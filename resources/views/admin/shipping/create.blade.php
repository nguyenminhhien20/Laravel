<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm thông tin vận chuyển</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 py-10">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            Thêm thông tin vận chuyển cho đơn hàng #{{ $order->id }}
        </h2>

        <form action="{{ route('admin.shipping.store') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">

            <div>
                <label class="block font-medium text-gray-700 mb-1">Mã vận đơn</label>
                <input type="text" name="tracking_number" class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-gray-400" required>
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1">Hãng vận chuyển</label>
                <input type="text" name="carrier" class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-gray-400" required>
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1">Trạng thái</label>
                <select name="status" class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-gray-400">
                    <option value="Chờ lấy hàng">Chờ lấy hàng</option>
                    <option value="Đang giao">Đang giao</option>
                    <option value="Đã giao">Đã giao</option>
                    <option value="Thất bại">Thất bại</option>
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1">Ghi chú</label>
                <textarea name="note" rows="3" class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-gray-400"></textarea>
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1">Ngày giao hàng</label>
                <input type="datetime-local" name="shipped_at" class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-gray-400">
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1">Ngày giao thành công</label>
                <input type="datetime-local" name="delivered_at" class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-gray-400">
            </div>

            <div>
                <button type="submit" class="bg-gray-600 text-white px-6 py-2 rounded shadow hover:bg-gray-700 transition">
                    Lưu thông tin vận chuyển
                </button>
            </div>
        </form>
    </div>
</body>

</html>
