<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    const CART_SESSION_KEY = 'cart';

    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thanh toán.');
        }

        $cartItems = $request->session()->get(self::CART_SESSION_KEY, []);
        $selectedIds = session('selected_items', []);
        if (!empty($selectedIds)) {
            $cartItems = array_filter($cartItems, function ($item) use ($selectedIds) {
                return in_array($item['id'], $selectedIds);
            });
        }

        if (empty($cartItems)) {
            return redirect()->route('site.cart.index')->with('message', 'Bạn chưa chọn sản phẩm nào để thanh toán.');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $price = ($item['price_sale'] ?? 0) > 0 ? $item['price_sale'] : ($item['price_root'] ?? 0);
            $total += $price * ($item['qty'] ?? 1);
        }

        return view('frontend.checkout', [
            'cartItems'    => $cartItems,
            'total'        => $total,
            'selected_ids' => $selectedIds,
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đặt hàng.');
        }

        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone'            => 'required|string|max:20',
            'address'          => 'required|string|max:255',
            'address_detail'   => 'nullable|string|max:255',
            'payment_method'   => 'required|string|in:cod,bank_transfer,paypal',
            'selected_items'   => 'required|array|min:1',
            'selected_items.*' => 'required|integer|distinct|exists:product,id',
        ]);

        $cartItems   = $request->session()->get(self::CART_SESSION_KEY, []);
        $selectedIds = $request->input('selected_items', []);

        $selectedItems = array_filter($cartItems, function ($item) use ($selectedIds) {
            return in_array($item['id'], $selectedIds);
        });

        if (empty($selectedItems)) {
            return redirect()->route('site.cart.index')->with('error', 'Bạn chưa chọn sản phẩm nào để thanh toán.');
        }

        $totalAmount = 0;
        foreach ($selectedItems as $item) {
            $price = ($item['price_sale'] ?? 0) > 0 ? $item['price_sale'] : ($item['price_root'] ?? 0);
            $totalAmount += $price * ($item['qty'] ?? 1);
        }

        // ✅ Kiểm tra tồn kho (dùng $product->qty thay vì quantity)
        foreach ($selectedItems as $item) {
            $product = Product::find($item['id']);
            if (!$product || $product->qty < $item['qty']) {
                return redirect()->back()->with('error', 'Sản phẩm "' . $item['name'] . '" đã hết hàng hoặc không đủ số lượng tồn kho.');
            }
        }

        DB::beginTransaction();

        try {
            $userId = Auth::id();

            $order = new Order();
            $order->user_id        = $userId;
            $order->name           = $request->name;
            $order->email          = $request->email;
            $order->phone          = $request->phone;
            $order->address        = trim($request->address . ' - ' . $request->address_detail);
            $order->payment_method = $request->payment_method;
            $order->total_amount   = $totalAmount;
            $order->status         = 'pending';

            if (property_exists($order, 'created_by')) {
                $order->created_by = $userId;
            }
            if (property_exists($order, 'updated_by')) {
                $order->updated_by = $userId;
            }

            $order->save();

            Shipping::create([
                'order_id'         => $order->id,
                'status'           => 'pending',
                'shipping_address' => $order->address,
                'carrier'          => 'Đang xử lý',
                'tracking_number'  => null,
                'note'             => 'Đơn hàng đang được xử lý',
            ]);

            if ($order->payment_method === 'bank_transfer') {
                DB::commit();
                return redirect()->route('vnpay.payment', ['order_id' => $order->id]);
            }

            foreach ($selectedItems as $item) {
                $product = Product::find($item['id']);

                if (!$product) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
                }

                if ($item['qty'] > $product->qty) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Sản phẩm "' . $product->name . '" chỉ còn ' . $product->qty . ' sản phẩm trong kho.');
                }

                $price = ($item['price_sale'] ?? 0) > 0 ? $item['price_sale'] : ($item['price_root'] ?? 0);

                OrderDetail::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['id'],
                    'price_buy'  => $price,
                    'qty'        => $item['qty'] ?? 1,
                    'amount'     => $price * ($item['qty'] ?? 1),
                ]);

                $product->qty -= $item['qty'];
                $product->save();
            }

            DB::commit();

            $remainingCart = array_filter($cartItems, function ($item) use ($selectedIds) {
                return !in_array($item['id'], $selectedIds);
            });
            $request->session()->put(self::CART_SESSION_KEY, array_values($remainingCart));

            return redirect()->route('site.checkout.confirm', $order->id)
                ->with('message', 'Đơn hàng của bạn đã được đặt thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi đặt hàng: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi đặt hàng. Vui lòng thử lại.');
        }
    }

    public function confirm($id)
    {
        $order = Order::with('orderDetails')->findOrFail($id);

        if ($order->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xem đơn hàng này.');
        }

        return view('frontend.checkout-confirm', compact('order'));
    }

    public function checkoutSelected(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thanh toán.');
        }

        $selectedIds = $request->input('selected_items', []);

        if (empty($selectedIds)) {
            return redirect()->route('site.cart.index')->with('error', 'Vui lòng chọn ít nhất một sản phẩm để thanh toán.');
        }

        $request->session()->flash('selected_items', $selectedIds);

        return redirect()->route('site.checkout.index');
    }

    public function buyNow(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để mua hàng.');
        }

        $productId = $request->input('product_id');
        $qty = $request->input('qty', 1);

        $product = Product::findOrFail($productId);

        // ✅ Kiểm tra tồn kho
        if ($product->qty < $qty) {
            return redirect()->back()->with('error', 'Sản phẩm "' . $product->name . '" đã hết hàng hoặc không đủ số lượng tồn kho.');
        }

        $cart = session()->get(self::CART_SESSION_KEY, []);

        $cart[$productId] = [
            'id'         => $product->id,
            'name'       => $product->name,
            'thumbnail'  => $product->thumbnail,
            'price_root' => $product->price_root,
            'price_sale' => $product->price_sale,
            'qty'        => $qty,
        ];

        session()->put(self::CART_SESSION_KEY, $cart);
        session()->flash('selected_items', [$productId]);

        return redirect()->route('site.checkout.index');
    }
}
