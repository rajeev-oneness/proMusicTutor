<?php
	Route::get('dashboard',function(){
		return view('admin.dashboard');
	})->name('home');
?>