<x-layout-admin>
    <div class="content-wrapper">
        <!-- Tiêu đề và quay lại -->
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">THÊM USER</h2>
                <a href="{{ route('user.index') }}" class="bg-gray-500 px-2 py-2 rounded-xl mx-1 text-white">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="border border-blue-100 rounded-lg p-3">
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-3 gap-6">
                    <!-- Cột trái -->
                    <div class="col-span-2">
                        <!-- Tên user -->
                        <div class="mb-3">
                            <label for="name"><strong>Tên user</strong></label>
                            <input value="{{ old('name') }}" type="text" name="name" id="name" placeholder="Nhập tên user" class="w-full border border-gray-300 rounded-lg p-2" required>
                            @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email"><strong>Email</strong></label>
                            <input value="{{ old('email') }}" type="email" name="email" id="email" placeholder="Nhập email" class="w-full border border-gray-300 rounded-lg p-2" required>
                            @error('email') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>

                        <!-- Số điện thoại -->
                        <div class="mb-3">
                            <label for="phone"><strong>Số điện thoại</strong></label>
                            <input value="{{ old('phone') }}" type="text" name="phone" id="phone" placeholder="Nhập số điện thoại" class="w-full border border-gray-300 rounded-lg p-2" required>
                            @error('phone') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>

                        <!-- Địa chỉ -->
                        <div class="mb-3">
                            <label for="address"><strong>Địa chỉ</strong></label>
                            <input value="{{ old('address') }}" type="text" name="address" id="address" placeholder="Nhập địa chỉ" class="w-full border border-gray-300 rounded-lg p-2" required>
                            @error('address') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>

                        <!-- Tên người dùng -->
                        <div class="mb-3">
                            <label for="username"><strong>Tên người dùng</strong></label>
                            <input value="{{ old('username') }}" type="text" name="username" id="username" placeholder="Nhập tên người dùng" class="w-full border border-gray-300 rounded-lg p-2" required>
                            @error('username') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>

                        <!-- Mật khẩu -->
                        <div class="mb-3">
                            <label for="password"><strong>Mật khẩu</strong></label>
                            <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" class="w-full border border-gray-300 rounded-lg p-2" required>
                            @error('password') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Cột phải -->
                    <div class="col-span-1">
                        <!-- Avatar -->
                        <div class="mb-3">
                            <label for="avatar"><strong>Hình đại diện</strong></label>
                            <input type="file" name="avatar" id="avatar" class="w-full border border-gray-300 rounded-lg p-2">
                            @error('avatar') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label for="status"><strong>Trạng thái</strong></label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2" required>
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Xuất bản</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Không xuất bản</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Nút submit -->
                <div class="text-center mt-4">
                    <button type="submit" class="bg-rose-500 text-white px-4 py-2 rounded-md">
                        <i class="fa fa-save mr-1"></i> Lưu người dùng
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout-admin>
