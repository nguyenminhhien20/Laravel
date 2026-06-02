<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tyuu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-white">
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
    <x-slider />


    <!-- Contact Section -->
    <section class="container mx-auto px-6 py-12">
        <h3 class="text-xl font-semibold text-center text-rose-500 mb-8">
            <span class="inline-flex items-center justify-center p-1 bg-rose-500 text-white rounded-full mr-2">
                <i class="fas fa-headset text-sm"></i>
            </span>
            Liên Hệ Với Chúng Tôi
            <span class="inline-flex items-center justify-center p-1 bg-rose-500 text-white rounded-full ml-2">
                <i class="fas fa-headset text-sm"></i>
            </span>
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Form liên hệ -->
            <div class="bg-white p-6 shadow-lg rounded-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Gửi Tin Nhắn</h2>

                <!-- Hiển thị thông báo nếu có -->
                @if (session('success'))
                    <div class="bg-green-500 text-white p-2 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('site.contact.store') }}" method="POST" class="space-y-4">
                    @csrf <!-- Thêm CSRF token để bảo vệ chống tấn công CSRF -->
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700">Họ và Tên</label>
                        <input type="text" name="name" placeholder="Nhập họ và tên"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-rose-500 focus:ring focus:ring-rose-200">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700">Số Điện Thoại</label>
                        <input type="tel" name="phone" placeholder="Nhập số điện thoại"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-rose-500 focus:ring focus:ring-rose-200">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700">Email</label>
                        <input type="email" name="email" placeholder="Nhập email"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-rose-500 focus:ring focus:ring-rose-200">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700">Tiêu đề</label>
                        <input type="text" name="title" placeholder="Nhập tiêu đề"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-rose-500 focus:ring focus:ring-rose-200">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700">Nội dung</label>
                        <textarea name="content" placeholder="Nhập nội dung"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 h-28 focus:border-rose-500 focus:ring focus:ring-rose-200"></textarea>
                    </div>
                    <button type="submit"
                        class="w-full bg-rose-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-rose-600 transition">Gửi
                        Tin Nhắn</button>
                </form>
            </div>

            <!-- Thông tin liên hệ & Google Maps -->
            <div class="bg-white p-6 shadow-lg rounded-lg">
                <h2 class="text-2xl font-bold text-blue-500 mb-4">Thông Tin Liên Hệ</h2>
                <p class="text-gray-700 mb-3 flex items-center"><i class="fas fa-map-marker-alt text-rose-500 mr-3"></i>
                    46 Tăng Nhơn Phú, Quận 9, TP.HCM</p>
                <p class="text-gray-700 mb-3 flex items-center"><i class="fas fa-phone text-rose-500 mr-3"></i> 0123 456
                    789</p>
                <p class="text-gray-700 mb-3 flex items-center"><i class="fas fa-envelope text-rose-500 mr-3"></i>
                    contact@tyuumei.com</p>
                <p class="text-gray-700 flex items-center"><i class="fas fa-clock text-rose-500 mr-3"></i> 8:00 - 18:00
                    (Thứ 2 - Thứ 7)</p>

                <!-- Google Maps -->
                <div class="mt-6 relative w-full h-[220px] rounded-lg shadow-md overflow-hidden">
                    <iframe class="absolute inset-0 w-full h-full rounded-lg"
                        src="https://maps.google.com/maps?q=Ho%20Chi%20Minh&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        frameborder="0" allowfullscreen></iframe>
                </div>
            </div>

        </div>
    </section>


    <!-- Footer -->
    <x-MenuFooter />
</body>

</html>
