<x-layout-admin>
    <div class="content-wrapper">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">Chi tiết danh mục</h2>
                <a href="{{ route('category.index') }}" class="bg-gray-500 px-2 py-2 rounded-xl mx-1 text-white">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách danh mục
                </a>
            </div>
        </div>

        @if($category)
        <div class="border border-blue-100 rounded-lg p-3">
            <div class="mb-3">
                <strong>Tên danh mục:</strong> {{ $category->name }}
            </div>
            <div class="mb-3">
                <strong>Slug:</strong> {{ $category->slug }}
            </div>
            <div class="mb-3">
                <strong>Mô tả:</strong> {{ $category->description }}
            </div>
            <div class="mb-3">
                <strong>Trạng thái:</strong> {{ $category->status == 1 ? 'Xuất bản' : 'Không xuất bản' }}
            </div>
            <div class="mb-3">
                <strong>Ảnh đại diện:</strong>
                @if ($category->image)
                    <img src="{{ asset('assets/images/category/' . $category->image) }}" alt="Image" class="w-32 h-32 object-cover rounded-lg">
                @else
                    <span>Không có ảnh đại diện</span>
                @endif
            </div>
        </div>
        @else
        <div class="alert alert-danger">
            Danh mục không tồn tại.
        </div>
        @endif
    </div>
</x-layout-admin>
