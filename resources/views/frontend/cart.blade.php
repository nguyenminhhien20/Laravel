<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Giỏ Hàng - TyuuMei</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
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

    <main class="flex-grow">
        <section class="container mx-auto px-6 py-12">
            <h3 class="text-2xl font-bold text-center mb-10 text-rose-500">🛒 Giỏ Hàng Của Bạn</h3>

            @if (count($list_cart) > 0)
                <div class="overflow-x-auto bg-white shadow rounded-lg">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b bg-gray-100">
                                <th class="px-4 py-2 text-center">
                                    <input type="checkbox" id="select-all" class="form-checkbox w-5 h-5 text-rose-500">
                                </th>
                                <th class="px-4 py-2">Sản phẩm</th>
                                <th class="px-4 py-2">Giá</th>
                                <th class="px-4 py-2">Số lượng</th>
                                <th class="px-4 py-2">Thành tiền</th>
                                <th class="px-4 py-2">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_cart as $item)
                                @php
                                    $id = $item['id'];
                                    $qty = $item['qty'];
                                    $price = $item['price_sale'] > 0 ? $item['price_sale'] : $item['price_root'];
                                    $subtotal = $qty * $price;
                                @endphp
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="text-center px-4 py-2">
                                        <input type="checkbox" name="selected_items[]" value="{{ $id }}"
                                            class="item-checkbox form-checkbox w-5 h-5 text-rose-500"
                                            data-subtotal="{{ $subtotal }}" form="checkout-form">
                                    </td>
                                    <td class="flex items-center space-x-4 px-4 py-2">
                                        <img src="{{ file_exists(public_path('assets/images/product/' . $item['thumbnail'])) ? asset('assets/images/product/' . $item['thumbnail']) : asset('build/assets/images/no-image.png') }}"
                                            class="w-16 h-16 object-cover rounded border">
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $item['name'] }}</p>
                                            {{-- <p class="text-sm text-gray-500">{{ $item['description'] ?? 'Không có mô tả' }}</p> --}}
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 text-rose-600 font-medium">
                                        {{ number_format($price, 0, ',', '.') }}₫
                                    </td>
                                    <td class="px-4 py-2">
                                        <div class="flex space-x-2 items-center">
                                            <button type="button" onclick="updateQty({{ $item['id'] }}, 'decrease')"
                                                class="px-2 bg-gray-200 hover:bg-gray-300 rounded">-</button>

                                            <input type="number" min="1" max="{{ $item['max_qty'] ?? 100 }}"
                                                value="{{ $qty }}"
                                                class="w-16 text-center bg-white rounded border"
                                                onchange="updateQtyManual({{ $item['id'] }}, this.value)"
                                                onkeydown="if(event.key === 'Enter') event.preventDefault();">

                                            <button type="button" onclick="updateQty({{ $item['id'] }}, 'increase')"
                                                class="px-2 bg-gray-200 hover:bg-gray-300 rounded">+</button>
                                        </div>
                                    </td>

                                    <td class="px-4 py-2 font-semibold text-gray-700">
                                        {{ number_format($subtotal, 0, ',', '.') }}₫
                                    </td>
                                    <td class="px-4 py-2">
                                        <form action="{{ route('site.cart.remove', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash-alt"></i> Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- FORM RIÊNG để checkout -->
                <form id="checkout-form" action="{{ route('site.cart.checkoutSelected') }}" method="POST">
                    @csrf
                    @if (session('error') || session('message'))
                        <div class="w-full md:w-auto mb-4 md:mb-0">
                            <div
                                class="flex items-center px-4 py-2 text-sm rounded-md shadow-md
                {{ session('error') ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                <i
                                    class="fas {{ session('error') ? 'fa-exclamation-circle' : 'fa-check-circle' }} mr-2"></i>
                                <span>{{ session('error') ?? session('message') }}</span>
                            </div>
                        </div>
                    @endif
                    <div class="flex flex-col md:flex-row justify-between items-center mt-6">
                        <div class="text-lg font-semibold">
                            Tổng cộng: <span id="total-amount" class="text-rose-500">0₫</span>
                        </div>
                        <div class="space-x-4 mt-4 md:mt-0">
                            <a href="{{ route('site.home') }}"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded shadow">
                                <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
                            </a>
                            <button type="submit"
                                class="bg-rose-500 hover:bg-rose-600 text-white px-4 py-2 rounded shadow">
                                <i class="fas fa-credit-card"></i> Đặt hàng 
                            </button>
                        </div>
                    </div>
                </form>
            @else
                <div class="text-center py-20">
                    <p class="text-lg text-gray-600">😥 Giỏ hàng của bạn hiện đang trống.</p>
                    <a href="{{ route('site.home') }}"
                        class="mt-6 inline-block bg-rose-500 text-white px-6 py-3 rounded hover:bg-rose-600 shadow-lg">
                        Tiếp tục mua sắm
                    </a>
                </div>
            @endif
        </section>
    </main>

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

    <script>
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.item-checkbox:checked').forEach(cb => {
                total += parseInt(cb.dataset.subtotal);
            });
            document.getElementById('total-amount').textContent = total.toLocaleString('vi-VN') + '₫';
        }

        document.getElementById('select-all')?.addEventListener('change', function() {
            document.querySelectorAll('.item-checkbox').forEach(cb => {
                cb.checked = this.checked;
            });
            updateTotal();
        });

        document.querySelectorAll('.item-checkbox').forEach(cb => {
            cb.addEventListener('change', updateTotal);
        });

        updateTotal();

        function updateQty(id, action) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/gio-hang/update/${id}`;

            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrf;
            form.appendChild(csrfInput);

            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = action;
            form.appendChild(actionInput);

            document.body.appendChild(form);
            form.submit();
        }
    </script>
    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast-message');
            if (toast) {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 500);
            }
        }, 3000);
    </script>
    <script>
        function updateQtyManual(id, qty) {
            qty = parseInt(qty);
            if (isNaN(qty) || qty < 1) {
                alert('Số lượng không hợp lệ');
                return;
            }

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/gio-hang/update/${id}`;

            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            form.innerHTML = `
            <input type="hidden" name="_token" value="${csrf}">
            <input type="hidden" name="action" value="manual">
            <input type="hidden" name="qty" value="${qty}">
        `;

            document.body.appendChild(form);
            form.submit();
        }
    </script>


</body>

</html>
