<!-- Homepage specific marker for transparent navbar logic -->
<div class="hero-monoline hidden"></div>

@php
    // Get Hero Image from active gallery
    $galeri = \App\Models\Galery::where('enabled', 1)->where('slider', 1)->inRandomOrder()->first();
    if ($galeri && $galeri->gambar && is_file(LOKASI_GALERI . 'sedang_' . $galeri->gambar)) {
        $heroImage = base_url(LOKASI_GALERI . 'sedang_' . $galeri->gambar);
    } else {
        // Fallback to random gallery image
        $galeri_any = \App\Models\Galery::where('enabled', 1)->inRandomOrder()->first();
        if ($galeri_any && $galeri_any->gambar && is_file(LOKASI_GALERI . 'sedang_' . $galeri_any->gambar)) {
            $heroImage = base_url(LOKASI_GALERI . 'sedang_' . $galeri_any->gambar);
        } else {
            // Absolute fallback
            $heroImage = asset('assets/images/header.jpg'); 
        }
    }

    // Get statistics data
    $totPenduduk = \App\Models\PendudukHidup::count();
    $lakiLaki = \App\Models\PendudukHidup::where('sex', 1)->count();
    $perempuan = \App\Models\PendudukHidup::where('sex', 2)->count();
    $totKeluarga = \App\Models\Keluarga::count();
@endphp
<<section class="relative w-full h-[85vh] min-h-[600px] flex items-center justify-center pt-20" style="background-image: url('{{ $heroImage }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-slate-950/70 mix-blend-multiply"></div>
    <!-- Glowing background nodes -->
    <div class="absolute w-[30vw] h-[30vw] bg-primary-600/10 blur-[120px] rounded-full top-1/4 left-1/4"></div>
    <div class="absolute w-[30vw] h-[30vw] bg-accent-500/5 blur-[120px] rounded-full bottom-1/4 right-1/4"></div>
    
    <div class="relative z-10 text-center px-6 py-10 md:py-16 max-w-4xl mx-auto bg-slate-950/40 backdrop-blur-md rounded-3xl border border-white/10 shadow-[0_30px_60px_rgba(0,0,0,0.4)] animate-fade-in-up">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/10 backdrop-blur-sm border border-white/20 text-xs font-semibold text-accent-400 rounded-full tracking-widest uppercase mb-4">
            Portal Resmi Pemerintah
        </span>
        <h1 class="text-white text-3xl md:text-5xl lg:text-6xl font-extrabold font-heading mb-6 tracking-tight uppercase leading-tight">
            Desa Kualan Hilir
        </h1>
        <p class="text-white/80 text-base md:text-lg font-medium mb-10 max-w-2xl mx-auto leading-relaxed">
            Terwujudnya masyarakat desa yang mandiri, sejahtera, dan berbudaya melalui tata kelola pemerintahan yang transparan dan berbasis digital.
        </p>
        <a href="#layanan" class="inline-flex items-center gap-2 bg-accent-500 hover:bg-accent-600 text-slate-950 font-bold px-8 py-4 rounded-full transition-all duration-300 transform hover:scale-105 shadow-[0_10px_25px_rgba(255,185,0,0.35)] group">
            PELAJARI LEBIH LANJUT <i class="fas fa-arrow-down text-xs transition-transform group-hover:translate-y-1"></i>
        </a>
    </div>
</section>

