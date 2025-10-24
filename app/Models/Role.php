<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'idrole';
    protected $fillable = ['nama_role'];

    public function users()
    {
        return $this->belongsToMany(user::class, 'role_user', 'idrole', 'iduser')->withPivot('status');
    }
}
