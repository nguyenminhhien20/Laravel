<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TyuuMei</title>
    <!-- Chỉnh sửa để load đúng Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-white">
    <!-- Navbar -->
    <header class="bg-white shadow-md px-6">
        <div class="flex justify-between items-center py-4 w-full">
            <!-- Logo + Brand -->
            <a href="{{ route('site.home') }}">
                <img src="/build/assets/images/logo1.jpg" alt="Logo" class="h-12 w-12 rounded-full object-cover">
            </a>
            <span class="text-2xl font-extrabold text-gray-600">
                Tyuu<span class="text-rose-500">Mei</span>
            </span>
            <!-- Main Menu -->
            <x-main-menu />
        </div>
    </header>
    {{-- <x-slider/> --}}

    <section class="page-product-detail py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

                <!-- Left Column: Ảnh + Social -->
                <div class="space-y-6">
                    <img src="{{ asset('assets/images/product/' . $product->thumbnail) }}" alt="{{ $product->name }}"
                        class="w-[500px] mx-auto rounded-xl shadow-lg object-cover" />
                    <div class="flex justify-center space-x-4">
                        @foreach (['facebook-f', 'twitter', 'instagram'] as $icon)
                            <a href="#"
                                class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-full text-gray-600 hover:bg-rose-100 hover:text-rose-500 transition">
                                <i class="fab fa-{{ $icon }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Right Column: Thông tin chi tiết -->
                <div class="space-y-6">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
                    <p class="text-gray-600">Thương hiệu: {{ $product->brand->name ?? 'N/A' }}</p>
                    <p class="text-gray-600">Danh mục: {{ $product->category->name ?? 'N/A' }}</p>
                    <p class="text-gray-600">Mô tả: {{ $product->description ?? 'N/A' }}</p>


                    <div class="text-2xl font-extrabold">
                        @if ($product->pricesale > 0 && $product->pricesale < $product->price_root)
                            <span class="text-red-600">{{ number_format($product->pricesale) }}₫</span>
                            <span
                                class="text-gray-500 line-through ml-2">{{ number_format($product->price_root) }}₫</span>
                            <span class="text-green-500 ml-2">
                                -{{ round((($product->price_root - $product->pricesale) / $product->price_root) * 100) }}%
                            </span>
                        @else
                            <span class="text-gray-800">{{ number_format($product->price_root) }}₫</span>
                        @endif
                    </div>

                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Nhập mã <strong>TYUU</strong> giảm thêm 5% cho đơn hàng từ 30 triệu</li>
                        <li>Miễn phí vận chuyển toàn quốc</li>
                        <li>Tặng Voucher 10 triệu cho đơn hàng từ 50 triệu</li>
                        <li>Gói quà chuyên nghiệp miễn phí cho giày</li>
                    </ul>

                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                        <div>
                            <label for="size" class="block text-sm font-medium text-rose-700">Kích thước</label>
                            <select id="size"
                                class="mt-1 block w-32 p-2 border border-gray-300 rounded-md focus:ring-rose-500 focus:border-rose-500">
                                @foreach ([35, 36, 37, 38, 39, 40, 41, 42] as $size)
                                    <option>{{ $size }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="qty" class="block text-sm font-medium text-rose-700 mb-1">Số lượng</label>
                            <div class="flex items-center border border-gray-300 rounded-md w-[100px] overflow-hidden">
                                <!-- Nút trừ -->
                                <button type="button" onclick="updateQty(-1)"
                                    class="w-7 h-7 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold">-</button>

                                <!-- Ô nhập số -->
                                <input id="qty" name="qty" type="number" value="1" min="1"
                                    max="10" class="w-10 h-7 text-center text-sm focus:outline-none border-0" />

                                <!-- Nút cộng -->
                                <button type="button" onclick="updateQty(1)"
                                    class="w-7 h-7 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold">+</button>
                            </div>
                        </div>


                        <script>
                            function updateQty(delta) {
                                const input = document.getElementById('qty');
                                const min = parseInt(input.min) || 1;
                                const max = parseInt(input.max) || 100;
                                let value = parseInt(input.value) || min;

                                value = Math.max(min, Math.min(max, value + delta));
                                input.value = value;
                            }
                        </script>

                    </div>

                    <button type="button"
                        class="mt-4 w-full sm:w-48 bg-rose-500 text-white px-6 py-3 rounded-full font-semibold hover:bg-rose-600 transition"
                        onclick="addToCart(event, {{ $product->id }})">
                        Thêm vào giỏ
                    </button>
                </div>

            </div>
        </div>
    </section>


    <!-- Sản phẩm cùng loại -->
    <section class="container mx-auto py-10 px-4">
        <div class="text-center">
            <div class="inline-flex items-center justify-center gap-2 text-rose-500 mb-2">
                <i class="fas fa-tags text-xl"></i>
                <span class="text-sm font-medium uppercase tracking-wider">Gợi ý từ TyuuMei</span>
            </div>
            <h3 class="text-3xl font-bold text-gray-800">Sản Phẩm Cùng Loại</h3>
            <div class="mt-3 w-16 h-1 bg-rose-400 mx-auto rounded-full"></div>
        </div>
    </section>
    <!-- Danh sách sản phẩm -->
    <div id="product-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach ($product_list as $product_Row)
            <div>
                <x-product-card :productRow="$product_Row" />
            </div>
        @endforeach
    </div>
    </section>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Footer -->
    <x-menu-footer />
</body>

</html>
