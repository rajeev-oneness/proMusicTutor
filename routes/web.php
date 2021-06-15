<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Common Auth Routes
Route::group(['middleware' => 'auth'],function(){
	Route::get('user/profile','HomeController@userProfile')->name('user.profile');
	Route::post('user/profile','HomeController@userProfileSave')->name('user.profile.save');
	// Route::get('user/change/password','HomeController@changePassword')->name('user.changepassword');
	Route::post('user/change/password','HomeController@updateUserPassword')->name('user.changepassword.save');
	Route::get('user/points','HomeController@userPoints')->name('user.points');
});

// Stripe Payment Route
Route::post('stripe/payment/form_submit','StripePaymentController@stripePostForm_Submit')->name('stripe.payment.form_submit');
Route::get('payment/successfull/thankyou/{stripeTransactionId}','StripePaymentController@thankyouStripePayment')->name('payment.successfull.thankyou');

Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
	require 'custom/admin.php';
});

Route::group(['prefix'=>'teacher','middleware'=>'teacher'],function(){
	require 'custom/teacher.php';
});

Route::group(['prefix'=>'student','middleware'=>'student'],function(){
	require 'custom/student.php';
});