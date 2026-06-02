<x-layout-admin>
    <div class="content-wrapper space-y-6">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-rose-100 to-rose-200 border border-rose-300 rounded-xl p-6 shadow flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <i class="fa fa-trash text-2xl text-rose-600"></i>
                <h1 class="text-2xl font-bold text-rose-800">Thùng rác người dùng</h1>
            </div>
            <a href="{{ route('user.index') }}"
               class="flex items-center bg-gray-600 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-700 transition">
                <i class="fa fa-arrow-left mr-2"></i> Về danh sách
            </a>
        </div>

        <!-- Table Section -->
        <div class="bg-white border border-gray-200 rounded-xl shadow overflow-hidden">
            <table class="min-w-full text-sm text-gray-800">
                <thead class="bg-gray-100 text-gray-700 uppercase text-left">
                    <tr>
                        <th class="px-6 py-4">👤 Tên</th>
                        <th class="px-6 py-4">📧 Email</th>
                        <th class="px-6 py-4">📱 SĐT</th>
                        <th class="px-6 py-4">🧑‍💻 Tài khoản</th>
                        <th class="px-6 py-4 text-center">⚙️ Chức năng</th>
                        <th class="px-6 py-4 text-center">🆔 ID</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($list as $item)
                        <tr class="hover:bg-rose-50 transition duration-200">
                            <td class="px-6 py-4">{{ $item->name }}</td>
                            <td class="px-6 py-4">{{ $item->email }}</td>
                            <td class="px-6 py-4">{{ $item->phone }}</td>
                            <td class="px-6 py-4">{{ $item->username }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-3 text-lg">
                                    <!-- Khôi phục -->
                                    <a href="{{ route('user.restore', ['user' => $item->id]) }}"
                                       title="Khôi phục" class="text-green-600 hover:text-green-700">
                                        <i class="fa fa-rotate-left"></i>
                                    </a>
                                    <!-- Xóa vĩnh viễn -->
                                   <form action="{{ route('user.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Xóa vĩnh viễn</button>
                                </form>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">{{ $item->id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500 italic">Không có người dùng trong thùng rác.</td>
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
