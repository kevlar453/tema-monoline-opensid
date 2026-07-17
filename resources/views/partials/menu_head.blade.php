<!-- Monoline Transparent-to-Solid Navbar -->
<div class="fixed top-0 inset-x-0 z-[100] transition-all duration-300 bg-transparent py-4" id="main-nav">
    <!-- Navbar Container -->
    <div class="mx-auto px-4 lg:px-8 max-w-7xl">
        <div class="flex items-center justify-between h-14">
            
            <!-- Logo & Title (Left) -->
            <div class="flex items-center gap-3">
                <a href="{{ site_url() }}" class="flex items-center gap-3 group">
                    <img src="{{ gambar_desa($desa['logo']) }}" alt="Logo {{ setting('sebutan_desa') }}" class="h-10 w-auto group-hover:scale-105 transition-transform duration-300">
                    <div class="flex flex-col">
                        <span class="text-sm sm:text-lg font-bold text-white transition-colors duration-300 leading-none tracking-tight font-heading nav-text">{{ ucwords(setting('sebutan_desa')) }} {{ $desa['nama_desa'] }}</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation (Center/Right) -->
            <nav class="hidden lg:flex items-center justify-end flex-1" id="desktopMenu">
                <ul class="flex items-center space-x-6">
                    <li>
                        <a href="{{ site_url() }}" class="text-sm font-semibold text-white/90 hover:text-accent-500 transition-colors duration-300 uppercase tracking-widest nav-text">
                            Beranda
                        </a>
                    </li>

                    <li class="group relative">
                        <a href="{{ site_url('arsip') }}" class="text-sm font-semibold text-white/90 hover:text-accent-500 transition-colors duration-300 uppercase tracking-widest flex items-center gap-1 cursor-pointer nav-text font-heading">
                            Berita <i class="fas fa-angle-down text-[10px]"></i>
                        </a>
                        <div class="absolute top-full left-0 pt-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 w-60 z-50">
                            <div class="bg-white/90 backdrop-blur-md rounded-xl shadow-[0_15px_35px_rgba(0,0,0,0.08)] border border-slate-200/50 border-t-2 border-t-primary-600 p-2">
                                <a href="{{ site_url('arsip') }}" class="block px-4 py-2.5 text-sm font-semibold text-slate-700 hover:text-primary-600 hover:bg-primary-50/50 rounded-lg transition-all">Semua Berita</a>
                                @if (isset($menu_kiri) && is_array($menu_kiri))
                                    @foreach ($menu_kiri as $kategori)
                                        <a href="{{ site_url('artikel/kategori/' . $kategori['slug']) }}" class="block px-4 py-2.5 text-sm font-semibold text-slate-700 hover:text-primary-600 hover:bg-primary-50/50 rounded-lg transition-all">{{ $kategori['kategori'] }}</a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </li>

                    <li class="group relative">
                        <a href="javascript:void(0)" class="text-sm font-semibold text-white/90 hover:text-accent-500 transition-colors duration-300 uppercase tracking-widest flex items-center gap-1 cursor-pointer nav-text font-heading">
                            Statistik <i class="fas fa-angle-down text-[10px]"></i>
                        </a>
                        <div class="absolute top-full left-0 pt-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 w-60 z-50">
                            <div class="bg-white/90 backdrop-blur-md rounded-xl shadow-[0_15px_35px_rgba(0,0,0,0.08)] border border-slate-200/50 border-t-2 border-t-primary-600 p-2">
                                <a href="{{ site_url('data-wilayah') }}" class="block px-4 py-2.5 text-sm font-semibold text-slate-700 hover:text-primary-600 hover:bg-primary-50/50 rounded-lg transition-all">Data Wilayah</a>
                                <a href="{{ site_url('data-statistik/pendidikan-dalam-kk') }}" class="block px-4 py-2.5 text-sm font-semibold text-slate-700 hover:text-primary-600 hover:bg-primary-50/50 rounded-lg transition-all">Pendidikan</a>
                                <a href="{{ site_url('data-statistik/pekerjaan') }}" class="block px-4 py-2.5 text-sm font-semibold text-slate-700 hover:text-primary-600 hover:bg-primary-50/50 rounded-lg transition-all">Pekerjaan</a>
                            </div>
                        </div>
                    </li>

                    <li>
                        <a href="{{ site_url('galeri') }}" class="text-sm font-semibold text-white/90 hover:text-accent-500 transition-colors duration-300 uppercase tracking-widest nav-text font-heading">
                            Galeri
                        </a>
                    </li>
                    
                    <li>
                        <!-- Search Button -->
                        <button onclick="toggleSearch()" class="text-white hover:text-accent-500 transition-colors duration-200 nav-text ml-4">
                            <i class="fas fa-search"></i>
                        </button>
                    </li>
                </ul>
            </nav>

            <!-- Mobile Menu Toggle -->
            <button class="lg:hidden text-white hover:text-accent-500 transition-colors duration-200 nav-text mobile-menu-button text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</div>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay fixed inset-0 bg-slate-900/40 backdrop-blur-md z-[110] lg:hidden hidden transition-opacity duration-300 opacity-0">
    <div class="mobile-menu bg-white/95 backdrop-blur-lg h-full w-80 max-w-[80vw] shadow-2xl border-r border-slate-200/50 transform transition-transform duration-300 ease-in-out -translate-x-full flex flex-col">
        <div class="flex items-center justify-between p-6 border-b border-slate-200/30">
            <h3 class="text-lg font-bold text-slate-800 font-heading tracking-wider uppercase">Menu Utama</h3>
            <button class="mobile-menu-close text-slate-400 hover:text-slate-600 transition-colors text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="p-4 space-y-1 flex-1 overflow-y-auto">
            <a href="{{ site_url() }}" class="block px-4 py-3 text-slate-700 hover:text-primary-600 hover:bg-primary-50/50 rounded-xl font-bold uppercase tracking-wider text-xs transition-all border-b border-slate-100/50">Beranda</a>
            <a href="{{ site_url('arsip') }}" class="block px-4 py-3 text-slate-700 hover:text-primary-600 hover:bg-primary-50/50 rounded-xl font-bold uppercase tracking-wider text-xs transition-all border-b border-slate-100/50">Berita & Artikel</a>
            <a href="{{ site_url('data-wilayah') }}" class="block px-4 py-3 text-slate-700 hover:text-primary-600 hover:bg-primary-50/50 rounded-xl font-bold uppercase tracking-wider text-xs transition-all border-b border-slate-100/50">Statistik Wilayah</a>
            <a href="{{ site_url('galeri') }}" class="block px-4 py-3 text-slate-700 hover:text-primary-600 hover:bg-primary-50/50 rounded-xl font-bold uppercase tracking-wider text-xs transition-all border-b border-slate-100/50">Galeri Foto</a>
            <a href="{{ site_url('pengaduan') }}" class="block px-4 py-3 text-slate-700 hover:text-primary-600 hover:bg-primary-50/50 rounded-xl font-bold uppercase tracking-wider text-xs transition-all">Pengaduan</a>
        </nav>
    </div>
