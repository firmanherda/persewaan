<?php

namespace App\Http\Controllers\admin;

use App\Models\Barang;
use App\Models\Kategori;
use App\Http\Controllers\Controller;
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
        $barangs = Barang::all();
        return view('admin.barang.index' , ['barangs' => $barangs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.barang.create', ['kategoris' => $kategoris]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barangs = Barang::create([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori ,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'harga' =>$request->harga,
            'link_foto' => $request->nama .".jpg",
        // $barang->nama = $request->nama;
        // $barang->kategori_id = $request->kategori;
        // $barang->deskripsi = $request->deskripsi;
        // $barang->stok = $request->stok;
        // $barang->harga = $request->harga;
        // $barang->link_foto = 'img/'.$request->file;
        // $barang->save();
    ]);

        //dd($barang); //cara cari tau isi variable barang
        return redirect()->route('admin.barang.index')->with('status', 'Barang telah ditambah');
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
        $barangs = Barang::find($id);
        return view('admin.barang.edit', ['barang' => $barangs]);
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
        $barangs = Barang::find($id);

        $barangs->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.barang.index');
        // $barangs = Barang::find($id);


        // $barangs->nama = $request->nama;
        // $barangs->deskripsi = $request->deskripsi;
        // $barangs->stok = $request->stok;
        // $barangs->harga = $request->harga;

        // $barangs->save();

        // return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barangs = Barang::whereId($id)->firstOrFail();
        $namaBarang = $barangs->nama;
        $barangs->delete();

        return redirect(action('barang.index'))->with('Status','Barang dengan nama'.$namaBarang. 'telah dihapus');
    }
}
