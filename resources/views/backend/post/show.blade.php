<x-layout-admin>
    <div class="bg-white p-8 rounded-lg shadow-lg space-y-8">
        <h2 class="text-3xl font-bold text-blue-600 mb-6 border-b pb-3">📄 Chi tiết bài viết</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Thông tin chính -->
            <div class="md:col-span-2 space-y-6">
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="font-semibold text-gray-700">Tiêu đề:</span>
                        <span class="text-gray-900">{{ $post->title }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold text-gray-700">Slug:</span>
                        <span class="text-gray-900">{{ $post->slug }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold text-gray-700">Chủ đề:</span>
                        <span class="text-gray-900">{{ $post->topic ? $post->topic->name : 'Không có' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold text-gray-700">Mô tả:</span>
                        <span class="text-gray-900">{{ $post->description }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold text-gray-700">Loại bài viết:</span>
                        <span class="text-gray-900">{{ $post->type }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold text-gray-700">Trạng thái:</span>
                        <span class="text-gray-900">
                            <span class="px-2 py-1 rounded-full text-xs {{ $post->status == 1 ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-700' }}">
                                {{ $post->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                            </span>
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold text-gray-700">Ngày tạo:</span>
                        <span class="text-gray-900">{{ $post->created_at ? $post->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold text-gray-700">Cập nhật:</span>
                        <span class="text-gray-900">{{ $post->updated_at ? $post->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Ảnh thumbnail nhỏ lại -->
            <div class="flex flex-col items-center space-y-4">
                <h3 class="font-semibold text-gray-700">Ảnh thumbnail:</h3>
                @if($post->thumbnail)
                    <img src="{{ asset('assets/images/post/' . $post->thumbnail) }}"
                         alt="{{ $post->title }}"
                         class="w-40 h-40 object-cover rounded-lg shadow-lg transition-transform duration-300 hover:scale-105">
                @else
                    <p class="text-gray-500 italic">Chưa có ảnh</p>
                @endif
            </div>
        </div>

        <!-- Nội dung chi tiết -->
        <div class="mt-10">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">📝 Nội dung chi tiết:</h3>
            <div class="prose max-w-none bg-gray-50 p-5 rounded-lg border border-gray-200">
                {!! $post->detail !!}
            </div>
        </div>

        <!-- Nút quay lại -->
        <div class="mt-8 text-center">
            <a href="{{ route('post.index') }}"
               class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                ← Quay lại danh sách
            </a>
        </div>
    </div>
</x-layout-admin>