<!-- 2. SERVICES SECTION -->
<section id="layanan" class="py-24 bg-slate-50 dark:bg-slate-950 relative -mt-16 z-20 transition-colors duration-300">
    <div class="container mx-auto px-4 lg:px-8 xl:px-12 max-w-[1600px]">
        <div class="bg-white/80 dark:bg-slate-900/60 backdrop-blur-lg rounded-3xl shadow-[0_25px_60px_rgba(0,0,0,0.06)] border border-slate-200/50 dark:border-slate-800/50 p-8 lg:p-12 transition-colors duration-300">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-slate-800 dark:text-white font-heading mb-3 tracking-wide">LAYANAN UNGGULAN</h2>
                <p class="text-slate-500 dark:text-slate-300 max-w-2xl mx-auto text-sm md:text-base">Akses cepat menuju berbagai layanan pemerintahan and informasi publik desa.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 text-left">
                <!-- Layanan Mandiri -->
                @if ((bool) setting('layanan_mandiri'))
                <a href="{{ site_url('layanan-mandiri') }}" class="group flex gap-6 p-6 rounded-2xl bg-white dark:bg-slate-900/40 hover:bg-primary-50/30 dark:hover:bg-primary-950/20 border border-slate-100 dark:border-slate-800 hover:border-primary-100 dark:hover:border-primary-900 shadow-sm transition-all duration-300 hover:shadow-md glow-primary-hover">
                    <div class="w-14 h-14 bg-primary-50 dark:bg-primary-950/40 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-primary-600 transition-colors">
                        <i class="fas fa-desktop text-2xl text-primary-600 dark:text-primary-400 group-hover:text-white transition-colors"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-slate-800 dark:text-white font-heading mb-2">Layanan Mandiri</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-300 leading-relaxed">Urus surat menyurat secara online tanpa harus antre di balai desa.</p>
                    </div>
                </a>
                @endif
                
                <!-- Data Wilayah -->
                <a href="{{ site_url('data-wilayah') }}" class="group flex gap-6 p-6 rounded-2xl bg-white dark:bg-slate-900/40 hover:bg-teal-50/30 dark:hover:bg-teal-950/20 border border-slate-100 dark:border-slate-800 hover:border-teal-100 dark:hover:border-teal-900 shadow-sm transition-all duration-300 hover:shadow-md glow-cyan-hover">
                    <div class="w-14 h-14 bg-teal-50 dark:bg-teal-950/40 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-teal-500 transition-colors">
                        <i class="fas fa-map-marked-alt text-2xl text-teal-600 dark:text-teal-400 group-hover:text-white transition-colors"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-slate-800 dark:text-white font-heading mb-2">Data Wilayah</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-300 leading-relaxed">Statistik dan demografi kependudukan yang selalu diperbarui.</p>
                    </div>
                </a>

                <!-- Transparansi APBDes -->
                <a href="{{ site_url('apbdesa') }}" class="group flex gap-6 p-6 rounded-2xl bg-white dark:bg-slate-900/40 hover:bg-amber-50/30 dark:hover:bg-amber-950/20 border border-slate-100 dark:border-slate-800 hover:border-amber-100 dark:hover:border-amber-900 shadow-sm transition-all duration-300 hover:shadow-md glow-primary-hover">
                    <div class="w-14 h-14 bg-amber-50 dark:bg-amber-950/40 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-amber-500 transition-colors">
                        <i class="fas fa-chart-pie text-2xl text-amber-500 dark:text-amber-400 group-hover:text-white transition-colors"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-slate-800 dark:text-white font-heading mb-2">Transparansi</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-300 leading-relaxed">Laporan APBDes dan rincian pembangunan desa yang terbuka.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 3. COUNTER STRIP SECTION (DARK SLATE WITH TECH GRID) -->
