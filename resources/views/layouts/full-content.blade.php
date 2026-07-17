@extends('theme::template')

@section('layout')
    <div class="min-h-full bg-white">
        <!-- Premium Page Header -->
        <div class="border-b border-slate-200/60 bg-gradient-to-br from-slate-50 via-slate-100/40 to-white">
            <div class="container mx-auto px-4 py-12 lg:py-16 text-center max-w-4xl">
                <p class="text-primary-600 font-extrabold uppercase tracking-widest text-xs lg:text-sm mb-3">{{ ucwords(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa'] ?? '') }}</p>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-slate-800 font-heading mb-4 tracking-tight">
                     @php 
                         $title = (!empty($judul_kategori)) ? $judul_kategori : 'Laman Informasi';
                         if (is_array($title)) {
                             foreach ($title as $item) $title = $item;
                         }
                     @endphp
                     {{ $title }}
                </h1>
                <div class="h-1.5 w-16 bg-primary-600 mx-auto rounded-full"></div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-12 max-w-5xl">
            <main class="w-full">
                @yield('content')
            </main>
        </div>
    </div>
@endsection
