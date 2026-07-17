@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="w-full">
    <table class="w-full text-sm text-slate-600 border-collapse">
        <tbody>
            <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50 transition-colors">
                <td class="py-3 font-medium">Hari ini</td>
                <td class="py-3 px-2 text-slate-400">:</td>
                <td class="py-3 text-right font-semibold text-slate-800">{{ number_format($statistik_pengunjung['hari_ini']) }}</td>
            </tr>
            <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50 transition-colors">
                <td class="py-3 font-medium">Kemarin</td>
                <td class="py-3 px-2 text-slate-400">:</td>
                <td class="py-3 text-right font-semibold text-slate-800">{{ number_format($statistik_pengunjung['kemarin']) }}</td>
            </tr>
            <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50 transition-colors">
                <td class="py-3 font-medium">Total Pengunjung</td>
                <td class="py-3 px-2 text-slate-400">:</td>
                <td class="py-3 text-right font-semibold text-slate-800">{{ number_format($statistik_pengunjung['total']) }}</td>
            </tr>
            <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50 transition-colors">
                <td class="py-3 font-medium">Sistem Operasi</td>
                <td class="py-3 px-2 text-slate-400">:</td>
                <td class="py-3 text-right text-slate-800">{{ $statistik_pengunjung['os'] }}</td>
            </tr>
            <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50 transition-colors">
                <td class="py-3 font-medium">IP Address</td>
                <td class="py-3 px-2 text-slate-400">:</td>
                <td class="py-3 text-right text-slate-800">{{ $statistik_pengunjung['ip_address'] }}</td>
            </tr>
            <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50 transition-colors">
                <td class="py-3 font-medium">Browser</td>
                <td class="py-3 px-2 text-slate-400">:</td>
                <td class="py-3 text-right text-slate-800">{{ $statistik_pengunjung['browser'] }}</td>
            </tr>
        </tbody>
    </table>
</div>
