@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="w-full">
    @foreach (array_slice($arsip_terkini, 0, 5) as $arsip)
        <div class="overflow-hidden border-b border-[#eee] pb-[15px] mb-[20px] last:border-0 last:pb-0 last:mb-0 group">
            <a href="{{ site_url('artikel/' . buat_slug($arsip)) }}" class="block">
                <h4 class="text-[#666] text-[18px] font-medium leading-[28px] m-0 transition-colors duration-300 group-hover:text-[#ffaa17]">
                    {{ $arsip['judul'] }}
                </h4>
            </a>
            <span class="text-[#161616] text-[13px] block mt-[5px]">
                <i class="far fa-calendar-alt text-[#ffaa17] mr-[5px]"></i> {{ tgl_indo($arsip['tgl_upload']) }}
            </span>
        </div>
    @endforeach
</div>
