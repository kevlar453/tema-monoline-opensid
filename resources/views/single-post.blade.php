@extends('theme::layouts.left-sidebar')

@section('content')
    <!-- Article Header -->
    <div class="bg-white/80 dark:bg-slate-900/60 backdrop-blur-lg rounded-2xl shadow-soft border border-slate-200/50 dark:border-slate-800 p-6 mb-6 transition-colors duration-300">
        <div class="space-y-4">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-sm text-gray-500 dark:text-slate-400">
                <a href="{{ site_url() }}" class="hover:text-primary-600 transition-colors duration-200">
                    <i class="fas fa-home"></i>
                </a>
                <i class="fas fa-chevron-right text-gray-300 dark:text-slate-700"></i>
                <a href="{{ site_url('artikel') }}" class="hover:text-primary-600 transition-colors duration-200">
                    Artikel
                </a>
                @if (isset($artikel['kategori']))
                    <i class="fas fa-chevron-right text-gray-300"></i>
                    <span>{{ $artikel['kategori'] }}</span>
                @endif
            </nav>
            
            <!-- Article Title -->
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-slate-100 leading-tight">
                {{ $artikel['judul'] ?? 'Judul Artikel' }}
            </h1>
            
            <!-- Article Meta -->
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-slate-400">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-calendar text-primary-500"></i>
                    <span>{{ $artikel['tgl_upload'] ?? date('d M Y') }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-user text-primary-500"></i>
                    <span>{{ $artikel['owner'] ?? 'Admin' }}</span>
                </div>
                @if (isset($artikel['kategori']))
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-folder text-primary-500"></i>
                        <span>{{ $artikel['kategori'] }}</span>
                    </div>
                @endif
                <div class="flex items-center space-x-2">
                    <i class="fas fa-eye text-primary-500"></i>
                    <span>{{ rand(100, 999) }} kali dibaca</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Content -->
    <div class="bg-white/85 dark:bg-slate-900/40 backdrop-blur-lg rounded-2xl shadow-soft border border-slate-200/50 dark:border-slate-800/60 p-8 mb-6 transition-colors duration-300">
        <!-- Featured Image -->
        @if (isset($artikel['gambar']) && !empty($artikel['gambar']))
            <div class="relative mb-8 overflow-hidden rounded-xl">
                <img class="w-full h-64 md:h-80 lg:h-96 object-cover cursor-pointer transition-transform duration-300 hover:scale-105" 
                     src="{{ $artikel['gambar'] }}" 
                     alt="{{ $artikel['judul'] ?? 'Article Image' }}"
                     onclick="openLightbox('{{ $artikel['gambar'] }}', '{{ $artikel['judul'] ?? 'Article Image' }}')">
                
                <!-- Lightbox Trigger Overlay -->
                <div class="absolute inset-0 bg-black/0 hover:bg-black/20 transition-all duration-300 flex items-center justify-center opacity-0 hover:opacity-100">
                    <div class="bg-white/90 backdrop-blur-sm rounded-full p-4 transform translate-y-2 hover:translate-y-0 transition-all duration-300">
                        <i class="fas fa-expand text-gray-700 text-xl"></i>
                    </div>
                </div>
            </div>
        @endif
        
        @php
            $iklan_atas = theme_config('iklan_artikel_atas');
            $iklan_atas_clean = trim(preg_replace('/<!--(.*?)-->/s', '', $iklan_atas));
        @endphp
        @if (!empty($iklan_atas_clean))
            <div class="w-full flex justify-center my-6 overflow-hidden adsense-article-top">
                {!! $iklan_atas !!}
            </div>
        @endif
        
        <!-- Article Text Content -->
        <div class="prose prose-lg max-w-none dark:prose-invert text-slate-800 dark:text-slate-200">
            @if (isset($artikel['isi']))
                {!! $artikel['isi'] !!}
            @else
                <p class="text-gray-600 dark:text-slate-400">Konten artikel tidak tersedia.</p>
            @endif
        </div>

        @php
            $iklan_bawah = theme_config('iklan_artikel_bawah');
            $iklan_bawah_clean = trim(preg_replace('/<!--(.*?)-->/s', '', $iklan_bawah));
        @endphp
        @if (!empty($iklan_bawah_clean))
            <div class="w-full flex justify-center my-6 overflow-hidden adsense-article-bottom">
                {!! $iklan_bawah !!}
            </div>
        @endif
        
        <!-- Article Tags -->
        @if (isset($artikel['tag']) && !empty($artikel['tag']))
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-slate-800/50">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-slate-200 mb-3">Tag:</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach (explode(',', $artikel['tag']) as $tag)
                        <span class="bg-primary-100 dark:bg-primary-950/40 text-primary-700 dark:text-primary-400 px-3 py-1 rounded-full text-sm font-medium hover:bg-primary-200 dark:hover:bg-primary-900/40 transition-colors duration-200">
                            {{ trim($tag) }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Related Articles -->
    <div class="bg-white/80 dark:bg-slate-900/60 backdrop-blur-lg rounded-2xl shadow-soft border border-slate-200/50 dark:border-slate-800 p-6 mb-6 transition-colors duration-300">
        <h3 class="text-xl font-bold text-gray-900 dark:text-slate-100 mb-4">Artikel Terkait</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @for ($i = 1; $i <= 3; $i++)
                <article class="group bg-gray-50 dark:bg-slate-950/40 rounded-xl p-4 hover:bg-white dark:hover:bg-slate-900/30 hover:shadow-md transition-all duration-300 border border-gray-100 dark:border-slate-800 hover:border-primary-200 dark:hover:border-primary-900/50">
                    <div class="relative mb-3 overflow-hidden rounded-lg">
                        <div class="w-full h-32 bg-gray-200 rounded-lg flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-2xl"></i>
                        </div>
                    </div>
                    <h4 class="font-semibold text-gray-900 dark:text-slate-200 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors duration-200 mb-2">
                        Artikel Terkait {{ $i }}
                    </h4>
                    <p class="text-gray-600 dark:text-slate-400 text-sm text-xs line-clamp-2">
                        Ini adalah artikel terkait yang mungkin menarik untuk dibaca.
                    </p>
                </article>
            @endfor
        </div>
    </div>

    <!-- Social Share -->
    <div class="bg-white/80 dark:bg-slate-900/60 backdrop-blur-lg rounded-2xl shadow-soft border border-slate-200/50 dark:border-slate-800 p-6 mb-6 transition-colors duration-300">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-slate-100 mb-4">Bagikan Artikel:</h3>
        <div class="flex items-center space-x-4">
            <a href="#" class="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fab fa-facebook-f"></i>
                <span>Facebook</span>
            </a>
            <a href="#" class="flex items-center space-x-2 bg-blue-400 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors duration-200">
                <i class="fab fa-twitter"></i>
                <span>Twitter</span>
            </a>
            <a href="#" class="flex items-center space-x-2 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200">
                <i class="fab fa-whatsapp"></i>
                <span>WhatsApp</span>
            </a>
            <a href="#" class="flex items-center space-x-2 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors duration-200">
                <i class="fas fa-envelope"></i>
                <span>Email</span>
            </a>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="bg-white dark:bg-slate-900/60 rounded-2xl shadow-lg border border-gray-200 dark:border-slate-800 p-6 transition-colors duration-300">
        <h3 class="text-xl font-bold text-gray-900 dark:text-slate-100 mb-4">Komentar (0)</h3>
        <div class="text-center py-8 text-gray-500 dark:text-slate-400">
            <i class="fas fa-comments text-4xl mb-4 text-gray-300 dark:text-slate-700"></i>
            <p>Belum ada komentar untuk artikel ini.</p>
            <p class="text-sm">Jadilah yang pertama memberikan komentar!</p>
        </div>
    </div>
</div>

<!-- Lightbox Modal -->
<div id="lightboxModal" class="fixed inset-0 bg-black bg-opacity-95 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative max-w-6xl w-full">
            <!-- Close Button -->
            <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300 text-3xl z-10 bg-black/50 hover:bg-black/70 rounded-full w-12 h-12 flex items-center justify-center transition-all duration-200">
                <i class="fas fa-times"></i>
            </button>
            
            <!-- Image Container -->
            <div class="relative">
                <img id="lightboxImage" src="" alt="" class="w-full h-auto max-h-[85vh] object-contain rounded-lg">
                <div id="lightboxCaption" class="text-white text-center mt-4 text-lg font-medium"></div>
            </div>
            
            <!-- Download Button -->
            <button id="downloadImage" class="absolute bottom-4 right-4 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-all duration-200 backdrop-blur-sm">
                <i class="fas fa-download"></i>
            </button>
        </div>
    </div>
</div>

<script>
// Lightbox functionality
function openLightbox(imageSrc, caption) {
    const modal = document.getElementById('lightboxModal');
    const image = document.getElementById('lightboxImage');
    const captionEl = document.getElementById('lightboxCaption');
    const downloadBtn = document.getElementById('downloadImage');
    
    image.src = imageSrc;
    captionEl.textContent = caption;
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Setup download functionality
    downloadBtn.onclick = function() {
        const link = document.createElement('a');
        link.href = imageSrc;
        link.download = caption.replace(/[^a-z0-9]/gi, '_').toLowerCase() + '.jpg';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    };
}

function closeLightbox() {
    const modal = document.getElementById('lightboxModal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

// Close lightbox on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    }
});

// Close lightbox on overlay click
document.getElementById('lightboxModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLightbox();
    }
});

