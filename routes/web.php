<?php

use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    // Root
    Route::get('/', function () {
        if(Auth::user()->role == 2){
            return redirect('peminjaman');
        }
        else if(Auth::user()->role == 3){
            return redirect('peminjaman');
        }
        else {
            return redirect('home');
        }
    });
    Route::get('/home', function () {
        if(Auth::user()->role == 2){
            return redirect('peminjaman');
        }
        else if(Auth::user()->role == 3){
            return redirect('peminjaman');
        }
        else {
            return redirect('home');
        }
    });
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/kelola_inventaris', [HomeController::class, 'kelola_inventaris'])->name('kelola_inventaris');
    Route::post('/tambah_inventaris', [HomeController::class, 'tambah_inventaris'])->name('tambah_inventaris');
    Route::get('/kelola_lab', [HomeController::class, 'kelola_lab'])->name('kelola_lab');
    Route::post('/tambah_lab', [HomeController::class, 'tambah_lab'])->name('tambah_lab');
    Route::get('/peminjaman', [HomeController::class, 'peminjaman'])->name('peminjaman');
    Route::get('/pengembalian', [HomeController::class, 'pengembalian'])->name('pengembalian');

    Route::post('kembalikan_barang', [HomeController::class, 'kembalikan_barang'])->name('kembalikan_barang');
});