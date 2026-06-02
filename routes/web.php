<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\ProductController as SanphamController;
use App\Http\Controllers\frontend\ContactController as LienheController;
use App\Http\Controllers\frontend\AuthController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\UserController as FrontendUserController;
use App\Http\Controllers\frontend\PostController as BaiVietController;
use App\Http\Controllers\frontend\SiteController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\OrderController as DonHangController;
use App\Http\Controllers\frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\frontend\Auth\ResetPasswordController;
use App\Http\Controllers\frontend\ShippingTrackingController;


use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\TopicController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\MenuController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\OrderDetailController;
use App\Http\Controllers\backend\AdminAuthController;
use App\Http\Controllers\backend\VnPayController;

use App\Http\Controllers\Admin\ShippingController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('site.home');
Route::get('/san-pham', [SanphamController::class, 'index'])->name('site.product');
Route::get('/san-pham/{slug}', [SanphamController::class, 'product_detail'])->name('site.product_detail');
Route::get('/danh-muc/{category_slug}', [SanphamController::class, 'category'])->name('site.product.category');
Route::get('thuong-hieu/{brand_slug}', [SanphamController::class, 'brand'])->name('site.product.brand');
Route::get('/ajax/search', [App\Http\Controllers\frontend\ProductController::class, 'ajaxSearch'])->name('ajax.search');


Route::get('/lien-he', [LienheController::class, 'index'])->name('site.contact');
Route::post('/lien-he', [LienheController::class, 'store'])->name('site.contact.store');


// Route login và register
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');

Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.post');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

//Thông tin tài khoản-chỉnh sửa-đổi mật khẩu
Route::middleware(['auth'])->group(function () {
    Route::get('/tai-khoan', [FrontendUserController::class, 'index'])->name('user.profile');

    Route::get('/tai-khoan/chinh-sua', [FrontendUserController::class, 'edit'])->name('frontend.user.edit');
    Route::put('/tai-khoan', [FrontendUserController::class, 'update'])->name('frontend.user.update');

    Route::get('/tai-khoan/doi-mat-khau', [FrontendUserController::class, 'showChangePasswordForm'])->name('user.password.change');
    Route::post('/tai-khoan/doi-mat-khau', [FrontendUserController::class, 'changePassword'])->name('user.password.update');
});
//Quên mật khẩu
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Xử lý gửi email reset password
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Form reset mật khẩu (link có token)
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Xử lý reset mật khẩu
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

//Thanh toán
Route::prefix('checkout')->name('site.')->middleware('auth')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index'); // GET: /checkout
    Route::post('/', [CheckoutController::class, 'store'])->name('checkout.store'); // POST: /checkout
    Route::get('confirm/{id}', [CheckoutController::class, 'confirm'])->name('checkout.confirm'); // GET: /checkout/confirm/{id}
    Route::post('buy-now', [CheckoutController::class, 'buyNow'])->name('checkout.buy_now');
});
// Danh sách bài viết
Route::get('bai-viet', [BaiVietController::class, 'index'])->name('site.post');

// Chi tiết bài viết
Route::get('chi-tiet-bai-viet/{slug}', [BaiVietController::class, 'post_detail'])->name('site.post.detail');
Route::get('chu-de/{slug}', [BaiVietController::class, 'topic'])->name('site.post.topic');
Route::get('bai-viet-moi', [BaiVietController::class, 'new_post'])->name('site.post.new');

//
Route::middleware(['auth'])->group(function () {
    Route::get('/order-history', [DonHangController::class, 'history'])->name('order.history');
    Route::get('/order/confirm/{id}', [DonHangController::class, 'confirm'])->name('site.order.confirm');
    Route::post('/order/{id}/cancel', [DonHangController::class, 'cancel'])->name('order.cancel');
    Route::get('/order/cancel-success', [DonHangController::class, 'cancelSuccess'])->name('order.cancel.success');
});

// Giới thiệu
Route::get('/gioi-thieu', [SiteController::class, 'about'])->name('site.about');

// Giỏ hàng
Route::prefix('gio-hang')->name('site.cart.')->group(function () {
    // Hiển thị giỏ hàng
    Route::get('/', [CartController::class, 'index'])->name('index');

    // Thêm sản phẩm vào giỏ hàng
    Route::post('addcart', [CartController::class, 'addcart'])
        ->name('addcart')
        ->middleware('auth'); // Bắt buộc đăng nhập mới thêm giỏ hàng

    // Xóa sản phẩm khỏi giỏ hàng
    Route::delete('remove/{id}', [CartController::class, 'remove'])->name('remove');

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    Route::post('update/{id}', [CartController::class, 'update'])->name('update');
    // Xóa toàn bộ giỏ hàng
    Route::delete('clear', [CartController::class, 'clear'])->name('clear');
    Route::get('count', [CartController::class, 'getCartCount'])->name('count');
    Route::post('checkout-selected', [CheckoutController::class, 'checkoutSelected'])->name('checkoutSelected');
});
//giao hàng
Route::get('/shipping/{order}', [ShippingTrackingController::class, 'show'])->name('shipping.track');


//admin vận chuyển đơn hàng
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('shipping/create/{order}', [ShippingController::class, 'create'])->name('shipping.create');
    Route::post('shipping/store', [ShippingController::class, 'store'])->name('shipping.store');
});

