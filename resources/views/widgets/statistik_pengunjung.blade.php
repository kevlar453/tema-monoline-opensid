@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="w-full">
    <div class="divide-y divide-slate-100 dark:divide-slate-800/60">
        <!-- Hari Ini -->
        <div class="flex items-center justify-between py-3.5 hover:bg-slate-50/50 dark:hover:bg-slate-900/30 px-1 rounded-xl transition-colors duration-200">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-primary-50 dark:bg-primary-950/40 flex items-center justify-center text-primary-600 dark:text-primary-400">
                    <i class="fas fa-calendar-day text-sm"></i>
                </div>
                <span class="text-sm font-semibold text-slate-700 dark:text-slate-350">Hari Ini</span>
            </div>
            <span class="text-sm font-bold text-slate-800 dark:text-white">{{ number_format($statistik_pengunjung['hari_ini']) }}</span>
        </div>

        <!-- Kemarin -->
        <div class="flex items-center justify-between py-3.5 hover:bg-slate-50/50 dark:hover:bg-slate-900/30 px-1 rounded-xl transition-colors duration-200">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400">
                    <i class="fas fa-calendar-alt text-sm"></i>
                </div>
                <span class="text-sm font-semibold text-slate-700 dark:text-slate-350">Kemarin</span>
            </div>
            <span class="text-sm font-bold text-slate-800 dark:text-white">{{ number_format($statistik_pengunjung['kemarin']) }}</span>
        </div>

        <!-- Total Pengunjung -->
        <div class="flex items-center justify-between py-3.5 hover:bg-slate-50/50 dark:hover:bg-slate-900/30 px-1 rounded-xl transition-colors duration-200">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950/40 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                    <i class="fas fa-users text-sm"></i>
                </div>
                <span class="text-sm font-semibold text-slate-700 dark:text-slate-350">Total Pengunjung</span>
            </div>
            <span class="text-sm font-black text-slate-800 dark:text-white">{{ number_format($statistik_pengunjung['total']) }}</span>
        </div>

        <!-- Sistem Operasi -->
        <div class="flex items-center justify-between py-3.5 hover:bg-slate-50/50 dark:hover:bg-slate-900/30 px-1 rounded-xl transition-colors duration-200">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-amber-50 dark:bg-amber-950/40 flex items-center justify-center text-amber-600 dark:text-amber-400">
                    <i class="fas fa-desktop text-sm"></i>
                </div>
                <span class="text-sm font-semibold text-slate-700 dark:text-slate-350">Sistem Operasi</span>
            </div>
            <span class="text-xs font-semibold text-slate-800 dark:text-slate-200 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-md">{{ $statistik_pengunjung['os'] }}</span>
        </div>

        <!-- IP Address -->
        <div class="flex items-center justify-between py-3.5 hover:bg-slate-50/50 dark:hover:bg-slate-900/30 px-1 rounded-xl transition-colors duration-200">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-rose-50 dark:bg-rose-950/40 flex items-center justify-center text-rose-600 dark:text-rose-400">
                    <i class="fas fa-network-wired text-sm"></i>
                </div>
                <span class="text-sm font-semibold text-slate-700 dark:text-slate-350">IP Address</span>
            </div>
            <span class="text-xs font-mono font-bold text-slate-800 dark:text-slate-300">{{ $statistik_pengunjung['ip_address'] }}</span>
        </div>

        <!-- Browser -->
        <div class="flex items-center justify-between py-3.5 hover:bg-slate-50/50 dark:hover:bg-slate-900/30 px-1 rounded-xl transition-colors duration-200">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-950/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                    <i class="fas fa-globe text-sm"></i>
                </div>
                <span class="text-sm font-semibold text-slate-700 dark:text-slate-350">Browser</span>
            </div>
            <span class="text-xs font-semibold text-slate-800 dark:text-slate-200 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-md max-w-[120px] truncate" title="{{ $statistik_pengunjung['browser'] }}">{{ $statistik_pengunjung['browser'] }}</span>
        </div>
    </div>
</div>
