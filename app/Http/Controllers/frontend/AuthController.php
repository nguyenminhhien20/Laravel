<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Trường hợp bỏ trống email hoặc password
        if (empty($email) || empty($password)) {
            return back()->withErrors(['login' => 'Đăng nhập không thành công'])->withInput();
        }

        $credentials = $request->only('email', 'password');

        // Trường hợp nhập đủ nhưng sai thông tin
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng'])->withInput();
    }


    public function showRegisterForm()
    {
        return view('frontend.auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email',
            'phone' => 'required|string|max:20',
            'username' => 'required|string|max:50|unique:user,username',
            'address' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra nếu avatar là hình ảnh hợp lệ
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Kiểm tra và lưu ảnh avatar nếu có
        $avatarPath = null;
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            // Lưu avatar vào thư mục 'avatars' trong storage và trả về đường dẫn
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        // Tạo user mới và lưu thông tin vào cơ sở dữ liệu
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => $request->username,
            'address' => $request->address,
            'avatar' => $avatarPath,
            'password' => Hash::make($request->password),
            'created_by' => Auth::id(),  // Gán giá trị created_by là ID của người đang đăng nhập
            'updated_at' => now(),
            'created_at' => now(),
            'status' => 1,
        ]);

        // Đăng nhập ngay sau khi tạo tài khoản
        Auth::login($user);

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout(); // Đăng xuất người dùng
        session()->invalidate(); // Hủy phiên làm việc hiện tại
        session()->regenerateToken(); // Tạo lại CSRF token để tránh tấn công CSRF
        return redirect('/login'); // Chuyển hướng về trang đăng nhập
    }
}
