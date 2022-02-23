<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'barang_id',
        'jumlah',
        'subtotal'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
