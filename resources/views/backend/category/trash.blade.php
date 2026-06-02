<x-layout-admin>
    <div class="content-wrapper space-y-6">
        <!-- Header Section -->
        <div class="flex items-center justify-between bg-blue-50 border border-blue-200 rounded-xl px-6 py-4 shadow-sm">
            <h2 class="text-xl font-bold text-blue-600 tracking-wide uppercase">
                Danh Mục Đã Xoá (Thùng Rác)
            </h2>
            <a href="{{ route('category.index') }}"
               class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg shadow transition duration-300">
                <i class="fa fa-arrow-left"></i>
                <span>Về danh sách</span>
            </a>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-md overflow-x-auto">
            <table class="min-w-full text-sm table-auto">
                <thead class="bg-blue-100 text-blue-700">
                    <tr class="text-center uppercase tracking-wide font-semibold text-sm">
                        <th class="p-4">Hình ảnh</th>
                        <th class="p-4">Tên danh mục</th>
                        <th class="p-4">Chức năng</th>
                        <th class="p-4">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $item)
                        <tr class="text-center hover:bg-blue-50 transition duration-200">
                            <td class="p-3 border-t">
                                <img src="{{ asset('assets/images/category/' . $item->image) }}"
                                     alt="{{ $item->image }}"
                                     class="w-14 h-14 object-cover rounded-md shadow-sm mx-auto">
                            </td>
                            <td class="p-3 border-t font-medium text-gray-800">{{ $item->name }}</td>
                            <td class="p-3 border-t">
                                <div class="flex justify-center gap-4">
                                    <!-- Khôi phục -->
                                    <a href="{{ route('category.restore', ['category' => $item->id]) }}"
                                       class="text-green-600 hover:text-green-800 transition" title="Khôi phục">
                                        <i class="fa fa-undo text-lg"></i>
                                    </a>
                                    <!-- Xoá vĩnh viễn -->
                                     <form action="{{ route('category.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Xóa vĩnh viễn</button>
                                </form>
                                </div>
                            </td>
                            <td class="p-3 border-t text-gray-600">{{ $item->id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-5 text-center text-gray-500 italic">
                                Không có danh mục nào trong thùng rác.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pt-4 flex justify-center">
            {{ $list->links() }}
        </div>
    </div>
</x-layout-admin>
