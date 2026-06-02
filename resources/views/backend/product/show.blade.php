<x-layout-admin>
    <div class="content-wrapper">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">Chi tiết sản phẩm</h2>
                <a href="{{ route('product.index') }}" class="bg-gray-500 px-2 py-2 rounded-xl mx-1 text-white hover:bg-gray-600 transition">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách sản phẩm
                </a>
            </div>
        </div>

        @if(isset($product) && !empty($product))
            <div class="border border-blue-100 rounded-lg p-3 space-y-3">
                <div>
                    <strong>Tên sản phẩm:</strong> {{ $product->name ?? 'Không có' }}
                </div>
                <div>
                    <strong>Slug:</strong> {{ $product->slug ?? 'Không có' }}
                </div>
                <div>
                    <strong>Chi tiết:</strong> {{ $product->detail ?? 'Không có' }}
                </div>
                <div>
                    <strong>Mô tả:</strong> {{ $product->description ?? 'Không có' }}
                </div>
                <div>
                    <strong>Thương hiệu:</strong> {{ $product->brand->name ?? 'Không có' }}
                </div>
                <div>
                    <strong>Danh mục:</strong> {{ $product->category->name ?? 'Không có' }}
                </div>
                <div>
                    <strong>Giá gốc:</strong> {{ number_format($product->price_root ?? 0, 0, ',', '.') }} VNĐ
                </div>
                <div>
                    <strong>Giá bán:</strong> {{ number_format($product->price_sale ?? 0, 0, ',', '.') }} VNĐ
                </div>
                <div>
                    <strong>Số lượng:</strong> {{ $product->qty ?? 0 }}
                </div>
                <div>
                    <strong>Trạng thái:</strong>
                    @if($product->status == 1)
                        <span class="text-green-600 font-semibold">Xuất bản</span>
                    @else
                        <span class="text-red-600 font-semibold">Không xuất bản</span>
                    @endif
                </div>
                <div>
                    <strong>Ảnh đại diện:</strong>
                    @if (!empty($product->thumbnail) && file_exists(public_path('assets/images/product/' . $product->thumbnail)))
                        <img src="{{ asset('assets/images/product/' . $product->thumbnail) }}" alt="Thumbnail" class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                    @else
                        <span>Không có ảnh đại diện</span>
                    @endif
                </div>
            </div>
        @else
            <div class="p-4 bg-red-100 text-red-700 rounded-lg">
                Sản phẩm không tồn tại.
            </div>
        @endif
    </div>
</x-layout-admin>
