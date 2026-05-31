<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $table = 'keluarga';

    protected $fillable = [
        'no_kk',
        'nama_kepala_keluarga',
        'alamat_keluarga',
        'wilayah_pelayanan',
        'tanggal_registrasi',
        'status'
    ];

    public function jemaat()
    {
        return $this->hasMany(Jemaat::class, 'keluarga_id', 'id');
    }
}
