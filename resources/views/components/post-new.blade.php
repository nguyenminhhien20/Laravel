<section class="container mx-auto px-6 py-20 relative z-10">
    <!-- Nền ánh sáng mờ -->
    <div class="absolute inset-0 -z-10 bg-gradient-to-br from-white via-rose-50 to-rose-100 opacity-50 blur-[80px]"></div>

    <div class="grid md:grid-cols-2 gap-16 items-start">

        <!-- GIỚI THIỆU & VIDEO -->
        <div class="space-y-6">
            <h2 class="text-2xl font-bold tracking-tight text-center text-transparent bg-clip-text bg-[linear-gradient(45deg,#f43f5e,#d946ef,#0ea5e9)] bg-[length:200%] animate-gradient-3d">
                GIỚI THIỆU THƯƠNG HIỆU
            </h2>

            <div class="rounded-2xl overflow-hidden shadow-2xl ring-2 ring-rose-200 group transition-all duration-300">
                <video controls autoplay muted loop class="w-full h-[360px] object-cover group-hover:scale-[1.01] transition-transform duration-300">
                    <source src="{{ asset('videos/tyuu.mp4') }}" type="video/mp4">
                    Trình duyệt của bạn không hỗ trợ video HTML5.
                </video>
            </div>

            <p class="text-base text-gray-700 leading-relaxed bg-white/70 rounded-xl p-4 shadow-md backdrop-blur border-l-4 border-rose-400">
                <strong>TyuuMei</strong> là biểu tượng của sự tinh tế và đột phá trong thời trang. Chúng tôi mang đến những mẫu giày thiết kế độc đáo, chất lượng vượt trội, giúp bạn thể hiện cá tính và phong cách riêng.
            </p>
        </div>

        <!-- BÀI VIẾT NỔI BẬT -->
        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-left text-transparent bg-clip-text bg-gradient-to-l from-rose-500 via-purple-500 to-teal-500 animate-gradient-3d">
                BÀI VIẾT NỔI BẬT
            </h2>

            <div class="space-y-6">
                @foreach ($postnew as $post)
                    <a href="{{ route('site.post.detail', $post->slug) }}"
                        class="flex gap-4 group bg-white/70 hover:bg-white/90 transition duration-300 rounded-xl p-4 shadow-lg border border-white/40 backdrop-blur">
                        @php
                            $imagePath = public_path('assets/images/post/' . $post->thumbnail);
                            $imageUrl = asset('assets/images/post/' . $post->thumbnail);
                        @endphp

                        <img src="{{ !empty($post->thumbnail) && file_exists($imagePath) ? $imageUrl : 'https://via.placeholder.com/100x100?text=No+Image' }}"
                            class="w-24 h-24 object-cover rounded-xl shadow-md transition-transform duration-300 group-hover:scale-105">

                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-900 group-hover:text-rose-600">{{ $post->name }}</h3>
                            <p class="text-sm text-pink-500 font-medium mt-1">{{ $post->title }}</p>
                            <p class="text-sm text-gray-700 mt-1 line-clamp-2">{{ $post->description }}</p>
                            <p class="text-xs text-gray-400 mt-2 italic">Ngày đăng: {{ $post->created_at->format('d/m/Y') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="flex justify-end mt-4">
                <a href="{{ route('site.post') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full font-medium text-rose bg-gradient-to-r from-teal-400 via-blue-400 to-teal -400 hover:from-orange-400 hover:to-rose-500 shadow-md hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                    <i class="fas fa-arrow-right"></i> Đọc thêm
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Hiệu ứng gradient mượt -->
<style>
@keyframes gradient-3d {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}
.animate-gradient-3d {
    background-size: 200% 200%;
    animation: gradient-3d 6s ease infinite;
}
</style>
