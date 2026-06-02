<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Xác Nhận Đơn Hàng - TyuuMei</title>
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
            <h3 class="text-2xl font-bold text-center mb-10 text-rose-500">✅ Đặt Hàng Thành Công</h3>

            <div class="bg-white p-6 shadow-lg rounded-lg max-w-3xl mx-auto">
                <div class="mb-6">
                    <p class="text-lg text-gray-700 mb-2">🎉 Cảm ơn bạn <span
                            class="font-semibold text-rose-500">{{ $order->name }}</span> đã đặt hàng tại
                        <strong>TyuuMei</strong>.
                    </p>
                    <p>Mã đơn hàng của bạn là: <strong>#{{ $order->id }}</strong></p>
                    <p class="text-sm text-gray-500 mt-2">Chúng tôi sẽ sớm liên hệ để xác nhận và giao hàng đến bạn.
                    </p>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <h4 class="text-xl font-semibold mb-4 text-gray-700">📦 Thông tin đơn hàng</h4>
                    <ul class="space-y-2 text-gray-700">
                        <li><strong>Họ tên:</strong> {{ $order->name }}</li>
                        <li><strong>Email:</strong> {{ $order->email }}</li>
                        <li><strong>Số điện thoại:</strong> {{ $order->phone }}</li>
                        <li><strong>Địa chỉ nhận hàng:</strong> {{ $order->address }}</li>
                        <li><strong>Phương thức thanh toán:</strong> {{ ucfirst($order->payment_method) }}</li>
                        <li><strong>Ghi chú:</strong> {{ $order->note ?? 'Không có ghi chú' }}</li>
                        <li><strong>Trạng thái:</strong>
                            @switch($order->status)
                                @case('pending')
                                    <span class="text-yellow-600 font-semibold">Chờ xử lý</span>
                                @break

                                @case('processing')
                                    <span class="text-blue-600 font-semibold">Đang xử lý</span>
                                @break

                                @case('shipped')
                                    <span class="text-indigo-600 font-semibold">Đang giao hàng</span>
                                @break

                                @case('completed')
                                    <span class="text-green-600 font-semibold">Hoàn thành</span>
                                @break

                                @case('cancelled')
                                    <span class="text-red-600 font-semibold">Đã hủy</span>
                                @break

                                @default
                                    <span class="text-gray-600">Không xác định</span>
                            @endswitch
                        </li>
                    </ul>
                </div>

                <div class="mt-8">
                    <h4 class="text-xl font-semibold mb-4 text-gray-700">🛒 Sản phẩm</h4>
                    <table class="w-full border border-gray-200 text-left">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border-b">Hình ảnh</th>
                                <th class="px-4 py-2 border-b">Sản phẩm</th>
                                <th class="px-4 py-2 border-b">Giá</th>
                                <th class="px-4 py-2 border-b">Số lượng</th>
                                <th class="px-4 py-2 border-b">Thành tiền</th>
                                <th class="px-4 py-2 border-b text-center">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $detail)
                                <tr>
                                    <td class="px-4 py-2 border-b">
                                        <img src="{{ asset('assets/images/product/' . ($detail->product->thumbnail ?? 'no-image.jpg')) }}"
                                            alt="{{ $detail->product->name ?? 'Sản phẩm' }}"
                                            class="w-12 h-12 object-cover rounded border">
                                    </td>
                                    <td class="px-4 py-2 border-b">
                                        {{ $detail->product->name ?? 'Sản phẩm đã xóa' }}
                                    </td>
                                    <td class="px-4 py-2 border-b">
                                        {{ number_format($detail->price_buy, 0, ',', '.') }}₫
                                    </td>
                                    <td class="px-4 py-2 border-b">
                                        {{ $detail->qty }}
                                    </td>
                                    <td class="px-4 py-2 border-b text-rose-500 font-semibold">
                                        {{ number_format($detail->amount, 0, ',', '.') }}₫
                                    </td>
                                    <td class="px-4 py-2 border-b text-center">
                                        @if ($detail->product)
                                            <a href="{{ route('site.product_detail', $detail->product->slug) }}"
                                                class="text-blue-500 hover:text-blue-700 underline text-sm inline-flex items-center space-x-1">
                                                <i class="fas fa-eye"></i> <span>Xem chi tiết</span>
                                            </a>
                                        @else
                                            <span class="text-gray-400 text-sm italic">Không có</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-right mt-4 text-xl font-semibold">
                        Tổng cộng: <span
                            class="text-rose-500">{{ number_format($order->total_amount, 0, ',', '.') }}₫</span>
                    </div>
                </div>

                <div class="mt-8 text-center space-y-4">
                    <a href="{{ route('site.home') }}"
                        class="inline-block bg-rose-500 text-white px-6 py-3 rounded hover:bg-rose-600 shadow">
                        🏠 Quay về trang chủ
                    </a>

                    @if ($order->status === 'pending')
                        <form action="{{ route('order.cancel', $order->id) }}" method="POST"
                            onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này?');" class="inline-block">
                            @csrf
                            <button type="submit"
                                class="bg-gray-300 text-gray-700 px-6 py-3 rounded hover:bg-red-500 hover:text-white transition">
                                ❌ Hủy đơn hàng
                            </button>
                        </form>
                    @endif
                </div>
            </div>
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
