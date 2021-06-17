<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;use Auth;

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

Route::get('/',[DefaultController::class,'welcome']);
Route::get('about-us',[DefaultController::class,'aboutus']);
Route::get('browse/guitar',[DefaultController::class,'browserGuitar']);
Route::get('browse/guitar/{seriesId}/details',[DefaultController::class,'browserGuitarDetails']);
Route::get('subscription',[DefaultController::class,'subscription']);
Route::post('email/subscribe',[DefaultController::class,'subscribeEmail'])->name('email.subscribe');
Route::get('email/unsubscribe',[DefaultController::class,'unSubscribeEmail'])->name('email.unsubscribe');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Common Auth Routes
Route::group(['middleware' => 'auth'],function(){
	Route::get('user/profile',[HomeController::class, 'userProfile'])->name('user.profile');
	Route::post('user/profile',[HomeController::class, 'userProfileSave'])->name('user.profile.save');
	//Route::get('user/change/password',[HomeController::class, 'index'])->name('user.changepassword');
	Route::post('user/change/password',[HomeController::class, 'updateUserPassword'])->name('user.changepassword.save');
	Route::get('user/points',[HomeController::class, 'userPoints'])->name('user.points');
});

// Stripe Payment Route
Route::post('stripe/payment/form_submit',[StripePaymentController::class, 'stripePostForm_Submit'])->name('stripe.payment.form_submit');
Route::get('payment/successfull/thankyou/{stripeTransactionId}',[StripePaymentController::class, 'thankyouStripePayment'])->name('payment.successfull.thankyou');

Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
	require 'custom/admin.php';
});

Route::group(['prefix'=>'tutor','middleware'=>'tutor'],function(){
	require 'custom/tutor.php';
});

Route::group(['prefix'=>'user','middleware'=>'customer'],function(){
	require 'custom/user.php';
});