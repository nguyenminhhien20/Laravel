<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Lấy giỏ hàng từ session
    private function getCart()
    {
        return session('cart', []);
    }

    // Lưu giỏ hàng vào session
    private function saveCart($cart)
    {
        session(['cart' => $cart]);
    }

    // Hiển thị trang giỏ hàng
    public function index()
    {
        $list_cart = $this->getCart();
        $total = 0;

        foreach ($list_cart as $item) {
            $price = $item['price_sale'] > 0 ? $item['price_sale'] : $item['price_root'];
            if ($price <= 0) continue;

            $subtotal = $item['qty'] * $price;
            $total += $subtotal;
        }

        return view('frontend.cart', compact('list_cart', 'total'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addcart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.'
            ], 401);
        }

        $productId = $request->input('productid');
        $qty = max(1, min(100, (int)$request->input('qty', 1)));

        try {
            $product = Product::findOrFail($productId);
            if ($product->qty <= 0) {
    return response()->json([
        'status' => 'error',
        'message' => 'Sản phẩm "' . $product->name . '" hiện đã hết hàng.'
    ], 400);
}   
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sản phẩm không tồn tại.'
            ], 404);
        }

        $cart = $this->getCart();
        $found = false;

        foreach ($cart as $key => $item) {
            if ((int)$item['id'] === (int)$productId) {
                $newQty = $item['qty'] + $qty;
                if ($newQty > $product->qty) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Sản phẩm "' . $product->name . '" chỉ còn ' . $product->qty . ' sản phẩm trong kho.'
                    ], 400);
                }

                $cart[$key]['qty'] = $newQty;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'image' => $product->image ?? null,
                'thumbnail' => $product->thumbnail ?? 'no-image.png',
                'description' => $product->description ?? '',
                'price_root' => $product->price_root,
                'price_sale' => $product->price_sale ?? 0,
                'qty' => $qty
            ];
        }

        $this->saveCart($cart);
        $totalQty = array_sum(array_column($cart, 'qty'));

        return response()->json([
            'status' => 'success',
            'count' => $totalQty,
            'message' => 'Đã thêm sản phẩm vào giỏ hàng',
            'product' => [
                'name' => $product->name,
                'qty' => $qty,
                'price' => $product->price_sale > 0 ? $product->price_sale : $product->price_root,
            ]
        ]);
    }

    // Cập nhật số lượng sản phẩm (tăng/giảm)
    public function update(Request $request, $id)
    {
        $action = $request->input('action');
        $cart = $this->getCart();
        $found = false;

        foreach ($cart as $key => $item) {
            if ((int)$item['id'] === (int)$id) {
                $product = Product::find($id);
                if (!$product) {
                    return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong kho.');
                }

                if ($action === 'increase') {
                    if ($item['qty'] + 1 > $product->qty) {
                        return redirect()->back()->with('error', 'Chỉ còn ' . $product->qty . ' sản phẩm trong kho.');
                    }
                    $cart[$key]['qty'] = min(100, $item['qty'] + 1);
                } elseif ($action === 'decrease') {
                    $cart[$key]['qty'] = max(1, $item['qty'] - 1);
                } elseif ($action === 'manual') {
                    $qtyInput = (int)$request->input('qty', 1);

                    if ($qtyInput < 1 || $qtyInput > 100) {
                        return redirect()->back()->with('error', 'Số lượng phải từ 1 đến 100.');
                    }

                    if ($qtyInput > $product->qty) {
                        return redirect()->back()->with('error', 'Sản phẩm "' . $product->name . '" chỉ còn ' . $product->qty . ' sản phẩm trong kho.');
                    }

                    $cart[$key]['qty'] = $qtyInput;
                }

                $found = true;
                break;
            }
        }

        if (!$found) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng');
        }

        $this->saveCart($cart);
        return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công');
    }


    // Xóa 1 sản phẩm khỏi giỏ hàng
    public function remove($id)
    {
        $cart = $this->getCart();
        $cart = array_filter($cart, fn($item) => (int)$item['id'] !== (int)$id);
        $this->saveCart(array_values($cart));

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

    // Xóa toàn bộ giỏ hàng
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('site.cart.index')->with('success', 'Đã xóa toàn bộ giỏ hàng');
    }

    // Lấy tổng số lượng sản phẩm trong giỏ (AJAX)
    public function count()
    {
        $totalQty = array_sum(array_column($this->getCart(), 'qty'));

        return response()->json([
            'status' => 'success',
            'count' => $totalQty
        ]);
    }

    // Chọn sản phẩm để thanh toán
    public function checkoutSelected(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('site.login')->with('error', 'Bạn cần đăng nhập để thanh toán.');
        }

        $selected = $request->input('selected_items', []);
        $cart = $this->getCart();
        $selectedCart = [];

        foreach ($cart as $item) {
            if (in_array($item['id'], $selected)) {
                $selectedCart[] = $item;
            }
        }

        session(['selected_cart' => $selectedCart]);
        return redirect()->route('site.checkout.index');
    }
}
