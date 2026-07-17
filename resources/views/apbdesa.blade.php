@extends('theme::template')

@section('layout')
    <!-- Header Spacing -->
    <div class="h-20 bg-slate-900/10"></div>

    <div class="min-h-screen bg-[#f9fcff] py-12">
        <div class="container mx-auto px-4 max-w-[1200px]">
            @if (!empty($data_widget))
                @include('theme::partials.apbdesa-tema')
            @else
                <div class="bg-white rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,64,128,0.1)] border border-gray-100 p-12 text-center my-12">
                    <div class="w-24 h-24 bg-amber-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                        <i class="fas fa-chart-pie text-4xl text-amber-500"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 font-heading mb-4">Transparansi Anggaran</h2>
                    <div class="w-20 h-1 bg-amber-500 mx-auto rounded-full mb-6"></div>
                    <p class="text-lg text-gray-500 max-w-md mx-auto leading-relaxed">
                        Data realisasi dan anggaran untuk tahun anggaran ini belum diisi atau dinonaktifkan di sistem. Silakan hubungi operator desa untuk informasi lebih lanjut.
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
