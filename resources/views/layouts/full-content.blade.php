@extends('theme::template')

@section('layout')
    <div class="min-h-full bg-white">
        <!-- Minimalist Page Header -->
        <div class="border-b border-slate-100 bg-slate-50/50">
            <div class="container mx-auto px-4 py-10 lg:py-16 text-center max-w-4xl">
                <h1 class="text-4xl lg:text-5xl font-bold text-slate-800 font-heading mb-4 tracking-tight">
                    @php 
                        $title = (!empty($judul_kategori)) ? $judul_kategori : 'Laman Informasi';
                        if (is_array($title)) {
                            foreach ($title as $item) $title = $item;
                        }
                    @endphp
                    {{ $title }}
                </h1>
                <div class="h-1 w-16 bg-slate-800 mx-auto rounded-full mb-6"></div>
                <p class="text-lg text-slate-500 font-medium">{{ ucwords(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa'] ?? '') }}</p>
            </div>
        </div>

        <div class="container mx-auto px-4 py-12 max-w-5xl">
            <main class="w-full">
                @yield('content')
            </main>
        </div>
    </div>
@endsection
