<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiptadahController;
use App\Http\Controllers\PrisonerController;
use App\Models\User;
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
    if (Auth::check()) {
        return redirect()->route('redirect');
    }
    return view('welcome');
});

Route::get('/redirect', function () {
    if (User::findOrFail(auth()->user()->id)->hasRole(['Admin', 'admin'])) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('siptadah.index');
    }
})->name('redirect');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::group(['middleware' => ['can:Kelola User']], function () {
        Route::resource('kelola-user', AdminDashboardController::class);
        Route::resource('kelola-role', RoleController::class);
        Route::resource('kelola-permission', PermissionController::class);
    });

    Route::group(['middleware' => ['role_or_permission:Admin|Input Siptadah']], function () {
        Route::resource('siptadah', SiptadahController::class);
    });

    Route::group(['middleware' => ['role_or_permission:Admin|Input Tahanan']], function () {
        Route::resource('tahanan', PrisonerController::class);
    });
});
