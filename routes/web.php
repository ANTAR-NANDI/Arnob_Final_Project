<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
/*
|--------------------------------------------------------------------------
| Web Routes 
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|Route::get('/user/{id}', [UserController::class, 'show']);
*/
//Auth Related Routes
// Reset password
Route::post('password-reset', 'FrontendController@showResetForm')->name('password.reset');
// Socialite 
Route::get('login/{provider}/', 'Auth\LoginController@redirect')->name('login.redirect');
Route::get('login/{provider}/callback/', 'Auth\LoginController@Callback')->name('login.callback');
Route::get('/', function () {
    return view('welcome');
});
// Route::get('product-detail/{slug}', [FrontendController::class, 'productDetail'])->name('product-detail');
// Route::post('/product/search', 'FrontendController@productSearch')->name('product.search');
// Route::get('/product-cat/{slug}', 'FrontendController@productCat')->name('product-cat');
Route::get('/product-sub-cat/{slug}/{sub_slug}', 'FrontendController@productSubCat')->name('product-sub-cat');
// Route::get('/product-brand/{slug}', 'FrontendController@productBrand')->name('product-brand');
// Route::post('cart/order', 'OrderController@store')->name('cart.order');
// Route::get('order/pdf/{id}', 'OrderController@pdf')->name('order.pdf');
Route::get('/income', 'OrderController@incomeChart')->name('product.order.income');
// Route::get('/user/chart','AdminController@userPieChart')->name('user.piechart');
// Route::get('/product-grids', 'FrontendController@productGrids')->name('product-grids');
// Route::get('/product-lists', 'FrontendController@productLists')->name('product-lists');
// Route::match(['get', 'post'], '/filter', 'FrontendController@productFilter')->name('shop.filter');
// NewsLetter
Route::post('/subscribe', 'FrontendController@subscribe')->name('subscribe');
Route::post('product/{slug}/review', 'ProductReviewController@store')->name('review.store');
// Coupon
Route::post('/coupon-store', 'CouponController@couponStore')->name('coupon-store');
// Payment
Route::get('payment', 'PayPalController@payment')->name('payment');
Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PayPalController@success')->name('payment.success');
// Backend section start
Route::group(['prefix' => '/admin'], function () {

    Route::get('/file-manager', function () {
        return view('backend.layouts.file-manager');
    })->name('file-manager');

    // Ajax for sub category
    Route::post('/category/{id}/child', [CategoryController::class, 'getChildByParent']);
});











