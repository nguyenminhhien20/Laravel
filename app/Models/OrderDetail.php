<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Order;
use App\Models\Product;

class OrderDetail extends Model
{
    // Tên bảng không có tiền tố, Laravel sẽ nối với prefix 'nmh_' nếu đã cấu hình
    protected $table = 'order_detail';

    // Nếu bảng có created_at và updated_at, hãy để true
    public $timestamps = true;

    // Nếu dùng soft delete (nên dùng), khai báo use SoftDeletes
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'product_id',
        'price_buy',
        'qty',
        'amount',
    ];

    protected $casts = [
        'price_buy' => 'float',
        'qty' => 'integer',
        'amount' => 'float',
    ];

    /**
     * Quan hệ: Chi tiết đơn hàng thuộc về một đơn hàng
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Quan hệ: Chi tiết đơn hàng thuộc về một sản phẩm
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
