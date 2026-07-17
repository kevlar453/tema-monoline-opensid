@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="w-full font-sans">
    @if (!isset($_SESSION['mandiri']) || $_SESSION['mandiri'] <> 1)
        @if (isset($_SESSION['mandiri_wait']) && $_SESSION['mandiri_wait'] == 1)
            <div class="text-slate-500 text-sm italic mb-4 font-medium">
                Silakan datang atau hubungi operator {{ setting('sebutan_desa') }} untuk mendapatkan kode PIN anda.
            </div>
            <div class="bg-rose-50 text-rose-600 p-4 rounded-xl mb-4 text-xs font-bold border border-rose-100 shadow-sm flex items-center gap-2">
                <i class="fas fa-exclamation-circle text-sm"></i>
                Gagal 3 kali, silakan coba kembali dalam {{ waktu_ind((time() - $_SESSION['mandiri_timeout']) * (-1)) }} detik lagi
            </div>
            <div class="bg-rose-50 text-rose-600 p-4 rounded-xl text-xs font-bold border border-rose-100 shadow-sm flex items-center gap-2">
                <i class="fas fa-times-circle text-sm"></i>
                Login Gagal. Username atau Password yang anda masukkan salah!
            </div>
        @else
            <div class="text-slate-500 text-sm italic mb-4 font-medium">
                Silakan datang atau hubungi operator {{ setting('sebutan_desa') }} untuk mendapatkan kode PIN anda.
            </div>
            <form action="{{ site_url('first/auth') }}" method="post" class="space-y-4">
                <div>
                    <input name="nik" type="text" placeholder="NIK" required 
                           class="w-full bg-slate-50/70 border border-slate-200/80 text-slate-800 h-[48px] px-4 rounded-xl transition-all duration-300 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 focus:outline-none placeholder-slate-400 font-sans text-sm font-medium">
                </div>
                <div>
                    <input name="pin" type="password" placeholder="PIN" required 
                           class="w-full bg-slate-50/70 border border-slate-200/80 text-slate-800 h-[48px] px-4 rounded-xl transition-all duration-300 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 focus:outline-none placeholder-slate-400 font-sans text-sm font-medium">
                </div>
                <button type="submit" class="w-full bg-primary-600 text-white font-bold text-sm uppercase tracking-wider py-3 rounded-xl hover:bg-primary-700 shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    Masuk
                </button>
                
                @if (isset($_SESSION['mandiri_try']) && isset($_SESSION['mandiri']) && $_SESSION['mandiri'] == -1)
                    <div class="text-xs text-rose-500 font-bold flex items-center gap-1.5 mt-2">
                        <i class="fas fa-info-circle"></i> Kesempatan mencoba {{ $_SESSION['mandiri_try'] - 1 }} kali lagi.
                    </div>
                @endif
                @if (isset($_SESSION['mandiri']) && $_SESSION['mandiri'] == -1)
                    <div class="text-xs text-rose-500 font-bold flex items-center gap-1.5 mt-2">
                        <i class="fas fa-exclamation-triangle"></i> Login Gagal. PIN atau NIK salah!
                    </div>
                @endif
            </form>
        @endif
    @else
        <div class="w-full">
            <table class="w-full text-sm text-slate-600 mb-6">
                <tbody>
                    <tr class="border-b border-slate-100">
                        <td class="py-2.5 w-1/4 font-bold text-slate-800 font-heading">Nama</td>
                        <td class="py-2.5 w-[5%]">:</td>
                        <td class="py-2.5 font-medium text-slate-700">{{ $_SESSION['nama'] }}</td>
                    </tr>
                    <tr class="border-b border-slate-100">
                        <td class="py-2.5 w-1/4 font-bold text-slate-800 font-heading">NIK</td>
                        <td class="py-2.5 w-[5%]">:</td>
                        <td class="py-2.5 font-medium text-slate-700">{{ $_SESSION['nik'] }}</td>
                    </tr>
                    <tr class="border-b border-slate-100">
                        <td class="py-2.5 w-1/4 font-bold text-slate-800 font-heading">No KK</td>
                        <td class="py-2.5 w-[5%]">:</td>
                        <td class="py-2.5 font-medium text-slate-700">{{ $_SESSION['no_kk'] }}</td>
                    </tr>
                </tbody>
            </table>
            
            <div class="flex flex-col gap-3">
                <a href="{{ site_url('mandiri_web/mandiri/1/1') }}" class="w-full block text-center bg-slate-50 border border-slate-200 text-slate-700 font-bold text-xs uppercase tracking-wider py-2.5 rounded-xl hover:bg-primary-50 hover:text-primary-600 hover:border-primary-100 transition-all duration-300">Profil</a>
                <a href="{{ site_url('mandiri_web/mandiri/1/2') }}" class="w-full block text-center bg-slate-50 border border-slate-200 text-slate-700 font-bold text-xs uppercase tracking-wider py-2.5 rounded-xl hover:bg-primary-50 hover:text-primary-600 hover:border-primary-100 transition-all duration-300">Layanan</a>
                <a href="{{ site_url('mandiri_web/mandiri/1/3') }}" class="w-full block text-center bg-slate-50 border border-slate-200 text-slate-700 font-bold text-xs uppercase tracking-wider py-2.5 rounded-xl hover:bg-primary-50 hover:text-primary-600 hover:border-primary-100 transition-all duration-300">Lapor</a>
                <a href="{{ site_url('mandiri_web/mandiri/1/4') }}" class="w-full block text-center bg-slate-50 border border-slate-200 text-slate-700 font-bold text-xs uppercase tracking-wider py-2.5 rounded-xl hover:bg-primary-50 hover:text-primary-600 hover:border-primary-100 transition-all duration-300">Bantuan</a>
                <a href="{{ site_url('first/logout') }}" class="w-full block text-center bg-rose-50 border border-rose-100 text-rose-600 font-bold text-xs uppercase tracking-wider py-2.5 rounded-xl hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all duration-300">Keluar</a>
            </div>
        </div>

        @if (isset($_SESSION['lg']) && $_SESSION['lg'] == 1)
            <div class="mt-6 border-t border-slate-100 pt-5">
                <div class="text-sm font-bold text-slate-800 mb-4 font-heading">Untuk keamanan, silakan ubah kode PIN Anda.</div>
                <form action="{{ site_url('first/ganti') }}" method="post" class="space-y-4">
                    <input name="pin1" type="password" placeholder="PIN Baru" required class="w-full bg-slate-50/70 border border-slate-200/80 text-slate-800 h-[48px] px-4 rounded-xl transition-all duration-300 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 focus:outline-none placeholder-slate-400 font-sans text-sm font-medium">
                    <input name="pin2" type="password" placeholder="Ulangi PIN Baru" required class="w-full bg-slate-50/70 border border-slate-200/80 text-slate-800 h-[48px] px-4 rounded-xl transition-all duration-300 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 focus:outline-none placeholder-slate-400 font-sans text-sm font-medium">
                    <button type="submit" class="w-full bg-primary-600 text-white font-bold text-sm uppercase tracking-wider py-3 rounded-xl hover:bg-primary-700 shadow-md transition-all duration-300">Ganti PIN</button>
                </form>
                @if (isset($flash_message))
                    <div id="notification" class="mt-4 p-3 bg-rose-50 text-rose-600 text-xs font-bold rounded-xl border border-rose-100 shadow-sm">{{ $flash_message }}</div>
                    <script>
                        setTimeout(function(){ document.getElementById('notification').style.display = 'none'; }, 4000);
                    </script>
                @endif
                <div class="text-xs text-slate-400 italic mt-3 font-medium">Silakan coba login kembali setelah PIN baru disimpan.</div>
            </div>
        @elseif (isset($_SESSION['lg']) && $_SESSION['lg'] == 2)
            <div class="mt-6 border-t border-slate-100 pt-5">
                <div class="p-3 bg-emerald-50 text-emerald-600 text-xs font-bold rounded-xl border border-emerald-100 shadow-sm">PIN Baru berhasil disimpan!</div>
            </div>
            @php unset($_SESSION['lg']); @endphp
        @endif
    @endif
</div>
