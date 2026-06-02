<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tyuu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
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
    {{-- <x-slider /> --}}

    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <!-- Tiêu đề -->
            <div class="text-center mb-12">
                <h3
                    class="inline-flex items-center justify-center text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-rose-500 to-pink-600 space-x-3">
                    <i class="fas fa-star text-rose-400 drop-shadow-sm"></i>
                    <span>Tất Cả Sản Phẩm</span>
                    <i class="fas fa-star text-rose-400 drop-shadow-sm"></i>
                </h3>
                <p class="mt-2 text-blue-500 text-sm italic">Khám phá xu hướng mới, nổi bật phong cách của bạn</p>
            </div>

            <div class="flex flex-col md:flex-row gap-12">
                <!-- Sidebar lọc -->
                @if (!request('keyword'))
                    <aside class="w-full md:w-1/4 bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
                        <div class="space-y-10">
                            <!-- Thương hiệu -->
                            <div x-data="{ open: false, selected: '{{ request('brand') ? $brand_list->firstWhere('id', request('brand'))->name ?? '-- Chọn thương hiệu --' : '-- Chọn thương hiệu --' }}' }" class="relative" @click.outside="open = false">
                                <label class="block text-sm font-bold text-blue-600 mb-2 flex items-center">
                                    <i class="fas fa-tags mr-2 text-blue-500"></i> Thương hiệu
                                </label>
                                <button @click="open = !open"
                                    class="w-full px-4 py-3 border border-blue-300 rounded-xl bg-white flex justify-between items-center shadow-sm hover:shadow-md hover:bg-blue-50 transition duration-200">
                                    <span x-text="selected" class="text-gray-700"></span>
                                    <i class="fas fa-chevron-down ml-2 text-blue-500 transition-transform duration-300"
                                        :class="{ 'rotate-180': open }"></i>
                                </button>
                                <div x-show="open" x-transition
                                    class="absolute z-20 w-full bg-white border border-blue-300 rounded-xl mt-2 shadow-lg max-h-60 overflow-auto">
                                    @foreach ($brand_list as $brand)
                                        <div @click="selected='{{ $brand->name }}'; open=false; $('#brand').val('{{ $brand->id }}').change();"
                                            class="px-4 py-2 hover:bg-blue-100 cursor-pointer text-gray-700 transition">
                                            {{ $brand->name }}
                                        </div>
                                    @endforeach
                                </div>
                                <input type="hidden" id="brand" name="brand" value="{{ request('brand') }}">
                            </div>

                            <!-- Danh mục -->
                            <div x-data="{ open: false, selected: '{{ request('category') ? $category_list->firstWhere('id', request('category'))->name ?? '-- Chọn danh mục --' : '-- Chọn danh mục --' }}' }" class="relative" @click.outside="open = false">
                                <label class="block text-sm font-bold text-green-600 mb-2 flex items-center">
                                    <i class="fas fa-list mr-2 text-green-500"></i> Danh mục
                                </label>
                                <button @click="open = !open"
                                    class="w-full px-4 py-3 border border-green-300 rounded-xl bg-white flex justify-between items-center shadow-sm hover:shadow-md hover:bg-green-50 transition duration-200">
                                    <span x-text="selected" class="text-gray-700"></span>
                                    <i class="fas fa-chevron-down ml-2 text-green-500 transition-transform duration-300"
                                        :class="{ 'rotate-180': open }"></i>
                                </button>
                                <div x-show="open" x-transition
                                    class="absolute z-20 w-full bg-white border border-green-300 rounded-xl mt-2 shadow-lg max-h-60 overflow-auto">
                                    @foreach ($category_list as $category)
                                        <div @click="selected='{{ $category->name }}'; open=false; $('#category').val('{{ $category->id }}').change();"
                                            class="px-4 py-2 hover:bg-green-100 cursor-pointer text-gray-700 transition">
                                            {{ $category->name }}
                                        </div>
                                    @endforeach
                                </div>
                                <input type="hidden" id="category" name="category" value="{{ request('category') }}">
                            </div>

                            <!-- Mức giá -->
                            <div>
                                <p class="font-bold mb-3 text-yellow-600 border-t pt-4 flex items-center">
                                    <i class="fas fa-dollar-sign mr-2 text-yellow-500"></i> Mức giá
                                </p>
                                <div class="space-y-3">
                                    @foreach ([
        '0-1000000' => 'Dưới 1.000.000₫',
        '1000000-2000000' => '1.000.000₫ - 2.000.000₫',
        '2000000-3000000' => '2.000.000₫ - 3.000.000₫',
        '3000000-5000000' => '3.000.000₫ - 5.000.000₫',
        '5000000-7000000' => '5.000.000₫ - 7.000.000₫',
        '7000000-10000000' => '7.000.000₫ - 10.000.000₫',
        '10000000-999999999' => 'Trên 10.000.000₫',
    ] as $range => $label)
                                        <label
                                            class="flex items-center space-x-3 p-2 rounded-lg hover:bg-yellow-50 cursor-pointer transition">
                                            <input
                                                class="form-checkbox text-yellow-500 border-yellow-400 rounded focus:ring-yellow-500"
                                                type="checkbox" name="price[]" value="{{ $range }}">
                                            <span class="text-gray-700 text-sm">{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Dịch vụ giao hàng -->
                            <div>
                                <p class="font-bold mb-3 text-green-600 border-t pt-4 flex items-center">
                                    <i class="fas fa-shipping-fast mr-2 text-green-500"></i> Dịch vụ giao hàng
                                </p>
                                <div class="space-y-3">
                                    @foreach (['Miễn phí giao hàng', 'Giao hàng nhanh', 'Giao hàng tiết kiệm'] as $ship)
                                        <label
                                            class="flex items-center space-x-3 p-2 rounded-lg hover:bg-green-50 cursor-pointer transition">
                                            <input
                                                class="form-checkbox text-green-500 border-green-400 rounded focus:ring-green-500"
                                                type="checkbox" name="delivery[]">
                                            <span class="text-gray-700 text-sm">{{ $ship }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </aside>
                @endif

                <!-- Sản phẩm -->
                {{-- <main class="w-full md:w-3/4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 min-h-[200px]" id="product-list">
                        @forelse ($product_list as $product_row)
                            <x-product-card :productRow="$product_row" />
                        @empty
                            <div
                                class="col-span-3 flex justify-center items-center text-gray-500 py-10 text-lg font-medium text-center">
                                Không tìm thấy sản phẩm nào phù hợp với từ khóa
                                "<span class="text-rose-500">{{ request('keyword') }}</span>"
                            </div>
                    </div>
                    @endforelse
            </div>

            @if ($product_list->count() > 0)
                <div class="mt-6 flex justify-center">
                    {{ $product_list->links() }}
                </div>
            @endif
            </main> --}}
                <!-- Sản phẩm -->
                <main class="w-full md:w-3/4">
                    <div id="product-list">
                        @include('frontend.partials.product-list')
                    </div>
                </main>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <x-MenuFooter />

    <script>
        $(document).ready(function() {
            function fetchProducts(page = 1) {
                let category = $('#category').val();
                let brand = $('#brand').val();
                let price = $("input[name='price[]']:checked").map(function() {
                    return this.value;
                }).get();
                let delivery = $("input[name='delivery[]']:checked").map(function() {
                    return this.value;
                }).get();

                $.ajax({
                    url: "{{ route('site.product') }}",
                    type: "GET",
                    data: {
                        category: category,
                        brand: brand,
                        price: price,
                        delivery: delivery,
                        page: page
                    },
                    success: function(response) {
                        $('#product-list').html(response);
                    }
                });
            }

            $('#category, #brand, input[name="price[]"], input[name="delivery[]"]').change(function() {
                fetchProducts(1);
            });

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                fetchProducts(page);
            });
        });
    </script>
</body>

</html>
