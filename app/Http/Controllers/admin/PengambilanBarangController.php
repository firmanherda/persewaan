<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;

class PengambilanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengambilan = Transaksi::where('status_pengambilan_barang', 'Belum Diambil')->get();
        return view('admin.pengambilanbarang.index', compact('pengambilan'));
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
        $pengambilan = Transaksi::with(['transaksiDetails.barang', 'user'])->find($id);

        return view('admin.pengambilanbarang.show', compact('pengambilan'));
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

        $pengambilan = Transaksi::find($id);
        $pengambilan->update([
            'status_pengambilan_barang' => 'Sudah Diambil',
            'status_transaksi' => 'Belum Dikembalikan',
            'jenis_jaminan' => $request->jenis_jaminan
        ]);
        return redirect()->route('admin.pengambilanbarang.index')->with('success' , 'Barang Telah Diambil');
    }
     // $pengambilan = Transaksi::find($id);
        // $pengambilan->update(['status_pengambilan_barang' => $request->aksi]);


        // if ($request->aksi == 'Sudah Diambil') {
        //     $pengambilan->update(['status_transaksi' => 'Belum Dikembalikan']);
        // } else if ($request->aksi == 'Ditolak') {
        //     $pengambilan->transaksiDetails()->delete();
        //     $pengambilan->barangTanggals()->delete();
        // }

        // return redirect()->route('admin.pengambilanbarang.index');

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
