<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $checkout = true;
            $keranjang = Keranjang::with('keranjangDetails.barang')->firstWhere('user_id', Auth::id());
            $transaksiDetails = [];
            $jumlah = 0;

            $tanggalSewa = Carbon::parse($keranjang->tanggal_sewa);
            $tanggalKembali = Carbon::parse($keranjang->tanggal_batas_kembali);
            $lamaSewa =$tanggalSewa->diffInDays($tanggalKembali);

            foreach ($keranjang->keranjangDetails as $k) {
                $jumlah += $k->jumlah;

                for ($i = 0; $i < $k->jumlah; $i++) {
                    $newKeranjang = $k;
                    $newKeranjang->subtotal = $newKeranjang->barang->harga * $lamaSewa;
                    unset($newKeranjang->id);

                    array_push($transaksiDetails, $newKeranjang->toArray());
                }

                if (!$k->checkoutable) {
                    $checkout = false;
                }
            }

            if (!$checkout) {
                return redirect()->back()->withErrors(['status' => 'Stok barang tidak mencukupi']);
            }

            $transaksi = Transaksi::create([
                'user_id' => Auth::id(),
                'total_harga' => $keranjang->keranjangDetails->sum('subtotal'),
                'jumlah' => $jumlah,
                'tanggal_sewa' => Carbon::parse($keranjang->tanggal_sewa)->format('Y-m-d'),
                'tanggal_batas_kembali'=> Carbon::parse($keranjang->tanggal_batas_kembali)->format('Y-m-d'),
            ]);

            $transaksiDetails = $transaksi->transaksiDetails()->createMany($transaksiDetails);
            $transaksi->update(['total_harga' => $transaksiDetails->sum('subtotal')]);

            Keranjang::where('user_id', Auth::id())->delete();

            $barangTanggals = [];
            $transaksiDetails = $transaksiDetails->groupBy('barang_id');
            $period = CarbonPeriod::create($transaksi->tanggal_sewa, $transaksi->tanggal_batas_kembali);

            foreach ($period as $tanggal) {
                $bt = $transaksiDetails
                    ->map(fn ($td, $key) => [
                        'barang_id' => $key,
                        'transaksi_id' => $td[0]->transaksi_id,
                        'jumlah_disewa' => $td->count(),
                        'tanggal' => $tanggal->format('Y-m-d')
                    ])
                    ->values()
                    ->toArray();
                $barangTanggals = array_merge($barangTanggals, $bt);
            }

            DB::table('barang_tanggals')->insert($barangTanggals);

            return redirect()->route('user.home');
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
