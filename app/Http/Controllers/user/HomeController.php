<?php

namespace App\Http\Controllers\User;

use App\Models\Barang;
use App\Http\Controllers\Controller;
use App\Models\BarangTanggal;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jumlahfix = [];
        $barangs = Barang::all();
        $keranjang = Keranjang::with(['keranjangDetails.barang'])->firstWhere('user_id', Auth::id());

        if ($request->tanggal_sewa && $request->tanggal_batas_kembali) {
            $sewa = BarangTanggal::where([
                    ['tanggal', '>=', $request->tanggal_sewa],
                    ['tanggal', '<=', $request->tanggal_batas_kembali]
                ])
                ->distinct()
                ->get(['barang_id', 'transaksi_id', 'jumlah_disewa']);

            foreach ($sewa as $s) {
                if (!in_array($s, $jumlahfix)) {
                    array_push($jumlahfix, $s);
                }
            }

            $jumlahfix = collect($jumlahfix)->groupBy('barang_id');


            foreach ($barangs as $barang) {
                foreach ($sewa as $s) {
                    if ($s->barang_id == $barang->id) {
                        $barang->stok = $barang->stok - $s->jumlah_disewa;
                    }
                }
            }
        }
        return view('user.home', compact('barangs', 'keranjang'));
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
        $barangs = Barang::find($id);
        $users = Auth::user();
        return view('user.showbarang', ['barang' => $barangs, 'users' => $users])->with('success', 'Barang telah ditambah kedalam keranjang');
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
