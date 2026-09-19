@if ($paginator->hasPages())
    <nav class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3">
        {{-- Mobile Compact Pagination Info & Links --}}
        <div class="d-flex flex-column align-items-center gap-2 w-100 d-sm-none text-center">
            <div class="text-muted fs-7">
                Menampilkan <span class="fw-bold text-gray-800">{{ $paginator->firstItem() ?? 0 }}</span> - <span class="fw-bold text-gray-800">{{ $paginator->lastItem() ?? 0 }}</span> dari <span class="fw-bold text-gray-800">{{ $paginator->total() }}</span> data
            </div>
            <ul class="pagination pagination-sm m-0">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link"><i class="ki-outline ki-left fs-6"></i></span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="ki-outline ki-left fs-6"></i></a>
                    </li>
                @endif

                {{-- Page Links (Compact Range for Mobile) --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @elseif ($page == 1 || $page == $paginator->lastPage() || abs($page - $paginator->currentPage()) <= 1)
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="ki-outline ki-right fs-6"></i></a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link"><i class="ki-outline ki-right fs-6"></i></span>
                    </li>
                @endif
            </ul>
        </div>

        {{-- Desktop Full Pagination View --}}
        <div class="d-none d-sm-flex align-items-center justify-content-between w-100">
            <div class="text-muted fs-7">
                Menampilkan <span class="fw-bold text-gray-800">{{ $paginator->firstItem() ?? 0 }}</span> sampai <span class="fw-bold text-gray-800">{{ $paginator->lastItem() ?? 0 }}</span> dari <span class="fw-bold text-gray-800">{{ $paginator->total() }}</span> data
            </div>

            <div>
                <ul class="pagination m-0">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="Sebelumnya">
                            <span class="page-link" aria-hidden="true"><i class="ki-outline ki-left fs-5"></i></span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Sebelumnya"><i class="ki-outline ki-left fs-5"></i></a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
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
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Berikutnya"><i class="ki-outline ki-right fs-5"></i></a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="Berikutnya">
                            <span class="page-link" aria-hidden="true"><i class="ki-outline ki-right fs-5"></i></span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
