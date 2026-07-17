<!-- Slider Container -->
<div class="relative overflow-hidden rounded-2xl shadow-lg mb-8 bg-white">
    <div class="slider-container relative">
        @php $active = true; @endphp
        @foreach ($slider_gambar['gambar'] as $gambar)
            @php
                // Fix filename (replace "/" with ".")
                $clean_filename = str_replace('/', '.', $gambar['gambar']);

                // Browser URL
                $file_url = is_file($file_path)?base_url($slider_gambar['lokasi'] . 'sedang_' . $clean_filename):"https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D";

                // Filesystem path
                $file_path = FCPATH . $slider_gambar['lokasi'] . 'sedang_' . $clean_filename;
            @endphp

            @if (is_file($file_path))
                <div class="slider-slide {{ $active ? 'active' : '' }} {{ $slider_gambar['sumber'] != 3 ? 'cursor-pointer' : '' }}"
                     data-artikel="{{ $gambar['id'] }}"
                     @if ($slider_gambar['sumber'] != 3)
                         onclick="location.href='{{ ci_route('artikel.' . buat_slug($gambar)) }}'"
                     @endif>

                    <div class="relative group">
                        <!-- Image -->
                        <img class="w-full h-64 md:h-80 lg:h-96 object-cover transition-transform duration-700 group-hover:scale-105"
                             src="{{ $file_url }}"
                             alt="{{ $gambar['judul'] ?? 'Slider Image' }}"
                             loading="lazy">

                        <!-- Overlay for clickable images -->
                        @if ($slider_gambar['sumber'] != 3)
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
                                <div class="bg-white/90 backdrop-blur-sm rounded-full p-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                    <i class="fas fa-external-link-alt text-gray-700 text-xl"></i>
                                </div>
                            </div>
                        @endif

                        <!-- Title Overlay -->
                        @if ($gambar['judul'])
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-6">
                                <h3 class="text-white text-lg md:text-xl lg:text-2xl font-bold leading-tight">
                                    {{ $gambar['judul'] }}
                                </h3>
                            </div>
                        @endif
                    </div>
                </div>
                @php $active = false; @endphp
            @endif
        @endforeach
    </div>

    <!-- Navigation Arrows -->
    <button class="slider-prev absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 hover:text-primary-600 p-3 rounded-full shadow-lg transition-all duration-300 z-10 opacity-0 hover:opacity-100 group-hover:opacity-100"
            aria-label="Previous slide">
        <i class="fas fa-chevron-left text-lg"></i>
    </button>

    <button class="slider-next absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 hover:text-primary-600 p-3 rounded-full shadow-lg transition-all duration-300 z-10 opacity-0 hover:opacity-100 group-hover:opacity-100"
            aria-label="Next slide">
        <i class="fas fa-chevron-right text-lg"></i>
    </button>

    <!-- Dots Navigation -->
    <div class="slider-dots absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
        @foreach ($slider_gambar['gambar'] as $index => $gambar)
            @php
                $clean_filename = str_replace('/', '.', $gambar['gambar']);
                $file_url = base_url($slider_gambar['lokasi'] . 'sedang_' . $clean_filename);
                $file_path = FCPATH . $slider_gambar['lokasi'] . 'sedang_' . $clean_filename;
            @endphp

            @if (is_file($file_path))
                <button class="slider-dot w-3 h-3 rounded-full bg-white/60 hover:bg-white transition-all duration-200 {{ $index === 0 ? 'bg-white' : '' }}"
                        data-slide="{{ $index }}"
                        aria-label="Go to slide {{ $index + 1 }}">
                </button>
            @endif
        @endforeach
    </div>
</div>

<!-- Custom Slider JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sliderContainer = document.querySelector('.slider-container');
    const slides = document.querySelectorAll('.slider-slide');
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    const dots = document.querySelectorAll('.slider-dot');

    if (!sliderContainer || slides.length === 0) return;

    let currentSlide = 0;
    const totalSlides = slides.length;

    // Initialize slider
    function initSlider() {
    slides.forEach((slide, index) => {
        slide.classList.toggle('active', index === 0);
    });
}

function showSlide(index) {
    if (index < 0) index = totalSlides - 1;
    if (index >= totalSlides) index = 0;

    slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
    });

    dots.forEach((dot, dotIndex) => {
        dot.classList.toggle('bg-white', dotIndex === index);
        dot.classList.toggle('bg-white/60', dotIndex !== index);
    });

    currentSlide = index;
}


    // Next slide
    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    // Previous slide
    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    // Event listeners
    if (prevBtn) prevBtn.addEventListener('click', prevSlide);
    if (nextBtn) nextBtn.addEventListener('click', nextSlide);

    // Dot navigation
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => showSlide(index));
    });

    // Auto-play
    let autoPlayInterval = setInterval(nextSlide, 5000);

    // Pause on hover
    sliderContainer.addEventListener('mouseenter', () => {
        clearInterval(autoPlayInterval);
    });

    sliderContainer.addEventListener('mouseleave', () => {
        autoPlayInterval = setInterval(nextSlide, 5000);
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') prevSlide();
        if (e.key === 'ArrowRight') nextSlide();
    });

    // Touch/swipe support
    let startX = 0;
    let endX = 0;

    sliderContainer.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });

    sliderContainer.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        handleSwipe();
    });

    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = startX - endX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                nextSlide(); // Swipe left
            } else {
                prevSlide(); // Swipe right
            }
        }
    }

    // Initialize
    initSlider();

    // Prevent right-click on images
    slides.forEach(slide => {
        const img = slide.querySelector('img');
        if (img) {
            img.addEventListener('contextmenu', (e) => e.preventDefault());
        }
    });
});
</script>

<style>
.slider-container {
    position: relative;
    width: 100%;
    height: 40vh; /* h-96 ~ adjust as needed */
    overflow: hidden;
}

@media (min-width: 768px) {
    .slider-container {
        height: 60vh; /* md:h-128 */
    }
}

@media (min-width: 1024px) {
    .slider-container {
        height: 70vh; /* lg:h-144 */
    }
}

.slider-slide {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    z-index: 0;
    transition: opacity 0.8s ease-in-out;
}

.slider-slide.active {
    opacity: 1;
    z-index: 1;
}

.slider-slide img {
width: 100%;
height: 100%;
object-fit: cover;
object-position: center center;
}

</style>
