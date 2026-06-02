<x-layout-admin>
    <div class="content-wrapper">
        <!-- Tiêu đề và quay lại -->
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">THÊM CONTACT</h2>
                <a href="{{ route('contact.index') }}" class="bg-gray-500 px-3 py-2 rounded-xl text-white hover:bg-gray-600">
                    <i class="fa fa-arrow-left"></i> Về danh sách
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="border border-blue-100 rounded-lg p-3 bg-white">
            <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-3 gap-6">
                    <!-- Cột trái -->
                    <div class="col-span-2">
                        <!-- Tên -->
                        <div class="mb-3">
                            <label for="name" class="font-semibold">Tên liên hệ</label>
                            <input value="{{ old('name') }}" type="text" name="name" id="name"
                                   placeholder="Nhập tên" class="w-full border border-gray-300 rounded-lg p-2">
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="font-semibold">Email</label>
                            <input value="{{ old('email') }}" type="email" name="email" id="email"
                                   placeholder="Nhập email" class="w-full border border-gray-300 rounded-lg p-2">
                            @error('email')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="font-semibold">Số điện thoại</label>
                            <input value="{{ old('phone') }}" type="text" name="phone" id="phone"
                                   placeholder="Nhập số điện thoại" class="w-full border border-gray-300 rounded-lg p-2">
                            @error('phone')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nội dung -->
                        <div class="mb-3">
                            <label for="content" class="font-semibold">Nội dung</label>
                            <textarea name="content" id="content" rows="4"
                                      class="w-full border border-gray-300 rounded-lg p-2">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Cột phải -->
                    <div class="col-span-1">
                        <!-- Tiêu đề -->
                        <div class="mb-3">
                            <label for="title" class="font-semibold">Tiêu đề</label>
                            <textarea name="title" id="title" rows="4"
                                      class="w-full border border-gray-300 rounded-lg p-2">{{ old('title') }}</textarea>
                            @error('title')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label for="status" class="font-semibold">Trạng thái</label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Xuất bản</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Không xuất bản</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Nút submit -->
                <div class="text-center mt-6">
                    <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white px-6 py-2 rounded-md">
                        <i class="fa fa-save mr-1"></i> Lưu liên hệ
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout-admin>
