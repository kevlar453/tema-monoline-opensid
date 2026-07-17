@extends('theme::template')

@section('footer_bg', 'bg-primary-600')

@section('layout')
<!-- Homepage specific marker for transparent navbar logic -->
<div class="hero-monoline hidden"></div>

<!-- 1. HERO SECTION -->
@php
    $heroArticle = null;
    if (isset($artikel) && is_array($artikel) && count($artikel) > 0) {
        $heroArticle = $artikel[0];
    }
    $heroImage = ($heroArticle && isset($heroArticle['gambar'])) ? AmbilFotoArtikel($heroArticle['gambar'], 'besar') : asset('assets/images/default-hero.jpg');
@endphp
<section class="relative w-full h-[85vh] min-h-[600px] flex items-center justify-center pt-20" style="background-image: url('{{ $heroImage }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-slate-950/70 mix-blend-multiply"></div>
    <!-- Glowing background node -->
    <div class="absolute w-[30vw] h-[30vw] bg-primary-600/10 blur-[120px] rounded-full top-1/4 left-1/4"></div>
    <div class="absolute w-[30vw] h-[30vw] bg-accent-500/5 blur-[120px] rounded-full bottom-1/4 right-1/4"></div>
    
    <div class="relative z-10 text-center px-6 py-10 md:py-16 max-w-4xl mx-auto bg-slate-950/40 backdrop-blur-md rounded-3xl border border-white/10 shadow-[0_30px_60px_rgba(0,0,0,0.4)] animate-fade-in-up">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/10 backdrop-blur-sm border border-white/20 text-xs font-semibold text-accent-400 rounded-full tracking-widest uppercase mb-4">
            Portal Resmi Pemerintah
        </span>
        <h1 class="text-white text-3xl md:text-5xl lg:text-6xl font-extrabold font-heading mb-6 tracking-tight uppercase leading-tight">
            {{ ucwords(setting('sebutan_desa')) }} {{ $desa['nama_desa'] }}
        </h1>
        <p class="text-white/80 text-base md:text-lg font-medium mb-10 max-w-2xl mx-auto leading-relaxed">
            Terwujudnya masyarakat desa yang mandiri, sejahtera, dan berbudaya melalui tata kelola pemerintahan yang transparan dan berbasis digital.
        </p>
        <a href="#layanan" class="inline-flex items-center gap-2 bg-accent-500 hover:bg-accent-600 text-slate-950 font-bold px-8 py-4 rounded-full transition-all duration-300 transform hover:scale-105 shadow-[0_10px_25px_rgba(255,185,0,0.35)] group">
            PELAJARI LEBIH LANJUT <i class="fas fa-arrow-down text-xs transition-transform group-hover:translate-y-1"></i>
        </a>
    </div>
</section>

