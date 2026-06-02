    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Ảnh bài viết -->
            <div class="flex justify-center">
                <img src="{{ asset('assets/images/post/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                class="rounded-2xl shadow-xl w-full max-w-[350px] object-cover aspect-square border-2 border-rose-300 hover:scale-105 transition-transform duration-300">
            </div>

            <!-- Nội dung bài viết -->
            <div>
                <div class="py-5">
                    <!-- Tiêu đề bài viết -->
                    <h2 class="text-3xl font-bold mb-4 text-rose-400">{{ $post->title }}</h2>
                    <!-- Nội dung bài viết -->
                    <p class="text-lg text-gray-700 mb-6 leading-relaxed">{{ $post->detail }}</p>
                    {{-- <p class="text-lg text-gray-700 mb-6 leading-relaxed">{{ $post->description }}</p> --}}

                    <!-- chi tiết -->
                    <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}">
                        <button type="button"
                            class="bg-rose-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-rose-600 transition duration-300 ease-in-out transform hover:scale-105">
                            Xem Chi Tiết
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
