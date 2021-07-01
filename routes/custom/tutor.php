<?php
    namespace App\Http\Controllers\Tutor;
    use Illuminate\Support\Facades\Route;

    Route::get('dashboard',function(){
      return view('tutor.dashboard');
    })->name('home');

    Route::group(['prefix' => 'guitar/series'],function(){
        Route::get('/',[TutorController::class,'guitarSeriesView'])->name('tutor.guitar.series');
        Route::get('/create',[TutorController::class,'guitarSeriesCreate'])->name('tutor.guitar.series.create');
        Route::post('/save',[TutorController::class,'guitarSeriesSave'])->name('tutor.guitar.series.save');
        Route::get('/{id}/edit',[TutorController::class,'guitarSeriesEdit'])->name('tutor.guitar.series.edit');
        Route::post('/{id}/update',[TutorController::class,'guitarSeriesUpdate'])->name('tutor.guitar.series.update');
        Route::post('/{id}/delete',[TutorController::class,'guitarSeriesDelete'])->name('tutor.guitar.series.delete');

        Route::group(['prefix' => 'guitar/series/{guitarSeriesId}/lession'],function(){
            Route::get('/',[TutorController::class,'guitarSeriesLessionView'])->name('tutor.guitar.series.lession');
        });
    });
?>