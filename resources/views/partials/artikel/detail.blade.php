@extends('theme::layouts.right-sidebar')

@section('content')
    <article class="mb-[60px]">
        
        <!-- Cover Image (Flush at top) -->
        @if ($single_artikel['gambar'] && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $single_artikel['gambar']))
            <figure class="w-full mb-[30px] overflow-hidden rounded-2xl shadow-md border border-slate-100">
                <img class="w-full h-auto object-cover hover:scale-[1.02] transition-transform duration-500" 
                     src="{{ AmbilFotoArtikel($single_artikel['gambar'], 'sedang') }}" 
                     alt="{{ $single_artikel['judul'] }}">
            </figure>
        @endif

        <div class="py-2">
            <!-- Post Title & Meta -->
            <div class="border-b border-slate-100 pb-[15px] mb-[25px]">
                <h2 class="text-3xl lg:text-4xl font-extrabold text-slate-800 font-heading leading-tight mb-[12px] inline-block tracking-tight">
                    {{ $single_artikel['judul'] }}
                </h2>
                <div class="mt-2 flex flex-wrap items-center gap-3 text-[14px]">
                    @if (isset($single_artikel['kategori']))
                        <span>
                            <a href="{{ site_url('artikel/kategori/' . $single_artikel['kat_slug']) }}" class="text-primary-600 hover:text-primary-700 font-bold transition-colors tracking-wide uppercase text-xs">
                                {{ $single_artikel['kategori'] }}
                            </a>
                        </span>
                        <span class="text-slate-300">|</span>
                    @endif
                    <span class="text-slate-500 flex items-center gap-1">
                        <i class="far fa-user text-primary-500"></i> {{ $single_artikel['owner'] }}
                    </span>
                    <span class="text-slate-300">|</span>
                    <span class="text-slate-500 flex items-center gap-1">
                        <i class="far fa-calendar text-primary-500"></i> {{ tgl_indo($single_artikel['tgl_upload']) }}
                    </span>
                    <span class="text-slate-300">|</span>
                    <span class="text-slate-500 flex items-center gap-1">
                        <i class="far fa-eye text-primary-500"></i> {{ hit($single_artikel['hit']) }} Views
                    </span>
                </div>
            </div>

            <!-- Post Content (Reading Experience) -->
            <div class="prose prose-lg max-w-none font-sans leading-[28px] text-slate-600 
                        prose-headings:font-heading prose-headings:font-bold prose-headings:text-slate-800
                        prose-a:text-primary-600 hover:prose-a:text-primary-700 prose-a:transition-colors prose-a:no-underline hover:prose-a:underline
                        prose-blockquote:border-l-[4px] prose-blockquote:border-primary-600 prose-blockquote:bg-slate-50 prose-blockquote:py-2 prose-blockquote:px-6 prose-blockquote:font-semibold prose-blockquote:italic prose-blockquote:text-slate-600
                        mb-[30px]">
                {!! $single_artikel['isi'] !!}
            </div>

            @if ($single_artikel['dokumen'])
                <!-- Attachments -->
                <div class="mt-[30px] p-6 bg-white/80 backdrop-blur-md rounded-2xl border border-slate-200/50 shadow-soft">
                    <h4 class="text-[18px] font-bold text-slate-800 mb-[15px] pb-[10px] border-b border-slate-100 font-heading capitalize flex items-center gap-2">
                        <i class="fas fa-paperclip text-primary-500"></i> Lampiran Dokumen
                    </h4>
                    <a href="{{ base_url(LOKASI_DOKUMEN . $single_artikel['dokumen']) }}" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-50 border border-primary-100 hover:bg-primary-100 transition-colors text-primary-700 font-bold rounded-xl text-[14px]">
                        <i class="fas fa-download"></i>
                        <span>Unduh {{ $single_artikel['link_dokumen'] ?: $single_artikel['dokumen'] }}</span>
                    </a>
                </div>
            @endif
            
            <div class="flex items-center gap-[10px] mt-[30px] pt-[20px] border-t border-slate-100">
                <span class="text-[14px] font-bold text-slate-800 uppercase tracking-wider mr-2 font-heading">Bagikan</span>
                <a href="http://www.facebook.com/sharer.php?u={{ site_url('artikel/' . $single_artikel['slug']) }}" target="_blank" class="w-[38px] h-[38px] rounded-xl border border-slate-200 text-slate-500 flex items-center justify-center hover:bg-primary-600 hover:text-white hover:border-primary-600 transition-all duration-300 shadow-sm"><i class="fab fa-facebook-f text-sm"></i></a>
                <a href="http://twitter.com/share?url={{ site_url('artikel/' . $single_artikel['slug']) }}" target="_blank" class="w-[38px] h-[38px] rounded-xl border border-slate-200 text-slate-500 flex items-center justify-center hover:bg-primary-600 hover:text-white hover:border-primary-600 transition-all duration-300 shadow-sm"><i class="fab fa-twitter text-sm"></i></a>
                <a href="https://api.whatsapp.com/send?text={{ site_url('artikel/' . $single_artikel['slug']) }}" target="_blank" class="w-[38px] h-[38px] rounded-xl border border-slate-200 text-slate-500 flex items-center justify-center hover:bg-primary-600 hover:text-white hover:border-primary-600 transition-all duration-300 shadow-sm"><i class="fab fa-whatsapp text-sm"></i></a>
            </div>
        </div>
    </article>

    <!-- Author Box -->
    @php
        $ownerName = $single_artikel['owner'] ?? 'Admin';
        $userModel = \App\Models\User::where('nama', $ownerName)->orWhere('username', $ownerName)->first();
        $avatarUrl = asset('images/pengguna/kuser.png');
        if ($userModel && $userModel->foto) {
            $userPictPath = LOKASI_USER_PICT . $userModel->foto;
            if (is_file(FCPATH . $userPictPath)) {
                $avatarUrl = base_url($userPictPath);
            } else {
                $avatarUrl = asset('images/pengguna/' . $userModel->foto);
            }
        }
    @endphp
    <div class="mb-[30px] mt-[60px] overflow-hidden">
        <h3 class="border-b border-slate-100 text-slate-800 text-[20px] font-heading font-extrabold mb-[20px] pb-[10px] capitalize tracking-wider">About the author</h3>
        <div class="bg-white/80 backdrop-blur-lg p-8 rounded-2xl border border-slate-200/50 shadow-soft overflow-hidden">
            <div class="flex flex-col sm:flex-row gap-[20px] items-start">
                <img src="{{ $avatarUrl }}" alt="{{ $single_artikel['owner'] }}" class="w-[100px] h-[100px] flex-shrink-0 object-cover rounded-2xl border-[3px] border-primary-500/20 shadow-sm">
                <div class="flex-1">
                    <h4 class="text-[16px] font-bold text-slate-800 mb-[10px] uppercase tracking-[1px] font-heading">{{ $single_artikel['owner'] }}</h4>
                    <p class="text-slate-600 text-[15px] leading-[28px] m-0">
                        Aparatur Pemerintah Desa yang berdedikasi tinggi dalam melayani masyarakat dan memberikan informasi publik secara transparan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    @if ($single_artikel['boleh_komentar'])
        <div class="mb-[30px] overflow-hidden">
            <h3 class="border-b border-slate-100 text-slate-800 text-[20px] font-bold mb-[20px] pb-[10px] font-heading capitalize tracking-wider">
                Comments ({{ $single_artikel['jumlah_komentar'] ?? 0 }})
            </h3>
            
            <div class="mt-[20px]">
                @include('theme::partials.artikel.comment')
            </div>
        </div>
    @endif

@endsection
