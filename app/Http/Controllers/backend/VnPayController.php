<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Jobs\SendOrderConfirmationEmail;

class VnPayController extends Controller
{
    public function paymentSuccess(Request $request)
    {
        $order = Order::where('order_code', $request->input('vnp_TxnRef'))->first();

        if ($order) {
            $order->status = 1;
            $order->payment_status = 'paid';
            $order->save();

            // Gửi job email
            dispatch(new SendOrderConfirmationEmail($order));

            return redirect()->route('home')->with('success', 'Đơn hàng đã thanh toán thành công!');
        }

        return redirect()->route('home')->with('error', 'Không tìm thấy đơn hàng.');
    }
}
