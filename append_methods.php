<?php
$file = 'app/Http/Controllers/DashboardController.php';
$content = file_get_contents($file);

$methods = "

    // Racakitri
    public function racakitri() { 
        \$data = \App\Models\Racakitri::latest()->get();
        return view('dashboard.racakitri.index', ['artikel' => \$data]); 
    }
    public function createRacakitri() { return view('dashboard.racakitri.form', ['type' => 'Tambah', 'artikel' => new \App\Models\Racakitri()]); }
    public function storeRacakitri(\Illuminate\Http\Request \$request) 
    {
        \$data = \$request->except(['_token', '_method']);
        if (\$request->hasFile('gambar')) {
            \$data['gambar'] = \$request->file('gambar')->store('uploads/racakitri', 'public');
        }
        \App\Models\Racakitri::create(\$data);
        return redirect()->route('dashboard.racakitri.index')->with('success', 'Data berhasil ditambahkan.');
    }
    public function showRacakitri(\$id) { 
        \$data = \App\Models\Racakitri::findOrFail(\$id);
        return view('dashboard.racakitri.detail', ['artikel' => \$data]); 
    }
    public function editRacakitri(\$id) { 
        \$data = \App\Models\Racakitri::findOrFail(\$id);
        return view('dashboard.racakitri.form', ['type' => 'Edit', 'artikel' => \$data]); 
    }
    public function updateRacakitri(\Illuminate\Http\Request \$request, \$id) 
    {
        \$model = \App\Models\Racakitri::findOrFail(\$id);
        \$data = \$request->except(['_token', '_method']);
        if (\$request->hasFile('gambar')) {
            \$data['gambar'] = \$request->file('gambar')->store('uploads/racakitri', 'public');
        }
        \$model->update(\$data);
        return redirect()->route('dashboard.racakitri.index')->with('success', 'Data berhasil diperbarui.');
    }
    public function destroyRacakitri(\$id) 
    {
        \App\Models\Racakitri::destroy(\$id);
        return redirect()->route('dashboard.racakitri.index')->with('success', 'Data berhasil dihapus.');
    }

    // Informasi
    public function informasi() { 
        \$data = \App\Models\Informasi::latest()->get();
        return view('dashboard.informasi.index', ['artikel' => \$data]); 
    }
    public function createInformasi() { return view('dashboard.informasi.form', ['type' => 'Tambah', 'artikel' => new \App\Models\Informasi()]); }
    public function storeInformasi(\Illuminate\Http\Request \$request) 
    {
        \$data = \$request->except(['_token', '_method']);
        if (\$request->hasFile('gambar')) {
            \$data['gambar'] = \$request->file('gambar')->store('uploads/informasi', 'public');
        }
        \App\Models\Informasi::create(\$data);
        return redirect()->route('dashboard.informasi.index')->with('success', 'Data berhasil ditambahkan.');
    }
    public function showInformasi(\$id) { 
        \$data = \App\Models\Informasi::findOrFail(\$id);
        return view('dashboard.informasi.detail', ['artikel' => \$data]); 
    }
    public function editInformasi(\$id) { 
        \$data = \App\Models\Informasi::findOrFail(\$id);
        return view('dashboard.informasi.form', ['type' => 'Edit', 'artikel' => \$data]); 
    }
    public function updateInformasi(\Illuminate\Http\Request \$request, \$id) 
    {
        \$model = \App\Models\Informasi::findOrFail(\$id);
        \$data = \$request->except(['_token', '_method']);
        if (\$request->hasFile('gambar')) {
            \$data['gambar'] = \$request->file('gambar')->store('uploads/informasi', 'public');
        }
        \$model->update(\$data);
        return redirect()->route('dashboard.informasi.index')->with('success', 'Data berhasil diperbarui.');
    }
    public function destroyInformasi(\$id) 
    {
        \App\Models\Informasi::destroy(\$id);
        return redirect()->route('dashboard.informasi.index')->with('success', 'Data berhasil dihapus.');
    }

    // Video
    public function video() { 
        \$data = \App\Models\Video::latest()->get();
        return view('dashboard.video.index', ['artikel' => \$data]); 
    }
    public function createVideo() { return view('dashboard.video.form', ['type' => 'Tambah', 'artikel' => new \App\Models\Video()]); }
    public function storeVideo(\Illuminate\Http\Request \$request) 
    {
        \$data = \$request->except(['_token', '_method']);
        if (\$request->hasFile('gambar')) {
            \$data['gambar'] = \$request->file('gambar')->store('uploads/video', 'public');
        }
        \App\Models\Video::create(\$data);
        return redirect()->route('dashboard.video.index')->with('success', 'Data berhasil ditambahkan.');
    }
    public function showVideo(\$id) { 
        \$data = \App\Models\Video::findOrFail(\$id);
        return view('dashboard.video.detail', ['artikel' => \$data]); 
    }
    public function editVideo(\$id) { 
        \$data = \App\Models\Video::findOrFail(\$id);
        return view('dashboard.video.form', ['type' => 'Edit', 'artikel' => \$data]); 
    }
    public function updateVideo(\Illuminate\Http\Request \$request, \$id) 
    {
        \$model = \App\Models\Video::findOrFail(\$id);
        \$data = \$request->except(['_token', '_method']);
        if (\$request->hasFile('gambar')) {
            \$data['gambar'] = \$request->file('gambar')->store('uploads/video', 'public');
        }
        \$model->update(\$data);
        return redirect()->route('dashboard.video.index')->with('success', 'Data berhasil diperbarui.');
    }
    public function destroyVideo(\$id) 
    {
        \App\Models\Video::destroy(\$id);
        return redirect()->route('dashboard.video.index')->with('success', 'Data berhasil dihapus.');
    }
";

// Insert before the last '}'
\$pos = strrpos(\$content, '}');
if (\$pos !== false) {
    \$content = substr_replace(\$content, \$methods . \"\n\", \$pos, 0);
    file_put_contents(\$file, \$content);
    echo \"Methods injected successfully.\\n\";
} else {
    echo \"Failed to find the closing brace.\\n\";
}
