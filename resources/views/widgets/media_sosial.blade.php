<!-- Custom Media Sosial Widget for Monoline -->
<div class="flex flex-wrap gap-3">
    @if (!empty($sosmed))
        @foreach ($sosmed as $data)
            @if (!empty($data['link']))
                <a href="{{ $data['link'] }}" target="_blank" class="w-12 h-12 rounded-lg flex items-center justify-center hover:opacity-80 transition-opacity shadow-sm overflow-hidden bg-slate-50 border border-slate-100 p-2" title="{{ $data['nama'] ?? '' }}">
                    <img src="{{ $data['icon'] }}" alt="{{ $data['nama'] ?? 'Media Sosial' }}" class="w-full h-full object-contain" />
                </a>
            @endif
        @endforeach
    @endif
</div>
