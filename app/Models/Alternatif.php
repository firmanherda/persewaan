<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    // protected $fillable = ['nama', 'kode', 'bobot', 'jenis'];
    use HasFactory;

    protected $table = 'alternatifs';

    protected $guarded = [];

    public $timestamps = false;

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
