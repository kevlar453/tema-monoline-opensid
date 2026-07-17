@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="w-full font-sans">
    @if (!isset($_SESSION['mandiri']) || $_SESSION['mandiri'] <> 1)
        @if (isset($_SESSION['mandiri_wait']) && $_SESSION['mandiri_wait'] == 1)
            <div class="text-slate-500 dark:text-slate-400 text-sm italic mb-4 font-medium">
                Silakan datang atau hubungi operator {{ setting('sebutan_desa') }} untuk mendapatkan kode PIN anda.
            </div>
            <div class="bg-rose-50 dark:bg-rose-950/40 text-rose-600 dark:text-rose-400 p-4 rounded-xl mb-4 text-xs font-bold border border-rose-100 dark:border-rose-900/50 shadow-sm flex items-center gap-2">
                <i class="fas fa-exclamation-circle text-sm"></i>
                Gagal 3 kali, silakan coba kembali dalam {{ waktu_ind((time() - $_SESSION['mandiri_timeout']) * (-1)) }} detik lagi
            </div>
            <div class="bg-rose-50 dark:bg-rose-950/40 text-rose-600 dark:text-rose-400 p-4 rounded-xl text-xs font-bold border border-rose-100 dark:border-rose-900/50 shadow-sm flex items-center gap-2">
                <i class="fas fa-times-circle text-sm"></i>
                Login Gagal. Username atau Password yang anda masukkan salah!
            </div>
        @else
            <div class="text-slate-500 dark:text-slate-400 text-sm italic mb-4 font-medium">
                Silakan datang atau hubungi operator {{ setting('sebutan_desa') }} untuk mendapatkan kode PIN anda.
            </div>
            <form action="{{ site_url('first/auth') }}" method="post" class="space-y-4">
                <div>
                    <input name="nik" type="text" placeholder="NIK" required 
                           class="w-full bg-slate-50/70 dark:bg-slate-900/40 border border-slate-200/80 dark:border-slate-800 text-slate-800 dark:text-slate-100 h-[48px] px-4 rounded-xl transition-all duration-300 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 focus:outline-none placeholder-slate-400 dark:placeholder-slate-600 font-sans text-sm font-medium">
                </div>
                <div>
                    <input name="pin" type="password" placeholder="PIN" required 
                           class="w-full bg-slate-50/70 dark:bg-slate-900/40 border border-slate-200/80 dark:border-slate-800 text-slate-800 dark:text-slate-100 h-[48px] px-4 rounded-xl transition-all duration-300 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 focus:outline-none placeholder-slate-400 dark:placeholder-slate-600 font-sans text-sm font-medium">
                </div>
                <button type="submit" class="w-full bg-primary-600 text-white font-bold text-sm uppercase tracking-wider py-3 rounded-xl hover:bg-primary-700 shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    Masuk
                </button>
                
                @if (isset($_SESSION['mandiri_try']) && isset($_SESSION['mandiri']) && $_SESSION['mandiri'] == -1)
                    <div class="text-xs text-rose-500 dark:text-rose-400 font-bold flex items-center gap-1.5 mt-2">
                        <i class="fas fa-info-circle"></i> Kesempatan mencoba {{ $_SESSION['mandiri_try'] - 1 }} kali lagi.
                    </div>
                @endif
                @if (isset($_SESSION['mandiri']) && $_SESSION['mandiri'] == -1)
                    <div class="text-xs text-rose-500 dark:text-rose-400 font-bold flex items-center gap-1.5 mt-2">
                        <i class="fas fa-exclamation-triangle"></i> Login Gagal. PIN atau NIK salah!
                    </div>
                @endif
            </form>
        @endif
    @else
        <div class="w-full">
            <table class="w-full text-sm text-slate-600 dark:text-slate-400 mb-6">
                <tbody>
                    <tr class="border-b border-slate-100 dark:border-slate-800/60">
                        <td class="py-2.5 w-1/4 font-bold text-slate-800 dark:text-slate-200 font-heading">Nama</td>
                        <td class="py-2.5 w-[5%] dark:text-slate-700">:</td>
                        <td class="py-2.5 font-medium text-slate-700 dark:text-slate-300">{{ $_SESSION['nama'] }}</td>
                    </tr>
                    <tr class="border-b border-slate-100 dark:border-slate-800/60">
                        <td class="py-2.5 w-1/4 font-bold text-slate-800 dark:text-slate-200 font-heading">NIK</td>
                        <td class="py-2.5 w-[5%] dark:text-slate-700">:</td>
                        <td class="py-2.5 font-medium text-slate-700 dark:text-slate-300">{{ $_SESSION['nik'] }}</td>
                    </tr>
                    <tr class="border-b border-slate-100 dark:border-slate-800/60">
                        <td class="py-2.5 w-1/4 font-bold text-slate-800 dark:text-slate-200 font-heading">No KK</td>
                        <td class="py-2.5 w-[5%] dark:text-slate-700">:</td>
                        <td class="py-2.5 font-medium text-slate-700 dark:text-slate-300">{{ $_SESSION['no_kk'] }}</td>
                    </tr>
                </tbody>
            </table>
            
            <div class="flex flex-col gap-3">
                <a href="{{ site_url('mandiri_web/mandiri/1/1') }}" class="w-full block text-center bg-slate-50 dark:bg-slate-900/30 border border-slate-200 dark:border-slate-800/60 text-slate-700 dark:text-slate-300 font-bold text-xs uppercase tracking-wider py-2.5 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-950/20 hover:text-primary-600 dark:hover:text-primary-400 hover:border-primary-100 dark:hover:border-primary-900/50 transition-all duration-300">Profil</a>
                <a href="{{ site_url('mandiri_web/mandiri/1/2') }}" class="w-full block text-center bg-slate-50 dark:bg-slate-900/30 border border-slate-200 dark:border-slate-800/60 text-slate-700 dark:text-slate-300 font-bold text-xs uppercase tracking-wider py-2.5 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-950/20 hover:text-primary-600 dark:hover:text-primary-400 hover:border-primary-100 dark:hover:border-primary-900/50 transition-all duration-300">Layanan</a>
                <a href="{{ site_url('mandiri_web/mandiri/1/3') }}" class="w-full block text-center bg-slate-50 dark:bg-slate-900/30 border border-slate-200 dark:border-slate-800/60 text-slate-700 dark:text-slate-300 font-bold text-xs uppercase tracking-wider py-2.5 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-950/20 hover:text-primary-600 dark:hover:text-primary-400 hover:border-primary-100 dark:hover:border-primary-900/50 transition-all duration-300">Lapor</a>
                <a href="{{ site_url('mandiri_web/mandiri/1/4') }}" class="w-full block text-center bg-slate-50 dark:bg-slate-900/30 border border-slate-200 dark:border-slate-800/60 text-slate-700 dark:text-slate-300 font-bold text-xs uppercase tracking-wider py-2.5 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-950/20 hover:text-primary-600 dark:hover:text-primary-400 hover:border-primary-100 dark:hover:border-primary-900/50 transition-all duration-300">Bantuan</a>
                <a href="{{ site_url('first/logout') }}" class="w-full block text-center bg-rose-50 dark:bg-rose-950/20 border border-rose-100 dark:border-rose-900 text-rose-600 dark:text-rose-400 font-bold text-xs uppercase tracking-wider py-2.5 rounded-xl hover:bg-rose-600 dark:hover:bg-rose-600 hover:text-white dark:hover:text-white hover:border-rose-600 dark:hover:border-rose-600 transition-all duration-300">Keluar</a>
            </div>
            
            <div class="mt-6 border-t border-slate-100 dark:border-slate-800/50 pt-5 flex items-center justify-between text-[11px] text-slate-400 dark:text-slate-500 font-medium">
                <span>Sistem Warga Mandiri</span>
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-900/30 font-bold rounded-full uppercase tracking-wider text-[8px]"><i class="fas fa-lock-open text-[7px]"></i> Terkoneksi</span>
            </div>
        </div>

        @if (isset($_SESSION['lg']) && $_SESSION['lg'] == 1)
            <div class="mt-6 border-t border-slate-100 dark:border-slate-800/60 pt-5">
                <div class="text-sm font-bold text-slate-800 dark:text-slate-200 mb-4 font-heading">Untuk keamanan, silakan ubah kode PIN Anda.</div>
                <form action="{{ site_url('first/ganti') }}" method="post" class="space-y-4">
                    <input name="pin1" type="password" placeholder="PIN Baru" required class="w-full bg-slate-50/70 dark:bg-slate-900/40 border border-slate-200/80 dark:border-slate-800 text-slate-800 dark:text-slate-100 h-[48px] px-4 rounded-xl transition-all duration-300 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 focus:outline-none placeholder-slate-400 dark:placeholder-slate-600 font-sans text-sm font-medium">
                    <input name="pin2" type="password" placeholder="Ulangi PIN Baru" required class="w-full bg-slate-50/70 dark:bg-slate-900/40 border border-slate-200/80 dark:border-slate-800 text-slate-800 dark:text-slate-100 h-[48px] px-4 rounded-xl transition-all duration-300 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 focus:outline-none placeholder-slate-400 dark:placeholder-slate-600 font-sans text-sm font-medium">
                    <button type="submit" class="w-full bg-primary-600 text-white font-bold text-sm uppercase tracking-wider py-3 rounded-xl hover:bg-primary-700 shadow-md transition-all duration-300">Ganti PIN</button>
                </form>
                @if (isset($flash_message))
                    <div id="notification" class="mt-4 p-3 bg-rose-50 dark:bg-rose-950/40 text-rose-600 dark:text-rose-400 text-xs font-bold rounded-xl border border-rose-100 dark:border-rose-900/50 shadow-sm">{{ $flash_message }}</div>
                    <script>
                        setTimeout(function(){ document.getElementById('notification').style.display = 'none'; }, 4000);
                    </script>
                @endif
                <div class="text-xs text-slate-400 dark:text-slate-500 italic mt-3 font-medium">Silakan coba login kembali setelah PIN baru disimpan.</div>
            </div>
        @elseif (isset($_SESSION['lg']) && $_SESSION['lg'] == 2)
            <div class="mt-6 border-t border-slate-100 dark:border-slate-800/60 pt-5">
                <div class="p-3 bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 text-xs font-bold rounded-xl border border-emerald-100 dark:border-emerald-900/30 shadow-sm">PIN Baru berhasil disimpan!</div>
            </div>
            @php unset($_SESSION['lg']); @endphp
        @endif
    @endif
</div>
