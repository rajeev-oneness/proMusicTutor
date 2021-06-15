<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try{
            //view()->share('contact', ContactUs::where('id',1)->where('type',1)->first());    
        }catch(Exception $e){
            // dd($e);
        }
    }
}
