<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    //

    protected $fillable = [
        'name'
    ];
   
    public function tarif()
    {
        return $this->hasMany(Tarif::class, 'jenis_plg');
    }
}
