<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('theme::commons.meta')

    <!-- Dark Mode Handler (Avoids FOUC) -->
    <script>
        (function() {
            const isDark = localStorage.getItem('darkMode') === 'true' || 
                           (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
            if (isDark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <!-- Google Fonts: Oswald & Inter (Monoline Style) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
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
                        heading: ['Plus Jakarta Sans', 'Oswald', 'sans-serif'],
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

        /* Cyber Grid Background Overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: 
                linear-gradient(to right, rgba(26, 99, 166, 0.02) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(26, 99, 166, 0.02) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
            z-index: -20;
            transition: background-image 0.3s;
        }
        
        .dark body::before {
            background-image: 
                linear-gradient(to right, rgba(56, 189, 248, 0.015) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(56, 189, 248, 0.015) 1px, transparent 1px);
        }
        
        /* Subtle radial pulse overlay */
        .cyber-radial {
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at 50% 50%, rgba(26, 99, 166, 0.02) 0%, transparent 80%);
            pointer-events: none;
            z-index: -19;
            transition: background 0.3s;
        }
        
        .dark .cyber-radial {
            background: radial-gradient(circle at 50% 50%, rgba(56, 189, 248, 0.02) 0%, transparent 80%);
        }

        /* Force rich-text content text tags to inherit color in dark mode to override inline editor styles */
        .dark .prose span,
        .dark .prose p,
        .dark .prose li,
        .dark .prose font,
        .dark .prose strong,
        .dark .prose em,
        .dark .prose h1,
        .dark .prose h2,
        .dark .prose h3,
        .dark .prose h4,
        .dark .prose h5,
        .dark .prose h6 {
            color: inherit !important;
        }

        /* Dark Mode table styles */
        .dark table,
        .dark .table,
        .dark table tbody,
        .dark .table tbody {
            background-color: #0f172a !important;
            color: #cbd5e1 !important;
            border-color: #334155 !important;
        }

        .dark table th,
        .dark table td,
        .dark .table th,
        .dark .table td {
            color: #cbd5e1 !important;
            border-color: #334155 !important;
        }

        .dark table tr,
        .dark .table tr {
            background-color: transparent !important;
        }

        .dark table thead th,
        .dark table thead td,
        .dark .table thead th,
        .dark .table thead td {
            background-color: #1e293b !important;
            color: #f8fafc !important;
            border-color: #475569 !important;
        }

        /* Zebra striping for dark mode tables */
        .dark tbody tr:nth-of-type(odd),
        .dark .table-striped tbody tr:nth-of-type(odd),
        .dark table.table-striped tbody tr:nth-of-type(odd),
        .dark tr.odd {
            background-color: rgba(30, 41, 59, 0.45) !important;
        }

        .dark tbody tr:nth-of-type(even),
        .dark .table-striped tbody tr:nth-of-type(even),
        .dark table.table-striped tbody tr:nth-of-type(even),
        .dark tr.even {
            background-color: #0f172a !important;
        }

        /* Hover effect for rows in dark mode */
        .dark .table-hover tbody tr:hover,
        .dark table tbody tr:hover {
            background-color: rgba(30, 41, 59, 0.8) !important;
            color: #ffffff !important;
        }

        /* Link colors inside tables in dark mode */
        .dark table td a,
        .dark .table td a {
            color: #38bdf8 !important;
            text-decoration: none;
        }

        .dark table td a:hover,
        .dark .table td a:hover {
            color: #0ea5e9 !important;
            text-decoration: underline;
        }

        /* DataTables length/search controls in dark mode */
        .dark .dataTables_wrapper,
        .dark .dataTables_info,
        .dark .dataTables_length,
        .dark .dataTables_filter,
        .dark .dataTables_paginate {
            color: #94a3b8 !important;
        }

        .dark .dataTables_wrapper select,
        .dark .dataTables_wrapper input {
            background-color: #1e293b !important;
            color: #f1f5f9 !important;
            border: 1px solid #475569 !important;
            border-radius: 6px !important;
            padding: 4px 8px !important;
            outline: none !important;
        }

        .dark .dataTables_wrapper select:focus,
        .dark .dataTables_wrapper input:focus {
            border-color: #38bdf8 !important;
        }

        /* DataTables pagination buttons in dark mode */
        .dark .dataTables_paginate .paginate_button {
            color: #94a3b8 !important;
            border: 1px solid transparent !important;
            background: transparent !important;
        }

        .dark .dataTables_paginate .paginate_button.current,
        .dark .dataTables_paginate .paginate_button.current:hover {
            color: #ffffff !important;
            background-color: #0284c7 !important;
            border-color: #0284c7 !important;
            border-radius: 6px !important;
        }

        .dark .dataTables_paginate .paginate_button:hover {
            color: #ffffff !important;
            background-color: #1e293b !important;
            border-color: #475569 !important;
            border-radius: 6px !important;
        }
    </style>
</head>

<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 font-sans antialiased min-h-screen flex flex-col transition-colors duration-300" onLoad="renderDate()">
    @include('theme::partials.holiday_helper')
    @php
        $todayHoliday = null;
        if (class_exists('HolidayHelper')) {
            $todayHoliday = HolidayHelper::getTodayHoliday();
        }
    @endphp
    @if ($todayHoliday)
        <!-- Holiday Alert Banner -->
        <div class="w-full bg-gradient-to-r from-rose-600 via-amber-600 to-rose-600 text-white py-3.5 px-4 text-center text-xs lg:text-sm font-semibold tracking-wide shadow-md flex items-center justify-center gap-2 relative z-50 transition-all duration-300">
            <i class="fas fa-exclamation-circle animate-pulse text-sm lg:text-base flex-shrink-0"></i>
            <span>HARI LIBUR NASIONAL: <strong class="underline">{{ strtoupper($todayHoliday) }}</strong> - Pelayanan Kantor Tutup. Gunakan Layanan Mandiri untuk keperluan online.</span>
        </div>
    @endif
    <!-- Cyber background elements -->
    <div class="cyber-radial"></div>
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

        @php
            $iklan_header = theme_config('iklan_header');
            $iklan_header_clean = trim(preg_replace('/<!--(.*?)-->/s', '', $iklan_header));
        @endphp
        @if (!empty($iklan_header_clean))
            <div class="container mx-auto px-4 mt-6 max-w-[1200px] flex justify-center">
                <div class="w-full overflow-hidden flex justify-center py-2 bg-white rounded-xl border border-gray-200 shadow-sm adsense-header-container">
                    {!! $iklan_header !!}
                </div>
            </div>
        @endif

        <!-- Main Content Area - This will expand to fill available space -->
        <main class="flex-1 flex-grow bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
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
