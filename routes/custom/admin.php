<?php
	
	namespace App\Http\Controllers\Admin;
	use Illuminate\Support\Facades\Route,Auth;

	Route::get('dashboard',function(){
		return view('admin.dashboard');
	})->name('home');

	Route::group(['prefix'=>'users'],function(){
		Route::get('/',[CrudController::class,'getUsers'])->name('admin.users');
		Route::get('/create',[CrudController::class,'createUser'])->name('admin.user.create');
		Route::post('/save',[CrudController::class,'saveUser'])->name('admin.user.save');
		Route::post('/manage',[CrudController::class,'manageUser'])->name('admin.user.manageUser');
	});

	Route::get('referred_to/user/{userId}',[CrudController::class,'getReferredToList'])->name('admin.referral.referred_to');
	Route::get('user/points/{userId}',[CrudController::class,'getUserPoints'])->name('admin.user.points');

	// Reports
	Route::group(['prefix' => 'report'],function(){
		Route::get('contact-us',[CrudController::class,'contactUs'])->name('admin.report.contactus');
		Route::post('contact-us/remark/save',[CrudController::class,'saveRemarkOfContactUs'])->name('admin.report.contactUsSaveRemark');
	});

	// Testimonials
	Route::group(['prefix'=>'testimonial'],function(){
		Route::get('/',[CrudController::class,'testimonials'])->name('admin.testimonial');
		Route::get('/create',[CrudController::class,'createTestimonial'])->name('admin.testimonial.create');
		Route::post('/save', [CrudController::class,'saveTestimonial'])->name('admin.testimonial.save');
		Route::get('/{id}/edit',[CrudController::class,'editTestimonial'])->name('admin.testimonial.edit');
		Route::post('/update',[CrudController::class,'updateTestimonial'])->name('admin.testimonial.update');
		Route::post('/{id}/delete', [CrudController::class,'deleteTestimonial'])->name('admin.testimonial.delete');
	});

	// Faqs
	Route::group(['prefix' => 'faq'],function(){
		Route::get('/',[CrudController::class,'faq'])->name('admin.faq');
		Route::get('/create',[CrudController::class,'createFaq'])->name('admin.faq.create');
		Route::post('/save', [CrudController::class,'saveFaq'])->name('admin.faq.save');
		Route::get('/{id}/edit',[CrudController::class,'editFaq'])->name('admin.faq.edit');
		Route::post('/update',[CrudController::class,'updateFaq'])->name('admin.faq.update');
		Route::post('/{id}/delete', [CrudController::class,'deleteFaq'])->name('admin.faq.delete');
	});
?>