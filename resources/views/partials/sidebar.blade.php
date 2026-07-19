<!-- Minimalist Sidebar Container (Monoline Style) -->
<div class="space-y-[30px] pb-12">
    <!-- Jam Widget (Custom Analog Clock) -->
    @if (theme_config('jam', true))
        <div class="bg-white/80 backdrop-blur-lg p-6 rounded-2xl border border-slate-200/50 border-t-[3px] border-t-primary-600 shadow-soft mb-6 hover:shadow-medium transition-all duration-300">
            @includeIf('theme::widgets.jam', ['judul_widget' => ['judul_widget' => 'Waktu Sistem']])
        </div>
    @endif

    <!-- Iklan Sidebar -->
    @php
        $iklan_sidebar = theme_config('iklan_sidebar');
        $iklan_sidebar_clean = trim(preg_replace('/<!--(.*?)-->/s', '', $iklan_sidebar));
    @endphp
    @if (!empty($iklan_sidebar_clean))
        <div class="bg-white/80 backdrop-blur-lg p-6 rounded-2xl border border-slate-200/50 border-t-[3px] border-t-primary-600 shadow-soft mb-6 hover:shadow-medium transition-all duration-300 flex flex-col items-center">
            <h4 class="border-b border-slate-100 text-slate-800 text-[18px] font-heading font-extrabold mb-[15px] pb-[10px] w-full capitalize tracking-wider">Sponsor</h4>
            <div class="w-full flex justify-center overflow-hidden adsense-sidebar-container">
                {!! $iklan_sidebar !!}
            </div>
        </div>
    @endif

    <!-- Widget Aktif -->
    @if ($widgetAktif)
        @foreach ($widgetAktif as $widget)
            @php
                $judul_widget = [
                    'judul_widget' => str_replace('Desa', ucwords(setting('sebutan_desa')), strip_tags($widget['judul'])),
                ];
            @endphp
            
            <div class="bg-white/80 backdrop-blur-lg p-6 rounded-2xl border border-slate-200/50 border-t-[3px] border-t-primary-600 shadow-soft mb-6 hover:shadow-medium transition-all duration-300">
                <h4 class="border-b border-slate-100 text-slate-800 text-[18px] font-heading font-extrabold mb-[15px] pb-[10px] capitalize tracking-wider">{{ $judul_widget['judul_widget'] }}</h4>
                <div class="w-full">
                    @if ($widget['jenis_widget'] == 3)
                        <div class="prose prose-sm max-w-none text-slate-600 prose-a:text-[#1b2032] hover:prose-a:text-primary-600 overflow-hidden">
                            {!! html_entity_decode($widget['isi']) !!}
                        </div>
                    @else
                        @includeIf("theme::widgets.{$widget['isi']}", $judul_widget)
                    @endif
                </div>
            </div>
        @endforeach
    @endif

    <!-- Quick Links Section -->
    <div class="bg-white/80 backdrop-blur-lg p-6 rounded-2xl border border-slate-200/50 border-t-[3px] border-t-primary-600 shadow-soft mb-6 hover:shadow-medium transition-all duration-300">
        <h4 class="border-b border-slate-100 text-slate-800 text-[18px] font-heading font-extrabold mb-[15px] pb-[10px] capitalize tracking-wider font-heading">Menu Pintas</h4>
        
        <ul class="m-0 p-0 list-none space-y-2">
            <li>
                <a href="{{ site_url('data-wilayah') }}" class="flex items-center text-slate-600 text-sm font-semibold hover:text-primary-600 transition-colors py-1">
                    <i class="fas fa-chevron-right mr-[10px] text-xs text-primary-500"></i> Data Wilayah
                </a>
            </li>
            <li>
                <a href="{{ site_url('data-statistik') }}" class="flex items-center text-slate-600 text-sm font-semibold hover:text-primary-600 transition-colors py-1">
                    <i class="fas fa-chevron-right mr-[10px] text-xs text-primary-500"></i> Statistik Desa
                </a>
            </li>
            <li>
                <a href="{{ site_url('galeri') }}" class="flex items-center text-slate-600 text-sm font-semibold hover:text-primary-600 transition-colors py-1">
                    <i class="fas fa-chevron-right mr-[10px] text-xs text-primary-500"></i> Galeri Foto
                </a>
            </li>
        </ul>
    </div>
</div>

<script>
// Jam Live
setInterval(() => {
    const jamEl = document.getElementById('jam');
    if(jamEl) {
        const d = new Date();
        jamEl.textContent = d.toLocaleTimeString('id-ID', { hour12: false, hour: '2-digit', minute: '2-digit' });
    }
}, 1000);
</script>
