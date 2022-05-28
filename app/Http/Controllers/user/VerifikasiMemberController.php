<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerifikasiMember;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VerifikasiMemberController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.profil.verifikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find(Auth::id());

        $verifikasi = $user->verifikasiMember()->create([
            'nama_lengkap' => $request->nama,
            'nomor_identitas' => $request->nomer,
            'alamat_identitas' => $request->alamat,
            'tanggal_lahir' => $request->tanggal,
        ]);

        try {
            Storage::putFileAs('public/img/identitas', $request->file('foto'), "{$verifikasi->id}.jpg");
            $verifikasi->update(['foto_identitas' => "{$verifikasi->id}.jpg"]);

            $user->update(['status' => 'menunggu']);

            return redirect()->route('user.profil.index')->with('ok', 'Verifikasi member anda telah tersimpan');
        } catch (Exception $e) {
            return redirect()->route('user.profil.index')->with('fail', 'Terjadi kesalahan sistem');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $verifikasi = VerifikasiMember::firstWhere('user_id', Auth::id());

        return view('user.profil.verifikasi.edit', ['verifikasi' => $verifikasi]);
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
        $user = Auth::user();

        $verifikasi = $user->verifikasiMember()->update([
            'namalengkap' => $request->nama,
            'nomoridentitas' => $request->nomer,
            'alamatidentitas' => $request->alamat,
            'tanggal_lahir' => $request->tanggal,
            'fotoidentitas' => "$id.jpg"
        ]);

        try {
            Storage::putFileAs('public/img', $request->file('foto'), "{$verifikasi->id}.jpg");

            return redirect()->route('user.profil.index')->with('ok', 'Verifikasi member anda telah tersimpan');
        } catch (Exception $e) {
            return redirect()->route('user.profil.index')->with('fail', 'Terjadi kesalahan sistem');
        }
    }
}
