<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đơn Hàng Đã Hủy - TyuuMei</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    <!-- Navbar -->
    <header class="bg-white shadow-md px-6">
        <div class="flex justify-between items-center py-4 w-full">
            <a href="{{ route('site.home') }}">
                <img src="{{ asset('build/assets/images/logo1.jpg') }}" alt="Logo"
                    class="h-12 w-12 rounded-full object-cover">
            </a>
            <span class="text-2xl font-extrabold text-gray-700">Tyuu<span class="text-rose-500">Mei</span></span>
            <x-main-menu />
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <section class="container mx-auto px-6 py-12">
            <h3 class="text-2xl font-bold text-center mb-10 text-red-500">❌ Đơn Hàng Đã Được Hủy</h3>

            <div class="bg-white p-6 shadow-lg rounded-lg max-w-2xl mx-auto text-center">
                <p class="text-lg text-gray-700 mb-4">
                    Đơn hàng của bạn đã được hủy thành công. Rất tiếc vì sự bất tiện này.
                </p>

                <p class="text-sm text-gray-500 mb-6">
                    Nếu đây là sự nhầm lẫn hoặc bạn cần hỗ trợ thêm, vui lòng liên hệ đội ngũ chăm sóc khách hàng của chúng tôi.
                </p>

                <a href="{{ route('site.home') }}"
                    class="inline-block bg-rose-500 text-white px-6 py-3 rounded hover:bg-rose-600 shadow transition">
                    🏠 Quay về trang chủ
                </a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 text-gray-600 py-6 mt-12">
        <div class="max-w-7xl mx-auto text-center space-y-2">
            <p class="text-sm">© 2025 TyuuMei. All rights reserved.</p>
            <div class="flex justify-center space-x-4">
                <a href="#" class="hover:text-rose-500"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-rose-500"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-rose-500"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

</body>

</html>
