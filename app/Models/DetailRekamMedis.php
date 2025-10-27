<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DetailRekamMedis extends Pivot
{
    protected $table = 'detail_rekam_medis';
    protected $primaryKey = 'iddetail_rekam_medis';
    protected $fillable = [
        'idrekam_medis',
        'idkode_tindakan_terapi',
        'detail'
    ];
}
