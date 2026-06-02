<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đổi Mật Khẩu - TyuuMei</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-white min-h-screen flex flex-col font-sans">

    <!-- Navbar -->
    <header class="bg-white shadow-md px-6 py-4">
        <div class="flex justify-between items-center">
            <a href="{{ route('site.home') }}" class="flex items-center gap-2">
                <img src="{{ asset('build/assets/images/logo1.jpg') }}" alt="Logo"
                    class="h-12 w-12 rounded-full object-cover">
                <span class="text-2xl font-extrabold text-gray-700">
                    Tyuu<span class="text-rose-500">Mei</span>
                </span>
            </a>
            <x-main-menu />
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-xl bg-white p-8 sm:p-10 rounded-2xl shadow-lg border border-gray-100">
            <h1 class="text-3xl font-bold text-center text-teal-600 mb-6">🔒 Đổi Mật Khẩu</h1>

            {{-- Thông báo thành công --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-300 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Hiển thị lỗi --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 text-red-700 border border-red-300 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('user.password.update') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="current_password" class="block text-gray-700 font-medium mb-1">
                        Mật khẩu hiện tại
                    </label>
                    <input type="password" name="current_password" id="current_password" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 transition" />
                </div>

                <div>
                    <label for="new_password" class="block text-gray-700 font-medium mb-1">
                        Mật khẩu mới
                    </label>
                    <input type="password" name="new_password" id="new_password" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 transition" />
                </div>

                <div>
                    <label for="new_password_confirmation" class="block text-gray-700 font-medium mb-1">
                        Xác nhận mật khẩu mới
                    </label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 transition" />
                </div>

                <button type="submit"
                    class="w-full bg-teal-500 hover:bg-rose-500 text-white font-semibold py-2 rounded-xl shadow-md transition duration-300">
                    Cập nhật mật khẩu
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('user.profile') }}"
                    class="text-sm text-gray-500 hover:text-teal-500 transition duration-300">
                    ← Quay lại trang thông tin
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-10 py-6">
        <div class="text-center text-sm text-gray-500 space-y-2">
            <p>© 2025 TyuuMei. All rights reserved.</p>
            <div class="flex justify-center gap-6 text-xl">
                <a href="#" class="hover:text-rose-500 transition"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-rose-500 transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-rose-500 transition"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

</body>

</html>
