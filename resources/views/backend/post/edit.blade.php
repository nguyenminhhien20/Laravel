<x-layout-admin>
    <div class="content-wrapper">
        <!-- Tiêu đề và nút quay lại -->
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">SỬA POST</h2>
                <a href="{{ route('post.index') }}" class="bg-gray-500 px-2 py-2 rounded-xl text-white">
                    <i class="fa fa-arrow-left"></i> Về danh sách
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="border border-blue-100 rounded-lg p-3">
            <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-3 gap-6">
                    <!-- Cột trái -->
                    <div class="col-span-2">
                        <!-- Tiêu đề -->
                        <div class="mb-3">
                            <label for="title"><strong>Tiêu Đề</strong></label>
                            <input value="{{ old('title', $post->title) }}" type="text" name="title" id="title"
                                placeholder="Nhập tiêu đề"
                                class="w-full border border-gray-300 rounded-lg p-2">
                            @error('title') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <!-- Nội dung chi tiết -->
                        <div class="mb-3">
                            <label for="detail"><strong>Nội dung</strong></label>
                            <textarea name="detail" id="detail" class="w-full border border-gray-300 rounded-lg p-2">{{ old('detail', $post->detail) }}</textarea>
                            @error('detail') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label for="description"><strong>Mô tả</strong></label>
                            <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description') }}</textarea>
                            @error('description') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Cột phải -->
                    <div class="col-span-1">
                        <!-- Chủ đề -->
                        <div class="mb-3">
                            <label for="topic_id"><strong>Chủ đề</strong></label>
                            <select name="topic_id" id="topic_id" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="">Chọn chủ đề</option>
                                @foreach ($list_topic as $topic)
                                    <option value="{{ $topic->id }}" {{ old('topic_id', $post->topic_id) == $topic->id ? 'selected' : '' }}>
                                        {{ $topic->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('topic_id') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <!-- Hình đại diện -->
                        <div class="mb-3">
                            <label for="thumbnail"><strong>Hình đại diện</strong></label>
                            <input type="file" name="thumbnail" id="thumbnail"
                                class="w-full border border-gray-300 rounded-lg p-2">
                            @error('thumbnail') <div class="text-red-500">{{ $message }}</div> @enderror

                            @if ($post->thumbnail)
                                <div class="mt-2">
                                    <img src="{{ asset('assets/images/post/' . $post->thumbnail) }}" alt="Thumbnail"
                                        class="w-32 h-auto rounded">
                                </div>
                            @endif
                        </div>

                        <!-- Loại bài viết -->
                        <div class="mb-3">
                            <label for="type"><strong>Loại bài viết</strong></label>
                            <select name="type" id="type" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                                <option value="post" {{ old('type', $post->type) == 'post' ? 'selected' : '' }}>Post</option>
                                <option value="page" {{ old('type', $post->type) == 'page' ? 'selected' : '' }}>Page</option>
                            </select>
                            @error('type') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label for="status"><strong>Trạng thái</strong></label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="1" {{ old('status', $post->status) == '1' ? 'selected' : '' }}>Xuất bản</option>
                                <option value="0" {{ old('status', $post->status) == '0' ? 'selected' : '' }}>Không xuất bản</option>
                            </select>
                            @error('status') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="text-center mt-4">
                    <button type="submit" class="bg-rose-500 text-white px-4 py-2 rounded-md">
                        <i class="fa fa-save mr-1"></i> Cập nhật bài viết
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout-admin>
