<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\AccountController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Front\ShopController;
use \App\Http\Controllers\Front\CartController;
use \App\Http\Controllers\Front\CheckoutController;
use \App\Http\Controllers\Front\HomeController;
use \App\Http\Controllers\Front\FavouriteController;
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

Route::get('/',[HomeController::class,'home'] );
Route::get('change-language/{locale}', [LanguageController::class, 'changeLanguage'])->name('change-language');

Route::get('/blog',[Controller::class,'blog']);
Route::get('/contacts',[Controller::class,'contacts']);

Route::prefix('shop')->group(function (){
    Route::get('/product/{id}',[ShopController::class,'show']);
    Route::post('/product/{id}',[ShopController::class,'postComment']);
    Route::get('/quick-view',[ShopController::class,'quickView']);
    Route::get('',[ShopController::class,'index']);
    Route::get('category/{categoryName}',[ShopController::class,'category']);
    Route::get('brand/{brandName}',[ShopController::class,'brand']);

});

Route::prefix('cart')->group(function (){
    Route::get('add',[CartController::class,'add']);
    Route::get('/',[CartController::class,'index']);
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
    Route::get('',[CheckoutController::class,'index']);
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
    Route::get('/login',[AccountController::class,'login']);
    Route::post('/login',[AccountController::class,'checkLogin']);
    Route::get('/logout',[AccountController::class,'logout']);
    Route::get('/register',[AccountController::class,'register']);
    Route::post('/register',[AccountController::class,'postRegister']);
    Route::get('/login-facebook',[AccountController::class,'loginFacebook']);
    Route::get('/callback',[AccountController::class,'callbackFacebook']);

    Route::prefix('my-order')->middleware('CheckUserLogin')->group(function (){
        Route::get('/',[AccountController::class,'myOrder']);
        Route::get('{id}',[AccountController::class,'myOrderDetails']);
    });
});


