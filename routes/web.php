<?php


//client
use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\AccountController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Front\ShopController;
use \App\Http\Controllers\Front\CartController;
use \App\Http\Controllers\Front\CheckoutController;
use \App\Http\Controllers\Front\HomeController;
use \App\Http\Controllers\Front\FavouriteController;
use \App\Http\Controllers\BotManController;

//admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ProductController;
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

Route::get('/',[HomeController::class,'home'] )->name('home');
Route::get('change-language/{locale}', [LanguageController::class, 'changeLanguage'])->name('change-language');

Route::get('/blog',[Controller::class,'blog']);
Route::get('/contacts',[Controller::class,'contacts']);

Route::prefix('shop')->group(function (){
    Route::get('/product/{id}',[ShopController::class,'show']);
    Route::post('/product/{id}',[ShopController::class,'postComment']);
    Route::get('/product/delete/{id}',[ShopController::class,'deleteComment']);
    Route::get('',[ShopController::class,'index']);
    Route::get('category/{categoryName}',[ShopController::class,'category'])->name('shop.category');
    Route::get('brand/{brandName}',[ShopController::class,'brand']);

});
Route::POST('/quick-view',[ShopController::class,'quickView']);
Route::POST('/cart-quickview',[CartController::class,'cartQuickView']);
Route::get('/getProductDetails',[ShopController::class,'getProductDetails']);

Route::prefix('cart')->group(function (){
    Route::get('add',[CartController::class,'add']);
    Route::post('update-product',[CartController::class,'updateProduct']);
    Route::get('/',[CartController::class,'index'])->name('cart.index');
    Route::get('delete',[CartController::class,'delete']);
    Route::get('destroy',[CartController::class,'destroyCart']);
    Route::get('update',[CartController::class,'update']);
});

Route::prefix('favourite')->middleware('CheckUserLogin')->group(function (){
   Route::get('addFav',[FavouriteController::class,'addFav']);
   Route::get('/',[FavouriteController::class,'index']);
   Route::get('/remove/{id}', [FavouriteController::class, 'removeFromFavourites']);
    Route::get('/clear', [FavouriteController::class,'clearFav']);

});

Route::prefix('checkout')->middleware('CheckUserLogin')->group(function (){
    Route::get('',[CheckoutController::class,'index'])->name('checkout');
    Route::post('/',[CheckoutController::class,'addOrder'])->name('checkout.addOrder');;
    Route::get('/thank-you',[CheckoutController::class,'thankYou']);
    Route::get('/vnPayCheck',[CheckoutController::class,'vnPayCheck']);
    Route::get('success-transaction', [CheckoutController::class, 'successTransaction'])->name('successTransaction');
    Route::get('cancel-transaction', [CheckoutController::class, 'cancelTransaction'])->name('cancelTransaction');
    Route::post('check_coupon',[CheckoutController::class,'checkCoupon']);
    Route::get('delete_coupon',[CheckoutController::class,'deleteCoupon']);
});
Route::get('/calculate-shipping', [CheckoutController::class, 'calculateShipping'])->name('calculate-shipping');





Route::prefix('account')->group(function (){
    Route::get('/login',[AccountController::class,'login'])->name('login');
    Route::post('/login',[AccountController::class,'checkLogin']);
    Route::get('/logout',[AccountController::class,'logout'])->name('logout');
    Route::get('/register',[AccountController::class,'register']);
    Route::post('/register',[AccountController::class,'postRegister']);
    Route::get('/login-facebook',[AccountController::class,'loginFacebook']);
    Route::get('/callback',[AccountController::class,'callbackFacebook']);
    Route::get('/forgot-password',[AccountController::class,'forgotPassword']);
    Route::post('/recover-password',[AccountController::class,'recoverPassword']);
    Route::post('/reset-password',[AccountController::class,'resetNewPassword']);

    Route::prefix('my-order')->middleware('CheckUserLogin')->group(function (){
        Route::get('/',[AccountController::class,'myOrder']);
        Route::get('{id}',[AccountController::class,'myOrderDetails']);
        Route::get('/download-bill/{orderId}', [AccountController::class, 'downloadBill'])->name('download.bill');
        Route::post('/orders/search', [AccountController::class, 'search']);
        Route::get('orders/search', [AccountController::class, 'search'])->name('orders.search');
        Route::get('/cancel-order/{id}', [AccountController::class, 'cancelOrder'])->name('order.cancel');
    });
    Route::prefix('profile')->middleware('CheckUserLogin')->group(function (){
        Route::get('/',[AccountController::class,'profile']);
        Route::post('/update-user', [AccountController::class, 'updateUser'])->name('updateUser');
    });
});
Route::get('/update-new-password',[AccountController::class,'updatePassword']);

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
Route::get('/tinker', [BotManController::class, 'tinker']);
Route::view('/botman/chat', 'vendor.botman.tinker');

