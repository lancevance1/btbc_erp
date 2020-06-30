<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home.index');
Route::get('/dashboard/{user}', 'DashboardController@index')->name('dashboard.show');
Route::get('/orders/create', 'OrderController@create')->name('orders.show');
Route::post('/orders','OrderController@store')->name('orders.store');
Route::get('/orders/{order}','OrderController@show')->name('orders.show');
//Route::redirect('/dashboard/{user}', '/home');
