<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanans = Transaksi::where('status_pembayaran', 'Menunggu Pembayaran')->get();
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
            $transaksi->update(['status_pengambilan_barang' => 'Belum Diambil']);
            return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan Telah Diterima');
        } else if ($request->aksi == 'Ditolak') {
            $transaksi->transaksiDetails()->delete();
            $transaksi->barangTanggals()->delete();
            return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan Telah Ditolak');
        }


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
