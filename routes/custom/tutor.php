<?php
  Route::get('dashboard',function(){
    return view('tutor.dashboard');
  })->name('home');
?>