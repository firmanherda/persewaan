<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjangs';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keranjangDetails()
    {
        return $this->hasMany(KeranjangDetail::class);
    }
}
