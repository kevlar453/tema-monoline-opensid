@php 
    $abstrak = potong_teks($post['isi'], 200);
    $is_headline = $is_headline ?? false;
@endphp

<div class="bg-white/80 dark:bg-slate-900/60 backdrop-blur-lg rounded-2xl border border-slate-200/50 dark:border-slate-800 shadow-soft overflow-hidden group hover:-translate-y-1 hover:shadow-md hover:border-primary-100 dark:hover:border-primary-900 transition-all duration-300 flex flex-col md:flex-row gap-6 p-6">
    <div class="w-full md:w-1/3 h-48 md:h-auto min-h-[180px] flex-shrink-0 relative overflow-hidden rounded-xl bg-slate-50 dark:bg-slate-950">
        @if (is_file(LOKASI_FOTO_ARTIKEL . 'kecil_' . $post['gambar']))
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ AmbilFotoArtikel($post['gambar'], 'sedang') }}" alt="{{ $post['judul'] }}" />
        @else
            <div class="w-full h-full flex items-center justify-center">
                <i class="fas fa-image text-4xl text-slate-300 dark:text-slate-700"></i>
            </div>
        @endif
        @if (isset($post['kategori']))
            <span class="absolute top-3 left-3 bg-primary-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-sm">
                {{ $post['kategori'] }}
            </span>
        @endif
    </div>
    
    <div class="flex-1 flex flex-col justify-between py-1">
        <div>
            <div class="flex items-center gap-3 text-xs text-slate-500 dark:text-slate-300 mb-2 font-medium">
                <span class="flex items-center gap-1"><i class="far fa-calendar-alt text-primary-500 dark:text-primary-400"></i> {{ tgl_indo($post['tgl_upload']) }}</span>
                <span class="flex items-center gap-1"><i class="far fa-eye text-primary-500 dark:text-primary-400"></i> {{ hit($post['hit']) }}</span>
            </div>
            
            <h2 class="text-xl md:text-2xl font-bold text-slate-800 dark:text-white font-heading leading-snug group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors mb-3">
                <a href="{{ $post->url_slug }}">{{ $post['judul'] }}</a>
            </h2>
            
            <p class="text-slate-600 dark:text-slate-200 text-sm leading-relaxed mb-4 line-clamp-3">{!! strip_tags($abstrak) !!}...</p>
        </div>
        
        <div>
            <a class="inline-flex items-center gap-1.5 text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-350 font-bold text-sm transition-colors group/btn" href="{{ $post->url_slug }}">
                Baca Selengkapnya 
                <i class="fas fa-arrow-right text-xs group-hover/btn:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</div>
