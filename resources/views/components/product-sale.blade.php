<section class="mb-16 bg-white py-14">
    <div class="container mx-auto max-w-7xl px-4">
        <!-- Header -->
        <div class="text-center mb-10">
            <h2
                class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-rose-500 to-pink-600 flex items-center justify-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-rose-400 animate-bounce" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2s-3 1.343-3 3 1.343 3 3 3zm0 2c-2.21 0-4 1.79-4 4v5h8v-5c0-2.21-1.79-4-4-4z" />
                </svg>
                <span>Sản phẩm khuyến mãi</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-rose-400 animate-bounce" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2s-3 1.343-3 3 1.343 3 3 3zm0 2c-2.21 0-4 1.79-4 4v5h8v-5c0-2.21-1.79-4-4-4z" />
                </svg>
            </h2>
            <p class="text-gray-600 mt-3 text-lg italic">Săn sale cực sốc, giá tốt nhất chỉ hôm nay!</p>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @forelse ($product_list as $product_row)
                @php
                    $salePercent =
                        $product_row->price_root > $product_row->price_sale && $product_row->price_root > 0
                            ? round(
                                (($product_row->price_root - $product_row->price_sale) / $product_row->price_root) *
                                    100,
                            )
                            : 0;
                @endphp

                <div
                    class="relative bg-white rounded-3xl shadow-md hover:shadow-xl transform hover:-translate-y-2 transition overflow-hidden">

                    <!-- Label SALE -->
                    @if ($salePercent > 0)
                        <div
                            class="absolute top-2 left-2 bg-gradient-to-r from-rose-500 to-pink-400 text-white text-xs px-3 py-1 rounded-full shadow animate-pulse">
                            SALE -{{ $salePercent }}%
                        </div>
                    @endif

                    <x-product-card :productRow="$product_row" />
                </div>
            @empty
                <div class="col-span-5 text-center text-gray-500 py-10">
                    Không có sản phẩm nào.
                </div>
            @endforelse
        </div>


        <!-- See More Button -->
        <div class="flex justify-center mt-10">
            <a href="{{ route('site.product') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5
              text-sm font-semibold text-white
              rounded-full bg-gradient-to-r from-rose-500 to-pink-600
              hover:from-gray-300 hover:via-rose-200 hover:to-gray-100
              hover:text-rose-600
              transition duration-300 ease-in-out
              shadow-md hover:shadow-lg transform hover:scale-105 group">
                <span>Xem thêm</span>
                <i
                    class="fas fa-arrow-right text-xs sm:text-sm transition-transform duration-300 group-hover:translate-x-1"></i>
            </a>
        </div>
    </div>
</section>
