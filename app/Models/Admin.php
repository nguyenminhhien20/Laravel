<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        // các cột khác của bảng admins
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
