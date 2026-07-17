@push('styles')
    <style type="text/css">
        #agenda .nav-tabs {
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            gap: 4px;
            margin: 0;
            padding: 0;
            list-style: none;
        }
        #agenda .nav-tabs > li {
            margin-bottom: -1px;
        }
        #agenda .nav-tabs > li > a {
            display: block;
            padding: 8px 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            color: #64748b;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
            letter-spacing: 0.5px;
        }
        #agenda .nav-tabs > li.active > a {
            color: #1a63a6;
            border-bottom-color: #1a63a6;
            text-decoration: none;
        }
        #agenda .nav-tabs > li > a:hover {
            color: #1a63a6;
            text-decoration: none;
        }
        #agenda .tab-content {
            padding-top: 12px;
            margin-top: 0px;
        }
        #agenda #table-agenda td a {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            transition: color 0.3s;
            line-height: 1.4;
        }
        #agenda #table-agenda td a:hover {
            color: #1a63a6;
        }
        #agenda #label-meta-agenda {
            font-size: 11px;
            color: #94a3b8;
            font-weight: 600;
            text-align: left;
            padding-top: 6px;
            vertical-align: top;
        }
        #agenda #isi-meta-agenda {
            font-size: 11px;
            color: #475569;
            padding-top: 6px;
            vertical-align: top;
            font-medium: 500;
        }
        #agenda .sidebar-latest {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        #agenda .sidebar-latest li {
            border-bottom: 1px dashed #e2e8f0;
            padding: 12px 0;
        }
        #agenda .sidebar-latest li:last-child {
            border-bottom: none;
        }
    </style>
@endpush

<div id="agenda" class="w-full">
    <ul class="nav nav-tabs">
        @if (count($hari_ini ?? []) > 0)
            <li class="active"><a data-toggle="tab" href="#hari-ini">Hari ini</a></li>
        @endif
        @if (count($yad ?? []) > 0)
            <li class="@if (count($hari_ini ?? []) == 0) active @endif"><a data-toggle="tab" href="#yad">Mendatang</a></li>
        @endif
        @if (count($lama ?? []) > 0)
            <li class="@if (count(array_merge($hari_ini, $yad) ?? []) == 0) active @endif"><a data-toggle="tab" href="#lama">Lama</a></li>
        @endif
    </ul>
    <div class="tab-content">
        @php $merge = array_merge($hari_ini, $yad, $lama); @endphp
        @if (count($merge ?? []) > 0)
            @if (count($hari_ini ?? []) > 0)
                <div id="hari-ini" class="tab-pane fade in active">
                    <ul class="sidebar-latest">
                        @foreach ($hari_ini as $agenda)
                            <li>
                                <table id="table-agenda" width="100%">
                                    <tr>
                                        <td colspan="3" class="pb-1"><a href="{{ site_url('artikel/' . buat_slug($agenda)) }}">{{ $agenda['judul'] }}</a></td>
                                    </tr>
                                    <tr>
                                        <th id="label-meta-agenda" width="30%">Waktu</th>
                                        <td width="5%" class="pt-[6px] text-slate-400 text-xs">:</td>
                                        <td id="isi-meta-agenda" width="65%">{{ tgl_indo2($agenda['tgl_agenda']) }}</td>
                                    </tr>
                                    <tr>
                                        <th id="label-meta-agenda">Lokasi</th>
                                        <td class="pt-[6px] text-slate-400 text-xs">:</td>
                                        <td id="isi-meta-agenda">{{ $agenda['lokasi_kegiatan'] }}</td>
                                    </tr>
                                    <tr>
                                        <th id="label-meta-agenda">Koordinator</th>
                                        <td class="pt-[6px] text-slate-400 text-xs">:</td>
                                        <td id="isi-meta-agenda">{{ $agenda['koordinator_kegiatan'] }}</td>
                                    </tr>
                                </table>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (count($yad ?? []) > 0)
                <div id="yad" class="tab-pane fade @if (count($hari_ini ?? []) == 0) in active @endif">
                    <ul class="sidebar-latest">
                        @foreach ($yad as $agenda)
                            <li>
                                <table id="table-agenda" width="100%">
                                    <tr>
                                        <td colspan="3" class="pb-1"><a href="{{ site_url('artikel/' . buat_slug($agenda)) }}">{{ $agenda['judul'] }}</a></td>
                                    </tr>
                                    <tr>
                                        <th id="label-meta-agenda" width="30%">Waktu</th>
                                        <td width="5%" class="pt-[6px] text-slate-400 text-xs">:</td>
                                        <td id="isi-meta-agenda" width="65%">{{ tgl_indo2($agenda['tgl_agenda']) }}</td>
                                    </tr>
                                    <tr>
                                        <th id="label-meta-agenda">Lokasi</th>
                                        <td class="pt-[6px] text-slate-400 text-xs">:</td>
                                        <td id="isi-meta-agenda">{{ $agenda['lokasi_kegiatan'] }}</td>
                                    </tr>
                                    <tr>
                                        <th id="label-meta-agenda">Koordinator</th>
                                        <td class="pt-[6px] text-slate-400 text-xs">:</td>
                                        <td id="isi-meta-agenda">{{ $agenda['koordinator_kegiatan'] }}</td>
                                    </tr>
                                </table>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (count($lama ?? []) > 0)
                <div id="lama" class="tab-pane fade @if (count(array_merge($hari_ini, $yad) ?? []) == 0) in active @endif">
                    <marquee
                        onmouseover="this.stop()"
                        onmouseout="this.start()"
                        scrollamount="2"
                        direction="up"
                        width="100%"
                        height="140"
                        align="center"
                        behavior="alternate"
                    >
                        <ul class="sidebar-latest">
                            @foreach ($lama as $agenda)
                                <li>
                                    <table id="table-agenda" width="100%">
                                        <tr>
                                            <td colspan="3" class="pb-1"><a href="{{ site_url('artikel/' . buat_slug($agenda)) }}">{{ $agenda['judul'] }}</a></td>
                                        </tr>
                                        <tr>
                                            <th id="label-meta-agenda" width="30%">Waktu</th>
                                            <td width="5%" class="pt-[6px] text-slate-400 text-xs">:</td>
                                            <td id="isi-meta-agenda" width="65%">{{ tgl_indo2($agenda['tgl_agenda']) }}</td>
                                        </tr>
                                        <tr>
                                            <th id="label-meta-agenda">Lokasi</th>
                                            <td class="pt-[6px] text-slate-400 text-xs">:</td>
                                            <td id="isi-meta-agenda">{{ $agenda['lokasi_kegiatan'] }}</td>
                                        </tr>
                                        <tr>
                                            <th id="label-meta-agenda">Koordinator</th>
                                            <td class="pt-[6px] text-slate-400 text-xs">:</td>
                                            <td id="isi-meta-agenda">{{ $agenda['koordinator_kegiatan'] }}</td>
                                        </tr>
                                    </table>
                                </li>
                            @endforeach
                        </ul>
                    </marquee>
                </div>
            @endif
        @else
            <p class="text-slate-400 text-sm italic py-4 text-center font-medium">Belum ada agenda kegiatan.</p>
        @endif
    </div>
</div>
