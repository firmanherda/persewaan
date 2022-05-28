<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use App\Models\VerifikasiMember;
use Illuminate\Support\Facades\Storage;
use Throwable;

class VerifikasiMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = VerifikasiMember::whereHas('user', function ($q) {
            return $q->where('status', 'Menunggu');
        })->get();
        return view('admin.verifikasimember.index', ['members' => $members]);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $verifikasi = VerifikasiMember::find($id);


        return view('admin.verifikasimember.show', ['member' => $verifikasi]);
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
        $verifikasi = VerifikasiMember::find($id);

        if ($request->aksi == 'ditolak') {
            try {
                $verifikasi->user()->update(['status' => 'ditolak']);
                Storage::disk('public')->delete("img/identitas/{$verifikasi->foto_identitas}");
                VerifikasiMember::destroy($verifikasi->id);
                return redirect()->route('admin.verifikasimember.index')->with('success', "Verifikasi User atas nama '{$verifikasi->user->nama}' berhasil ditolak");
            } catch (Throwable $e) {
                return redirect()->route('admin.verifikasimember.index')->with('fail', 'Terjadi kesalahan sistem');
            }
        } else if ($request->aksi == 'diterima') {
            try{
                $verifikasi->user()->update(['status' => 'diterima']);
                $user = User::find($verifikasi->user_id)->userDetail()->create($verifikasi->toArray());
                VerifikasiMember::destroy($verifikasi->id);
                return redirect()->route('admin.verifikasimember.index')->with('success', "Verifikasi User atas nama '{$verifikasi->user->nama}' berhasil diterima");
            }
            catch (Throwable $e)
            {
                return redirect()->route('admin.verifikasimember.index')->with('fail', 'Terjadi kesalahan sistem');
            }
        }
    }
}
