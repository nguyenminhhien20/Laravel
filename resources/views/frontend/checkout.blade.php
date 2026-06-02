<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thanh Toán - TyuuMei</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <meta name="description"
        content="Thanh toán đơn hàng tại TyuuMei - Thời trang phong cách Nhật Bản, dễ thương, hiện đại.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    <!-- Navbar -->
    <header class="bg-white shadow-md px-4 md:px-6">
        <div class="flex justify-between items-center py-4">
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
        <section class="container mx-auto px-4 md:px-6 py-12">
            <h3 class="text-2xl font-bold text-center mb-10 text-rose-500">🛒 Thanh Toán</h3>

            @if (session('message'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            @if (count($cartItems) > 0)
                <form action="{{ route('site.checkout.store') }}" method="POST" id="checkoutForm">
                    @csrf
                    <div class="bg-white p-6 shadow-lg rounded-lg">

                        <!-- Giỏ hàng -->
                        <div class="mb-8 overflow-x-auto">
                            <h4 class="text-xl font-semibold mb-4">Chọn sản phẩm để đặt hàng</h4>
                            <table class="min-w-full text-left border border-gray-200">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="py-2 px-3 border-b text-center">Chọn</th>
                                        <th class="py-2 px-3 border-b">Sản phẩm</th>
                                        <th class="py-2 px-3 border-b">Giá</th>
                                        <th class="py-2 px-3 border-b">Số lượng</th>
                                        <th class="py-2 px-3 border-b">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        @php
                                            $priceRoot = $item['price_root'] ?? 0;
                                            $priceSale = $item['price_sale'] ?? 0;
                                            $price = $priceSale > 0 ? $priceSale : $priceRoot;
                                        @endphp
                                        <tr>
                                            <td class="py-2 px-3 border-b text-center">
                                                <input type="checkbox" name="selected_items[]"
                                                    value="{{ $item['id'] }}" class="item-checkbox" checked>
                                            </td>
                                            <td class="flex items-center space-x-4 px-4 py-2">
                                                <img src="{{ file_exists(public_path('assets/images/product/' . $item['thumbnail'])) ? asset('assets/images/product/' . $item['thumbnail']) : asset('build/assets/images/no-image.png') }}"
                                                    class="w-16 h-16 object-cover rounded border">
                                                <div>
                                                    <p class="font-semibold text-gray-800">{{ $item['name'] }}</p>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $item['description'] ?? 'Không có mô tả' }}</p>
                                                </div>
                                            </td>
                                            <td class="py-2 px-3 border-b">{{ number_format($price, 0, ',', '.') }}₫
                                            </td>
                                            <td class="py-2 px-3 border-b">{{ $item['qty'] }}</td>
                                            <td class="py-2 px-3 border-b text-rose-500 font-semibold">
                                                {{ number_format($price * $item['qty'], 0, ',', '.') }}₫
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Tóm tắt đơn hàng -->
                        <div class="mb-10">
                            <h4 class="text-xl font-bold text-gray-700 mb-4">📦 Tóm tắt đơn hàng</h4>
                            <div class="bg-white p-6 rounded-lg shadow-md border">
                                <div class="flex justify-between mb-2 text-sm text-gray-600">
                                    <span>Tạm tính:</span>
                                    <span>{{ number_format($total, 0, ',', '.') }}₫</span>
                                </div>
                                <div class="flex justify-between mb-2 text-sm text-gray-600">
                                    <span>Phí vận chuyển:</span>
                                    <span>Miễn phí</span>
                                </div>
                                <div class="flex justify-between text-lg font-bold text-rose-600 border-t pt-3 mt-2">
                                    <span>Tổng cộng:</span>
                                    <span>{{ number_format($total, 0, ',', '.') }}₫</span>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin người mua -->
                        <div class="mb-6">
                            <h4 class="text-xl font-semibold text-gray-700 mb-4">Thông tin người mua</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-gray-600">Họ và tên</label>
                                    <input type="text" id="name" name="name" required
                                        class="w-full px-4 py-2 border rounded-md"
                                        value="{{ old('name', Auth::user()->name ?? '') }}" />
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-gray-600">Email</label>
                                    <input type="email" id="email" name="email" required
                                        class="w-full px-4 py-2 border rounded-md"
                                        value="{{ old('email', Auth::user()->email ?? '') }}" />
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="phone" class="block text-gray-600">Số điện thoại</label>
                                    <input type="text" id="phone" name="phone" required pattern="[0-9]{10,11}"
                                        class="w-full px-4 py-2 border rounded-md"
                                        value="{{ old('phone', Auth::user()->phone ?? '') }}" />
                                    @error('phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="address" class="block text-gray-600">Địa chỉ</label>
                                    <input type="text" id="address" name="address" required
                                        class="w-full px-4 py-2 border rounded-md"
                                        value="{{ old('address', Auth::user()->address ?? '') }}" />
                                    @error('address')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="address_detail" class="block text-gray-600">Địa chỉ nhận hàng cụ
                                        thể</label>
                                    <input type="text" id="address_detail" name="address_detail"
                                        class="w-full px-4 py-2 border rounded-md"
                                        placeholder="Số nhà, tên đường, tầng/lầu..."
                                        value="{{ old('address_detail') }}" />
                                    @error('address_detail')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label for="note" class="block text-gray-600">Ghi chú</label>
                                    <textarea id="note" name="note" rows="3" class="w-full px-4 py-2 border rounded-md"
                                        placeholder="Nhập ghi chú nếu có...">{{ old('note') }}</textarea>
                                    @error('note')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Phương thức thanh toán -->
                        <div class="mb-6">
                            <h4 class="text-xl font-semibold text-gray-700 mb-4">Phương thức thanh toán</h4>
                            <div>
                                <select name="payment_method" id="payment_method"
                                    class="w-full px-4 py-2 border rounded-md" required>
                                    <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>
                                        Thanh toán khi nhận hàng (COD)</option>
                                    <option value="bank_transfer"
                                        {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Chuyển khoản
                                        ngân hàng</option>
                                    <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>
                                        PayPal</option>
                                </select>
                                @error('payment_method')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Nút xác nhận -->
                        <div class="flex justify-between items-center">
                            <div class="text-xl font-semibold">
                                Tổng cộng: <span
                                    class="text-rose-500">{{ number_format($total, 0, ',', '.') }}₫</span>
                            </div>
                            <button type="submit"
                                class="bg-rose-500 text-white px-6 py-3 rounded hover:bg-rose-600 shadow">
                                Xác nhận thanh toán
                            </button>
                        </div>

                        @if ($errors->any())
                            <div class="bg-red-100 text-red-700 p-2 mt-3 rounded">
                                <ul class="list-disc pl-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                </form>
            @else
                <div class="text-center py-20">
                    <p class="text-lg text-gray-600">😥 Giỏ hàng của bạn hiện đang trống.</p>
                    <a href="{{ route('site.home') }}"
                        class="mt-6 inline-block bg-rose-500 text-white px-6 py-3 rounded hover:bg-rose-600 shadow-lg">Tiếp
                        tục mua sắm</a>
                </div>
            @endif
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 text-gray-600 py-6">
        <div class="max-w-7xl mx-auto text-center space-y-2">
            <p class="text-sm">© 2025 TyuuMei. All rights reserved.</p>
            <div class="flex justify-center space-x-4">
                <a href="#" class="hover:text-rose-500"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-rose-500"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-rose-500"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <!-- JavaScript kiểm tra có chọn sản phẩm nào không -->
    <script>
        const form = document.getElementById('checkoutForm');
        form.addEventListener('submit', function(e) {
            const checked = document.querySelectorAll('.item-checkbox:checked');
            if (checked.length === 0) {
                e.preventDefault();
                alert('Vui lòng chọn ít nhất một sản phẩm để thanh toán.');
            }
        });
    </script>

</body>

</html>
