<?php 

  Route::get('/',function(){
    return view('user.dashboard');
  })->name('home');

?>