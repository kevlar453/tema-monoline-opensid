<!-- Minimalist Sidebar Container (Monoline Style) -->
<div class="space-y-[30px] pb-12">
    <!-- Jam Widget (Custom Analog Clock) -->
    @if (theme_config('jam', true))
        <div class="bg-white p-[30px] rounded-[10px] border-t-[3px] border-[#ffaa17] shadow-[0_10px_40px_-10px_rgba(0,64,128,0.2)] mb-[30px]">
            @includeIf('theme::widgets.jam', ['judul_widget' => ['judul_widget' => 'Waktu Sistem']])
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
            
            <div class="bg-white p-[30px] rounded-[10px] border-t-[3px] border-[#ffaa17] shadow-[0_10px_40px_-10px_rgba(0,64,128,0.2)] mb-[30px]">
                <h4 class="border-b border-[#eee] text-[#1b2032] text-[20px] font-semibold mb-[15px] pb-[10px] capitalize">{{ $judul_widget['judul_widget'] }}</h4>
                <div class="w-full">
                    @if ($widget['jenis_widget'] == 3)
                        <div class="prose prose-sm max-w-none text-slate-600 prose-a:text-[#ffaa17] hover:prose-a:text-[#1b2032] overflow-hidden">
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
    <div class="bg-white p-[30px] rounded-[10px] border-t-[3px] border-[#ffaa17] shadow-[0_10px_40px_-10px_rgba(0,64,128,0.2)] mb-[30px]">
        <h4 class="border-b border-[#eee] text-[#1b2032] text-[20px] font-semibold mb-[15px] pb-[10px] capitalize">Menu Pintas</h4>
        
        <ul class="m-0 p-0 list-none">
            <li>
                <a href="{{ site_url('data-wilayah') }}" class="block text-[#1b2032] text-[14px] py-[5px] font-normal font-sans hover:text-[#ffaa17] transition-colors">
                    <i class="ti-arrow-right mr-[10px]"></i> Data Wilayah
                </a>
            </li>
            <li>
                <a href="{{ site_url('data-statistik') }}" class="block text-[#1b2032] text-[14px] py-[5px] font-normal font-sans hover:text-[#ffaa17] transition-colors">
                    <i class="ti-arrow-right mr-[10px]"></i> Statistik Desa
                </a>
            </li>
            <li>
                <a href="{{ site_url('galeri') }}" class="block text-[#1b2032] text-[14px] py-[5px] font-normal font-sans hover:text-[#ffaa17] transition-colors">
                    <i class="ti-arrow-right mr-[10px]"></i> Galeri Foto
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
