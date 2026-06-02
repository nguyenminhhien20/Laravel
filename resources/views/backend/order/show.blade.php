<x-layout-admin>
    <div class="content-wrapper">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">Chi tiết đơn hàng</h2>
                <a href="{{ route('order.index') }}" class="bg-gray-500 px-2 py-2 rounded-xl mx-1 text-white">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách đơn hàng
                </a>
            </div>
        </div>

        @if($order)
        <div class="border border-blue-100 rounded-lg p-3">
            <div class="mb-3">
                <strong>Tên đơn hàng:</strong> {{ $order->name }}
            </div>
            <div class="mb-3">
                <strong>Số điện thoại:</strong> {{ $order->phone }}
            </div>
            <div class="mb-3">
                <strong>Email:</strong> {{ $order->email }}
            </div>
            <div class="mb-3">
                <strong>Địa chỉ:</strong> {{ $order->address }}
            </div>
            <div class="mb-3">
                <strong>Ghi chú:</strong> {{ $order->note ?? 'Không có ghi chú' }}
            </div>
            <div class="mb-3">
                <strong>Người dùng:</strong> {{ $order->user->name ?? 'Không có người dùng' }}
            </div>
            <div class="mb-3">
                <strong>Trạng thái:</strong> {{ $order->status == 1 ? 'Xuất bản' : 'Không xuất bản' }}
            </div>
            <div class="mb-3">
                <strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y H:i:s') }}
            </div>
            <div class="mb-3">
                <strong>Ngày cập nhật:</strong> {{ $order->updated_at->format('d/m/Y H:i:s') }}
            </div>
        </div>
        @else
        <div class="alert alert-danger">
            Đơn hàng không tồn tại.
        </div>
        @endif
    </div>
</x-layout-admin>
