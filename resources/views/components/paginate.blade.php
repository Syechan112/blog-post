@if ($paginator->hasPages())
    <nav aria-label="Page navigation" class="my-8">
        <ul class="flex justify-center items-center space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="px-3 py-2 text-gray-400 rounded-md cursor-not-allowed" aria-disabled="true">
                    <span aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
                </li>
            @else
                <li>
                    <a class="px-3 py-2 text-blue-500 bg-white rounded-md hover:bg-blue-100 transition duration-150 ease-in-out" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="px-3 py-2 text-gray-500" aria-disabled="true">
                        <span class="text-gray-400">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page">
                                <span class="px-3 py-2 text-white bg-blue-500 rounded-md">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a class="px-3 py-2 text-blue-500 bg-white rounded-md hover:bg-blue-100 transition duration-150 ease-in-out" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="px-3 py-2 text-blue-500 bg-white rounded-md hover:bg-blue-100 transition duration-150 ease-in-out" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="px-3 py-2 text-gray-400 rounded-md cursor-not-allowed" aria-disabled="true">
                    <span aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
