<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendeta extends Model
{
    protected $table = 'pendetas';
    protected $guarded = [];

    protected $casts = [
        'riwayat_pelayanan' => 'array',
        'pendidikan' => 'array',
    ];
}
