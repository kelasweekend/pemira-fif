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


Route::group(['middleware' => ['auth', 'dontback']], function () {
    Route::get('/home', [App\Http\Controllers\Home\HomeController::class, 'index'])->name('home');
    Route::resource('dashboard/roles', App\Http\Controllers\Role\RoleController::class);
    Route::resource('dashboard/permissions', App\Http\Controllers\Role\PermissionsController::class);
    Route::resource('dashboard/users', App\Http\Controllers\User\UserController::class);
    Route::resource('admin/pemira', App\Http\Controllers\Backend\PemiraController::class);
    Route::resource('admin/pemilih', App\Http\Controllers\Backend\PemilihController::class);
    // route vote
    Route::get('/vote', [App\Http\Controllers\Home\IndexController::class, 'index'])->name('home');
    Route::redirect('/admin', '/admin/pemira');
    // route excell
    Route::get('/excell/pemilih', [App\Http\Controllers\Excell\PemilihController::class, 'export_pemilih'])->name('export_pemilih');
    Route::post('/excell/pemilih', [App\Http\Controllers\Excell\PemilihController::class, 'import_pemilih'])->name('import_pemilih');
});
