<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = "barangs";
    protected $guarded = [];
   // protected $fillable = ['nama','kategori_id','deskripsi', 'stok', 'harga', 'link_foto'];
    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori','kategori_id');
    }
}
