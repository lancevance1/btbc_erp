<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/dashboard', 'DashboardController@show')->name('dashboard.show');
Route::patch('/orders/reverse/{id}', 'OrderController@reverse');
Route::delete('/orders/forceDelete/{id}', 'OrderController@forceDestroy');
Route::get('/orders/export/{id}', 'OrderController@export');
Route::resources([
    'orders' => 'OrderController',
    'products' => 'ProductController',

]);
//Route::get('/orders/create', 'OrderController@create')->name('orders.create');
//Route::post('/orders','OrderController@store')->name('orders.store');
//Route::get('/orders/{order}','OrderController@show')->name('orders.show');
//Route::get('/orders/{order}/edit','OrderController@edit')->name('orders.edit');
//Route::patch('/orders/{order}','OrderController@update')->name('orders.update');
//Route::redirect('/dashboard/{user}', '/home');
