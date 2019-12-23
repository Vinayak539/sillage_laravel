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

Route::GET('/', 'MainController@index')->name('index');
Route::view('/about', 'frontend.about')->name('about');
// Route::view('/contact', 'frontend.contact')->name('contact');
Route::view('/all-product', 'frontend.all-product')->name('all-product');
Route::view('/product-detail', 'frontend.product-detail')->name('product-detail');
Route::view('/compare', 'frontend.compare')->name('compare');
Route::view('/checkout', 'frontend.checkout')->name('checkout');
Route::view('/terms-condition', 'frontend.terms-condition')->name('terms-condition');
Route::view('/privacy', 'frontend.privacy')->name('privacy');
Route::view('/cancellation', 'frontend.cancellation')->name('cancellation');
Route::view('/refund-return', 'frontend.refund-return')->name('refund-return');
Route::view('/shipping', 'frontend.shipping')->name('shipping');
Route::view('/faq', 'frontend.faq')->name('faq');
Route::view('/myaccount/login', 'frontend.login')->name('user.login');
Route::view('/team', 'frontend.team')->name('team');
Route::view('/myaccount/register', 'frontend.register')->name('register');
Route::view('/myaccount/otp', 'frontend.otp')->name('otp');
Route::view('/forget-password', 'frontend.forget-password')->name('forget-password');
Route::view('/orders', 'frontend.orders')->name('orders');
Route::view('/own-creation', 'frontend.own-creation')->name('own-creation');
Route::view('/account-details', 'frontend.account-details')->name('account-details');
Route::view('/asd', 'ads')->name('password.request');

// contact us
Route::GET('/contact', 'EnquiryController@create')->name('contact');
Route::POST('/contact', 'EnquiryController@store');

// product routes
Route::GET('/product/{slug}', 'MainController@getProduct')->name('product');
Route::GET('/category/{slug}', 'MainController@getCategoryProducts')->name('cate');
Route::GET('/search', 'MainController@search')->name('search');
Route::POST('/get-sizes', 'MainController@getSizes');

// Start Socialite

Route::GET('auth/{provider}', 'SocialiteManageController@redirectToProvider');
Route::GET('auth/{provider}/callback', 'SocialiteManageController@handleProviderCallback');

// End Socialite

// Cart & Checkout

Route::post('/cart', 'CartController@store');
Route::get('/cart', 'CartController@index')->name('cart');
Route::POST('/cart/delete', 'CartController@destroy');
Route::POST('/cart/update', 'CartController@update')->name('cart.update');
Route::get('/checkout', 'OrderController@index')->name('checkout');
Route::POST('/checkout', 'OrderController@checkout')->name('order.checkout');
Route::POST('/transaction-callback', 'OrderController@handleCallbackFromPaytm')->name('paytm.callback');
Route::POST('/pincode', 'MainController@verifyPincode');

