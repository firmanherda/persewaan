<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.home');
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
        $barang = Barang::with(['kategori'])->find($id);
        return view('user.showbarang', ['barang' => $barang]);
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

    /* public function cekStok(Request $request, $id)
    {
        $tanggalCek = Carbon::parse($request->tanggal)->format('Y-m-d');

        $stok = Barang::find($id)->stok;
        $bookingsMulaiSewa = Transaksi::select('transaksis.*', DB::raw('sum(transaksi_details.jumlah) as jumlah'))
            ->leftJoin('transaksi_details', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
            ->where('transaksi_details.barang_id', $id)
            ->where('transaksis.tanggal_sewa', '<=', $tanggalCek) // 22 <= 24
            ->where('transaksis.tanggal_batas_kembali', '>=', $tanggalCek) // 27 <= 24
            ->groupBy('transaksis.id')
            ->get()
            ->sum('jumlah');
        $stok -= $bookingsMulaiSewa;

        dd($stok);
    } */
}
