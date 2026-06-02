<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang Cá Nhân - TyuuMei</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-50 flex flex-col min-h-screen font-sans">

    <!-- Navbar -->
    <header class="bg-white shadow-md px-6 py-4">
        <div class="flex justify-between items-center">
            <a href="{{ route('site.home') }}">
                <a href="#">
                    <img src="build/assets/images/logo1.jpg" alt="Logo" class="h-12 w-12 rounded-full object-cover">
                </a>
                <span class="text-2xl font-extrabold text-gray-600">
                    Tyuu<span class="text-rose-500">Mei</span>
                </span>
                <x-main-menu />
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <section class="container mx-auto px-6 py-12">
            <h1
                class="text-3xl sm:text-4xl font-bold text-center text-teal-500 mb-10 hover:text-rose-500 transition duration-300">
                👤 Thông Tin Tài Khoản
            </h1>

            <div class="bg-white p-8 sm:p-10 shadow-md rounded-xl max-w-4xl mx-auto">
                <!-- Avatar + Info -->
                <div class="flex flex-col sm:flex-row items-center sm:items-center sm:space-x-10 mb-10">
                    <div class="w-32 h-32 sm:w-40 sm:h-40 mb-6 sm:mb-0">
                        <img src="{{ asset('assets/images/user/' . $user->avatar) }}"
                            class="w-full h-full object-cover rounded-full border-4 border-rose-400 shadow-lg"
                            alt="{{ $user->name }}" />
                    </div>
                    <div class="text-center sm:text-left space-y-1">
                        <p class="text-2xl font-semibold text-gray-800">{{ $user->name }}</p>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        <p class="text-gray-400 text-sm">Tham gia ngày: {{ $user->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>

                <!-- Details -->
                <div class="space-y-4 text-gray-700">
                    <p><span class="font-medium w-36 inline-block">Tên:</span> {{ $user->name }}</p>
                    <p><span class="font-medium w-36 inline-block">Email:</span> {{ $user->email }}</p>
                    <p><span class="font-medium w-36 inline-block">Số điện thoại:</span>
                        {{ $user->phone ?? 'Chưa cập nhật' }}</p>
                    <p><span class="font-medium w-36 inline-block">Địa chỉ:</span>
                        {{ $user->address ?? 'Chưa cập nhật' }}</p>
                    <p><span class="font-medium w-36 inline-block">Ngày tạo:</span>
                        {{ $user->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <!-- Actions -->
                <div class="mt-10 flex flex-col sm:flex-row justify-center gap-6">
                    <a href="{{ route('frontend.user.edit') }}"
                        class="flex items-center justify-center px-6 py-3 bg-teal-500 text-white rounded-lg shadow hover:bg-rose-500 transition duration-300">
                        <i class="fas fa-edit mr-2"></i> Chỉnh sửa thông tin
                    </a>

                    <a href="{{ route('user.password.change') }}"
                        class="flex items-center justify-center px-6 py-3 bg-rose-500 text-white rounded-lg shadow hover:bg-teal-500 transition duration-300">
                        <i class="fas fa-lock mr-2"></i> Đổi mật khẩu
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-14 py-6">
        <div class="text-center text-sm text-gray-500 space-y-2">
            <p>© 2025 TyuuMei. All rights reserved.</p>
            <div class="flex justify-center gap-6 text-2xl">
                <a href="#" class="hover:text-rose-500 transition"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-rose-500 transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-rose-500 transition"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

</body>

</html>
