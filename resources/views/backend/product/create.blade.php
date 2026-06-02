<x-layout-admin>
    <div class="content-wrapper">
        <!-- Tiêu đề và quay lại -->
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-blue-600">THÊM SẢN PHẨM</h2>
                </div>
                <div class="text-right">
                    <a href="{{ route('product.index') }}" class="bg-gray-500 px-2 py-2 rounded-xl mx-1 text-white">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Về danh sách
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="border border-blue-100 rounded-lg p-3">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-3 gap-6">
                    <!-- Cột trái -->
                    <div class="col-span-2">
                        <!-- Tên sản phẩm -->
                        <div class="mb-3">
                            <label for="name">
                                <strong>Tên sản phẩm</strong>
                            </label>
                            <input value="{{old('name')}}" type="text" name="name" id="name" placeholder="Nhập tên sản phẩm" class="w-full border border-gray-300 rounded-lg p-2">
                            @if($errors->has('name'))
                            <div class="text-red-500">{{$errors->first('name')}}</div>
                            @endif
                        </div>

                        <!-- Chi tiết -->
                        <div class="mb-3">
                            <label for="detail"><strong>Chi tiết sản phẩm</strong></label>
                            <textarea name="detail" id="detail" rows="4" class="w-full border border-gray-300 rounded-lg p-2"></textarea>
                            @if($errors->has('detail'))
                            <div class="text-red-500">{{$errors->first('detail')}}</div>
                            @endif
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label for="description"><strong>Mô tả</strong></label>
                            <textarea name="description" id="description" class="w-full border border-gray-300 rounded-lg p-2"></textarea>
                            @if($errors->has('description'))
                            <div class="text-red-500">{{$errors->first('description')}}</div>
                            @endif
                        </div>

                        <!-- Giá bán - khuyến mãi - số lượng -->
                        <div class="flex justify-between gap-5">
                            <div class="mb-3">
                                <label for="price_root"><strong>Giá bán</strong></label>
                                <textarea name="price_root" id="price_root" rows="1" class="w-full border border-gray-300 rounded-lg p-2"></textarea>
                                @if($errors->has('price_root'))
                                <div class="text-red-500">{{$errors->first('price_root')}}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="price_sale"><strong>Giá khuyến mãi</strong></label>
                                <textarea name="price_sale" id="price_sale" rows="1" class="w-full border border-gray-300 rounded-lg p-2"></textarea>
                                @if($errors->has('price_sale'))
                                <div class="text-red-500">{{$errors->first('price_sale')}}</div>
                            @endif
                            </div>

                            <div class="mb-3">
                                <label for="qty"><strong>Số lượng</strong></label>
                                <input type="number" value="{{old('qty',20)}}" name="qty" id="qty" min="1" value="1" class="w-full border border-gray-300 rounded-lg p-2">
                                @if($errors->has('qty'))
                                <div class="text-red-500">{{$errors->first('qty')}}</div>
                            @endif
                            </div>
                        </div>
                    </div>

                    <!-- Cột phải -->
                    <div class="col-span-1">
                        <!-- Danh mục -->
                        <div class="mb-3">
                            <label id="category_id">
                                <strong>Danh mục</strong>
                            </label>
                            <select name="category_id" id="category_id" class="w-full border border-gray-300 rounded-lg">
                                <option value="">Chọn danh mục</option>
                                @foreach ($list_category as $category)
                                    @if (old('category_id') == $category->id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @if ($errors->has('category_id'))
                                <div class="text-red-600">
                                    {{ $errors->first('category_id') }}
                                </div>
                            @endif
                        </div>

                        <!-- Thương hiệu -->
                        <div class="mb-3">
                            <label id="brand_id">
                                <strong>Thương hiệu</strong>
                            </label>
                            <select name="brand_id" id="brand_id" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="">Chọn thương hiệu</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                            </select>
                           @if($errors->has('brand_id'))
                            <div class="text-red-500">{{$errors->first('brand_id')}}</div>
                        @endif
                        </div>

                        <div class="mb-3">
                            <label id="thumbnail">
                                <strong>Hình</strong>
                            </label>
                            <input type="file" class="w-full border border-gray-300 rounded-lg p-2" name="thumbnail" id="thumbnail">
                            @if($errors->has('thumbnail'))
                            <div class="text-red-500">{{$errors->first('thumbnail')}}</div>
                        @endif
                        </div>

                        <div class="mb-3">
                            <label id="status">
                                <strong>Trạng thái</strong>
                            </label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="1">Xuất bản</option>
                                <option value="0">Không xuất bản</option>
                            </select>

                        </div>

                    </div>
                </div>

                <!-- Nút submit -->
                <div class="text-center mt-4">
                    <button type="submit" class="bg-rose-500 text-white px-4 py-2 rounded-md">
                        <i class="fa fa-save mr-1"></i> Lưu sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout-admin>
