<x-layout title="Baca Renungan" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        @php
            // =================================================================
            // CATATAN UNTUK BACKEND DEVELOPER:
            // 
            // Variabel $article di bawah ini adalah dummy data. 
            // Di level controller, gunakan Route Model Binding atau 
            // $article = Article::where('slug', $slug)->firstOrFail();
            // =================================================================
            
            $article = (object)[
                'title' => 'Kasih Karunia yang Menyelamatkan',
                'category' => 'Renungan Pagi',
                'author' => 'Pdt. Dr. Yerusa Maria Agustini',
                'date' => '12 Mei 2024',
                'image' => 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=1200&auto=format&fit=crop',
                'content' => '
                    <p>Seringkali kita merasa sendirian saat menghadapi cobaan berat. Namun, firman Tuhan menjanjikan damai sejahtera yang melampaui segala akal. Dalam perjalanan kehidupan ini, badai tidak pernah permisi. Ia datang tiba-tiba, merusak ketenangan, dan menguji fondasi keimanan kita.</p>
                    
                    <h3>Mengapa Badai Diizinkan Terjadi?</h3>
                    <p>Pertanyaan ini sering muncul ketika kita sedang berada di titik terendah. Jawabannya mungkin tidak selalu instan, namun satu hal yang pasti: Tuhan selalu memiliki rencana yang indah di balik setiap peristiwa.</p>
                    <ul>
                        <li>Menguatkan karakter dan ketahanan iman kita.</li>
                        <li>Mengingatkan kita bahwa kendali penuh ada di tangan Tuhan.</li>
                        <li>Mengajarkan kita untuk lebih bergantung pada anugerah-Nya.</li>
                    </ul>

                    <blockquote>
                        "Damai sejahtera Kutinggalkan bagimu. Damai sejahtera-Ku Kuberikan kepadamu, dan apa yang Kuberikan tidak seperti yang diberikan oleh dunia kepadamu. Janganlah gelisah dan gentar hatimu." - Yohanes 14:27
                    </blockquote>

                    <p>Ayat di atas adalah pegangan utama kita. Tuhan Yesus tidak menjanjikan pelayaran yang tanpa ombak, tetapi Ia menjanjikan pendaratan yang aman. Tugas kita adalah tetap memegang kemudi iman dan terus memandang kepada-Nya, sang Nahkoda Agung.</p>
                    
                    <p>Mari kita renungkan bersama, sudahkah kita menyerahkan seluruh kekhawatiran kita ke dalam tangan Tuhan? Ataukah kita masih mencoba menyelesaikan badai tersebut dengan kekuatan kita sendiri?</p>
                ',
                'tags' => ['Iman', 'Keluarga', 'Pengharapan']
            ];
        @endphp

        <x-article-detail 
            :article="$article"
            backRoute="{{ route('renungan.index') }}"
            backText="Kembali ke Daftar Renungan"
            breadcrumbParent="Renungan"
        />
        
    </div>
</x-layout>
