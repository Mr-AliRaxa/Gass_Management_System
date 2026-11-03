@if ($paginator->hasPages())
    @php
        $isRtl = app()->getLocale() === 'ar';
        $prevIcon = $isRtl ? 'fa-chevron-right' : 'fa-chevron-left';
        $nextIcon = $isRtl ? 'fa-chevron-left' : 'fa-chevron-right';
    @endphp
    <nav class="d-flex align-items-center justify-content-between flex-wrap gap-2 w-100" role="navigation" aria-label="{!! __('Pagination Navigation') !!}">
        <ul class="pagination pagination-modern mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link"><i class="fas {{ $prevIcon }}" style="font-size: 11px;"></i> <span class="ms-1">{{ __('messages.previous') }}</span></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas {{ $prevIcon }}" style="font-size: 11px;"></i> <span class="ms-1">{{ __('messages.previous') }}</span>
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <span class="me-1">{{ __('messages.next') }}</span> <i class="fas {{ $nextIcon }}" style="font-size: 11px;"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link"><span class="me-1">{{ __('messages.next') }}</span> <i class="fas {{ $nextIcon }}" style="font-size: 11px;"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
