<x-layout-admin>
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="bg-blue-100 mb-6 rounded-xl px-6 py-4 shadow flex items-center justify-between">
            <h2 class="text-2xl font-bold text-blue-700">📋 Quản lý Menu</h2>
            <div class="flex gap-3">
                <a href="{{ route('menu.create') }}"
                   class="bg-blue-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl flex items-center gap-2 shadow transition-all duration-300 hover:scale-105">
                    <i class="fa fa-plus"></i> Thêm
                </a>
                <a href="{{ route('menu.trash') }}"
                   class="bg-rose-500 hover:bg-rose-600 text-white px-4 py-2 rounded-xl flex items-center gap-2 shadow transition-all duration-300 hover:scale-105">
                    <i class="fa fa-trash"></i> Thùng rác
                </a>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-blue-50 text-blue-700 uppercase text-sm font-semibold">
                        <th class="p-4 text-center">Tên</th>
                        <th class="p-4 text-center">Liên kết</th>
                        <th class="p-4 text-center">Kiểu</th>
                        <th class="p-4 text-center">Vị trí</th>
                        <th class="p-4 text-center">Chức năng</th>
                        <th class="p-4 text-center">ID</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($list as $item)
                        <tr class="text-center hover:bg-gray-50 transition">
                            <td class="p-4 font-medium">{{ $item->name }}</td>
                            <td class="p-4 text-sm text-blue-600 break-all">{{ $item->link }}</td>
                            <td class="p-4 text-sm">{{ ucfirst($item->type) }}</td>
                            <td class="p-4 text-sm">{{ ucfirst($item->position) }}</td>
                            <td class="p-4 text-sm">
                                <div class="flex justify-center items-center gap-3">
                                    <!-- Trạng thái -->
                                    <a href="{{ route('menu.status', ['menu' => $item->id]) }}" title="Đổi trạng thái"
                                       class="text-2xl transition hover:scale-110">
                                        <i class="fa {{ $item->status == 1 ? 'fa-toggle-on text-green-500' : 'fa-toggle-off text-red-500' }}"></i>
                                    </a>
                                    <!-- Xem -->
                                    <a href="{{ route('menu.show', ['menu' => $item->id]) }}"
                                       class="text-orange-500 hover:text-orange-700 transition" title="Xem chi tiết">
                                        <i class="fa fa-eye text-xl"></i>
                                    </a>
                                    <!-- Sửa -->
                                    <a href="{{ route('menu.edit', ['menu' => $item->id]) }}"
                                       class="text-blue-500 hover:text-blue-700 transition" title="Chỉnh sửa">
                                        <i class="fa fa-edit text-xl"></i>
                                    </a>
                                    <!-- Xóa -->
                                    <form action="{{ route('menu.destroy', ['menu' => $item->id]) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa menu này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-600 text-xl"
                                        title="Xóa">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                </div>
                            </td>
                            <td class="p-4 text-sm text-gray-500">{{ $item->id ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $list->links() }}
        </div>
    </div>
</x-layout-admin>
