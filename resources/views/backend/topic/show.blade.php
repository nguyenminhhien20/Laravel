<x-layout-admin>
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">Thông Tin Chủ Đề</h2>
                <a href="{{ route('topic.index') }}" class="bg-gray-500 px-2 py-2 rounded-xl mx-1 text-white">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách
                </a>
            </div>
        </div>

        <!-- Topic Details Section -->
        <div class="border border-blue-100 rounded-lg p-3">
            <!-- Topic Name -->
            <div class="mb-3">
                <strong>Tên Chủ Đề:</strong> {{ $topic->name }}
            </div>

            <!-- Topic Slug -->
            <div class="mb-3">
                <strong>Slug:</strong> {{ $topic->slug }}
            </div>

            <!-- Topic Description -->
            <div class="mb-3">
                <strong>Mô Tả:</strong>
                <p>{{ $topic->description ?? 'Không có mô tả' }}</p>
            </div>

            <!-- Topic Status -->
            <div class="mb-3">
                <strong>Trạng Thái:</strong>
                {{ $topic->status == 1 ? 'Xuất bản' : 'Không xuất bản' }}
            </div>

            <!-- Topic Created By -->
            <div class="mb-3">
                <strong>Tạo Bởi:</strong> {{ $topic->created_by }}
            </div>

            <!-- Topic Updated By -->
            <div class="mb-3">
                <strong>Cập Nhật Bởi:</strong> {{ $topic->updated_by }}
            </div>

            <!-- Topic Created At -->
            <div class="mb-3">
                <strong>Ngày Tạo:</strong> {{ $topic->created_at->format('d-m-Y H:i') }}
            </div>

            <!-- Topic Updated At -->
            <div class="mb-3">
                <strong>Ngày Cập Nhật:</strong> {{ $topic->updated_at->format('d-m-Y H:i') }}
            </div>
        </div>
    </div>
</x-layout-admin>
