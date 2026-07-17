<!-- Monoline Transparent-to-Solid Navbar -->
<div class="fixed top-0 inset-x-0 z-[100] transition-all duration-300 bg-transparent py-4" id="main-nav">
    <!-- Navbar Container -->
    <div class="mx-auto px-4 lg:px-8 max-w-7xl">
        <div class="flex items-center justify-between h-14">
            
            <!-- Logo & Title (Left) -->
            <div class="flex items-center gap-3">
                <a href="{{ site_url() }}" class="flex items-center gap-3 group">
                    <img src="{{ gambar_desa($desa['logo']) }}" alt="Logo {{ setting('sebutan_desa') }}" class="h-10 w-auto group-hover:scale-105 transition-transform duration-300">
                    <div class="hidden sm:flex flex-col">
                        <span class="text-lg font-bold text-white transition-colors duration-300 leading-none tracking-tight font-heading nav-text">{{ ucwords(setting('sebutan_desa')) }} {{ $desa['nama_desa'] }}</span>
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
                        <a href="{{ site_url('arsip') }}" class="text-sm font-semibold text-white/90 hover:text-accent-500 transition-colors duration-300 uppercase tracking-widest flex items-center gap-1 cursor-pointer nav-text">
                            Berita <i class="fas fa-angle-down text-[10px]"></i>
                        </a>
                        <div class="absolute top-full left-0 pt-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 w-56 z-50">
                            <div class="bg-white rounded-lg shadow-[0_10px_30px_rgba(0,0,0,0.1)] border-t-2 border-accent-500 p-2">
                                <a href="{{ site_url('arsip') }}" class="block px-4 py-2.5 text-sm font-medium text-slate-700 hover:text-primary-600 hover:bg-slate-50 transition-colors">Semua Berita</a>
                                @if (isset($menu_kiri) && is_array($menu_kiri))
                                    @foreach ($menu_kiri as $kategori)
                                        <a href="{{ site_url('artikel/kategori/' . $kategori['slug']) }}" class="block px-4 py-2.5 text-sm font-medium text-slate-700 hover:text-primary-600 hover:bg-slate-50 transition-colors">{{ $kategori['kategori'] }}</a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </li>

                    <li class="group relative">
                        <a href="javascript:void(0)" class="text-sm font-semibold text-white/90 hover:text-accent-500 transition-colors duration-300 uppercase tracking-widest flex items-center gap-1 cursor-pointer nav-text">
                            Statistik <i class="fas fa-angle-down text-[10px]"></i>
                        </a>
                        <div class="absolute top-full left-0 pt-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 w-56 z-50">
                            <div class="bg-white rounded-lg shadow-[0_10px_30px_rgba(0,0,0,0.1)] border-t-2 border-accent-500 p-2">
                                <a href="{{ site_url('data-wilayah') }}" class="block px-4 py-2.5 text-sm font-medium text-slate-700 hover:text-primary-600 hover:bg-slate-50 transition-colors">Data Wilayah</a>
                                <a href="{{ site_url('data-statistik/pendidikan-dalam-kk') }}" class="block px-4 py-2.5 text-sm font-medium text-slate-700 hover:text-primary-600 hover:bg-slate-50 transition-colors">Pendidikan</a>
                                <a href="{{ site_url('data-statistik/pekerjaan') }}" class="block px-4 py-2.5 text-sm font-medium text-slate-700 hover:text-primary-600 hover:bg-slate-50 transition-colors">Pekerjaan</a>
                            </div>
                        </div>
                    </li>

                    <li>
                        <a href="{{ site_url('galeri') }}" class="text-sm font-semibold text-white/90 hover:text-accent-500 transition-colors duration-300 uppercase tracking-widest nav-text">
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
<div class="mobile-menu-overlay fixed inset-0 bg-slate-900/90 backdrop-blur-sm z-[110] lg:hidden hidden transition-opacity duration-300 opacity-0">
    <div class="mobile-menu bg-white h-full w-80 max-w-[80vw] shadow-2xl transform transition-transform duration-300 ease-in-out -translate-x-full flex flex-col">
        <div class="flex items-center justify-between p-6 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-800 font-heading">Menu</h3>
            <button class="mobile-menu-close text-slate-400 hover:text-slate-600 transition-colors text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="p-4 space-y-1 flex-1 overflow-y-auto">
            <a href="{{ site_url() }}" class="block px-4 py-3 text-slate-700 hover:text-primary-600 font-medium uppercase tracking-wider text-sm transition-colors border-b border-slate-50">Beranda</a>
            <a href="{{ site_url('arsip') }}" class="block px-4 py-3 text-slate-700 hover:text-primary-600 font-medium uppercase tracking-wider text-sm transition-colors border-b border-slate-50">Berita & Artikel</a>
            <a href="{{ site_url('data-wilayah') }}" class="block px-4 py-3 text-slate-700 hover:text-primary-600 font-medium uppercase tracking-wider text-sm transition-colors border-b border-slate-50">Statistik Wilayah</a>
            <a href="{{ site_url('galeri') }}" class="block px-4 py-3 text-slate-700 hover:text-primary-600 font-medium uppercase tracking-wider text-sm transition-colors border-b border-slate-50">Galeri Foto</a>
            <a href="{{ site_url('pengaduan') }}" class="block px-4 py-3 text-slate-700 hover:text-primary-600 font-medium uppercase tracking-wider text-sm transition-colors">Pengaduan</a>
        </nav>
    </div>
</div>

<!-- Search Overlay -->
<div id="searchOverlay" class="fixed inset-0 bg-primary-900/95 backdrop-blur-sm z-[120] hidden transition-opacity duration-300 opacity-0 flex items-center justify-center">
    <div class="w-full max-w-3xl px-4 transform scale-95 transition-transform duration-300" id="searchBox">
        <form method="get" action="{{ site_url() }}" class="relative">
            <input type="text" name="cari" class="w-full bg-transparent border-b-2 border-white/30 focus:border-white text-white text-3xl md:text-5xl py-4 outline-none placeholder-white/30 font-heading font-light" placeholder="Ketik pencarian...">
            <button type="button" onclick="toggleSearch()" class="absolute right-0 top-1/2 -translate-y-1/2 text-white/50 hover:text-white text-3xl transition-colors">
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
    
    // Check if we are on a page that is NOT the homepage. 
    // If we are not on the homepage, the navbar should probably be solid immediately because inner pages don't have a massive dark hero.
    // We can guess if we're on inner page if body doesn't have a specific hero element.
    const isInnerPage = !document.querySelector('.hero-monoline');
    
    if (window.scrollY > 20 || isInnerPage) {
        nav.classList.remove('bg-transparent', 'py-4');
        nav.classList.add('bg-white', 'py-2', 'shadow-md');
        
        texts.forEach(t => {
            t.classList.remove('text-white', 'text-white/90');
            t.classList.add('text-slate-800');
        });
    } else {
        nav.classList.add('bg-transparent', 'py-4');
        nav.classList.remove('bg-white', 'py-2', 'shadow-md');
        
        texts.forEach(t => {
            t.classList.add('text-white', 'text-white/90');
            t.classList.remove('text-slate-800');
        });
    }
});

// Run once on load
document.dispatchEvent(new Event('scroll'));

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
