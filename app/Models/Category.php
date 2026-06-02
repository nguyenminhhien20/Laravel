<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;
use App\Models\OrderDetail;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'category';

    // Mối quan hệ: Category → Products → OrderDetails
    public function orderDetails()
    {
        return $this->hasManyThrough(
            OrderDetail::class,   // Model cuối
            Product::class,       // Model trung gian
            'category_id',        // Khóa ngoại trong bảng Product
            'product_id',         // Khóa ngoại trong bảng OrderDetail
            'id',                 // Khóa chính của Category
            'id'                  // Khóa chính của Product
        );
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
