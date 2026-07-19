<!-- Custom Jam Widget for Monoline -->
<div class="flex flex-col items-center justify-center relative overflow-hidden group w-full pt-2">
    <!-- Analog Clock -->
    <div class="relative w-44 h-44 rounded-full border-4 border-slate-200/60 dark:border-slate-800/80 bg-white/60 dark:bg-slate-950/40 backdrop-blur-md shadow-[inset_0_2px_10px_rgba(0,0,0,0.05),0_10px_25px_rgba(0,0,0,0.05)] dark:shadow-[inset_0_2px_10px_rgba(255,255,255,0.02),0_15px_30px_rgba(0,0,0,0.3)] mb-6 flex items-center justify-center z-10 transition-all duration-300 group-hover:scale-[1.02] group-hover:border-primary-500/40">
        <!-- Markers -->
        @for($i=0; $i<12; $i++)
            <div class="absolute w-full h-full" style="transform: rotate({{ $i * 30 }}deg);">
                <div class="mx-auto w-1 {{ $i % 3 == 0 ? 'h-3.5 bg-primary-500' : 'h-2 bg-slate-300 dark:bg-slate-700' }} rounded-full mt-1.5"></div>
            </div>
        @endfor
        
        <!-- Hands -->
        <div id="hour-hand" class="absolute w-1.5 h-12 bg-slate-800 dark:bg-slate-200 rounded-full origin-bottom left-[calc(50%-3px)]" style="bottom: 50%; transform: rotate(0deg); transition: transform 0.05s cubic-bezier(0.4, 2.08, 0.55, 0.44);"></div>
        <div id="min-hand" class="absolute w-1 h-16 bg-slate-500 dark:bg-slate-400 rounded-full origin-bottom left-[calc(50%-2px)]" style="bottom: 50%; transform: rotate(0deg); transition: transform 0.05s cubic-bezier(0.4, 2.08, 0.55, 0.44);"></div>
        <div id="sec-hand" class="absolute w-0.5 h-20 bg-rose-500 dark:bg-rose-400 rounded-full origin-bottom left-[calc(50%-1px)]" style="bottom: 50%; transform: rotate(0deg); transition: transform 0.05s cubic-bezier(0.4, 2.08, 0.55, 0.44);"></div>
        
        <!-- Center Dot -->
        <div class="absolute w-3.5 h-3.5 bg-slate-800 dark:bg-white rounded-full z-20 border-2 border-white dark:border-slate-900 shadow-md"></div>
    </div>
    
    <!-- Digital Date/Time -->
    <div class="text-center relative z-10">
        <div class="text-3xl font-bold font-mono tracking-wider text-slate-800 dark:text-white drop-shadow-[0_2px_8px_rgba(2,132,199,0.1)] mb-1" id="digital-time">00:00:00</div>
        <div class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-350" id="digital-date">{{ date('l, d F Y') }}</div>
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
