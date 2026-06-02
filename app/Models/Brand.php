<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;
use App\Models\OrderDetail;

class Brand extends Model
{
    use SoftDeletes;

    protected $table = 'brand';

    // Một thương hiệu có nhiều sản phẩm
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }

    // Một thương hiệu có nhiều order detail thông qua product
    public function orderDetails()
    {
        return $this->hasManyThrough(
            OrderDetail::class,   // Model cuối
            Product::class,       // Model trung gian
            'brand_id',           // Khóa ngoại ở Product
            'product_id',         // Khóa ngoại ở OrderDetail
            'id',                 // Khóa chính ở Brand
            'id'                  // Khóa chính ở Product
        );
    }
}
