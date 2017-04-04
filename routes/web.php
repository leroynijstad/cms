<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
use App\Notifications\InvoicePaid;

Route::auth();

Route::group(['prefix' => 'administrator','middleware' => 'auth'],function(){

	Route::get('/', 'DashboardController@index');
	
	Route::model('user', 'App\User');
	Route::get('module/user/{id}/delete', 'ResourceController@destroy');
	Route::resource('module/user', 'ResourceController');
	
	Route::model('module', 'App\Module');
	Route::get('module/module/{module}/delete', 'ResourceController@destroy');
	Route::resource('module/module', 'ResourceController');
	
	Route::model('banner', 'App\Banner');
	Route::get('module/banner/{banner}/delete', 'ResourceController@destroy');
	Route::resource('module/banner', 'ResourceController');
	
	Route::model('album', 'App\Album');
	Route::get('module/album/{album}/delete', 'ResourceController@destroy');
	Route::resource('module/album', 'ResourceController');
	
	Route::model('page', 'App\Page');
	Route::get('module/page/{page}/delete', 'ResourceController@destroy');
	Route::resource('module/page', 'ResourceController');

});	

Route::group(['prefix' => 'portfolio'], function(){

	Route::get('/', 'PortfolioController@index');
	Route::get('/album/{album}', 'PortfolioController@show');
	Route::get('/categorie/{categorie}', 'PortfolioController@index');

});

Route::get('/', 'MainController@home');
Route::get('/{pagelink}', 'MainController@show');
