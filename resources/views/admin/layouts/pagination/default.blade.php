@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('pagination.title') }}" class="my-1 md:my-0">
        <div class="hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-normal text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-normal text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    {!! __('pagination.previous') !!}
                </a>
            @endif
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 mr-3 text-sm font-normal text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 mr-3 text-sm font-normal text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="flex flex-col items-center justify-between flex-1 md:flex-row gap-y-3">
            <div class="self-start md:self-auto">
                <p class="text-sm font-normal leading-5 text-gray-700">
                    {!! __('pagination.showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-normal">{{ $paginator->firstItem() }}</span>
                        {!! __('pagination.to') !!}
                        <span class="font-normal">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('pagination.of') !!}
                    <span class="font-normal">{{ $paginator->total() }}</span>
                    {!! __('pagination.results') !!}
                </p>
            </div>

            <div class="self-end md:self-auto">
                <nav class="inline-flex -space-x-px rounded-md shadow-sm isolate" aria-label="Pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-normal text-gray-500 border border-gray-300 cursor-default bg-gray-50 broder-l-0 rounded-r-md focus:z-20" aria-hidden="true">
                                <!-- Heroicon name: mini/chevron-right -->
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-normal text-gray-500 bg-white border border-l-0 border-gray-300 rounded-r-md hover:bg-gray-50 focus:z-20" aria-label="{{ __('pagination.previous') }}">
                            <span class="sr-only">{{ __('pagination.previous') }}</span>
                            <!-- Heroicon name: mini/chevron-right -->
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true" class="relative inline-flex items-center px-4 py-2 text-sm font-normal text-gray-700 bg-white border border-gray-300">
                                {{ $element }}
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page" class="relative z-10 inline-flex items-center px-4 py-2 text-sm font-normal border text-primary-600 border-primary-600 bg-primary-50 focus:z-20">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-normal text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 focus:z-20" aria-label="{{ __('pagination.go_to', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 text-sm font-normal text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50 focus:z-20" aria-label="{{ __('pagination.next') }}">
                            <span class="sr-only">{{ __('pagination.next') }}</span>
                            <!-- Heroicon name: mini/chevron-left -->
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-normal text-gray-500 border border-r-0 border-gray-300 cursor-default bg-gray-50 rounded-l-md focus:z-20" aria-hidden="true">
                                <!-- Heroicon name: mini/chevron-left -->
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </nav>
            </div>
        </div>
    </nav>
@endif
