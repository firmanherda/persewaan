<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pesanans = Transaksi::get();
        $pesanans = Transaksi::where('status_pembayaran', 'Menunggu Pembayaran')->get();
        //dd($pesanans);
        // $keranjangs = Keranjang::with(['barang'])->where('user_id', Auth::id())->get();
        return view('admin.pesanan.index', compact('pesanans'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::with(['transaksiDetails.barang', 'user'])->find($id);

        return view('admin.pesanan.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksiDetail = TransaksiDetail::find($id);

        return response()->json($transaksiDetail);
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
        $transaksi = Transaksi::find($id);
        $transaksi->update(['status_pembayaran' => $request->aksi]);


        if ($request->aksi == 'Lunas') {
            $transaksiDetails = $transaksi->transaksiDetails;
            $transaksi->update(['status_transaksi' => 'Belum Dikembalikan']);
            /* foreach ($transaksiDetails as $detail) {
                $barang = Barang::find($detail->barang_id);
                $barang->update(['stok' => $barang->stok - 1]);
            } */

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

            // dd($barangTanggals);

            DB::table('barang_tanggals')->insert($barangTanggals);
        } else if ($request->aksi == 'Ditolak') {
            $transaksi->transaksiDetails()->delete();
        }

        return redirect()->route('admin.pesanan.index');
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
