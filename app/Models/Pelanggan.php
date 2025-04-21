<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    //
    protected $primaryKey = 'no_kontrol';
    protected $table = 'pelanggans';
    protected $guarded = [];
    protected $keyType = 'string';

    public function pemakaian()
    {
        return $this->hasMany(Pemakaian::class, 'no_kontrol', 'no_kontrol');
    }
    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'jenis_plg');
    }

}
