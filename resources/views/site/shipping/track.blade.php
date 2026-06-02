<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Theo Dõi Đơn Hàng - TyuuMei</title>
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

    <!-- Main -->
    <main class="flex-grow py-12 px-6">
        <div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-8">
            <h2 class="text-2xl font-bold text-rose-500 mb-6">🚚 Trạng Thái Vận Chuyển</h2>

            <div class="mb-4">
                <p class="text-sm text-gray-500">Mã đơn hàng: <span
                        class="text-blue-600 font-medium">#{{ $order->id }}</span></p>
                <p class="text-sm text-gray-500">Ngày đặt hàng: {{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>

            @if ($order->shipping && $order->status !== 'cancelled')
                <div class="space-y-3 text-gray-700">
                    <p><strong>Trạng thái:</strong>
                        <span
                            class="px-3 py-1 rounded-full text-white font-medium
                        @if ($order->shipping->status == 'pending') bg-yellow-400
                        @elseif($order->shipping->status == 'shipping') bg-blue-500
                        @elseif($order->shipping->status == 'delivered') bg-green-500
                        @else bg-gray-400 @endif">
                            @switch($order->shipping->status)
                                @case('pending')
                                    Chờ giao hàng
                                @break

                                @case('shipping')
                                    Đang giao hàng
                                @break

                                @case('delivered')
                                    Đã giao hàng
                                @break

                                @default
                                    Không xác định
                            @endswitch
                        </span>
                    </p>

                    <p><strong>Địa chỉ giao hàng:</strong> {{ $order->shipping->shipping_address ?? 'Không có' }}</p>
                    <p><strong>Đơn vị vận chuyển:</strong> {{ $order->shipping->carrier ?? 'Không có' }}</p>
                    <p><strong>Mã vận đơn:</strong> {{ $order->shipping->tracking_number ?? 'Không có' }}</p>
                    <p><strong>Ghi chú:</strong> {{ $order->shipping->note ?? 'Không có ghi chú' }}</p>
                    <p><strong>Cập nhật lần cuối:</strong> {{ $order->shipping->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            @elseif ($order->status === 'cancelled')
                <div class="bg-red-100 text-red-800 p-4 rounded-lg mt-4 text-center">
                    Đơn hàng này đã bị hủy và sẽ không được vận chuyển.
                </div>
            @else
                <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg mt-4 text-center">
                    Đơn hàng này hiện chưa có thông tin vận chuyển.
                </div>
            @endif

            <div class="mt-8 text-right">
                <a href="{{ route('order.history') }}"
                    class="inline-block px-6 py-2 bg-rose-500 text-white rounded hover:bg-rose-600 transition">
                    ← Quay lại lịch sử
                </a>
            </div>
        </div>
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
