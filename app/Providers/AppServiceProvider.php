<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Admin;
use Illuminate\Support\Facades\View; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         $webDetail=Admin::orderBy('id','DESC')->first()->get(['webSiteName', 'email', 'address', 'addressMapUrl', 'contact', 'instagram','facebook', 'youtube', ]);
				View::share('webDetail', $webDetail);
    }
}
