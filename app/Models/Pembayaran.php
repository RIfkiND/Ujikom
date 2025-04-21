<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    //
    protected $guarded = [];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'no_kontrol', 'no_kontrol');
    }
    public function pemakaian()
    {
        return $this->belongsTo(Pemakaian::class,'pemakaian_id', 'id');
    }
}
