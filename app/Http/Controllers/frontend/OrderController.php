<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Lưu đơn hàng từ form thanh toán
     */
    public function store(Request $request)
    {
        // Lấy giỏ hàng từ session
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        // Validate dữ liệu người mua
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'phone'           => 'required|string|max:20',
            'address'         => 'required|string|max:255',
            'address_detail'  => 'nullable|string|max:255',
            'note'            => 'nullable|string|max:1000',
            'payment_method'  => 'required|in:cod,bank_transfer,paypal',
        ]);

        $userId = auth()->id();

        DB::beginTransaction();

        try {
            $totalAmount = 0;
            foreach ($cart as $item) {
                $price = (float)(($item['price_sale'] ?? 0) > 0 ? $item['price_sale'] : ($item['price_root'] ?? 0));
                $qty = (int)($item['qty'] ?? 1);
                $totalAmount += $price * $qty;
            }

            $orderData = [
                'user_id'        => $userId,
                'name'           => $validated['name'],
                'email'          => $validated['email'],
                'phone'          => $validated['phone'],
                'address'        => $validated['address'],
                'address_detail' => $validated['address_detail'] ?? null,
                'note'           => $validated['note'] ?? null,
                'payment_method' => $validated['payment_method'],
                'total_amount'   => $totalAmount,
                'status'         => 'pending',
            ];

            if (Order::hasColumn('created_by')) {
                $orderData['created_by'] = $userId;
            }
            if (Order::hasColumn('updated_by')) {
                $orderData['updated_by'] = $userId;
            }

            $order = Order::create($orderData);

            // Thêm chi tiết đơn hàng
            foreach ($cart as $item) {
                if (!isset($item['product_id'])) {
                    continue;
                }

                $price = ($item['price_sale'] ?? 0) > 0 ? ($item['price_sale'] ?? 0) : ($item['price_root'] ?? 0);
                $qty = $item['qty'] ?? 1;

                $order->orderDetails()->create([
                    'product_id' => $item['product_id'],
                    'price_buy'  => $price,
                    'qty'        => $qty,
                    'amount'     => $price * $qty,
                ]);
            }

            DB::commit();

            // Xóa giỏ hàng sau khi đặt hàng
            session()->forget('cart');

            // Chuyển hướng đến trang xác nhận
            return redirect()->route('site.order.confirm', $order->id)
                ->with('message', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi đặt hàng: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi đặt hàng. Vui lòng thử lại.');
        }
    }


    /**
     * Trang xác nhận đơn hàng sau khi đặt
     */
    public function confirm($id)
    {
        $order = Order::with('orderDetails.product')->findOrFail($id);

        // Kiểm tra nếu đơn hàng thuộc về người dùng hiện tại
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Bạn không có quyền xem đơn hàng này.');
        }

        return view('frontend.order.confirm', compact('order'));
    }

    /**
     * Trang lịch sử đơn hàng của người dùng
     */
    public function history()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('orderDetails.product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.order.history', compact('orders'));
    }

    /**
     * Hủy đơn hàng (chỉ khi đang chờ xử lý)
     */
    public function cancel($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Chỉ có thể hủy đơn hàng đang chờ xử lý.');
        }

        $order->update([
            'status' => 'cancelled',
            'cancelled_at' => now(), // nếu bạn có cột cancelled_at
        ]);

        // Chuyển hướng đến trang hủy thành công
        return redirect()->route('order.cancel.success')->with('message', 'Đơn hàng đã được hủy thành công.');
    }

    /**
     * Trang hiển thị sau khi hủy đơn hàng thành công
     */
    public function cancelSuccess()
    {
        return view('frontend.order.cancel_success');
    }
}
