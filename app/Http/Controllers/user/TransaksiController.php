<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $keranjangs = Keranjang::where('user_id', Auth::id())->get();

            foreach ($keranjangs as $keranjang) {
                if (!$keranjang->checkoutable) {
                    $checkout = false;
                }
            }

            if (!$checkout) {
                return redirect()->route('user.keranjang.index')->withErrors(['status' => 'Stok barang tidak mencukupi']);
            }

            $transaksi = Transaksi::create([
                'user_id' => Auth::id(),
                // 'jumlah' => $keranjangs

                'total_harga' => $keranjangs->sum('subtotal'),
                'jumlah' => $request->jumlah,
                'tanggal_sewa' => Carbon::parse($request->tanggal_sewa)->format('Y-m-d'),
                'tanggal_batas_kembali' => Carbon::parse($request->tanggal_batas_kembali)->format('Y-m-d'),
            ]);

            // $transaksi->transaksiDetails()->createMany($keranjangs->toArray());

            Keranjang::where('user_id', Auth::id())->delete();

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
