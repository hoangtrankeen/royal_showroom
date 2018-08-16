<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Frontend Route
Route::get('/', 'Frontend\ShopController@index')->name('home');

//Route::resource('/cart', 'Frontend\CartController');
Route::get('cart', 'Frontend\CartController@index')->name('cart.index');
Route::delete('/cart/remove/{id}', 'Frontend\CartController@destroyCartItem');
Route::post('/cart/update/{id}', 'Frontend\CartController@updateCartItem');
Route::post('/add-to-cart','Frontend\CartController@addCartShopPage');
Route::post('/add-to-cart-group','Frontend\CartController@addCartGroupProduct');
Route::post('/cart/switchToSaveForLater/{product}', 'Frontend\CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

Route::get('/product', 'Frontend\ShopController@allProduct')->name('catalog.product.all');
Route::get('/checkout', 'Frontend\CheckoutController@index')->name('checkout');
Route::post('/checkout/store', 'Frontend\CheckoutController@placeOrder')->name('checkout.placeorder')->middleware('cart');
Route::get('/checkout/success', 'Frontend\CheckoutController@checkoutSuccess')->name('checkout.success');

Route::get('/category/{slug}', 'Frontend\ShopController@catalogCategory')->name('catalog.category');
Route::get('/product/{slug}', 'Frontend\ShopController@catalogProduct')->name('catalog.product');
Route::get('/search', 'Frontend\ShopController@search')->name('catalog.search');
Route::get('mini-search', 'Frontend\ShopController@miniSearch')->name('mini.search');
Route::get('/filter', 'Frontend\ShopController@filter')->name('catalog.filter');
Route::get('/quick-view', 'Frontend\ShopController@quickView')->name('catalog.quickview');

Route::get('/post', 'Frontend\BlogController@index')->name('cms.post');
Route::get('/post/{slug}', 'Frontend\BlogController@details')->name('cms.post.detail');
Route::get('/post-category/{slug}', 'Frontend\BlogController@topic')->name('cms.topic');
Route::get('/sale/post', 'Frontend\BlogController@getSalePost')->name('cms.sale.post');

Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::get('/customer/account', 'Frontend\CustomerController@index')->name('customer.dashboard');
Route::get('/customer/account/edit', 'Frontend\CustomerController@accountEdit')->name('customer.account.edit');
Route::post('/customer/account/update', 'Frontend\CustomerController@accountUpdate')->name('customer.account.update');

Route::get('/customer/order/list', 'Frontend\CustomerController@listOrder')->name('customer.order.list');
Route::get('/customer/order/detail/{id}', 'Frontend\CustomerController@orderDetail')->name('customer.order.detail');

Route::get('/contact', 'Frontend\ShopInfoController@contactPage')->name('contact');

Route::get('/combo', 'Frontend\PromoteController@getCombo')->name('promote.combo');

Route::get('/tracking/order', 'Frontend\TrackingOrderController@index')->name('tracking.order');
Route::get('/tracking/order/info', 'Frontend\TrackingOrderController@getOrderInformation')->name('tracking.order.info');

//Comment System
Route::get('{pageId}', function($pageId){
    return view('page',['pageId' => $pageId]);
});

Route::get('comments/{pageId}', 'Frontend/CommentController@index');
Route::post('comments', 'Frontend/CommentController@store');
Route::post('comments/{commentId}/{type}', 'Frontend/CommentController@update');

//Backend Route
Auth::routes();
Route::get('admin/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');

Route::group(['prefix'=>'admin', 'middleware'=>'auth:admin'], function () {

    Route::get('/', 'Backend\DashboardController@index')->name('admin.home');
    Route::post('/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');
    Route::get('/password/reset', 'AuthAdmin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'AuthAdmin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'AuthAdmin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'AuthAdmin\ResetPasswordController@reset');

    Route::get('product/create/{type}','Backend\ProductController@create')->name('product.create');
    Route::resource('product-simple','Backend\ProductSimpleController');
    Route::resource('product-group','Backend\ProductGroupController');
    Route::resource('product','Backend\ProductController');

    Route::resource('attribute','Backend\AttributeController');
    Route::resource('category','Backend\CategoryController');

    Route::resource('order','Backend\OrderController');
    Route::post('order/update/cart','Backend\OrderController@upDateCart');

    Route::resource('order-status','Backend\OrderStatusController');
    Route::resource('payment-method','Backend\PaymentMethodController');
    Route::resource('shipping-method','Backend\ShippingMethodController');

    Route::resource('topic','Backend\TopicController');
    Route::resource('post','Backend\PostController');
    Route::resource('tag','Backend\TagController');


});
