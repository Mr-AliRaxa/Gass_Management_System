@if ($paginator->hasPages())
    @php
        $isRtl = app()->getLocale() === 'ar';
        $prevIcon = $isRtl ? 'fa-chevron-right' : 'fa-chevron-left';
        $nextIcon = $isRtl ? 'fa-chevron-left' : 'fa-chevron-right';
    @endphp
    <nav class="pagination-container d-flex align-items-center justify-content-between flex-wrap gap-3 flex-grow-1" role="navigation" aria-label="Pagination Navigation">
        {{-- Results Info --}}
        <div class="pagination-info text-muted small">
            {{ __('messages.showing') }}
            <span class="fw-bold text-dark">{{ $paginator->firstItem() ?? 0 }}</span>
            {{ __('messages.to') }}
            <span class="fw-bold text-dark">{{ $paginator->lastItem() ?? 0 }}</span>
            {{ __('messages.of') }}
            <span class="fw-bold text-dark">{{ $paginator->total() }}</span>
            {{ __('messages.results') }}
        </div>

        {{-- Pagination Links --}}
        <ul class="pagination pagination-modern mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="{{ __('messages.previous') }}">
                    <span class="page-link" aria-hidden="true">
                        <i class="fas {{ $prevIcon }}" style="font-size: 11px;"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('messages.previous') }}">
                        <i class="fas {{ $prevIcon }}" style="font-size: 11px;"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link dots">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('messages.next') }}">
                        <i class="fas {{ $nextIcon }}" style="font-size: 11px;"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="{{ __('messages.next') }}">
                    <span class="page-link" aria-hidden="true">
                        <i class="fas {{ $nextIcon }}" style="font-size: 11px;"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
