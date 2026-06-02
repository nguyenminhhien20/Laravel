<x-layout-admin>
    <div class="content-wrapper space-y-6">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-100 to-blue-50 border border-blue-200 rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl font-bold text-blue-700 flex items-center gap-2">
                    <i class="fa fa-trash text-blue-500"></i> Danh sách Thương Hiệu đã xóa
                </h2>
                <a href="{{ route('brand.index') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-full flex items-center gap-2 transition-all shadow">
                    <i class="fa fa-arrow-left"></i> Về danh sách
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white border border-blue-100 rounded-2xl shadow p-6 overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-blue-100 text-gray-800 text-sm">
                    <tr>
                        <th class="px-5 py-3 text-center font-semibold">Hình ảnh</th>
                        <th class="px-5 py-3 text-center font-semibold">Tên thương hiệu</th>
                        <th class="px-5 py-3 text-center font-semibold">Mô tả</th>
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
                                     class="w-16 h-16 object-cover rounded-xl shadow mx-auto">
                            </td>
                            <td class="px-5 py-4 text-center font-medium text-gray-800">{{ $item->name }}</td>
                            <td class="px-5 py-4 text-center text-gray-600 text-sm">{{ $item->description }}</td>
                            <td class="px-5 py-4 text-center">
                                <div class="flex justify-center gap-4 text-xl">
                                    <!-- Khôi phục -->
                                    <a href="{{ route('brand.restore', ['brand' => $item->id]) }}"
                                       class="text-green-500 hover:text-green-700 transition hover:scale-110"
                                       title="Khôi phục">
                                        <i class="fa fa-rotate-left"></i>
                                    </a>

                                    <!-- Xóa vĩnh viễn -->
                                   <form action="{{ route('brand.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Xóa vĩnh viễn</button>
                                </form>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-center text-gray-700 text-sm">{{ $item->id ?? 'Không có ID' }}</td>
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
