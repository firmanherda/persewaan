<?php

use App\Http\Controllers\Admin\BarangController as AdminBarangController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\KriteriaController as AdminKriteriaController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\Admin\AlternatifController as AdminAlternatifController;
use App\Http\Controllers\Admin\BarangSedangDisewaController as AdminBarangSedangDisewaController;
use App\Http\Controllers\Admin\RiwayatTransaksiController as AdminRiwayatTransaksiController;
use App\Http\Controllers\Admin\VerifikasiMemberController as AdminVerifikasiMemberController;


use App\Http\Controllers\User\BarangController as UserBarangController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\User\KeranjangController as UserKeranjangController;
use App\Http\Controllers\User\ProfilController as UserProfilController;
use App\Http\Controllers\User\TransaksiController as UserTransaksiController;
use App\Http\Controllers\User\VerifikasiMemberController as UserVerifikasiMemberController;
use App\Http\Controllers\User\SedangDisewaController as UserSedangDisewaController;
use App\Http\Controllers\User\RiwayatTransaksiController as UserRiwayatTransaksiController;
use App\Http\Controllers\User\PesananController as UserPesananController;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

Route::get('/cek', function() {
    $tanggalMulai = Carbon::parse('2022-03-25')->format('Y-m-d');
    $tanggalAkhir = Carbon::parse('2022-03-31')->format('Y-m-d');

    // $stok = Barang::find($id)->stok;
    $bookingsMulaiSewa = DB::table('barang_stok')
        ->select('transaksis.*')
        ->leftJoin('transaksi_details', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
        ->whereIn('transaksi_details.barang_id', [1, 2])
        ->where(function ($q) use ($tanggalMulai) {
            return $q->where([
                ['transaksis.tanggal_sewa', '<=', $tanggalMulai],
                ['transaksis.tanggal_batas_kembali', '>=', $tanggalMulai],
            ]);
        })
        ->orWhere(function ($q) use ($tanggalAkhir) {
            return $q->where([
                ['transaksis.tanggal_sewa', '<=', $tanggalAkhir],
                ['transaksis.tanggal_batas_kembali', '>=', $tanggalAkhir]
            ]);
        })
        ->groupBy('transaksis.id')
        ->toSql();
    // $stok -= $bookingsMulaiSewa;

    dd($bookingsMulaiSewa);
});

Route::get('cek2', function () {
    $jumlahfix = [];
    $sewa = DB::table('barang_stok')
        ->select('barang_id', 'jumlah_disewa')
        ->where([
            ['tanggal', '>=', '2022-03-27'],
            ['tanggal', '<=', '2022-03-30']
        ])
        ->distinct()
        ->get();

    foreach ($sewa as $s) {
        if (!in_array($s, $jumlahfix)) {
            array_push($jumlahfix, $s);
        }
    }

    $jumlahfix = collect($jumlahfix)->groupBy('barang_id');
    $test = [];
    foreach ($jumlahfix as $id => $j) {
        $c = collect($j);
        $test[$id] = $c->sum('jumlah_disewa');
    }

    dd($test);

    $barangs = Barang::query()
        ->when(count($sewa) >= 1,
            function ($q) use ($sewa) {
                return $q->whereIn('id', $sewa->map(fn($s) => $s->id));
            }
        )
        ->get();

    foreach($barangs as $barang) {
        foreach ($sewa as $s) {
            if ($s->id == $barang->id) {
                $barang->stok = $barang->stok - $s->jumlah;
            }
        }
    }

    dd($barangs->map(fn($b) => ['id' => $b->id, 'stok' => $b->stok]));
});

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
    Route::resource('barangdisewa', AdminBarangSedangDisewaController::class, ['as' => 'admin']);
    Route::resource('riwayattransaksi', AdminRiwayatTransaksiController::class, ['as' => 'admin']);
});

Route::name('user.')->group(function () {
    Route::get('home', [UserHomeController::class, 'index'])->name('home');
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
