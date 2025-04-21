<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    //

    protected $guarded = [];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class ,'no_kontrol', 'no_kontrol');  
    }

}
