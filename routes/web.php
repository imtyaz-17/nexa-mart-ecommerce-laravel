<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\DiscountCouponController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

//Route::get('/test', function () {
//   orderEmail(1);
//});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop/{categorySlug?}/{subCategorySlug?}', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{slug?}', [ShopController::class, 'product'])->name('product');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/add-to-wishlist', [HomeController::class, 'addToWishlist'])->name('add-to-wishlist');

Route::get('/about-us', function () {
    return view('front.static-pages.about-us');
})->name('about-us');
Route::get('/contact-us', function () {
    return view('front.static-pages.contact-us');
})->name('contact-us');
Route::get('/privacy-policy', function () {
    return view('front.static-pages.privacy');
})->name('privacy-policy');
Route::get('/terms-conditions', function () {
    return view('front.static-pages.terms-conditions');
})->name('terms-conditions');
Route::get('/refund-policy', function () {
    return view('front.static-pages.refund');
})->name('refund-policy');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.process-checkout');
    Route::post('/get-order-summery', [CartController::class, 'getOrderSummary'])->name('cart.get-order-summery');
    Route::post('/apply-discount', [CartController::class, 'applyDiscount'])->name('cart.apply-discount');
    Route::post('/remove-coupon', [CartController::class, 'removeCoupon'])->name('cart.remove-coupon');
    Route::get('/thanks/{orderId}', [CartController::class, 'thankYou'])->name('thanks');

    // User Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/address', [ProfileController::class, 'updateAddress'])->name('profile.address.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/orders', [ProfileController::class, 'myOrders'])->name('profile.orders');
    Route::get('/orders/{order}', [ProfileController::class, 'myOrderDetails'])->name('profile.order-details');
    Route::get('/my-wishlist', [ProfileController::class, 'wishlist'])->name('profile.wishlist');
    Route::delete('/remove-from-wishlist/{wishlist}', [ProfileController::class, 'removeFromWishlist'])->name('profile.remove-from-wishlist');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    });

    Route::middleware('auth.admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        // Image Upload Route - Dropzone
        Route::post('/image/upload/{folder}', [ImageUploadController::class, 'uploadImage'])->name('image.upload');
        // Delete Upload Image Route
        Route::delete('/image/delete/{image}', [ImageUploadController::class, 'deleteImage'])->name('image.delete');

        // Category Routes
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');

        // Sub Category Routes
        Route::get('/subcategories', [SubCategoryController::class, 'index'])->name('admin.subcategories.index');
        Route::get('/subcategories/create', [SubCategoryController::class, 'create'])->name('admin.subcategories.create');
        Route::post('/subcategories/store', [SubCategoryController::class, 'store'])->name('admin.subcategories.store');
        Route::get('/subcategories/{subcategory}/edit', [SubCategoryController::class, 'edit'])->name('admin.subcategories.edit');
        Route::put('/subcategories/{subcategory}', [SubCategoryController::class, 'update'])->name('admin.subcategories.update');
        Route::delete('/subcategories/{subcategory}', [SubCategoryController::class, 'destroy'])->name('admin.subcategories.delete');

        // Brand Routes
        Route::get('/brands', [BrandController::class, 'index'])->name('admin.brands.index');
        Route::get('/brands/create', [BrandController::class, 'create'])->name('admin.brands.create');
        Route::post('/brands/store', [BrandController::class, 'store'])->name('admin.brands.store');
        Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('admin.brands.edit');
        Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('admin.brands.update');
        Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('admin.brands.delete');

        // Product Routes
        Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::get('/product-subcategories/{categoryId}', [ProductController::class, 'productSubcategories']);
        Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.delete');

        // Shipping Routes
        Route::get('/shipping', [ShippingController::class, 'index'])->name('admin.shipping.index');
        Route::get('/shipping/create', [ShippingController::class, 'create'])->name('admin.shipping.create');
        Route::post('/shipping/store', [ShippingController::class, 'store'])->name('admin.shipping.store');
        Route::get('/shipping/{shipping}/edit', [ShippingController::class, 'edit'])->name('admin.shipping.edit');
        Route::put('/shipping/{shipping}', [ShippingController::class, 'update'])->name('admin.shipping.update');
        Route::delete('/shipping/{shipping}', [ShippingController::class, 'destroy'])->name('admin.shipping.delete');

        // Discount coupon Routes
        Route::get('/coupons', [DiscountCouponController::class, 'index'])->name('admin.coupons.index');
        Route::get('/coupons/create', [DiscountCouponController::class, 'create'])->name('admin.coupons.create');
        Route::post('/coupons/store', [DiscountCouponController::class, 'store'])->name('admin.coupons.store');
        Route::get('/coupons/{coupon}/edit', [DiscountCouponController::class, 'edit'])->name('admin.coupons.edit');
        Route::put('/coupons/{coupon}', [DiscountCouponController::class, 'update'])->name('admin.coupons.update');
        Route::delete('/coupons/{coupon}', [DiscountCouponController::class, 'destroy'])->name('admin.coupons.delete');

        //Orders Routes
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'orderDetail'])->name('admin.orders.detail');
        Route::post('/orders/change-status/{order}', [OrderController::class, 'changeOrderStatus'])->name('admin.orders.change-status');
        Route::post('/orders/send-invoice/{order}', [OrderController::class, 'sendInvoiceEmail'])->name('admin.orders.send-invoice-email');

        //Users Routes
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.delete');

        //Setting Routes
        Route::get('/change-password', [SettingController::class, 'changePasswordForm'])->name('admin.change-password');
        Route::put('/change-password', [SettingController::class, 'processChangePassword'])->name('admin.process-change-password');

    });
});

require __DIR__ . '/auth.php';
