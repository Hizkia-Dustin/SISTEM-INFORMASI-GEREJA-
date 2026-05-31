<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'no_induk',
        'username',
        'jenis_kelamin',
        'alamat',
        'status_anggota',
        'status_pernikahan',
        'tanggal_baptis',
        'tanggal_sidi',
        'foto_profil',
        'role',
        'sektor',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}