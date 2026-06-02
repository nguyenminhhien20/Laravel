<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Đăng ký Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            /* Gradient background with rose/pink tones */
            background: linear-gradient(135deg, #fef2f2 0%, #fdeff0 100%); /* Very light pink to light reddish pink */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2.5rem 1rem;
            position: relative;
            overflow: hidden;
        }

        /* Abstract background shapes - bigger, bolder, and animated */
        body::before,
        body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            opacity: 0.6;
            filter: blur(80px);
            z-index: -1;
        }

        body::before {
            width: 500px;
            height: 500px;
            background: linear-gradient(45deg, #fecaca, #fda4af); /* Light red to lighter rose */
            top: -100px;
            left: -150px;
            animation: moveBlob1 25s infinite alternate ease-in-out;
        }

        body::after {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #fbcfe8, #f0abfc); /* Light pink to light purple */
            bottom: -80px;
            right: -100px;
            animation: moveBlob2 20s infinite alternate ease-in-out;
        }

        @keyframes moveBlob1 {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(50px, 80px) scale(1.05); }
            100% { transform: translate(0, 0) scale(1); }
        }

        @keyframes moveBlob2 {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-70px, -60px) scale(1.1); }
            100% { transform: translate(0, 0) scale(1); }
        }

        h1,
        button {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
        }

        /* Card entry animation - Adjusted for one-time appearance, then remains visible */
        .fade-in-on-load {
            animation: fadeInOnce 1.5s ease-out forwards; /* Longer, smoother fade in */
            opacity: 0; /* Start hidden */
            transform: translateY(20px); /* Start slightly below */
        }
        @keyframes fadeInOnce {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom focus ring for inputs: Rose tone */
        .input-focus:focus {
            outline: none;
            border-color: #f472b6; /* Rose-400 */
            box-shadow: 0 0 0 4px rgba(244, 114, 182, 0.25); /* Soft, wide glow */
        }

        /* Button hover effect: subtle 3D press + light scale */
        .btn-fancy-hover:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        .btn-fancy-hover:active {
            transform: translateY(0) scale(1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="fade-in-on-load bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 sm:p-10 relative overflow-hidden transform transition-all duration-300 ease-in-out hover:shadow-3xl z-10 border border-gray-50">
        <div class="absolute top-0 right-0 p-4 text-rose-400">
            <svg class="w-8 h-8 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                <path d="M2 17l10 5 10-5"></path>
                <path d="M2 12l10 5 10-5"></path>
            </svg>
        </div>


        <h1 class="text-4xl text-center text-gray-800 mb-10 tracking-wide relative z-20">Đăng ký Tài khoản</h1>

        @if (session('error'))
            <div class="mb-7 p-4 text-red-700 bg-red-50 rounded-lg font-medium text-center border border-red-200 relative z-20 animate-pulse">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.register.post') }}" class="space-y-6 relative z-20">
            @csrf

            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Họ và tên</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="input-focus w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-400 transition-colors duration-200"
                    placeholder="Nguyễn Văn A"
                />
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="input-focus w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-400 transition-colors duration-200"
                    placeholder="email@example.com"
                />
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-700">Số điện thoại</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    value="{{ old('phone') }}"
                    required
                    class="input-focus w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-400 transition-colors duration-200"
                    placeholder="0123456789"
                    pattern="0([0-9]{9,10})"
                    title="Vui lòng nhập số điện thoại hợp lệ (bắt đầu bằng 0, 10 hoặc 11 chữ số)"
                />
                @error('phone')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Mật khẩu</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="input-focus w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-400 transition-colors duration-200"
                    placeholder="••••••••"
                />
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700">Xác nhận mật khẩu</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    class="input-focus w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-400 transition-colors duration-200"
                    placeholder="••••••••"
                />
            </div>

            <button
                type="submit"
                class="btn-fancy-hover w-full bg-rose-500 hover:bg-rose-600 active:bg-rose-700 rounded-lg py-3.5 text-white text-lg font-bold shadow-md transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-rose-400 focus:ring-opacity-50"
            >
                Đăng ký
            </button>
        </form>

        <p class="text-center text-gray-600 mt-8 text-sm">
            Bạn đã có tài khoản?
            <a href="{{ route('admin.login') }}" class="text-rose-600 hover:underline font-semibold transition-colors duration-200">Đăng nhập ngay</a>
        </p>
    </div>

</body>

</html>