//Admin-đăng nhập-đăng ký-đăng xuất
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
// Các route admin phải đăng nhập mới truy cập được
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Product routes
    Route::prefix('product')->group(function () {
        Route::get('trash', [ProductController::class, 'trash'])->name('product.trash');
        Route::get('restore/{product}', [ProductController::class, 'restore'])->name('product.restore');
        Route::get('status/{product}', [ProductController::class, 'status'])->name('product.status');
    });
    Route::delete('delete/{product}', [ProductController::class, 'delete'])->name('product.delete');
    // Tự động có cả route DELETE dùng cho destroy:
    Route::resource('product', ProductController::class);


    // Category routes
    Route::prefix('category')->group(function () {
        Route::get('trash', [CategoryController::class, 'trash'])->name('category.trash');
        Route::get('restore/{category}', [CategoryController::class, 'restore'])->name('category.restore');
        Route::get('status/{category}', [CategoryController::class, 'status'])->name('category.status');
        Route::delete('delete/{category}', [CategoryController::class, 'delete'])->name('category.delete'); // chỉ giữ cái này
    });

    Route::resource('category', CategoryController::class);


    // Banner routes
    Route::prefix('banner')->group(function () {
        Route::get('trash', [BannerController::class, 'trash'])->name('banner.trash');
        Route::delete('banner/delete/{banner}', [BannerController::class, 'delete'])->name('banner.delete');
        Route::get('restore/{banner}', [BannerController::class, 'restore'])->name('banner.restore');
        Route::get('status/{banner}', [BannerController::class, 'status'])->name('banner.status');
    });
    Route::resource('banner', BannerController::class);

    // Brand routes
    Route::prefix('brand')->group(function () {
        Route::get('trash', [BrandController::class, 'trash'])->name('brand.trash');
        Route::delete('brand/delete/{brand}', [BrandController::class, 'delete'])->name('brand.delete');
        Route::get('restore/{brand}', [BrandController::class, 'restore'])->name('brand.restore');
        Route::get('status/{brand}', [BrandController::class, 'status'])->name('brand.status');
    });
    Route::resource('brand', BrandController::class);

    // Post routes
    Route::prefix('post')->group(function () {
        Route::get('trash', [PostController::class, 'trash'])->name('post.trash');
        Route::delete('post/delete/{post}', [PostController::class, 'delete'])->name('post.delete');
        Route::get('restore/{post}', [PostController::class, 'restore'])->name('post.restore');
        Route::get('status/{post}', [PostController::class, 'status'])->name('post.status');
    });
    Route::resource('post', PostController::class);

    // Topic routes
    Route::prefix('topic')->group(function () {
        Route::get('trash', [TopicController::class, 'trash'])->name('topic.trash');
        Route::delete('topic/delete/{topic}', [TopicController::class, 'delete'])->name('topic.delete');
        Route::get('restore/{topic}', [TopicController::class, 'restore'])->name('topic.restore');
        Route::get('status/{topic}', [TopicController::class, 'status'])->name('topic.status');
    });
    Route::resource('topic', TopicController::class);

    // Contact routes
    Route::prefix('contact')->group(function () {
        Route::get('trash', [ContactController::class, 'trash'])->name('contact.trash');
        Route::delete('contact/delete/{contact}', [ContactController::class, 'delete'])->name('contact.delete');
        Route::get('restore/{contact}', [ContactController::class, 'restore'])->name('contact.restore');
        Route::get('status/{contact}', [ContactController::class, 'status'])->name('contact.status');
    });
    Route::resource('contact', ContactController::class);

    // Menu routes
    Route::prefix('menu')->group(function () {
        Route::get('trash', [MenuController::class, 'trash'])->name('menu.trash');
        Route::delete('menu/delete/{menu}', [MenuController::class, 'delete'])->name('menu.delete');
        Route::get('restore/{menu}', [MenuController::class, 'restore'])->name('menu.restore');
        Route::get('status/{menu}', [MenuController::class, 'status'])->name('menu.status');
    });
    Route::resource('menu', MenuController::class);

    // User routes
    Route::prefix('user')->group(function () {
        Route::get('trash', [UserController::class, 'trash'])->name('user.trash');
        Route::delete('user/delete/{user}', [UserController::class, 'delete'])->name('user.delete');
        Route::get('restore/{user}', [UserController::class, 'restore'])->name('user.restore');
        Route::get('status/{user}', [UserController::class, 'status'])->name('user.status');
    });
    Route::resource('user', UserController::class);

    // Order routes
    Route::prefix('order')->group(function () {
        Route::get('trash', [OrderController::class, 'trash'])->name('order.trash');
        Route::delete('order/delete/{order}', [OrderController::class, 'delete'])->name('order.delete');
        Route::get('restore/{order}', [OrderController::class, 'restore'])->name('order.restore');
        Route::get('status/{order}', [OrderController::class, 'status'])->name('order.status');
    });
    Route::resource('order', OrderController::class);

    // Order Detail routes
    Route::prefix('order_detail')->group(function () {
        Route::get('trash', [OrderDetailController::class, 'trash'])->name('order_detail.trash');
        Route::get('delete/{orderDetail}', [OrderDetailController::class, 'delete'])->name('order_detail.delete');
        Route::get('restore/{orderDetail}', [OrderDetailController::class, 'restore'])->name('order_detail.restore');
        Route::get('destroy/{orderDetail}', [OrderDetailController::class, 'destroy'])->name('order_detail.destroy');
    });
    // Route resource phải đặt sau cùng để không bị chồng tên
    Route::resource('order-detail', OrderDetailController::class);
    //
    Route::get('/vnpay/payment-success', [VnPayController::class, 'paymentSuccess'])->name('vnpay.payment.success');
});
