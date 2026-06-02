<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function create($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('admin.shipping.create', compact('order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:order,id',
            'tracking_number' => 'nullable|string|max:255',
            'carrier' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'note' => 'nullable|string',
            'shipped_at' => 'nullable|date',
            'delivered_at' => 'nullable|date|after_or_equal:shipped_at',
        ]);

        Shipping::create($request->all());

        return redirect()->route('admin.order.show', $request->order_id)
                         ->with('success', 'Đã thêm thông tin vận chuyển thành công.');
    }
}
