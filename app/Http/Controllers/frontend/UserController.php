<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Hiển thị trang thông tin tài khoản
    public function index()
    {
        $user = Auth::user();
        return view('frontend.user.profile', compact('user'));
    }

    // Hiển thị form chỉnh sửa thông tin
    public function edit()
    {
        $user = Auth::user();
        return view('frontend.user.edit', compact('user')); // Tạo view này
    }

    // Xử lý cập nhật thông tin người dùng
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|max:2048', // tối đa 2MB
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/user'), $filename);
            $user->avatar = $filename;
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Cập nhật thông tin thành công!');
    }

    // Hiển thị form đổi mật khẩu
    public function showChangePasswordForm()
    {
        return view('frontend.user.change-password'); // Tạo file này nếu chưa có
    }

    // Xử lý đổi mật khẩu
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công.');
    }
}
