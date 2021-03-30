<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\RequestController;
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
    if(Auth::check()){
        return redirect()->route('redirect');
    }
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => ['can:Kelola User']], function(){
        Route::resource('kelola-user', AdminDashboardController::class);    
        Route::resource('kelola-role', RoleController::class);
        Route::resource('kelola-permission', PermissionController::class);
    });
    
    // Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    //     Route::resource('dashboard', AdminDashboardController::class);
    // });

    Route::group(['middleware' => ['can:Input Permohonan']], function () {        
        Route::resource('permohonan', RequestController::class);
        // Route::get('permohonan', [RequestController::class, 'index'])->name('user.request');
        // Route::get('input-permohonan', [RequestController::class, 'index'])->name('user.create.request');        
    });
});
