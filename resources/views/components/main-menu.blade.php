    <nav class="flex items-center px-8 w-full">
        <ul class="flex items-center space-x-6">
            {{-- Trang Chủ --}}
            <li>
                <a href="{{ route('site.home') }}"
                    class="inline-block text-gray-700 hover:text-rose-500 transform hover:scale-110 transition duration-300 ease-in-out">
                    Trang Chủ
                </a>
            </li>

            <li>
                <a href="{{ route('site.about') }}"
                    class="inline-block text-gray-700 hover:text-rose-500 transform hover:scale-110 transition duration-300 ease-in-out">
                    Giới Thiệu
                </a>
            </li>

            {{-- Dropdown Menu --}}
            <li class="relative group">
                <button
                    class="inline-block text-gray-700 hover:text-rose-500 transform hover:scale-110 transition duration-300 ease-in-out cursor-pointer">
                    Menu
                </button>
                <ul
                    class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 overflow-hidden">
                    @foreach ($menu_list as $menu_item)
                        <li>
                            <x-main-menu-item :menuitem="$menu_item"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-rose-100 hover:text-rose-500 transform hover:scale-105 transition duration-200 ease-in-out">
                            </x-main-menu-item>
                        </li>
                    @endforeach
                </ul>
            </li>

            {{-- Bài Viết --}}
            <li>
                <a href="{{ route('site.post') }}"
                    class="inline-block text-gray-700 hover:text-rose-500 transform hover:scale-110 transition duration-300 ease-in-out">
                    Bài Viết
                </a>
            </li>

            {{-- Liên Hệ --}}
            <li>
                <a href="{{ route('site.contact') }}"
                    class="inline-block text-gray-700 hover:text-rose-500 transform hover:scale-110 transition duration-300 ease-in-out">
                    Liên Hệ
                </a>
            </li>

            {{-- Sản Phẩm --}}
            <li>
                <a href="{{ route('site.product') }}"
                    class="inline-block text-gray-700 hover:text-rose-500 transform hover:scale-110 transition duration-300 ease-in-out">
                    Sản Phẩm
                </a>
            </li>
            {{-- Danh Mục --}}
            <li class="relative group">
                <div
                    class="inline-block text-gray-700 hover:text-rose-500 transform hover:scale-110 transition duration-300 ease-in-out focus:outline-none cursor-pointer">
                    Danh Mục
                </div>
                <ul
                    class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-300 z-50">
                    @foreach ($category_list as $category)
                        <li>
                            <a href="{{ route('site.product.category', ['category_slug' => $category->slug]) }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-rose-100 hover:text-rose-500 transition">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
            {{-- Thương Hiệu --}}
            <li class="relative group">
                <button
                    class="inline-block text-gray-700 hover:text-rose-500 transform hover:scale-110 transition duration-300 ease-in-out focus:outline-none">
                    Thương Hiệu
                </button>
                <ul
                    class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-300 z-50">
                    @foreach ($brand_list as $brand)
                        <li>
                            <a href="{{ route('site.product.brand', ['brand_slug' => $brand->slug]) }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-rose-100 hover:text-rose-500 transition">
                                {{ $brand->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>

        <!-- Phần bên phải: Tìm kiếm, giỏ hàng, tài khoản -->
        <div class="flex items-center space-x-6 ml-auto">
            <!-- Tìm kiếm -->
            <div class="relative w-60">
                <form action="{{ route('site.product') }}" method="GET" class="relative">
                    <input id="search-ajax" type="text" name="keyword" placeholder="Tìm kiếm..."
                        value="{{ request('keyword') }}"
                        class="w-full border-2 border-rose-500 rounded-full pl-12 pr-4 py-2 text-gray-700
                   focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-600 transition duration-300" />

                    <button type="submit" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-rose-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m2.5-5.5a7 7 0 1 1-10-10 7 7 0 0 1 10 10z" />
                        </svg>
                    </button>
                </form>

                <!-- Dropdown kết quả gợi ý -->
                <div id="search-results"
                    class="absolute top-12 left-0 w-full bg-white shadow-lg rounded-lg z-50 hidden">
                </div>
            </div>

            <!-- Giỏ hàng -->
            <a href="{{ route('site.cart.index') }}" class="relative flex items-center justify-center w-12 h-12">
                <svg class="w-8 h-8 text-white bg-gradient-to-r from-green-400 via-teal-500 to-blue-500 p-1 rounded-full hover:scale-110 transform transition-all duration-300 ease-in-out shadow-lg"
                    xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 3h18l-1.5 9a2 2 0 0 1-2 1.5H6.5a2 2 0 0 1-2-1.5L3 3z" />
                    <circle cx="9" cy="18" r="2" class="fill-gradient" />
                    <circle cx="15" cy="18" r="2" class="fill-gradient" />
                </svg>
                <span
                    class="absolute -top-1 -right-2 bg-rose-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full cart-count shadow-lg">
                    {{ session('cart') ? count(session('cart')) : 0 }}
                </span>
            </a>

            @if (Auth::check())
                <div class="relative" title="Tài khoản" id="user-menu-container">
                    <!-- Profile Card -->
                    <button onclick="toggleDropdown()" id="user-menu-button"
                        class="flex items-center gap-3 px-4 py-2 bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition duration-300 focus:outline-none cursor-pointer">

                        <!-- Avatar -->
                        <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-rose-400 shadow-sm">
                            @if (Auth::user()->avatar)
                                <img src="{{ asset('assets/images/user/' . Auth::user()->avatar) }}" alt="Avatar"
                                    class="w-full h-full object-cover" />
                            @else
                                <div
                                    class="flex items-center justify-center w-full h-full bg-gradient-to-br from-yellow-50 to-white text-rose-500">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5.5 20a8.5 8.5 0 1 1 13 0M16 7a4 4 0 1 1-8 0" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="text-left">
                            <p class="text-sm font-semibold text-rose-500 leading-tight">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400 italic">Tài khoản thành viên</p>
                        </div>
                    </button>
                    <!-- Dropdown tài khoản -->
                    <div id="dropdown"
                        class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-200 hidden z-50 transition duration-200 ease-in-out">

                        <!-- Item: Thông tin tài khoản -->
                        <a href="{{ route('user.profile') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-black hover:text-rose-500 hover:bg-blue-50 transition-colors duration-150 rounded-t-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Thông tin tài khoản</span>
                        </a>
                        <!-- Giỏ hàng của tôi -->
                        <a href="{{ route('site.cart.index') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 7h11L17 13M9 21a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z" />
                            </svg>
                            <span>Giỏ hàng của tôi</span>
                        </a>
                        <!-- Lịch sử đơn hàng -->
                        <a href="{{ route('order.history') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-yellow-500 hover:bg-blue-50 transition-colors duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 17v-2a4 4 0 014-4h5m-2-2l3 3-3 3M3 3h18" />
                            </svg>
                            <span>Lịch sử đơn hàng</span>
                        </a>

                        <!-- Item: Đăng xuất -->
                        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="flex items-center gap-3 w-full px-4 py-3 text-sm text-black hover:text-teal-500 hover:bg-blue-50 transition-colors duration-150 rounded-b-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Đăng xuất</span>
                        </button>
                    </div>
                    <!-- Logout form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf
                    </form>
                </div>
            @else
                <!-- Nếu chưa đăng nhập -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('login') }}"
                        class="text-gray-700 hover:text-rose-500 font-semibold transition relative group">
                        Đăng Nhập
                        <span
                            class="absolute left-0 bottom-0 w-full h-0.5 bg-rose-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 rounded-full"></span>
                    </a>
                    <span class="text-gray-400">/</span>
                    <a href="{{ route('register') }}"
                        class="text-white bg-rose-500 px-4 py-1.5 rounded-full hover:bg-rose-600 transition">
                        Đăng Ký
                    </a>
                </div>
            @endif
        </div>
    </nav>

    <script>
        // Toggle dropdown user
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown');
            dropdown.classList.toggle('hidden');
        }

        // Đóng dropdown khi click ngoài
        window.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdown');
            const userMenuButton = document.getElementById('user-menu-button');

            if (!dropdown.classList.contains('hidden') &&
                !dropdown.contains(event.target) &&
                !userMenuButton.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

    <script>
        // Tìm kiếm sản phẩm
        document.getElementById("search").addEventListener("keyup", function() {
            let keyword = this.value;

            fetch(`/products/search?keyword=${keyword}`)
                .then(res => res.text())
                .then(data => {
                    let productList = document.getElementById("product-list");
                    productList.innerHTML = data.trim();

                    // Nếu rỗng thì hiện thông báo với từ khóa
                    if (productList.innerHTML.trim() === "") {
                        productList.innerHTML = `
                        <div class="col-span-3 text-center text-gray-500 py-10">
                            Không tìm thấy sản phẩm nào phù hợp với từ khóa "${keyword}"
                        </div>
                    `;
                    }
                });
        });
    </script>


    <script>
        // Tìm kiếm ajax gợi ý
        document.addEventListener("DOMContentLoaded", function() {
            let searchInput = document.getElementById("search-ajax");
            let resultsDiv = document.getElementById("search-results");

            searchInput.addEventListener("keyup", function() {
                let keyword = this.value;

                if (keyword.length < 2) {
                    resultsDiv.classList.add("hidden");
                    return;
                }

                fetch(`/ajax/search?keyword=${keyword}`)
                    .then(res => res.json())
                    .then(data => {
                        resultsDiv.innerHTML = "";

                        if (data.length > 0) {
                            data.forEach(p => {
                                resultsDiv.innerHTML += `
                                <a href="/san-pham/${p.slug}"
                                   class="block px-4 py-2 hover:bg-rose-100 transition">
                                    ${p.name}
                                </a>`;
                            });
                            resultsDiv.classList.remove("hidden");
                        } else {
                            resultsDiv.innerHTML =
                                `<div class="px-4 py-2 text-gray-500">Không có sản phẩm</div>`;
                            resultsDiv.classList.remove("hidden");
                        }
                    });
            });

            // Ẩn dropdown khi click ra ngoài
            document.addEventListener("click", function(e) {
                if (!resultsDiv.contains(e.target) && e.target !== searchInput) {
                    resultsDiv.classList.add("hidden");
                }
            });
        });
    </script>
