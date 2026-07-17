<!-- Custom Jam Widget for Monoline -->
<div class="flex flex-col items-center justify-center relative overflow-hidden group mb-10 w-full">
    <!-- Decorative background element -->
    <div class="absolute w-full h-full bg-slate-50/50 rounded-full blur-3xl opacity-50 group-hover:opacity-80 transition-opacity duration-500"></div>
    
    <h4 class="text-lg font-semibold text-slate-800 mb-6 capitalize relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-1/2 after:-translate-x-1/2 after:w-10 after:h-[3px] after:bg-primary-500 text-center w-full">{{ $judul_widget['judul_widget'] ?? 'Waktu Sistem' }}</h4>
    
    <!-- Analog Clock -->
    <div class="relative w-40 h-40 rounded-full border-[6px] border-slate-100 bg-white shadow-inner mb-6 flex items-center justify-center z-10">
        <!-- Markers -->
        @for($i=0; $i<12; $i++)
            <div class="absolute w-full h-full" style="transform: rotate({{ $i * 30 }}deg);">
                <div class="mx-auto w-1 {{ $i % 3 == 0 ? 'h-3 bg-primary-500' : 'h-1.5 bg-slate-300' }} rounded-full mt-1"></div>
            </div>
        @endfor
        
        <!-- Hands -->
        <div id="hour-hand" class="absolute w-1.5 h-10 bg-slate-800 rounded-full origin-bottom" style="bottom: 50%; transform: rotate(0deg); transition: transform 0.05s cubic-bezier(0.4, 2.08, 0.55, 0.44);"></div>
        <div id="min-hand" class="absolute w-1 h-14 bg-slate-500 rounded-full origin-bottom" style="bottom: 50%; transform: rotate(0deg); transition: transform 0.05s cubic-bezier(0.4, 2.08, 0.55, 0.44);"></div>
        <div id="sec-hand" class="absolute w-0.5 h-16 bg-red-500 rounded-full origin-bottom" style="bottom: 50%; transform: rotate(0deg); transition: transform 0.05s cubic-bezier(0.4, 2.08, 0.55, 0.44);"></div>
        
        <!-- Center Dot -->
        <div class="absolute w-3 h-3 bg-slate-800 rounded-full z-20 border-2 border-white"></div>
    </div>
    
    <!-- Digital Date/Time -->
    <div class="text-center relative z-10">
        <div class="text-3xl font-bold text-slate-800 font-heading tracking-tight mb-1" id="digital-time">00:00</div>
        <div class="text-sm font-medium text-slate-500" id="digital-date">{{ date('l, d F Y') }}</div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hourHand = document.getElementById('hour-hand');
    const minHand = document.getElementById('min-hand');
    const secHand = document.getElementById('sec-hand');
    const digitalTime = document.getElementById('digital-time');
    const digitalDate = document.getElementById('digital-date');
    
    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    function setDate() {
        const now = new Date();
        
        const seconds = now.getSeconds();
        const mins = now.getMinutes();
        const hours = now.getHours();
        
        const secondsDegrees = (seconds / 60) * 360;
        const minsDegrees = ((mins / 60) * 360) + ((seconds/60)*6);
        const hoursDegrees = ((hours / 12) * 360) + ((mins/60)*30);
        
        if (secHand) secHand.style.transform = `rotate(${secondsDegrees}deg)`;
        if (minHand) minHand.style.transform = `rotate(${minsDegrees}deg)`;
        if (hourHand) hourHand.style.transform = `rotate(${hoursDegrees}deg)`;
        
        if (digitalTime) {
            digitalTime.textContent = `${hours.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
        
        if (digitalDate) {
            digitalDate.textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
        }
    }

    setInterval(setDate, 1000);
    setDate();
});
</script>
