<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $fillable = ['nama', 'barang_id', 'jumlah'];
    protected $appends = ['checkoutable'];

    public function getCheckoutableAttribute()
    {
        return $this->attributes['jumlah'] <= $this->barang->stok;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
