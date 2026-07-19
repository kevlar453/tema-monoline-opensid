@extends('theme::template')

@section('layout')
    <div class="min-h-full bg-white dark:bg-slate-950 transition-colors duration-300">
        <!-- Premium Page Header -->
        <div class="border-b border-slate-200/60 dark:border-slate-800/80 bg-gradient-to-br from-slate-50 via-slate-100/40 to-white dark:from-slate-900/60 dark:via-slate-900/40 dark:to-slate-950 transition-colors duration-300">
            <div class="container mx-auto px-4 py-12 lg:py-16 text-center max-w-4xl">
                <p class="text-primary-600 dark:text-primary-400 font-extrabold uppercase tracking-widest text-xs lg:text-sm mb-3">{{ ucwords(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa'] ?? '') }}</p>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-slate-800 dark:text-slate-200 font-heading mb-4 tracking-tight">
                    @php 
                        $title = (!empty($judul_kategori)) ? $judul_kategori : 'Informasi Desa';
                        if (is_array($title)) {
                            foreach ($title as $item) $title = $item;
                        }
                    @endphp
                    {{ $title }}
                </h1>
                <div class="h-1.5 w-16 bg-primary-600 mx-auto rounded-full"></div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-12">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Sidebar -->
                <aside class="w-full lg:w-80 xl:w-96 flex-shrink-0 order-2 lg:order-1">
                    <div class="lg:sticky lg:top-28">
                        @include('theme::partials.sidebar')
                    </div>
                </aside>

                <!-- Main Content -->
                <main class="flex-1 min-w-0 order-1 lg:order-2">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
@endsection
