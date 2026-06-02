<x-layout-admin>
    <div class="content-wrapper">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">Chi tiết thương hiệu</h2>
                <a href="{{ route('brand.index') }}" class="bg-gray-500 px-2 py-2 rounded-xl mx-1 text-white">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách thương hiệu
                </a>
            </div>
        </div>

        @if($brand)
        <div class="border border-blue-100 rounded-lg p-3">
            <div class="mb-3">
                <strong>Tên thương hiệu:</strong> {{ $brand->name }}
            </div>
            <div class="mb-3">
                <strong>Slug:</strong> {{ $brand->slug }}
            </div>
            <div class="mb-3">
                <strong>Mô tả:</strong> {{ $brand->description }}
            </div>
            <div class="mb-3">
                <strong>Trạng thái:</strong> {{ $brand->status == 1 ? 'Xuất bản' : 'Không xuất bản' }}
            </div>
            <div class="mb-3">
                <strong>Ảnh logo:</strong>
                @if ($brand->image)
                <img src="{{ asset('assets/images/brand/' . $brand->image) }}" alt="Image" class="w-32 h-32 object-cover rounded-lg">
                @else
                    <span>Không có logo</span>
                @endif
            </div>
        </div>
        @else
        <div class="alert alert-danger">
            Thương hiệu không tồn tại.
        </div>
        @endif
    </div>
</x-layout-admin>
