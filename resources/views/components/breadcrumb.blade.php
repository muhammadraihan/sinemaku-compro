{{-- resources/views/components/breadcrumb.blade.php --}}
@php
    $segments = request()->segments();
@endphp
@if (count($segments) > 0)
    <nav class="absolute top-24 left-6 lg:left-8 z-30">
        <ol class="flex items-center space-x-2 text-sm">
            <li>
                <a href="{{ url('/') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-300 flex items-center">
                    <span class="iconify h-3 w-3" data-icon="lucide:home"></span>
                </a>
            </li>
            @foreach ($segments as $index => $segment)
                <span class="iconify h-3 w-3 text-gray-400" data-icon="lucide:chevron-right"></span>
                <li>
                    @if ($index + 1 < count($segments))
                        <a href="{{ url(implode('/', array_slice($segments, 0, $index + 1))) }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-300">
                            {{ ucfirst($segment) }}
                        </a>
                    @else
                        <span class="text-gray-700 font-medium">
                            {{ ucfirst($segment) }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
