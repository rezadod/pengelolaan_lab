<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/tambah_inventaris', [App\Http\Controllers\HomeController::class, 'tambah_inventaris'])->name('tambah_inventaris');
Route::get('/kelola_lab', [App\Http\Controllers\HomeController::class, 'kelola_lab'])->name('kelola_lab');
Route::post('/tambah_lab', [App\Http\Controllers\HomeController::class, 'tambah_lab'])->name('tambah_lab');
Route::get('/peminjaman', [App\Http\Controllers\HomeController::class, 'peminjaman'])->name('peminjaman');
});