Route::post('botman/message', [BotManController::class, 'sendMessage']);

Route::get('open-api',[\App\Http\Controllers\ChatgptController::class,'index']);

Route::post('/orders/reorder/{id}', [AccountController::class, 'reOrder'])->name('reorder');


///admin /////////////////////////////////////////////////////////////////////////////////////////////////////
Route::middleware(['auth', 'level'])->prefix('admin')->group(function () {
    Route::get('', [AdminController::class, 'index'])
        ->name('admin');
    Route::get('search', [AdminController::class, 'search'])
        ->name('admin.search');
    Route::prefix('categories')->group(function () {
        Route::get('/search', [CategoryController::class, 'search'])
            ->name('categories.search');
        Route::get('/delete{id}', [CategoryController::class, 'delete'])
            ->name('categories.delete');
        Route::put('/update{id}', [CategoryController::class, 'update'])
            ->name('categories.update');
        Route::get('/edit{id}', [CategoryController::class, 'edit'])
            ->name('categories.edit');
        Route::post('/store', [CategoryController::class, 'store'])
            ->name('categories.store');
        Route::get('/create', [CategoryController::class, 'create'])
            ->name('categories.create');
        Route::put('/restore', [CategoryController::class, 'restore'])
            ->name('categories.restore');
        Route::get('/', [CategoryController::class, 'index'])
            ->name('categories');
    });
    Route::prefix('brands')->group(function () {
        Route::get('/search', [BrandController::class, 'search'])
            ->name('brands.search');
        Route::put('/restore', [BrandController::class, 'restore'])
            ->name('brands.restore');
        Route::get('/delete{id}', [BrandController::class, 'delete'])
            ->name('brands.delete');
        Route::put('/update{id}', [BrandController::class, 'update'])
            ->name('brands.update');
        Route::get('/edit{id}', [BrandController::class, 'edit'])
            ->name('brands.edit');
        Route::post('/store', [BrandController::class, 'store'])
            ->name('brands.store');
        Route::get('/create', [BrandController::class, 'create'])
            ->name('brands.create');
        Route::get('/', [BrandController::class, 'index'])
            ->name('brands');
    });


    Route::prefix('products')->group(function () {
        Route::get('/search', [ProductController::class, 'search'])
            ->name('products.search');


//        Route::get('/fetch-quantity', [ProductController::class, 'fetchQuantity'])
//            ->name('products.fetch-quantity');


        Route::post('/emptyTempFolder', [ProductController::class, 'emptyTempFolder'])
            ->name('products.emptyTempFolder');
        Route::post('/update/{id}', [ProductController::class, 'update'])
            ->name('products.update');
        Route::get('/edit{id}', [ProductController::class, 'edit'])
            ->name('products.edit');
        Route::get('/productDetails/{product}', [ProductController::class, 'productsDetails'])
            ->name('products.productDetails');
        Route::put('/restore', [ProductController::class, 'restore'])
            ->name('products.restore');
        Route::get('/delete{id}', [ProductController::class, 'delete'])
            ->name('products.delete');
        Route::post('/store', [ProductController::class, 'store'])
            ->name('products.store');
//        Route::get('/create', [ProductController::class, 'create'])
//            ->name('products.create');


        Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/uploadImgDZ', [ProductController::class, 'uploadImgDZ'])->name('uploadImgDZ');
        Route::post('/deleteImgDZ', [ProductController::class, 'deleteImgDZ'])->name('deleteImgDZ');
        Route::post('/updateText', [ProductController::class, 'updateText'])
            ->name('products.updateText');
        Route::get('/getText', [ProductController::class, 'getText'])
            ->name('products.getText');
        Route::get('/', [ProductController::class, 'index'])
            ->name('products');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/search', [OrderController::class, 'search'])
            ->name('orders.search');// route name luôn phải ở dạng orders.abcxyz để search box hướng url về phần trước dầu. tức orders và chấm thêm search
        Route::put('/restore', [OrderController::class, 'restore'])
            ->name('orders.restore');
        Route::get('/delete{id}', [OrderController::class, 'delete'])
            ->name('orders.delete');
        Route::post('/updateDelivery', [OrderController::class, 'updateDelivery'])
            ->name('orders.updateDelivery');
        Route::get('/getOrderNote', [OrderController::class, 'getOrderNote'])
            ->name('orders.getOrderNote');
        Route::post('/updateStaffNote', [OrderController::class, 'updateStaffNote'])
            ->name('orders.updateStaffNote');
        Route::get('/getStaffNote', [OrderController::class, 'getStaffNote'])
            ->name('orders.getStaffNote');
        Route::post('/updateOrderCancelReason', [OrderController::class, 'updateOrderCancelReason'])
            ->name('orders.updateOrderCancelReason');
        Route::get('/getOrderCancelReason', [OrderController::class, 'getOrderCancelReason'])
            ->name('orders.getOrderCancelReason');
        Route::get('/editOrderInfo', [OrderController::class, 'editOrderInfo'])
            ->name('orders.editOrderInfo');
        Route::get('/addDelivery', [OrderController::class, 'addDelivery'])
            ->name('orders.addDelivery');
        Route::get('/orderDetails/{order}', [OrderController::class, 'orderDetails'])
            ->name('orders.orderDetails');
        Route::put('/updateDeliveryFee', [OrderController::class, 'updateDeliveryFee'])
            ->name('orders.updateDeliveryFee');
        Route::put('/updateOrderStatus', [OrderController::class, 'updateOrderStatus'])
            ->name('orders.updateOrderStatus');
        Route::put('/updatePaymentStatus', [OrderController::class, 'updatePaymentStatus'])
            ->name('orders.updatePaymentStatus');
        Route::put('/update{id}', [OrderController::class, 'update'])
            ->name('orders.update');
        Route::get('/fetch-quantity', [OrderController::class, 'fetchQuantity'])
            ->name('orders.fetch-quantity');
        Route::get('/edit{id}', [OrderController::class, 'edit'])
            ->name('orders.edit');
        Route::post('/store', [OrderController::class, 'store'])
            ->name('orders.store');
        Route::get('/create', [OrderController::class, 'create'])
            ->name('orders.create');
        Route::get('/', [OrderController::class, 'index'])
            ->name('orders');
        Route::post('/change-status', [OrderController::class, 'changeStatus'])->name('changeStatus');

    });

    Route::prefix('reviews')->group(function () {
        Route::get('/search', [ReviewController::class, 'search'])
            ->name('reviews.search');// route name luôn phải ở dạng reviews.abcxyz để search box hướng url về phần trước dầu. tức reviews và chấm thêm search
        Route::put('/restore', [ReviewController::class, 'restore'])
            ->name('reviews.restore');
        Route::get('/delete{id}', [ReviewController::class, 'delete'])
            ->name('reviews.delete');
        Route::post('/submitReviewResponse', [ReviewController::class, 'submitReviewResponse'])
            ->name('reviews.submitReviewResponse');
        Route::get('/getSubmitReviewResponse', [ReviewController::class, 'getSubmitReviewResponse'])
            ->name('reviews.getSubmitReviewResponse');
        Route::put('/updateReviewStatus', [ReviewController::class, 'updateReviewStatus'])
            ->name('reviews.updateReviewStatus');
        Route::get('/', [ReviewController::class, 'index'])
            ->name('reviews');
    });
});







