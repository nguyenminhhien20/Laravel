<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lịch Sử Đơn Hàng - TyuuMei</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    <!-- Navbar -->
    <header class="bg-white shadow-md px-6">
        <div class="flex justify-between items-center py-4 w-full">
            <a href="{{ route('site.home') }}">
                <img src="{{ asset('build/assets/images/logo1.jpg') }}" alt="Logo"
                    class="h-12 w-12 rounded-full object-cover">
            </a>
            <span class="text-2xl font-extrabold text-gray-700">Tyuu<span class="text-rose-500">Mei</span></span>
            <x-main-menu />
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <section class="container mx-auto px-6 py-12">
            <h3 class="text-3xl font-bold text-center mb-10 text-rose-500">🧾 Lịch Sử Mua Hàng Của Bạn</h3>

            @if ($orders->isEmpty())
                <div class="text-center text-gray-600">
                    Bạn chưa có đơn hàng nào.
                </div>
            @else
                <div class="space-y-8 max-w-5xl mx-auto">
                    @foreach ($orders as $order)
                        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                            <!-- Header đơn -->
                            <div class="flex justify-between items-center mb-4 border-b pb-3">
                                <div>
                                    <p class="text-lg font-semibold text-gray-700">
                                        Đơn hàng <span class="text-blue-500">#{{ $order->id }}</span>
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                                <div>
                                    <span
                                        class="px-3 py-1 text-sm font-medium rounded-full
            @if ($order->status == 'pending') bg-yellow-200 text-yellow-600
            @elseif($order->status == 'confirmed') bg-green-200 text-green-600
            @elseif($order->status == 'cancelled') bg-red-200 text-red-600
            @else bg-gray-100 text-gray-700 @endif">
                                        @switch($order->status)
                                            @case('pending')
                                                Chờ xử lý
                                            @break

                                            @case('confirmed')
                                                Đã xác nhận
                                            @break

                                            @case('cancelled')
                                                Đã hủy
                                            @break

                                            @default
                                                Không xác định
                                        @endswitch
                                    </span>
                                </div>

                            </div>

                            <!-- Sản phẩm -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm text-left">
                                    <thead class="bg-gray-100 text-gray-600">
                                        <tr>
                                            <th class="py-2 px-4">Sản phẩm</th>
                                            <th class="py-2 px-4">Giá</th>
                                            <th class="py-2 px-4">Số lượng</th>
                                            <th class="py-2 px-4">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderDetails as $detail)
                                            <tr class="border-b hover:bg-gray-50">
                                                <td class="py-2 px-4">
                                                    {{ $detail->product->name ?? 'Sản phẩm đã xóa' }}
                                                </td>
                                                <td class="py-2 px-4">
                                                    {{ number_format($detail->price_buy, 0, ',', '.') }}₫
                                                </td>
                                                <td class="py-2 px-4">{{ $detail->qty }}</td>
                                                <td class="py-2 px-4 text-rose-600 font-semibold">
                                                    {{ number_format($detail->amount, 0, ',', '.') }}₫
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tổng -->
                            <div class="text-right mt-4 text-lg font-semibold">
                                Tổng cộng:
                                <span class="text-rose-500">
                                    {{ number_format($order->total_amount, 0, ',', '.') }}₫
                                </span>
                            </div>

                            <!-- Thông tin người nhận -->
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-gray-700">
                                <div><strong>Người nhận:</strong> {{ $order->name }}</div>
                                <div><strong>Điện thoại:</strong> {{ $order->phone }}</div>
                                <div><strong>Địa chỉ:</strong> {{ $order->address }}</div>
                                <div><strong>Thanh toán:</strong> {{ ucfirst($order->payment_method) }}</div>
                            </div>
                            <!-- Xem chi tiết và Theo dõi -->
                            <div class="mt-6 text-right space-x-2">
                                <a href="{{ $order->status === 'cancelled' ? route('order.cancel.success') : route('site.order.confirm', $order->id) }}"
                                    class="inline-block bg-rose-500 text-white px-5 py-2 rounded hover:bg-rose-600 transition">
                                    🔍 Xem chi tiết
                                </a>
                                <a href="{{ route('shipping.track', $order->id) }}"
                                    class="inline-block bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600 transition">
                                    🚚 Theo dõi đơn hàng
                                </a>

                                @if ($order->status !== 'cancelled')
                                    <form action="{{ route('order.cancel', $order->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        <button type="submit"
                                            onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này không?')"
                                            class="bg-gray-200 text-gray-800 px-5 py-2 rounded hover:bg-red-500 hover:text-white transition">
                                            ❌ Hủy đơn
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 text-gray-600 py-6 mt-12">
        <div class="max-w-7xl mx-auto text-center space-y-2">
            <p class="text-sm">© 2025 TyuuMei. All rights reserved.</p>
            <div class="flex justify-center space-x-4">
                <a href="#" class="hover:text-rose-500"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-rose-500"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-rose-500"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

</body>

</html>
