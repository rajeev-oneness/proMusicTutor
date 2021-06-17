<?php 

  Route::get('/',function(){
    return view('tutor.dashboard');
  })->name('home');

?>