<?php
	Route::get('dashboard',function(){
		return view('student.dashboard');
	})->name('home');
?>