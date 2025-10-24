<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    protected $fillable = ['anamnesa', 'temuan_klinis', 'diagnosa', 'idpet', 'dokter_pemeriksa'];

    public function pets() 
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }
    public function user() 
    {
        return $this->belongsTo(User::class, 'dokter_pemeriksa', 'iduser');
    }
    public function KodeTindakanTerapi()
    {
        return $this->belongsToMany(KodeTindakanTerapi::class, 'detail_rekam_medis', 'idrekam_medis', 'idkode_tindakan_terapi')->withPivot('detail');
    }
    
}