Route::prefix('adhatke852')->group(function () {

    Route::middleware(['guest:admin'])->group(function () {
        Route::GET('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
        Route::POST('/login', 'AdminAuth\LoginController@login');
        Route::POST('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
        Route::GET('/password/email', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::POST('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::POST('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.update');
        Route::GET('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::GET('/check/email', 'AdminAuth\LoginController@checkEmail')->name('check.email');
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::GET('/', 'AdminController@index')->name('admin.dashboard');
        Route::GET('/profile', 'AdminController@profile')->name('admin.profile');
        Route::POST('/profile', 'AdminController@update');
        Route::POST('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');
        Route::GET('/add-users', 'AdminController@addUserForm')->name('admin.add.user');
        Route::POST('/add-users', 'AdminController@addUser');

        Route::prefix('/manage-admins')->group(function () {
            Route::GET('/', 'AdminController@manage')->name('admin.admins.all');
            Route::POST('/', 'AdminController@store');
            Route::GET('/edit/{id}', 'AdminController@edit')->name('admin.admins.edit');
            Route::POST('/edit/{id}', 'AdminController@update');
            Route::POST('/delete/{id}', 'AdminController@destroy');
        });

        Route::prefix('/manage-shipments')->group(function () {
            Route::GET('/', 'Admin\ShipmentController@index')->name('admin.shipments.all');
            Route::POST('/', 'Admin\ShipmentController@store');
            Route::GET('/edit/{id}', 'Admin\ShipmentController@edit')->name('admin.shipments.edit');
            Route::POST('/edit/{id}', 'Admin\ShipmentController@update');
        });

        Route::prefix('/manage-users')->group(function () {
            Route::GET('/', 'Admin\UserManageController@index')->name('admin.users.all');
            Route::GET('/edit/{id}', 'Admin\UserManageController@edit')->name('admin.users.edit');
            Route::GET('/show/{id}', 'Admin\UserManageController@show')->name('admin.users.show');
            Route::POST('/edit/{id}', 'Admin\UserManageController@update');
            Route::GET('/orders/{id}', 'Admin\UserManageController@orders')->name('admin.users.orders');
            Route::GET('/reviews/{id}', 'Admin\UserManageController@reviews')->name('admin.users.reviews');
            Route::POST('/block/{id}', 'Admin\UserManageController@block');
            Route::POST('/unblock/{id}', 'Admin\UserManageController@unblock');
        });

        Route::prefix('/manage-sliders')->group(function () {
            Route::GET('/', 'Admin\SliderController@index')->name('admin.sliders.all');
            Route::POST('/', 'Admin\SliderController@store');
            Route::GET('/edit/{id}', 'Admin\SliderController@edit')->name('admin.sliders.edit');
            Route::POST('/edit/{id}', 'Admin\SliderController@update');
            Route::POST('/delete', 'Admin\SliderController@destroy')->name('admin.sliders.delete');
        });

        Route::prefix('/manage-categories')->group(function () {
            Route::GET('/', 'Admin\CategoryController@index')->name('admin.categories.all');
            Route::GET('/add', 'Admin\CategoryController@create')->name('admin.categories.create');
            Route::POST('/add/catagory', 'Admin\CategoryController@store')->name('admin.categories.add');
            Route::GET('/edit/{id}', 'Admin\CategoryController@edit')->name('admin.categories.edit');
            Route::POST('/edit/{id}', 'Admin\CategoryController@update');
            Route::POST('/get/catagory', 'Admin\CategoryController@getCategory');
        });

        Route::prefix('/manage-products')->group(function () {
            Route::GET('/', 'Admin\ProductController@index')->name('admin.products.all');
            Route::GET('/add', 'Admin\ProductController@create')->name('admin.products.create');
            Route::POST('/add', 'Admin\ProductController@store');
            Route::GET('/edit/{id}', 'Admin\ProductController@edit')->name('admin.products.edit');
            Route::POST('/edit/{id}', 'Admin\ProductController@update');
            Route::GET('/questions/{id}', 'Admin\ProductController@getQuestions')->name('admin.products.questions');
            Route::POST('/add-product-custom-field/{id}', 'Admin\ProductController@addCustomField')->name('admin.products.add.custom.field');
            Route::POST('/add-product-color/{id}', 'Admin\ProductController@addColor')->name('admin.products.add.color');
            Route::POST('/update-product-custom-field', 'Admin\ProductController@updateCustomField')->name('admin.products.update.custom.field');
            Route::POST('/delete-product-custom-field', 'Admin\ProductController@destroyCustomField')->name('admin.products.delete.custom.field');
            Route::POST('/update-product-color', 'Admin\ProductController@updateColor')->name('admin.products.update.color');
            Route::POST('/delete-product-color', 'Admin\ProductController@destroyColor')->name('admin.products.delete.color');
            Route::POST('/update-stock/{id}', 'Admin\ProductController@updateStock')->name('admin.products.update.stock');
            Route::POST('/update-price/{id}', 'Admin\ProductController@updatePrice')->name('admin.products.update.price');
            Route::POST('/add-product-images/{id}', 'Admin\ProductController@addImages')->name('admin.products.add.images');
            Route::POST('/delete-image', 'Admin\ProductController@deleteImage')->name('admin.products.delete.images');
            Route::GET('/edit/question/{id}', 'Admin\ProductController@getQuestion')->name('admin.product-faqs.edit');
            Route::POST('/edit/question/{id}', 'Admin\ProductController@updateQuestion')->name('admin.product-faqs.edit');
            Route::POST('/delete/question/{id}', 'Admin\ProductController@deleteQuestion')->name('admin.product-faqs.delete');
            Route::POST('/add/size/{id}', 'Admin\ProductController@addSizes')->name('admin.products.add.sizes');
        });

        Route::prefix('/manage-brands')->group(function () {
            Route::GET('/', 'Admin\BrandController@index')->name('admin.brands.all');
            Route::POST('/', 'Admin\BrandController@store');
            Route::GET('/edit/{id}', 'Admin\BrandController@edit')->name('admin.brands.edit');
            Route::POST('/edit/{id}', 'Admin\BrandController@update');
        });

        Route::prefix('/manage-gsts')->group(function () {
            Route::GET('/', 'Admin\GstController@index')->name('admin.gsts.all');
            Route::POST('/', 'Admin\GstController@store');
            Route::GET('/edit/{id}', 'Admin\GstController@edit')->name('admin.gsts.edit');
            Route::POST('/edit/{id}', 'Admin\GstController@update');
        });

        Route::prefix('/manage-colors')->group(function () {
            Route::GET('/', 'Admin\MstColorController@index')->name('admin.colors.all');
            Route::POST('/', 'Admin\MstColorController@store');
            Route::GET('/edit/{id}', 'Admin\MstColorController@edit')->name('admin.colors.edit');
            Route::POST('/edit/{id}', 'Admin\MstColorController@update');
        });

        Route::prefix('/manage-materials')->group(function () {
            Route::GET('/', 'Admin\MaterialController@index')->name('admin.materials.all');
            Route::POST('/', 'Admin\MaterialController@store');
            Route::GET('/edit/{id}', 'Admin\MaterialController@edit')->name('admin.materials.edit');
            Route::POST('/edit/{id}', 'Admin\MaterialController@update');
        });

        Route::prefix('/manage-units')->group(function () {
            Route::GET('/', 'Admin\UnitController@index')->name('admin.units.all');
            Route::POST('/', 'Admin\UnitController@store');
            Route::GET('/edit/{id}', 'Admin\UnitController@edit')->name('admin.units.edit');
            Route::POST('/edit/{id}', 'Admin\UnitController@update');
        });

        Route::prefix('/manage-sizes')->group(function () {
            Route::GET('/', 'Admin\MstSizeController@index')->name('admin.sizes.all');
            Route::POST('/', 'Admin\MstSizeController@store');
            Route::GET('/edit/{id}', 'Admin\MstSizeController@edit')->name('admin.sizes.edit');
            Route::POST('/edit/{id}', 'Admin\MstSizeController@update');
        });

        Route::prefix('/manage-conditions')->group(function () {
            Route::GET('/', 'Admin\ConditionController@index')->name('admin.conditions.all');
            Route::POST('/', 'Admin\ConditionController@store');
            Route::GET('/edit/{id}', 'Admin\ConditionController@edit')->name('admin.conditions.edit');
            Route::POST('/edit/{id}', 'Admin\ConditionController@update');
        });

        Route::prefix('/manage-warranties')->group(function () {
            Route::GET('/', 'Admin\WarrantyController@index')->name('admin.warranties.all');
            Route::POST('/', 'Admin\WarrantyController@store');
            Route::GET('/edit/{id}', 'Admin\WarrantyController@edit')->name('admin.warranties.edit');
            Route::POST('/edit/{id}', 'Admin\WarrantyController@update');
        });

        Route::prefix('/manage-sections')->group(function () {
            Route::GET('/', 'Admin\MasterSectionController@index')->name('admin.sections.all');
            Route::POST('/', 'Admin\MasterSectionController@store');
            Route::GET('/edit/{id}', 'Admin\MasterSectionController@edit')->name('admin.sections.edit');
            Route::GET('/assign/{id}', 'Admin\MasterSectionController@assignPage')->name('admin.sections.assign');
            Route::POST('/assign/{id}', 'Admin\MasterSectionController@assign');
            Route::GET('/view/assign/{id}', 'Admin\MasterSectionController@viewAssign')->name('admin.sections.viewAssign');
            Route::POST('/view/assign/{id}', 'Admin\MasterSectionController@removeAssign');
            Route::POST('/edit/{id}', 'Admin\MasterSectionController@update');
            Route::POST('/delete/{id}', 'Admin\MasterSectionController@destroy');
        });

        Route::prefix('/manage-reviews')->group(function () {
            Route::GET('/', 'Admin\ReviewController@index')->name('admin.reviews.all');
            Route::POST('/', 'Admin\ReviewController@store');
            Route::GET('/edit/{id}', 'Admin\ReviewController@edit')->name('admin.reviews.edit');
            Route::POST('/edit/{id}', 'Admin\ReviewController@update');
            Route::POST('/delete', 'Admin\ReviewController@destroy')->name('admin.reviews.delete');
        });

        Route::prefix('/manage-tickets')->group(function () {
            Route::GET('/', 'Admin\TicketController@index')->name('admin.tickets.all');
            Route::POST('/', 'Admin\TicketController@store');
            Route::GET('/edit/{id}', 'Admin\TicketController@edit')->name('admin.tickets.edit');
            Route::POST('/edit/{id}', 'Admin\TicketController@update');
        });

        Route::prefix('/manage-return-refund-tickets')->group(function () {
            Route::GET('/', 'Admin\ReturnticketController@index')->name('admin.return-tickets.all');
            Route::POST('/', 'Admin\ReturnticketController@store');
            Route::GET('/edit/{id}', 'Admin\ReturnticketController@edit')->name('admin.return-tickets.edit');
            Route::POST('/edit/{id}', 'Admin\ReturnticketController@update');
        });

        Route::prefix('/manage-subscribers')->group(function () {
            Route::GET('/', 'Admin\SubscriberController@index')->name('admin.subscribers.all');
            Route::POST('/view', 'Admin\SubscriberController@show')->name('admin.subscribers.show');
            Route::POST('/send', 'Admin\SubscriberController@send')->name('admin.subscribers.send');
        });

        Route::prefix('/manage-orders')->group(function () {
            Route::GET('/', 'Admin\OrderController@index')->name('admin.orders.all');
            Route::GET('/show/{id}', 'Admin\OrderController@show')->name('admin.orders.show');
            Route::POST('/show/{id}', 'Admin\OrderController@update');
            Route::POST('/return-status/{id}', 'Admin\OrderController@returnUpdate')->name('admin.orders.return-status');
            Route::POST('/assign/{id}', 'Admin\OrderController@assignShipment')->name('admin.orders.assign');
            Route::POST('/charges', 'Admin\OrderController@updateCharges')->name('admin.orders.charges');
            Route::GET('/generate-label/{id}', 'Admin\OrderController@generateLabel')->name('admin.orders.generate-label');
            Route::POST('/export', 'Admin\OrderController@export')->name('admin.orders.export');
        });

        Route::prefix('/manage-reports')->group(function () {
            Route::GET('/', 'Admin\ReportController@index')->name('admin.reports.all');
            Route::POST('/', 'Admin\ReportController@generateReport');
            Route::POST('/export-report', 'Admin\ReportController@exportGeneratedReport')->name('admin.orders.reports.export');
        });

        Route::prefix('/manage-invoices')->group(function () {
            Route::GET('/', 'Admin\InvoiceController@index')->name('admin.invoices.all');
            Route::GET('/show/{id}', 'Admin\InvoiceController@show')->name('admin.invoices.show');
            Route::GET('/download/{id}', 'Admin\InvoiceController@downloadInvoice')->name('admin.invoices.download');
            Route::POST('/resend/{id}', 'Admin\InvoiceController@resendInvoice');
        });

        Route::prefix('/manage-enquiries')->group(function () {
            Route::GET('/', 'EnquiryController@index')->name('admin.enquiries.all');
        });

        Route::prefix('/manage-faqs')->group(function () {
            Route::GET('/', 'Admin\FaqController@index')->name('admin.faqs.all');
            Route::POST('/', 'Admin\FaqController@store');
            Route::GET('/edit/{id}', 'Admin\FaqController@edit')->name('admin.faqs.edit');
            Route::POST('/edit/{id}', 'Admin\FaqController@update');
            Route::POST('/delete/{id}', 'Admin\FaqController@destroy')->name('admin.faqs.delete');
        });

        Route::prefix('/manage-abouts')->group(function () {
            Route::GET('/', 'Admin\AboutController@index')->name('admin.abouts.all');
            Route::POST('/', 'Admin\AboutController@store');
            Route::POST('/edit/{id}', 'Admin\AboutController@update');
            Route::POST('/delete/{id}', 'Admin\AboutController@destroy');
        });

        Route::prefix('/manage-home-offer-sliders')->group(function () {
            Route::GET('/', 'Admin\HomeOfferSliderController@index')->name('admin.home-offer-sliders.all');
            Route::POST('/', 'Admin\HomeOfferSliderController@store');
            Route::GET('/edit/{slider}', 'Admin\HomeOfferSliderController@edit')->name('admin.home-offer-sliders.edit');
            Route::POST('/edit/{slider}', 'Admin\HomeOfferSliderController@update');
            Route::POST('/delete/{slider}', 'Admin\HomeOfferSliderController@destroy');
        });

    });
});

// User
Route::prefix('myaccount')->group(function () {

    Route::middleware(['guest:user'])->group(function () {
        Route::GET('/login', 'UserAuth\LoginController@showLoginForm')->name('user.login');
        Route::GET('/login/otp', 'UserAuth\LoginController@showOtpLoginForm')->name('user.login.otp');
        Route::POST('/login/otp', 'UserAuth\LoginController@otpLogin')->name('user.login.otp');
        Route::POST('/login', 'UserAuth\LoginController@login')->name('user.login');
        Route::GET('/register', 'UserAuth\LoginController@create')->name('user.register');
        Route::POST('/register', 'UserAuth\LoginController@store')->name('user.register');
        Route::GET('/otp', 'UserAuth\LoginController@otp')->name('user.otp');
        Route::POST('/otp/resend', 'UserAuth\LoginController@resendOtp')->name('user.otp.resend');
        Route::POST('/otp/verify', 'UserAuth\LoginController@verifyOtp')->name('user.otp.verify');
        Route::GET('/password/email', 'UserResetPassword@showResetRequestForm')->name('user.password.request');
        Route::POST('/password/email', 'UserResetPassword@resetPassword');
        Route::GET('/password/otp/send', 'UserResetPassword@sendOtp');
        Route::POST('/password/otp/resend', 'UserResetPassword@resendOtp')->name('user.reset-otp.resend');
        Route::POST('/password/otp/verify', 'UserResetPassword@verifyOtp')->name('user.reset-otp.verify');
        Route::GET('/reset/password', 'UserResetPassword@resetForm')->name('user.password.reset.form');
        Route::POST('/reset/password', 'UserResetPassword@reset')->name('user.reset.password');
    });

    Route::group(['middleware' => 'auth:user'], function () {

        Route::POST('/logout', 'UserAuth\LoginController@logout')->name('user.logout');
        Route::GET('/', 'UserController@index')->name('user.dashboard');
        Route::GET('/profile', 'UserController@showMyAccount')->name('user.profile');
        Route::GET('/change-password', 'UserController@showChangePassword')->name('user.change-password');
        Route::GET('/orders', 'UserController@showOrder')->name('user.showOrder');
        Route::POST('/profile', 'UserController@update')->name('user.profile.updateRequest');
        Route::POST('/change-password', 'UserController@updateChangePassword')->name('user.change-password.updateRequest');
        Route::POST('/review', 'UserController@review');
        Route::GET('/order/{id}', 'UserController@getOrder')->name('user.order');
        Route::POST('/order/return/{id}', 'UserController@returnOrder')->name('user.orders.return');
        Route::POST('/order/help/{id}', 'UserController@orderHelp')->name('user.orders.help');
        Route::POST('/order/cancel', 'UserController@cancelOrder')->name('user.orders.cancel');
        Route::GET('/download/{id}', 'UserController@downloadInvoice')->name('user.invoices.download');
    });
});
