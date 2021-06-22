<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route,Auth;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/',[DefaultController::class,'welcome'])->name('welcome');
Route::get('about-us',[DefaultController::class,'aboutus'])->name('welcome.aboutus');
Route::get('browse/guitar',[DefaultController::class,'browserGuitar'])->name('guitar.series');
Route::get('browse/guitar/{seriesId}/details',[DefaultController::class,'browserGuitarDetails'])->name('guitar.series.details');
Route::get('subscription',[DefaultController::class,'subscription'])->name('subscription');
Route::get('explore/tutor/{tutorId?}',[DefaultController::class,'exploreTutor'])->name('explore.tutor');
Route::post('email/subscribe',[DefaultController::class,'subscribeEmail'])->name('email.subscribe');
Route::get('email/unsubscribe',[DefaultController::class,'unSubscribeEmail'])->name('email.unsubscribe');

Route::get('terms-and-condition',[DefaultController::class,'termsAndCondition'])->name('terms&condition');
Route::get('privacy/policy',[DefaultController::class,'privacyPolicy'])->name('privacy.policy');

Auth::routes(['logout'=>false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::any('logout',[HomeController::class,'logout'])->name('logout');

// SOCIALITE SIGN-IN
Route::get('sign-in/{socialite}',[LoginController::class,'socialiteLogin'])->name('socialite.login');
Route::get('sign-in/{socialite}/redirect',[LoginController::class,'socialiteLoginRedirect'])->name('socialite.login.redirect');

// // SOCIALITE SIGN-IN
// Route::get('sign-in/{socialite}','LoginController@socialiteLogin');
// Route::get('sign-in/{socialite}/redirect','LoginController@socialiteLoginRedirect')->name('socialite.login.redirect');

// Common Auth Routes
Route::group(['middleware' => 'auth'],function(){
	Route::get('user/profile',[HomeController::class, 'userProfile'])->name('user.profile');
	Route::post('user/profile',[HomeController::class, 'userProfileSave'])->name('user.profile.save');
	// Route::get('user/change/password',[HomeController::class, 'index'])->name('user.changepassword');
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