</div>

<!-- Search Overlay -->
<div id="searchOverlay" class="fixed inset-0 bg-slate-950/95 backdrop-blur-md z-[120] hidden transition-opacity duration-300 opacity-0 flex items-center justify-center">
    <div class="w-full max-w-3xl px-4 transform scale-95 transition-transform duration-300" id="searchBox">
        <form method="get" action="{{ site_url() }}" class="relative">
            <input type="text" name="cari" class="w-full bg-transparent border-b-2 border-slate-700 focus:border-primary-500 text-white text-3xl md:text-5xl py-4 outline-none placeholder-slate-600 font-heading font-light tracking-wide" placeholder="Cari informasi desa...">
            <button type="button" onclick="toggleSearch()" class="absolute right-0 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white text-3xl transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </form>
    </div>
</div>

<script>
// Monoline Scroll Effect
window.addEventListener('scroll', function() {
    const nav = document.getElementById('main-nav');
    const texts = document.querySelectorAll('.nav-text');
    
    const isInnerPage = !document.querySelector('.hero-monoline');
    
    if (window.scrollY > 20 || isInnerPage) {
        nav.classList.remove('bg-transparent', 'py-4');
        nav.classList.add('bg-white/90', 'backdrop-blur-md', 'border-b', 'border-slate-200/40', 'py-2.5', 'shadow-sm');
        
        texts.forEach(t => {
            t.classList.remove('text-white', 'text-white/90');
            t.classList.add('text-slate-800');
        });
    } else {
        nav.classList.add('bg-transparent', 'py-4');
        nav.classList.remove('bg-white/90', 'backdrop-blur-md', 'border-b', 'border-slate-200/40', 'py-2.5', 'shadow-sm');
        
        texts.forEach(t => {
            t.classList.add('text-white', 'text-white/90');
            t.classList.remove('text-slate-800');
        });
    }
});
// Run once on load
window.dispatchEvent(new Event('scroll'));

// Mobile menu and Search
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
    const mobileMenuClose = document.querySelector('.mobile-menu-close');
    const mobileMenu = document.querySelector('.mobile-menu');

    function openMobileMenu() {
        mobileMenuOverlay.classList.remove('hidden');
        void mobileMenuOverlay.offsetWidth;
        mobileMenuOverlay.classList.remove('opacity-0');
        mobileMenu.classList.remove('-translate-x-full');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        mobileMenuOverlay.classList.add('opacity-0');
        mobileMenu.classList.add('-translate-x-full');
        setTimeout(() => { mobileMenuOverlay.classList.add('hidden'); }, 300);
        document.body.style.overflow = '';
    }

    if (mobileMenuButton) mobileMenuButton.addEventListener('click', openMobileMenu);
    if (mobileMenuClose) mobileMenuClose.addEventListener('click', closeMobileMenu);
});

function toggleSearch() {
    const searchOverlay = document.getElementById('searchOverlay');
    const searchBox = document.getElementById('searchBox');
    
    if (searchOverlay.classList.contains('hidden')) {
        searchOverlay.classList.remove('hidden');
        void searchOverlay.offsetWidth;
        searchOverlay.classList.remove('opacity-0');
        searchBox.classList.remove('scale-95');
        searchBox.classList.add('scale-100');
        document.body.style.overflow = 'hidden';
        setTimeout(() => { searchOverlay.querySelector('input[name="cari"]').focus(); }, 100);
    } else {
        searchOverlay.classList.add('opacity-0');
        searchBox.classList.remove('scale-100');
        searchBox.classList.add('scale-95');
        setTimeout(() => { searchOverlay.classList.add('hidden'); }, 300);
        document.body.style.overflow = '';
    }
}
</script>
