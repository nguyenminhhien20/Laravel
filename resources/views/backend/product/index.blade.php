<x-layout-admin>
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="bg-white border border-blue-200 mb-6 rounded-xl shadow px-6 py-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-blue-600 flex items-center gap-2">
                    <i class="fa fa-box"></i>
                    Quản lý Sản Phẩm
                </h2>
                <div class="flex gap-3">
                    <a href="{{ route('product.create') }}"
                        class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded-lg shadow transition duration-300">
                        <i class="fa fa-plus"></i> Thêm
                    </a>
                    <a href="{{ route('product.trash') }}"
                        class="flex items-center gap-2 bg-rose-500 hover:bg-rose-600 text-white font-medium px-4 py-2 rounded-lg shadow transition duration-300">
                        <i class="fa fa-trash"></i> Thùng Rác
                    </a>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white border border-blue-200 rounded-xl shadow px-6 py-4 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-100 text-blue-900">
                    <tr>
                        <th class="px-4 py-3 text-sm font-semibold text-center">Hình ảnh</th>
                        <th class="px-4 py-3 text-sm font-semibold text-left">Tên Sản Phẩm</th>
                        <th class="px-4 py-3 text-sm font-semibold text-left">Danh Mục</th>
                        <th class="px-4 py-3 text-sm font-semibold text-left">Thương Hiệu</th>
                        <th class="px-4 py-3 text-sm font-semibold text-center">Chức Năng</th>
                        <th class="px-4 py-3 text-sm font-semibold text-center">Số Lượng</th>
                        <th class="px-4 py-3 text-sm font-semibold text-center">ID</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($list as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-center">
                                <img src="{{ asset('assets/images/product/' . $item->thumbnail) }}"
                                    alt="{{ $item->name }}" class="w-16 h-16 object-cover rounded shadow mx-auto">
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $item->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item->categoryname }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item->brandname }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('product.status', ['product' => $item->id]) }}"
                                    class="text-2xl {{ $item->status == 1 ? 'text-green-500 hover:text-green-600' : 'text-gray-400 hover:text-gray-500' }}"
                                    title="Đổi trạng thái">
                                    <i class="fa {{ $item->status == 1 ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                </a>

                                <a href="{{ route('product.show', ['product' => $item->id]) }}"
                                    class="text-orange-500 hover:text-orange-600 text-xl" title="Xem chi tiết">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="{{ route('product.edit', ['product' => $item->id]) }}"
                                    class="text-blue-500 hover:text-blue-600 text-xl" title="Chỉnh sửa">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="{{ route('product.destroy', ['product' => $item->id]) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-600 text-xl"
                                        title="Xóa">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            <!-- Cột số lượng -->
                            <td class="px-4 py-3 text-center text-blue-700 font-semibold">
                                {{ $item->qty }}
                            </td>
                            <td class="px-4 py-3 text-sm text-center text-gray-700">{{ $item->id }}</td>
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
