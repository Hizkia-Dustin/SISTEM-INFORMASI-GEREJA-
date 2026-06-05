<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DashboardRouteSmokeTest extends TestCase
{
    public function test_dashboard_pages_render_without_server_error(): void
    {
        $user = $this->testUser();

        $paths = [
            '/dashboard',
            '/dashboard/keluarga',
            '/dashboard/keluarga/create',
            '/dashboard/jemaat',
            '/dashboard/jemaat/create',
            '/dashboard/sektor',
            '/dashboard/sektor/create',
            '/dashboard/keuangan',
            '/dashboard/keuangan/create',
            '/dashboard/keuangan/laporan',
            '/dashboard/pelayan',
            '/dashboard/pelayan/create',
            '/dashboard/renungan',
            '/dashboard/renungan/create',
            '/dashboard/jadwal',
            '/dashboard/jadwal/create',
            '/dashboard/tugas',
            '/dashboard/tugas/create',
            '/dashboard/program-kerja',
            '/dashboard/program-kerja/create',
            '/dashboard/berita',
            '/dashboard/berita/create',
            '/dashboard/warta',
            '/dashboard/warta/create',
            '/dashboard/artikel',
            '/dashboard/artikel/create',
            '/dashboard/racakitri',
            '/dashboard/racakitri/create',
            '/dashboard/informasi',
            '/dashboard/informasi/create',
            '/dashboard/video',
            '/dashboard/video/create',
            '/dashboard/komisi',
            '/dashboard/komisi/create',
            '/dashboard/profil',
            '/dashboard/profil/edit',
            '/dashboard/settings',
            '/dashboard/settings/admin/create',
        ];

        foreach ($paths as $path) {
            $response = $this->actingAs($user)->get($path);

            $this->assertLessThan(500, $response->getStatusCode(), $path . ' returned ' . $response->getStatusCode());
        }
    }

    public function test_dashboard_content_detail_and_edit_pages_render_without_server_error(): void
    {
        $user = $this->testUser();

        $items = [
            'berita' => \App\Models\Berita::create(['judul' => 'Berita Test', 'konten' => 'Konten test', 'isi' => 'Isi test', 'kategori' => 'Berita']),
            'warta' => \App\Models\Warta::create(['judul' => 'Warta Test', 'isi' => 'Isi test', 'kategori' => 'Warta Jemaat']),
            'artikel' => \App\Models\Artikel::create(['judul' => 'Artikel Test', 'isi' => 'Isi test', 'kategori' => 'Artikel']),
            'racakitri' => \App\Models\Racakitri::create(['judul' => 'Racakitri Test', 'isi' => 'Isi test', 'kategori' => 'Racakitri']),
            'informasi' => \App\Models\Informasi::create(['judul' => 'Informasi Test', 'isi' => 'Isi test', 'kategori' => 'Informasi']),
            'video' => \App\Models\Video::create(['judul' => 'Video Test', 'isi' => 'Isi test', 'kategori' => 'Video']),
        ];

        foreach ($items as $section => $item) {
            foreach (["/dashboard/{$section}/{$item->id}", "/dashboard/{$section}/{$item->id}/edit"] as $path) {
                $response = $this->actingAs($user)->get($path);

                $this->assertLessThan(500, $response->getStatusCode(), $path . ' returned ' . $response->getStatusCode());
            }
        }
    }

    public function test_pelayanan_registration_can_be_submitted_and_approved(): void
    {
        $admin = $this->testUser();

        $this->get('/pelayanan/daftar?komisi=Komisi%20Pemuda')
            ->assertStatus(200);

        $this->post('/pelayanan/daftar', [
            'nama' => 'Calon Pelayan',
            'email' => 'calon.pelayan@example.test',
            'no_telepon' => '081234567890',
            'komisi_tujuan' => 'Komisi Pemuda',
            'posisi' => 'Tim Musik',
            'alasan' => 'Bersedia melayani di musik.',
        ])->assertRedirect('/pelayanan/daftar');

        $pelayan = \App\Models\Pelayan::where('email', 'calon.pelayan@example.test')->firstOrFail();
        $this->assertSame('pending', $pelayan->status);

        $this->actingAs($admin)
            ->put("/dashboard/pelayan/{$pelayan->id}/approve")
            ->assertRedirect('/dashboard/pelayan');

        $this->assertSame('aktif', $pelayan->fresh()->status);
    }

    private function testUser(): User
    {
        return User::firstOrCreate(
            ['email' => 'route-smoke-test@example.test'],
            [
                'name' => 'Route Smoke Test',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );
    }
}
