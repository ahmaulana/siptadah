<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\RequestController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PhpOffice\PhpWord\Template;
use PhpOffice\PhpWord\TemplateProcessor;

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
    if (User::findOrFail(auth()->user()->id)->hasRole('admin')) {
        return redirect()->route('permohonan.index');
    } else {
        return redirect()->route('permohonan.index');
    }
})->name('redirect');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => ['can:Kelola User']], function () {
        Route::resource('kelola-user', AdminDashboardController::class);
        Route::resource('kelola-role', RoleController::class);
        Route::resource('kelola-permission', PermissionController::class);
    });

    // Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    //     Route::resource('dashboard', AdminDashboardController::class);
    // });

    Route::group(['middleware' => ['can:Kelola Permohonan']], function () {
        Route::resource('permohonan', RequestController::class);
        // Route::get('permohonan', [RequestController::class, 'index'])->name('user.request');
        // Route::get('input-permohonan', [RequestController::class, 'index'])->name('user.create.request');        
    });
});

Route::get('/word', function () {
    $template = new TemplateProcessor(storage_path('app/template/surat.docx'));
    $template->setValue('nama_tersangka', 'Agus');
    $template->setValue('tempat_lahir', 'Demak');
    $template->setValue('tgl_lahir', '3 April 2000');
    $template->setValue('alamat', 'Mranggen');
    // Saving the document as OOXML file...    
    $template->saveAs('test.docx');
});
