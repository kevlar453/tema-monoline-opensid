@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<!-- APBDesa Transparansi Section -->
<div class="bg-white py-16" id="transparansi-footer">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Transparansi Anggaran</h2>
            <div class="w-32 h-1 bg-primary-600 mx-auto rounded-full"></div>
            <p class="text-lg text-gray-600 mt-4 max-w-2xl mx-auto">
                Informasi lengkap tentang realisasi dan anggaran {{ ucwords(setting('sebutan_desa')) }} untuk meningkatkan transparansi dan akuntabilitas
            </p>
        </div>
        
        <!-- APBDesa Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($data_widget as $subdata_name => $subdatas)
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-200 p-8 hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-chart-pie text-primary-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">
                            {{ \Illuminate\Support\Str::of($subdatas['laporan'])->when(setting('sebutan_desa') != 'desa', function (\Illuminate\Support\Stringable $string) {
                                return $string->replace('Des', \Illuminate\Support\Str::of(setting('sebutan_desa'))->substr(0, 1)->ucfirst());
                            }) }}
                        </h3>
                        <div class="w-20 h-0.5 bg-primary-400 mx-auto rounded-full"></div>
                    </div>
                    
                    <!-- Subtitle -->
                    <div class="text-center mb-8">
                        <h4 class="text-lg font-semibold text-gray-700">Realisasi | Anggaran</h4>
                    </div>
                    
                    <!-- Progress Items -->
                    <div class="space-y-6">
                        @foreach ($subdatas as $key => $subdata)
                            @continue(!is_array($subdata))
                            @if ($subdata['judul'] != null and $key != 'laporan' and $subdata['realisasi'] != 0 or $subdata['anggaran'] != 0)
                                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                                    <!-- Title -->
                                    <h5 class="text-sm font-medium text-gray-900 mb-4 leading-tight">
                                        {{ \Illuminate\Support\Str::of($subdata['judul'])->title()->whenEndsWith('Desa', function (\Illuminate\Support\Stringable $string) {
                                                if (!in_array($string, ['Dana Desa'])) {
                                                    return $string->replace('Desa', setting('sebutan_desa'));
                                                }
                                            })->title() }}
                                    </h5>
                                    
                                    <!-- Amounts -->
                                    <div class="flex justify-between items-center mb-4 text-sm">
                                        <div class="text-center">
                                            <div class="text-green-600 font-bold text-lg">
                                                {{ rupiah24($subdata['realisasi'], 'RP ') }}
                                            </div>
                                            <div class="text-green-500 text-xs">Realisasi</div>
                                        </div>
                                        <div class="text-gray-300 text-2xl">|</div>
                                        <div class="text-center">
                                            <div class="text-blue-600 font-bold text-lg">
                                                {{ rupiah24($subdata['anggaran']) }}
                                            </div>
                                            <div class="text-blue-500 text-xs">Anggaran</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Progress Bar -->
                                    <div class="relative mb-4">
                                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden shadow-inner">
                                            <div class="progress-bar h-4 rounded-full transition-all duration-1000 ease-out relative"
                                                 style="width: {{ $subdata['persen'] }}%; background: linear-gradient(90deg, #0284c7 0%, #075985 100%);">
                                                <!-- Progress Bar Glow Effect -->
                                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent animate-pulse"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Percentage Badge -->
                                        <div class="absolute -top-2 right-0">
                                            <span class="bg-primary-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                                {{ $subdata['persen'] }}%
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Status Indicator -->
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-gray-500">Status:</span>
                                        @if ($subdata['persen'] >= 100)
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full font-medium">
                                                <i class="fas fa-check-circle mr-1"></i>Lengkap
                                            </span>
                                        @elseif ($subdata['persen'] >= 80)
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full font-medium">
                                                <i class="fas fa-clock mr-1"></i>Sedang Berjalan
                                            </span>
                                        @else
                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full font-medium">
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
            <div class="bg-gray-50 rounded-2xl p-8 border border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Tentang Transparansi Anggaran</h3>
                <p class="text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Transparansi anggaran merupakan salah satu wujud good governance yang bertujuan untuk memberikan informasi 
                    yang akurat, tepat waktu, dan mudah dipahami oleh masyarakat tentang pengelolaan keuangan {{ ucwords(setting('sebutan_desa')) }}.
                </p>
                <div class="mt-6 flex items-center justify-center space-x-4 text-sm text-gray-500">
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
