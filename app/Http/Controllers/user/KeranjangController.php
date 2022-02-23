<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Keranjang;
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
        $keranjangs = Keranjang::with(['barang'])->where('user_id', Auth::id())->get();

        return view('user.keranjang.index', ['keranjangs' => $keranjangs]);
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
            Auth::user()->keranjangs()->create([
                'barang_id' => $request->barang,
                'jumlah' => $request->jumlah,
            ]);

            $barang = Barang::find($request->barang);
            $barang->update([
                'stok' => $barang->stok - $request->jumlah
            ]);

            return redirect()->route('user.keranjang.index')->with([
                'status' => 'OK',
                'msg' => 'Barang telah ditambahkan ke keranjang'
            ]);
        } catch (Throwable $e) {
            return redirect()->back()->withErrors("Barang gagal ditambahkan ke keranjang; {$e->getMessage()}");
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
