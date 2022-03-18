<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Keranjang;
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
        // $pesanans = Transaksi::get();
        $pesanans = Transaksi::all();
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
        $transaksi->update(['status' => $request->aksi]);

        if ($request->aksi == 'Berhasil') {
            $transaksiDetails = $transaksi->transaksiDetails;

            foreach ($transaksiDetails as $detail) {
                $barang = Barang::find($detail->barang_id);
                $barang->update(['stok' => $barang->stok - 1]);
            }
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
