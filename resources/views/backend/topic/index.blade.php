<x-layout-admin>
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="bg-white border border-blue-200 rounded-xl shadow px-6 py-4 mb-6">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-blue-600">📚 Quản lý Topic</h2>
                <div class="flex gap-3">
                    <a href="{{ route('topic.create') }}"
                        class="bg-blue-500 hover:bg-green-600 text-white px-5 py-2 rounded-xl flex items-center shadow transition-all duration-300 hover:scale-105">
                        <i class="fa fa-plus mr-2"></i> Thêm
                    </a>
                    <a href="{{ route('topic.trash') }}"
                        class="bg-rose-500 hover:bg-rose-600 text-white px-5 py-2 rounded-xl flex items-center shadow transition-all duration-300 hover:scale-105">
                        <i class="fa fa-trash mr-2"></i> Thùng rác
                    </a>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white border border-blue-200 rounded-xl shadow p-6 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-center">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-4 py-3 text-sm font-semibold text-gray-700">Tên</th>
                        <th class="px-4 py-3 text-sm font-semibold text-gray-700">Mô tả</th>
                        <th class="px-4 py-3 text-sm font-semibold text-gray-700">Chức năng</th>
                        <th class="px-4 py-3 text-sm font-semibold text-gray-700">ID</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($list as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $item->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600 max-w-xs mx-auto">
                                {{ Str::limit($item->description, 100) }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-3">
                                    <!-- Trạng thái -->
                                    <a href="{{ route('topic.status', ['topic' => $item->id]) }}"
                                        class="text-xl {{ $item->status == 1 ? 'text-green-500' : 'text-red-500' }} hover:scale-110 transition">
                                        <i class="fa {{ $item->status == 1 ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                    </a>

                                    <!-- Xem -->
                                    <a href="{{ route('topic.show', ['topic' => $item->id]) }}"
                                        class="text-orange-500 hover:text-rose-700 transition">
                                        <i class="fa fa-eye text-xl"></i>
                                    </a>

                                    <!-- Sửa -->
                                    <a href="{{ route('topic.edit', ['topic' => $item->id]) }}"
                                        class="text-blue-500 hover:text-blue-700 transition">
                                        <i class="fa fa-edit text-xl"></i>
                                    </a>

                                    <!-- Xóa -->
                                    <form action="{{ route('topic.destroy', ['topic' => $item->id]) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa chủ đề này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-500 hover:text-rose-600 text-xl"
                                            title="Xóa">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item->id }}</td>
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
        