<section class="mb-16 bg-gradient-to-br from-rose-50 via-pink-50 to-white bg-[url('/pattern-light.svg')] bg-cover py-14">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-rose-500 to-pink-600 flex items-center justify-center space-x-3 drop-shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-rose-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l2.39 6.95h7.31l-5.91 4.3 2.39 6.95-5.91-4.3-5.91 4.3 2.39-6.95-5.91-4.3h7.31z"/>
                </svg>
                <span>{{ $category_name }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-rose-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l2.39 6.95h7.31l-5.91 4.3 2.39 6.95-5.91-4.3-5.91 4.3 2.39-6.95-5.91-4.3h7.31z"/>
                </svg>
            </h2>
            <p class="text-gray-500 mt-3 text-lg italic">Khám phá sản phẩm thuộc danh mục {{ strtolower($category_name) }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8 gap-y-12">
            @foreach ($product_list as $product_row)
                <div class="relative bg-white rounded-3xl shadow-md hover:shadow-xl transform hover:-translate-y-2 hover:ring-2 hover:ring-rose-300 hover:ring-offset-2 transition overflow-hidden">
                    <!-- Label 'Mới' -->
                    <div class="absolute top-2 left-2 bg-gradient-to-r from-rose-400 to-pink-500 text-white text-xs px-3 py-1 rounded-full shadow">
                        Mới
                    </div>

                    <x-product-card :productRow="$product_row" />
                </div>
            @endforeach
        </div>

        <div class="flex justify-center mt-12">
            <a href="{{ route('site.product', ['category' => $category_slug]) }}" class="inline-flex items-center px-10 py-3 rounded-full bg-gradient-to-r from-rose-500 to-pink-600 text-white font-semibold text-lg shadow-lg hover:shadow-2xl transform hover:scale-105 transition">
                Xem tất cả
                <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</section>
