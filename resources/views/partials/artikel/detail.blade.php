@extends('theme::layouts.right-sidebar')

@section('content')
    <article class="mb-[60px]">
        
        <!-- Cover Image (Flush at top) -->
        @if ($single_artikel['gambar'] && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $single_artikel['gambar']))
            <figure class="w-full mb-[30px]">
                <img class="w-full h-auto object-cover" 
                     src="{{ AmbilFotoArtikel($single_artikel['gambar'], 'sedang') }}" 
                     alt="{{ $single_artikel['judul'] }}">
            </figure>
        @endif

        <div class="py-4">
            <!-- Post Title & Meta -->
            <div class="border-b border-[#eee] pb-[10px] mb-[20px]">
                <h2 class="text-3xl lg:text-4xl font-bold text-[#1b2032] font-heading leading-tight mb-[5px] inline-block">
                    {{ $single_artikel['judul'] }}
                </h2>
                <div class="mt-2 text-[14px]">
                    @if (isset($single_artikel['kategori']))
                        <span class="mx-[5px]">
                            <a href="{{ site_url('artikel/kategori/' . $single_artikel['kat_slug']) }}" class="text-[#ffaa17] hover:text-[#1b2032] transition-colors tracking-[1px]">
                                {{ $single_artikel['kategori'] }}
                            </a>
                        </span>
                        <span class="text-slate-300">|</span>
                    @endif
                    <span class="mx-[5px] text-slate-500">
                        <i class="far fa-user text-[#ffaa17] mr-1"></i> {{ $single_artikel['owner'] }}
                    </span>
                    <span class="text-slate-300">|</span>
                    <span class="mx-[5px] text-slate-500">
                        <i class="far fa-calendar text-[#ffaa17] mr-1"></i> {{ tgl_indo($single_artikel['tgl_upload']) }}
                    </span>
                    <span class="text-slate-300">|</span>
                    <span class="mx-[5px] text-slate-500">
                        <i class="far fa-eye text-[#ffaa17] mr-1"></i> {{ hit($single_artikel['hit']) }} Views
                    </span>
                </div>
            </div>

            <!-- Post Content (Reading Experience) -->
            <div class="prose prose-lg max-w-none font-sans leading-[28px] text-[#666] 
                        prose-headings:font-heading prose-headings:font-bold prose-headings:text-[#1b2032]
                        prose-a:text-[#ffaa17] hover:prose-a:text-[#1b2032] prose-a:transition-colors prose-a:no-underline hover:prose-a:underline
                        prose-blockquote:border-l-[4px] prose-blockquote:border-[#ffaa17] prose-blockquote:bg-slate-50 prose-blockquote:py-2 prose-blockquote:px-6 prose-blockquote:font-semibold prose-blockquote:italic prose-blockquote:text-[#666]
                        mb-[30px]">
                {!! $single_artikel['isi'] !!}
            </div>

            @if ($single_artikel['dokumen'])
                <!-- Attachments -->
                <div class="mt-[30px] p-[30px] bg-white rounded-[10px] border-t-[3px] border-[#ffaa17] shadow-[0_10px_40px_-10px_rgba(0,64,128,0.2)]">
                    <h4 class="text-[20px] font-semibold text-[#1b2032] mb-[15px] pb-[10px] border-b border-[#eee] capitalize">
                        <i class="fas fa-paperclip text-[#ffaa17]"></i> Lampiran Dokumen
                    </h4>
                    <a href="{{ base_url(LOKASI_DOKUMEN . $single_artikel['dokumen']) }}" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-[#eee] hover:border-[#ffaa17] transition-colors text-[#666] hover:text-[#1b2032] font-semibold text-[14px]">
                        <i class="fas fa-download"></i>
                        <span>Unduh {{ $single_artikel['link_dokumen'] ?: $single_artikel['dokumen'] }}</span>
                    </a>
                </div>
            @endif
            
            <div class="flex items-center gap-[10px] mt-[30px] pt-[20px] border-t border-[#eee]">
                <span class="text-[14px] font-semibold text-[#1b2032] uppercase tracking-[1px] mr-2">Share</span>
                <a href="http://www.facebook.com/sharer.php?u={{ site_url('artikel/' . $single_artikel['slug']) }}" target="_blank" class="w-[35px] h-[35px] rounded border border-[#eee] text-[#666] flex items-center justify-center hover:bg-[#ffaa17] hover:text-white hover:border-[#ffaa17] transition-colors"><i class="fab fa-facebook-f text-sm"></i></a>
                <a href="http://twitter.com/share?url={{ site_url('artikel/' . $single_artikel['slug']) }}" target="_blank" class="w-[35px] h-[35px] rounded border border-[#eee] text-[#666] flex items-center justify-center hover:bg-[#ffaa17] hover:text-white hover:border-[#ffaa17] transition-colors"><i class="fab fa-twitter text-sm"></i></a>
                <a href="https://api.whatsapp.com/send?text={{ site_url('artikel/' . $single_artikel['slug']) }}" target="_blank" class="w-[35px] h-[35px] rounded border border-[#eee] text-[#666] flex items-center justify-center hover:bg-[#ffaa17] hover:text-white hover:border-[#ffaa17] transition-colors"><i class="fab fa-whatsapp text-sm"></i></a>
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
            <h3 class="border-b border-[#eee] text-[#1b2032] text-[20px] font-semibold mb-[20px] pb-[10px] capitalize">
                Comments ({{ $single_artikel['jumlah_komentar'] ?? 0 }})
            </h3>
            
            <div class="mt-[20px]">
                @include('theme::partials.artikel.comment')
            </div>
        </div>
    @endif

@endsection
