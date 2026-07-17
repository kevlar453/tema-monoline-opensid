/**
 * Tema Cursor Tailwind CSS - Pure Tailwind Theme JavaScript
 * OpenSID Theme with modern Tailwind CSS - No Bootstrap dependencies
 */

(function() {
    'use strict';

    // Theme configuration
    const themeConfig = {
        primaryColor: '#0284c7',
        secondaryColor: '#0d9488',
        animationDuration: 300,
        scrollThreshold: 300
    };

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        initializeTheme();
        setupEventListeners();
        setupMobileMenu();
        setupScrollEffects();
        setupThemeCustomization();
        initializeComponents();
        ensureDesktopMenu(); // Force desktop menu visibility
    });

    /**
     * Initialize theme functionality
     */
    function initializeTheme() {
        console.log('🎨 Tema Cursor Tailwind CSS (Pure) initialized');
        
        // Add theme class to body
        document.body.classList.add('theme-cursor-tailwind', 'pure-tailwind');
        
        // Set CSS custom properties
        const root = document.documentElement;
        root.style.setProperty('--color-primary', themeConfig.primaryColor);
        root.style.setProperty('--color-secondary', themeConfig.secondaryColor);
    }

    /**
     * Initialize all theme components
     */
    function initializeComponents() {
        initializeSlider();
        initializeProgressBars();
        initializeLazyLoading();
        initializeAnimations();
    }

    /**
     * Setup event listeners
     */
    function setupEventListeners() {
        // Search form enhancement
        const searchForm = document.querySelector('form[action*="cari"]');
        if (searchForm) {
            searchForm.addEventListener('submit', enhanceSearchForm);
        }

        // External links enhancement
        const externalLinks = document.querySelectorAll('a[target="_blank"]');
        externalLinks.forEach(link => {
            link.addEventListener('click', handleExternalLink);
        });

        // Form inputs enhancement
        const formInputs = document.querySelectorAll('input, textarea, select');
        formInputs.forEach(input => {
            input.addEventListener('focus', enhanceFormInput);
            input.addEventListener('blur', enhanceFormInput);
        });

        // Add smooth scrolling to all internal links
        const internalLinks = document.querySelectorAll('a[href^="#"]');
        internalLinks.forEach(link => {
            link.addEventListener('click', handleInternalLink);
        });
    }

    /**
     * Setup mobile menu functionality
     */
    function setupMobileMenu() {
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
        const mobileMenuClose = document.querySelector('.mobile-menu-close');
        const mobileMenu = document.querySelector('.mobile-menu');

        if (!mobileMenuButton || !mobileMenuOverlay) return;

        function openMobileMenu() {
            mobileMenuOverlay.classList.remove('hidden');
            mobileMenu.classList.add('translate-x-0');
            mobileMenu.classList.remove('-translate-x-full');
            document.body.style.overflow = 'hidden';
            
            // Add animation classes
            mobileMenu.classList.add('animate-slide-in-right');
        }

        function closeMobileMenu() {
            mobileMenuOverlay.classList.add('hidden');
            mobileMenu.classList.remove('translate-x-0');
            mobileMenu.classList.add('-translate-x-full');
            document.body.style.overflow = '';
            
            // Remove animation classes
            mobileMenu.classList.remove('animate-slide-in-right');
        }

        mobileMenuButton.addEventListener('click', openMobileMenu);
        mobileMenuClose.addEventListener('click', closeMobileMenu);
        
        // Close on overlay click
        mobileMenuOverlay.addEventListener('click', function(e) {
            if (e.target === mobileMenuOverlay) {
                closeMobileMenu();
            }
        });

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeMobileMenu();
            }
        });
    }

    /**
     * Setup scroll effects
     */
    function setupScrollEffects() {
        const scrollToTopBtn = document.getElementById('scrollToTop');
        if (!scrollToTopBtn) return;

        window.addEventListener('scroll', function() {
            if (window.pageYOffset > themeConfig.scrollThreshold) {
                scrollToTopBtn.classList.remove('opacity-0', 'invisible');
                scrollToTopBtn.classList.add('opacity-100', 'visible');
            } else {
                scrollToTopBtn.classList.add('opacity-0', 'invisible');
                scrollToTopBtn.classList.remove('opacity-100', 'visible');
            }
        });

        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    /**
     * Setup theme customization
     */
    function setupThemeCustomization() {
        // Add theme toggle functionality (for future dark mode)
        const themeToggle = document.querySelector('[data-theme-toggle]');
        if (themeToggle) {
            themeToggle.addEventListener('click', toggleTheme);
        }
    }

    /**
     * Ensure desktop menu is visible - CRITICAL FUNCTION
     */
    function ensureDesktopMenu() {
        console.log('🔧 Ensuring desktop menu visibility...');
        
        const desktopMenu = document.getElementById('desktopMenu');
        if (!desktopMenu) {
            console.error('❌ Desktop menu element not found!');
            return;
        }

        // Force show on large screens
        if (window.innerWidth >= 1024) {
            desktopMenu.style.display = 'flex';
            desktopMenu.classList.remove('hidden');
            desktopMenu.classList.add('lg:flex');
            console.log('✅ Desktop menu should be visible now');
            
            // Additional debugging
            console.log('Menu element:', desktopMenu);
            console.log('Menu display style:', desktopMenu.style.display);
            console.log('Menu classes:', desktopMenu.className);
            console.log('Window width:', window.innerWidth);
        } else {
            console.log('📱 Mobile view detected, hiding desktop menu');
            desktopMenu.style.display = 'none';
        }
    }

    /**
     * Initialize slider functionality (Pure JavaScript)
     */
    function initializeSlider() {
        const slider = document.querySelector('.slider-container');
        if (!slider) return;

        // Slider is already initialized in the HTML
        console.log('✅ Custom slider initialized');
    }

    /**
     * Initialize progress bars with intersection observer
     */
    function initializeProgressBars() {
        const progressBars = document.querySelectorAll('.progress-bar');
        if (progressBars.length === 0) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const bar = entry.target;
                    const width = bar.style.width;
                    if (width) {
                        // Animate progress bar
                        bar.style.transition = 'width 1.5s cubic-bezier(0.4, 0, 0.2, 1)';
                        bar.style.width = width;
                        
                        // Add shimmer effect
                        bar.classList.add('animate-shimmer');
                    }
                }
            });
        }, { threshold: 0.1 });

        progressBars.forEach(bar => observer.observe(bar));
    }

    /**
     * Initialize lazy loading for images
     */
    function initializeLazyLoading() {
        const images = document.querySelectorAll('img[data-src]');
        if ('IntersectionObserver' in window && images.length > 0) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            images.forEach(img => imageObserver.observe(img));
        }
    }

    /**
     * Initialize animations
     */
    function initializeAnimations() {
        // Add animation classes to elements when they come into view
        const animatedElements = document.querySelectorAll('[data-animate]');
        
        if ('IntersectionObserver' in window && animatedElements.length > 0) {
            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        const animation = element.dataset.animate;
                        element.classList.add(animation);
                        animationObserver.unobserve(element);
                    }
                });
            }, { threshold: 0.1 });

            animatedElements.forEach(element => animationObserver.observe(element));
        }
    }

    /**
     * Enhance search form
     */
    function enhanceSearchForm(e) {
        const searchInput = e.target.querySelector('input[name="cari"]');
        if (searchInput && searchInput.value.trim() === '') {
            e.preventDefault();
            searchInput.focus();
            searchInput.classList.add('animate-pulse');
            setTimeout(() => {
                searchInput.classList.remove('animate-pulse');
            }, 1000);
        }
    }

    /**
     * Handle external links
     */
    function handleExternalLink(e) {
        // Add loading state
        const link = e.target.closest('a');
        if (link) {
            link.classList.add('opacity-75');
            setTimeout(() => {
                link.classList.remove('opacity-75');
            }, 1000);
        }
    }

    /**
     * Handle internal links with smooth scrolling
     */
    function handleInternalLink(e) {
        const href = this.getAttribute('href');
        if (href === '#') return;
        
        const target = document.querySelector(href);
        if (target) {
            e.preventDefault();
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }

    /**
     * Enhance form inputs
     */
    function enhanceFormInput(e) {
        const input = e.target;
        const parent = input.closest('.form-group') || input.parentElement;
        
        if (e.type === 'focus') {
            parent.classList.add('ring-2', 'ring-primary-500', 'ring-offset-2');
        } else {
            parent.classList.remove('ring-2', 'ring-primary-500', 'ring-offset-2');
        }
    }

    /**
     * Toggle theme (for future dark mode)
     */
    function toggleTheme() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        
        // Update toggle button
        const toggle = document.querySelector('[data-theme-toggle]');
        if (toggle) {
            const icon = toggle.querySelector('i');
            if (icon) {
                icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            }
        }
    }

    /**
     * Utility function to add loading state
     */
    function addLoadingState(element, text = 'Loading...') {
        if (!element) return;
        
        const originalContent = element.innerHTML;
        element.innerHTML = `
            <div class="flex items-center space-x-2">
                <div class="animate-spin rounded-full border-2 border-gray-300 border-t-primary-600 w-4 h-4"></div>
                <span>${text}</span>
            </div>
        `;
        
        return function() {
            element.innerHTML = originalContent;
        };
    }

    /**
     * Utility function to show notification
     */
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 p-4 rounded-xl shadow-lg transition-all duration-300 transform translate-x-full max-w-sm`;
        
        const colors = {
            success: 'bg-green-500 text-white',
            error: 'bg-red-500 text-white',
            warning: 'bg-yellow-500 text-white',
            info: 'bg-blue-500 text-white'
        };
        
        notification.className += ` ${colors[type] || colors.info}`;
        
        notification.innerHTML = `
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <i class="fas fa-${getNotificationIcon(type)} text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium">${message}</p>
                </div>
                <button class="text-white/80 hover:text-white transition-colors" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        // Auto remove
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }, 4000);
    }

    /**
     * Get notification icon based on type
     */
    function getNotificationIcon(type) {
        const icons = {
            success: 'check-circle',
            error: 'exclamation-circle',
            warning: 'exclamation-triangle',
            info: 'info-circle'
        };
        return icons[type] || icons.info;
    }

    /**
     * Add smooth reveal animation to elements
     */
    function addRevealAnimation() {
        const elements = document.querySelectorAll('.reveal-on-scroll');
        
        if ('IntersectionObserver' in window && elements.length > 0) {
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            elements.forEach(element => revealObserver.observe(element));
        }
    }

    /**
     * Initialize tooltips
     */
    function initializeTooltips() {
        const tooltipElements = document.querySelectorAll('[data-tooltip]');
        
        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', showTooltip);
            element.addEventListener('mouseleave', hideTooltip);
        });
    }

    /**
     * Show tooltip
     */
    function showTooltip(e) {
        const tooltipText = e.target.dataset.tooltip;
        if (!tooltipText) return;

        const tooltip = document.createElement('div');
        tooltip.className = 'absolute z-50 px-2 py-1 text-xs text-white bg-gray-900 rounded shadow-lg whitespace-nowrap';
        tooltip.textContent = tooltipText;
        tooltip.id = 'tooltip';

        document.body.appendChild(tooltip);

        const rect = e.target.getBoundingClientRect();
        tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
        tooltip.style.top = rect.top - tooltip.offsetHeight - 5 + 'px';
    }

    /**
     * Hide tooltip
     */
    function hideTooltip() {
        const tooltip = document.getElementById('tooltip');
        if (tooltip) {
            tooltip.remove();
        }
    }

    // Initialize additional features
    document.addEventListener('DOMContentLoaded', function() {
        addRevealAnimation();
        initializeTooltips();
    });

    // Window resize handler for desktop menu
    window.addEventListener('resize', function() {
        ensureDesktopMenu();
    });

    // Window load handler for desktop menu
    window.addEventListener('load', function() {
        ensureDesktopMenu();
    });

    // Expose utility functions globally
    window.themeUtils = {
        addLoadingState,
        showNotification,
        toggleTheme,
        addRevealAnimation,
        ensureDesktopMenu
    };

})();
