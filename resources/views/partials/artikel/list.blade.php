@php 
    $abstrak = potong_teks($post['isi'], 200);
    $is_headline = $is_headline ?? false;
@endphp

<div class="home_single_blog">
    @if (is_file(LOKASI_FOTO_ARTIKEL . 'kecil_' . $post['gambar']))
        <img class="img-fluid" src="{{ AmbilFotoArtikel($post['gambar'], 'sedang') }}" alt="{{ $post['judul'] }}" />
    @else
        <div style="width: 100%; height: 400px; display: flex; align-items: center; justify-content: center; background: #e2e8f0; border-radius: 10px 10px 0 0;">
            <i class="fas fa-image text-6xl text-slate-400"></i>
        </div>
    @endif
    <div class="home_blog_content">
        <div class="blog_title_info">
            <h2><a href="{{ $post->url_slug }}">{{ $post['judul'] }}</a></h2>
            <div class="mt-2 flex flex-wrap gap-4 text-sm text-slate-500">
                <span><i class="far fa-calendar-alt text-[#ffaa17] mr-1"></i> {{ tgl_indo($post['tgl_upload']) }}</span>
                @if (isset($post['kategori']))
                    <span><i class="far fa-folder text-[#ffaa17] mr-1"></i> <a href="{{ site_url('artikel/kategori/' . $post['kat_slug']) }}">{{ $post['kategori'] }}</a></span>
                @endif
                <span><i class="far fa-eye text-[#ffaa17] mr-1"></i> {{ hit($post['hit']) }} Kali</span>
            </div>
        </div>
        <p class="text-slate-600 leading-relaxed">{!! $abstrak !!}...</p>
        <a class="home_b_btn" href="{{ $post->url_slug }}">Read More <i class="fas fa-arrow-right ml-1"></i></a>
    </div>
</div>
