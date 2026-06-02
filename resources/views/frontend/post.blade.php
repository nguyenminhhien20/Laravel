<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài viết</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body class="bg-gray-50">

    <!-- Navbar -->
    <header class="bg-white shadow-md px-6">
        <div class="flex justify-between items-center py-4 w-full">
            <a href="{{ route('site.home') }}">
                <img src="build/assets/images/logo1.jpg" alt="Logo" class="h-12 w-12 rounded-full object-cover">
            </a>
            <span class="text-2xl font-extrabold text-gray-600">
                Tyuu<span class="text-rose-500">Mei</span>
            </span>
            <x-main-menu />
        </div>
    </header>

    <!-- Slider (optional) -->
    <x-slider />

    <!-- Nội dung bài viết -->
   <section class="page_product section py-12 bg-white">
    <div class="container mx-auto px-4 md:px-6">

        <!-- Tiêu đề -->
        <div class="text-center mb-12">
            <h3 class="text-3xl md:text-4xl font-bold text-rose-500 inline-flex items-center gap-2">
                <i class="fas fa-feather-alt text-rose-400 text-2xl"></i>
                Bài Viết Mới Nhất
                <i class="fas fa-feather-alt text-rose-400 text-2xl transform rotate-180"></i>
            </h3>
            <p class="text-gray-500 mt-2 text-sm md:text-base">Cập nhật thông tin và xu hướng mỗi ngày từ TyuuMei</p>
        </div>

        <div id="post-list">
            @if ($list_post->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach ($list_post as $postitem)
                        <a href="{{ url('/chi-tiet-bai-viet', $postitem->slug) }}" class="group">
                            <div class="rounded-xl overflow-hidden bg-white border border-gray-100 shadow-md hover:shadow-xl transition duration-300">
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ asset('assets/images/post/' . $postitem->thumbnail) }}"
                                         alt="{{ $postitem->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute top-2 left-2 bg-white text-rose-500 px-3 py-1 text-xs font-semibold rounded-full shadow">
                                        Bài viết
                                    </div>
                                </div>
                                <div class="p-5">
                                    <h4 class="text-lg font-semibold text-gray-800 group-hover:text-rose-600 transition mb-2">
                                        {{ $postitem->title }}
                                    </h4>
                                    <p class="text-gray-600 text-sm line-clamp-3">
                                        {{ $postitem->detail }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Phân trang -->
                <div class="mt-10 text-center">
                    {!! $list_post->links('pagination::tailwind') !!}
                </div>
            @else
                <p class="text-center text-gray-500">Không có bài viết nào để hiển thị.</p>
            @endif
        </div>
    </div>
</section>



    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Footer -->
    <x-MenuFooter />

    <!-- Script AJAX phân trang -->
    <script>
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');

            if (url !== undefined) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    beforeSend: function() {
                        $('#post-list').html(
                            '<div class="text-center py-10 text-gray-500">Đang tải bài viết...</div>'
                        );
                    },
                    success: function(data) {
                        let newPosts = $(data).find('#post-list').html();
                        $('#post-list').html(newPosts);

                        // Cập nhật URL (giữ nguyên khi reload)
                        window.history.pushState("", "", url);
                    },
                    error: function() {
                        alert('Không thể tải bài viết. Vui lòng thử lại!');
                    }
                });
            }
        });
    </script>

</body>

</html>
