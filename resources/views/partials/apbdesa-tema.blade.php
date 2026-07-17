@php 
    defined('BASEPATH') || exit('No direct script access allowed'); 
    
    $chartData = [];
    foreach ($data_widget as $subdata_name => $subdatas) {
        $items = [];
        foreach ($subdatas as $key => $subdata) {
            if (is_array($subdata) && $subdata['judul'] != null && $key != 'laporan' && ($subdata['realisasi'] != 0 || $subdata['anggaran'] != 0)) {
                $items[] = [
                    'name' => str_replace('Desa', ucwords(setting('sebutan_desa')), strip_tags($subdata['judul'])),
                    'y' => (float) $subdata['anggaran'],
                    'realisasi' => (float) $subdata['realisasi'],
                    'formatted_anggaran' => rupiah24($subdata['anggaran']),
                    'formatted_realisasi' => rupiah24($subdata['realisasi'], 'Rp '),
                ];
            }
        }
        $chartData[$subdata_name] = [
            'title' => $subdatas['laporan'],
            'items' => $items
        ];
    }
@endphp

<!-- APBDesa Transparansi Section -->
<div class="bg-transparent py-12" id="transparansi-footer">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-slate-800 dark:text-slate-100 mb-4 font-heading tracking-tight">Transparansi Anggaran</h2>
            <div class="w-24 h-1.5 bg-primary-600 mx-auto rounded-full"></div>
            <p class="text-lg text-slate-600 dark:text-slate-400 mt-4 max-w-2xl mx-auto font-sans leading-relaxed">
                Informasi lengkap tentang realisasi dan anggaran {{ ucwords(setting('sebutan_desa')) }} untuk meningkatkan transparansi dan akuntabilitas
            </p>
        </div>
        
        <!-- APBDesa Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($data_widget as $subdata_name => $subdatas)
                <div class="bg-white/80 dark:bg-slate-900/40 backdrop-blur-lg rounded-2xl border border-slate-200/50 dark:border-slate-800/50 p-8 shadow-soft hover:shadow-md hover:border-primary-100 dark:hover:border-primary-900 transition-all duration-300">
                    <!-- Header -->
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 bg-primary-50 dark:bg-primary-950/30 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-primary-100 dark:border-primary-900">
                            <i class="fas fa-chart-pie text-primary-600 dark:text-primary-400 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-200 mb-2 font-heading">
                            {{ \Illuminate\Support\Str::of($subdatas['laporan'])->when(setting('sebutan_desa') != 'desa', function (\Illuminate\Support\Stringable $string) {
                                return $string->replace('Des', \Illuminate\Support\Str::of(setting('sebutan_desa'))->substr(0, 1)->ucfirst());
                            }) }}
                        </h3>
                        <div class="w-16 h-1 bg-primary-400 mx-auto rounded-full"></div>
                    </div>

                    <!-- Donut Chart Container -->
                    <div id="chart-{{ $subdata_name }}" class="w-full h-[200px] mb-6 flex justify-center items-center overflow-hidden"></div>
                    
                    <!-- Subtitle -->
                    <div class="text-center mb-6">
                        <h4 class="text-xs font-extrabold text-slate-500 dark:text-slate-400 uppercase tracking-widest font-heading">Realisasi | Anggaran</h4>
                    </div>
                    
                    <!-- Progress Items -->
                    <div class="space-y-6">
                        @foreach ($subdatas as $key => $subdata)
                            @continue(!is_array($subdata))
                            @if ($subdata['judul'] != null and $key != 'laporan' and $subdata['realisasi'] != 0 or $subdata['anggaran'] != 0)
                                <div class="bg-slate-50/50 dark:bg-slate-950/40 rounded-xl p-5 border border-slate-100 dark:border-slate-800/60 hover:border-slate-200 dark:hover:border-slate-700 transition-all duration-300">
                                    <!-- Title -->
                                    <h5 class="text-sm font-bold text-slate-800 dark:text-slate-200 mb-4 leading-tight font-heading">
                                        {{ \Illuminate\Support\Str::of($subdata['judul'])->title()->whenEndsWith('Desa', function (\Illuminate\Support\Stringable $string) {
                                                if (!in_array($string, ['Dana Desa'])) {
                                                    return $string->replace('Desa', setting('sebutan_desa'));
                                                }
                                            })->title() }}
                                    </h5>
                                    
                                    <!-- Amounts -->
                                    <div class="flex justify-between items-center mb-4 text-sm">
                                        <div class="text-center">
                                            <div class="text-emerald-600 dark:text-emerald-400 font-extrabold text-base lg:text-lg">
                                                {{ rupiah24($subdata['realisasi'], 'RP ') }}
                                            </div>
                                            <div class="text-slate-400 dark:text-slate-500 text-xxs font-bold uppercase tracking-wider">Realisasi</div>
                                        </div>
                                        <div class="text-slate-200 dark:text-slate-800 text-2xl">|</div>
                                        <div class="text-center">
                                            <div class="text-primary-600 dark:text-primary-400 font-extrabold text-base lg:text-lg">
                                                {{ rupiah24($subdata['anggaran']) }}
                                            </div>
                                            <div class="text-slate-400 dark:text-slate-500 text-xxs font-bold uppercase tracking-wider">Anggaran</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Progress Bar -->
                                    <div class="relative mb-4">
                                        <div class="w-full bg-slate-200/80 dark:bg-slate-800/80 rounded-full h-4 overflow-hidden shadow-inner">
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
                                        <span class="text-slate-400 dark:text-slate-500 font-medium">Status:</span>
                                        @if ($subdata['persen'] >= 100)
                                            <span class="bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-900/50 px-2 py-0.5 rounded-full font-bold text-xxs flex items-center gap-1">
                                                <i class="fas fa-check-circle text-[10px]"></i>Lengkap
                                            </span>
                                        @elseif ($subdata['persen'] >= 80)
                                            <span class="bg-amber-50 dark:bg-amber-950/50 text-amber-700 dark:text-amber-400 border border-amber-100 dark:border-amber-900/50 px-2 py-0.5 rounded-full font-bold text-xxs flex items-center gap-1">
                                                <i class="fas fa-clock text-[10px]"></i>Sedang Berjalan
                                            </span>
                                        @else
                                            <span class="bg-rose-50 dark:bg-rose-950/50 text-rose-700 dark:text-rose-400 border border-rose-100 dark:border-rose-900/50 px-2 py-0.5 rounded-full font-bold text-xxs flex items-center gap-1">
                                                <i class="fas fa-exclamation-circle text-[10px]"></i>Perlu Perhatian
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
            <div class="bg-slate-50/70 dark:bg-slate-900/30 backdrop-blur-md rounded-2xl p-8 border border-slate-200/50 dark:border-slate-800/50 shadow-soft">
                <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-200 mb-4 font-heading">Tentang Transparansi Anggaran</h3>
                <p class="text-slate-600 dark:text-slate-400 max-w-3xl mx-auto leading-relaxed font-sans text-sm md:text-base">
                    Transparansi anggaran merupakan salah satu wujud good governance yang bertujuan untuk memberikan informasi 
                    yang akurat, tepat waktu, dan mudah dipahami oleh masyarakat tentang pengelolaan keuangan {{ ucwords(setting('sebutan_desa')) }}.
                </p>
                <div class="mt-6 flex flex-wrap items-center justify-center gap-6 text-sm text-slate-500 dark:text-slate-400 font-medium">
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
    box-shadow: 0 2px 8px rgba(26, 99, 166, 0.2);
    overflow: hidden;
}

