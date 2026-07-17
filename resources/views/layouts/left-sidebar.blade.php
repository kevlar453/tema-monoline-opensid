@extends('theme::template')

@section('layout')
    <div class="min-h-full bg-white">
        <!-- Minimalist Page Header -->
        <div class="border-b border-slate-100 bg-slate-50/50">
            <div class="container mx-auto px-4 py-10 lg:py-16 text-center max-w-4xl">
                <h1 class="text-4xl lg:text-5xl font-bold text-slate-800 font-heading mb-4 tracking-tight">
                    @php 
                        $title = (!empty($judul_kategori)) ? $judul_kategori : 'Informasi Desa';
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
