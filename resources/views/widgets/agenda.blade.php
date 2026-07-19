@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div id="agenda-widget" class="w-full font-sans">
    <!-- Tabs Navigation -->
    <div class="flex border border-slate-150 dark:border-slate-800 mb-4 bg-slate-50 dark:bg-slate-900/40 p-1 rounded-xl">
        @php $hasActive = false; @endphp
        @if (count($hari_ini ?? []) > 0)
            <button onclick="switchAgendaTab('hari-ini')" id="agenda-tab-btn-hari-ini" class="flex-1 py-1.5 text-center text-xs font-bold rounded-lg bg-white dark:bg-slate-800 text-slate-800 dark:text-white shadow-sm transition-all duration-300">
                Hari Ini
            </button>
            @php $hasActive = true; @endphp
        @endif
        @if (count($yad ?? []) > 0)
            <button onclick="switchAgendaTab('yad')" id="agenda-tab-btn-yad" class="flex-1 py-1.5 text-center text-xs font-bold rounded-lg {{ !$hasActive ? 'bg-white dark:bg-slate-800 text-slate-800 dark:text-white shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-350' }} transition-all duration-300">
                Mendatang
            </button>
            @php if (!$hasActive) $hasActive = true; @endphp
        @endif
        @if (count($lama ?? []) > 0)
            <button onclick="switchAgendaTab('lama')" id="agenda-tab-btn-lama" class="flex-1 py-1.5 text-center text-xs font-bold rounded-lg {{ !$hasActive ? 'bg-white dark:bg-slate-800 text-slate-800 dark:text-white shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-350' }} transition-all duration-300">
                Lama
            </button>
        @endif
    </div>

    <!-- Tab Contents -->
    <div class="space-y-1">
        @php $hasActiveContent = false; @endphp
        
        @if (count($hari_ini ?? []) > 0)
            <div id="agenda-content-hari-ini" class="divide-y divide-slate-100/50 dark:divide-slate-800/40">
                @foreach ($hari_ini as $agenda)
                    @php
                        $eventDate = strtotime($agenda['tgl_agenda']);
                        $day = date('d', $eventDate);
                        $month = strtoupper(date('M', $eventDate));
                    @endphp
                    <div class="flex gap-4 py-3.5 border-b border-slate-100/60 dark:border-slate-800/40 last:border-0 hover:bg-slate-50/50 dark:hover:bg-slate-900/10 px-1 rounded-xl transition-all duration-300">
                        <!-- Date Badge -->
                        <div class="flex-shrink-0 w-11 h-14 bg-primary-50 dark:bg-primary-950/40 border border-primary-100 dark:border-primary-900/30 rounded-xl overflow-hidden text-center shadow-sm">
                            <div class="bg-primary-600 dark:bg-primary-500 text-white text-[9px] font-extrabold uppercase py-0.5 tracking-wider">{{ $month }}</div>
                            <div class="text-slate-800 dark:text-white text-lg font-black leading-none mt-1.5 font-mono">{{ $day }}</div>
                        </div>
                        <!-- Event Details -->
                        <div class="min-w-0 flex-1">
                            <h5 class="text-sm font-bold text-slate-800 dark:text-slate-200 leading-snug mb-1 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                <a href="{{ site_url('artikel/' . buat_slug($agenda)) }}">{{ $agenda['judul'] }}</a>
                            </h5>
                            <div class="space-y-1 text-[11px] font-semibold text-slate-550 dark:text-slate-400">
                                @if(!empty($agenda['lokasi_kegiatan']))
                                    <div class="flex items-center gap-1.5">
                                        <i class="fas fa-map-marker-alt text-primary-500 w-3 text-center"></i>
                                        <span class="truncate">{{ $agenda['lokasi_kegiatan'] }}</span>
                                    </div>
                                @endif
                                @if(!empty($agenda['koordinator_kegiatan']))
                                    <div class="flex items-center gap-1.5">
                                        <i class="fas fa-user text-primary-500 w-3 text-center"></i>
                                        <span class="truncate">{{ $agenda['koordinator_kegiatan'] }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @php $hasActiveContent = true; @endphp
        @endif
        
        @if (count($yad ?? []) > 0)
            <div id="agenda-content-yad" class="divide-y divide-slate-100/50 dark:divide-slate-800/40 {{ $hasActiveContent ? 'hidden' : '' }}">
                @foreach ($yad as $agenda)
                    @php
                        $eventDate = strtotime($agenda['tgl_agenda']);
                        $day = date('d', $eventDate);
                        $month = strtoupper(date('M', $eventDate));
                    @endphp
                    <div class="flex gap-4 py-3.5 border-b border-slate-100/60 dark:border-slate-800/40 last:border-0 hover:bg-slate-50/50 dark:hover:bg-slate-900/10 px-1 rounded-xl transition-all duration-300">
                        <!-- Date Badge -->
                        <div class="flex-shrink-0 w-11 h-14 bg-primary-50 dark:bg-primary-950/40 border border-primary-100 dark:border-primary-900/30 rounded-xl overflow-hidden text-center shadow-sm">
                            <div class="bg-primary-600 dark:bg-primary-500 text-white text-[9px] font-extrabold uppercase py-0.5 tracking-wider">{{ $month }}</div>
                            <div class="text-slate-800 dark:text-white text-lg font-black leading-none mt-1.5 font-mono">{{ $day }}</div>
                        </div>
                        <!-- Event Details -->
                        <div class="min-w-0 flex-1">
                            <h5 class="text-sm font-bold text-slate-800 dark:text-slate-200 leading-snug mb-1 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                <a href="{{ site_url('artikel/' . buat_slug($agenda)) }}">{{ $agenda['judul'] }}</a>
                            </h5>
                            <div class="space-y-1 text-[11px] font-semibold text-slate-550 dark:text-slate-400">
                                @if(!empty($agenda['lokasi_kegiatan']))
                                    <div class="flex items-center gap-1.5">
                                        <i class="fas fa-map-marker-alt text-primary-500 w-3 text-center"></i>
                                        <span class="truncate">{{ $agenda['lokasi_kegiatan'] }}</span>
                                    </div>
                                @endif
                                @if(!empty($agenda['koordinator_kegiatan']))
                                    <div class="flex items-center gap-1.5">
                                        <i class="fas fa-user text-primary-500 w-3 text-center"></i>
                                        <span class="truncate">{{ $agenda['koordinator_kegiatan'] }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @php if (!$hasActiveContent) $hasActiveContent = true; @endphp
        @endif

        @if (count($lama ?? []) > 0)
            <div id="agenda-content-lama" class="max-h-[300px] overflow-y-auto pr-1 divide-y divide-slate-100/50 dark:divide-slate-800/40 {{ $hasActiveContent ? 'hidden' : '' }}">
                @foreach ($lama as $agenda)
                    @php
                        $eventDate = strtotime($agenda['tgl_agenda']);
                        $day = date('d', $eventDate);
                        $month = strtoupper(date('M', $eventDate));
                    @endphp
                    <div class="flex gap-4 py-3.5 border-b border-slate-100/60 dark:border-slate-800/40 last:border-0 hover:bg-slate-50/50 dark:hover:bg-slate-900/10 px-1 rounded-xl transition-all duration-300">
                        <!-- Date Badge -->
                        <div class="flex-shrink-0 w-11 h-14 bg-slate-100 dark:bg-slate-850 border border-slate-200 dark:border-slate-700/50 rounded-xl overflow-hidden text-center shadow-sm">
                            <div class="bg-slate-500 dark:bg-slate-600 text-white text-[9px] font-extrabold uppercase py-0.5 tracking-wider">{{ $month }}</div>
                            <div class="text-slate-600 dark:text-slate-300 text-lg font-black leading-none mt-1.5 font-mono">{{ $day }}</div>
                        </div>
                        <!-- Event Details -->
                        <div class="min-w-0 flex-1">
                            <h5 class="text-sm font-bold text-slate-800 dark:text-slate-200 leading-snug mb-1 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                <a href="{{ site_url('artikel/' . buat_slug($agenda)) }}">{{ $agenda['judul'] }}</a>
                            </h5>
                            <div class="space-y-1 text-[11px] font-semibold text-slate-550 dark:text-slate-400">
                                @if(!empty($agenda['lokasi_kegiatan']))
                                    <div class="flex items-center gap-1.5">
                                        <i class="fas fa-map-marker-alt text-slate-400 w-3 text-center"></i>
                                        <span class="truncate">{{ $agenda['lokasi_kegiatan'] }}</span>
                                    </div>
                                @endif
                                @if(!empty($agenda['koordinator_kegiatan']))
                                    <div class="flex items-center gap-1.5">
                                        <i class="fas fa-user text-slate-400 w-3 text-center"></i>
                                        <span class="truncate">{{ $agenda['koordinator_kegiatan'] }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if (count(array_merge($hari_ini ?? [], $yad ?? [], $lama ?? [])) == 0)
            <p class="text-slate-400 dark:text-slate-500 text-sm italic py-6 text-center font-medium">Belum ada agenda kegiatan.</p>
        @endif
    </div>
</div>

<script>
    function switchAgendaTab(tabId) {
        const tabs = ['hari-ini', 'yad', 'lama'];
        tabs.forEach(t => {
            const btn = document.getElementById('agenda-tab-btn-' + t);
            if (btn) {
                if (t === tabId) {
                    btn.className = "flex-1 py-1.5 text-center text-xs font-bold rounded-lg bg-white dark:bg-slate-800 text-slate-800 dark:text-white shadow-sm transition-all duration-300";
                } else {
                    btn.className = "flex-1 py-1.5 text-center text-xs font-bold rounded-lg text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-350 transition-all duration-300";
                }
            }
            const c = document.getElementById('agenda-content-' + t);
            if (c) {
                if (t === tabId) {
                    c.classList.remove('hidden');
                } else {
                    c.classList.add('hidden');
                }
            }
        });
    }
</script>
