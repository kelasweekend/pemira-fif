<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;

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

Route::get('/', HomeController::class);

Auth::routes();


Route::group(['middleware' => ['auth', 'dontback']], function() {
    // vote system
    Route::get('vote',[App\Http\Controllers\Frontend\VoteController::class, 'index'])->name('vote');
    Route::get('vote/detail/{id}',[App\Http\Controllers\Frontend\VoteController::class, 'detail'])->name('detail');
    Route::post('vote',[App\Http\Controllers\Frontend\VoteController::class, 'send_voting'])->name('send');
    Route::get('vote/bukti',[App\Http\Controllers\Frontend\VoteController::class, 'bukti'])->name('bukti');
    // admin system
    Route::redirect('admin', 'admin/pemira');
    Route::resource('dashboard/roles', App\Http\Controllers\Role\RoleController::class);
    Route::resource('dashboard/permissions', App\Http\Controllers\Role\PermissionsController::class);
    Route::resource('dashboard/users', App\Http\Controllers\User\UserController::class);
    Route::resource('admin/pemira', App\Http\Controllers\Backend\PemiraController::class);
    Route::resource('admin/pemilih', App\Http\Controllers\Backend\PemilihController::class);
    Route::get('admin/vote',[App\Http\Controllers\Frontend\VoteController::class, 'dashboard'])->name('hasil');

    // excel pemilih
    Route::get('pemilih/export', [App\Http\Controllers\Excel\PemilihController::class, 'index'])->name('export-pemilih');
    Route::post('pemilih/export', [App\Http\Controllers\Excel\PemilihController::class, 'import_pemilih'])->name('import-pemilih');
});