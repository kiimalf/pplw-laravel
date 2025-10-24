<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    protected $fillable = ['nama', 'tanggal_lahir', 'warna_tanda', 'jenis_kelamin'];

    public function pemilik() 
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }
    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }
    // alias for snake_case relation name used in views
    public function ras_hewan()
    {
        return $this->rasHewan();
    }
}
