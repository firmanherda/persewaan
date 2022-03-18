<?php

use App\Http\Controllers\Admin\BarangController as AdminBarangController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\KriteriaController as AdminKriteriaController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\Admin\AlternatifController as AdminAlternatifController;
use App\Http\Controllers\Admin\VerifikasiMemberController as AdminVerifikasiMemberController;


use App\Http\Controllers\User\BarangController as UserBarangController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\User\KeranjangController as UserKeranjangController;
use App\Http\Controllers\User\ProfilController as UserProfilController;
use App\Http\Controllers\User\TransaksiController as UserTransaksiController;
use App\Http\Controllers\User\VerifikasiMemberController as UserVerifikasiMemberController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|yes
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('home', [AdminHomeController::class, 'index'])->name('homeadmin');
    Route::resource('barang', AdminBarangController::class, ['as' => 'admin']);
    Route::resource('member', AdminMemberController::class, ['as' => 'admin']);
    Route::resource('verifikasimember', AdminVerifikasiMemberController::class, ['as' => 'admin']);
    Route::resource('pesanan', AdminPesananController::class, ['as' => 'admin']);
    Route::resource('kriteria', AdminKriteriaController::class, ['as' => 'admin']);
    Route::resource('alternatif', AdminAlternatifController::class, ['as' => 'admin']);
});

Route::name('user.')->group(function () {
    Route::get('home', [UserHomeController::class, 'index'])->name('home');
    Route::resource('profil', UserProfilController::class);
    Route::resource('barang', UserBarangController::class);
    Route::resource('keranjang', UserKeranjangController::class);
    Route::resource('transaksi', UserTransaksiController::class);

    Route::prefix('profil')->group(function () {
        Route::resource('verifikasi', UserVerifikasiMemberController::class, ['as' => 'profil'])->except(['index', 'destroy']);
    });
});
