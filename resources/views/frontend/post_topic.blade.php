<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tyuu</title>
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
                <img src="build/assets/images/logo1.jpg" alt="Logo" class="h-10 w-10 rounded-full object-cover">
            </a>
            <span class="text-2xl font-extrabold text-gray-600">Tyuu<span class="text-rose-500">Mei</span></span>
            <!-- MainMenu -->
            <x-main-menu />
        </div>
    </header>

    <!-- Slider (optional) -->
    <x-slider />

    <!-- Main Content -->
    <section class="page_product section py-8">
        <div class="container mx-auto">
            <!-- Bài viết chi tiết -->
            <div class="mb-10">
                <h1 class="text-3xl font-extrabold text-center mb-6">Bài viết theo chủ đề: {{ $row->name }}</h1>
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Hình ảnh bài viết -->
                    <div class="md:w-1/2">
                        <img src="{{asset('assets/images/post/' . $post->thumbnail) }}" class="w-full rounded-lg shadow-md object-cover"
                             alt="{{ $post->title }}">
                    </div>

                    <!-- Nội dung bài viết -->
                    <div class="md:w-1/2">
                        <h2 class="py-3 text-2xl font-semibold">{{ $post->title }}</h2>
                        <div class="text-gray-700 leading-relaxed">
                            {!! $post->detail !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Các bài viết liên quan -->
            <div>
                <h4 class="text-2xl font-semibold py-4 border-b border-rose-400 mb-6">Các bài viết liên quan</h4>
                @if ($list_post->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($list_post as $postitem)
                            <a href="{{ url('/chi-tiet-bai-viet', $postitem->slug) }}">
                                <x-post-item :postitem="$postitem" />
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500">Chưa có bài viết liên quan.</p>
                @endif
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Footer -->
    <x-MenuFooter />
</body>

</html>
