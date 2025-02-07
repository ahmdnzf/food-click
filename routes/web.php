<?php

use App\Events\RTOrderPlacedNotificationEvent;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ChatController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CustomPageController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\Frontendcontroller;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/** Admin Auth Routes */
Route::group(['middleware' => 'guest'], function () {
    Route::get('admin/login', [AdminAuthController::class, 'index'])->name('admin.login');
    Route::get('admin/forget-password', [AdminAuthController::class, 'forgetPassword'])->name('admin.forget-password');
});


/** User Auth Routes */
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::post('address', [DashboardController::class, 'createAddress'])->name('address.store');
    Route::put('address/{id}/edit', [DashboardController::class, 'updateAddress'])->name('address.update');
    Route::delete('address/{id}', [DashboardController::class, 'destroyAddress'])->name('address.destroy');
    // Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');

    /** Chat Routes */
    Route::post('chat/send-message', [ChatController::class, 'sendMessage'])->name('chat.send-message');
    Route::get('chat/get-conversation/{senderId}',[ChatController::class, 'getConversation'])->name('chat.get-conversation');


});


require __DIR__ . '/auth.php';

/** Show home page */
Route::get('/', [Frontendcontroller::class, 'index'])->name('home');

/** Chef Page */
Route::get('/chef', [Frontendcontroller::class, 'chef'])->name('chef');

/** Testimonial Page */
Route::get('/testimonials', [Frontendcontroller::class, 'testimonial'])->name('testimonial');

/** About Page */
Route::get('/about', [Frontendcontroller::class, 'about'])->name('about');

/** Contact Page */
Route::get('/contact', [Frontendcontroller::class, 'contact'])->name('contact.index');
Route::post('/contact', [FrontendController::class, 'sendContactMessage'])->name('contact.send-message');

/** Custom Page Routes */
Route::get('/page/{slug}', CustomPageController::class);

/** Product page Route*/
Route::get('/products', [FrontendController::class, 'products'])->name('product.index');

/** Show product details page */
Route::get('/product/{slug}', [Frontendcontroller::class, 'showProduct'])->name('product.show');

/** Product Modal Route */
Route::get('/load-product-modal/{productId}', [Frontendcontroller::class, 'loadProductModal'])->name('load-product-modal');

/** Product Review Route */
Route::post('product-review', [FrontendController::class, 'productReviewStore'])->name('product-review.store');

/** Add to cart Route */
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('get-cart-products', [CartController::class, 'getCartProduct'])->name('get-cart-products');
Route::get('cart-product-remove/{rowId}', [CartController::class, 'cartProductRemove'])->name('cart-product-remove');

/** Cart page Route */
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart-update-qty', [CartController::class, 'cartQtyUpdate'])->name('cart.quantity-update');
Route::get('/cart-destroy', [CartController::class, 'cartDestroy'])->name('cart.destroy');

/** Coupon Route */
Route::post('/apply-coupon', [FrontendController::class, 'applyCoupon'])->name('apply-coupon');
Route::get('/destroy-coupon', [FrontendController::class, 'destroyCoupon'])->name('destroy-coupon');

/** Checkout Routes */
Route::group(['middleware' => 'auth'], function () {
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('checkout/{id}/delivery-calc', [CheckoutController::class, 'CalculateDeliveryCharge'])->name('checkout.delivery-calc');
    Route::post('checkout', [CheckoutController::class, 'checkoutRedirect'])->name('checkout.redirect');


    /** Payment Routes */
    Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('make-payment', [PaymentController::class, 'makePayment'])->name('make-payment');

    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('payment-cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');

    /** Stripe Routes */
    Route::get('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
    Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
    Route::get('stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');



});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
