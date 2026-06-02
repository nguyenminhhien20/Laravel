<section class="relative mb-0 bg-white py-16 overflow-hidden">
    <div class="absolute inset-0 bg-[url('/pattern-light.svg')] opacity-50"></div>
    {{-- <div class="absolute inset-0 bg-gradient-to-br from-rose-50/60 to-pink-50/40"></div> --}}

    <div class="relative z-10 max-w-7xl mx-auto px-4">

        <!-- Heading -->
        <div class="text-center mb-12">
            <div class="flex justify-center items-center gap-2 mb-4">
                <span class="w-3 h-3 bg-rose-500 rounded-full animate-ping"></span>
                <span class="w-3 h-3 bg-pink-500 rounded-full animate-ping delay-150"></span>
                <span class="w-3 h-3 bg-rose-300 rounded-full animate-ping delay-300"></span>
            </div>

            <h2 class="text-4xl md:text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-rose-600 to-pink-500 tracking-wide drop-shadow-md">
                Sản phẩm mới
            </h2>

            <p class="text-gray-500 mt-3 text-lg italic">
                Khám phá những món hàng hot nhất hôm nay
            </p>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8 gap-y-14">
            @foreach ($product_list as $product_row)
                <div class="relative group bg-white rounded-3xl shadow-md hover:shadow-2xl
                    transform hover:-translate-y-2 transition-all duration-300 overflow-hidden">

                    <!-- Label 'Mới' -->
                    <div class="absolute top-3 left-3 z-20
                        bg-gradient-to-r from-rose-500 to-pink-500 text-white text-xs font-semibold
                        px-3 py-1 rounded-full shadow-md">
                        ✨ Mới
                    </div>

                    <x-product-card :productRow="$product_row" />
                </div>
            @endforeach
        </div>

        <!-- Button -->
        <div class="flex justify-center mt-12">
            <a href="{{ route('site.product') }}"
                class="group inline-flex items-center gap-3 px-7 py-3 border-2 border-rose-500
                rounded-full font-semibold tracking-wide text-rose-600 bg-white
                hover:bg-gradient-to-r hover:from-rose-500 hover:to-pink-500
                hover:text-white transition-all duration-300 shadow-sm hover:shadow-xl">
                <span>Xem thêm</span>
                <span class="w-7 h-7 flex items-center justify-center rounded-full bg-rose-100 group-hover:bg-white">
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </a>
        </div>

    </div>
</section>
