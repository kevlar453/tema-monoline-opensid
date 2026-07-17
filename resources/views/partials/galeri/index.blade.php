@extends('theme::template')
@section('layout')

@push('styles')
    <!-- Custom styles removed in favor of Tailwind CSS utility classes -->
@endpush


    <!-- START SECTION TOP (Monoline Style) -->
    <div class="py-16 lg:py-24 text-center relative mb-12 overflow-hidden" style="background-image: url('{{ theme_asset('img/bg/section-top.png') }}'); background-size: cover; background-position: center center;">
        <!-- Dark Tint and Gradient Overlay -->
        <div class="absolute inset-0 bg-slate-950/60 z-0"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent z-0"></div>
        <div class="relative z-10 container mx-auto px-4">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight font-heading mb-3 drop-shadow-lg">
                @if (isset($is_detail) && $is_detail)
                    <a href="{{ ci_route('galeri') }}" class="text-white hover:text-accent-400 transition-colors">Galeri Foto</a>
                @else
                    Galeri Foto
                @endif
            </h1>
            <p class="text-slate-300 text-base md:text-lg max-w-xl mx-auto font-medium">
                @if (isset($is_detail) && $is_detail)
                    Album: {{ $title_galeri ?? "" }}
                @else
                    Dokumentasi Kegiatan dan Album Foto Desa
                @endif
            </p>
        </div>
    </div>
    <!-- END SECTION TOP -->

    <div class="w-full max-w-[1200px] mx-auto px-4 pb-16">
        <div class="mt-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="galeri-list"></div>
            <div class="mt-12 flex justify-center">
                @include('theme::commons.pagination')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var parent = `{{ $parent ?? "" }}`;
            var routeGaleri = `{{ ci_route('internal_api.galeri') }}`;
            let pageSizes = 6;
            let status = '';

            if (parent) {
                routeGaleri = `{{ ci_route('internal_api.galeri') }}/${parent}`;
                pageSizes = 12;
            }

            const loadGaleri = function(pageNumber) {
                $.ajax({
                    url: routeGaleri + `?sort=-tgl_upload&page[number]=${pageNumber}&page[size]=${pageSizes}`,
                    type: "GET",
                    beforeSend: function() {
                        const galeriList = document.getElementById('galeri-list');
                        galeriList.innerHTML = `<div class="col-span-full text-center py-16 text-slate-500"><i class="fas fa-spinner fa-spin text-3xl text-primary-500 mb-3"></i><p class="font-bold text-sm">Memuat galeri...</p></div>`;
                    },
                    dataType: 'json',
                    data: {},
                    success: function(data) {
                        displayGaleri(data);
                        initPagination(data);
                    },
                    error: function() {
                        const galeriList = document.getElementById('galeri-list');
                        galeriList.innerHTML = `<div class="col-span-full p-4 bg-rose-50 text-rose-500 rounded-2xl border border-rose-100 text-center font-bold">Data galeri tidak dapat dimuat saat ini.</div>`;
                    }
                });
            }

            const displayGaleri = function(dataGaleri) {
                const galeriList = document.getElementById('galeri-list');
                galeriList.innerHTML = '';
                if (!dataGaleri.data || !dataGaleri.data.length) {
                    galeriList.innerHTML = `<div class="col-span-full p-8 bg-slate-50 text-slate-500 rounded-2xl border border-slate-100 text-center font-medium">Data tidak tersedia</div>`
                    return
                }
                dataGaleri.data.forEach(item => {
                    const card = document.createElement('div');
                    card.className = "group relative bg-white/80 backdrop-blur-lg rounded-2xl border border-slate-200/50 overflow-hidden shadow-soft hover:shadow-md hover:border-primary-100 transition-all duration-300 flex flex-col";
                    
                    const imgUrl = item.attributes.src_gambar || '';
                    const imageHtml = imgUrl ? 
                        `<img class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-500" src="${imgUrl}" alt="${item.attributes.nama}" />` : 
                        `<div class="w-full h-60 bg-slate-100 flex items-center justify-center"><i class="fas fa-image text-5xl text-slate-300"></i></div>`;
                    
                    let overlayHtml = '';
                    let detailsHtml = '';
                    
                    if (parent) {
                        // Inside album (listing photos): Enlarge via Lightbox
                        overlayHtml = `
                            <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-10">
                                <a href="${imgUrl || '#'}" data-fancybox="images" data-caption="${item.attributes.nama}" class="w-12 h-12 rounded-xl bg-white text-primary-600 flex items-center justify-center shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <i class="fas fa-search-plus text-lg"></i>
                                </a>
                            </div>
                        `;
                        detailsHtml = `
                            <div class="p-5 flex-1 flex flex-col justify-between border-t border-slate-100/50 bg-white/40">
                                <div>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-emerald-50 text-emerald-600 border border-emerald-100 text-[10px] font-extrabold rounded-full uppercase tracking-wider mb-2"><i class="fas fa-image text-[8px]"></i> Foto</span>
                                    <h4 class="text-base font-bold text-slate-800 font-heading leading-snug">
                                        <a href="${imgUrl || '#'}" data-fancybox="images-title" data-caption="${item.attributes.nama}" class="hover:text-primary-600 transition-colors">${item.attributes.nama}</a>
                                    </h4>
                                </div>
                            </div>
                        `;
                    } else {
                        // Main gallery page (listing albums): Navigate to album details
                        overlayHtml = `
                            <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-10">
                                <a href="${item.attributes.url_detail}" class="w-12 h-12 rounded-xl bg-white text-primary-600 flex items-center justify-center shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <i class="fas fa-folder-open text-lg"></i>
                                </a>
                            </div>
                        `;
                        detailsHtml = `
                            <div class="p-5 flex-1 flex flex-col justify-between border-t border-slate-100/50 bg-white/40">
                                <div>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-primary-50 text-primary-600 border border-primary-100 text-[10px] font-extrabold rounded-full uppercase tracking-wider mb-2"><i class="fas fa-images text-[8px]"></i> Album</span>
                                    <h4 class="text-base font-bold text-slate-800 font-heading leading-snug group-hover:text-primary-600 transition-colors">
                                        <a href="${item.attributes.url_detail}">${item.attributes.nama}</a>
                                    </h4>
                                </div>
                            </div>
                        `;
                    }

                    card.innerHTML = `
                        <div class="relative overflow-hidden w-full h-60">
                            ${imageHtml}
                            ${overlayHtml}
                        </div>
                        ${detailsHtml}
                    `;
                    galeriList.appendChild(card);
                });
            }

            $('.pagination').on('click', '.btn-page', function() {
                var params = {};
                var page = $(this).data('page');
                loadGaleri(page);
            });
            loadGaleri(1);
        });
    </script>
@endpush
