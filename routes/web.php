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
    'customers' => 'CustomerController',
    'customers.contacts' => 'ContactController',
    'orders.pallets'=> 'PalletController',

]);

