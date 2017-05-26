<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('country' , getCountryBySlug());
        View::share('cats' , getAllCats());
        View::share('siteTitle' , getSetting('siteTitle'));

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       Schema::defaultStringLength(191);
    }
}
