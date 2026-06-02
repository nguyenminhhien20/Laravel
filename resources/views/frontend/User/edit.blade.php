<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chỉnh Sửa Thông Tin - TyuuMei</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-50 flex flex-col min-h-screen font-sans">

    <!-- Navbar -->
    <header class="bg-white shadow-md px-6 py-4">
        <div class="flex justify-between items-center">
            <a href="{{ route('site.home') }}" class="flex items-center gap-2">
                <img src="{{ asset('build/assets/images/logo1.jpg') }}" alt="Logo" class="h-12 w-12 rounded-full object-cover">
                <span class="text-2xl font-extrabold text-gray-600">
                    Tyuu<span class="text-rose-500">Mei</span>
                </span>
            </a>
            <x-main-menu />
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <section class="container mx-auto px-6 py-12">
            <h1 class="text-3xl sm:text-4xl font-bold text-center text-teal-500 mb-10 hover:text-rose-500 transition duration-300">
                🛠️ Chỉnh Sửa Thông Tin Cá Nhân
            </h1>

            <div class="bg-white p-8 sm:p-10 shadow-md rounded-xl max-w-3xl mx-auto">

                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-md border border-green-300">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-md border border-red-300">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

              <form action="{{ route('frontend.user.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-gray-700 font-medium mb-1">Họ và tên</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" />
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" />
                    </div>

                    <div>
                        <label for="phone" class="block text-gray-700 font-medium mb-1">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" />
                    </div>

                    <div>
                        <label for="address" class="block text-gray-700 font-medium mb-1">Địa chỉ</label>
                        <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" />
                    </div>

                    <div>
                        <label for="avatar" class="block text-gray-700 font-medium mb-1">Ảnh đại diện</label>
                        <input type="file" name="avatar" id="avatar"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" />
                        @if ($user->avatar)
                            <img src="{{ asset('assets/images/user/' . $user->avatar) }}" alt="Avatar"
                                class="mt-3 w-20 h-20 rounded-full object-cover border border-gray-300 shadow" />
                        @endif
                    </div>

                    <div class="flex justify-center gap-4 pt-4">
                        <button type="submit"
                            class="bg-teal-500 hover:bg-rose-500 text-white font-semibold py-2 px-6 rounded-lg transition">
                            Cập nhật
                        </button>
                        <a href="{{ route('user.profile') }}"
                            class="text-gray-500 hover:text-teal-500 font-medium py-2 px-6 rounded-lg transition">
                            ← Quay lại
                        </a>
                    </div>
                </form>

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
