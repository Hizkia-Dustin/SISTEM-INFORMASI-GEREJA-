<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'aktif' => 0,
            'nonaktif' => 0,
        ];

        $sektorLabels = [];
        $sektorData = [];

        $jemaatTerbaru = [];

        $kategorialLabels = [];
        $kategorialData = [];

        $recentActivities = [];

        return view('dashboard.home.index', compact('stats', 'sektorLabels', 'sektorData', 'kategorialLabels', 'kategorialData', 'recentActivities', 'jemaatTerbaru'));
    }

    // 2. Keluarga
    public function keluarga() 
    { 
        $keluarga = [];
        return view('dashboard.keluarga.index', compact('keluarga')); 
    }
    public function createKeluarga() { return view('dashboard.keluarga.form', ['type' => 'Tambah']); }
    public function showKeluarga($id) { return view('dashboard.keluarga.detail'); }
    public function editKeluarga($id) { return view('dashboard.keluarga.form', ['type' => 'Edit', 'id' => $id]); }
    public function destroyKeluarga($id) { return redirect()->back()->with('success', 'Data keluarga berhasil dihapus.'); }

    // 3. Jemaat
    public function jemaat() 
    { 
        $jemaat = [];
        return view('dashboard.jemaat.index', compact('jemaat')); 
    }
    public function createJemaat() { return view('dashboard.jemaat.form', ['type' => 'Tambah']); }
    public function showJemaat($id) { return view('dashboard.jemaat.detail'); }
    public function editJemaat($id) { return view('dashboard.jemaat.form', ['type' => 'Edit', 'id' => $id]); }
    public function destroyJemaat($id) { return redirect()->back()->with('success', 'Data jemaat berhasil dihapus.'); }

    // 4. Sektor
    public function sektor() { return view('dashboard.sektor.index'); }
    public function createSektor() { return view('dashboard.sektor.form', ['type' => 'Tambah']); }
    public function editSektor($id) { return view('dashboard.sektor.form', ['type' => 'Edit']); }
    public function destroySektor($id) { return redirect()->back()->with('success', 'Sektor berhasil dihapus.'); }

    // 5. Keuangan
    public function keuangan() { return view('dashboard.keuangan.index'); }
    public function createKeuangan() { return view('dashboard.keuangan.form', ['type' => 'Tambah']); }
    public function editKeuangan($id) { return view('dashboard.keuangan.edit'); }
    public function laporanKeuangan() { return view('dashboard.keuangan.laporan'); }
    public function destroyKeuangan($id) { return redirect()->back()->with('success', 'Data keuangan berhasil dihapus.'); }

    // 6. Pelayan
    public function pelayan() { return view('dashboard.pelayan.index'); }
    public function createPelayan() { return view('dashboard.pelayan.form', ['type' => 'Tambah']); }
    public function editPelayan($id) { return view('dashboard.pelayan.form', ['type' => 'Edit']); }
    public function destroyPelayan($id) { return redirect()->back()->with('success', 'Data pelayan berhasil dihapus.'); }

    // 7. Renungan
    public function renungan() { return view('dashboard.renungan.index'); }
    public function createRenungan() { return view('dashboard.renungan.form', ['type' => 'Tambah']); }
    public function editRenungan($id) { return view('dashboard.renungan.form', ['type' => 'Edit']); }
    public function destroyRenungan($id) { return redirect()->back()->with('success', 'Renungan berhasil dihapus.'); }

    // 8. Jadwal Ibadah
    public function jadwal() 
    { 
        $jadwal = [];
        return view('dashboard.jadwal.index', compact('jadwal')); 
    }
    public function createJadwal() { return view('dashboard.jadwal.form', ['type' => 'Tambah']); }
    public function editJadwal($id) { return view('dashboard.jadwal.form', ['type' => 'Edit']); }
    public function destroyJadwal($id) { return redirect()->back()->with('success', 'Jadwal ibadah berhasil dihapus.'); }

    // 9. Jadwal Pelayanan (Tugas)
    public function tugas() { return view('dashboard.tugas.index'); }
    public function createTugas() { return view('dashboard.tugas.form', ['type' => 'Tambah']); }
    public function editTugas($id) { return view('dashboard.tugas.form', ['type' => 'Edit']); }
    public function destroyTugas($id) { return redirect()->back()->with('success', 'Jadwal pelayanan berhasil dihapus.'); }

    // 10. Program Kerja
    public function programKerja() { return view('dashboard.program_kerja.index'); }
    public function createProgramKerja() { return view('dashboard.program_kerja.form', ['type' => 'Tambah']); }
    public function editProgramKerja($id) { return view('dashboard.program_kerja.form', ['type' => 'Edit']); }
    public function destroyProgramKerja($id) { return redirect()->back()->with('success', 'Program kerja berhasil dihapus.'); }

    // 11. Berita
    public function berita() 
    { 
        $berita = [];
        return view('dashboard.berita.index', compact('berita')); 
    }
    public function createBerita() { return view('dashboard.berita.form', ['type' => 'Tambah']); }
    public function showBerita($id) { return view('dashboard.berita.detail'); }
    public function editBerita($id) { return view('dashboard.berita.form', ['type' => 'Edit', 'id' => $id]); }
    public function destroyBerita($id) { return redirect()->back()->with('success', 'Berita berhasil dihapus.'); }

    // Extra
    public function profil() { return view('dashboard.profile.index'); }
    public function settings() { return view('dashboard.settings.index'); }
    public function createAdmin() { return view('dashboard.settings.admin_form', ['type' => 'Tambah']); }
    public function editAdmin($id) { return view('dashboard.settings.admin_form', ['type' => 'Edit', 'id' => $id]); }
    public function destroyAdmin($id) { return redirect()->back()->with('success', 'Akun administrator berhasil dihapus.'); }
    public function komisi() 
    { 
        $komisi = [];
        return view('dashboard.komisi.index', compact('komisi')); 
    }
    public function createKomisi() { return view('dashboard.komisi.form', ['type' => 'Tambah']); }
    public function editKomisi($id) { return view('dashboard.komisi.form', ['type' => 'Edit']); }
    public function destroyKomisi($id) { return redirect()->back()->with('success', 'Komisi berhasil dihapus.'); }
}
