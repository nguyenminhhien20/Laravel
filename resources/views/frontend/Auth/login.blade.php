<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - TyuuMei</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1522920194561-1b1d20160e7c?auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(4px);
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px);
        }

        .btn-rose {
            background: linear-gradient(90deg, #f43f5e, #ec4899);
        }

        .btn-rose:hover {
            background: linear-gradient(90deg, #ec4899, #f43f5e);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">

    <!-- Header -->
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

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center px-4 py-16 relative">
        <div class="absolute inset-0 overflow-hidden z-0 pointer-events-none">
            <div
                class="absolute top-1/4 left-[10%] w-64 h-64 bg-gradient-to-br from-rose-300 to-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob">
            </div>
            <div
                class="absolute bottom-1/4 right-[15%] w-72 h-72 bg-gradient-to-tr from-pink-300 to-red-300 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000">
            </div>
        </div>
        <style>
            /* Keyframes cho các blob nền */
            @keyframes blob {
                0% {
                    transform: translate(0px, 0px) scale(1);
                }

                33% {
                    transform: translate(30px, -50px) scale(1.1);
                }

                66% {
                    transform: translate(-20px, 20px) scale(0.9);
                }

                100% {
                    transform: translate(0px, 0px) scale(1);
                }
            }

            .animate-blob {
                animation: blob 7s infinite;
            }

            .animation-delay-2000 {
                animation-delay: 2s;
            }

            /* Để các blob di chuyển lệch pha */

            /* Nâng cấp hiệu ứng Glassmorphism cho thẻ */
            .glass-fancy {
                background: rgba(255, 255, 255, 0.08);
                /* Trong suốt và mờ hơn */
                backdrop-filter: blur(30px) saturate(180%);
                /* Tăng cường blur và độ bão hòa */
                border: 1px solid rgba(255, 255, 255, 0.2);
                /* Viền sáng hơn */
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
                /* Bóng đổ sâu hơn */
                /* Thêm hiệu ứng phát sáng nhẹ khi hover (optional, có thể bỏ nếu không thích) */
                transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }

            .glass-fancy:hover {
                box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5), 0 0 30px rgba(255, 105, 180, 0.3);
                /* Thêm bóng đổ màu hồng */
            }

            /* Nút với gradient động và hiệu ứng 3D */
            .btn-gradient-glow {
                background: linear-gradient(90deg, #ec4899 0%, #f43f5e 100%);
                /* Pink-500 to Rose-500 */
                transition: all 0.4s ease;
                box-shadow: 0 5px 20px rgba(244, 63, 94, 0.5);
                /* Bóng đổ mạnh hơn */
                position: relative;
                z-index: 1;
                /* Đảm bảo nút nằm trên hiệu ứng glow */
            }

            .btn-gradient-glow::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(90deg, #f43f5e 0%, #ec4899 100%);
                /* Gradient đảo ngược cho hiệu ứng glow */
                border-radius: inherit;
                filter: blur(15px);
                /* Làm mờ để tạo glow */
                opacity: 0;
                transition: opacity 0.4s ease;
                z-index: -1;
            }

            .btn-gradient-glow:hover {
                transform: translateY(-3px) scale(1.02);
                box-shadow: 0 10px 30px rgba(244, 63, 94, 0.7);
            }

            .btn-gradient-glow:hover::before {
                opacity: 0.8;
                /* Hiển thị glow khi hover */
            }

            .btn-gradient-glow:active {
                transform: translateY(0);
                box-shadow: 0 2px 10px rgba(244, 63, 94, 0.3);
            }

            /* Input focus phát sáng hơn */
            .input-glow:focus {
                outline: none;
                border-color: #f43f5e;
                /* Rose-500 */
                box-shadow: 0 0 0 4px rgba(244, 63, 94, 0.4), 0 0 15px rgba(244, 63, 94, 0.3);
                /* Vòng sáng và glow mạnh hơn */
                background-color: rgba(255, 255, 255, 0.8);
                /* Ít trong suốt hơn khi focus để dễ đọc */
            }

            /* Icon user với hiệu ứng lung linh */
            .user-icon-sparkle {
                animation: sparklePulse 2s infinite ease-in-out;
                text-shadow: 0 0 8px rgba(255, 255, 255, 0.8);
                /* Thêm hiệu ứng sáng cho icon */
            }

            @keyframes sparklePulse {
                0% {
                    transform: scale(1) rotate(0deg);
                    opacity: 1;
                }

                50% {
                    transform: scale(1.1) rotate(5deg);
                    opacity: 0.9;
                }

                100% {
                    transform: scale(1) rotate(0deg);
                    opacity: 1;
                }
            }
        </style>

        <div class="glass-fancy max-w-md w-full rounded-3xl p-8 sm:p-10 space-y-7 relative z-10 overflow-hidden">
            <div
                class="absolute top-0 left-0 w-32 h-32 bg-gradient-to-br from-white/30 to-transparent rounded-full -translate-x-1/2 -translate-y-1/2 opacity-70">
            </div>
            <div
                class="absolute bottom-0 right-0 w-24 h-24 bg-gradient-to-tl from-white/20 to-transparent rounded-full translate-x-1/2 translate-y-1/2 opacity-60">
            </div>


            <div class="text-center relative z-10">
                <div
                    class="w-28 h-28 bg-gradient-to-br from-rose-500 to-pink-600 rounded-full flex items-center justify-center shadow-2xl mx-auto mb-6 border-4 border-white border-opacity-30 transform hover:scale-105 transition-transform duration-300">
                    <i class="fas fa-user text-white text-5xl user-icon-sparkle"></i>
                </div>
                <h2
                    class="text-4xl font-extrabold text-gray-800 font-['Playfair_Display'] tracking-wider leading-tight">
                    Đăng Nhập</h2>
                <p class="text-base text-gray-600 mt-2 font-medium">Chào mừng bạn quay trở lại <span
                        class="text-rose-600 font-semibold">TyuuMei</span>!</p>
            </div>

            <form action="{{ url('/login') }}" method="POST" class="space-y-6 relative z-10">
                @csrf
                <!-- Thông báo lỗi chung (bỏ trống) -->
                @if ($errors->has('login'))
                    <div class="text-red-500 text-sm mb-2 text-center font-medium">
                        {{ $errors->first('login') }}
                    </div>
                @endif

                <!-- Thông báo lỗi email/password sai -->
                @error('email')
                    <div class="text-red-500 text-sm mb-2 text-center font-medium">{{ $message }}</div>
                @enderror

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" autocomplete="email" value="{{ old('email') }}"
                        class="input-glow w-full px-5 py-3 border border-gray-300 rounded-xl bg-white/70 text-gray-900 placeholder-gray-500 shadow-md transition-all duration-300">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu</label>
                    <input type="password" id="password" name="password" autocomplete="current-password"
                        class="input-glow w-full px-5 py-3 border border-gray-300 rounded-xl bg-white/70 text-gray-900 placeholder-gray-500 shadow-md transition-all duration-300">
                    <div class="text-right mt-2">
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-rose-600 hover:underline font-semibold transition-colors duration-200">Quên
                            mật khẩu?</a>
                    </div>
                </div>

                <button type="submit"
                    class="w-full btn-gradient-glow text-white px-8 py-3.5 rounded-full font-bold text-lg uppercase tracking-wide flex items-center justify-center space-x-2">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Đăng Nhập</span>
                </button>
            </form>

            <div
                class="text-center text-sm text-gray-600 relative z-10 pt-4 border-t border-gray-200 border-opacity-50">
                Chưa có tài khoản?
                <a href="/register" class="text-rose-600 hover:underline font-semibold">Đăng ký ngay</a>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer class="bg-gray-100 text-gray-600 py-6">
        <div class="max-w-7xl mx-auto text-center space-y-2">
            <p class="text-sm">© 2025 TyuuMei. Mọi quyền được bảo lưu.</p>
            <div class="flex justify-center space-x-4">
                <a href="#" class="hover:text-rose-500"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-rose-500"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-rose-500"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

</body>

</html>
