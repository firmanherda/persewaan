<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama'];

    public function barangs()
    {
        return $this->hasMany('App\Models\Barang','kategori_id','id');
    }
}