<section class="relative bg-slate-950 py-20 overflow-hidden">
    <!-- Sci-fi glowing grid background -->
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#0284c7_1px,transparent_1px),linear-gradient(to_bottom,#0284c7_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] opacity-[0.08]"></div>
    <!-- Floating glowing nodes -->
    <div class="absolute w-[20vw] h-[20vw] bg-teal-500/5 blur-[80px] rounded-full -top-10 left-10"></div>
    <div class="absolute w-[20vw] h-[20vw] bg-primary-600/5 blur-[80px] rounded-full -bottom-10 right-10"></div>

    <div class="container mx-auto px-4 lg:px-8 xl:px-12 max-w-[1400px] relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center text-white">
            <div class="flex flex-col items-center justify-center p-6 rounded-2xl bg-white/[0.02] border border-white/5 backdrop-blur-sm hover:border-white/10 transition-all duration-300">
                <div class="w-12 h-12 rounded-full bg-primary-500/10 flex items-center justify-center mb-4 text-primary-400">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <h3 class="text-4xl font-extrabold font-heading mb-1.5 tracking-tight text-white">{{ number_format($totPenduduk, 0, ',', '.') }}</h3>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Total Penduduk</p>
            </div>
            <div class="flex flex-col items-center justify-center p-6 rounded-2xl bg-white/[0.02] border border-white/5 backdrop-blur-sm hover:border-white/10 transition-all duration-300">
                <div class="w-12 h-12 rounded-full bg-teal-500/10 flex items-center justify-center mb-4 text-teal-400">
                    <i class="fas fa-male text-xl"></i>
                </div>
                <h3 class="text-4xl font-extrabold font-heading mb-1.5 tracking-tight text-white">{{ number_format($lakiLaki, 0, ',', '.') }}</h3>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Laki-Laki</p>
            </div>
            <div class="flex flex-col items-center justify-center p-6 rounded-2xl bg-white/[0.02] border border-white/5 backdrop-blur-sm hover:border-white/10 transition-all duration-300">
                <div class="w-12 h-12 rounded-full bg-pink-500/10 flex items-center justify-center mb-4 text-pink-400">
                    <i class="fas fa-female text-xl"></i>
                </div>
                <h3 class="text-4xl font-extrabold font-heading mb-1.5 tracking-tight text-white">{{ number_format($perempuan, 0, ',', '.') }}</h3>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Perempuan</p>
            </div>
            <div class="flex flex-col items-center justify-center p-6 rounded-2xl bg-white/[0.02] border border-white/5 backdrop-blur-sm hover:border-white/10 transition-all duration-300">
                <div class="w-12 h-12 rounded-full bg-amber-500/10 flex items-center justify-center mb-4 text-amber-400">
                    <i class="fas fa-home text-xl"></i>
                </div>
                <h3 class="text-4xl font-extrabold font-heading mb-1.5 tracking-tight text-white">{{ number_format($totKeluarga, 0, ',', '.') }}</h3>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Keluarga</p>
            </div>
        </div>
    </div>
</section>

<!-- 4. SPLIT CONTENT SECTION (VISI MISI) -->
<section class="py-24 bg-white dark:bg-slate-900 overflow-hidden transition-colors duration-300">
    <div class="container mx-auto px-4 lg:px-8 xl:px-12 max-w-[1600px]">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="w-full lg:w-1/2">
                <h2 class="text-4xl lg:text-6xl font-bold text-slate-800 dark:text-white font-heading mb-8 leading-tight uppercase tracking-wide">Mewujudkan Desa yang Maju, Sejahtera, dan Inovatif</h2>
                <p class="text-slate-500 dark:text-slate-300 mb-10 leading-relaxed text-xl lg:text-2xl">
                    Kami terus berupaya meningkatkan kualitas pelayanan publik dan mendorong pembangunan yang berkelanjutan demi kesejahteraan seluruh masyarakat desa.
                </p>
                <div class="space-y-8 mb-12">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-primary-50 dark:bg-primary-950/30 flex items-center justify-center flex-shrink-0 text-primary-600 dark:text-primary-400 shadow-sm">
                            <i class="fas fa-check text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold text-slate-800 dark:text-white font-heading mb-2">Pelayanan Cepat</h4>
                            <p class="text-slate-500 dark:text-slate-300 text-lg">Sistem digitalisasi mempermudah urusan administrasi.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-accent-50 dark:bg-accent-950/30 flex items-center justify-center flex-shrink-0 text-accent-600 dark:text-accent-400 shadow-sm">
                            <i class="fas fa-leaf text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold text-slate-800 dark:text-white font-heading mb-2">Pemberdayaan Ekonomi</h4>
                            <p class="text-slate-500 dark:text-slate-300 text-lg">Mendukung UMKM lokal dan pertanian presisi.</p>
                        </div>
                    </div>
                </div>
                <a href="{{ site_url('profil/visi-misi') }}" class="inline-block border-2 border-slate-800 dark:border-slate-200 text-slate-800 dark:text-slate-200 hover:bg-slate-800 dark:hover:bg-slate-200 hover:text-white dark:hover:text-slate-900 font-bold px-10 py-4 text-xl rounded-full transition-all duration-300 uppercase tracking-wider">
                    BACA VISI MISI
                </a>
            </div>
            <div class="w-full lg:w-1/2 relative">
                <div class="absolute inset-0 bg-primary-600 transform translate-x-4 translate-y-4 rounded-3xl opacity-20"></div>
                @php
                    // Ambil gambar Kades atau sembarang gambar galeri untuk ilustrasi
                    $ilustrasi = \App\Models\Galery::where('enabled', 1)->inRandomOrder()->first();
                    $imgIlustrasi = ($ilustrasi && $ilustrasi->gambar && is_file(LOKASI_GALERI . 'sedang_' . $ilustrasi->gambar)) ? base_url(LOKASI_GALERI . 'sedang_' . $ilustrasi->gambar) : asset('assets/images/header.jpg');
                @endphp
                <img src="{{ $imgIlustrasi }}" alt="Visi Misi Desa" class="relative rounded-3xl shadow-2xl w-full object-cover h-[500px]">
            </div>
        </div>
    </div>
