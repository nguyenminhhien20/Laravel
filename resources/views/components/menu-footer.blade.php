<!-- Footer -->
<section class="bg-gradient-to-b from-white to-gray-50 py-12 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8 text-center">
            <!-- 1. Mẫu giày -->
            <div class="group">
                <div
                    class="flex flex-col items-center justify-center space-y-3 p-4 rounded-lg transition-all duration-300 group-hover:scale-105 group-hover:shadow-xl">
                    <i class="fas fa-shoe-prints text-3xl text-rose-500 group-hover:text-rose-600"></i>
                    <p class="text-gray-800 font-medium text-sm">+mẫu giày</p>
                </div>
            </div>

            <!-- 2. Miễn phí vận chuyển -->
            <div class="group">
                <div
                    class="flex flex-col items-center justify-center space-y-3 p-4 rounded-lg transition-all duration-300 group-hover:scale-105 group-hover:shadow-xl">
                    <i class="fas fa-truck text-3xl text-rose-500 group-hover:text-rose-600"></i>
                    <p class="text-gray-800 font-medium text-sm">Vận chuyển</p>
                </div>
            </div>

            <!-- 3. Thanh toán linh hoạt -->
            <div class="group">
                <div
                    class="flex flex-col items-center justify-center space-y-3 p-4 rounded-lg transition-all duration-300 group-hover:scale-105 group-hover:shadow-xl">
                    <i class="fas fa-credit-card text-3xl text-rose-500 group-hover:text-rose-600"></i>
                    <p class="text-gray-800 font-medium text-sm">Thanh toán COD, Online</p>
                </div>
            </div>

            <!-- 4. Quà tặng thành viên -->
            <div class="group">
                <div
                    class="flex flex-col items-center justify-center space-y-3 p-4 rounded-lg transition-all duration-300 group-hover:scale-105 group-hover:shadow-xl">
                    <i class="fas fa-gift text-3xl text-rose-500 group-hover:text-rose-600"></i>
                    <p class="text-gray-800 font-medium text-sm">Quà tặng thành viên</p>
                </div>
            </div>

            <!-- 5. Bảo hành & chăm sóc -->
            <div class="group">
                <div
                    class="flex flex-col items-center justify-center space-y-3 p-4 rounded-lg transition-all duration-300 group-hover:scale-105 group-hover:shadow-xl">
                    <i class="fas fa-shield-heart text-3xl text-rose-500 group-hover:text-rose-600"></i>
                    <p class="text-gray-800 font-medium text-sm">Bảo hành & chăm sóc</p>
                </div>
            </div>
        </div>


    </div>
    </div>
</section>


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
                    <li><a href="/gioi-thieu" class="hover:text-rose-500 active:text-rose-600">Giới thiệu</a></li>
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
                    <li><a href="/lien-he" class="hover:text-rose-500 active:text-rose-600">Liên hệ</a></li>
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
                    <li><a href="{{ route('login') }}" class="hover:text-rose-500 active:text-rose-600">Đăng nhập</a>
                    </li>
                    <li><a href="{{ route('register') }}" class="hover:text-rose-500 active:text-rose-600">Đăng ký</a>
                    </li>
                    <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Cài đặt tài khoản</a></li>
                    <li><a href="#" class="hover:text-rose-500 active:text-rose-600">Đơn hàng của tôi</a></li>
                    <li><a href="{{ route('dashboard') }}" class="hover:text-rose-500 active:text-rose-600">Quản trị viên</a>
                    </li>
                </ul>
            </div>
            <div>
                <h6 class="font-semibold mb-2">Mạng xã hội</h6>
                <ul class="space-y-2">
                    <li><a href="#" class="flex items-center space-x-2 hover:text-rose-500 active:text-rose-600">
                            <i class="fab fa-facebook"></i> <span>Facebook</span>
                        </a></li>
                    <li><a href="#" class="flex items-center space-x-2 hover:text-rose-500 active:text-rose-600">
                            <i class="fab fa-twitter"></i> <span>Twitter</span>
                        </a></li>
                    <li><a href="#" class="flex items-center space-x-2 hover:text-rose-500 active:text-rose-600">
                            <i class="fab fa-instagram"></i> <span>Instagram</span>
                        </a></li>
                    <li><a href="#" class="flex items-center space-x-2 hover:text-rose-500 active:text-rose-600">
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