// Add lightbox to all images in article content
document.addEventListener('DOMContentLoaded', function() {
    const articleContent = document.querySelector('.prose');
    if (articleContent) {
        const images = articleContent.querySelectorAll('img');
        images.forEach(img => {
            img.style.cursor = 'pointer';
            img.addEventListener('click', function() {
                openLightbox(this.src, this.alt || 'Article Image');
            });
            
            // Add hover effect
            img.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.02)';
                this.style.transition = 'transform 0.2s ease-in-out';
            });
            
            img.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
    }
});

// Social share functionality
function shareToSocial(platform, url, title) {
    const shareUrls = {
        facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`,
        twitter: `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`,
        whatsapp: `https://wa.me/?text=${encodeURIComponent(title + ' ' + url)}`,
        email: `mailto:?subject=${encodeURIComponent(title)}&body=${encodeURIComponent('Baca artikel ini: ' + url)}`
    };
    
    if (shareUrls[platform]) {
        window.open(shareUrls[platform], '_blank', 'width=600,height=400');
    }
}

// Add click handlers to social share buttons
document.addEventListener('DOMContentLoaded', function() {
    const currentUrl = window.location.href;
    const currentTitle = document.title;
    
    document.querySelectorAll('[href="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const platform = this.textContent.toLowerCase().replace(/\s+/g, '');
            shareToSocial(platform, currentUrl, currentTitle);
        });
    });
});
</script>

