<x-layout-admin>
    <div class="content-wrapper space-y-6">

        <!-- Header -->
        <div class="bg-rose-100 px-6 py-4 rounded-2xl shadow flex items-center justify-between">
            <div class="flex items-center gap-3">
                <i class="fa fa-trash-alt text-2xl text-rose-600"></i>
                <h1 class="text-2xl font-bold text-rose-700">Thùng rác Chi tiết đơn hàng</h1>
            </div>
            <a href="{{ route('order-detail.index') }}"
                class="bg-blue-600 hover:bg-gray-700 text-white px-4 py-2 rounded-xl shadow transition flex items-center gap-2">
                <i class="fa fa-arrow-left"></i> Về danh sách
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-md rounded-2xl overflow-hidden">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-center">Mã Đơn hàng</th>
                        <th class="px-6 py-3 text-center">Sản phẩm</th>
                        <th class="px-6 py-3 text-center">Giá mua</th>
                        <th class="px-6 py-3 text-center">Số lượng</th>
                        <th class="px-6 py-3 text-center">Thành tiền</th>
                        <th class="px-6 py-3 text-center">Thao tác</th>
                        <th class="px-6 py-3 text-center">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $item)
                        <tr class="border-t hover:bg-rose-50 transition text-center">
                            <td class="px-6 py-4">{{ $item->order_id }}</td>
                            <td class="px-6 py-4">{{ $item->product_name }}</td>
                            <td class="px-6 py-4">{{ number_format($item->price_buy, 0, ',', '.') }}₫</td>
                            <td class="px-6 py-4">{{ $item->qty }}</td>
                            <td class="px-6 py-4">{{ number_format($item->amount, 0, ',', '.') }}₫</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('order_detail.restore', ['orderDetail' => $item->id]) }}"
                                        title="Khôi phục" class="text-green-600 hover:text-green-800 transition">
                                        <i class="fa fa-rotate-left text-xl"></i>
                                    </a>

                                    <a href="{{ route('order_detail.destroy', ['orderDetail' => $item->id]) }}"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn chi tiết đơn hàng này?')"
                                        title="Xóa vĩnh viễn" class="text-rose-600 hover:text-rose-800 transition">
                                        <i class="fa fa-trash-alt text-xl"></i>
                                    </a>

                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $item->id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-500 italic">
                                Không có chi tiết đơn hàng nào trong thùng rác.
                            </td>
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
