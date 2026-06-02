<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $post->title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">
    <!-- Navbar -->
    <header class="bg-white shadow-md px-6">
        <div class="flex justify-between items-center py-4 w-full">
            <!-- Logo + Brand -->
            <a href="{{ route('site.home') }}">
                <img src="/build/assets/images/logo1.jpg" alt="Logo" class="h-12 w-12 rounded-full object-cover" />
            </a>
            <span class="text-2xl font-extrabold text-gray-600">
                Tyuu<span class="text-rose-500">Mei</span>
            </span>
            <!-- MainMenu -->
            <x-main-menu />
        </div>
    </header>

    <!-- Slider (optional) -->
    <x-slider />

    <!-- Main Content -->
    <section class="page_product section py-8">
        <div class="container mx-auto">
            <!-- Chi tiết bài viết -->
            <div class="flex flex-col md:flex-row mb-12">
                <!-- Ảnh bài viết -->
                <div class="md:w-1/2 flex justify-center mb-6 md:mb-0">
                    <img src="{{ asset('assets/images/post/' . $post->thumbnail) }}"
                        class="rounded-lg shadow-lg max-w-2xl h-auto object-cover" alt="{{ $post->title }}" />
                </div>

                <!-- Nội dung bài viết -->
                <div class="md:w-1/2 md:pl-6 text-lg text-gray-700 mx-auto max-w-4xl leading-relaxed">
                    <h1 class="text-4xl font-extrabold text-blue-500 text-center md:text-left mb-6">{{ $post->title }}
                    </h1>
                    <div class="text-lg text-gray-700">
                        {!! $post->detail !!}
                    </div>
                </div>
            </div>

            <!-- Mô tả ngắn -->
            <p class="text-base italic text-orange-500 mb-4">
                Khám phá phiên bản tuyệt vời nhất của chính bạn mỗi ngày.
            </p>

            <div class="text-lg text-gray-700">
                {{ $post->description }}
            </div>
        </div>

        <!-- Bài viết theo chủ đề -->
        @if ($topic)
            <div class="mt-12">
                <h3 class="text-2xl font-semibold py-4 border-b-2 border-rose-500 mb-6">
                    Bài viết theo chủ đề: {{ $topic->name }}
                </h3>
                @if ($related_posts->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($related_posts as $postitem)
                            <a href="{{ route('site.post.detail', ['slug' => $postitem->slug]) }}"
                                class="block border rounded-lg p-4 shadow-md hover:shadow-lg transition-all duration-300">
                                <img src="{{ asset('assets/images/post/' . $postitem->thumbnail) }}"
                                    class="rounded-t-lg mb-4 w-full h-48 object-cover" alt="{{ $postitem->title }}" />
                                <h4 class="text-lg font-semibold mb-2">{{ $postitem->title }}</h4>
                                <p class="text-sm text-gray-600">
                                    {{ Str::limit(strip_tags($postitem->detail), 100) }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500">Không có bài viết nào thuộc chủ đề này.</p>
                @endif
            </div>
        @endif
    </section>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Footer -->
    <x-MenuFooter />
</body>

</html>
