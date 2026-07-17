<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('theme::commons.meta')

    <!-- Google Fonts: Oswald & Inter (Monoline Style) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f7ff',
                            100: '#e0f0fe',
                            200: '#b9e0fe',
                            300: '#7cc7fd',
                            400: '#36abfa',
                            500: '#0c8ef2',
                            600: '#1a63a6', /* Monoline Primary Blue */
                            700: '#035c9e',
                            800: '#074e82',
                            900: '#0c416b',
                            950: '#082a49',
                        },
                        accent: {
                            400: '#ffc733',
                            500: '#ffb900', /* Monoline Yellow Accent */
                            600: '#e6a600',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
                        heading: ['Oswald', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Theme JavaScript -->
    <script src="{{ theme_asset('js/theme.js') }}" defer></script>

    <!-- Custom Styles -->
    <style>
        /* Ensure desktop menu is visible */
        @media (min-width: 1024px) {
            .lg\:flex {
                display: flex !important;
            }
            .lg\:hidden {
                display: none !important;
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #0284c7;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #0d9488;
        }

        /* Loading animation */
        .loading {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Focus states */
        .focus-visible:focus {
            outline: 2px solid #0284c7;
            outline-offset: 2px;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased min-h-screen flex flex-col" onLoad="renderDate()">
    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="fixed bottom-8 right-8 bg-primary-600 text-white p-3 rounded-full shadow-lg hover:bg-primary-700 transition-all duration-300 opacity-0 invisible z-50 group">
        <i class="fas fa-arrow-up group-hover:scale-110 transition-transform duration-200"></i>
    </button>

    <!-- Main Container with proper flexbox layout -->
    <div class="flex flex-col min-h-screen">
        <!-- Header -->
        <header id="header" class="relative z-50 flex-shrink-0">
            @include('theme::partials.header')
        </header>

        <!-- Navigation -->
        <nav id="navarea" class="flex-shrink-0 relative z-40 w-full shadow-sm">
            @include('theme::partials.menu_head')
        </nav>

        <!-- Main Content Area - This will expand to fill available space -->
        <main class="flex-1 flex-grow bg-slate-50">
            @yield('layout')
        </main>

        <!-- Footer - This will stay at bottom -->
        <footer id="footer" class="flex-shrink-0 mt-auto relative z-10 w-full" style="background-image: url('{{ theme_asset('img/bg/footer.png') }}'); background-size: 100% 100%; padding-top: 80px; padding-bottom: 50px;">
            @include('theme::partials.footer_top')
            @include('theme::partials.footer_bottom')
        </footer>
    </div>

    @include('theme::commons.meta_footer')

    <!-- JavaScript -->
    <script>
        // Format Rupiah function
        function formatRupiah(angka, prefix = 'Rp ') {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '') + ',00';
        }

        // Scroll to top functionality
        document.addEventListener('DOMContentLoaded', function() {
            const scrollToTopBtn = document.getElementById('scrollToTop');

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
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

            // Add loading animation to images
            const images = document.querySelectorAll('img');
            images.forEach(img => {
                img.addEventListener('load', function() {
                    this.classList.remove('loading');
                });
                img.addEventListener('error', function() {
                    this.classList.remove('loading');
                });
            });
        });

        // Ensure menu is visible on desktop
        function ensureDesktopMenu() {
            if (window.innerWidth >= 1024) {
                const desktopNav = document.querySelector('.lg\\:flex');
                if (desktopNav) {
                    desktopNav.style.display = 'flex';
                }
            }
        }

        // Call on load and resize
        window.addEventListener('load', ensureDesktopMenu);
        window.addEventListener('resize', ensureDesktopMenu);
    </script>

    @stack('scripts')
</body>
</html>
