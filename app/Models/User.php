<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'iduser';
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole')->using(RoleUser::class)->withPivot('status');
    }


}
