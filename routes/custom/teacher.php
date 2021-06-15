<?php
	Route::get('dashboard',function(){
		return view('teacher.dashboard');
	})->name('home');
?>