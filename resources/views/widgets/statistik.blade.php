@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<style type="text/css">
    .highcharts-xaxis-labels tspan {
        font-size: 8px;
    }
</style>
<div class="w-full">
    <script type="text/javascript">
        $(function() {
            var chart_widget;
            $(document).ready(function() {
                var isDark = document.documentElement.classList.contains('dark');
                var textColor = isDark ? '#cbd5e1' : '#334155';
                var gridLineColor = isDark ? '#334155' : '#e2e8f0';

                // Build the chart
                chart_widget = new Highcharts.Chart({
                    chart: {
                        renderTo: 'container_widget',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        backgroundColor: "rgba(0,0,0,0)"
                    },
                    title: {
                        text: 'Jumlah Penduduk',
                        style: {
                            color: textColor,
                            fontSize: '14px',
                            fontWeight: 'bold'
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'Jumlah',
                            style: {
                                color: textColor
                            }
                        },
                        gridLineColor: gridLineColor,
                        labels: {
                            style: {
                                color: textColor
                            }
                        }
                    },
                    xAxis: {
                        categories: [
                            @foreach ($stat_widget as $data)
                                @if ($data['jumlah'] > 0 && $data['nama'] != 'JUMLAH')
                                    ['{{ $data['jumlah'] }} <br> {{ $data['nama'] }}'],
                                @endif
                            @endforeach
                        ],
                        labels: {
                            style: {
                                color: textColor
                            }
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            colorByPoint: true
                        },
                        column: {
                            pointPadding: 0,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        type: 'column',
                        name: 'Populasi',
                        data: [
                            @foreach ($stat_widget as $data)
                                @if ($data['jumlah'] > 0 && $data['nama'] != 'JUMLAH')
                                    ['{{ $data['nama'] }}', {{ $data['jumlah'] }}],
                                @endif
                            @endforeach
                        ]
                    }]
                });
            });

        });
    </script>
    <div id="container_widget" style="width: 100%; height: 300px; margin: 0 auto"></div>
</div>
