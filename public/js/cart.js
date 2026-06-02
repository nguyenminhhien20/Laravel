const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const addToCartUrl = "{{ route('site.cart.addcart') }}";
const cartCountUrl = "{{ route('site.cart.count') }}"; // API để lấy số lượng giỏ hàng

// Thêm sản phẩm vào giỏ hàng
function addToCart(productId) {
    let qty = 1; // Số lượng mặc định

    fetch(addToCartUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            productid: productId,
            qty: qty
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showNotification(data.message);
            // Cập nhật số lượng giỏ hàng sau khi thêm sản phẩm thành công
            updateCartCount(); // Chỉ cần gọi hàm này để cập nhật giỏ hàng mà không phải reload trang
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Đã xảy ra lỗi, vui lòng thử lại.', 'error');
    });
}

// Cập nhật số lượng giỏ hàng
function updateCartCount() {
    fetch(cartCountUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const cartCount = document.querySelector('#cart-count');
            if (cartCount) {
                cartCount.innerText = data.count; // Cập nhật số lượng giỏ hàng
            }
        } else {
            console.warn('Không thể cập nhật giỏ hàng:', data.message || 'Lỗi không xác định.');
        }
    })
    .catch(error => {
        console.error('Lỗi khi cập nhật giỏ hàng:', error);
    });
}

// Hiển thị thông báo
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.classList.add(
        'fixed', 'top-5', 'right-5', 'z-50',
        'px-4', 'py-2', 'rounded-lg', 'shadow-lg',
        'text-white', 'text-sm', 'font-medium', 'transition'
    );

    if (type === 'success') {
        notification.classList.add('bg-green-500');
    } else {
        notification.classList.add('bg-red-500');
    }

    notification.innerText = message;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Tự động cập nhật giỏ hàng khi load trang
document.addEventListener('DOMContentLoaded', () => {
    updateCartCount(); // Lấy số lượng giỏ hàng ngay khi trang được tải
});
