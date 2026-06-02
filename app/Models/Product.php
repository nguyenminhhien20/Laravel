<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'product';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_root',
        'price_sale',
        'qty',
        'thumbnail',
        'image',
        'category_id',
        'brand_id',
        'status',
        'created_by',
        'updated_by',
    ];

    // Quan hệ đến bảng chi tiết đơn hàng
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

    // Quan hệ đến danh mục
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Quan hệ đến thương hiệu
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    // (Tuỳ chọn) Người tạo
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // (Tuỳ chọn) Người cập nhật
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
