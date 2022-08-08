<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;
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

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'namespace' => "User"
], function () {
    Route::get('/', 'HomeController@top')->name('top');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('admin/login','Auth\AdminAuthController@getLogin')->name('adminLogin');
Route::post('admin/login', 'Auth\AdminAuthController@postLogin')->name('adminLoginPost');
Route::post('admin/logout', 'Auth\AdminAuthController@logout')->name('adminLogout');


Route::group([
    'prefix' => 'admin',
    'namespace' => "Admin",
    'middleware' => 'admin'
], function () {
    Route::get('/', 'HomeController@index')->name('admin.home');
});

Auth::routes();
