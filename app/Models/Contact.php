<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Contact extends Model
{
    protected $table ='contact';
    use softDeletes;

       protected $fillable = [
        'name',
        'phone',
        'email',
        'title',
        'content',
        'created_by',
        'status',
    ];

    // Nếu bạn sử dụng SoftDeletes, Laravel sẽ tự động thêm trường deleted_at vào cơ sở dữ liệu của bạn
    protected $dates = ['deleted_at'];
}
