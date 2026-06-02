<x-layout-admin>
    <div class="content-wrapper">
        <!-- Tiêu đề và quay lại -->
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-blue-600">SỬA THƯƠNG HIỆU</h2>
                </div>
                <div class="text-right">
                    <a href="{{ route('brand.index') }}" class="bg-gray-500 px-2 py-2 rounded-xl mx-1 text-white">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Về danh sách
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="border border-blue-100 rounded-lg p-3">
            <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-3 gap-6">
                    <!-- Cột trái -->
                    <div class="col-span-2">
                        <!-- Tên thương hiệu -->
                        <div class="mb-3">
                            <label for="name">
                                <strong>Tên thương hiệu</strong>
                            </label>
                            <input value="{{ old('name', $brand->name) }}" type="text" name="name" id="name" placeholder="Nhập tên thương hiệu" class="w-full border border-gray-300 rounded-lg p-2">
                            @if($errors->has('name'))
                                <div class="text-red-500">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label for="description"><strong>Mô tả</strong></label>
                            <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded-lg p-2">{{ old('description', $brand->description) }}</textarea>
                            @if($errors->has('description'))
                                <div class="text-red-500">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
                    </div>

                    <!-- Cột phải -->
                    <div class="col-span-1">
                        <!-- Hình -->
                        <div class="mb-3">
                            <label for="image">
                                <strong>Hình</strong>
                            </label>
                            <input type="file" class="w-full border border-gray-300 rounded-lg p-2" name="image" id="image">
                            @if($errors->has('image'))
                                <div class="text-red-500">{{ $errors->first('image') }}</div>
                            @endif

                            @if($brand->image)
                                <div class="mt-2">
                                    <img src="{{ asset('assets/images/brand/' . $brand->image) }}" alt="Hình hiện tại" class="h-24 object-cover border rounded">
                                </div>
                            @endif
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label for="status">
                                <strong>Trạng thái</strong>
                            </label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="1" {{ old('status', $brand->status) == 1 ? 'selected' : '' }}>Xuất bản</option>
                                <option value="0" {{ old('status', $brand->status) == 0 ? 'selected' : '' }}>Không xuất bản</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Nút submit -->
                <div class="text-center mt-4">
                    <button type="submit" class="bg-rose-500 text-white px-4 py-2 rounded-md">
                        <i class="fa fa-save mr-1"></i> Cập nhật thương hiệu
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout-admin>
