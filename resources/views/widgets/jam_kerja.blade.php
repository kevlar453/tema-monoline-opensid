@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

@includeIf('theme::partials.holiday_helper')

@if ($jam_kerja)
    @php
        $todayHoliday = null;
        if (class_exists('HolidayHelper')) {
            $todayHoliday = HolidayHelper::getTodayHoliday();
        }
    @endphp
    <div class="w-full">
        @if ($todayHoliday)
            <div class="mb-4 p-3.5 bg-rose-50 dark:bg-rose-950/40 border border-rose-100 dark:border-rose-900/50 rounded-xl text-rose-800 dark:text-rose-400 text-xs font-semibold flex items-start gap-2.5 leading-relaxed">
                <i class="fas fa-exclamation-circle text-rose-500 text-sm flex-shrink-0 mt-0.5"></i>
                <span>Hari ini Libur Nasional: <strong>{{ $todayHoliday }}</strong>. Kantor Pelayanan Tutup.</span>
            </div>
        @endif
        <div class="data-case-container">
        <ul class="ants-right-headline">
            <li class="info-case">
                <table class="w-full text-sm text-slate-650 dark:text-slate-300 border-collapse">
                    <thead>
                                <tr class="border-b border-slate-100 dark:border-slate-800/80">
                                    <th class="py-2.5 text-left font-bold text-slate-800 dark:text-white uppercase tracking-wider text-xs">Hari</th>
                                    <th class="py-2.5 text-center font-bold text-slate-800 dark:text-white uppercase tracking-wider text-xs">Mulai</th>
                                    <th class="py-2.5 text-center font-bold text-slate-800 dark:text-white uppercase tracking-wider text-xs">Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jam_kerja as $value)
                                    <tr class="border-b border-slate-50 dark:border-slate-800/30 last:border-0 hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-colors">
                                        <td class="py-3.5 font-semibold text-slate-700 dark:text-slate-350">{{ $value->nama_hari }}</td>
                                        @if ($value->status)
                                            <td class="py-3.5 text-center font-mono font-medium text-slate-600 dark:text-slate-300">{{ $value->jam_masuk }}</td>
                                            <td class="py-3.5 text-center font-mono font-medium text-slate-600 dark:text-slate-300">{{ $value->jam_keluar }}</td>
                                        @else
                                            <td colspan="2" class="py-3.5 text-center">
                                                <span class="bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-400 border border-rose-100 dark:border-rose-900/40 px-2.5 py-0.5 rounded-full text-xxs font-extrabold uppercase tracking-wide">Libur</span>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </li>
                </ul>
        </div>
    </div>
@endif
