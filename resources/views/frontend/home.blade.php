<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TyuuMei</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-white">
    <!-- Navbar -->
    <header class="bg-white shadow-md px-6">
        <div class="flex justify-between items-center py-4 w-full">
            <!-- Logo + Brand -->
            <a href="{{ route('site.home') }}">
                <img src="build/assets/images/logo1.jpg" alt="Logo" class="h-12 w-12 rounded-full object-cover">
            </a>
            <span class="text-2xl font-extrabold text-gray-600">
                Tyuu<span class="text-rose-500">Mei</span>
            </span>
            <!-- MainMenu -->
            <x-main-menu />
        </div>
    </header>

    <!-- Slider -->
    <x-slider />

    <!-- Bộ Sưu Tập Nổi Bật - New Premium Style -->
    <section class="my-28 px-4 md:px-12">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <!-- Left Text Zone - Pro Sneaker Style -->
            <div class="lg:col-span-4 flex flex-col justify-center gap-7">

                  <!-- Tagline Highlight -->
    <div class="inline-flex items-center gap-3 mb-2">
        <span class="w-14 h-[3px] bg-gradient-to-r from-blue-500 via-cyan-400 to-teal-400 rounded-full"></span>
        <p class="text-sm md:text-base font-semibold tracking-wider text-teal-500 uppercase">
            New Collection
        </p>
    </div>

    <!-- Heading -->
    <h2 class="text-3xl md:text-4xl font-extrabold leading-snug uppercase font-poppins">
        <span class="text-gray-800 block mb-1">Danh Mục</span>
        <span class="block bg-clip-text text-transparent bg-gradient-to-r from-blue-500 via-cyan-400 to-teal-400">
            Nổi Bật
        </span>
    </h2>

    <!-- Sub Text -->
    <p class="text-gray-600 text-base md:text-lg leading-relaxed max-w-md">
        Sản phẩm đẹp mỗi ngày tại
        <span class="font-bold text-blue-500">TyuuMei</span> — tỏa sáng phong cách của riêng bạn.
    </p>

    <!-- Decorative Dots -->
    <div class="flex gap-2">
        <span class="w-2 h-2 bg-blue-700 rounded-full"></span>
        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
        <span class="w-2 h-2 bg-blue-300 rounded-full"></span>
    </div>

</div>
            <!-- Right Category Grid - Premium UI -->
            <div class="lg:col-span-8 grid grid-cols-2 sm:grid-cols-3 gap-4">

                @foreach ($category_list->take(6) as $cat)
                    <a href="{{ route('site.product.category', $cat->slug) }}"
                        class="group relative overflow-hidden rounded-2xl
                   bg-neutral-900 shadow-lg
                   hover:-translate-y-1 hover:shadow-xl
                   transition-all duration-300">

                        <!-- Image -->
                        <img src="{{ asset('assets/images/category/' . $cat->image) }}" alt="{{ $cat->name }}"
                            class="w-full h-44 object-cover
                        group-hover:scale-105
                        transition-all duration-500" />

                        <!-- Overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-b
                        from-black/10 via-black/30 to-black/70
                        group-hover:via-black/50
                        transition-all duration-500">
                        </div>

                        <!-- Content -->
                        <div class="absolute bottom-3 left-3 right-3">
                            <h3
                                class="text-white tracking-wide font-bold
                           text-base drop-shadow
                           group-hover:text-rose-400 transition-colors">
                                {{ $cat->name }}
                            </h3>
                        </div>

                        <!-- Corner Badge -->
                        <div
                            class="absolute top-3 right-3
                        backdrop-blur-sm bg-white/20
                        text-white text-[10px] font-semibold
                        px-2 py-0.5 rounded-full
                        flex items-center gap-1
                        shadow-md
                        group-hover:bg-rose-500 group-hover:text-white
                        transition-all">
                            <span>🔥</span> Hot
                        </div>

                        <!-- Light shine -->
                        <span
                            class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent
                         opacity-0 group-hover:opacity-100
                         translate-x-[-100%] group-hover:translate-x-[100%]
                         transition-all duration-800"></span>
                    </a>
                @endforeach

            </div>


        </div>

    </section>

    <!-- Sản phẩm mới -->
    <x-product-new />

    <!-- Sản phẩm giảm giá -->
    <x-product-sale />

    <!-- Sản phẩm bán chạy -->
    <x-product-bestseller />

    <!-- Tin tức & Xu hướng -->
    <section class="my-16 px-6">
        <div class="text-center mb-10">
            <h2
                class="text-2xl sm:text-3xl md:text-4xl font-bold tracking-tight font-serif text-transparent bg-clip-text bg-gradient-to-r from-rose-500 via-purple-500 to-blue-500 animate-gradient-x inline-block border-b-4 border-rose-400 pb-1 px-4">
                📰 Tin Tức & Xu Hướng
            </h2>
            <p class="mt-3 text-gray-500 text-sm sm:text-base italic max-w-3xl mx-auto">
                Cập nhật xu hướng thời trang mới nhất và khám phá những chia sẻ nổi bật từ
                <strong>TyuuMei</strong>.
            </p>
        </div>

        <!-- Nội dung bài viết -->
        <div class="w-full">
            <x-post-new :postnew="$postnew" />
        </div>
    </section>
    <!-- Footer -->
    <x-menu-footer />

    <style>
        @keyframes gradient-x {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .animate-gradient-x {
            background-size: 200% 200%;
            animation: gradient-x 5s ease infinite;
        }
    </style>
</body>

</html>
