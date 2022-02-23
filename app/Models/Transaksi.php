<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_harga',
        'tanggal_sewa',
        'tanggal_batas_kembali',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
