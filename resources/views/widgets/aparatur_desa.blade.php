@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<link type='text/css' href="{{ asset('front/css/slider.css') }}" rel='Stylesheet' />
<script src="{{ asset('front/js/jquery.cycle2.caption2.min.js') }}"></script>
<style type="text/css">
    #aparatur_desa .cycle-pager span {
        height: 10px;
        width: 10px;
    }

    .cycle-slideshow {
        width: 100%;
        height: auto;
        margin-bottom: 0px;
        border: 0px;
        overflow: hidden;
        border-radius: 16px;
    }

    .cycle-slideshow img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .cycle-next,
    .cycle-prev {
        mix-blend-mode: difference;
    }
</style>

<!-- widget Aparatur Desa -->
<div class="w-full">
    <div id="aparatur_desa"
         class="cycle-slideshow"
         data-cycle-pause-on-hover=true
         data-cycle-fx=scrollHorz
         data-cycle-timeout=2000
         data-cycle-caption-plugin=caption2
         data-cycle-overlay-fx-out="slideUp"
         data-cycle-overlay-fx-in="slideDown"
    >
        @if (getWidgetSetting('aparatur_desa', 'overlay') == true)
            <span class="cycle-prev"><img src="{{ asset('images/back_button.png') }}" alt="Back"></span>
            <span class="cycle-next"><img src="{{ asset('images/next_button.png') }}" alt="Next"></span>
            <div class="cycle-caption"></div>
            <div class="cycle-overlay"></div>
        @else
            <span class="cycle-pager"></span>
        @endif
        @includeIf('theme::partials.holiday_helper')
        @php
            $todayHoliday = null;
            if (class_exists('HolidayHelper')) {
                $todayHoliday = HolidayHelper::getTodayHoliday();
            }
        @endphp
        @foreach ($aparatur_desa['daftar_perangkat'] as $data)
            @php
                $desc = "<span class='cycle-overlay-title'>" . $data['nama'] . '</span>';
                if ($todayHoliday) {
                    $desc .= "<span class='label label-warning' style='background-color: #d97706 !important;'>Libur</span>";
                } elseif ($data['kehadiran'] == 1) {
                    $desc .=
                        "<span class='label label-success'>" .
                        ($data['status_kehadiran'] == 'hadir' ? 'Hadir' : '') .
                        '</span>' .
                        "<span class='label label-danger'>" .
                        ($data['tanggal'] == date('Y-m-d') && $data['status_kehadiran'] != 'hadir' ? ucwords($data['status_kehadiran']) : '') .
                        '</span>' .
                        "<span class='label label-danger'>" .
                        ($data['tanggal'] != date('Y-m-d') ? 'Belum Rekam Kehadiran' : '') .
                        '</span>';
                }
            @endphp
            <img data-src="{{ $data['foto'] }}" src="{{ asset('images/img-loader.gif') }}" class="yall_lazy" data-cycle-title="{{ $desc }}" data-cycle-desc="{{ $data['jabatan'] }}">
        @endforeach
    </div>
</div>
