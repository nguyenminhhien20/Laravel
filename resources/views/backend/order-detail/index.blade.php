<x-layout-admin>
    <div class="content-wrapper space-y-6">

        <!-- Header -->
        <div class="bg-blue-100 px-6 py-4 rounded-xl shadow flex items-center justify-between">
            <h2 class="text-2xl font-bold text-blue-700">Chi tiết Đơn hàng</h2>
            <a href="{{ route('order_detail.trash') }}"
               class="inline-flex items-center bg-rose-500 text-white px-4 py-2 rounded-full shadow hover:bg-rose-400 transition">
                <i class="fa fa-trash-alt mr-2"></i> Thùng rác
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-md rounded-xl overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700 border-separate border-spacing-y-2">
                <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-center">Mã Đơn hàng</th>
                        <th class="px-4 py-3 text-center">Tên Sản phẩm</th>
                        <th class="px-4 py-3 text-center">Giá mua</th>
                        <th class="px-4 py-3 text-center">Số lượng</th>
                        <th class="px-4 py-3 text-center">Thành tiền</th>
                        <th class="px-4 py-3 text-center">Chức Năng</th>
                        <th class="px-4 py-3 text-center">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr class="bg-gray-50 hover:bg-blue-50 text-center transition rounded-md">
                            <td class="px-6 py-4 text-rose-600 font-semibold">{{ $item->order_id }}</td>
                            <td class="px-4 py-3">{{ $item->product_name }}</td>
                            <td class="px-4 py-3">{{ number_format($item->price_buy, 0, ',', '.') }}₫</td>
                            <td class="px-4 py-3">{{ $item->qty }}</td>
                            <td class="px-4 py-3 text-green-600 font-semibold">
                                {{ number_format($item->amount, 0, ',', '.') }}₫
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('order_detail.delete', ['orderDetail' => $item->id]) }}"
                                   onclick="return confirm('Bạn có chắc muốn xóa chi tiết đơn hàng này?')"
                                   class="text-rose-500 hover:text-rose-700 text-lg">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                            <td class="px-4 py-3 text-gray-500">{{ $item->id }}</td>
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
