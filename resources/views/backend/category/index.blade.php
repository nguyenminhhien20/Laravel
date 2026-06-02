<x-layout-admin>
    <div class="content-wrapper space-y-6">
        <!-- Header Section -->
        <div class="bg-white border border-blue-200 rounded-2xl px-6 py-5 shadow-lg">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-blue-700">Quản lý Danh Mục</h2>
                <div class="flex gap-4">
                    <a href="{{ route('category.create') }}"
                       class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-xl shadow transition duration-300">
                        <i class="fa fa-plus text-lg"></i>
                        Thêm
                    </a>
                    <a href="{{ route('category.trash') }}"
                       class="flex items-center gap-2 bg-rose-600 hover:bg-rose-700 text-white font-semibold px-4 py-2 rounded-xl shadow transition duration-300">
                        <i class="fa fa-trash text-lg"></i>
                        Thùng Rác
                    </a>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden">
            <table class="min-w-full table-auto bg-gray-50 text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 text-center">
                        <th class="p-4 font-semibold">Hình ảnh</th>
                        <th class="p-4 font-semibold">Tên Danh Mục</th>
                        <th class="p-4 font-semibold">Chức Năng</th>
                        <th class="p-4 font-semibold">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr class="hover:bg-blue-50 transition duration-300">
                            <td class="p-3 border-t text-center">
                                <img src="{{ asset('assets/images/category/' . $item->image) }}"
                                     alt="{{ $item->image }}"
                                     class="h-14 w-14 object-cover rounded-lg shadow-md mx-auto">
                            </td>
                            <td class="p-3 border-t text-center text-gray-700">{{ $item->name }}</td>

                            <td class="p-3 border-t text-center space-x-2">
                                <a href="{{ route('category.status', ['category' => $item->id]) }}">
                                    @if ($item->status == 1)
                                        <i class="fa fa-toggle-on text-2xl text-green-500 hover:text-green-600 transition"></i>
                                    @else
                                        <i class="fa fa-toggle-off text-2xl text-rose-500 hover:text-rose-600 transition"></i>
                                    @endif
                                </a>
                                <a href="{{ route('category.show', ['category' => $item->id]) }}"
                                   class="text-orange-500 hover:text-orange-700 transition">
                                    <i class="fa fa-eye text-xl"></i>
                                </a>
                                <a href="{{ route('category.edit', ['category' => $item->id]) }}"
                                   class="text-blue-500 hover:text-blue-700 transition">
                                    <i class="fa fa-edit text-xl"></i>
                                </a>
                                <form action="{{ route('category.destroy', ['category' => $item->id]) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-600 text-xl"
                                        title="Xóa">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="p-3 border-t text-center text-gray-600">{{ $item->id ?? 'Không có ID' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Section -->
        <div class="flex justify-center pt-4">
            {{ $list->links() }}
        </div>
    </div>
</x-layout-admin>
