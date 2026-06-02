<x-layout-admin>
    <div class="content-wrapper">
        <!-- Tiêu đề và quay lại -->
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">THÊM ORDER</h2>
                <a href="{{ route('order.index') }}" class="bg-gray-500 px-2 py-2 rounded-xl text-white">
                    <i class="fa fa-arrow-left"></i> Về danh sách
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="border border-blue-100 rounded-lg p-3">
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-3 gap-6">
                    <!-- Cột trái -->
                    <div class="col-span-2">
                        <!-- Tên đơn -->
                        <div class="mb-3">
                            <label for="name" class="font-semibold">Tên đơn</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                placeholder="Nhập tên đơn" class="w-full border border-gray-300 rounded-lg p-2">
                            @error('name')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Số điện thoại -->
                        <div class="mb-3">
                            <label for="phone" class="font-semibold">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                placeholder="Số điện thoại" class="w-full border border-gray-300 rounded-lg p-2">
                            @error('phone')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="font-semibold">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                placeholder="Email" class="w-full border border-gray-300 rounded-lg p-2">
                            @error('email')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Cột phải -->
                    <div class="col-span-1">
                        <!-- Địa chỉ -->
                        <div class="mb-3">
                            <label for="address" class="font-semibold">Địa chỉ</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}"
                                placeholder="Địa chỉ" class="w-full border border-gray-300 rounded-lg p-2">
                            @error('address')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Người dùng -->
                        <div class="mb-3">
                            <label for="user_id" class="font-semibold">Người dùng</label>
                            <select name="user_id" id="user_id" class="w-full border border-gray-300 rounded-lg p-2">
                                @foreach ($list_user as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label for="status" class="font-semibold">Trạng thái</label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý
                                </option>
                                <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Đang
                                    xử lý</option>
                                <option value="shipped" {{ old('status') == 'shipped' ? 'selected' : '' }}>Đang giao
                                    hàng</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Hoàn
                                    thành</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy
                                </option>
                            </select>
                            @error('status')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Ghi chú (nếu cần) -->
                <div class="mb-3">
                    <label for="note" class="font-semibold">Ghi chú</label>
                    <textarea name="note" id="note" placeholder="Ghi chú đơn hàng"
                        class="w-full border border-gray-300 rounded-lg p-2">{{ old('note') }}</textarea>
                    @error('note')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nút submit -->
                <div class="text-center mt-4">
                    <button type="submit" class="bg-rose-500 text-white px-4 py-2 rounded-md">
                        <i class="fa fa-save mr-1"></i> Lưu đơn hàng
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout-admin>