</section>

<!-- 5. LATEST BLOG SECTION -->
<section class="py-24 bg-slate-50 dark:bg-slate-950 transition-colors duration-300">
    <div class="container mx-auto px-4 lg:px-8 xl:px-12 max-w-[1600px]">
        <div class="text-center mb-20">
            <h2 class="text-4xl lg:text-5xl font-bold text-slate-800 dark:text-white font-heading mb-6 uppercase tracking-wide">Kabar Terbaru</h2>
            <p class="text-slate-500 dark:text-slate-300 max-w-3xl mx-auto text-xl lg:text-2xl">Pantau terus perkembangan, kegiatan, dan program-program terbaru dari balai desa kami.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $displayArticles = [];
                if (function_exists('get_latest_articles')) {
                    $displayArticles = get_latest_articles(6);
                } elseif (isset($artikel) && (is_array($artikel) || is_object($artikel))) {
                    $displayArticles = is_object($artikel) ? $artikel->take(6) : array_slice($artikel, 0, 6);
                }
            @endphp

            @if (!empty($displayArticles))
                @foreach ($displayArticles as $post)
                    <article class="bg-white dark:bg-slate-900/40 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-[0_4px_20px_rgba(0,0,0,0.02)] overflow-hidden group hover:-translate-y-2 hover:shadow-soft hover:border-slate-200 dark:hover:border-slate-700 transition-all duration-300">
                        <!-- Image -->
                        <div class="relative h-56 overflow-hidden">
                            @if (is_file(LOKASI_FOTO_ARTIKEL . 'kecil_' . $post['gambar']))
                                <img src="{{ AmbilFotoArtikel($post['gambar'], 'sedang') }}" alt="{{ $post['judul'] }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-slate-100 dark:bg-slate-900 flex items-center justify-center">
                                    <i class="fas fa-image text-4xl text-slate-300 dark:text-slate-700"></i>
                                </div>
                            @endif
                            @if (isset($post['kategori']))
                                <div class="absolute top-4 left-4 bg-accent-500 text-slate-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                    {{ $post['kategori'] }}
                                </div>
                            @endif
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6 lg:p-8">
                            <div class="flex items-center gap-4 text-sm lg:text-base text-slate-500 dark:text-slate-300 font-medium mb-4">
                                <span class="flex items-center gap-1.5"><i class="far fa-calendar"></i> {{ tgl_indo($post['tgl_upload'] ?? date('Y-m-d')) }}</span>
                                <span class="flex items-center gap-1.5"><i class="far fa-user"></i> {{ $post['owner'] ?? 'Admin' }}</span>
                            </div>
                            <h3 class="text-2xl lg:text-3xl font-black text-slate-800 dark:text-white font-heading leading-tight mb-4 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2 uppercase tracking-wide">
                                <a href="{{ isset($post['url_slug']) ? $post['url_slug'] : site_url('artikel/' . ($post['slug'] ?? '')) }}" class="before:absolute before:inset-0">
                                    {{ $post['judul'] }}
                                </a>
                            </h3>
                            <p class="text-slate-600 dark:text-slate-200 text-base lg:text-lg line-clamp-3 mb-8 leading-relaxed">
                                {{ potong_teks($post['isi'] ?? '', 120) }}...
                            </p>
                            <span class="text-primary-600 dark:text-primary-400 font-bold text-base uppercase tracking-widest group-hover:text-accent-500 transition-colors flex items-center gap-2">
                                Baca Selengkapnya <i class="fas fa-arrow-right transition-transform group-hover:translate-x-2"></i>
                            </span>
                        </div>
                    </article>
                @endforeach
            @else
                <div class="col-span-full py-12 text-center">
                    <p class="text-slate-500 dark:text-slate-400">Belum ada artikel terbaru.</p>
                </div>
            @endif
        </div>
        
        <div class="mt-16 text-center">
            <a href="{{ site_url('arsip') }}" class="inline-block border-2 border-primary-600 dark:border-primary-400 text-primary-600 dark:text-primary-400 hover:bg-primary-600 hover:text-white dark:hover:text-slate-900 font-bold px-10 py-4 text-xl rounded-full transition-all duration-300 uppercase tracking-wider">
                LIHAT SEMUA BERITA
            </a>
        </div>
    </div>