<style>
/* Line clamp utilities */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Prose styling */
.prose {
    color: #374151;
    line-height: 1.75;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #111827;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.prose h1 { font-size: 1.875rem; }
.prose h2 { font-size: 1.5rem; }
.prose h3 { font-size: 1.25rem; }
.prose h4 { font-size: 1.125rem; }

.prose p {
    margin-bottom: 1.25rem;
}

.prose ul, .prose ol {
    margin-bottom: 1.25rem;
    padding-left: 1.5rem;
}

.prose li {
    margin-bottom: 0.5rem;
}

.prose blockquote {
    border-left: 4px solid #e5e7eb;
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #6b7280;
}

.prose code {
    background-color: #f3f4f6;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
    font-size: 0.875rem;
    color: #0369a1;
}

.prose pre {
    background-color: #1f2937;
    color: #f9fafb;
    padding: 1rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 1.5rem 0;
}

.prose pre code {
    background-color: transparent;
    padding: 0;
    color: inherit;
}

.prose table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5rem 0;
}

.prose th, .prose td {
    border: 1px solid #e5e7eb;
    padding: 0.75rem;
    text-align: left;
}

.prose th {
    background-color: #f9fafb;
    font-weight: 600;
}

/* Lightbox animations */
#lightboxModal {
    transition: opacity 0.3s ease-in-out;
}

#lightboxModal img {
    transition: transform 0.3s ease-in-out;
}

#lightboxModal:hover img {
    transform: scale(1.01);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .prose h1 { font-size: 1.5rem; }
    .prose h2 { font-size: 1.25rem; }
    .prose h3 { font-size: 1.125rem; }
    
    .social-share-buttons {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .social-share-buttons a {
        justify-content: center;
    }
}

/* Hover effects for images */
.prose img:hover {
    transform: scale(1.02);
    transition: transform 0.2s ease-in-out;
}

/* Tag hover effects */
.tag:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: all 0.2s ease-in-out;
}
</style>
