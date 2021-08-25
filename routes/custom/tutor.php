<?php
    namespace App\Http\Controllers\Tutor;
    use Illuminate\Support\Facades\Route;

    Route::get('dashboard',function(){
      return view('tutor.dashboard');
    })->name('home');

    // Guitar Series and Their Lession
    Route::group(['prefix' => 'guitar/series'],function(){
        Route::get('/',[TutorController::class,'guitarSeriesView'])->name('tutor.guitar.series');
        Route::get('/create',[TutorController::class,'guitarSeriesCreate'])->name('tutor.guitar.series.create');
        Route::post('/save',[TutorController::class,'guitarSeriesSave'])->name('tutor.guitar.series.save');
        Route::get('/{id}/edit',[TutorController::class,'guitarSeriesEdit'])->name('tutor.guitar.series.edit');
        Route::post('/{id}/update',[TutorController::class,'guitarSeriesUpdate'])->name('tutor.guitar.series.update');
        Route::post('/{id}/delete',[TutorController::class,'guitarSeriesDelete'])->name('tutor.guitar.series.delete');

        Route::group(['prefix' => 'guitar/series/{guitarSeriesId}/lession'],function(){
            Route::get('/',[TutorController::class,'guitarSeriesLessionView'])->name('tutor.guitar.series.lession');
            Route::get('/create',[TutorController::class,'guitarSeriesLessionCreate'])->name('tutor.guitar.series.lession.create');
            Route::post('/save',[TutorController::class,'guitarSeriesLessionSave'])->name('tutor.guitar.series.lession.save');
            Route::get('/{id}/edit',[TutorController::class,'guitarSeriesLessionEdit'])->name('tutor.guitar.series.lession.edit');
            Route::post('/{id}/update',[TutorController::class,'guitarSeriesLessionUpdate'])->name('tutor.guitar.series.lession.update');
            Route::post('/{id}/delete',[TutorController::class,'guitarSeriesLessionDelete'])->name('tutor.guitar.series.lession.delete');
        });
    });



    // Sax Series and Their Lession
    Route::group(['prefix' => 'sax/series'],function(){
        Route::get('/',[TutorController::class,'saxSeriesView'])->name('tutor.sax.series');
        Route::get('/create',[TutorController::class,'saxSeriesCreate'])->name('tutor.sax.series.create');
        Route::post('/save',[TutorController::class,'saxSeriesSave'])->name('tutor.sax.series.save');
        Route::get('/{id}/edit',[TutorController::class,'saxSeriesEdit'])->name('tutor.sax.series.edit');
        Route::post('/{id}/update',[TutorController::class,'saxSeriesUpdate'])->name('tutor.sax.series.update');
        Route::post('/{id}/delete',[TutorController::class,'saxSeriesDelete'])->name('tutor.sax.series.delete');

        Route::group(['prefix' => 'sax/series/{saxSeriesId}/lession'],function(){
            Route::get('/',[TutorController::class,'saxSeriesLessionView'])->name('tutor.sax.series.lession');
            Route::get('/create',[TutorController::class,'saxSeriesLessionCreate'])->name('tutor.sax.series.lession.create');
            Route::post('/save',[TutorController::class,'saxSeriesLessionSave'])->name('tutor.sax.series.lession.save');
            Route::get('/{id}/edit',[TutorController::class,'saxSeriesLessionEdit'])->name('tutor.sax.series.lession.edit');
            Route::post('/{id}/update',[TutorController::class,'saxSeriesLessionUpdate'])->name('tutor.sax.series.lession.update');
            Route::post('/{id}/delete',[TutorController::class,'saxSeriesLessionDelete'])->name('tutor.sax.series.lession.delete');
        });
    });
?>