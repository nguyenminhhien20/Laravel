<x-layout-admin>
    <div class="content-wrapper space-y-6">

        <!-- Header -->
        <div class="bg-blue-400 text-white px-6 py-4 rounded-2xl shadow flex items-center justify-between">
            <div class="flex items-center gap-3">
                <i class="fa fa-box-open text-2xl"></i>
                <h1 class="text-2xl font-bold">Quản lý Đơn hàng</h1>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('order.create') }}"
                    class="bg-white text-blue-700 font-medium px-4 py-2 rounded-xl shadow hover:bg-blue-100 transition flex items-center gap-2">
                    <i class="fa fa-plus"></i> Thêm mới
                </a>
                <a href="{{ route('order.trash') }}"
                    class="bg-rose-600 text-white px-4 py-2 rounded-xl hover:bg-rose-700 transition flex items-center gap-2">
                    <i class="fa fa-trash"></i> Thùng rác
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-md rounded-2xl overflow-hidden">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">Đơn</th>
                        <th class="px-6 py-3">Tên khách hàng</th>
                        <th class="px-6 py-3">Số điện thoại</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Địa chỉ</th>
                        <th class="px-6 py-3">Ghi chú</th>
                        <th class="px-6 py-3 text-center">Trạng thái</th>
                        <th class="px-6 py-3 text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $item)
                        <tr class="border-t hover:bg-blue-50 transition">
                            <td class="px-6 py-4 text-rose-600 font-semibold">#{{ $item->id }}</td>
                            <td class="px-6 py-4 font-medium">{{ $item->name }}</td>
                            <td class="px-6 py-4">{{ $item->phone }}</td>
                            <td class="px-6 py-4 text-blue-600 break-words">{{ $item->email }}</td>
                            <td class="px-6 py-4">{{ $item->address }}</td>
                            <td class="px-6 py-4 whitespace-normal break-words">
                                {{ $item->note ?? 'Không có' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                    @switch($item->status)
                                        @case('pending') bg-yellow-100 text-yellow-800 @break
                                        @case('processing') bg-blue-100 text-blue-800 @break
                                        @case('shipped') bg-indigo-100 text-indigo-800 @break
                                        @case('completed') bg-green-100 text-green-800 @break
                                        @case('cancelled') bg-red-100 text-red-800 @break
                                        @default bg-gray-200 text-gray-700
                                    @endswitch">
                                    @switch($item->status)
                                        @case('pending')
                                            Chờ xử lý
                                        @break

                                        @case('processing')
                                            Đang xử lý
                                        @break

                                        @case('shipped')
                                            Đang giao hàng
                                        @break

                                        @case('completed')
                                            Hoàn thành
                                        @break

                                        @case('cancelled')
                                            Đã hủy
                                        @break

                                        @default
                                            Không xác định
                                    @endswitch
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('order-detail.index', ['order_id' => $item->id]) }}"
                                        title="Xem chi tiết" class="text-orange-500 hover:text-orange-700">
                                        <i class="fa fa-eye text-xl"></i>
                                    </a>
                                    <a href="{{ route('order.edit', ['order' => $item->id]) }}" title="Chỉnh sửa"
                                        class="text-blue-500 hover:text-blue-700">
                                        <i class="fa fa-edit text-xl"></i>
                                    </a>
                                    <form action="{{ route('order.destroy', ['order' => $item->id]) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Xóa" class="text-rose-500 hover:text-rose-600">
                                            <i class="fa fa-trash text-xl"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-6 text-gray-500 italic">Không có đơn hàng nào.</td>
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
