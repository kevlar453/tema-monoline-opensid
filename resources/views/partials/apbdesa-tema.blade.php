@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<!-- APBDesa Transparansi Section -->
<div class="bg-transparent py-12" id="transparansi-footer">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-slate-800 mb-4 font-heading tracking-tight">Transparansi Anggaran</h2>
            <div class="w-24 h-1.5 bg-primary-600 mx-auto rounded-full"></div>
            <p class="text-lg text-slate-600 mt-4 max-w-2xl mx-auto font-sans leading-relaxed">
                Informasi lengkap tentang realisasi dan anggaran {{ ucwords(setting('sebutan_desa')) }} untuk meningkatkan transparansi dan akuntabilitas
            </p>
        </div>
        
        <!-- APBDesa Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($data_widget as $subdata_name => $subdatas)
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl border border-slate-200/50 p-8 shadow-soft hover:shadow-md hover:border-primary-100 transition-all duration-300">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-primary-100">
                            <i class="fas fa-chart-pie text-primary-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-2 font-heading">
                            {{ \Illuminate\Support\Str::of($subdatas['laporan'])->when(setting('sebutan_desa') != 'desa', function (\Illuminate\Support\Stringable $string) {
                                return $string->replace('Des', \Illuminate\Support\Str::of(setting('sebutan_desa'))->substr(0, 1)->ucfirst());
                            }) }}
                        </h3>
                        <div class="w-16 h-1 bg-primary-400 mx-auto rounded-full"></div>
                    </div>
                    
                    <!-- Subtitle -->
                    <div class="text-center mb-8">
                        <h4 class="text-sm font-extrabold text-slate-500 uppercase tracking-widest font-heading">Realisasi | Anggaran</h4>
                    </div>
                    
                    <!-- Progress Items -->
                    <div class="space-y-6">
                        @foreach ($subdatas as $key => $subdata)
                            @continue(!is_array($subdata))
                            @if ($subdata['judul'] != null and $key != 'laporan' and $subdata['realisasi'] != 0 or $subdata['anggaran'] != 0)
                                <div class="bg-slate-50/50 rounded-xl p-5 border border-slate-100 hover:border-slate-200 transition-all duration-300">
                                    <!-- Title -->
                                    <h5 class="text-sm font-bold text-slate-800 mb-4 leading-tight font-heading">
                                        {{ \Illuminate\Support\Str::of($subdata['judul'])->title()->whenEndsWith('Desa', function (\Illuminate\Support\Stringable $string) {
                                                if (!in_array($string, ['Dana Desa'])) {
                                                    return $string->replace('Desa', setting('sebutan_desa'));
                                                }
                                            })->title() }}
                                    </h5>
                                    
                                    <!-- Amounts -->
                                    <div class="flex justify-between items-center mb-4 text-sm">
                                        <div class="text-center">
                                            <div class="text-emerald-600 font-extrabold text-base lg:text-lg">
                                                {{ rupiah24($subdata['realisasi'], 'RP ') }}
                                            </div>
                                            <div class="text-slate-400 text-xxs font-bold uppercase tracking-wider">Realisasi</div>
                                        </div>
                                        <div class="text-slate-200 text-2xl">|</div>
                                        <div class="text-center">
                                            <div class="text-primary-600 font-extrabold text-base lg:text-lg">
                                                {{ rupiah24($subdata['anggaran']) }}
                                            </div>
                                            <div class="text-slate-400 text-xxs font-bold uppercase tracking-wider">Anggaran</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Progress Bar -->
                                    <div class="relative mb-4">
                                        <div class="w-full bg-slate-200/80 rounded-full h-4 overflow-hidden shadow-inner">
                                            <div class="progress-bar h-4 rounded-full transition-all duration-1000 ease-out relative"
                                                 style="width: {{ $subdata['persen'] }}%; background: linear-gradient(90deg, #1a63a6 0%, #074e82 100%);">
                                                <!-- Progress Bar Glow Effect -->
                                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent animate-pulse"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Percentage Badge -->
                                        <div class="absolute -top-2 right-0">
                                            <span class="bg-primary-600 text-white text-xxs font-extrabold px-2.5 py-1 rounded-full shadow-md font-heading">
                                                {{ $subdata['persen'] }}%
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Status Indicator -->
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-slate-400 font-medium">Status:</span>
                                        @if ($subdata['persen'] >= 100)
                                            <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 px-2 py-0.5 rounded-full font-bold text-xxs">
                                                <i class="fas fa-check-circle mr-1"></i>Lengkap
                                            </span>
                                        @elseif ($subdata['persen'] >= 80)
                                            <span class="bg-amber-50 text-amber-700 border border-amber-100 px-2 py-0.5 rounded-full font-bold text-xxs">
                                                <i class="fas fa-clock mr-1"></i>Sedang Berjalan
                                            </span>
                                        @else
                                            <span class="bg-rose-50 text-rose-700 border border-rose-100 px-2 py-0.5 rounded-full font-bold text-xxs">
                                                <i class="fas fa-exclamation-circle mr-1"></i>Perlu Perhatian
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Additional Info -->
        <div class="mt-16 text-center">
            <div class="bg-slate-50/70 backdrop-blur-md rounded-2xl p-8 border border-slate-200/50 shadow-soft">
                <h3 class="text-2xl font-bold text-slate-800 mb-4 font-heading">Tentang Transparansi Anggaran</h3>
                <p class="text-slate-600 max-w-3xl mx-auto leading-relaxed font-sans">
                    Transparansi anggaran merupakan salah satu wujud good governance yang bertujuan untuk memberikan informasi 
                    yang akurat, tepat waktu, dan mudah dipahami oleh masyarakat tentang pengelolaan keuangan {{ ucwords(setting('sebutan_desa')) }}.
                </p>
                <div class="mt-6 flex flex-wrap items-center justify-center gap-6 text-sm text-slate-500 font-medium">
                    <div class="flex items-center">
                        <i class="fas fa-shield-alt text-primary-500 mr-2"></i>
                        <span>Data Terverifikasi</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-sync-alt text-primary-500 mr-2"></i>
                        <span>Update Berkala</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-eye text-primary-500 mr-2"></i>
                        <span>Terbuka Umum</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom progress bar styles */
.progress-bar {
    position: relative;
    background: linear-gradient(90deg, #0284c7 0%, #075985 100%);
    box-shadow: 0 2px 8px rgba(2, 132, 199, 0.3);
    overflow: hidden;
}

.progress-bar::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}

/* Hover effects */
.bg-gradient-to-br:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .grid {
        grid-template-columns: repeat(1, 1fr);
    }
    
    .text-4xl {
        font-size: 2rem;
    }
    
    .p-8 {
        padding: 1.5rem;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Animation for progress bars */
.progress-bar {
    animation: progressGrow 1s ease-out;
}

@keyframes progressGrow {
    from { width: 0%; }
    to { width: var(--progress-width); }
}

/* Status indicator animations */
.bg-green-100,
.bg-yellow-100,
.bg-red-100 {
    animation: statusPulse 2s infinite;
}

@keyframes statusPulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}
</style>
