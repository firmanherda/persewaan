<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiMember extends Model
{
    protected $fillable = ['user_id', 'namalengkap', 'nomoridentitas', 'alamatidentitas', 'fotoidentitas', 'tanggal_lahir'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
