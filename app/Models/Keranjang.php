<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    // protected $table = "keranjangs";
    // protected $guarded = [];
    protected $fillable = ['nama','barang_id','jumlah'];
    public function barang()
    {
        return $this->belongsTo('App\Models\Barang','barang_id');
    }
}
