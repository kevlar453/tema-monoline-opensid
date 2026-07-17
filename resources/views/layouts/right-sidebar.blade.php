@extends('theme::template')

@section('footer_bg', 'bg-white')

@section('layout')
    <!-- Halaman Konten & Sidebar -->
    <div class="min-h-full bg-[#f9fcff] pb-20">
        <!-- START SECTION TOP -->
        <section class="w-full py-12 md:py-20 lg:py-24 relative overflow-hidden" style="background-image: url('{{ theme_asset('img/bg/section-top.png') }}'); background-size: cover; background-position: center center;">
            <!-- Dark Tint and Gradient Overlay -->
            <div class="absolute inset-0 bg-slate-950/60 z-0"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent z-0"></div>
            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white font-heading capitalize tracking-tight drop-shadow-lg">
                        @php 
                            $title = (!empty($judul_kategori)) ? (is_array($judul_kategori) ? $judul_kategori[0] : $judul_kategori) : 'Blog Single Page Post';
                        @endphp
                        {{ $title }}
                    </h1>		
                </div>
            </div>
        </section>
        <!-- END SECTION TOP -->

        <div class="container mx-auto px-4 py-12 lg:py-16 max-w-[1200px]">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                <!-- Konten Utama (Artikel dll) -->
                <main class="w-full lg:w-2/3 min-w-0">
                    <div class="w-full mb-8">
                        @yield('content')
                    </div>
                </main>

                <!-- Sidebar Kanan -->
                <aside class="w-full lg:w-1/3 flex-shrink-0">
                    <div class="sticky top-24">
                        @include('theme::partials.sidebar')
                    </div>
                </aside>
            </div>
        </div>
    </div>
@endsection
