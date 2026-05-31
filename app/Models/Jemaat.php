<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    protected $table = 'jemaat';

    protected $fillable = [
        'no_induk',
        'nama_lengkap',
        'nama',
        'username',
        'no_telepon',
        'jenis_kelamin',
        'posisi',
        'tempat_lahir',
        'tanggal_lahir',
        'status_nikah',
        'status_keanggotaan',
        'status_aktif',
        'baptis',
        'sidi',
        'alamat',
        'foto_profil',
        'lampiran_baptis',
        'lampiran_sidi',
        'keluarga_id',
    ];

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'keluarga_id', 'id');
    }
}
