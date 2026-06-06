<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JemaatPelayananHistory extends Model
{
    protected $table = 'jemaat_pelayanan_histories';

    protected $fillable = [
        'jemaat_id',
        'bidang_pelayanan',
        'peran',
        'periode_mulai',
        'periode_selesai',
        'status',
        'keterangan',
    ];

    public function jemaat()
    {
        return $this->belongsTo(Jemaat::class, 'jemaat_id');
    }
}
