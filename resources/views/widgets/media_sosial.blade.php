<!-- Custom Media Sosial Widget for Monoline -->
<div class="flex flex-wrap gap-3.5 pt-1">
    @if (!empty($sosmed))
        @foreach ($sosmed as $data)
            @if (!empty($data['link']))
                <a href="{{ $data['link'] }}" target="_blank" class="w-11 h-11 rounded-xl flex items-center justify-center hover:-translate-y-1 hover:shadow-md hover:border-primary-500/40 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all duration-300 overflow-hidden bg-slate-50 dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800 p-2.5" title="{{ $data['nama'] ?? '' }}">
                    <img src="{{ $data['icon'] }}" alt="{{ $data['nama'] ?? 'Media Sosial' }}" class="w-full h-full object-contain filter dark:brightness-95" />
                </a>
            @endif
        @endforeach
    @endif
</div>
