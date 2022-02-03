<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keranjangs = Keranjang::all();
        return view('user.keranjang.index' , ['keranjangs' => $keranjangs]);
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
    public function store(Request $request, $id)
    {
        $keranjangs = Keranjang::create([
            'nama' => $request->nama,
            'barang_id' => $request->barang ,
            'jumlah' => $request->jumlah,
        ]);
        return redirect()->route('keranjang.index')->with('status', 'Keranjang telah ditambah');
            //$nama = $request->input('nama');
            //$barang_id = $request->input('barang_id');

        // $jumlah = $request->input('jumlah');
        // $keranjang = new Keranjang();
        // $keranjang->nama = Auth::user()->nama;
        // $keranjang->barang_id = $id;
        // $keranjang->jumlah = $jumlah;
        // $keranjang->save();
        // return back()->with('status', 'Keranjang telah ditambah');

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
