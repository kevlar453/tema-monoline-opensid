@extends('theme::template')
@section('layout')

@push('styles')
    <!-- Custom styles removed in favor of Tailwind CSS utility classes -->
@endpush


    <!-- START SECTION TOP (Monoline Style) -->
    <div class="py-16 lg:py-24 text-center relative mb-12 shadow-inner" style="background-image: url('{{ theme_asset('img/bg/section-top.png') }}'); background-size: cover; background-position: center center;">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="relative z-10 container mx-auto px-4">
            <h1 class="text-3xl md:text-5xl font-bold text-white uppercase tracking-wider mb-3">
                @if (isset($is_detail) && $is_detail)
                    <a href="{{ ci_route('galeri') }}" class="text-white hover:text-accent-500 transition-colors">Galeri Foto</a>
                @else
                    Galeri Foto
                @endif
            </h1>
            <p class="text-slate-300 text-lg">
                @if (isset($is_detail) && $is_detail)
                    Album: {{ $title_galeri ?? "" }}
                @else
                    Dokumentasi Kegiatan dan Album Foto Desa
                @endif
            </p>
        </div>
    </div>
    <!-- END SECTION TOP -->

    <div class="w-full max-w-[1400px] mx-auto px-6 pb-12">
        <div class="mt-8">
            <div class="row" id="galeri-list"></div>
            <div class="mt-10 flex justify-center">
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
                pageSizes = 10;
            }

            const loadGaleri = function(pageNumber) {
                $.ajax({
                    url: routeGaleri + `?sort=-tgl_upload&page[number]=${pageNumber}&page[size]=${pageSizes}`,
                    type: "GET",
                    beforeSend: function() {
                        const galeriList = document.getElementById('galeri-list');
                        galeriList.innerHTML = `<div class="col-span-full text-center py-10 text-slate-500"><i class="fas fa-spinner fa-spin text-3xl mb-3"></i><p>Memuat galeri...</p></div>`;
                    },
                    dataType: 'json',
                    data: {},
                    success: function(data) {
                        displayGaleri(data);
                        initPagination(data);
                    },
                    error: function() {
                        const galeriList = document.getElementById('galeri-list');
                        galeriList.innerHTML = `<div class="col-span-full p-4 bg-red-50 text-red-500 rounded-lg border border-red-100 text-center">Data galeri tidak dapat dimuat saat ini.</div>`;
                    }
                });
            }

            const displayGaleri = function(dataGaleri) {
                const galeriList = document.getElementById('galeri-list');
                galeriList.innerHTML = '';
                if (!dataGaleri.data || !dataGaleri.data.length) {
                    galeriList.innerHTML = `<div class="col-span-full p-4 bg-slate-50 text-slate-500 rounded-lg border border-slate-100 text-center">Data tidak tersedia</div>`
                    return
                }
                dataGaleri.data.forEach(item => {
                    const card = document.createElement('div');
                    card.className = "col-lg-4 col-md-6 col-sm-6 col-xs-12 portfolio-item mb-4";
                    const image = item.attributes.src_gambar ? `<img class="img-fluid" src="${item.attributes.src_gambar}" alt="${item.attributes.nama}" style="width: 100%; height: 250px; object-fit: cover;" />` : `<div style="width: 100%; height: 250px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; border-radius: 4px;"><i class="fas fa-image" style="font-size: 3rem; color: #cbd5e1;"></i></div>`;
                    
                    let linkHtml = '';
                    if (parent) {
                        // Inside album (listing photos): Enlarge via Lightbox
                        linkHtml = `
                            <a href="${item.attributes.src_gambar || '#'}" data-fancybox="images" data-caption="${item.attributes.nama}" class="gallery_enlarge_icon"><i class="fa-solid fa-plus"></i></a>
                            <h4><a href="${item.attributes.src_gambar || '#'}" data-fancybox="images-title" data-caption="${item.attributes.nama}">${item.attributes.nama}</a></h4>
                        `;
                    } else {
                        // Main gallery page (listing albums): Navigate to album details
                        linkHtml = `
                            <a href="${item.attributes.url_detail}" class="gallery_enlarge_icon"><i class="fa-solid fa-plus"></i></a>
                            <h4><a href="${item.attributes.url_detail}">${item.attributes.nama}</a></h4>
                        `;
                    }

                    card.innerHTML = `
                        <div class="single-gallery">
                            ${image}
                            ${linkHtml}
                        </div>
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
