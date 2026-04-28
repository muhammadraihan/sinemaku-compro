{{-- resources/views/components/navbar.blade.php --}}

<nav id="main-navbar" class="fixed top-0 w-full z-50 transition-all duration-500 ease-out backdrop-blur-xl bg-brand-deepbreath/40 border-b border-white/10">
    <div class="w-full px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            {{-- Hamburger --}}
            <button id="menu-toggle"
                    class="transition-colors duration-300 z-60 relative text-white hover:text-brand-orange cursor-none hover-target"
                    aria-label="Toggle menu">
                <span class="iconify" data-icon="lucide:menu" data-width="24"></span>
            </button>

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="group z-60 absolute left-1/2 transform -translate-x-1/2 text-center cursor-none hover-target">
                <span class="block text-xl font-serif font-bold tracking-tight text-white group-hover:text-brand-orange transition-colors duration-300">
                    SINEMAKU PICTURES
                </span>
                <span class="block h-[1px] w-0 group-hover:w-full transition-all duration-500 mt-1 mx-auto bg-gradient-to-r from-transparent via-brand-orange to-transparent"></span>
            </a>

            {{-- Search --}}
            <button id="search-toggle"
                    class="transition-colors duration-300 z-60 relative text-white hover:text-brand-orange cursor-none hover-target"
                    aria-label="Toggle search">
                <span class="iconify" data-icon="lucide:search" data-width="24"></span>
            </button>

        </div>
    </div>
</nav>

{{-- MegaMenu Fullscreen Overlay --}}
<div id="mega-menu" class="fixed inset-0 z-40 invisible opacity-0 pointer-events-none transition-all duration-700 ease-in-out">

    {{-- Deep navy background --}}
    <div class="absolute inset-0 bg-brand-deepbreath/95 backdrop-blur-2xl"></div>

    {{-- Close Button --}}
    <button id="mega-menu-close"
            class="absolute top-8 left-8 text-white text-3xl z-50 focus:outline-none transition-colors duration-300 hover:text-brand-orange cursor-none hover-target"
            aria-label="Close menu">&times;</button>

    {{-- Menu Content --}}
    <div class="relative h-full overflow-y-auto flex items-center justify-center py-20">
        <div class="w-full px-8 md:px-16 max-w-[1600px] mx-auto">
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-16 items-center">

                {{-- Navigation Links --}}
                <div class="xl:col-span-8">
                    <div class="flex flex-col gap-4 md:gap-6">
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
                                   class="group block transition-all duration-500 w-fit cursor-none hover-target {{ $isActive ? 'text-brand-orange' : 'text-white/40 hover:text-white' }}">

                                    <div class="flex flex-col lg:flex-row lg:items-end lg:gap-8">
                                        {{-- NO ITALIC AS REQUESTED --}}
                                        <h2 class="font-serif not-italic text-4xl sm:text-5xl md:text-6xl lg:text-7xl tracking-tight group-hover:translate-x-4 transition-transform duration-500 leading-none">
                                            {{ $item['name'] }}
                                        </h2>
                                        <span class="font-sans font-light text-sm md:text-base opacity-0 group-hover:opacity-100 transition-opacity duration-500 mb-2 {{ $isActive ? 'text-brand-orange/80' : 'text-white/60' }}">
                                            {{ $item['description'] }}
                                        </span>
                                    </div>

                                    {{-- Underline --}}
                                    <div class="h-[1px] mt-2 transition-all duration-700 bg-brand-orange {{ $isActive ? 'w-24 opacity-100' : 'w-0 group-hover:w-16 opacity-0 group-hover:opacity-100' }}"></div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Contact Info & Brand --}}
                <div class="xl:col-span-4 mt-16 xl:mt-0">
                    <div class="flex flex-col gap-12">

                        <div>
                            <span class="font-sans text-[10px] tracking-[0.3em] uppercase font-bold text-brand-orange mb-6 block">
                                Get in Touch
                            </span>
                            <div class="flex flex-col gap-3 font-sans font-light text-sm md:text-base text-white/70">
                                <span class="hover:text-white transition-colors cursor-none hover-target w-fit">hello@sinemakupictures.com</span>
                                <span class="hover:text-white transition-colors cursor-none hover-target w-fit">+62 21 1234 5678</span>
                                <span class="hover:text-white transition-colors cursor-none hover-target w-fit">Jakarta, Indonesia</span>
                            </div>
                        </div>

                        <div>
                            <span class="font-sans text-[10px] tracking-[0.3em] uppercase font-bold text-brand-orange mb-6 block">
                                Follow Us
                            </span>
                            <div class="flex flex-wrap gap-6">
                                @foreach(['Instagram','Twitter','YouTube'] as $social)
                                    <a href="#"
                                       class="font-sans text-sm md:text-base font-light text-white/70 hover:text-brand-orange transition-colors duration-300 cursor-none hover-target">
                                        {{ $social }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-8 border-t border-white/10">
                            <div class="flex items-center gap-3 text-white/20 mb-2">
                                <span class="iconify h-6 w-6" data-icon="lucide:film"></span>
                                <div class="font-serif text-2xl font-bold tracking-tight">SINEMAKU PICTURES</div>
                            </div>
                            <div class="font-sans text-[10px] tracking-widest text-white/20">EST. 2020</div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        {{-- Bottom decorative text --}}
        <div class="absolute bottom-8 left-8 md:left-16">
            <div class="font-sans font-medium text-[9px] tracking-widest text-white/20 uppercase">
                © 2026 Sinemaku Pictures. All rights reserved.
            </div>
        </div>
        <div class="hidden lg:block absolute top-1/2 right-8 md:right-16 -translate-y-1/2">
            <div class="vertical-text font-sans font-bold text-[10px] tracking-[0.3em] text-white/10">
                CREATIVE STORYTELLING
            </div>
        </div>
    </div>
</div>
