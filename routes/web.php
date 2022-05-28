<?php

use App\Http\Controllers\Admin\BarangController as AdminBarangController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\Admin\BarangSedangDisewaController as AdminBarangSedangDisewaController;
use App\Http\Controllers\Admin\RiwayatTransaksiController as AdminRiwayatTransaksiController;
use App\Http\Controllers\Admin\VerifikasiMemberController as AdminVerifikasiMemberController;
use App\Http\Controllers\Admin\PengambilanBarangController as AdminPengambilanBarangController;
use App\Http\Controllers\Admin\AlternatifController as AdminAlternatifController;
use App\Http\Controllers\Admin\PenilaianController as AdminPenilaianController;
use App\Http\Controllers\admin\KriteriaController as AdminKriteriaController;
use App\Http\Controllers\admin\PengeluaranController as AdminPengeluaranController;
use App\Http\Controllers\admin\SubKriteriaController as AdminSubKriteriaController;


use App\Http\Controllers\User\BarangController as UserBarangController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\User\KeranjangController as UserKeranjangController;
use App\Http\Controllers\User\ProfilController as UserProfilController;
use App\Http\Controllers\User\TransaksiController as UserTransaksiController;
use App\Http\Controllers\User\VerifikasiMemberController as UserVerifikasiMemberController;
use App\Http\Controllers\User\SedangDisewaController as UserSedangDisewaController;
use App\Http\Controllers\User\RiwayatTransaksiController as UserRiwayatTransaksiController;
use App\Http\Controllers\User\PesananController as UserPesananController;
use App\Http\Controllers\user\SPKController;
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
    return view('auth.login');
});

Auth::routes();

Route::prefix('admin')->group(function () {
    //Route::get('home', [AdminPesananController::class, 'index'])->name('homeadmin');
    Route::get('home', [AdminHomeController::class, 'index'])->name('homeadmin');
    Route::resource('barang', AdminBarangController::class, ['as' => 'admin']);
    Route::resource('member', AdminMemberController::class, ['as' => 'admin']);
    Route::resource('verifikasimember', AdminVerifikasiMemberController::class, ['as' => 'admin']);
   Route::resource('pesanan', AdminPesananController::class, ['as' => 'admin']);
    Route::resource('barangdisewa', AdminBarangSedangDisewaController::class, ['as' => 'admin']);
    Route::resource('riwayattransaksi', AdminRiwayatTransaksiController::class, ['as' => 'admin']);
    Route::resource('pengambilanbarang', AdminPengambilanBarangController::class, ['as' => 'admin']);
    Route::resource('kriteria', AdminKriteriaController::class, ['as' => 'admin']);
    Route::resource('alternatif', AdminAlternatifController::class, ['as' => 'admin']);
    Route::resource('penilaian', AdminPenilaianController::class, ['as' => 'admin']);
    Route::resource('subkriteria', AdminSubKriteriaController::class, ['as' => 'admin']);
    Route::resource('pengeluaran', AdminPengeluaranController::class, ['as' => 'admin']);
});

Route::name('user.')->group(function () {
    Route::get('home', [UserHomeController::class, 'index'])->name('home');
    Route::get('spk', [SPKController::class, 'index'])->name('spk.index');
    Route::post('spk', [SPKController::class, 'hitung'])->name('spk.hitung');
    Route::resource('profil', UserProfilController::class);
    Route::resource('barang', UserBarangController::class);
    Route::resource('keranjang', UserKeranjangController::class);
    Route::resource('transaksi', UserTransaksiController::class);
    Route::resource('sedangdisewa', UserSedangDisewaController::class);
    Route::resource('riwayattransaksi', UserRiwayatTransaksiController::class);
    Route::resource('pesanan', UserPesananController::class);

    Route::prefix('profil')->group(function () {
        Route::resource('verifikasi', UserVerifikasiMemberController::class, ['as' => 'profil'])->except(['index', 'destroy']);
    });
});
