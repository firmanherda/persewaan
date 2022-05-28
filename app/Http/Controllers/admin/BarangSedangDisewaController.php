<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Carbon\Carbon;
use Illuminate\Support\Carbon as SupportCarbon;

class BarangSedangDisewaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $members = User::where([
        //     ['role', 'user'],
        //     ['status', 'menunggu']
        // ])->get();
        $bsd = Transaksi::where('status_transaksi', 'Belum Dikembalikan')->get();


        return view('admin.barangdisewa.index', compact('bsd'));
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
    public function show(Request $request, $id)
    {
        // $bsd = Transaksi::with(['transaksiDetails.barang', 'user'])->find($id);
        // $tanggal_sewa = \Carbon\Carbon::parse($bsd->tanggal_sewa);
        // $tanggal_batas_kembali = \Carbon\Carbon::parse($bsd->tanggal_batas_kembali);
        // $now = \Carbon\Carbon::now()->toDateString();
        // $lamaSewa = $tanggal_sewa->diffInDays($tanggal_batas_kembali);
        // if ($now > $tanggal_batas_kembali) {
        //     $terlambat = $tanggal_batas_kembali->diffInDays($now);
        // }
        // $denda = 0;
        // if (isset($terlambat)){
        //     foreach ($bsd->transaksiDetails as $gajian) {
        //         $denda += $gajian->barang->harga * $terlambat;
        //     }
        // }
            $bsd = Transaksi::with(['transaksiDetails.barang', 'user'])->find($id);

            return view('admin.barangdisewa.show', compact('bsd'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bsd = TransaksiDetail::find($id);

        return view('admin.barangdisewa.edit', compact('bsd'));
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
        $total_harga = 0;

        foreach ($request->id as $key => $val) {
            $bsd = TransaksiDetail::find($val);
            $total_harga += $request->denda[$key];

            $bsd->update([
                'status' => $request->status[$key],
                'denda' => $request->denda[$key],
            ]);
            if ($request->status[$key] == 'Hilang' ||  $request->status[$key] == 'Rusak') {
                $bsd->barang()->update([
                    'stok' => $bsd->barang->stok - 1
                ]);
            }
        }
        $transaksi->update([
            'status_transaksi' => 'Selesai',
            'tanggal_kembali' => Carbon::now(), //d-m-Y H:i:s
            'total_harga' => $total_harga + $transaksi->total_harga
        ]);

        $transaksi->barangTanggals()->delete();

        return redirect()->route('admin.barangdisewa.index')->with('success','Barang Telah Dikembalikan');
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
