<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/get-dashboard-detail', [ApiController::class,     'getDashboardDetail']);
Route::post('/login', [ApiController::class,                       'login']);
Route::post('/social-login', [ApiController::class,                'Sociallogin']);
Route::post('/user-registration', [ApiController::class,           'userRegistration']);
Route::post('/send-otp', [ApiController::class,                    'sendOtp']);
Route::post('/verify-otp', [ApiController::class,                  'verifyOtp']);
Route::get('/get-category-list', [ApiController::class,            'getCategoryList']);
Route::get('/get-home-detail', [ApiController::class,              'getHomeDetail']);
Route::post('/get-product-detail', [ApiController::class,          'getProductDetail']);
Route::post('/search-product', [ApiController::class,              'searchProduct']);
Route::middleware('auth:api')->group( function () {
	Route::post('/update-profile', [ApiController::class,          'updateProfile']);
	Route::post('/change-password', [ApiController::class,         'changePassword']);
	Route::post('/add-cart', [ApiController::class,  'addCart']);
	Route::get('/get-profile-detail', [ApiController::class,       'getProfileDetail']);
	Route::get('/get-cart-detail', [ApiController::class,          'getCartDetail']);
	Route::post('/update-cart-qty', [ApiController::class,         'updateCartqty']);
	Route::post('/remove-cart', [ApiController::class,             'removeCart']);
	Route::post('/add-to-wishlist', [ApiController::class,         'addToWishlist']);
	Route::get('/get-wishlist-detail', [ApiController::class,      'getWishList']);
	Route::post('/remove-from-wishlist', [ApiController::class,    'removeFromWishList']);
	Route::get('/get-coupon-list', [ApiController::class,          'getCouponList']);
	Route::get('/get-shipping-list', [ApiController::class,        'getShippingList']);
	Route::get('/get-packaging-list', [ApiController::class,       'getPackagingList']);
	Route::post('/checkout', [ApiController::class,                'checkout']);
	Route::get('/order-detail', [ApiController::class,             'orderDetail']);
	Route::post('/order-item-detail', [ApiController::class,       'orderItemDetail']);
	Route::post('/update-firebase-token', [ApiController::class,   'updateFirebaseToken']);
	Route::get('/get-general-setting', [ApiController::class,      'getGeneralSetting']);
	Route::post('/razor-call-back', [ApiController::class,         'razorCallback']);
	Route::get('/get-address', [ApiController::class,              'getAddress']);
	Route::post('/save-address', [ApiController::class,            'saveAddress']);
	Route::post('/update-address', [ApiController::class,          'updateAddress']);
	Route::post('/remove-address', [ApiController::class,          'removeAddress']);
	Route::get('/get-notification-list', [ApiController::class,    'getNotification']);
	Route::post('/change-profile-picture', [ApiController::class,  'changeProfilePicture']);
	Route::post('/cancel-order', [ApiController::class,            'cancelOrder']);
	Route::post('/save-reviews-ratings', [ApiController::class,    'saveReviewsAndratings']);
	Route::post('/download-order-invoice', [ApiController::class,  'downloadOrderInvoice']);
	Route::get('/get-items-count', [ApiController::class,          'getItemsCount']);
	Route::get('/get-user-order-item-wise', [ApiController::class, 'getUserOrderItemWise']);
});
Route::post('/update-password', [ApiController::class,             'updatePassword']);
Route::post('/get-reviews-ratings', [ApiController::class,         'getReviewsAndratings']);
Route::post('/get-popular-tags', [ApiController::class,            'getPopularTags']);
Route::post('/filter-product', [ApiController::class,              'filterProduct']);
Route::post('/get-category-wise-product-list', [ApiController::class,  'getCategoryWiseProductList']);
Route::post('/get-subcategory-wise-product-list', [ApiController::class,  'getSubcategoryWiseProductList']);
Route::post('/get-filter-attributes', [ApiController::class,  'getFilterAttributes']);

