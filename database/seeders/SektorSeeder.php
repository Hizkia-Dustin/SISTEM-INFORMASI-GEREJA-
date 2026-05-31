<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SektorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sektors = [
            ['nama' => 'Sektor 1', 'deskripsi' => 'Wilayah Sektor 1', 'status' => 'aktif'],
            ['nama' => 'Sektor 2', 'deskripsi' => 'Wilayah Sektor 2', 'status' => 'aktif'],
            ['nama' => 'Sektor 3', 'deskripsi' => 'Wilayah Sektor 3', 'status' => 'aktif'],
        ];

        foreach ($sektors as $sektor) {
            \App\Models\Sektor::create($sektor);
        }
    }
}
