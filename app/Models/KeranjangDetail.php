<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangDetail extends Model
{
    protected $table = 'keranjang_details';
    protected $guarded = [];
    protected $appends = ['checkoutable'];

    public $timestamps = false;

    public function getCheckoutableAttribute()
    {
        return $this->attributes['jumlah'] <= $this->barang->stok;
    }

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

}
