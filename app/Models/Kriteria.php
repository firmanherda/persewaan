<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    // protected $fillable = ['nama', 'kode', 'bobot', 'jenis'];


    protected $table = 'kriterias';

    protected $guarded = [];

    public $timestamps = false;

    public function subKriterias()
    {
        return $this->hasMany(SubKriteria::class);
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
