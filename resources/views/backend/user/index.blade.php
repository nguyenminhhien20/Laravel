<x-layout-admin>
    <div class="content-wrapper space-y-6">

        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-6 shadow border border-blue-200 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <i class="fa fa-users text-2xl text-blue-600"></i>
                <h1 class="text-2xl font-bold text-blue-800">Danh sách người dùng</h1>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('user.create') }}"
                    class="flex items-center bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition-all duration-200">
                    <i class="fa fa-plus mr-2"></i> Thêm mới
                </a>
                <a href="{{ route('user.trash') }}"
                    class="flex items-center bg-rose-500 text-white px-5 py-2 rounded-lg shadow hover:bg-rose-600 transition-all duration-200">
                    <i class="fa fa-trash mr-2"></i> Thùng rác
                </a>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
            <table class="w-full text-sm text-gray-700">
                <thead class="bg-gray-100 border-b border-gray-200 text-left">
                    <tr>
                        <th class="px-5 py-4">👤 Tên</th>
                        <th class="px-5 py-4">📧 Email</th>
                        <th class="px-5 py-4">📱 SĐT</th>
                        <th class="px-5 py-4">🧑‍💻 Tài khoản</th>
                        <th class="px-5 py-4">🏠 Địa chỉ</th>
                        <th class="px-5 py-4 text-center">⚙️ Chức năng</th>
                        <th class="px-5 py-4 text-center">🆔 ID</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($list as $item)
                        <tr class="hover:bg-blue-50 transition duration-200">
                            <td class="px-5 py-3">{{ $item->name }}</td>
                            <td class="px-5 py-3">{{ $item->email }}</td>
                            <td class="px-5 py-3">{{ $item->phone }}</td>
                            <td class="px-5 py-3">{{ $item->username }}</td>
                            <td class="px-5 py-3">{{ $item->address }}</td>
                            <td class="px-5 py-3 text-center">
                                <div class="flex justify-center gap-3 text-lg">
                                    <!-- Trạng thái -->
                                    <a href="{{ route('user.status', ['user' => $item->id]) }}" title="Trạng thái">
                                        <i class="fa {{ $item->status ? 'fa-toggle-on text-green-500' : 'fa-toggle-off text-gray-400' }}"></i>
                                    </a>
                                    <!-- Xem -->
                                    <a href="{{ route('user.show', ['user' => $item->id]) }}" title="Xem chi tiết"
                                       class="text-orange-500 hover:text-orange-600">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <!-- Sửa -->
                                    <a href="{{ route('user.edit', ['user' => $item->id]) }}" title="Chỉnh sửa"
                                       class="text-blue-500 hover:text-blue-600">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <!-- Xóa -->
                                   <form action="{{ route('user.destroy', ['user' => $item->id]) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-500 hover:text-rose-600 text-xl"
                                            title="Xóa">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-center">{{ $item->id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-6 text-center text-gray-500 italic">Không có người dùng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="text-center">
            {{ $list->links() }}
        </div>
    </div>
</x-layout-admin>
