{{-- resources/views/components/navbar.blade.php --}}

<nav id="main-navbar" class="fixed top-0 w-full z-50 transition-all duration-500 ease-out backdrop-blur-xl"
     style="background: rgba(11,10,26,0.40); border-bottom: 1px solid rgba(237,149,32,0.12);">
    <div class="w-full px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            {{-- Hamburger --}}
            <button id="menu-toggle"
                    class="transition-all duration-300 z-60 relative text-white"
                    style="color: #fff;"
                    onmouseenter="this.style.color='#ed9520'"
                    onmouseleave="this.style.color='#fff'"
                    aria-label="Toggle menu">
                <span class="iconify" data-icon="lucide:menu" data-width="24"></span>
            </button>

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="group z-60 absolute left-1/2 transform -translate-x-1/2 text-center">
                <span class="block text-xl font-bold tracking-tight text-white transition-colors duration-300"
                      style="transition: color 300ms ease;"
                      onmouseenter="this.style.color='#ed9520'"
                      onmouseleave="this.style.color='#fff'">
                    SINEMAKU PICTURES
                </span>
                <span class="block h-[1px] w-0 group-hover:w-full transition-all duration-500 mt-0.5 mx-auto"
                      style="background: linear-gradient(90deg, #ed9520, transparent);"></span>
            </a>

            {{-- Search --}}
            <button id="search-toggle"
                    class="transition-all duration-300 z-60 relative text-white"
                    style="color: #fff;"
                    onmouseenter="this.style.color='#ed9520'"
                    onmouseleave="this.style.color='#fff'"
                    aria-label="Toggle search">
                <span class="iconify" data-icon="lucide:search" data-width="24"></span>
            </button>

        </div>
    </div>
</nav>

{{-- MegaMenu Fullscreen Overlay --}}
<div id="mega-menu" class="fixed inset-0 z-40 invisible opacity-0 pointer-events-none transition-all duration-700 ease-in-out">

    {{-- Deep navy background --}}
    <div class="absolute inset-0 backdrop-blur-2xl" style="background: rgba(9,8,26,0.97);"></div>

    {{-- Close Button --}}
    <button id="mega-menu-close"
            class="absolute top-8 left-8 text-white text-3xl z-50 focus:outline-none transition-colors duration-300"
            onmouseenter="this.style.color='#ed9520'"
            onmouseleave="this.style.color='#fff'"
            aria-label="Close menu">&times;</button>

    {{-- Menu Content --}}
    <div class="relative h-full overflow-y-auto flex items-center justify-center py-20">
        <div class="w-full px-6 lg:px-8">
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-16 items-center">

                {{-- Navigation Links --}}
                <div class="xl:col-span-8">
                    <div class="space-y-4 md:space-y-6 lg:space-y-8">
                        @php
                            $navItems = [
                                [ 'name' => 'Home',       'path' => '/',          'description' => 'Return to homepage' ],
                                [ 'name' => 'Films',      'path' => '/movies',    'description' => 'Explore our cinematic works' ],
                                [ 'name' => 'Series',     'path' => '/series',    'description' => 'Long-form storytelling' ],
                                [ 'name' => 'Shop',       'path' => '/shop',      'description' => 'Exclusive merchandise' ],
                                [ 'name' => 'Articles',   'path' => '/articles',  'description' => 'Stories and insights' ],
                                [ 'name' => 'Events',     'path' => '/events',    'description' => 'Premieres and screenings' ],
                                [ 'name' => 'Membership', 'path' => '/membership','description' => 'Join our inner circle' ],
                                [ 'name' => 'Careers',    'path' => '/jobs',      'description' => 'Join our creative team' ],
                            ];
                            $currentPath = request()->path() === '/' ? '/' : '/' . request()->path();
                        @endphp

                        @foreach($navItems as $item)
                            @php $isActive = $currentPath === $item['path']; @endphp
                            <div>
                                <a href="{{ url($item['path']) }}"
                                   class="group block transition-all duration-500"
                                   style="color: {{ $isActive ? '#ed9520' : 'rgba(107,114,128,1)' }};"
                                   onmouseenter="if(!{{ $isActive ? 'true' : 'false' }}) this.style.color='#fff'"
                                   onmouseleave="if(!{{ $isActive ? 'true' : 'false' }}) this.style.color='rgba(107,114,128,1)'">

                                    <div class="flex flex-col lg:flex-row lg:items-baseline lg:space-x-6">
                                        <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl cinematic-title tracking-tight group-hover:translate-x-2 lg:group-hover:translate-x-4 transition-transform duration-500">
                                            {{ $item['name'] }}
                                        </h2>
                                        <span class="text-sm md:text-base lg:text-lg editorial-text opacity-0 group-hover:opacity-100 transition-all duration-500 delay-100 mt-2 lg:mt-0"
                                              style="color: #a39de0;">
                                            {{ $item['description'] }}
                                        </span>
                                    </div>

                                    {{-- Amber underline — full width if active, animates in on hover --}}
                                    <div class="h-px mt-2 md:mt-4 transition-all duration-700 {{ $isActive ? 'w-16 md:w-32 opacity-100' : 'w-0 group-hover:w-12 md:group-hover:w-24 opacity-0 group-hover:opacity-60' }}"
                                         style="background: linear-gradient(90deg, #ed9520, transparent);"></div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Contact Info & Brand --}}
                <div class="xl:col-span-4 mt-16 xl:mt-0">
                    <div class="space-y-8 lg:space-y-12">

                        <div>
                            <h3 class="text-xl md:text-2xl font-semibold text-white mb-4 md:mb-6 tracking-wide">
                                Get in Touch
                            </h3>
                            <div class="space-y-3 md:space-y-4" style="color: #a39de0;">
                                <span class="editorial-text text-sm md:text-base block">hello@sinemakupictures.com</span>
                                <span class="editorial-text text-sm md:text-base block">+62 21 1234 5678</span>
                                <span class="editorial-text text-sm md:text-base block">Jakarta, Indonesia</span>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-base md:text-lg font-medium text-white mb-3 md:mb-4 tracking-wide">
                                Follow Us
                            </h3>
                            <div class="flex flex-wrap gap-4 md:gap-6">
                                @foreach(['Instagram','Twitter','YouTube'] as $social)
                                    <a href="#"
                                       class="editorial-text text-sm md:text-base transition-colors duration-300"
                                       style="color: #7069c7;"
                                       onmouseenter="this.style.color='#ed9520'"
                                       onmouseleave="this.style.color='#7069c7'">
                                        {{ $social }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div style="color: #221d55;">
                            <div class="text-xl md:text-2xl font-bold tracking-tight">SINEMAKU PICTURES</div>
                            <div class="text-xs md:text-sm editorial-text">EST. 2020</div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        {{-- Bottom decorative text --}}
        <div class="absolute bottom-6 md:bottom-8 left-6 md:left-8">
            <div class="editorial-text text-xs md:text-sm" style="color: #221d55;">
                © 2024 Sinemaku Pictures. All rights reserved.
            </div>
        </div>
        <div class="hidden lg:block absolute top-1/2 right-6 md:right-8 -translate-y-1/2">
            <div class="writing-mode-vertical editorial-text text-xs md:text-sm tracking-widest" style="color: #221d55;">
                CREATIVE STORYTELLING
            </div>
        </div>
    </div>
</div>
