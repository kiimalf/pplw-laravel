<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    protected $fillable = ['anamnesa', 'temuan_klinis', 'diagnosa', 'idpet', 'dokter_pemeriksa', 'idreservasi_dokter'];

    public function pet() 
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }
    public function roleUser() 
    {
        return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa', 'idrole_user');
    }
    
    public function detailRekamMedis()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

    public function temuDokter()
    {
        return $this->belongsTo(TemuDokter::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }
    
}
