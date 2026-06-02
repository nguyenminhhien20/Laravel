<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký - TyuuMei</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-b from-rose-100 via-rose-200 to-white min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="bg-white shadow-md px-6">
        <div class="flex justify-between items-center py-4 w-full">
            <!-- Logo + Brand -->
            <a href="{{ route('site.home') }}">
                <img src="build/assets/images/logo1.jpg" alt="Logo" class="h-12 w-12 rounded-full object-cover">
            </a>
            <span class="text-2xl font-extrabold text-gray-600">
                Tyuu<span class="text-rose-500">Mei</span>
            </span>
            <!-- MainMenu -->
            <x-main-menu />
    </header>

    <section class="container mx-auto px-6 py-12">
        <div class="max-w-md mx-auto p-8 bg-white shadow-xl rounded-2xl border border-rose-200">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-2 flex items-center justify-center space-x-2">
                    <i class="fas fa-user-plus text-rose-500"></i>
                    <span>Đăng Ký</span>
                </h2>
                <p class="text-gray-500 text-sm">Tạo tài khoản mới để tham gia TyuuMei</p>
            </div>

            <!-- Registration Form -->
            <form action="{{ url('/register') }}" method="POST" class="space-y-5" enctype="multipart/form-data">
                @csrf

                <!-- Name Input -->
                <div class="relative">
                    <i class="fas fa-user absolute left-3 top-3.5 text-gray-400"></i>
                    <input type="text" name="name" placeholder="Họ và Tên" value="{{ old('name') }}"
                        class="w-full pl-10 pr-4 py-2.5 border border-rose-300 rounded-lg focus:border-rose-500 focus:ring-2 focus:ring-rose-200 transition">
                    @error('name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Username Input -->
                <div class="relative">
                    <i class="fas fa-user absolute left-3 top-3.5 text-gray-400"></i>
                    <input type="text" name="username" id="username" placeholder="Tên đăng nhập"
                        value="{{ old('username') }}"
                        class="w-full pl-10 pr-4 py-2.5 border border-rose-300 rounded-lg focus:border-rose-500 focus:ring-2 focus:ring-rose-200 transition">
                    @error('username')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Input -->
                <div class="relative">
                    <i class="fas fa-phone absolute left-3 top-3.5 text-gray-400"></i>
                    <input type="text" name="phone" placeholder="Số điện thoại" value="{{ old('phone') }}"
                        class="w-full pl-10 pr-4 py-2.5 border border-rose-300 rounded-lg focus:border-rose-500 focus:ring-2 focus:ring-rose-200 transition">
                    @error('phone')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Address Input -->
                <div class="relative">
                    <i class="fas fa-map-marker-alt absolute left-3 top-3.5 text-gray-400"></i>
                    <input type="text" name="address" placeholder="Địa chỉ" value="{{ old('address') }}"
                        class="w-full pl-10 pr-4 py-2.5 border border-rose-300 rounded-lg focus:border-rose-500 focus:ring-2 focus:ring-rose-200 transition">
                    @error('address')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="relative">
                    <i class="fas fa-envelope absolute left-3 top-3.5 text-gray-400"></i>
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                        class="w-full pl-10 pr-4 py-2.5 border border-rose-300 rounded-lg focus:border-rose-500 focus:ring-2 focus:ring-rose-200 transition">
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Password Input -->
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-3.5 text-gray-400"></i>
                    <input type="password" name="password" placeholder="Mật khẩu"
                        class="w-full pl-10 pr-4 py-2.5 border border-rose-300 rounded-lg focus:border-rose-500 focus:ring-2 focus:ring-rose-200 transition">
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Confirmation Input -->
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-3.5 text-gray-400"></i>
                    <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu"
                        class="w-full pl-10 pr-4 py-2.5 border border-rose-300 rounded-lg focus:border-rose-500 focus:ring-2 focus:ring-rose-200 transition">
                    @error('password_confirmation')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>



                <!-- Avatar Input -->
                <div class="relative">
                    <i class="fas fa-image absolute left-3 top-3.5 text-gray-400"></i>
                    <input type="file" name="avatar" accept="image/*"
                        class="w-full pl-10 pr-4 py-2.5 border border-rose-300 rounded-lg focus:border-rose-500 focus:ring-2 focus:ring-rose-200 transition">
                    @error('avatar')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-rose-500 to-rose-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-rose-600 hover:to-rose-700 transition">
                    <i class="fas fa-user-plus mr-2"></i> Đăng Ký
                </button>
            </form>

            <p class="text-center text-gray-700 mt-4 text-sm">Đã có tài khoản? <a href="/login"
                    class="text-rose-500 hover:text-rose-600 font-medium">Đăng nhập ngay</a></p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-b from-rose-300 to-rose-500 text-white py-6 mt-auto">
        <div class="container mx-auto text-center">
            <p class="text-sm">© 2025 TyuuMei, Bản quyền thuộc về chúng tôi</p>
        </div>
    </footer>

</body>

</html>
