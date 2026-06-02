<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'order';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'total_amount',
        'address',
        'address_detail',
        'note',
        'payment_method',
        'status',
        'created_by',
        'updated_by',
        'cancelled_at',
    ];

    protected $dates = ['deleted_at', 'cancelled_at'];

    protected $casts = [
        'total_amount' => 'float',
    ];

    /**
     * Danh sách trạng thái đơn hàng
     */
    public const STATUS = [
        'pending'    => 'Chờ xử lý',
        'processing' => 'Đang xử lý',
        'shipped'    => 'Đang giao hàng',
        'completed'  => 'Hoàn thành',
        'cancelled'  => 'Đã hủy',
    ];

    /**
     * Trả về tên trạng thái
     */
    public function getStatusTextAttribute()
    {
        return self::STATUS[$this->status] ?? 'Không xác định';
    }

    /**
     * Quan hệ: Đơn hàng thuộc về một người dùng
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Quan hệ: Một đơn hàng có nhiều chi tiết đơn hàng
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    /**
     * Quan hệ: Một đơn hàng có một thông tin vận chuyển
     */
    public function shipping()
    {
        return $this->hasOne(Shipping::class, 'order_id');
    }
}
