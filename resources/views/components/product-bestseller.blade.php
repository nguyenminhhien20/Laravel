<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<section class="py-20 bg-white">
    <div class="relative w-full max-w-7xl mx-auto px-4">

        <!-- Title -->
        <div class="text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 drop-shadow-sm">
                Top sản phẩm yêu thích
            </h2>
            <p class="text-gray-500 text-base mt-2">
                Những lựa chọn hàng đầu từ khách hàng
            </p>
        </div>

        <!-- Slider -->
        <div class="swiper mySwiper pb-[100px]">
            <div class="swiper-wrapper">
                @foreach ($product_bestseller as $product)
                @php
                    $salePercent = ($product->price_root > $product->price_sale && $product->price_root > 0)
                        ? round((($product->price_root - $product->price_sale) / $product->price_root) * 100)
                        : 0;
                @endphp

                <div class="swiper-slide flex justify-center">
                    <div
                        class="relative bg-white rounded-3xl shadow-lg hover:shadow-[0_8px_25px_rgba(79,70,229,0.2)] transition-all duration-500 flex flex-col h-[390px] w-[240px] overflow-hidden group border border-transparent hover:border-indigo-400">

                        <!-- Shine Effect -->
                        <div class="absolute top-0 left-[-150%] h-full w-full bg-white opacity-10
                            group-hover:translate-x-[250%] transition-transform duration-700 rotate-45"></div>

                        <!-- Badge -->
                        @if ($salePercent > 0)
                        <div
                            class="absolute top-3 left-3 bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-xs px-3 py-1 rounded-full shadow">
                            Top Choice ⭐ - {{ $salePercent }}%
                        </div>
                        @else
                        <div
                            class="absolute top-3 left-3 bg-indigo-400 text-white text-xs px-3 py-1 rounded-full shadow">
                            Top Choice ⭐
                        </div>
                        @endif

                        <!-- Image block -->
                        <a href="{{ route('site.product_detail', ['slug' => $product->slug]) }}"
                            class="h-52 w-full overflow-hidden">
                            <img src="{{ asset('assets/images/product/' . ($product->thumbnail ?? 'no-image.png')) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.08]">
                        </a>

                        <!-- Content -->
                        <div class="p-4 flex flex-col justify-between flex-1">
                            <h3 class="text-sm font-semibold text-gray-800 line-clamp-2 h-10">
                                {{ $product->name }}
                            </h3>

                            <!-- Price block (fixed height) -->
                            <div class="mt-2 min-h-[38px] flex flex-col justify-start">
                                @if ($product->price_sale < $product->price_root)
                                <p class="text-gray-400 line-through text-xs">
                                    {{ number_format($product->price_root,0,',','.') }}₫
                                </p>
                                <p class="text-[18px] font-bold text-indigo-600">
                                    {{ number_format($product->price_sale,0,',','.') }}₫
                                </p>
                                @else
                                <p class="invisible text-xs">0₫</p>
                                <p class="text-[18px] font-bold text-indigo-600">
                                    {{ number_format($product->price_root,0,',','.') }}₫
                                </p>
                                @endif
                            </div>

                            <!-- Button -->
                            <button onclick="addToCart(event, {{ $product->id }})"
                                class="mt-3 py-2 w-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-semibold rounded-xl hover:shadow-lg hover:scale-[1.03] transition-all text-sm">
                                Mua ngay 🛒
                            </button>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination !-bottom-[35px]"></div>

            <!-- Navigation -->
            <div class="swiper-button-next text-indigo-600"></div>
            <div class="swiper-button-prev text-indigo-600"></div>
        </div>
    </div>
</section>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new Swiper(".mySwiper", {
        slidesPerView: 5,
        spaceBetween: 26,
        loop: true,
        autoplay: { delay: 2600 },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            320: { slidesPerView: 1 },
            480: { slidesPerView: 2 },
            768: { slidesPerView: 3 },
            1024: { slidesPerView: 4 },
            1280: { slidesPerView: 5 },
        },
    });
});
</script>

<style>
/* Pagination */
.swiper-pagination-bullet {
    width: 11px;
    height: 11px;
    background-color: #e5e7eb !important;
    opacity: 1;
}
.swiper-pagination-bullet-active {
    background: linear-gradient(135deg, #6366F1, #A855F7) !important;
}

/* Navigation buttons */
.swiper-button-next,
.swiper-button-prev {
    top: 45%;
    width: 2.4rem;
    height: 2.4rem;
    background-color: rgba(255,255,255,0.95);
    border-radius: 50%;
    box-shadow: 0 4px 20px rgba(0,0,0,.15);
    transition: .25s;
}
.swiper-button-next:hover,
.swiper-button-prev:hover {
    background-color: white;
    transform: scale(1.08);
}
</style>
