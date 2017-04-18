<?php

use Illuminate\Http\Request;
use App\Notifications\InvoicePaid;

Route::group(['prefix' => 'administrator','namespace'=> 'admin','middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index');

    Route::group(['prefix' => 'module','middleware' => 'auth'], function () {
        
        if($modules = App\Module::all()){

            foreach ($modules as $module) {
                Route::get($module->name, ucfirst($module->name).'Controller@index');
                Route::get($module->name.'/create', ucfirst($module->name).'Controller@create');
                Route::get($module->name."/{".$module->name."}/edit", ucfirst($module->name).'Controller@edit');
                Route::get($module->name."/{".$module->name."}/delete", ucfirst($module->name).'Controller@destroy');

                Route::post($module->name, ucfirst($module->name).'Controller@store');
                Route::patch($module->name."/{".$module->name."}", ucfirst($module->name).'Controller@update');
            }
        }
    });
});

Route::auth();

Route::get('portfolio', 'PortfolioController@index');
Route::get('portfolio/album/{album}', 'PortfolioController@show');
Route::get('portfolio/categorie/{categorie}', 'PortfolioController@index');

Route::get('/', 'MainController@home');
Route::get('/{pagelink}', 'MainController@show');
