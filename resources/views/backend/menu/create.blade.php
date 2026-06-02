<x-layout-admin>
    <div class="content-wrapper">
        <!-- Tiêu đề và quay lại -->
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-blue-600">THÊM MENU</h2>
                </div>
                <div class="text-right">
                    <a href="{{ route('menu.index') }}" class="bg-gray-500 px-4 py-2 rounded-xl mx-1 text-white flex items-center justify-center">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="border border-blue-100 rounded-lg p-4">
            <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-3 gap-6">
                    <!-- Cột trái -->
                    <div class="col-span-2">
                        <!-- Tên menu -->
                        <div class="mb-3">
                            <label for="name">
                                <strong>Tên menu</strong>
                            </label>
                            <input value="{{ old('name') }}" type="text" name="name" id="name" placeholder="Nhập tên menu" class="w-full border border-gray-300 rounded-lg p-2">
                            @if($errors->has('name'))
                                <div class="text-red-500 text-sm">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <!-- Link -->
                        <div class="mb-3">
                            <label for="link">
                                <strong>Liên kết</strong>
                            </label>
                            <input value="{{ old('link') }}" type="text" name="link" id="link" placeholder="Nhập Liên Kết" class="w-full border border-gray-300 rounded-lg p-2">
                            @if($errors->has('link'))
                                <div class="text-red-500 text-sm">{{ $errors->first('link') }}</div>
                            @endif
                        </div>

                        <!-- Loại menu -->
                        <div class="mb-3">
                            <label for="type"><strong>Loại menu</strong></label>
                            <select name="type" id="type" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="custom" {{ old('type') == 'custom' ? 'selected' : '' }}>Tùy chỉnh</option>
                                <option value="category" {{ old('type') == 'category' ? 'selected' : '' }}>Danh mục</option>
                                <option value="page" {{ old('type') == 'page' ? 'selected' : '' }}>Trang</option>
                            </select>
                            @if($errors->has('type'))
                                <div class="text-red-500 text-sm">{{ $errors->first('type') }}</div>
                            @endif
                        </div>
                    </div>

                    <!-- Cột phải -->
                    <div class="col-span-1">
                        <!-- Vị trí hiển thị -->
                        <div class="mb-3">
                            <label for="position" class="font-semibold">Vị Trí</label>
                            <input value="{{ old('position') }}" type="number" name="position" id="position"
                            placeholder="Nhập Vị trí" class="w-full border border-gray-300 rounded-lg p-2">
                            @error('position')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label for="status"><strong>Trạng thái</strong></label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Xuất bản</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Không xuất bản</option>
                            </select>
                            @if($errors->has('status'))
                                <div class="text-red-500 text-sm">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Nút submit -->
                <div class="text-center mt-4">
                    <button type="submit" class="bg-rose-500 text-white px-6 py-2 rounded-md hover:bg-rose-600 transition duration-300">
                        <i class="fa fa-save mr-1"></i> Lưu menu
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout-admin>