</section>

<!-- 5. APARATUR SECTION -->
@php
    $aparatur_desa = \App\Models\Pamong::where('pamong_status', 1)->get();
@endphp
@if ($aparatur_desa && count($aparatur_desa) > 0)
<section class="py-24 bg-white dark:bg-slate-900 transition-colors duration-300">
    <div class="container mx-auto px-4 lg:px-8 xl:px-12 max-w-[1600px]">
        <div class="text-center mb-20">
            <h2 class="text-4xl lg:text-5xl font-bold text-slate-800 dark:text-white font-heading mb-6 uppercase tracking-wide">Aparatur Desa</h2>
            <p class="text-slate-500 dark:text-slate-300 max-w-3xl mx-auto text-xl lg:text-2xl">Kami siap melayani masyarakat dengan sepenuh hati.</p>
        </div>
        
        <div class="aparatur-carousel -mx-4">
            @foreach ($aparatur_desa as $aparatur)
                <div class="text-center group px-4">
                    <div class="relative w-48 h-48 lg:w-56 lg:h-56 mx-auto mb-8 rounded-3xl overflow-hidden shadow-xl border-8 border-white dark:border-slate-850 group-hover:border-primary-500/30 group-hover:shadow-glow-primary transition-all duration-300">
                        @php
                            $fotoUrl = AmbilFoto($aparatur->foto_staff, '', $aparatur->penduduk ? $aparatur->penduduk->sex : '1');
                        @endphp
                        <img src="{{ $fotoUrl }}" onerror="this.src='{{ base_url('assets/images/pengguna/kuser.png') }}'" alt="{{ $aparatur->pamong_nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h4 class="text-2xl font-bold text-slate-800 dark:text-white font-heading mb-2 uppercase tracking-wide">{{ $aparatur->pamong_nama }}</h4>
                    <p class="text-primary-600 dark:text-primary-400 font-bold text-lg lg:text-xl">{{ is_object($aparatur->jabatan) ? $aparatur->jabatan->nama : $aparatur->jabatan }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Initialize Slick Carousel for Aparatur -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof $ !== 'undefined' && $.fn.slick) {
            $('.aparatur-carousel').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: false,
                dots: true,
                responsive: [
                    { breakpoint: 1024, settings: { slidesToShow: 3 } },
                    { breakpoint: 768, settings: { slidesToShow: 2 } },
                    { breakpoint: 480, settings: { slidesToShow: 1 } }
                ]
            });
        }
    });
</script>
@endif

<!-- 7. CONTACT BLOCK -->
<section class="bg-primary-600 py-16 lg:py-24 mt-0">
    <div class="container mx-auto px-4 lg:px-8 max-w-4xl text-center">
        <h2 class="text-4xl lg:text-5xl font-bold text-white font-heading mb-4 tracking-wide uppercase">Kritik & Saran</h2>
        <p class="text-primary-100 mb-10 text-lg">Mari bersama-sama membangun desa. Sampaikan masukan atau pengaduan Anda.</p>
        
        <form action="{{ site_url('pengaduan') }}" method="POST" class="flex flex-col md:flex-row gap-4 justify-center max-w-3xl mx-auto">
            <input type="text" name="nama" placeholder="Nama Anda" class="w-full md:w-1/3 px-6 py-4 rounded-full border-none focus:ring-4 focus:ring-accent-500/50 outline-none text-lg">
            <input type="text" name="nik" placeholder="NIK" class="w-full md:w-1/3 px-6 py-4 rounded-full border-none focus:ring-4 focus:ring-accent-500/50 outline-none text-lg">
            <button type="submit" class="w-full md:w-1/3 bg-accent-500 hover:bg-accent-600 text-slate-900 font-bold px-8 py-4 rounded-full transition-transform hover:-translate-y-1 shadow-lg text-lg uppercase tracking-wider">
                KIRIM PESAN
            </button>
        </form>
    </div>
</section>
