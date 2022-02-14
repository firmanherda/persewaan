<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['nama', 'kategori_id', 'deskripsi', 'stok', 'harga', 'link_foto'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
