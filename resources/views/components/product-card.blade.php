<!-- Thẻ sản phẩm -->
<div
    class="w-full flex flex-col bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <!-- Hình ảnh sản phẩm -->
    <a href="{{ route('site.product_detail', ['slug' => $product->slug]) }}">
        <img src="{{ asset('assets/images/product/' . ($product->thumbnail ?? 'no-image.png')) }}"
            alt="{{ $product->name }}" class="w-full h-64 object-cover">
    </a>

    <!-- Nội dung sản phẩm -->
    <div class="flex flex-col justify-between p-4 text-center h-full">
        <div>
            <!-- Tên sản phẩm -->
            <h3 class="text-lg font-semibold text-gray-800">
                {{ $product->name }}
            </h3>

            <!-- Mô tả -->
            <p class="text-sm text-gray-500 mb-1">High-class</p>

            <!-- Giá sản phẩm -->
            <div class="mb-4">
                @if ($product->price_sale && $product->price_sale > 0)
                    <p class="text-sm text-gray-400 line-through">
                        {{ number_format($product->price_root, 0, ',', '.') }}₫
                    </p>
                    <p class="text-lg font-bold text-red-500">
                        {{ number_format($product->price_sale, 0, ',', '.') }}₫
                    </p>
                @else
                    <p class="text-lg font-bold text-rose-500">
                        {{ number_format($product->price_root, 0, ',', '.') }}₫
                    </p>
                @endif
            </div>
        </div>

        <!-- Các nút hành động -->
        <div class="flex justify-between items-center gap-2 mt-4">
            <!-- Nút thêm vào giỏ -->
            <button
                class="flex-1 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-full text-sm font-medium transition text-center"
                onclick="addToCart(event, {{ $product->id }})">
                Thêm vào giỏ 🛒
            </button>

            <!-- Nút mua ngay -->
            @if (session('error'))
                <div id="toast-message" class="mt-4 px-4 py-3 bg-red-100 text-red-700 rounded shadow-md">
                    <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('site.checkout.buy_now') }}" method="POST" class="flex-1">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="qty" id="buyQty" value="1">
                <button type="submit"
                    class="w-full bg-rose-500 hover:bg-rose-600 text-white px-4 py-2 rounded-full text-sm font-semibold transition text-center">
                    Mua ngay
                </button>
            </form>
            <script>
                const qtyInput = document.getElementById('qty');
                const buyQty = document.getElementById('buyQty');

                if (qtyInput && buyQty) {
                    qtyInput.addEventListener('input', function() {
                        buyQty.value = qtyInput.value;
                    });
                }

                // Tự ẩn thông báo lỗi sau 3 giây
                setTimeout(() => {
                    const toast = document.getElementById('toast-message');
                    if (toast) {
                        toast.style.opacity = '0';
                        setTimeout(() => toast.remove(), 500);
                    }
                }, 3000);
            </script>
        </div>
    </div>
</div>

<!-- Thẻ meta CSRF token (đảm bảo có trong <head> layout bạn dùng) -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const addToCartUrl = "{{ route('site.cart.addcart') }}";
    const cartCountUrl = "{{ route('site.cart.count') }}";

    let isUnauthorizedHandled = false; // cờ để chỉ show 1 lần thông báo 401

    function addToCart(event, productId) {
        const button = event.currentTarget;
        button.disabled = true;

        fetch(addToCartUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    productid: productId,
                    qty: 1
                })
            })
            .then(res => {
                if (!res.ok) {
                    if (res.status === 401) {
                        if (!isUnauthorizedHandled) {
                            isUnauthorizedHandled = true;
                            showNotification('Vui lòng đăng nhập để mua hàng.', 'error');
                            setTimeout(() => window.location.href = "{{ route('login') }}", 1500);
                        }
                        throw new Error('Unauthorized');
                    }
                    return res.json().then(data => {
                        throw data;
                    });
                }
                return res.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    showNotification(data.message, 'success');
                    updateCartCount(data.count);
                } else {
                    showNotification(data.message || 'Lỗi không xác định', 'error');
                }
            })
            .catch(err => {
                if (err.message === 'Unauthorized') {
                    // Không hiện thông báo lần 2
                    return;
                }
                if (typeof err === 'object' && err.message) {
                    showNotification(err.message, 'error');
                } else {
                    showNotification('Đã xảy ra lỗi, vui lòng thử lại.', 'error');
                }
            })
            .finally(() => {
                button.disabled = false;
            });
    }

    function updateCartCount(count = null) {
        if (count !== null) {
            const cartCount = document.querySelector('#cart-count');
            if (cartCount) cartCount.innerText = count;
            return;
        }

        fetch(cartCountUrl, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const cartCount = document.querySelector('#cart-count');
                    if (cartCount) cartCount.innerText = data.count;
                }
            })
            .catch(console.error);
    }

    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.classList.add(
            'fixed', 'bottom-5', 'right-5', 'z-50',
            'flex', 'items-center', 'gap-3',
            'px-5', 'py-3', 'rounded-lg', 'shadow-2xl',
            'text-white', 'text-sm', 'font-medium',
            'animate-slide-in', 'transition-all', 'duration-300',
            'max-w-sm'
        );

        const icon = type === 'success' ? `
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        ` : `
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        `;

        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        notification.classList.add(bgColor);

        notification.innerHTML = `
            ${icon}
            <span class="flex-1">${message}</span>
            <button onclick="this.parentElement.remove()" class="text-white hover:text-gray-200 text-lg font-bold">&times;</button>
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.add('opacity-0', 'translate-y-2');
            setTimeout(() => notification.remove(), 300);
        }, 4000);
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateCartCount();
    });
</script>

<style>
    @keyframes slide-in {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-in {
        animation: slide-in 0.3s ease-out;
    }
</style>
