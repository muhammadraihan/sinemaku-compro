@php
// This logic replicates the React useLocation and path splitting
$pathnames = collect(explode('/', request()->path()))->filter(fn($value) => $value !== '');

// Don't show breadcrumb on homepage
if (request()->is('/')) {
    $pathnames = collect([]);
}

$breadcrumbNameMap = [
    'movies' => 'Films',
    'series' => 'Series',
    'shop' => 'Shop',
    'jobs' => 'Careers',
    'events' => 'Events',
    'articles' => 'Articles',
    'movie' => 'Film',
    'article' => 'Article',
    'event' => 'Event',
    'job' => 'Job',
    'casting' => 'Casting',
    'product' => 'Product',
    'membership' => 'Membership'
];

// Function to get display name for breadcrumb
function getDisplayName($segment, $index, $pathnames, $map) {
    if (isset($map[$segment])) {
        return $map[$segment];
    }
    $parentSegment = $index > 0 ? $pathnames[$index - 1] : '';
    if (in_array($parentSegment, ['movie', 'series', 'article', 'event', 'product', 'job', 'casting'])) {
        return ucfirst($parentSegment) . ' Detail';
    }
    return ucfirst($segment);
};
@endphp

@if($pathnames->isNotEmpty())
<nav class="absolute top-24 left-6 lg:left-8 z-30">
    <ol class="flex items-center space-x-2 text-sm">
        <li>
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-300 flex items-center">
                <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </a>
        </li>
        @foreach ($pathnames as $index => $value)
            @php
                $isLast = $index === $pathnames->count() - 1;
                $displayName = getDisplayName($value, $index, $pathnames, $breadcrumbNameMap);
                $linkPath = url('/' . $pathnames->slice(0, $index + 1)->implode('/'));
            @endphp
            <li class="flex items-center space-x-2">
                <svg class="h-3 w-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                @if (!$isLast)
                    <a href="{{ $linkPath }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-300">
                        {{ $displayName }}
                    </a>
                @else
                    <span class="text-gray-700 font-medium">
                        {{ $displayName }}
                    </span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
@endif
