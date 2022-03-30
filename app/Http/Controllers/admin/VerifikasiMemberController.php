<?php

namespace App\Http\Controllers\Admin;

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
        $members = User::where([
            ['role', 'user'],
            ['status', 'menunggu']
        ])->get();
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
        $verifikasi = VerifikasiMember::firstWhere('user_id',$id);

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
        $verifikasi = VerifikasiMember::firstWhere('user_id',$id);

        if ($request->aksi == 'ditolak') {
            if (!$verifikasi->user()->update(['status' => 'ditolak'])) {
                return redirect()->route('admin.verifikasimember.index')->with('fail', 'Terjadi kesalahan sistem');
            }

            if (!VerifikasiMember::destroy($verifikasi->id)) {
                return redirect()->route('admin.verifikasimember.index')->with('fail', 'Terjadi kesalahan sistem');
            }

            return redirect()->route('admin.verifikasimember.index')->with('ok', "User {$verifikasi->user->nama} berhasil ditolak");
        } else if ($request->aksi == 'diterima') {
            if (!$verifikasi->user()->update(['status' => 'diterima'])) {
                //harusnya verifikasi berhasil
                return redirect()->route('admin.verifikasimember.index')->with('fail', 'Terjadi kesalahan sistem');
            }

            if (!VerifikasiMember::destroy($verifikasi->id)) {
                return redirect()->route('admin.verifikasimember.index')->with('fail', 'Terjadi kesalahan sistem');
            }

            return redirect()->route('admin.verifikasimember.index')->with('ok', "User {$verifikasi->user->nama} berhasil diterima");
        } else {
            return redirect()->route('admin.verifikasimember.index');
        }
    }
}
