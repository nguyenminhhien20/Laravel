<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $header ?? 'Quản Lý' }}</title>
</head>

@php
    $isProductMenu =
        request()->routeIs('product.*') || request()->routeIs('category.*') || request()->routeIs('brand.*');
    $isPostMenu = request()->routeIs('post.*') || request()->routeIs('topic.*');
    $isInterfaceMenu = request()->routeIs('menu.*') || request()->routeIs('banner.*');
@endphp

<body class="bg-gray-100 font-sans text-gray-800">
    <!-- Header -->
    <header class="bg-gray-700 text-white shadow-md">
        <div class="flex justify-between items-center px-6 h-16">
            <a href="{{ route('dashboard') }}"
                class="text-3xl font-extrabold tracking-tight text-gray-800 hover:text-blue-600 transition duration-200">
                Admin
            </a>
            <div class="space-x-6 flex items-center text-gray-300">
                <a href="#" class="flex items-center hover:text-rose-400 transition duration-300">
                    <i class="fa fa-user mr-2"></i>{{ Auth::user()->name ?? 'Admin' }}
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center hover:text-rose-400 transition duration-300">
                        <i class="fa fa-power-off mr-2"></i>Đăng xuất
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-72 bg-white shadow-lg border-r py-4 space-y-3">

            <!-- Quản lý sản phẩm -->
            <div>
                <div class="flex items-center p-4 rounded-md hover:bg-rose-600 cursor-pointer transition text-gray-700 font-semibold"
                    onclick="toggleMenu('productMenu', 'productIcon')">
                    <i class="fa fa-box mr-4 text-rose-600 text-lg"></i> Quản lý sản phẩm
                    <i id="productIcon"
                        class="fa fa-chevron-down ml-auto transition-transform {{ $isProductMenu ? 'rotate-180' : '' }}"></i>
                </div>
                <ul id="productMenu"
                    class="ml-8 mt-2 space-y-1 text-sm text-gray-700 {{ $isProductMenu ? '' : 'hidden' }}">
                    <li>
                        <a href="{{ route('product.index') }}"
                            class="block px-3 py-2 rounded transition {{ request()->routeIs('product.*') ? 'bg-rose-500 text-white' : 'hover:bg-rose-500 hover:text-white' }}">
                            Sản phẩm
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('category.index') }}"
                            class="block px-3 py-2 rounded transition {{ request()->routeIs('category.*') ? 'bg-rose-500 text-white' : 'hover:bg-rose-500 hover:text-white' }}">
                            Danh mục
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('brand.index') }}"
                            class="block px-3 py-2 rounded transition {{ request()->routeIs('brand.*') ? 'bg-rose-500 text-white' : 'hover:bg-rose-500 hover:text-white' }}">
                            Thương hiệu
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Quản lý bài viết -->
            <div>
                <div class="flex items-center p-4 rounded-md hover:bg-blue-600 cursor-pointer transition text-gray-700 font-semibold"
                    onclick="toggleMenu('postMenu', 'postIcon')">
                    <i class="fa fa-newspaper mr-4 text-blue-600 text-lg"></i> Quản lý bài viết
                    <i id="postIcon"
                        class="fa fa-chevron-down ml-auto transition-transform {{ $isPostMenu ? 'rotate-180' : '' }}"></i>
                </div>
                <ul id="postMenu" class="ml-8 mt-2 space-y-1 text-sm text-gray-700 {{ $isPostMenu ? '' : 'hidden' }}">
                    <li>
                        <a href="{{ route('post.index') }}"
                            class="block px-3 py-2 rounded transition {{ request()->routeIs('post.*') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500 hover:text-white' }}">
                            Bài viết
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('topic.index') }}"
                            class="block px-3 py-2 rounded transition {{ request()->routeIs('topic.*') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500 hover:text-white' }}">
                            Chủ đề
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Giao diện -->
            <div>
                <div class="flex items-center p-4 rounded-md hover:bg-purple-600 cursor-pointer transition text-gray-700 font-semibold"
                    onclick="toggleMenu('interfaceMenu', 'interfaceIcon')">
                    <i class="fa fa-paint-brush mr-4 text-purple-600 text-lg"></i> Giao diện
                    <i id="interfaceIcon"
                        class="fa fa-chevron-down ml-auto transition-transform {{ $isInterfaceMenu ? 'rotate-180' : '' }}"></i>
                </div>
                <ul id="interfaceMenu"
                    class="ml-8 mt-2 space-y-1 text-sm text-gray-700 {{ $isInterfaceMenu ? '' : 'hidden' }}">
                    <li>
                        <a href="{{ route('menu.index') }}"
                            class="block px-3 py-2 rounded transition {{ request()->routeIs('menu.*') ? 'bg-purple-500 text-white' : 'hover:bg-purple-500 hover:text-white' }}">
                            Menu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('banner.index') }}"
                            class="block px-3 py-2 rounded transition {{ request()->routeIs('banner.*') ? 'bg-purple-500 text-white' : 'hover:bg-purple-500 hover:text-white' }}">
                            Banner
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Các mục khác -->
           <a href="{{ route('order.index') }}"
                class="flex items-center p-4 rounded-md hover:bg-teal-600 text-gray-700 transition font-semibold">
                <i class="fa fa-file-invoice mr-4 text-teal-600 text-lg"></i> Đơn hàng
            </a>
            <a href="{{ route('contact.index') }}"
                class="flex items-center p-4 rounded-md hover:bg-red-600 text-gray-700 transition font-semibold">
                <i class="fa fa-envelope mr-4 text-red-600 text-lg"></i> Liên Hệ
            </a>
            <a href="{{ route('user.index') }}"
                class="flex items-center p-4 rounded-md hover:bg-indigo-600 text-gray-700 transition font-semibold">
                <i class="fa fa-users mr-4 text-indigo-600 text-lg"></i> Khách hàng
            </a>
            <a href="{{ route('admin.shipping.create', 1) }}"
                class="flex items-center p-4 rounded-md hover:bg-green-600 text-gray-700 transition font-semibold">
                <i class="fa fa-truck mr-4 text-green-600 text-lg"></i> Vận chuyển
            </a>
        </aside>

        <!-- Content -->
        <section class="flex-1 p-6 bg-gray-50">
            {{ $slot }}
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 border-t-4 border-rose-500">
        Design: Nguyễn Minh Hiền
    </footer>

    {{ $footer ?? '' }}
    @include('backend.notifications')

    <!-- JavaScript for Sidebar Toggle -->
    <script>
        function toggleMenu(menuId, iconId) {
            const menu = document.getElementById(menuId);
            const icon = document.getElementById(iconId);
            menu.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }
    </script>

</body>

</html>
