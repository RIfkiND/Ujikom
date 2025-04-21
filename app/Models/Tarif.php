<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pelanggan(){
        return $this->hasMany(Pelanggan::class);
    }
}
