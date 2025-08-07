@extends('layouts.app')

@section('content')

@include('components.navbar')

<div class="bg-black text-white">

    {{-- COMING SOON (HERO) --}}
    <section class="inner-page bg-white text-black container-edge">
        <div class="container-content py-16">
            <h2 class="text-6xl md:text-7xl cinematic-title mb-20">Coming Soon</h2>
            <div class="space-y-24 lg:space-y-32">
                @php
                    $upcomingMovies = [
                        [
                            'id' => 'echoes-tomorrow',
                            'title' => 'Echoes of Tomorrow',
                            'year' => '2024',
                            'image' => 'https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=600&h=900&fit=crop',
                            'genre' => 'Sci-Fi Drama',
                            'status' => 'In Production',
                            'description' => 'A haunting exploration of memory and time in a world where the past refuses to stay buried.',
                            'director' => 'Elena Rodriguez'
                        ],
                        [
                            'id' => 'midnight-sequel',
                            'title' => 'Midnight: Awakening',
                            'year' => '2024',
                            'image' => 'https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=600&h=900&fit=crop',
                            'genre' => 'Thriller',
                            'status' => 'Post-Production',
                            'description' => 'The nightmare continues where reality ends in this highly anticipated sequel.',
                            'director' => 'Michael Torres'
                        ],
                        [
                            'id' => 'last-symphony',
                            'title' => 'The Last Symphony',
                            'year' => '2025',
                            'image' => 'https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=600&h=900&fit=crop',
                            'genre' => 'Musical Drama',
                            'status' => 'Pre-Production',
                            'description' => 'Music as the language of the soul in this emotional journey through sound and silence.',
                            'director' => 'Lisa Wang'
                        ]
                    ];
                    $statusColors = [
                        'Released' => 'bg-green-500 text-white',
                        'In Production' => 'bg-blue-500 text-white',
                        'Post-Production' => 'bg-yellow-500 text-black',
                        'Pre-Production' => 'bg-purple-500 text-white'
                    ];
                @endphp

                @foreach ($upcomingMovies as $i => $movie)
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center {{ $i % 2 == 1 ? 'lg:grid-flow-col-dense' : '' }}">
                    <div class="lg:col-span-7 {{ $i % 2 == 1 ? 'lg:col-start-6' : '' }}">
                        <div class="group cursor-pointer image-overlay">
                            <div class="relative aspect-[3/4] overflow-hidden rounded-xl shadow-lg">
                                <img src="{{ $movie['image'] }}" alt="{{ $movie['title'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                                <div class="absolute top-8 left-8">
                                    <span class="px-4 py-2 text-sm font-medium {{ $statusColors[$movie['status']] ?? 'bg-gray-500 text-white' }}">
                                        {{ $movie['status'] }}
                                    </span>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="absolute bottom-8 left-8 right-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    <div class="flex items-center justify-center">
                                        <span class="iconify h-12 w-12" data-icon="lucide:play"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-5 space-y-6 lg:space-y-8 {{ $i % 2 == 1 ? 'lg:col-start-1' : '' }}">
                        <h3 class="text-4xl md:text-5xl lg:text-6xl cinematic-title mb-4 lg:mb-6 leading-tight">
                            {{ $movie['title'] }}
                        </h3>
                        <div class="flex items-center space-x-4 text-gray-600 mb-4 lg:mb-6">
                            <span class="text-lg">{{ $movie['year'] }}</span>
                            <span>•</span>
                            <span class="text-lg">{{ $movie['genre'] }}</span>
                        </div>
                        <p class="text-gray-600 editorial-text leading-relaxed mb-4 lg:mb-6 text-lg">
                            {{ $movie['description'] }}
                        </p>
                        <p class="text-gray-500 editorial-text">Directed by {{ $movie['director'] }}</p>
                        <a href="{{ url('/moviex') }}"
                            class="inline-flex items-center px-8 py-4 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift group btn-cinematic"
                        >
                            EXPLORE
                            <span class="iconify ml-3 h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" data-icon="lucide:play"></span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ALL FILMS --}}
    <section class="py-24 lg:py-32 bg-white text-black container-edge">
        <div class="container-content">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end mb-16 lg:mb-20">
                <h2 class="text-6xl md:text-7xl cinematic-title text-black mb-8 lg:mb-0">All Films</h2>
                {{-- Filter --}}
                <div class="flex items-center space-x-4">
                    <span class="iconify h-5 w-5 text-gray-600" data-icon="lucide:filter"></span>
                    <div class="flex flex-wrap gap-2">
                        @php
                            $filters = ['all', 'drama', 'thriller', 'sci-fi', 'romance'];
                            $active = request('filter', 'all');
                        @endphp
                        @foreach($filters as $filterOption)
                        <a href="{{ url()->current() }}?filter={{ $filterOption }}"
                           class="px-4 py-2 text-sm font-medium tracking-wide transition-all duration-300 hover:scale-105 {{ $active == $filterOption ? 'bg-black text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                            {{ ucfirst($filterOption) }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @php
                $allMovies = [
                    [
                        'id' => 'midnight',
                        'title' => 'Midnight',
                        'year' => '2024',
                        'image' => 'https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
                        'genre' => 'Thriller',
                        'rating' => 4.8,
                        'status' => 'Released',
                        'director' => 'Elena Rodriguez'
                    ],
                    [
                        'id' => 'silent-waters',
                        'title' => 'Silent Waters',
                        'year' => '2023',
                        'image' => 'https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
                        'genre' => 'Drama',
                        'rating' => 4.6,
                        'status' => 'Released',
                        'director' => 'David Kim'
                    ],
                    [
                        'id' => 'neon-dreams',
                        'title' => 'Neon Dreams',
                        'year' => '2023',
                        'image' => 'https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
                        'genre' => 'Sci-Fi',
                        'rating' => 4.4,
                        'status' => 'Released',
                        'director' => 'Sarah Chen'
                    ],
                    [
                        'id' => 'forgotten-melody',
                        'title' => 'Forgotten Melody',
                        'year' => '2022',
                        'image' => 'https://images.pexels.com/photos/2873486/pexels-photo-2873486.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
                        'genre' => 'Romance',
                        'rating' => 4.7,
                        'status' => 'Released',
                        'director' => 'Anna Martinez'
                    ],
                    [
                        'id' => 'shadows-past',
                        'title' => 'Shadows of the Past',
                        'year' => '2022',
                        'image' => 'https://images.pexels.com/photos/1656684/pexels-photo-1656684.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
                        'genre' => 'Mystery',
                        'rating' => 4.5,
                        'status' => 'Released',
                        'director' => 'James Park'
                    ],
                    [
                        'id' => 'golden-hour',
                        'title' => 'Golden Hour',
                        'year' => '2021',
                        'image' => 'https://images.pexels.com/photos/167092/pexels-photo-167092.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
                        'genre' => 'Drama',
                        'rating' => 4.9,
                        'status' => 'Released',
                        'director' => 'Robert Chen'
                    ]
                ];
                $filterLower = strtolower($active);
                $filteredMovies = $filterLower == 'all'
                    ? $allMovies
                    : array_filter($allMovies, function($movie) use ($filterLower) {
                        return str_contains(strtolower($movie['genre']), $filterLower);
                    });
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 lg:gap-8">
                @foreach ($filteredMovies as $movie)
                <a href="{{ url('/moviex') }}"
                   class="group cursor-pointer hover-lift hover-tilt">
                    <div class="relative overflow-hidden image-overlay rounded-lg shadow">
                        <img src="{{ $movie['image'] }}" alt="{{ $movie['title'] }}" class="w-full aspect-[2/3] object-cover group-hover:scale-110 transition-transform duration-500" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute inset-0 flex flex-col justify-between p-4 lg:p-6 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="flex justify-between items-start">
                                <span class="text-xs bg-white/20 px-2 py-1 backdrop-blur-sm">{{ $movie['genre'] }}</span>
                                @if(isset($movie['rating']))
                                <div class="flex items-center">
                                    <span class="iconify h-4 w-4 text-yellow-400 mr-1" data-icon="lucide:star"></span>
                                    <span class="text-sm">{{ $movie['rating'] }}</span>
                                </div>
                                @endif
                            </div>
                            <div class="text-center">
                                <span class="iconify h-8 w-8 mx-auto mb-2" data-icon="lucide:play"></span>
                                <p class="text-xs">Directed by {{ $movie['director'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="font-semibold text-black group-hover:text-gray-600 transition-colors text-sm mb-1 leading-tight">{{ $movie['title'] }}</h3>
                        <p class="text-gray-600 text-xs">{{ $movie['year'] }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-24 lg:py-32 bg-gray-50 text-black container-edge">
        <div class="container-content">
            <div class="max-w-4xl mx-auto text-center">
                <span class="iconify h-20 w-20 text-gray-400 mx-auto mb-8" data-icon="lucide:calendar"></span>
                <h2 class="text-6xl md:text-7xl cinematic-title mb-8">
                    Stay in the Loop
                </h2>
                <p class="text-xl md:text-2xl editorial-text text-gray-600 mb-12 leading-relaxed">
                    Be the first to know about our latest releases, exclusive screenings,
                    and behind-the-scenes content. Join our community of film enthusiasts.
                </p>
                <button class="px-12 py-6 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift text-lg btn-cinematic">
                    SUBSCRIBE TO UPDATES
                </button>
            </div>
        </div>
    </section>

    @include('components.footer')
</div>

@endsection
