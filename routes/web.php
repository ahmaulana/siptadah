<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\RequestController;
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

Route::get('/redirects', [HomeController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('dashboard', AdminDashboardController::class);
    });

    Route::group(['middleware' => 'role:user', 'prefix' => 'user', 'as' => 'user.'], function () {
        Route::resource('dashboard', UserDashboardController::class);
        Route::resource('request', RequestController::class);
        // Route::get('permohonan', [RequestController::class, 'index'])->name('user.request');
        // Route::get('input-permohonan', [RequestController::class, 'index'])->name('user.create.request');        
    });
});
