<!-- Minimalist Sidebar Container (Monoline Style) -->
<div class="space-y-[30px] pb-12">
    <!-- Jam Widget (Custom Analog Clock) -->
    @if (theme_config('jam', true))
        <div class="bg-white/80 dark:bg-slate-900/60 backdrop-blur-lg p-6 rounded-2xl border border-slate-200/50 dark:border-slate-800 border-t-[3px] border-t-primary-600 dark:border-t-primary-500 shadow-soft mb-6 hover:shadow-medium transition-all duration-300">
            @includeIf('theme::widgets.jam', ['judul_widget' => ['judul_widget' => 'Waktu Sistem']])
        </div>
    @endif

    <!-- Iklan Sidebar -->
    @php
        $iklan_sidebar = theme_config('iklan_sidebar');
        $iklan_sidebar_clean = trim(preg_replace('/<!--(.*?)-->/s', '', $iklan_sidebar));
    @endphp
    @if (!empty($iklan_sidebar_clean))
        <div class="bg-white/80 dark:bg-slate-900/60 backdrop-blur-lg p-6 rounded-2xl border border-slate-200/50 dark:border-slate-800 border-t-[3px] border-t-primary-600 dark:border-t-primary-500 shadow-soft mb-6 hover:shadow-medium transition-all duration-300 flex flex-col items-center">
            <h4 class="text-[17px] font-heading font-extrabold mb-[18px] pb-[10px] w-full capitalize tracking-wider text-slate-800 dark:text-white relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-10 after:h-[3px] after:bg-primary-500 rounded-full border-b border-slate-100 dark:border-slate-800/40">Sponsor</h4>
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
            
            <div class="bg-white/80 dark:bg-slate-900/60 backdrop-blur-lg p-6 rounded-2xl border border-slate-200/50 dark:border-slate-800 border-t-[3px] border-t-primary-600 dark:border-t-primary-500 shadow-soft mb-6 hover:shadow-medium transition-all duration-300">
                <h4 class="text-[17px] font-heading font-extrabold mb-[18px] pb-[10px] capitalize tracking-wider text-slate-800 dark:text-white relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-10 after:h-[3px] after:bg-primary-500 rounded-full border-b border-slate-100 dark:border-slate-800/40">{{ $judul_widget['judul_widget'] }}</h4>
                <div class="w-full">
                    @if ($widget['jenis_widget'] == 3)
                        <div class="prose prose-sm max-w-none text-slate-600 dark:text-slate-350 dark:prose-invert prose-a:text-[#1b2032] dark:prose-a:text-primary-300 hover:prose-a:text-primary-600 dark:hover:prose-a:text-primary-200 overflow-hidden">
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
    <div class="bg-white/80 dark:bg-slate-900/60 backdrop-blur-lg p-6 rounded-2xl border border-slate-200/50 dark:border-slate-800 border-t-[3px] border-t-primary-600 dark:border-t-primary-500 shadow-soft mb-6 hover:shadow-medium transition-all duration-300">
        <h4 class="text-[17px] font-heading font-extrabold mb-[18px] pb-[10px] capitalize tracking-wider text-slate-800 dark:text-white relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-10 after:h-[3px] after:bg-primary-500 border-b border-slate-100 dark:border-slate-800/40">Menu Pintas</h4>
        
        <ul class="m-0 p-0 list-none space-y-2">
            <li>
                <a href="{{ site_url('data-wilayah') }}" class="flex items-center text-slate-600 dark:text-slate-300 text-sm font-semibold hover:text-primary-600 dark:hover:text-primary-400 transition-colors py-1">
                    <i class="fas fa-chevron-right mr-[10px] text-xs text-primary-500 dark:text-primary-400"></i> Data Wilayah
                </a>
            </li>
            <li>
                <a href="{{ site_url('data-statistik') }}" class="flex items-center text-slate-600 dark:text-slate-300 text-sm font-semibold hover:text-primary-600 dark:hover:text-primary-400 transition-colors py-1">
                    <i class="fas fa-chevron-right mr-[10px] text-xs text-primary-500 dark:text-primary-400"></i> Statistik Desa
                </a>
            </li>
            <li>
                <a href="{{ site_url('galeri') }}" class="flex items-center text-slate-600 dark:text-slate-300 text-sm font-semibold hover:text-primary-600 dark:hover:text-primary-400 transition-colors py-1">
                    <i class="fas fa-chevron-right mr-[10px] text-xs text-primary-500 dark:text-primary-400"></i> Galeri Foto
                </a>
            </li>
        </ul>
    </div>

    <!-- Hari Libur Nasional Widget -->
    @includeIf('theme::partials.holiday_helper')
    @php
        $upcomingHolidays = [];
        if (class_exists('HolidayHelper')) {
            $allHolidays = HolidayHelper::getHolidays(date('Y'));
            $today = date('Y-m-d');
            // Filter future holidays
            $futureHolidays = array_filter($allHolidays, function($h) use ($today) {
                return $h['date'] >= $today;
            });
            // Take the next 5 holidays
            $upcomingHolidays = array_slice($futureHolidays, 0, 5);
        }
    @endphp
    @if (!empty($upcomingHolidays))
        <div class="bg-white/80 dark:bg-slate-900/60 backdrop-blur-lg p-6 rounded-2xl border border-slate-200/50 dark:border-slate-800 border-t-[3px] border-t-primary-600 dark:border-t-primary-500 shadow-soft mb-6 hover:shadow-medium transition-all duration-300">
            <h4 class="text-[17px] font-heading font-extrabold mb-[18px] pb-[10px] capitalize tracking-wider text-slate-800 dark:text-white relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-10 after:h-[3px] after:bg-primary-500 border-b border-slate-100 dark:border-slate-800/40">Libur Nasional</h4>
            <div class="divide-y divide-slate-100 dark:divide-slate-800/60">
                @foreach ($upcomingHolidays as $h)
                    @php
                        $holidayDate = new DateTime($h['date']);
                        $now = new DateTime();
                        $diff = $now->diff($holidayDate)->days;
                        
                        $daysLeftText = '';
                        if ($h['date'] === date('Y-m-d')) {
                            $daysLeftText = 'Hari Ini';
                        } elseif ($diff === 0) {
                            $daysLeftText = 'Besok';
                        } else {
                            $daysLeftText = ($diff + 1) . ' Hari Lagi';
                        }
                    @endphp
                    <div class="py-3 flex items-start justify-between gap-3 first:pt-1 last:pb-1 hover:bg-slate-50/50 dark:hover:bg-slate-900/20 px-1 rounded-xl transition-colors duration-200">
                        <div class="min-w-0 flex-1">
                            <h5 class="text-xs font-bold text-slate-800 dark:text-slate-200 leading-snug line-clamp-2">{{ $h['name'] }}</h5>
                            <span class="text-[10px] font-semibold text-slate-400 dark:text-slate-500 mt-1 block">{{ tgl_indo($h['date']) }}</span>
                        </div>
                        <span class="bg-primary-50 dark:bg-primary-950/40 text-primary-600 dark:text-primary-400 text-[10px] font-extrabold px-2.5 py-1 rounded-full whitespace-nowrap shadow-sm border border-primary-100/50 dark:border-primary-900/30">
                            {{ $daysLeftText }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
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
