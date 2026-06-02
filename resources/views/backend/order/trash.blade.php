<x-layout-admin>
    <div class="content-wrapper space-y-6">

        <!-- Header -->
        <div class="bg-rose-100 px-6 py-4 rounded-2xl shadow flex items-center justify-between">
            <div class="flex items-center gap-3">
                <i class="fa fa-trash-alt text-2xl text-rose-600"></i>
                <h1 class="text-2xl font-bold text-rose-700">Thùng rác đơn hàng</h1>
            </div>
            <a href="{{ route('order.index') }}"
                class="bg-blue-600 hover:bg-gray-700 text-white px-4 py-2 rounded-xl shadow transition flex items-center gap-2">
                <i class="fa fa-arrow-left"></i> Về danh sách
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-md rounded-2xl overflow-hidden">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">Tên khách hàng</th>
                        <th class="px-6 py-3">Số điện thoại</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Địa chỉ</th>
                        <th class="px-6 py-3 text-center">Thao tác</th>
                        <th class="px-6 py-3 text-center">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $item)
                        <tr class="border-t hover:bg-rose-50 transition">
                            <td class="px-6 py-4 font-medium">{{ $item->name }}</td>
                            <td class="px-6 py-4">{{ $item->phone }}</td>
                            <td class="px-6 py-4 text-blue-600 break-words">{{ $item->email }}</td>
                            <td class="px-6 py-4">{{ $item->address }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('order.restore', ['order' => $item->id]) }}" title="Khôi phục"
                                        class="text-green-600 hover:text-green-800 transition">
                                        <i class="fa fa-rotate-left text-xl"></i>
                                    </a>
                                    <form action="{{ route('order.delete', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn đơn hàng này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-800"
                                            title="Xóa vĩnh viễn">
                                            <i class="fa fa-trash-alt text-xl"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">{{ $item->id ?? 'Không có' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500 italic">Không có đơn hàng nào trong
                                thùng rác.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $list->links() }}
        </div>
    </div>
</x-layout-admin>