# Final Section Routes Starts From Here #  # Final Section Routes Starts From Here #     # Final Section Routes Starts From Here #
//Admin Sect ion Routes Finalized
Route::group(['middleware' => 'admin'], function () {
    Route::group(
        ['prefix' => '/admin'],
        function () {
            Route::get('/', [AdminController::class, 'index'])->name('admin');
            // Settings
            Route::get('settings', [AdminController::class, 'settings'])->name('settings');
            Route::post('setting/update', [AdminController::class, 'settingsUpdate'])->name('settings.update');
            // user route
            Route::resource('users', UsersController::class);
            // Coupon
            Route::resource('/coupon', CouponController::class);
            // Profile
            Route::get('/profile', [AdminController::class, 'profile'])->name('admin-profile');
            Route::post('/profile/{id}', [AdminController::class, 'profileUpdate'])->name('profile-update');
            // Banner
            Route::resource('banner', BannerController::class);
            // Category
            Route::resource('/category', CategoryController::class);
            // Product
            Route::resource('/product', ProductController::class);
            // Brand
            Route::resource('brand', BrandController::class);
            // Shipping
            Route::resource('/shipping', ShippingController::class);
            // Order in Admin Panel
            Route::resource('/order', OrderController::class);
            Route::get('order/pdf/{id}', [OrderController::class, 'pdf'])->name('order.pdf');
            // Post
            Route::resource('/post', PostController::class);
            // POST category
            Route::resource('/post-category', PostCategoryController::class);
            // Post tag
            Route::resource('/post-tag', PostTagController::class);
            // Password Change
            Route::get('change-password', [AdminController::class, 'changePassword'])->name('change.password.form');
            Route::post('change-password', [AdminController::class, 'changPasswordStore'])->name('achange.password');
            // Message
            Route::resource('/message',  MessageController::class);
            Route::get('/message/five', [MessageController::class, 'messageFive'])->name('messages.five');
            // Notification
            Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('admin.notification');
            Route::get('/notifications', [NotificationController::class, 'index'])->name('all.notification');
            Route::delete('/notification/{id}', [NotificationController::class, 'delete'])->name('notification.delete');
        }
    );
});
//User Section Finalized
// User section start
Route::group(
    ['prefix' => '/user'],
    function () {
        //User Dashboard 
        Route::get('/', [HomeController::class, 'index'])->name('user');
        // Profile
        Route::get('/profile', [HomeController::class, 'profile'])->name('user-profile');
        Route::post('/profile/{id}', [HomeController::class, 'profileUpdate'])->name('user-profile-update');
        //  Order
        Route::get('/order', [HomeController::class, 'orderIndex'])->name('user.order.index');
        Route::get('/order/show/{id}', [HomeController::class, 'orderShow'])->name('user.order.show');
        Route::delete('/order/delete/{id}', [HomeController::class, 'userOrderDelete'])->name('user.order.delete');
        // Product Review
        Route::get('/user-review', [HomeController::class, 'productReviewIndex'])->name('user.productreview.index');
        Route::delete('/user-review/delete/{id}', [HomeController::class, 'productReviewDelete'])->name('user.productreview.delete');
        Route::get('/user-review/edit/{id}', [HomeController::class, 'productReviewEdit'])->name('user.productreview.edit');
        Route::patch('/user-review/update/{id}', [HomeController::class, 'productReviewUpdate'])->name('user.productreview.update');
        // Post comment
        Route::get('user-post/comment', [HomeController::class, 'userComment'])->name('user.post-comment.index');
        Route::delete('user-post/comment/delete/{id}', [HomeController::class, 'userCommentDelete'])->name('user.post-comment.delete');
        Route::get('user-post/comment/edit/{id}', [HomeController::class, 'userCommentEdit'])->name('user.post-comment.edit');
        Route::patch('user-post/comment/udpate/{id}', [HomeController::class, 'userCommentUpdate'])->name('user.post-comment.update');
        // Password Change
        Route::get('change-password', [HomeController::class, 'changePassword'])->name('user.change.password.form');
        Route::post('change-password', [HomeController::class, 'changPasswordStore'])->name('change.password');
    }
);
//Public Section Routes Finalized
//Register Routes
Route::get('user/register', [FrontendController::class, 'register'])->name('register.form');
Route::post('user/register', [FrontendController::class, 'registerSubmit'])->name('register.submit');
//Login Routes
Route::get('user/login', [FrontendController::class, 'login'])->name('login.form');
Route::post('user/login', [FrontendController::class, 'loginSubmit'])->name('login.submit');
Route::get('user/logout', [FrontendController::class, 'logout'])->name('user.logout');
//Home Section 
Route::get('/', [FrontendController::class, 'home'])->name('home');
//About Us
Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('about-us');
//Contact Section
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact/message', [MessageController::class, 'store'])->name('contact.store');
// Blog
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blog-detail/{slug}', [FrontendController::class, 'blogDetail'])->name('blog.detail');
Route::get('/blog/search', [FrontendController::class, 'blogSearch'])->name('blog.search');
Route::post('/blog/filter', [FrontendController::class, 'blogFilter'])->name('blog.filter');
Route::get('blog-cat/{slug}', [FrontendController::class, 'blogByCategory'])->name('blog.category');
Route::get('blog-tag/{slug}', [FrontendController::class, 'blogByTag'])->name('blog.tag');
// Order Track
Route::get('/product/track', [OrderController::class, 'orderTrack'])->name('order.track');
Route::post('product/track/order', [OrderController::class, 'productTrackOrder'])->name('product.track.order');
//Category of Products
Route::get('/product-cat/{slug}', [FrontendController::class, 'productCat'])->name('product-cat');
Route::get('/product-grids', [FrontendController::class, 'productGrids'])->name('product-grids');
Route::get('/product-brand/{slug}', [FrontendController::class, 'productBrand'])->name('product-brand');
// Product Review
Route::resource('/review', ProductReviewController::class);
// Post Comment 
Route::post('post/{slug}/comment', [PostCommentController::class, 'store'])->name('post-comment.store');
Route::resource('/comment', PostCommentController::class);
//Products
Route::post('/product/search', [FrontendController::class, 'productSearch'])->name('product.search');
Route::get('/product-lists', [FrontendController::class, 'productLists'])->name('product-lists');
Route::match(['get', 'post'], '/filter', [FrontendController::class, 'productFilter'])->name('shop.filter');
Route::get('product-detail/{slug}', [FrontendController::class, 'productDetail'])->name('product-detail');
// Wishlist
Route::get('/wishlist', function () {
    return view('frontend.pages.wishlist');
})->name('wishlist');
Route::get('/wishlist/{slug}', [WishlistController::class, 'wishlist'])->name('add-to-wishlist')->middleware('user');
Route::get('wishlist-delete/{id}', [WishlistController::class, 'wishlistDelete'])->name('wishlist-delete');
// Cart section
Route::post('/add-to-cart', [CartController::class, 'singleAddToCart'])->name('single-add-to-cart')->middleware('user');
Route::get('/add-to-cart/{slug}', [CartController::class, 'addToCart'])->name('add-to-cart')->middleware('user');
Route::get('/cart', function () {
    return view('frontend.pages.cart');
})->name('cart');
Route::post('cart-update', [CartController::class, 'cartUpdate'])->name('cart.update');
Route::get('cart-delete/{id}', [CartController::class, 'cartDelete'])->name('cart-delete');
// Coupon
Route::post('/coupon-store', [CouponController::class, 'couponStore'])->name('coupon-store');
//Checkout
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('user');
Route::post('cart/order', [OrderController::class, 'store'])->name('cart.order');
Route::get('order/pdf/{id}', [OrderController::class, 'pdf'])->name('order.pdf');
// NewsLetter
Route::post('/subscribe', [FrontendController::class, 'subscribe'])->name('subscribe');

// Route::get('bkash_payment', 'PayPalController@payment')->name('bkash_payment');
Route::get('bkash_payment', [OrderController::class, 'payment'])->name('bkash_payment');
Route::post('/bkash_checkout', [OrderController::class, 'bkash_checkout'])->name('bkash_checkout');

