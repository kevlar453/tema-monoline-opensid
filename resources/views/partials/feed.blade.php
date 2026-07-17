<!-- Feed Container -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-8">
    <!-- Feed Header -->
    <div class="flex items-center mb-8">
        <div class="w-2 h-10 bg-primary-600 rounded-full mr-4"></div>
        <h2 class="text-3xl font-bold text-gray-900">
            <a href="{{ $feed['url'] }}" 
               rel="noopener noreferrer" 
               target="_blank"
               class="hover:text-primary-600 transition-colors duration-200">
                {{ $feed['title'] }}
            </a>
        </h2>
    </div>

    <!-- Feed Items -->
    <div class="space-y-8">
        @foreach ($feed['items'] as $data)
            <article class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <!-- Article Header -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 leading-tight">
                        <a href="{{ $data['LINK'] }}" 
                           rel="noopener noreferrer" 
                           target="_blank"
                           class="hover:text-primary-600 transition-colors duration-200 line-clamp-2">
                            {{ $data['TITLE'] }}
                        </a>
                    </h3>
                    
                    <!-- Meta Information -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-calendar text-primary-600 text-sm"></i>
                            </div>
                            <span>{{ gmdate('d-M-Y H:i:s', $data['PUBDATE']) }}</span>
                        </div>
                        
                        @if (!empty($data['DC:CREATOR']))
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600 text-sm"></i>
                                </div>
                                <span>{{ $data['DC:CREATOR'] }}</span>
                            </div>
                        @endif
                        
                        @if (!empty($data['CATEGORY']))
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-tag text-green-600 text-sm"></i>
                                </div>
                                <span class="bg-primary-100 text-primary-800 px-3 py-1 rounded-full text-xs font-medium">
                                    {{ $data['CATEGORY'] }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Article Content -->
                <div class="mb-6">
                    <div class="text-gray-600 leading-relaxed">
                        @php $deskripsi = substr($data['DESCRIPTION'], 0, 450); @endphp
                        <p class="line-clamp-3 text-base">{{ $deskripsi }}...</p>
                    </div>
                </div>

                <!-- Read More Button -->
                <div class="flex justify-end">
                    <a href="{{ $data['LINK'] }}" 
                       rel="noopener noreferrer" 
                       target="_blank"
                       class="inline-flex items-center space-x-3 bg-primary-600 text-white px-6 py-3 rounded-xl hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200 font-medium shadow-sm hover:shadow-md group">
                        <span>Baca Selengkapnya</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-200"></i>
                    </a>
                </div>
            </article>
        @endforeach
    </div>
    
    <!-- Feed Footer -->
    <div class="mt-8 pt-6 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-500">
                <i class="fas fa-rss text-orange-500 mr-2"></i>
                RSS Feed dari {{ $feed['title'] }}
            </div>
            <a href="{{ $feed['url'] }}" 
               target="_blank" 
               rel="noopener noreferrer"
               class="text-primary-600 hover:text-primary-700 text-sm font-medium transition-colors duration-200">
                Lihat Semua Feed →
            </a>
        </div>
    </div>
</div>

<style>
/* Line clamp utilities for text truncation */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Hover effects */
article:hover {
    border-color: primary-300;
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .line-clamp-2 {
        -webkit-line-clamp: 3;
    }
    
    .line-clamp-3 {
        -webkit-line-clamp: 4;
    }
    
    .feed-container {
        padding: 1.5rem;
    }
    
    .feed-items {
        gap: 1.5rem;
    }
}

/* Smooth transitions */
article {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Focus states for accessibility */
article:focus-within {
    outline: 2px solid #0369a1;
    outline-offset: 2px;
}

/* Meta information responsive */
@media (max-width: 768px) {
    .meta-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }
}
</style>
