<x-layout-admin>
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-100 to-blue-200 mb-6 px-6 py-4 rounded-2xl shadow-md flex justify-between items-center">
            <h2 class="text-3xl font-bold text-blue-700 flex items-center gap-2">
                <i class="fa fa-trash text-blue-500"></i> THÙNG RÁC
            </h2>
            <a href="{{ route('menu.index') }}"
               class="bg-gray-600 text-white px-4 py-2 rounded-xl flex items-center gap-2 shadow hover:bg-gray-700 transition">
                <i class="fa fa-arrow-left"></i> Về danh sách
            </a>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl shadow-xl p-6 overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-blue-50 text-blue-700 text-sm font-semibold uppercase tracking-wider">
                        <th class="p-4 text-center">Tên</th>
                        <th class="p-4 text-center">Liên kết</th>
                        <th class="p-4 text-center">Kiểu</th>
                        <th class="p-4 text-center">Vị trí</th>
                        <th class="p-4 text-center">Chức năng</th>
                        <th class="p-4 text-center">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $item)
                        <tr class="text-center hover:bg-blue-50 transition duration-200 {{ $loop->even ? 'bg-gray-50' : '' }}">
                            <td class="p-4 font-medium text-gray-800">{{ $item->name }}</td>
                            <td class="p-4 text-sm text-blue-600 break-words">{{ $item->link }}</td>
                            <td class="p-4 text-sm text-gray-700 capitalize">{{ $item->type }}</td>
                            <td class="p-4 text-sm text-gray-700 capitalize">{{ $item->position }}</td>
                            <td class="p-4">
                                <div class="flex justify-center gap-3">
                                    <!-- Khôi phục -->
                                    <a href="{{ route('menu.restore', ['menu' => $item->id]) }}"
                                       class="text-green-500 hover:text-green-700 transition" title="Khôi phục">
                                        <i class="fa fa-rotate-left text-xl"></i>
                                    </a>
                                    <!-- Xóa vĩnh viễn -->
                                   <form action="{{ route('menu.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Xóa vĩnh viễn</button>
                                </form>
                                </div>
                            </td>
                            <td class="p-4 text-sm text-gray-500">{{ $item->id ?? 'Không có' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500 italic">
                                Không có mục nào trong thùng rác.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $list->links() }}
        </div>
    </div>
</x-layout-admin>
