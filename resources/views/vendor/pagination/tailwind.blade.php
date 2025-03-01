@if ($paginator->hasPages())
    <nav role="navigation" class="flex items-center justify-between">
        {{-- Page Links --}}
        <div class="flex-1 flex justify-center">
            <ul class="hidden sm:flex items-center gap-0.5">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="text-sm text-gray-500 dark:text-gray-400">{{ $element }}</li>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <li>
                                <a href="{{ $url }}"
                                   class="text-theme-sm flex h-10 w-10 items-center justify-center rounded-lg font-medium {{ $page == $paginator->currentPage() ? 'bg-brand-500/[0.08] text-brand-500' : 'hover:bg-brand-500/[0.08] hover:text-brand-500 dark:hover:text-brand-500 text-gray-700 dark:text-gray-400' }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                @endforeach
            </ul>
        </div>
    </nav>
@endif