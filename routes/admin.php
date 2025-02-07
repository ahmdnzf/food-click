<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\ChefController;
use App\Http\Controllers\Admin\ClearDatabaseController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomPageBuilderController;
use App\Http\Controllers\Admin\DeliveryAreaController;
use App\Http\Controllers\Admin\FooterInfoController;
use App\Http\Controllers\Admin\MenuBuilderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentGatewaySettingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\ProductOptionController;
use App\Http\Controllers\Admin\ProductReviewController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\TestimonialController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    /** Profile Route */
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    /** Slider Route */
    Route::resource('slider', SliderController::class);

    /** Chefs Route */
    Route::put('chefs-title-update', [ChefController::class, 'updateTitle'])->name('chefs-title-update');
    Route::resource('chefs', ChefController::class);

    /** Testimonial Route */
    Route::put('testimonial-title-update', [TestimonialController::class, 'updateTitle'])->name('testimonial-title-update');
    Route::resource('testimonial', TestimonialController::class);

    /** About Routes */
    Route::get('about', [AboutController::class, 'index'])->name('about.index');
    Route::put('about', [AboutController::class, 'update'])->name('about.update');

    /** Contact Routes */
    Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
    Route::put('contact', [ContactController::class, 'update'])->name('contact.update');

    /** Social Links Routes */
    Route::resource('social-link', SocialLinkController::class);

    /** Footer Routes */
    Route::get('footer-info', [FooterInfoController::class, 'index'])->name('footer-info.index');
    Route::put('footer-info', [FooterInfoController::class, 'update'])->name('footer-info.update');

    /** Menu builder Routes */
    Route::get('menu-builder', [MenuBuilderController::class, 'index'])->name('menu-builder.index');

    // /** Custom page builder Routes */
    Route::resource('custom-page-builder', CustomPageBuilderController::class);

    /** Product Category Route */
    Route::resource('category', CategoryController::class);

    /** Product Category Route */
    Route::resource('product', ProductController::class);

    /** Product Gallery Route */
    Route::get('product-gallery/{product}', [ProductGalleryController::class, 'index'])->name('product-gallery.show-index');
    Route::resource('product-gallery', ProductGalleryController::class);

    /** Product Size Route */
    Route::get('product-size/{product}', [ProductSizeController::class, 'index'])->name('product-size.show-index');
    Route::resource('product-size', ProductSizeController::class);

    /** Product Size Route */
    Route::resource('product-option', ProductOptionController::class);

    /** Product Reviews Routes */
    Route::get('product-reviews', [ProductReviewController::class, 'index'])->name('product-reviews.index');
    Route::post('product-reviews', [ProductReviewController::class, 'updateStatus'])->name('product-reviews.update');
    Route::delete('product-reviews/{id}', [ProductReviewController::class, 'destroy'])->name('product-reviews.destroy');

    /** Coupon Route */
    Route::resource('coupon', CouponController::class);

    /** Delivery Area Route */
    Route::resource('delivery-area', DeliveryAreaController::class);

    /** Order Routes */
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    Route::get('pending-orders', [OrderController::class, 'pendingOrderIndex'])->name('pending-orders');
    Route::get('inprocess-orders', [OrderController::class, 'inProcessOrderIndex'])->name('inprocess-orders');
    Route::get('delivered-orders', [OrderController::class, 'deliveredOrderIndex'])->name('delivered-orders');
    Route::get('declined-orders', [OrderController::class, 'declinedOrderIndex'])->name('declined-orders');


    Route::get('orders/status/{id}', [OrderController::class, 'getOrderStatus'])->name('orders.status');
    Route::put('orders/status-update/{id}', [OrderController::class, 'orderStatusUpdate'])->name('orders.status-update');

    /** Order Notification Routes */
    Route::get('clear-notification', [AdminDashboardController::class, 'clearNotification'])->name('clear-notification');

    /** chat Routes */
    Route::get('chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('chat/get-conversation/{senderId}', [ChatController::class, 'getConversation'])->name('chat.get-conversation');
    Route::post('chat/send-message', [ChatController::class, 'sendMessage'])->name('chat.send-message');

    /** Admin management Routes */
    Route::resource('admin-management', AdminManagementController::class);


    /** Payment Gateway Setting Routes */
    Route::get('/payment-gateway-setting', [PaymentGatewaySettingController::class, 'index'])->name('payment-setting.index');
    Route::put('/stripe-setting', [PaymentGatewaySettingController::class, 'stripeSettingUpdate'])->name('stripe-setting.update');
    

    /** Setting Route */
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/general-setting', [SettingController::class, 'UpdateGeneralSetting'])->name('general-setting.update');
    Route::put('/pusher-setting', [SettingController::class, 'UpdatePusherSetting'])->name('pusher-setting.update');
    Route::put('/mail-setting', [SettingController::class, 'UpdateMailSetting'])->name('mail-setting.update');
    Route::put('/logo-setting', [SettingController::class, 'UpdateLogoSetting'])->name('logo-setting.update');
    Route::put('/appearance-setting', [SettingController::class, 'UpdateAppearanceSetting'])->name('appearance-setting.update');
    Route::put('/seo-setting', [SettingController::class, 'UpdateSeoSetting'])->name('seo-setting.update');

    /** Clear Database Routes */
    Route::get('/clear-database', [ClearDatabaseController::class, 'index'])->name('clear-database.index');
    Route::post('/clear-database', [ClearDatabaseController::class, 'clearDB'])->name('clear-database.destroy');
});