.progress-bar::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    animation: shimmer 2.5s infinite;
}

@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}
</style>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    const apbdesData = @json($chartData);
    
    // Theme colors matching Monoline style
    const colorsLight = ['#1a63a6', '#0d9488', '#ffb900', '#f43f5e', '#8b5cf6', '#ec4899', '#f97316'];
    const colorsDark = ['#38bdf8', '#2dd4bf', '#fbbf24', '#f43f5e', '#a78bfa', '#f472b6', '#fb923c'];

    function renderCharts() {
        const isDark = document.documentElement.classList.contains('dark');
        const themeColors = isDark ? colorsDark : colorsLight;
        const textColor = isDark ? '#cbd5e1' : '#334155';
        
        Object.keys(apbdesData).forEach(key => {
            const chartId = 'chart-' + key;
            const container = document.getElementById(chartId);
            if (!container) return;
            
            const data = apbdesData[key].items.map(item => ({
                name: item.name,
                y: item.y,
                realisasi: item.realisasi,
                formatted_anggaran: item.formatted_anggaran,
                formatted_realisasi: item.formatted_realisasi
            }));
            
            if (data.length === 0) {
                container.innerHTML = `<div class="text-slate-400 dark:text-slate-500 text-xs italic">Tidak ada rincian anggaran</div>`;
                return;
            }

            Highcharts.chart(chartId, {
                chart: {
                    type: 'pie',
                    backgroundColor: 'transparent',
                    height: 200,
                    margin: [0, 0, 0, 0]
                },
                title: {
                    text: ''
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    pie: {
                        innerSize: '65%',
                        depth: 0,
                        colors: themeColors,
                        borderWidth: isDark ? 2 : 1,
                        borderColor: isDark ? '#0f172a' : '#ffffff',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: false
                    }
                },
                tooltip: {
                    backgroundColor: isDark ? '#1e293b' : '#ffffff',
                    style: {
                        color: textColor,
                        fontFamily: 'Inter, sans-serif',
                        fontSize: '11px'
                    },
                    borderWidth: 1,
                    borderColor: isDark ? '#334155' : '#e2e8f0',
                    formatter: function() {
                        return `<b>${this.point.name}</b><br/>Anggaran: <b>${this.point.formatted_anggaran}</b><br/>Realisasi: <b>${this.point.formatted_realisasi} (${this.percentage.toFixed(1)}%)</b>`;
                    }
                },
                series: [{
                    name: 'Anggaran',
                    data: data
                }]
            });
        });
    }

    renderCharts();
    
    // Listen to theme change
    window.addEventListener('darkModeChanged', function() {
        renderCharts();
    });
});
</script>
