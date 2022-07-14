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
            return redirect('report_peminjaman');
        }
        else if(Auth::user()->role == 3){
            return redirect('peminjaman');
        }
        else {
            return redirect('report_peminjaman');
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
    Route::post('/edit_inventaris', [HomeController::class, 'edit_inventaris'])->name('edit_inventaris');
    Route::post('/save_inventaris', [HomeController::class, 'save_inventaris'])->name('save_inventaris');
    Route::post('/delete_inventaris', [HomeController::class, 'delete_inventaris'])->name('delete_inventaris');

    Route::get('/kelola_lab', [HomeController::class, 'kelola_lab'])->name('kelola_lab');
    Route::post('/tambah_lab', [HomeController::class, 'tambah_lab'])->name('tambah_lab');
    Route::post('/edit_lab', [HomeController::class, 'edit_lab'])->name('edit_lab');
    Route::post('/save_lab', [HomeController::class, 'save_lab'])->name('save_lab');
    Route::post('/delete_lab', [HomeController::class, 'delete_lab'])->name('delete_lab');
    
    
    Route::get('/peminjaman', [HomeController::class, 'peminjaman'])->name('peminjaman');
    Route::post('/cek_barang', [HomeController::class, 'cek_barang'])->name('cek_barang');
    Route::post('/ajukan_peminjaman', [HomeController::class, 'ajukan_peminjaman'])->name('ajukan_peminjaman');
    Route::get('/pengembalian', [HomeController::class, 'pengembalian'])->name('pengembalian');
    Route::get('/report_lab', [HomeController::class, 'report_lab'])->name('report_lab');
    Route::get('/report_data_user', [HomeController::class, 'report_data_user'])->name('report_data_user');
    Route::post('kembalikan_barang', [HomeController::class, 'kembalikan_barang'])->name('kembalikan_barang');

    Route::get('/riwayat_peminjaman', [HomeController::class, 'riwayat_peminjaman'])->name('riwayat_peminjaman');
    Route::get('/report_peminjaman', [HomeController::class, 'report_peminjaman'])->name('report_peminjaman');

    // ADMIN
    Route::post('/verifikasi_peminjaman', [HomeController::class, 'verifikasi_peminjaman'])->name('verifikasi_peminjaman');
    Route::post('/verifikasi_pengembalian', [HomeController::class, 'verifikasi_pengembalian'])->name('verifikasi_pengembalian');

});