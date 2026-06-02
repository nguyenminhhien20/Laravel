<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    // Hiển thị form đăng nhập admin
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Xử lý đăng nhập admin
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $user = Auth::guard('admin')->user();

            if ($user->roles !== 'admin') {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with('error', 'Tài khoản không có quyền truy cập.');
            }

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email hoặc mật khẩu không đúng.')->withInput();
    }

    // Hiển thị form đăng ký admin
    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    // Xử lý đăng ký admin
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email',  // Bảng user
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'nullable|string|max:255',
        ]);

        $username = explode('@', $request->email)[0];

        $user = User::create([
            'name'       => $request->name,
            'username'   => $username,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'address'    => $request->address ?? '',
            'avatar'     => '',
            'status'     => 1,
            'created_by' => Auth::id() ?? 0,
            'password'   => Hash::make($request->password),
            'roles'      => 'admin',
        ]);

        Auth::guard('admin')->login($user);

        return redirect()->route('dashboard')->with('success', 'Tạo tài khoản quản trị thành công.');
    }

    // Đăng xuất admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
