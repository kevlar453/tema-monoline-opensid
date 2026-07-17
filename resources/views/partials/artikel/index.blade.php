@php
    $ci = get_instance();
    $uri = $ci->uri->uri_string();
    $is_homepage = (empty($uri) || $uri == 'first');
@endphp

@extends($is_homepage ? 'theme::template' : 'theme::layouts.right-sidebar')

@if($is_homepage)
    @section('layout')
        @include('theme::partials.home_content')
    @endsection
@else
    @section('content')
        <div class="w-full">
            <!-- Teks Berjalan -->
            @if (!empty($teks_berjalan))
                <div class="mb-8 overflow-hidden rounded-2xl bg-primary-50 border border-primary-100 flex items-center shadow-sm">
                    <div class="bg-primary-600 text-white px-4 py-3 text-sm font-bold flex-shrink-0 flex items-center gap-2">
                        <i class="fas fa-bullhorn"></i> PENGUMUMAN
                    </div>
                    <marquee class="flex-1 px-4 text-primary-900 font-medium text-sm" onmouseover="this.stop()" onmouseout="this.start()">
                        @include('theme::layouts.teks_berjalan')
                    </marquee>
                </div>
            @endif

            <!-- Corona Widgets (Optional) -->
            @if (setting('covid_data') || setting('covid_desa'))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                    @if (setting('covid_data'))
                        @include('theme::partials.corona-widget')
                    @endif
                    @if (setting('covid_desa'))
                        @include('theme::partials.corona-local')
                    @endif
                </div>
            @endif

            <!-- Headline Article -->
            @if ($headline)
                <div class="mb-12">
                    <h3 class="text-xl font-bold text-slate-800 font-heading mb-6 flex items-center gap-3">
                        <i class="fas fa-star text-amber-500"></i> Sorotan Utama
                    </h3>
                    @include('theme::partials.artikel.list', ['post' => $headline, 'is_headline' => true])
                </div>
            @endif

            <!-- Article List -->
            @if (isset($artikel) && $artikel->count() > 0)
                <div class="mb-8 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-slate-800 font-heading flex items-center gap-3">
                        <i class="fas fa-bars-staggered text-primary-500"></i> Daftar Artikel
                    </h3>
                </div>
                
                <div class="flex flex-col gap-6 lg:gap-8 mb-12">
                    @foreach ($artikel as $post)
                        @include('theme::partials.artikel.list', ['post' => $post])
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    @include('theme::commons.page')
                </div>
            @else
                <div class="bg-slate-50 border border-slate-100 rounded-3xl p-12 text-center shadow-sm">
                    <i class="fas fa-folder-open text-6xl text-slate-300 mb-4"></i>
                    <h3 class="text-2xl font-bold text-slate-700 font-heading mb-2">Belum Ada Artikel</h3>
                    <p class="text-slate-500 font-medium">Belum ada konten yang diterbitkan di kategori ini.</p>
                </div>
            @endif

        </div>
    @endsection
@endif
