<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TyuuMei</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-white">
    <!-- Navbar -->
    <header class="bg-white shadow-md px-6">
        <div class="flex justify-between items-center py-4 w-full">
            <!-- Logo + Brand -->
            <a href="#">
                <img src="build/assets/images/logo1.png" alt="Logo" class="h-14 w-auto">
            </a>
            {{-- <span class="text-2xl font-extrabold text-gray-800 flex">
                <span class="text-blue-500">Tyuu</span>
                <span class="text-orange-500">M</span>
                <span class="text-red-500">EI</span>
            </span> --}}
            <span class="text-2xl font-extrabold text-gray-600">Tyuu<span class="text-rose-500">Mei</span></span>


            <!-- MainMenu -->
            <x-main-menu />
    </header>

    <x-slider />

    <x-product-new />



    <!-- Sản phẩm khuyến mãi -->
    <x-product-sale />

    <!-- Danh Mục mới-->
    <section class="py-12 px-6 bg-gray-100">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">🔥Danh Mục Mới 🔥</h2>
            <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
        </div>
    </section>

    <script>
        const products = [{
                img: "build/assets/images/nike1.jpg",
                name: "Nike Jordan",
                desc: "High-class",
                price: "2.500.000đ"
            },
            {
                img: "build/assets/images/ad1.jpg",
                name: "Adidas Sneaker",
                desc: "High-class",
                price: "2.650.000đ"
            },
            {
                img: "build/assets/images/pm1.jpg",
                name: "Puma White",
                desc: "High-class",
                price: "2.700.000đ"
            },
            {
                img: "build/assets/images/convert1.jpg",
                name: "Convert",
                desc: "High-class",
                price: "2.750.000đ"
            },
        ];

        const productGrid = document.getElementById("product-grid");

        productGrid.innerHTML = products.map((product, index) => `
        <div class="bg-white border rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-transform scale-up"
            id="product-${index}"
            onclick="scaleEffect(this)">
            <img src="${product.img}" alt="${product.name}" class="w-full h-56 object-cover">
            <div class="p-4 text-center">
                <h3 class="text-lg font-semibold">${product.name}</h3>
                <p class="text-gray-600">${product.desc}</p>
                <p class="text-red-500 font-bold mt-2">${product.price}</p>
                <button class="mt-4 bg-rose-500 text-white px-4 py-2 rounded-full hover:bg-rose-600 transition">🛒Mua ngay</button>
            </div>
        </div>
    `).join("");

        function scaleEffect(element) {
            element.style.transform = "scale(1.1)";
            setTimeout(() => {
                element.style.transform = "scale(1)";
            }, 200);
        }
    </script>

    <style>
        .transition-transform {
            transition: transform 0.3s ease-in-out;
        }

        .scale-up:hover {
            transform: scale(1.05);
        }
    </style>



    <!-- Footer -->
    <div class="border-b border-gray-300 pb-6 mb-6 text-center">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center justify-center gap-2">
            🌍 <span>Chọn Khu Vực</span>
        </h2>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="#"
                class="bg-white rounded-lg shadow hover:shadow-lg transform hover:scale-105 transition px-2.5 py-2 flex flex-col items-center w-24">
                <img src="china.png" alt="China" class="w-8 h-8 rounded-full border">
                <span class="mt-1 text-sm font-medium text-gray-700">China</span>
            </a>
            <a href="#"
                class="bg-white rounded-lg shadow hover:shadow-lg transform hover:scale-105 transition px-2.5 py-2 flex flex-col items-center w-24">
                <img src="germany-flag.png" alt="Germany" class="w-8 h-8 rounded-full border">
                <span class="mt-1 text-sm font-medium text-gray-700">Germany</span>
            </a>
            <a href="#"
                class="bg-white rounded-lg shadow hover:shadow-lg transform hover:scale-105 transition px-2.5 py-2 flex flex-col items-center w-24">
                <img src="australia-flag.png" alt="Portugal" class="w-8 h-8 rounded-full border">
                <span class="mt-1 text-sm font-medium text-gray-700">Portugal</span>
            </a>
            <a href="#"
                class="bg-white rounded-lg shadow hover:shadow-lg transform hover:scale-105 transition px-2.5 py-2 flex flex-col items-center w-24">
                <img src="russia-flag.png" alt="Russia" class="w-8 h-8 rounded-full border">
                <span class="mt-1 text-sm font-medium text-gray-700">Russia</span>
            </a>
            <a href="#"
                class="bg-white rounded-lg shadow hover:shadow-lg transform hover:scale-105 transition px-2.5 py-2 flex flex-col items-center w-24">
                <img src="india-flag.png" alt="India" class="w-8 h-8 rounded-full border">
                <span class="mt-1 text-sm font-medium text-gray-700">India</span>
            </a>
            <a href="#"
                class="bg-white rounded-lg shadow hover:shadow-lg transform hover:scale-105 transition px-2.5 py-2 flex flex-col items-center w-24">
                <img src="uk-flag.png" alt="England" class="w-8 h-8 rounded-full border">
                <span class="mt-1 text-sm font-medium text-gray-700">England</span>
            </a>
            <a href="#"
                class="bg-white rounded-lg shadow hover:shadow-lg transform hover:scale-105 transition px-2.5 py-2 flex flex-col items-center w-24">
                <img src="turkey-flag.png" alt="Thái Lan" class="w-8 h-8 rounded-full border">
                <span class="mt-1 text-sm font-medium text-gray-700">Thái Lan</span>
            </a>
            <a href="#"
                class="bg-white rounded-lg shadow hover:shadow-lg transform hover:scale-105 transition px-2.5 py-2 flex flex-col items-center w-24">
                <img src="uzbekistan-flag.png" alt="Việt Nam" class="w-8 h-8 rounded-full border">
                <span class="mt-1 text-sm font-medium text-gray-700">Việt Nam</span>
            </a>
        </div>
        <div class="mt-4">
            <a href="#"
                class="inline-block px-5 py-1.5 text-xs font-semibold text-white bg-rose-500 rounded-full hover:bg-rose-600 transition">
                More regions
            </a>
        </div>
    </div>

    <!-- Đăng ký email -->
    <div class="bg-gradient-to-b from-blue-500 to-rose-200 p-6 text-center rounded-lg">
        <p class="text-lg mb-3">Nhận Thông báo các xu hướng sản phẩm mới nhất tới hộp thư của bạn.</p>
        <div class="flex justify-center gap-2">
            <input type="email" placeholder="Your Email" class="p-2 w-80 rounded text-black">
            <button class="bg-rose-500 text-black px-4 py-2 rounded font-semibold">&#9993; Subscribe</button>
        </div>
        <p class="text-xs mt-2">We'll never share your email address with a third-party.</p>
    </div>

    <footer class="bg-gradient-to-b from-rose-200 to-rose-400 text-gray-900 py-8">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                <div>
                    <h6 class="font-semibold mb-2">Thương hiệu</h6>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Adidas</a></li>
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Puma</a></li>
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Reebok</a></li>
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Nike</a></li>
                    </ul>
                </div>
                <div>
                    <h6 class="font-semibold mb-2">Công ty</h6>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Giới thiệu</a></li>
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Tuyển dụng</a></li>
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Hệ thống cửa hàng</a>
                        </li>
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Điều khoản sử
                                dụng</a></li>
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Sitemap</a></li>
                    </ul>
                </div>
                <div>
                    <h6 class="font-semibold mb-2">Hỗ trợ</h6>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Liên hệ</a></li>
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Chính sách hoàn
                                tiền</a></li>
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Tra cứu đơn
                                hàng</a></li>
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Thông tin vận
                                chuyển</a></li>
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Khiếu nại</a></li>
                    </ul>
                </div>
                <div>
                    <h6 class="font-semibold mb-2">Tài khoản</h6>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Đăng nhập</a></li>
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Đăng ký</a></li>
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Cài đặt tài
                                khoản</a></li>
                        <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Đơn hàng của
                                tôi</a></li>
                    </ul>
                </div>
                <div>
                    <h6 class="font-semibold mb-2">Mạng xã hội</h6>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="flex items-center space-x-2 hover:text-rose-500 active:text-rose-600">
                                <i class="fab fa-facebook"></i> <span>Facebook</span>
                            </a></li>
                        <li><a href="#"
                                class="flex items-center space-x-2 hover:text-rose-500 active:text-rose-600">
                                <i class="fab fa-twitter"></i> <span>Twitter</span>
                            </a></li>
                        <li><a href="#"
                                class="flex items-center space-x-2 hover:text-rose-500 active:text-rose-600">
                                <i class="fab fa-instagram"></i> <span>Instagram</span>
                            </a></li>
                        <li><a href="#"
                                class="flex items-center space-x-2 hover:text-rose-500 active:text-rose-600">
                                <i class="fab fa-youtube"></i> <span>Youtube</span>
                            </a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-8 text-center text-gray-700 text-sm">
                <p>Chính sách bảo mật - Điều khoản sử dụng - Hướng dẫn bảo vệ thông tin người dùng</p>
                <p>&copy; 2025 TyuuMei, Bản quyền thuộc về chúng tôi</p>
            </div>
        </div>
    </footer>


</body>

</html>
