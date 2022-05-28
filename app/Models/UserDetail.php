<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{

    protected $table = 'user_details';

    protected $guarded = ['id', 'user_id'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
