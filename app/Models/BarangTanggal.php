<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangTanggal extends Model
{
    protected $guarded = ['id', 'barang_id', 'transaksi_id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
