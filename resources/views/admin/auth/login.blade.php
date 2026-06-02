<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Đăng nhập quản trị</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet" />

  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
      /* Background gradient: Soft, warm grey to very light pink */
      background: linear-gradient(135deg, #f7f3ed 0%, #fef0f6 100%);
    }
    h1, button {
      font-family: 'Poppins', sans-serif;
    }
    /* Fade-in animation for the card */
    .fade-in {
      animation: fadeInUp 1s ease-out forwards;
      opacity: 0;
      transform: translateY(30px);
    }
    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    /* Custom focus ring for inputs - matching rose accent color */
    .input-focus:focus {
      outline: none;
      box-shadow: 0 0 0 3px rgba(244, 114, 182, 0.2); /* Soft rose */
      border-color: #f472b6; /* Stronger rose */
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-12">

  <div class="fade-in bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 sm:p-10 transform transition-all duration-400 ease-in-out hover:shadow-3xl hover:-translate-y-2 relative overflow-hidden">
    <div class="absolute -top-10 -right-10 w-48 h-48 bg-rose-50 rounded-full opacity-40 transform rotate-45"></div>
    <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-pink-50 rounded-full opacity-40 transform -rotate-30"></div>

    <h1 class="text-4xl font-bold text-center text-gray-800 mb-10 tracking-tight relative z-10">Đăng nhập Admin</h1>

    @if(session('error'))
      <div class="mb-7 p-4 text-red-700 bg-red-50 rounded-xl font-medium text-center border border-red-200 shadow-sm relative z-10 animate-pulse">
        {{ session('error') }}
      </div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-7 relative z-10">
      @csrf

      <div>
        <label for="email" class="block mb-2 font-medium text-gray-700 text-sm">Email</label>
        <div class="relative">
          <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
            autofocus
            placeholder="Địa chỉ email của bạn"
            class="input-focus w-full rounded-xl border border-gray-300 pl-12 pr-4 py-3 text-gray-800 placeholder-gray-400 transition-all duration-200"
          />
          <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16v16H4z"></path>
            <path d="M4 4l8 8m0 0l8-8m-8 8v12"></path>
          </svg>
        </div>
        @error('email')
          <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="password" class="block mb-2 font-medium text-gray-700 text-sm">Mật khẩu</label>
        <div class="relative">
          <input
            id="password"
            type="password"
            name="password"
            required
            placeholder="••••••••"
            class="input-focus w-full rounded-xl border border-gray-300 pl-12 pr-4 py-3 text-gray-800 placeholder-gray-400 transition-all duration-200"
          />
          <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
        </div>
        @error('password')
          <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex items-center justify-between mt-7">
        <label class="inline-flex items-center text-gray-700 select-none cursor-pointer">
          <input type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-rose-500 rounded focus:ring-rose-400 transition duration-150 ease-in-out" />
          <span class="ml-2 font-medium text-sm">Ghi nhớ đăng nhập</span>
        </label>

        <a href="#" class="text-sm font-medium text-rose-600 hover:text-rose-700 hover:underline transition-colors duration-200">Quên mật khẩu?</a>
      </div>

      <button
        type="submit"
        class="w-full mt-9 py-3 bg-rose-600 hover:bg-rose-700 active:bg-rose-800 rounded-xl text-white text-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-opacity-50"
      >
        Đăng nhập
      </button>

      <p class="text-center text-sm text-gray-600 mt-8">
        Chưa có tài khoản?
        <a href="{{ route('admin.register') }}" class="text-rose-600 hover:text-rose-700 hover:underline font-semibold transition-colors duration-200">
          Đăng ký ngay
        </a>
      </p>
    </form>
  </div>

</body>
</html>
