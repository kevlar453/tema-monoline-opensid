<!-- Main Footer Content with Image Wave -->
<div class="pt-[160px] pb-8 font-sans text-slate-300">
    <div class="container mx-auto px-4 lg:px-8 xl:px-12 max-w-[1200px]">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- About Widget -->
            <div>
                <h4 class="text-2xl lg:text-3xl font-bold text-accent-500 font-heading mb-6 tracking-wide">{{ ucwords(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa'] ?? '') }}</h4>
                
                <div class="flex flex-col sm:flex-row items-start gap-5 mb-8">
                    @if (isset($desa['logo']))
                        <a href="{{ site_url() }}" class="flex-shrink-0">
                            <img src="{{ gambar_desa($desa['logo']) }}" alt="Logo {{ setting('sebutan_desa') }}" class="w-[70px] lg:w-[90px] h-auto" />
                        </a>
                    @endif
                    <p class="text-base lg:text-lg leading-relaxed opacity-80 m-0">
                        {{ $desa['tentang_kami'] ?? 'Website resmi desa kami menyajikan informasi publik, berita kegiatan, dan transparansi data yang dikelola langsung oleh aparatur desa demi kemajuan bersama.' }}
                    </p>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ $desa['facebook'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-[#46536b] flex items-center justify-center text-slate-300 hover:bg-blue-600 hover:text-white transition-all text-lg"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ $desa['twitter'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-[#46536b] flex items-center justify-center text-slate-300 hover:bg-sky-500 hover:text-white transition-all text-lg"><i class="fab fa-twitter"></i></a>
                    <a href="{{ $desa['instagram'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-[#46536b] flex items-center justify-center text-slate-300 hover:bg-pink-600 hover:text-white transition-all text-lg"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $desa['youtube'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-[#46536b] flex items-center justify-center text-slate-300 hover:bg-red-600 hover:text-white transition-all text-lg"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-xl lg:text-2xl font-bold text-white font-heading mb-6">Tautan Cepat</h4>
                <ul class="space-y-4 text-base lg:text-lg opacity-80">
                    <li><a href="{{ site_url('mandiri') }}" class="hover:text-white transition-colors flex items-center gap-3"><span class="text-slate-400">-</span> Layanan Mandiri</a></li>
                    <li><a href="{{ site_url('apbdesa') }}" class="hover:text-white transition-colors flex items-center gap-3"><span class="text-slate-400">-</span> Transparansi APBDes</a></li>
                    <li><a href="{{ site_url('data-wilayah') }}" class="hover:text-white transition-colors flex items-center gap-3"><span class="text-slate-400">-</span> Data Kependudukan</a></li>
                    <li><a href="{{ site_url('peraturan-desa') }}" class="hover:text-white transition-colors flex items-center gap-3"><span class="text-slate-400">-</span> Produk Hukum</a></li>
                    <li><a href="{{ site_url('pembangunan') }}" class="hover:text-white transition-colors flex items-center gap-3"><span class="text-slate-400">-</span> Data Pembangunan</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-xl lg:text-2xl font-bold text-white font-heading mb-6">Kontak Kami</h4>
                <ul class="space-y-5 text-base lg:text-lg opacity-80">
                    <li><div class="flex items-center gap-3"><span class="text-slate-400">-</span> Jl. Raya {{ ucwords($desa['nama_desa'] ?? '') }} No. 1</div></li>
                    <li><div class="flex items-center gap-3"><span class="text-slate-400">-</span> Kec. {{ ucwords($desa['nama_kecamatan'] ?? '') }}, Kab. {{ ucwords($desa['nama_kabupaten'] ?? '') }}</div></li>
                    <li><div class="flex items-center gap-3"><span class="text-slate-400">-</span> {{ $desa['telepon'] ?? '(0123) 456789' }}</div></li>
                    <li><div class="flex items-center gap-3"><span class="text-slate-400">-</span> {{ $desa['email_desa'] ?? 'pemdes@desa.id' }}</div></li>
                </ul>
            </div>

            <!-- Subscribe/Maps -->
            <div>
                <h4 class="text-xl lg:text-2xl font-bold text-white font-heading mb-6">Newsletter</h4>
                <p class="text-base lg:text-lg opacity-80 mb-6">Berlangganan untuk mendapatkan informasi terbaru dari kami.</p>
                <form action="javascript:void(0)" class="flex border border-transparent rounded bg-white overflow-hidden focus-within:ring-2 focus-within:ring-accent-500 transition-shadow">
                    <input type="email" placeholder="Email Address" class="w-full bg-white text-slate-900 px-4 py-3 outline-none text-base placeholder-slate-400 font-sans">
                </form>
                <button type="submit" class="mt-4 bg-accent-500 text-white font-medium px-6 py-2 rounded hover:bg-accent-600 transition-colors">Subscribe</button>
            </div>
            
        </div>
    </div>
</div>
