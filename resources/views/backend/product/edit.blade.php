<x-layout-admin>
    <div class="content-wrapper">
        <!-- Tiêu đề và quay lại -->
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">SỬA SẢN PHẨM</h2>
                <a href="{{ route('product.index') }}" class="bg-gray-500 px-2 py-2 rounded-xl text-white">
                    <i class="fa fa-arrow-left"></i> Về danh sách
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="border border-blue-100 rounded-lg p-3">
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-3 gap-6">
                    <!-- Cột trái -->
                    <div class="col-span-2">
                        <!-- Tên sản phẩm -->
                        <div class="mb-3">
                            <label for="name"><strong>Tên sản phẩm</strong></label>
                            <input value="{{ old('name', $product->name) }}" type="text" name="name" id="name" placeholder="Nhập tên sản phẩm" class="w-full border border-gray-300 rounded-lg p-2">
                            @error('name')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Chi tiết -->
                        <div class="mb-3">
                            <label for="detail"><strong>Chi tiết sản phẩm</strong></label>
                            <textarea name="detail" id="detail" rows="4" class="w-full border border-gray-300 rounded-lg p-2">{{ old('detail', $product->detail) }}</textarea>
                            @error('detail')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label for="description"><strong>Mô tả</strong></label>
                            <textarea name="description" id="description" class="w-full border border-gray-300 rounded-lg p-2">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Giá bán - khuyến mãi - số lượng -->
                        <div class="flex justify-between gap-5">
                            <div class="mb-3 w-full">
                                <label for="price_root"><strong>Giá bán</strong></label>
                                <input type="number" step="0.01" name="price_root" id="price_root" value="{{ old('price_root', $product->price_root) }}" class="w-full border border-gray-300 rounded-lg p-2">
                                @error('price_root')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 w-full">
                                <label for="price_sale"><strong>Giá khuyến mãi</strong></label>
                                <input type="number" step="0.01" name="price_sale" id="price_sale" value="{{ old('price_sale', $product->price_sale) }}" class="w-full border border-gray-300 rounded-lg p-2">
                                @error('price_sale')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 w-full">
                                <label for="qty"><strong>Số lượng</strong></label>
                                <input type="number" min="1" name="qty" id="qty" value="{{ old('qty', $product->qty) }}" class="w-full border border-gray-300 rounded-lg p-2">
                                @error('qty')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Cột phải -->
                    <div class="col-span-1">
                        <!-- Danh mục -->
                        <div class="mb-3">
                            <label for="category_id"><strong>Danh mục</strong></label>
                            <select name="category_id" id="category_id" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="">Chọn danh mục</option>
                                @foreach ($list_category as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Thương hiệu -->
                        <div class="mb-3">
                            <label for="brand_id"><strong>Thương hiệu</strong></label>
                            <select name="brand_id" id="brand_id" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="">Chọn thương hiệu</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Ảnh sản phẩm -->
                        <div class="mb-3">
                            <label for="thumbnail"><strong>Hình</strong></label>
                            @if ($product->thumbnail)
                                <div class="mb-2">
                                    <img src="{{ asset('assets/images/product/' . $product->thumbnail) }}" alt="Ảnh hiện tại" class="w-24 rounded">
                                </div>
                            @endif
                            <input type="file" name="thumbnail" id="thumbnail" class="w-full border border-gray-300 rounded-lg p-2">
                            @error('thumbnail')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label for="status"><strong>Trạng thái</strong></label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Xuất bản</option>
                                <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Không xuất bản</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Nút submit -->
                <div class="text-center mt-4">
                    <button type="submit" class="bg-rose-500 text-white px-4 py-2 rounded-md">
                        <i class="fa fa-save mr-1"></i> Cập nhật sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout-admin>
