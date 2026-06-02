<x-layout-admin>
    <div class="content-wrapper">
        <!-- Tiêu đề và quay lại -->
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-blue-600">CHI TIẾT MENU</h2>
                </div>
                <div class="text-right">
                    <a href="{{ route('menu.index') }}" class="bg-gray-500 px-4 py-2 rounded-xl mx-1 text-white flex items-center justify-center">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách
                    </a>
                </div>
            </div>
        </div>

        <!-- Hiển thị thông tin menu -->
        <div class="border border-blue-100 rounded-lg p-4">
            <div class="grid grid-cols-3 gap-6">
                <!-- Cột trái -->
                <div class="col-span-2">
                    <!-- Tên menu -->
                    <div class="mb-3">
                        <label for="name"><strong>Tên menu</strong></label>
                        <p>{{ $menu->name }}</p>
                    </div>

                    <!-- Link -->
                    <div class="mb-3">
                        <label for="link"><strong>Liên kết</strong></label>
                        <p>{{ $menu->link }}</p>
                    </div>

                    <!-- Loại menu -->
                    <div class="mb-3">
                        <label for="type"><strong>Loại menu</strong></label>
                        <p>{{ ucfirst($menu->type) }}</p>
                    </div>
                </div>

                <!-- Cột phải -->
                <div class="col-span-1">
                    <!-- Vị trí hiển thị -->
                    <div class="mb-3">
                        <label for="position" class="font-semibold">Vị trí</label>
                        <p>{{ $menu->position }}</p>
                    </div>

                    <!-- Trạng thái -->
                    <div class="mb-3">
                        <label for="status"><strong>Trạng thái</strong></label>
                        <p>{{ $menu->status == 1 ? 'Xuất bản' : 'Không xuất bản' }}</p>
                    </div>
                </div>
            </div>

            <!-- Nút quay lại -->
            <div class="text-center mt-4">
                <a href="{{ route('menu.index') }}" class="bg-rose-500 text-white px-6 py-2 rounded-md hover:bg-rose-600 transition duration-300">
                    <i class="fa fa-arrow-left mr-1"></i> Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</x-layout-admin>
