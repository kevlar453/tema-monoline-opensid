@extends('theme::layouts.right-sidebar')

@section('content')
    <div class="bg-white rounded-xl shadow-md border border-slate-100 overflow-hidden mb-8 mt-6">
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-2xl font-bold text-slate-800 font-heading">{{ $heading }}</h2>
        </div>
        
        <div class="p-0 overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200" id="tabelData">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider border-b border-r border-slate-200 w-12">No</th>
                        <th colspan="8" class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider border-b border-r border-slate-200">Wilayah / Ketua</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider border-b border-r border-slate-200">KK</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider border-b border-r border-slate-200">L+P</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider border-b border-r border-slate-200">L</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider border-b border-slate-200">P</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200 text-sm text-slate-700"></tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var tabelData = $('#tabelData');
            var wilayahHTML = '';

            function loadWilayah() {

                var apiWilayah = '{{ route('api.wilayah.administratif') }}';

                $.get(apiWilayah, function(response) {

                    var wilayah = response.data;

                    tabelData.find('tbody').empty();
                    tabelData.find('tfoot').empty();

                    if (!wilayah.length) {
                        tabelData.find('tbody').append('<tr><td colspan="13" class="text-center">Tidak ada data wilayah yang tersedia</td></tr>');
                        return;
                    }

                    loadDusun(wilayah);
                });
            }

            // Tingkat 1 : Dusun
            function loadDusun(data) {
                let no = 1;
                let totalKK = 0;
                let totalPriaWanita = 0;
                let totalPria = 0;
                let totalWanita = 0;

                data.forEach(function(item, index) {
                    var row = `<tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3 text-center border-b border-r border-slate-200">${no}</td>
                    <td colspan="8" class="px-4 py-3 font-medium text-slate-800 border-b border-r border-slate-200">${item.attributes.sebutan_dusun + ' ' + item.attributes.dusun + ' - ' + item.attributes.kepala_nama}</td>
                    <td class="px-4 py-3 text-right border-b border-r border-slate-200">${item.attributes.keluarga_aktif_count}</td>
                    <td class="px-4 py-3 text-right border-b border-r border-slate-200">${item.attributes.penduduk_pria_wanita_count}</td>
                    <td class="px-4 py-3 text-right border-b border-r border-slate-200">${item.attributes.penduduk_pria_count}</td>
                    <td class="px-4 py-3 text-right border-b border-slate-200">${item.attributes.penduduk_wanita_count}</td>
                </tr>`;

                    wilayahHTML += row;
                    totalKK += item.attributes.keluarga_aktif_count;
                    totalPriaWanita += item.attributes.penduduk_pria_wanita_count;
                    totalPria += item.attributes.penduduk_pria_count;
                    totalWanita += item.attributes.penduduk_wanita_count;
                    no++;

                    loadRW(item.attributes.rws);
                });

                tabelData.find('tbody').append(wilayahHTML);

                let totalPW = totalPria + totalWanita;
                var tfoot = `<tr class="bg-slate-50 font-bold text-slate-800">
                <td class="px-4 py-3 text-center border-b border-r border-slate-200" colspan="9">TOTAL</td>
                <td class="px-4 py-3 text-right border-b border-r border-slate-200">${totalKK}</td>
                <td class="px-4 py-3 text-right border-b border-r border-slate-200">${totalPW}</td>
                <td class="px-4 py-3 text-right border-b border-r border-slate-200">${totalPria}</td>
                <td class="px-4 py-3 text-right border-b border-slate-200">${totalWanita}</td>
            </tr>`;

                tabelData.find('tbody').after(tfoot);
            }

            // Tingkat 2 : RW
            function loadRW(data) {
                let no = 1;

                data.forEach(function(item) {
                    if (item.rw !== '-') {
                        let row = `
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-2 border-b border-r border-slate-200"></td>
                            <td class="px-4 py-2 text-center border-b border-r border-slate-200">${no}</td>
                            <td colspan="7" class="px-4 py-2 border-b border-r border-slate-200">${item.sebutan_rw + ' ' + item.rw + ' - ' + item.kepala_nama}</td>
                            <td class="px-4 py-2 text-right border-b border-r border-slate-200">${item.keluarga_aktif_count}</td>
                            <td class="px-4 py-2 text-right border-b border-r border-slate-200">${item.penduduk_pria_wanita_count}</td>
                            <td class="px-4 py-2 text-right border-b border-r border-slate-200">${item.penduduk_pria_count}</td>
                            <td class="px-4 py-2 text-right border-b border-slate-200">${item.penduduk_wanita_count}</td>
                        </tr>`;

                        wilayahHTML += row;
                        no++;
                    }

                    loadRT(item.rw, item.rts);
                });
            }

            // Tingkat 3 : RT
            function loadRT(rw, data) {
                let no = 1;

                data.forEach(function(item) {
                    if (rw == item.rw && item.rt !== '-') {
                        let row = `
                        <tr class="text-slate-500 hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-2 border-b border-r border-slate-200"></td>
                            <td class="px-4 py-2 border-b border-r border-slate-200"></td>
                            <td class="px-4 py-2 text-center border-b border-r border-slate-200">${no}</td>
                            <td colspan="6" class="px-4 py-2 border-b border-r border-slate-200">${item.sebutan_rt + ' ' + item.rt + ' - ' + item.kepala_nama}</td>
                            <td class="px-4 py-2 text-right border-b border-r border-slate-200">${item.keluarga_aktif_count}</td>
                            <td class="px-4 py-2 text-right border-b border-r border-slate-200">${item.penduduk_pria_wanita_count}</td>
                            <td class="px-4 py-2 text-right border-b border-r border-slate-200">${item.penduduk_pria_count}</td>
                            <td class="px-4 py-2 text-right border-b border-slate-200">${item.penduduk_wanita_count}</td>
                        </tr>`;

                        wilayahHTML += row;
                        no++;
                    }
                });
            }

            loadWilayah();
        });
    </script>
@endpush