<!-- 2. SERVICES OVERLAP SECTION -->
<section id="layanan" class="relative z-20 -mt-24 pb-20">
    <div class="container mx-auto px-4 lg:px-8 max-w-6xl">
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-[0_25px_60px_rgba(0,0,0,0.06)] border border-slate-200/50 p-8 md:p-12 text-center">
            
            <h2 class="text-3xl font-bold text-slate-800 font-heading mb-3 tracking-tight">Layanan Unggulan</h2>
            <p class="text-slate-500 max-w-xl mx-auto mb-12 text-sm md:text-base">Akses cepat menuju berbagai layanan pemerintahan dan informasi publik desa.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 text-left">
                <!-- Layanan Mandiri -->
                @if ((bool) setting('layanan_mandiri'))
                <a href="{{ site_url('layanan-mandiri') }}" class="group flex gap-6 p-6 rounded-2xl bg-white hover:bg-primary-50/30 border border-slate-100 hover:border-primary-100 shadow-sm transition-all duration-300 hover:shadow-md glow-primary-hover">
                    <div class="w-14 h-14 bg-primary-50 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-primary-600 transition-colors">
                        <i class="fas fa-desktop text-2xl text-primary-600 group-hover:text-white transition-colors"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-slate-800 font-heading mb-2">Layanan Mandiri</h4>
                        <p class="text-sm text-slate-500 leading-relaxed">Urus surat menyurat secara online tanpa harus antre di balai desa.</p>
                    </div>
                </a>
                @endif
                
                <!-- Data Wilayah -->
                <a href="{{ site_url('data-wilayah') }}" class="group flex gap-6 p-6 rounded-2xl bg-white hover:bg-teal-50/30 border border-slate-100 hover:border-teal-100 shadow-sm transition-all duration-300 hover:shadow-md glow-cyan-hover">
                    <div class="w-14 h-14 bg-teal-50 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-teal-500 transition-colors">
                        <i class="fas fa-map-marked-alt text-2xl text-teal-600 group-hover:text-white transition-colors"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-slate-800 font-heading mb-2">Data Wilayah</h4>
                        <p class="text-sm text-slate-500 leading-relaxed">Statistik dan demografi kependudukan yang selalu diperbarui.</p>
                    </div>
                </a>

                <!-- Transparansi APBDes -->
                <a href="{{ site_url('apbdesa') }}" class="group flex gap-6 p-6 rounded-2xl bg-white hover:bg-amber-50/30 border border-slate-100 hover:border-amber-100 shadow-sm transition-all duration-300 hover:shadow-md glow-primary-hover">
                    <div class="w-14 h-14 bg-amber-50 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-amber-500 transition-colors">
                        <i class="fas fa-chart-pie text-2xl text-amber-500 group-hover:text-white transition-colors"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-slate-800 font-heading mb-2">Transparansi</h4>
                        <p class="text-sm text-slate-500 leading-relaxed">Laporan APBDes dan rincian pembangunan desa yang terbuka.</p>
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

    <div class="container mx-auto px-4 lg:px-8 max-w-6xl relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center text-white">
            <div class="flex flex-col items-center justify-center p-6 rounded-2xl bg-white/[0.02] border border-white/5 backdrop-blur-sm hover:border-white/10 transition-all duration-300">
                <div class="w-12 h-12 rounded-full bg-primary-500/10 flex items-center justify-center mb-4 text-primary-400">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <h3 class="text-4xl font-extrabold font-heading mb-1.5 tracking-tight text-white">{{ $penduduk['total'] ?? '0' }}</h3>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Total Penduduk</p>
            </div>
            <div class="flex flex-col items-center justify-center p-6 rounded-2xl bg-white/[0.02] border border-white/5 backdrop-blur-sm hover:border-white/10 transition-all duration-300">
                <div class="w-12 h-12 rounded-full bg-teal-500/10 flex items-center justify-center mb-4 text-teal-400">
                    <i class="fas fa-male text-xl"></i>
                </div>
                <h3 class="text-4xl font-extrabold font-heading mb-1.5 tracking-tight text-white">{{ $penduduk['laki'] ?? '0' }}</h3>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Laki-Laki</p>
            </div>
            <div class="flex flex-col items-center justify-center p-6 rounded-2xl bg-white/[0.02] border border-white/5 backdrop-blur-sm hover:border-white/10 transition-all duration-300">
                <div class="w-12 h-12 rounded-full bg-pink-500/10 flex items-center justify-center mb-4 text-pink-400">
                    <i class="fas fa-female text-xl"></i>
                </div>
                <h3 class="text-4xl font-extrabold font-heading mb-1.5 tracking-tight text-white">{{ $penduduk['perempuan'] ?? '0' }}</h3>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Perempuan</p>
            </div>
            <div class="flex flex-col items-center justify-center p-6 rounded-2xl bg-white/[0.02] border border-white/5 backdrop-blur-sm hover:border-white/10 transition-all duration-300">
                <div class="w-12 h-12 rounded-full bg-amber-500/10 flex items-center justify-center mb-4 text-amber-400">
                    <i class="fas fa-home text-xl"></i>
                </div>
                <h3 class="text-4xl font-extrabold font-heading mb-1.5 tracking-tight text-white">{{ $keluarga['total'] ?? '0' }}</h3>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Keluarga</p>
            </div>
        </div>
    </div>
</section>

