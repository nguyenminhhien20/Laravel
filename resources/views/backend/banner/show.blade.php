<x-layout-admin>
    <div class="content-wrapper">
        <!-- Tiêu đề và quay lại -->
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">CHI TIẾT BANNER</h2>
                <a href="{{ route('banner.index') }}" class="bg-gray-500 px-3 py-2 rounded-xl text-white">
                    <i class="fa fa-arrow-left"></i> Về danh sách
                </a>
            </div>
        </div>

        <!-- Chi tiết Banner -->
        <div class="border border-blue-100 rounded-lg p-3">
            <div class="mb-3">
                <strong>Tên Banner:</strong> {{ $banner->name }}
            </div>
            <div class="mb-3">
                <strong>Vị trí:</strong> {{ $banner->position }}
            </div>
            <div class="mb-3">
                <strong>Mô tả:</strong> {{ $banner->description }}
            </div>
            <div class="mb-3">
                <strong>Thứ tự hiển thị:</strong> {{ $banner->sort_order }}
            </div>
            <div class="mb-3">
                <strong>Trạng thái:</strong>
                {{ $banner->status == 1 ? 'Hiển thị' : 'Ẩn' }}
            </div>
            <div class="mb-3">
                <strong>Ảnh:</strong>
                @if ($banner->image)
                    <img src="{{ asset('assets/images/banner/' . $banner->image) }}" alt="Banner Image" class="w-48 h-48 object-cover rounded-lg">
                @else
                    <span>Không có ảnh</span>
                @endif
            </div>
        </div>
    </div>
</x-layout-admin>
