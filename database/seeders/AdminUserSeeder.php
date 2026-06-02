<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Mei',
            'username' => 'Mei',
            'email' => 'Mei@gmail.com',
            'phone' => '0123456789',
            'address' => 'Địa chỉ admin',
            'password' => Hash::make('327490'),  // Mật khẩu bạn muốn đặt
            'avatar' => 'default-avatar.png',
            'roles' => 'admin',
            'created_by' => 0,
            'status' => true,
        ]);
    }
}
