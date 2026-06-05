<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendeta;
use App\Models\Penatua;

class PendetaPenatuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Pendeta
        Pendeta::updateOrCreate(
            ['email' => 'yerumartin@yahoo.com'],
            [
                'nama' => 'Pdt. Dr. Yerusa Maria Agustini, S.Si., M.Pd.',
                'jabatan' => 'Pendeta Jemaat GKI Komplek Pakuwon',
                'foto' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBLIGeVdaFtvFOU0dkO2F5DeNZsS1JOIzfYQ0iNwlxUNjj8uRDF4puelkrOEHpiYwrEU1l6wAtlnrHY1Z2QfakK1igLmANANPt3xGMHEJbrNEEX-zsmT0VVsEDnLFwbJAaMXc3kC3Qe5VP7XD0K-PECiEO2I8Fr2EmjPUZDIFWrdq-ys6YCXoe5cYxcBBgebEfCngRQMv8d1H3suBktE-iejugr6j_2mNfWOj3tvtRDXlNMXcmxiLctwA1Ev24ovcTJy-7Whgw83fY',
                'pasangan' => 'Suami: Ayub Wahyono',
                'visi_pelayanan' => 'Menghadirkan damai sejahtera Kristus melalui pendidikan dan pendampingan jemaat yang holistik, membangun generasi masa depan yang berlandaskan kasih.',
                'jadwal_konseling' => 'Selasa & Kamis, 10:00 - 14:00',
                'riwayat_pelayanan' => [
                    [
                        'tanggal' => '23 Januari 2011',
                        'judul' => 'Diteguhkan sebagai Penatua Khusus',
                        'deskripsi' => 'Langkah awal dalam pengabdian struktural jemaat.'
                    ],
                    [
                        'tanggal' => '23 Januari 2013',
                        'judul' => 'Ditahbiskan ke dalam jabatan Pendeta',
                        'deskripsi' => 'Memasuki masa kependetaan penuh melalui penahbisan resmi.'
                    ],
                    [
                        'tanggal' => '1 Oktober 2018',
                        'judul' => 'Diteguhkan sebagai pendeta',
                        'deskripsi' => 'Pengukuhan komitmen pelayanan berkelanjutan dalam gereja.'
                    ]
                ],
                'pendidikan' => [
                    [
                        'tahun' => '1997 - 2003',
                        'gelar' => 'S1 Teologi',
                        'institusi' => 'Universitas Kristen Dutawacana Yogyakarta'
                    ],
                    [
                        'tahun' => '2010 - 2012',
                        'gelar' => 'S2 Manajemen / Administrasi Pendidikan',
                        'institusi' => 'Universitas Kristen Indonesia'
                    ],
                    [
                        'tahun' => '2016 - 2020',
                        'gelar' => 'S3 Teknologi Pendidikan Konsentrasi PAUD',
                        'institusi' => 'Universitas Negeri Jakarta'
                    ]
                ],
                'status' => 'Aktif Melayani'
            ]
        );

        // 2. Seed Penatua
        // Pengurus Harian
        $pengurusHarian = [
            ['nama' => 'Pnt. Alex R. Jacobus', 'jabatan' => 'Ketua Umum', 'urutan' => 1],
            ['nama' => 'Pnt. Dodi Wijaja', 'jabatan' => 'Wakil Ketua', 'urutan' => 2],
            ['nama' => 'Pnt. Marijani', 'jabatan' => 'Sekretaris 1', 'urutan' => 3],
            ['nama' => 'Pnt. Megayenli', 'jabatan' => 'Sekretaris 2', 'urutan' => 4],
            ['nama' => 'Pnt. Endah Trinawati', 'jabatan' => 'Bendahara 1', 'urutan' => 5],
            ['nama' => 'Pnt. Hendra Sakaroben', 'jabatan' => 'Bendahara 2', 'urutan' => 6],
        ];

        foreach ($pengurusHarian as $ph) {
            Penatua::updateOrCreate(
                ['nama' => $ph['nama'], 'jabatan' => $ph['jabatan']],
                [
                    'kategori' => 'Pengurus Harian',
                    'urutan' => $ph['urutan']
                ]
            );
        }

        // Bidang Kerja
        $bidangKerja = [
            // Bid. Sarpen
            ['nama' => 'Pnt. Budi Santoso', 'jabatan' => 'Anggota Bidang', 'sub_kategori' => 'Bid. Sarpen', 'urutan' => 7],
            ['nama' => 'Pnt. Andreas T.', 'jabatan' => 'Anggota Bidang', 'sub_kategori' => 'Bid. Sarpen', 'urutan' => 8],
            ['nama' => 'Pnt. Susi Susanti', 'jabatan' => 'Anggota Bidang', 'sub_kategori' => 'Bid. Sarpen', 'urutan' => 9],
            // Bid. Pembinaan
            ['nama' => 'Pnt. Heru Wijaya', 'jabatan' => 'Anggota Bidang', 'sub_kategori' => 'Bid. Pembinaan', 'urutan' => 10],
            ['nama' => 'Pnt. Maria Ulfa', 'jabatan' => 'Anggota Bidang', 'sub_kategori' => 'Bid. Pembinaan', 'urutan' => 11],
            ['nama' => 'Pnt. Lukas G.', 'jabatan' => 'Anggota Bidang', 'sub_kategori' => 'Bid. Pembinaan', 'urutan' => 12],
            // Bid. Kespel
            ['nama' => 'Pnt. David K.', 'jabatan' => 'Anggota Bidang', 'sub_kategori' => 'Bid. Kespel', 'urutan' => 13],
            ['nama' => 'Pnt. Sarah Jane', 'jabatan' => 'Anggota Bidang', 'sub_kategori' => 'Bid. Kespel', 'urutan' => 14],
            ['nama' => 'Pnt. Taufik H.', 'jabatan' => 'Anggota Bidang', 'sub_kategori' => 'Bid. Kespel', 'urutan' => 15],
            // Bid. Persekutuan
            ['nama' => 'Pnt. Samuel L.', 'jabatan' => 'Anggota Bidang', 'sub_kategori' => 'Bid. Persekutuan', 'urutan' => 16],
            ['nama' => 'Pnt. Grace M.', 'jabatan' => 'Anggota Bidang', 'sub_kategori' => 'Bid. Persekutuan', 'urutan' => 17],
            ['nama' => 'Pnt. Petrus C.', 'jabatan' => 'Anggota Bidang', 'sub_kategori' => 'Bid. Persekutuan', 'urutan' => 18],
        ];

        foreach ($bidangKerja as $bk) {
            Penatua::updateOrCreate(
                ['nama' => $bk['nama'], 'sub_kategori' => $bk['sub_kategori']],
                [
                    'jabatan' => $bk['jabatan'],
                    'kategori' => 'Bidang Kerja',
                    'urutan' => $bk['urutan']
                ]
            );
        }

        // Pendamping Komisi
        $pendampingKomisi = [
            ['nama' => 'Pnt. Stefanus Kurnia', 'sub_kategori' => 'Komisi Anak', 'urutan' => 19],
            ['nama' => 'Pnt. Jessica Tan', 'sub_kategori' => 'Komisi Remaja', 'urutan' => 20],
            ['nama' => 'Pnt. Jonathan S.', 'sub_kategori' => 'Komisi Pemuda', 'urutan' => 21],
            ['nama' => 'Pnt. Robertus P.', 'sub_kategori' => 'Komisi Dewasa', 'urutan' => 22],
            ['nama' => 'Pnt. Elisabeth W.', 'sub_kategori' => 'Komisi Usia Indah', 'urutan' => 23],
        ];

        foreach ($pendampingKomisi as $pk) {
            Penatua::updateOrCreate(
                ['nama' => $pk['nama'], 'sub_kategori' => $pk['sub_kategori']],
                [
                    'jabatan' => 'Pendamping Komisi',
                    'kategori' => 'Pendamping Komisi',
                    'urutan' => $pk['urutan']
                ]
            );
        }
    }
}
