@extends('theme::layouts.full-content')
@include('theme::commons.asset_highcharts')

@section('content')
    <div class="bg-white/80 dark:bg-slate-900/40 backdrop-blur-lg rounded-2xl border border-slate-200/50 dark:border-slate-800/50 p-6 md:p-8 shadow-soft transition-all duration-300">
        <h2 class="text-2xl font-extrabold text-slate-800 dark:text-slate-200 mb-6 font-heading tracking-tight border-b border-slate-100 dark:border-slate-800/30 pb-4">
            Struktur Organisasi dan Tata Kerja {{ setting('sebutan_pemerintah_desa') }}
        </h2>
        <div class="w-full overflow-x-auto">
            <div id="sotk-list" class="min-w-[800px] w-full">
                <div class="text-center py-12 text-slate-500"><i class="fas fa-spinner fa-spin text-3xl text-primary-500 mb-3"></i><p class="font-bold text-sm">Memuat SOTK...</p></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var strukturPemerintah = [];
            var strukturSotk = [];

            function loadHighcharts(pemerintahNodes, sotkLinks) {
                const isDark = document.documentElement.classList.contains('dark');
                
                // Color configuration
                const level0Color = isDark ? '#fbbf24' : '#ffb900'; // Emas/Yellow
                const level1Color = isDark ? '#38bdf8' : '#1a63a6'; // Biru Monoline
                const level2Color = isDark ? '#0284c7' : '#074e82'; // Biru Tua
                const level3Color = isDark ? '#0d9488' : '#0f766e'; // Teal
                const defaultNodeColor = isDark ? '#1e293b' : '#f8fafc';
                const linkColor = isDark ? '#475569' : '#cbd5e1';
                const textColor = isDark ? '#e2e8f0' : '#1e293b';
                const borderColor = isDark ? '#334155' : '#cbd5e1';

                // Map custom colors dynamically for BPD, LPM, and levels
                const nodesData = pemerintahNodes.map(node => {
                    let finalNode = Object.assign({}, node);
                    if (finalNode.id === 'BPD' || finalNode.id === 'LPM') {
                        finalNode.color = level0Color;
                        finalNode.dataLabels = { color: '#1e293b' };
                    } else if (finalNode.column === 1) {
                        finalNode.color = level1Color;
                        finalNode.dataLabels = { color: '#ffffff' };
                    } else if (finalNode.column === 2) {
                        finalNode.color = level2Color;
                        finalNode.dataLabels = { color: '#ffffff' };
                    } else if (finalNode.column >= 3) {
                        finalNode.color = level3Color;
                        finalNode.dataLabels = { color: '#ffffff' };
                    } else {
                        finalNode.color = defaultNodeColor;
                        finalNode.dataLabels = { color: textColor };
                    }
                    finalNode.borderColor = borderColor;
                    return finalNode;
                });

                Highcharts.chart('container-sotk', {
                    chart: {
                        height: 600,
                        inverted: true,
                        backgroundColor: 'transparent'
                    },
                    title: {
                        text: null
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        type: 'organization',
                        name: 'SOTK',
                        keys: ['from', 'to'],
                        data: sotkLinks,
                        levels: [{
                            level: 0,
                            color: level0Color,
                            height: 30
                        }, {
                            level: 1,
                            color: level1Color,
                            height: 30
                        }, {
                            level: 2,
                            color: level2Color,
                            height: 30
                        }, {
                            level: 3,
                            color: level3Color,
                            height: 30
                        }],
                        linkColor: linkColor,
                        linkLineWidth: 2,
                        linkRadius: 6,
                        nodes: nodesData,
                        colorByPoint: false,
                        color: defaultNodeColor,
                        dataLabels: {
                            color: textColor,
                            style: {
                                fontFamily: 'Plus Jakarta Sans, sans-serif',
                                fontSize: '11px',
                                fontWeight: '700',
                                textOutline: 'none'
                            }
                        },
                        shadow: false,
                        borderColor: borderColor,
                        nodeWidth: 80
                    }],
                    tooltip: {
                        backgroundColor: isDark ? '#1e293b' : '#ffffff',
                        style: {
                            color: textColor,
                            fontFamily: 'Inter, sans-serif'
                        },
                        borderWidth: 1,
                        borderColor: borderColor
                    },
                    exporting: {
                        enabled: false
                    }
                });
            }

            function loadSotk() {
                const apiPemerintah = '{{ route('api.pemerintah') }}';
                const $sotkList = $('#sotk-list');

                $.get(apiPemerintah, function(response) {
                    const pemerintah = response.data;

                    if (!pemerintah.length) {
                        $sotkList.html('<p class="py-6 text-center text-slate-500 font-medium">Tidak ada data SOTK yang tersedia</p>');
                        return;
                    }

                    const initialStructure = [{
                            id: 'BPD',
                            color: 'gold',
                            column: 0,
                            offset: '-150'
                        },
                        {
                            id: 'LPM',
                            color: 'gold',
                            column: 0,
                            offset: '150'
                        }
                    ];

                    strukturPemerintah = [...initialStructure];
                    strukturSotk = [['BPD', 'LPM']];

                    pemerintah.forEach(item => {
                        const data = {
                            id: parseInt(item.id),
                            title: item.attributes.nama_jabatan,
                            name: item.attributes.nama,
                            image: item.attributes.foto,
                            column: item.attributes.bagan_tingkat || undefined,
                            offset: item.attributes.bagan_offset || undefined,
                            layout: item.attributes.bagan_layout || undefined,
                            color: item.attributes.bagan_warna || undefined,
                        };

                        strukturPemerintah.push(data);

                        if (item.attributes.atasan) {
                            strukturSotk.push([parseInt(item.attributes.atasan), data.id]);
                        }
                    });

                    $sotkList.html(`
                        <figure class="highcharts-figure" style="max-width: 100%;">
                            <div id="container-sotk" style="max-width: 100%;"></div>
                        </figure>
                    `);

                    loadHighcharts(strukturPemerintah, strukturSotk);
                });
            }

            loadSotk();

            // Repaint chart on Dark Mode change
            window.addEventListener('darkModeChanged', function() {
                if (strukturPemerintah.length > 0) {
                    loadHighcharts(strukturPemerintah, strukturSotk);
                }
            });
        });
    </script>
@endpush
