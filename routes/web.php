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
Route::get('/administrator', 'AdminController@dashboard');

Route::get('/administrator/module/user/{id}/delete', 'ResourceController@destroy');
Route::resource('/administrator/module/user', 'ResourceController');

Route::get('/administrator/module/module/{id}/delete', 'ResourceController@destroy');
Route::resource('/administrator/module/module', 'ResourceController');

Route::get('/administrator/module/banner/{id}/delete', 'ResourceController@destroy');
Route::resource('/administrator/module/banner', 'ResourceController');

Route::get('/administrator/module/album/{id}/delete', 'ResourceController@destroy');
Route::resource('/administrator/module/album', 'ResourceController');

Route::get('/administrator/module/page/{id}/delete', 'ResourceController@destroy');
Route::resource('/administrator/module/page', 'ResourceController');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/portfolio', 'PortfolioController@index');
Route::get('/portfolio/album/{album}', 'PortfolioController@show');
Route::get('/portfolio/categorie/{categorie}', 'PortfolioController@showCategorie');

Route::get('/', 'MainController@home');
Route::get('/{page}', 'MainController@show');
