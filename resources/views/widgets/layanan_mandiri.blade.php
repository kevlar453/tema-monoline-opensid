@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="w-full">
    @if (!isset($_SESSION['mandiri']) || $_SESSION['mandiri'] <> 1)
        @if (isset($_SESSION['mandiri_wait']) && $_SESSION['mandiri_wait'] == 1)
            <div class="text-[#666] text-sm italic mb-4">
                Silakan datang atau hubungi operator {{ setting('sebutan_desa') }} untuk mendapatkan kode PIN anda.
            </div>
            <div class="bg-red-50 text-red-600 p-3 rounded mb-4 text-sm border border-red-100">
                Gagal 3 kali, silakan coba kembali dalam {{ waktu_ind((time() - $_SESSION['mandiri_timeout']) * (-1)) }} detik lagi
            </div>
            <div class="bg-red-50 text-red-600 p-3 rounded text-sm border border-red-100">
                Login Gagal. Username atau Password yang anda masukkan salah!
            </div>
        @else
            <div class="text-[#666] text-sm italic mb-4">
                Silakan datang atau hubungi operator {{ setting('sebutan_desa') }} untuk mendapatkan kode PIN anda.
            </div>
            <form action="{{ site_url('first/auth') }}" method="post" class="space-y-4">
                <div>
                    <input name="nik" type="text" placeholder="NIK" required 
                           class="w-full bg-[#f8f4ef] border border-[#eee] text-[#1b2032] h-[50px] px-4 transition-colors duration-300 focus:border-[#ffaa17] focus:outline-none">
                </div>
                <div>
                    <input name="pin" type="password" placeholder="PIN" required 
                           class="w-full bg-[#f8f4ef] border border-[#eee] text-[#1b2032] h-[50px] px-4 transition-colors duration-300 focus:border-[#ffaa17] focus:outline-none">
                </div>
                <button type="submit" class="w-full bg-white border-2 border-[#1b2032] text-[#1b2032] font-semibold text-[14px] uppercase tracking-[1px] py-[10px] rounded-[30px] hover:bg-[#ffaa17] hover:text-white hover:border-[#ffaa17] transition-all duration-300">
                    Masuk
                </button>
                
                @if (isset($_SESSION['mandiri_try']) && isset($_SESSION['mandiri']) && $_SESSION['mandiri'] == -1)
                    <div class="text-sm text-red-500 mt-2">
                        Kesempatan mencoba {{ $_SESSION['mandiri_try'] - 1 }} kali lagi.
                    </div>
                @endif
                @if (isset($_SESSION['mandiri']) && $_SESSION['mandiri'] == -1)
                    <div class="text-sm text-red-500 mt-2">
                        Login Gagal. Username atau Password yang Anda masukkan salah!
                    </div>
                @endif
            </form>
        @endif
    @else
        <div class="w-full">
            <table class="w-full text-sm text-[#666] mb-4">
                <tbody>
                    <tr class="border-b border-[#eee]">
                        <td class="py-2 w-1/4 font-semibold text-[#1b2032]">Nama</td>
                        <td class="py-2 w-[5%]">:</td>
                        <td class="py-2">{{ $_SESSION['nama'] }}</td>
                    </tr>
                    <tr class="border-b border-[#eee]">
                        <td class="py-2 w-1/4 font-semibold text-[#1b2032]">NIK</td>
                        <td class="py-2 w-[5%]">:</td>
                        <td class="py-2">{{ $_SESSION['nik'] }}</td>
                    </tr>
                    <tr class="border-b border-[#eee]">
                        <td class="py-2 w-1/4 font-semibold text-[#1b2032]">No KK</td>
                        <td class="py-2 w-[5%]">:</td>
                        <td class="py-2">{{ $_SESSION['no_kk'] }}</td>
                    </tr>
                </tbody>
            </table>
            
            <div class="flex flex-col gap-3">
                <a href="{{ site_url('mandiri_web/mandiri/1/1') }}" class="w-full block text-center bg-white border-2 border-[#eee] text-[#666] font-semibold text-[14px] uppercase tracking-[1px] py-[8px] rounded-[30px] hover:bg-[#ffaa17] hover:text-white hover:border-[#ffaa17] transition-all duration-300">Profil</a>
                <a href="{{ site_url('mandiri_web/mandiri/1/2') }}" class="w-full block text-center bg-white border-2 border-[#eee] text-[#666] font-semibold text-[14px] uppercase tracking-[1px] py-[8px] rounded-[30px] hover:bg-[#ffaa17] hover:text-white hover:border-[#ffaa17] transition-all duration-300">Layanan</a>
                <a href="{{ site_url('mandiri_web/mandiri/1/3') }}" class="w-full block text-center bg-white border-2 border-[#eee] text-[#666] font-semibold text-[14px] uppercase tracking-[1px] py-[8px] rounded-[30px] hover:bg-[#ffaa17] hover:text-white hover:border-[#ffaa17] transition-all duration-300">Lapor</a>
                <a href="{{ site_url('mandiri_web/mandiri/1/4') }}" class="w-full block text-center bg-white border-2 border-[#eee] text-[#666] font-semibold text-[14px] uppercase tracking-[1px] py-[8px] rounded-[30px] hover:bg-[#ffaa17] hover:text-white hover:border-[#ffaa17] transition-all duration-300">Bantuan</a>
                <a href="{{ site_url('first/logout') }}" class="w-full block text-center bg-red-50 border-2 border-red-500 text-red-600 font-semibold text-[14px] uppercase tracking-[1px] py-[8px] rounded-[30px] hover:bg-red-600 hover:text-white hover:border-red-600 transition-all duration-300">Keluar</a>
            </div>
        </div>

        @if (isset($_SESSION['lg']) && $_SESSION['lg'] == 1)
            <div class="mt-6 border-t border-[#eee] pt-4">
                <div class="text-sm text-[#1b2032] mb-4">Untuk keamanan silahkan ubah kode PIN Anda.</div>
                <form action="{{ site_url('first/ganti') }}" method="post" class="space-y-4">
                    <input name="pin1" type="password" placeholder="PIN Baru" required class="w-full bg-[#f8f4ef] border border-[#eee] text-[#1b2032] h-[50px] px-4 transition-colors duration-300 focus:border-[#ffaa17] focus:outline-none">
                    <input name="pin2" type="password" placeholder="Ulangi PIN Baru" required class="w-full bg-[#f8f4ef] border border-[#eee] text-[#1b2032] h-[50px] px-4 transition-colors duration-300 focus:border-[#ffaa17] focus:outline-none">
                    <button type="submit" class="w-full bg-white border-2 border-[#1b2032] text-[#1b2032] font-semibold text-[14px] uppercase tracking-[1px] py-[10px] rounded-[30px] hover:bg-[#ffaa17] hover:text-white hover:border-[#ffaa17] transition-all duration-300">Ganti PIN</button>
                </form>
                @if (isset($flash_message))
                    <div id="notification" class="mt-4 p-3 bg-red-50 text-red-600 text-sm rounded border border-red-100">{{ $flash_message }}</div>
                    <script>
                        setTimeout(function(){ document.getElementById('notification').style.display = 'none'; }, 4000);
                    </script>
                @endif
                <div class="text-xs text-[#666] italic mt-2">Silahkan coba login kembali setelah PIN baru disimpan.</div>
            </div>
        @elseif (isset($_SESSION['lg']) && $_SESSION['lg'] == 2)
            <div class="mt-6 border-t border-[#eee] pt-4">
                <div class="p-3 bg-green-50 text-green-600 text-sm rounded border border-green-100">PIN Baru berhasil Disimpan!</div>
            </div>
            @php unset($_SESSION['lg']); @endphp
        @endif
    @endif
</div>
