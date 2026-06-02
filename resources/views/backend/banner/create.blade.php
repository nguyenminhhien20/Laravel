<x-layout-admin>
    <div class="content-wrapper">
        <!-- Tiêu đề và quay lại -->
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">THÊM BANNER</h2>
                <a href="{{ route('banner.index') }}" class="bg-gray-500 px-3 py-2 rounded-xl text-white">
                    <i class="fa fa-arrow-left"></i> Về danh sách
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="border border-blue-100 rounded-lg p-3">
            <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-3 gap-6">
                    <!-- Cột trái -->
                    <div class="col-span-2">
                        <!-- Tên -->
                        <div class="mb-3">
                            <label for="name"><strong>Tên Banner</strong></label>
                            <input value="{{ old('name') }}" type="text" name="name" id="name" placeholder="Nhập tên banner"
                                   class="w-full border border-gray-300 rounded-lg p-2">
                                   @if($errors->has('name'))
                                <div class="text-red-500">{{$errors->first('name')}}</div>
                            @endif
                        </div>

                        <!-- Link -->
                        {{-- <div class="mb-3">
                            <label for="link"><strong>Liên kết</strong></label>
                            <input value="{{ old('link') }}" type="text" name="link" id="link" placeholder="https://..."
                                   class="w-full border border-gray-300 rounded-lg p-2">
                                   @if($errors->has('link'))
                                   <div class="text-red-500">{{$errors->first('link')}}</div>
                               @endif
                        </div> --}}

                        <div class="mb-3">
                            <label for="position"><strong>Vị trí</strong></label>
                            <input type="text" name="position" id="position" value="{{ old('position') }}"
                                   class="w-full border border-gray-300 rounded-lg p-2">
                            @if($errors->has('position'))
                                <div class="text-red-500">{{ $errors->first('position') }}</div>
                            @endif
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label for="description"><strong>Mô tả</strong></label>
                            <textarea name="description" id="description" rows="4"
                                      class="w-full border  border-gray-300  rounded-lg p-2">{{ old('description') }}</textarea>
                                      @if($errors->has('description'))
                                      <div class="text-red-500">{{$errors->first('description')}}</div>
                                  @endif
                        </div>
                    </div>

                    <!-- Cột phải -->
                    <div class="col-span-1">
                        <!-- Hình ảnh -->
                        <div class="mb-3">
                            <label for="image">
                                <strong>Hình</strong>
                            </label>
                            <input type="file" class="w-full border border-gray-300 rounded-lg p-2" name="image" id="image">
                            @if($errors->has('image'))
                            <div class="text-red-500">{{$errors->first('image')}}</div>
                        @endif
                        </div>

                        <!-- Sắp xếp -->
                        <div class="mb-3">
                            <label for="sort_order"><strong>Thứ tự hiển thị</strong></label>
                            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                                   class="w-full border border-gray-300 rounded-lg p-2">
                                   @if($errors->has('sort_order'))
                                   <div class="text-red-500">{{$errors->first('sort_order')}}</div>
                               @endif
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label for="status"><strong>Trạng thái</strong></label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                            @if($errors->has('status'))
                            <div class="text-red-500">{{$errors->first('status')}}</div>
                        @endif
                        </div>
                    </div>
                </div>

                <!-- Nút lưu -->
                <div class="text-center mt-4">
                    <button type="submit" class="bg-rose-600 text-white px-4 py-2 rounded-md">
                        <i class="fa fa-save mr-1"></i> Lưu banner
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout-admin>
