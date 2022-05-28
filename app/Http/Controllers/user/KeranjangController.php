<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\KeranjangDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keranjang = Keranjang::with(['keranjangDetails.barang'])->firstWhere('user_id', Auth::id());

        return view('user.keranjang.index', compact('keranjang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $barang = Barang::where('id', $id)->get();
        return view('user.showbarang', compact('barang'));
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
            $user = Auth::user();

            $keranjang = Keranjang::with(['keranjangDetails'])->firstWhere('user_id', $user->id);

            if ($keranjang) {
                if ($keranjang->tanggal_sewa == $request->tanggal_sewa && $keranjang->tanggal_batas_kembali == $keranjang->tanggal_batas_kembali) {
                    $keranjangDetails = $keranjang->keranjangDetails;
                    $barang = $keranjangDetails->firstWhere('barang_id', $request->barang);

                    if ($barang) {
                        $barang->update(['jumlah' => $barang->jumlah + $request->jumlah]);
                    } else {
                        $keranjang->keranjangDetails()->create([
                            'barang_id' => $request->barang,
                            'jumlah' => $request->jumlah,
                            'subtotal' => $request->subtotal
                        ]);
                    }
                } else {
                    return redirect()->back()->withErrors(['status' => "Tanggal keranjang tidak sama"]);
                }
            } else {
                $k = $user->keranjangs()->create([
                    'tanggal_sewa' => $request->tanggal_sewa,
                    'tanggal_batas_kembali' => $request->tanggal_batas_kembali
                ]);

                $k->keranjangDetails()->create([
                    'barang_id' => $request->barang,
                    'jumlah' => $request->jumlah,
                    'subtotal' => $request->subtotal
                ]);
            }

            return redirect()->back();
        } catch (Throwable $e) {
            return redirect()->back()->withErrors(['status' => "Barang gagal ditambahkan ke keranjang: {$e->getMessage()}"]);
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
        $keranjangs = Keranjang::with(['keranjangDetails'])->firstOrFail();
        //$keranjangs = KeranjangDetail::whereId($id)->firstOrFail();
        $keranjangs->delete();

        return redirect()->route('user.keranjang.index')->with('Status', 'Barang dengan nama');
    }
}
