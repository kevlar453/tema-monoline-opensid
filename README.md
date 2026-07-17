# Tema AR Modern Monoline - OpenSID

Tema OpenSID modern berbasis Tailwind CSS murni dengan integrasi penuh desain Monoline yang responsive untuk semua ukuran layar.

## 🚀 Fitur Utama

- **Pure Tailwind CSS**: 100% berbasis Tailwind CSS tanpa Bootstrap atau framework eksternal
- **Modern Design**: Interface yang clean dan modern dengan utility-first approach
- **Fully Responsive**: Mobile-first approach dengan breakpoint yang optimal
- **No External Dependencies**: Tidak memerlukan jQuery, Bootstrap, atau library eksternal
- **Performance**: Optimized CSS dan JavaScript untuk performa yang lebih baik
- **Accessibility**: Focus states dan semantic HTML untuk aksesibilitas yang lebih baik

## 🎨 Komponen yang Tersedia

### Header
- Logo dan judul website yang responsive
- Search bar dengan styling yang modern
- Layout yang adaptif untuk mobile dan desktop

### Navigation
- Menu navigation yang responsive
- Mobile overlay menu dengan smooth transitions
- Dropdown support untuk sub-menu

### Footer
- Grid layout yang responsive
- Informasi desa dengan icon yang informatif
- Kategori artikel dengan hover effects
- Social media links dengan styling yang menarik

### Sidebar
- Widget jam dengan styling yang modern
- Pintasan masuk admin dan layanan mandiri
- Support untuk custom widgets
- Quick links dan informasi kontak

### Content Areas
- **Custom Slider**: Slider murni JavaScript tanpa dependency eksternal
- Feed articles dengan card design
- APBDesa dengan progress bars yang modern
- Layout templates yang responsive

## 🛠️ Instalasi

1. Pastikan tema sudah terinstall di OpenSID
2. Aktifkan tema melalui admin panel
3. Konfigurasi tema sesuai kebutuhan
4. Tema akan otomatis menggunakan Tailwind CSS dari CDN

## ⚙️ Konfigurasi

### Warna Tema
- **Warna Dasar**: Primary color untuk tema (default: #dc2626)
- **Warna Sekunder**: Secondary color untuk elemen pendukung
- **Mode Tema**: Light, Dark, atau Auto

### Fitur
- **Statistik Desa**: Toggle untuk menampilkan statistik
- **Jam**: Toggle untuk menampilkan jam server
- **Pintasan Masuk**: Toggle untuk admin dan layanan mandiri
- **Animasi Hover**: Toggle untuk hover effects
- **Shadow Cards**: Toggle untuk shadow pada cards
- **Border Radius**: Pilihan ukuran border radius

## 📱 Responsive Breakpoints

- **Mobile**: < 640px
- **Tablet**: 640px - 1024px
- **Desktop**: > 1024px

## 🎯 Customization

### CSS Classes
Tema menggunakan utility classes dari Tailwind CSS:

```html
<!-- Button styles -->
<button class="bg-primary-600 text-white px-6 py-3 rounded-xl hover:bg-primary-700 transition-all duration-200">
    Primary Button
</button>

<!-- Card styles -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-300">
    <div class="text-lg font-semibold text-gray-900 mb-4">Card Title</div>
    <div class="text-gray-600">Card content goes here</div>
</div>

<!-- Form styles -->
<input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200" type="text">
```

### Custom CSS
Tambahkan custom styles di `src/input.css`:

```css
/* Custom component styles */
@layer components {
  .my-custom-component {
    @apply bg-white rounded-xl shadow-md p-6;
  }
}

/* Custom utilities */
@layer utilities {
  .text-gradient {
    @apply bg-gradient-to-r from-primary-600 to-primary-700 bg-clip-text text-transparent;
  }
}
```

## 🔧 Development

### Struktur File
```
desa/themes/ar-modern-1/
├── config.json              # Konfigurasi tema
├── composer.json            # Package information
├── package.json             # Build tools dan dependencies
├── tailwind.config.js       # Tailwind configuration
├── postcss.config.js        # PostCSS configuration
├── src/input.css            # Main Tailwind input file
├── assets/
│   ├── css/                 # Generated CSS output
│   └── js/theme.js          # Theme JavaScript
├── resources/
│   └── views/               # Blade templates
├── README.md                # Dokumentasi ini
├── DEVELOPMENT.md           # Panduan development
└── build.sh                 # Build script
```

### Dependencies
- **Tailwind CSS** (via CDN) - Utility-first CSS framework
- **Font Awesome 6** (via CDN) - Icon library
- **Vanilla JavaScript** - Interaktivitas tanpa dependency eksternal
- **CSS Grid & Flexbox** - Layout modern
- **CSS Custom Properties** - Dynamic theming

### Build Process
```bash
# Install dependencies
npm install

# Development mode (watch)
npm run dev

# Production build
npm run build:prod
```

## 🌟 Browser Support

- **Chrome**: 90+
- **Firefox**: 88+
- **Safari**: 14+
- **Edge**: 90+

## 📝 Changelog

### v2.0.0 - Pure Tailwind Version
- **BREAKING CHANGE**: Migrasi dari Bootstrap ke Tailwind CSS murni
- **REMOVED**: Semua dependency eksternal (jQuery, Bootstrap, Slick Slider)
- **ADDED**: Custom slider dengan vanilla JavaScript
- **ADDED**: Progress bars dengan intersection observer
- **ADDED**: Lazy loading untuk images
- **ADDED**: Smooth animations dan transitions
- **IMPROVED**: Layout structure untuk mencegah sidebar cutting footer
- **IMPROVED**: Responsive design yang lebih baik

## 🚨 Breaking Changes

- **Bootstrap Classes**: Semua class Bootstrap telah diganti dengan utility Tailwind CSS
- **jQuery**: Tidak lagi menggunakan jQuery, semua functionality menggunakan vanilla JavaScript
- **External Sliders**: Slick slider diganti dengan custom slider murni JavaScript
- **CSS Framework**: Tidak ada lagi dependency pada framework CSS eksternal

## 🤝 Contributing

1. Fork repository
2. Buat feature branch
3. Commit changes
4. Push ke branch
5. Buat Pull Request

## 📄 License

MIT License - lihat file LICENSE untuk detail.

## 🆘 Support

Untuk support dan pertanyaan:
- Buat issue di repository
- Hubungi ymakarius
- Dokumentasi lengkap tersedia di [OpenDesa Docs](https://docs.opendesadesa.id)

## 🔍 Troubleshooting

### Sidebar Cutting Footer
- Pastikan menggunakan layout yang benar (`left-sidebar.blade.php`, `right-sidebar.blade.php`)
- Layout sudah dioptimasi dengan flexbox untuk mencegah masalah ini

### CSS Not Loading
- Tema menggunakan Tailwind CSS dari CDN
- Pastikan koneksi internet stabil
- Clear browser cache jika diperlukan

### JavaScript Errors
- Semua JavaScript menggunakan vanilla JS
- Tidak ada dependency eksternal
- Check browser console untuk error details

---

**Dibuat dengan ❤️ oleh ymakarius**
