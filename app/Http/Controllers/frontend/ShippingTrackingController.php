<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingTrackingController extends Controller
{
    public function show($orderId)
    {
        // Lấy đơn hàng theo ID và chỉ nếu thuộc về người dùng hiện tại
        $order = Order::with('shipping')
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('site.shipping.track', compact('order'));
    }
}
