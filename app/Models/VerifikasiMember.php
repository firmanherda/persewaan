<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiMember extends Model
{
    protected $fillable = ['nama_lengkap', 'nomor_identitas', 'alamat_identitas', 'foto_identitas', 'tanggal_lahir'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
