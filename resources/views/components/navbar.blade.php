{{-- resources/views/components/navbar.blade.php --}}

<nav id="main-navbar" class="fixed top-0 w-full z-50 transition-all duration-500 ease-out bg-black/30 backdrop-blur-xl border-b border-white/20">
    <div class="w-full px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            {{-- Hamburger Menu Button --}}
            <button id="menu-toggle" class="transition-all duration-500 z-60 relative text-white hover:text-gray-300" aria-label="Toggle menu">
                <span class="iconify" data-icon="lucide:menu" data-width="24"></span>
            </button>
            {{-- Logo --}}
            <a href="{{ url('/') }}" class="group z-60 absolute left-1/2 transform -translate-x-1/2">
                <span class="text-xl font-bold tracking-tight transition-all duration-500 text-white">
                    SINEMAKU PICTURES
                </span>
            </a>
            {{-- Search Button --}}
            <button id="search-toggle" class="transition-all duration-500 z-60 relative text-white hover:text-gray-300" aria-label="Toggle search">
                <span class="iconify" data-icon="lucide:search" data-width="24"></span>
            </button>
        </div>
    </div>
</nav>

{{-- MegaMenu Fullscreen Overlay --}}
<div id="mega-menu" class="fixed inset-0 z-40 invisible opacity-0 pointer-events-none transition-all duration-700 ease-in-out">
    {{-- Background Glassmorphism --}}
    <div class="absolute inset-0 bg-black/95 backdrop-blur-2xl transition-all duration-700 opacity-100"></div>

    {{-- Close Button --}}
    <button id="mega-menu-close" class="absolute top-8 left-8 text-white text-3xl z-50 focus:outline-none" aria-label="Close menu">&times;</button>

    {{-- Menu Content --}}
    <div class="relative h-full overflow-y-auto flex items-center justify-center py-20 transition-all duration-700 delay-200 opacity-100 translate-y-0">
        <div class="w-full px-6 lg:px-8">
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-16 items-center">
                {{-- Navigation Links --}}
                <div class="xl:col-span-8">
                    <div class="space-y-4 md:space-y-6 lg:space-y-8">
                        @php
                            $navItems = [
                                [ 'name' => 'Home', 'path' => '/', 'description' => 'Return to homepage' ],
                                [ 'name' => 'Films', 'path' => '/movies', 'description' => 'Explore our cinematic works' ],
                                [ 'name' => 'Series', 'path' => '/series', 'description' => 'Long-form storytelling' ],
                                [ 'name' => 'Shop', 'path' => '/shop', 'description' => 'Exclusive merchandise' ],
                                [ 'name' => 'Articles', 'path' => '/articles', 'description' => 'Stories and insights' ],
                                [ 'name' => 'Events', 'path' => '/events', 'description' => 'Premieres and screenings' ],
                                [ 'name' => 'Membership', 'path' => '/membership', 'description' => 'Join our inner circle' ],
                                [ 'name' => 'Careers', 'path' => '/jobs', 'description' => 'Join our creative team' ],
                            ];
                            $currentPath = request()->path() === '/' ? '/' : '/' . request()->path();
                        @endphp
                        @foreach($navItems as $item)
                            <div class="transition-all duration-700 opacity-100 translate-x-0">
                                <a href="{{ url($item['path']) }}" class="group block transition-all duration-500 {{ $currentPath === $item['path'] ? 'text-white' : 'text-gray-400 hover:text-white' }}">
                                    <div class="flex flex-col lg:flex-row lg:items-baseline lg:space-x-6">
                                        <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl cinematic-title tracking-tight group-hover:translate-x-2 lg:group-hover:translate-x-4 transition-transform duration-500">
                                            {{ $item['name'] }}
                                        </h2>
                                        <span class="text-sm md:text-base lg:text-lg editorial-text opacity-0 group-hover:opacity-100 transition-all duration-500 delay-100 mt-2 lg:mt-0">
                                            {{ $item['description'] }}
                                        </span>
                                    </div>
                                    <div class="h-px bg-gradient-to-r from-white to-transparent mt-2 md:mt-4 transition-all duration-700 {{ $currentPath === $item['path'] ? 'w-16 md:w-32 opacity-100' : 'w-0 group-hover:w-12 md:group-hover:w-24 opacity-0 group-hover:opacity-50' }}"></div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Contact Info & Logo --}}
                <div class="xl:col-span-4 mt-16 xl:mt-0">
                    <div class="space-y-8 lg:space-y-12">
                        <div class="transition-all duration-700 delay-500 opacity-100 translate-y-0">
                            <div class="space-y-6 lg:space-y-8">
                                <div>
                                    <h3 class="text-xl md:text-2xl font-semibold text-white mb-4 md:mb-6 tracking-wide">
                                        Get in Touch
                                    </h3>
                                    <div class="space-y-3 md:space-y-4 text-gray-300">
                                        <div class="flex items-center space-x-3 md:space-x-4">
                                            <span class="editorial-text text-sm md:text-base">hello@sinemakupictures.com</span>
                                        </div>
                                        <div class="flex items-center space-x-3 md:space-x-4">
                                            <span class="editorial-text text-sm md:text-base">+62 21 1234 5678</span>
                                        </div>
                                        <div class="flex items-center space-x-3 md:space-x-4">
                                            <span class="editorial-text text-sm md:text-base">Jakarta, Indonesia</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-base md:text-lg font-medium text-white mb-3 md:mb-4 tracking-wide">
                                        Follow Us
                                    </h3>
                                    <div class="flex flex-wrap gap-4 md:gap-6">
                                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300 editorial-text text-sm md:text-base">Instagram</a>
                                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300 editorial-text text-sm md:text-base">Twitter</a>
                                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300 editorial-text text-sm md:text-base">YouTube</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="transition-all duration-700 delay-700 opacity-100 scale-100">
                            <div class="text-gray-600">
                                <div class="text-xl md:text-2xl font-bold tracking-tight">SINEMAKU PICTURES</div>
                                <div class="text-xs md:text-sm editorial-text">EST. 2020</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Decorative --}}
        <div class="absolute bottom-6 md:bottom-8 left-6 md:left-8 transition-all duration-700 delay-600 opacity-100 translate-y-0">
            <div class="text-gray-600 editorial-text text-xs md:text-sm">
                © 2024 Sinemaku Pictures. All rights reserved.
            </div>
        </div>
        <div class="hidden lg:block absolute top-1/2 right-6 md:right-8 -translate-y-1/2 transition-all duration-700 delay-800 opacity-100 translate-x-0">
            <div class="writing-mode-vertical text-gray-600 editorial-text text-xs md:text-sm tracking-widest">
                CREATIVE STORYTELLING
            </div>
        </div>
    </div>
</div>

{{-- End of navbar + MegaMenu --}}
