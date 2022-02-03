<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use App\Models\VerifikasiMember;
use Illuminate\Support\Facades\Storage;

class VerifikasiMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $members = User::with(['user'])->get();
        //  return view('admin.verifikasimember.index' , ['members' => $members]);
        $members = User::where("status","pending","ditolak")->get();
        return view('admin.verifikasimember.index' , ['members' => $members]);
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
        $verifikasimember = VerifikasiMember::create([
            'namalengkap' => $request->namalengkap,
            'nomoridentitas' => $request->nomoridentitas,
            'alamatidentitas' =>$request->alamatidentitas,
            'fotoidentitas' => $request->fotoidentitas,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);
        return redirect()->route('verifikasimember.index');
    //     //  $dokter = $user->dokter()->create([
    //     //     'deskripsi' => $request->deskripsi,
    //     //     'foto' => "public/dokter/{$user->nama}.{$foto->extension()}"
    //     // ]);
    //    $foto = $request->file('fotoidentitas');
    //    // $foto->storeAs('verifikasimember', "{$verifikasimember->nama}.{$foto->extension()}");
    //     $verifikasimember = VerifikasiMember::create([
    //         'namalengkap' => $request->namalengkap,
    //         'nomoridentitas' => $request->nomoridentitas,
    //         'alamatidentitas' => $request->alamatidentitas,
    //         'fotoidentitas' => $request->fotoidentitas,
    //         'tanggal_lahir' => $request->tanggal_lahir,

    //     ]);
    //     return redirect()->route('verifikasimember.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $members = User::find($id);

        return view('admin.verifikasimember.show', ['member' => $members]);
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
