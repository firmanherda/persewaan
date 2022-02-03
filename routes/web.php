<?php

use App\Http\Controllers\admin\BarangController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\MemberController;
use App\Http\Controllers\admin\PesananController;
use App\Http\Controllers\admin\VerifikasiMemberController;
use App\Http\Controllers\user\BarangController as UserBarangController;
use App\Http\Controllers\user\HomeController as UserHomeController;
use App\Http\Controllers\user\KeranjangController;
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
|yes
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('homeadmin');
    Route::resource('barang', BarangController::class,["as"=>"admin"]);
    Route::resource('member', MemberController::class);
    Route::resource('verifikasimember', VerifikasiMemberController::class);
    Route::resource('pesanan', PesananController::class);
});

Route::prefix('user')->group(function () {
    Route::get('home', [UserHomeController::class, 'index'])->name('homeuser');
    Route::resource('barang', UserBarangController::class,["as"=>"user"]);
    Route::resource('keranjang', KeranjangController::class);
    Route::view('profil', "user.profil.profil")->name('profiluser');
    Route::view('verifikasiprofil', "user.profil.verifikasi")->name('verifikasiprofiluser');
    //Route::view('showbarang/{id}', "user.showbarang")->name('showbarang');
    Route::get('showbarang/{id}', [UserHomeController::class, 'show'])->name('showbarang');
// Route::post('showbarang/{id}', [KeranjangController::class, 'store'])->name('addbarang');
    // Route::resource('home', UserHomeController::class,["as"=>"user"]);
});


//Route::resource('barang', BarangrController::class);




