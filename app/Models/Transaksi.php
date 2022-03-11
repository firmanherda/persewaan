<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    protected $guarded = [];
    // protected $fillable = [
    //     'user_id',
    //     'jumlah',
    //     'status',
    //     'total_harga',
    //     'tanggal_sewa',
    //     'tanggal_batas_kembali',

    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
