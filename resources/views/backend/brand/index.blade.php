<x-layout-admin>
    <div class="content-wrapper space-y-6">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-100 to-blue-50 border border-blue-200 rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl font-bold text-blue-700 flex items-center gap-2">
                    <i class="fa fa-tags text-blue-500"></i> Quản lý Thương Hiệu
                </h2>
                <div class="flex gap-4">
                    <a href="{{ route('brand.create') }}"
                       class="bg-blue-600 hover:bg-green-600 text-white px-5 py-2 rounded-full font-medium shadow transition-all duration-300 flex items-center gap-2">
                        <i class="fa fa-plus"></i> Thêm mới
                    </a>
                    <a href="{{ route('brand.trash') }}"
                       class="bg-rose-500 hover:bg-rose-600 text-white px-5 py-2 rounded-full font-medium shadow transition-all duration-300 flex items-center gap-2">
                        <i class="fa fa-trash"></i> Thùng rác
                    </a>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white border border-blue-200 rounded-2xl shadow p-6 overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-blue-100 text-gray-800 text-sm">
                    <tr>
                        <th class="px-5 py-3 text-center font-semibold">Hình ảnh</th>
                        <th class="px-5 py-3 text-center font-semibold">Tên thương hiệu</th>
                        <th class="px-5 py-3 text-center font-semibold">Chức năng</th>
                        <th class="px-5 py-3 text-center font-semibold">ID</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($list as $item)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-5 py-4 text-center">
                                <img src="{{ asset('assets/images/brand/' . $item->image) }}"
                                     alt="{{ $item->image }}"
                                     class="w-16 h-16 object-cover rounded-xl shadow-sm mx-auto">
                            </td>
                            <td class="px-5 py-4 text-center text-gray-800 font-medium text-base">
                                {{ $item->name }}
                            </td>
                            <td class="px-5 py-4 text-center">
                                <div class="flex justify-center items-center gap-3 text-xl">
                                    <!-- Status toggle -->
                                    <a href="{{ route('brand.status', ['brand' => $item->id]) }}" class="transition hover:scale-110">
                                        @if ($item->status == 1)
                                            <i class="fa fa-toggle-on text-green-500"></i>
                                        @else
                                            <i class="fa fa-toggle-off text-red-500"></i>
                                        @endif
                                    </a>

                                    <!-- Show -->
                                    <a href="{{ route('brand.show', ['brand' => $item->id]) }}"
                                       class="text-orange-500 hover:text-orange-700 transition hover:scale-110">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('brand.edit', ['brand' => $item->id]) }}"
                                       class="text-blue-500 hover:text-blue-700 transition hover:scale-110">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                     <form action="{{ route('brand.destroy', ['brand' => $item->id]) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-600 text-xl"
                                        title="Xóa">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-center text-sm text-gray-600">
                                {{ $item->id ?? 'Không có' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="text-center">
            {{ $list->links() }}
        </div>
    </div>
</x-layout-admin>
