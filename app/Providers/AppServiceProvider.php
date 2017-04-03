<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Page;
use App\Module;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { 
        view()->composer('backend.layouts.menu', function($view){
            $view->with('modules', Module::all());
        });
        view()->composer('frontend.layouts.menu', function($view){
            $view->with('pages', Page::all());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