<!-- 4. LATEST BLOG SECTION -->
<section class="py-24 bg-slate-50">
    <div class="container mx-auto px-4 lg:px-8 max-w-7xl">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-slate-800 font-heading mb-4">Kabar Terbaru</h2>
            <p class="text-slate-500 max-w-2xl mx-auto">Pantau terus perkembangan, kegiatan, dan program-program terbaru dari balai desa kami.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $displayArticles = [];
                if (function_exists('get_latest_articles')) {
                    $displayArticles = get_latest_articles(6);
                } elseif (isset($artikel) && is_array($artikel)) {
                    $displayArticles = array_slice($artikel, 0, 6);
                }
            @endphp

            @if (!empty($displayArticles))
                @foreach ($displayArticles as $post)
                    <article class="bg-white rounded-2xl border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.02)] overflow-hidden group hover:-translate-y-2 hover:shadow-soft hover:border-slate-200 transition-all duration-300">
                        <!-- Image -->
                        <div class="relative h-56 overflow-hidden">
                            @if (is_file(LOKASI_FOTO_ARTIKEL . 'kecil_' . $post['gambar']))
                                <img src="{{ AmbilFotoArtikel($post['gambar'], 'sedang') }}" alt="{{ $post['judul'] }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                    <i class="fas fa-image text-4xl text-slate-300"></i>
                                </div>
                            @endif
                            @if (isset($post['kategori']))
                                <div class="absolute top-4 left-4 bg-accent-500 text-slate-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                    {{ $post['kategori'] }}
                                </div>
                            @endif
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6">
                            <div class="flex items-center gap-4 text-xs text-slate-400 font-medium mb-3">
                                <span class="flex items-center gap-1.5"><i class="far fa-calendar"></i> {{ tgl_indo($post['tgl_upload'] ?? date('Y-m-d')) }}</span>
                                <span class="flex items-center gap-1.5"><i class="far fa-user"></i> {{ $post['owner'] ?? 'Admin' }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 font-heading leading-snug mb-3 group-hover:text-primary-600 transition-colors line-clamp-2">
                                <a href="{{ isset($post['url_slug']) ? $post['url_slug'] : site_url('artikel/' . ($post['slug'] ?? '')) }}" class="before:absolute before:inset-0">
                                    {{ $post['judul'] }}
                                </a>
                            </h3>
                            <p class="text-slate-500 text-sm line-clamp-3 mb-6">
                                {{ potong_teks($post['isi'] ?? '', 120) }}...
                            </p>
                            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider group-hover:text-accent-500 transition-colors flex items-center gap-2">
                                Baca Selengkapnya <i class="fas fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                            </span>
                        </div>
                    </article>
                @endforeach
            @else
                <div class="col-span-full py-12 text-center">
                    <p class="text-slate-500">Belum ada artikel terbaru.</p>
                </div>
            @endif
        </div>
        
        <div class="mt-12 text-center">
            <a href="{{ site_url('arsip') }}" class="inline-block border-2 border-primary-600 text-primary-600 hover:bg-primary-600 hover:text-white font-bold px-8 py-3 rounded-full transition-all duration-300">
                LIHAT SEMUA BERITA
            </a>
        </div>
    </div>
</section>

<!-- 5. APARATUR SECTION -->
@if (isset($aparatur_desa) && count($aparatur_desa) > 0)
<section class="py-24 bg-white">
    <div class="container mx-auto px-4 lg:px-8 max-w-7xl">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-slate-800 font-heading mb-4">Aparatur Desa</h2>
            <p class="text-slate-500 max-w-2xl mx-auto">Kami siap melayani masyarakat dengan sepenuh hati.</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach (array_slice($aparatur_desa, 0, 4) as $aparatur)
                <div class="text-center group">
                    <div class="relative w-40 h-40 mx-auto mb-6 rounded-3xl overflow-hidden shadow-md border-4 border-white group-hover:border-primary-500/30 group-hover:shadow-glow-primary transition-all duration-300">
                        @if ($aparatur['foto'] && is_file(LOKASI_USER_PICT . $aparatur['foto']))
                            <img src="{{ base_url(LOKASI_USER_PICT . $aparatur['foto']) }}" alt="{{ $aparatur['nama'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <img src="{{ asset('assets/images/pengguna/kuser.png') }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 font-heading">{{ $aparatur['nama'] }}</h4>
                    <p class="text-primary-600 font-medium text-sm">{{ $aparatur['jabatan'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
