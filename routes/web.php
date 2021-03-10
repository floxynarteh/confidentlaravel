<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AddOnController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;

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

Route::view('test', 'dashboard');

Route::get('/', 'OrderController@index')->name('home');
Route::post('/order', 'OrderController@store')->name('order.store');
Route::resource('invoice', 'InvoiceController', ['only' => ['create', 'store']]);

Route::group(['middleware' => 'auth'], function () {
    Route::resource('dashboard', 'DashboardController', ['only' => ['index']]);
    Route::resource('videos', 'VideosController', ['only' => ['show']]);

    Route::get('users/edit', 'UsersController@edit')->name('user.edit');
    Route::put('users', 'UsersController@update');

    Route::resource('add-ons', 'AddOnController')->only('index', 'store')->middleware('add-ons');
    Route::resource('watches', 'WatchesController')->only('store')->middleware('can:upgrade');
});

Route::get('promotions/{code}', 'CouponController@show');

//Route::get('dashboard',function(){ return 'Dashboard';});

Route::get('videos/show','VideosController@index');
Route::get('videos/show', function() {
    return view('videos.show', [
        'now_playing' => 'now playing',
    ]);
});
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
