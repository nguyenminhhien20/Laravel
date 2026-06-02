<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    // Tên bảng nếu không theo chuẩn Laravel
    protected $table = 'shipping';

    // Cho phép mass assignment các trường sau
    protected $fillable = [
        'order_id',
        'shipping_partner',        // Đối tác vận chuyển (Giao hàng tiết kiệm, GHN...)
        'tracking_number',         // Mã vận đơn
        'status',                  // Trạng thái: pending, delivering, delivered, failed,...
        'estimated_delivery_date', // Ngày giao dự kiến
        'shipping_address',        // Thêm địa chỉ giao nếu khác với order.address
        'carrier',                 // Tên hãng vận chuyển (nếu khác shipping_partner)
        'note',                    // Ghi chú vận chuyển
    ];

    protected $casts = [
        'estimated_delivery_date' => 'datetime',
    ];

    // Quan hệ: Shipping thuộc về Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
