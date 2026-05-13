@extends('layouts.app')

@section('title', 'Our Films | Sinemaku Pictures')

@section('content')

    @include('partials.navbar')

    <style>
        /* ── INTERACTIVE GRADIENT BACKGROUND ── */
        #interactive-bg {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background:
                radial-gradient(
                    ellipse 50vw 50vh at var(--mx, 25%) var(--my, 55%),
                    rgba(243, 107, 33, 0.4) 0%,
                    transparent 60%
                );
            filter: blur(80px);
            opacity: 0.5;
        }

        /* ── EFEK LIGHT LEAK & GRAIN ── */
        .cinematic-grain {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 9999;
            opacity: 0.04;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
            mix-blend-mode: multiply;
        }

        .light-leak {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            opacity: 0.2; /* Adjusted for better balance with multiple leaks */
            filter: blur(100px); /* Softer falloff */
        }

        @keyframes float-left {
            0%, 100% { transform: translate(-50%, 0) scale(1); }
            50%      { transform: translate(-45%, 5%) scale(1.1); }
        }

        @keyframes float-right {
            0%, 100% { transform: translate(50%, 0) scale(1); }
            50%      { transform: translate(45%, -5%) scale(1.1); }
        }

        /* Zig Zag Positions */
        #leak-orange-1 {
            background: radial-gradient(circle, #F36B21 0%, transparent 70%);
            top: 15%;
            left: 0;
            animation: float-left 20s ease-in-out infinite;
        }

        #leak-navy-1 {
            background: radial-gradient(circle, #22397A 0%, transparent 70%);
            top: 40%;
            right: 0;
            animation: float-right 25s ease-in-out infinite;
            opacity: 0.15;
        }

        #leak-orange-2 {
            background: radial-gradient(circle, #F36B21 0%, transparent 70%);
            top: 65%;
            left: 0;
            animation: float-left 22s ease-in-out infinite;
        }

        #leak-navy-2 {
            background: radial-gradient(circle, #22397A 0%, transparent 70%);
            top: 90%;
            right: 0;
            animation: float-right 28s ease-in-out infinite;
            opacity: 0.15;
        }
    </style>

    <!-- Interactive Gradient Background -->
    <div id="interactive-bg"></div>

    <!-- Efek Grain & Light Leak Global -->
    <div class="cinematic-grain"></div>
    
    <!-- Zig-Zag Light Leaks -->
    <div id="leak-orange-1" class="light-leak w-[40vw] h-[40vw]"></div>
    <div id="leak-navy-1" class="light-leak w-[45vw] h-[45vw]"></div>
    <div id="leak-orange-2" class="light-leak w-[40vw] h-[40vw]"></div>
    <div id="leak-navy-2" class="light-leak w-[45vw] h-[45vw]"></div>

    {{-- ============================================================
    EDITORIAL WRAPPER
    Menjaga gaya kanvas terang (Tint 3) khusus untuk halaman ini
    ============================================================ --}}
    <div id="editorial-wrapper" class="text-brand-deepbreath relative w-full font-sans">

        {{-- ============================================================
        1. EDITORIAL HERO SLIDESHOW
        ============================================================ --}}
        <section class="relative w-full h-[100svh] overflow-hidden">
            <!-- Background Images Container -->
            <div id="hero-bg-container" class="absolute inset-0 z-0">
                @foreach($film as $i => $item)
                    <div
                        class="hero-bg-image absolute inset-0 transition-opacity duration-1000 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}">
                        <img src="{{ asset('photo/' . $item->photo) }}" class="w-full h-full object-cover"
                            alt="@i18n($item, 'title')">
                        <!-- Dark Cinematic Overlay -->
                        <div class="absolute inset-0 bg-black/40"></div>
                    </div>
                @endforeach
            </div>

            <!-- Content Overlay -->
            <div class="relative z-10 w-full h-full flex flex-col justify-end px-8 md:px-16 pb-20">
                <div class="w-full flex flex-col items-start">
                    <!-- Film List (Vertical) -->
                    <div class="flex flex-col gap-2 md:gap-3">
                        @foreach($film as $i => $item)
                            <div class="film-nav-item group cursor-none hover-target" data-index="{{ $i }}">
                                <a href="{{ route('detail-film', $item->slug) }}" class="block">
                                    <div class="relative" style="max-width: min(50vw, 80vw);">
                                        <h2 class="film-title font-peckham text-2xl md:text-3xl lg:text-4xl uppercase leading-[0.95] transition-all duration-300 {{ $i === 0 ? 'text-white' : 'text-white/40 group-hover:text-white' }}">
                                            <span class="title-text">@i18n($item, 'title')</span>
                                        </h2>
                                        <div class="film-meta absolute top-0 flex flex-col gap-0.5 pl-3 pt-1 whitespace-nowrap pointer-events-none" style="left: 0; opacity: 1;">
                                            @if(\Carbon\Carbon::parse($item->release_date)->isFuture())
                                                <span class="font-sans text-[8px] md:text-[10px] tracking-widest uppercase text-brand-orange leading-none">Upcoming</span>
                                            @endif
                                            <span class="font-sans text-[8px] md:text-[9px] tracking-widest uppercase text-white/40 leading-none">{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }} | @i18n($item, 'genre')</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- ============================================================
        2. ALL FILMS CATALOGUE (HORIZONTAL PAN GRID)
        ============================================================ --}}
        <section class="py-32 z-10 relative max-w-[100vw] overflow-hidden">

            <!-- Header & Filter -->
            <div class="px-8 md:px-16 flex flex-col items-center mb-16 max-w-[1800px] mx-auto text-center">
                <h2 class="font-instrument italic text-4xl md:text-6xl text-brand-navy leading-none tracking-tight mb-12">
                    Our <span class="font-peckham not-italic text-brand-orange uppercase mx-1">Film</span> Catalogue
                </h2>

                <!-- Dual Filter Dropdown -->
                <div class="inline-flex items-center border border-brand-orange/30 rounded-full bg-brand-orange/5 p-1 relative z-50">
                    <div class="flex items-center">
                        <!-- Year Dropdown -->
                        <div class="relative group/filter">
                            <div id="filter-year-trigger" class="px-6 py-2 flex flex-col items-center border-r border-brand-orange/20 cursor-pointer hover:bg-brand-orange/10 transition-colors rounded-l-full">
                                <span class="text-[9px] uppercase tracking-widest text-brand-navy/40 leading-none mb-1">Release Year</span>
                                <span id="selected-year" class="text-sm font-instrument italic text-brand-navy font-bold leading-none">Any</span>
                            </div>
                            <div id="filter-year-menu" class="absolute top-full left-0 mt-2 w-48 bg-white border border-brand-orange/20 rounded-2xl shadow-xl opacity-0 translate-y-2 pointer-events-none transition-all duration-300 z-[60] overflow-hidden">
                                <div class="max-h-64 overflow-y-auto py-2">
                                    <div class="filter-option px-6 py-2 text-xs font-sans uppercase tracking-widest text-brand-navy/60 hover:text-brand-orange hover:bg-brand-orange/5 cursor-pointer transition-colors" data-type="year" data-value="Any">Any</div>
                                    @php
                                        $years = collect($genre)->map(fn($item) => \Carbon\Carbon::parse($item->release_date)->format('Y'))->unique()->sortDesc();
                                    @endphp
                                    @foreach($years as $year)
                                        <div class="filter-option px-6 py-2 text-xs font-sans uppercase tracking-widest text-brand-navy/60 hover:text-brand-orange hover:bg-brand-orange/5 cursor-pointer transition-colors" data-type="year" data-value="{{ $year }}">{{ $year }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Genre Dropdown -->
                        <div class="relative group/filter">
                            <div id="filter-genre-trigger" class="px-6 py-2 flex flex-col items-center cursor-pointer hover:bg-brand-orange/10 transition-colors rounded-r-full">
                                <span class="text-[9px] uppercase tracking-widest text-brand-navy/40 leading-none mb-1">Genre</span>
                                <span id="selected-genre" class="text-sm font-instrument italic text-brand-navy font-bold leading-none">Any</span>
                            </div>
                            <div id="filter-genre-menu" class="absolute top-full right-0 mt-2 w-48 bg-white border border-brand-orange/20 rounded-2xl shadow-xl opacity-0 translate-y-2 pointer-events-none transition-all duration-300 z-[60] overflow-hidden">
                                <div class="max-h-64 overflow-y-auto py-2">
                                    <div class="filter-option px-6 py-2 text-xs font-sans uppercase tracking-widest text-brand-navy/60 hover:text-brand-orange hover:bg-brand-orange/5 cursor-pointer transition-colors" data-type="genre" data-value="Any">Any</div>
                                    @php
                                        $genres = collect($genre)->map(fn($item) => $item->genre)->unique()->sort();
                                    @endphp
                                    @foreach($genres as $g)
                                        <div class="filter-option px-6 py-2 text-xs font-sans uppercase tracking-widest text-brand-navy/60 hover:text-brand-orange hover:bg-brand-orange/5 cursor-pointer transition-colors" data-type="genre" data-value="{{ $g }}">{{ $g }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- The Grid -->
            <style>
                :root {
                    --cg: 16px;
                }

                @media (max-width: 768px) {
                    :root {
                        --cg: 8px;
                    }
                }
            </style>

            <div id="catalogue-grid" class="w-full grid grid-cols-4 px-4 md:px-8" style="gap: var(--cg); grid-auto-rows: clamp(250px, 30vw, 600px);">
                @foreach($genre as $item)
                    <a href="{{ route('detail-film', $item->slug) }}"
                        class="film-card-trigger relative group cursor-none hover-target overflow-hidden rounded-2xl bg-brand-navy transition-all duration-500"
                        data-year="{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}"
                        data-genre="{{ $item->genre }}"
                        style="display: block;">
                                
                                {{-- Background Image with subtle zoom --}}
                                <img src="{{ asset('photo/' . $item->photo) }}"
                                    class="film-card-img w-full h-full object-cover opacity-80 group-hover:opacity-60 transition-all duration-1000 ease-expo scale-100 group-hover:scale-105"
                                    alt="@i18n($item, 'title')">

                                {{-- "UPCOMING" Label --}}
                                @if(\Carbon\Carbon::parse($item->release_date)->isFuture())
                                    <div class="absolute top-6 left-6 z-20">
                                        <span class="font-peckham text-brand-orange text-lg md:text-2xl tracking-wider">UPCOMING</span>
                                    </div>
                                @endif

                                {{-- Metadata Overlay - Right Side --}}
                                <div class="absolute top-0 right-0 bottom-0 w-1/3 flex flex-col justify-center p-6 text-right z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    <div class="flex flex-col gap-4">
                                        <div class="flex flex-col">
                                            <span class="text-[7px] uppercase tracking-tighter text-white/40">Release Date</span>
                                            <span class="text-[9px] uppercase text-white tracking-wide font-sans">
                                                {{ \Carbon\Carbon::parse($item->release_date)->isFuture() ? 'xx Sep 2025' : \Carbon\Carbon::parse($item->release_date)->format('d M Y') }}
                                            </span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[7px] uppercase tracking-tighter text-white/40">Directed By</span>
                                            <span class="text-[9px] uppercase text-white tracking-wide font-sans">{{ $item->director ?: 'N/A' }}</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[7px] uppercase tracking-tighter text-white/40">Written By</span>
                                            <span class="text-[9px] uppercase text-white tracking-wide font-sans">{{ $item->writer ?: 'N/A' }}</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[7px] uppercase tracking-tighter text-white/40">Starring</span>
                                            <span class="text-[8px] uppercase text-white leading-tight font-sans">
                                                @php
                                                    $casts = array_filter(explode(',', $item->cast));
                                                    $displayCasts = array_slice($casts, 0, 2);
                                                @endphp
                                                {{ implode(', ', $displayCasts) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Title & Year - Bottom Left --}}
                                <div class="absolute bottom-8 left-8 z-20 pointer-events-none transition-transform duration-500 group-hover:-translate-y-2">
                                    <span class="block font-sans text-[10px] md:text-xs text-white/60 mb-2 tracking-widest">{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}</span>
                                    <h4 class="font-peckham text-2xl md:text-4xl lg:text-5xl leading-[0.85] text-white uppercase max-w-[80%]">
                                        @i18n($item, 'title')
                                    </h4>
                                </div>

                                {{-- Dark Gradient Overlay --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-100 group-hover:opacity-0 transition-opacity duration-500"></div>
                            </a>
                @endforeach
            </div>
        </section>

    </div> {{-- End Editorial Wrapper --}}

    {{-- ============================================================
    TRAILER MODAL
    ============================================================ --}}
    <div id="hero-trailer-modal"
        class="fixed inset-0 z-[20000] bg-black opacity-0 pointer-events-none transition-opacity duration-500 flex items-center justify-center p-4 md:p-16">
        <button onclick="closeHeroTrailer()"
            class="absolute top-8 right-8 text-white text-4xl hover:text-brand-orange transition-colors z-[20010]">&times;</button>
        <div class="w-full max-w-6xl aspect-video bg-black relative shadow-2xl overflow-hidden">
            <iframe id="hero-trailer-iframe" src="" class="absolute inset-0 w-full h-full border-0"
                allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>

    @include('components.footer')

@endsection

{{-- ============================================================
STYLES & SCRIPTS
============================================================ --}}
@push('head')
    <style>
        /* UTILITIES SPESIFIK HALAMAN FILM */
        .bg-tint-3 {
            background-color: #FFF6F9;
        }

        .text-brand-deepbreath {
            color: #0f6ab0;
        }

        .text-brand-orange {
            color: #f46a21;
        }

        .bg-tint-2 {
            background-color: #CACAEF;
        }

        .hairline-border {
            border-color: rgba(37, 34, 94, 0.15);
        }

        /* ── CINEMATIC HERO IMAGE BOX ── */
        .hero-img-box {
            transition: width 800ms cubic-bezier(0.25, 1, 0.5, 1), right 800ms cubic-bezier(0.25, 1, 0.5, 1);
            right: 0;
        }

        .hero-slide.cinematic .hero-img-box {
            width: var(--cinematic-width, 100vw) !important;
            max-width: none !important;
            right: var(--right-offset, -4rem) !important;
        }

        /* Image: grayscale default, color on cinematic */
        .hero-img-box .slide-image {
            transition:
                filter 750ms cubic-bezier(0.25, 1, 0.5, 1),
                transform 750ms cubic-bezier(0.25, 1, 0.5, 1);
        }

        .hero-slide.cinematic .hero-img-box .slide-image {
            transform: scale(1.04);
        }

        /* Overlay gradient: hidden default, shows on cinematic */
        .hero-img-box .cinematic-overlay {
            transition: opacity 600ms ease;
        }

        .hero-slide.cinematic .hero-img-box .cinematic-overlay {
            opacity: 1;
        }

        /* Play button: hidden default, shows on cinematic */
        .hero-img-box .play-btn-hero {
            transition: opacity 500ms ease 200ms;
        }

        .hero-slide.cinematic .hero-img-box .play-btn-hero {
            opacity: 1;
        }

        .play-btn-circle {
            transition: transform 250ms ease, background-color 250ms ease;
        }

        .play-btn-hero:hover .play-btn-circle {
            transform: scale(1.1);
            background-color: rgba(255, 255, 255, 0.9);
            color: #0f6ab0;
        }

        /* Text: transitions for cinematic state */
        .hero-slide-text {
            transition: transform 700ms cubic-bezier(0.25, 1, 0.5, 1);
        }

        .hero-slide.cinematic .hero-slide-text {
            transform: translateX(1rem);
        }

        .hero-slide.cinematic .slide-title {
            color: #fff;
            text-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
        }

        .hero-slide.cinematic .slide-desc {
            color: rgba(255, 255, 255, 0.8);
        }

        .slide-title {
            transition: color 700ms ease, text-shadow 700ms ease;
        }

        .slide-desc {
            transition: color 700ms ease;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Pastikan GSAP terdaftar
            gsap.registerPlugin(ScrollTrigger);

            /* ─── 1. EDITORIAL HERO SLIDESHOW LOGIC ─── */
            // Hero Background Logic
            const bgImages = document.querySelectorAll('.hero-bg-image');
            const navItems = document.querySelectorAll('.film-nav-item');

            navItems.forEach(item => {
                item.addEventListener('mouseenter', () => {
                    const index = item.getAttribute('data-index');

                    // Update Active Image
                    bgImages.forEach((img, i) => {
                        img.classList.toggle('opacity-100', i == index);
                        img.classList.toggle('opacity-0', i != index);
                    });

                    // Update Active Text Styling
                    navItems.forEach((nav, i) => {
                        const h2 = nav.querySelector('h2');
                        if (i == index) {
                            h2.classList.remove('text-white/40');
                            h2.classList.add('text-white');
                        } else {
                            h2.classList.remove('text-white');
                            h2.classList.add('text-white/40');
                        }
                    });
                });
            });

            // Remove legacy hero code
            // [Old code for sliders, indicators, etc is gone from DOM above]

            /* ─── 2. ALIGN METADATA TO END OF FIRST LINE ─── */
            function alignFilmMeta() {
                document.querySelectorAll('.film-nav-item').forEach(item => {
                    const titleContainer = item.querySelector('.film-title');
                    const titleText = item.querySelector('.title-text');
                    const meta = item.querySelector('.film-meta');
                    
                    if (!titleContainer || !titleText || !meta) return;

                    const rects = titleText.getClientRects();
                    if (!rects.length) return;

                    const firstRect = rects[0];
                    const containerRect = titleContainer.getBoundingClientRect();

                    const leftOffset = firstRect.right - containerRect.left;
                    meta.style.left = leftOffset + 'px';
                });
            }

            alignFilmMeta();
            if (document.fonts) {
                document.fonts.ready.then(alignFilmMeta);
            }
            window.addEventListener('resize', alignFilmMeta);

            /* ─── 3. INITIAL SCROLL REVEAL UNTUK KARTU FILM ─── */
            if (document.querySelector('.film-row-container')) {
                gsap.from('.film-row-container > div', {
                    scrollTrigger: {
                        trigger: '.film-row-container',
                        start: "top 85%",
                    },
                    y: 100,
                    opacity: 0,
                    duration: 1.2,
                    stagger: 0.15,
                    ease: "power3.out"
                });
            }
            /* ─── 4. HERO TRAILER MODAL LOGIC ─── */
            window.openHeroTrailer = function (videoId) {
                const modal = document.getElementById('hero-trailer-modal');
                const iframe = document.getElementById('hero-trailer-iframe');
                if (modal && iframe) {
                    iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
                    modal.classList.remove('opacity-0', 'pointer-events-none');
                    modal.classList.add('opacity-100', 'pointer-events-auto');
                    document.body.style.overflow = 'hidden';
                }
            };

            window.closeHeroTrailer = function () {
                const modal = document.getElementById('hero-trailer-modal');
                const iframe = document.getElementById('hero-trailer-iframe');
                if (modal && iframe) {
                    iframe.src = '';
                    modal.classList.add('opacity-0', 'pointer-events-none');
                    modal.classList.remove('opacity-100', 'pointer-events-auto');
                    document.body.style.overflow = '';
                }
            };

            // Close on Escape
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeHeroTrailer();
            });

            /* ─── 5. CATALOGUE FILTER LOGIC ─── */
            const yearTrigger = document.getElementById('filter-year-trigger');
            const genreTrigger = document.getElementById('filter-genre-trigger');
            const yearMenu = document.getElementById('filter-year-menu');
            const genreMenu = document.getElementById('filter-genre-menu');

            function toggleMenu(menu, otherMenu) {
                menu.classList.toggle('opacity-0');
                menu.classList.toggle('translate-y-2');
                menu.classList.toggle('pointer-events-none');
                
                // Close other menu
                if (otherMenu) {
                    otherMenu.classList.add('opacity-0', 'translate-y-2', 'pointer-events-none');
                }
            }

            if (yearTrigger && genreTrigger) {
                yearTrigger.addEventListener('click', (e) => {
                    e.stopPropagation();
                    toggleMenu(yearMenu, genreMenu);
                });

                genreTrigger.addEventListener('click', (e) => {
                    e.stopPropagation();
                    toggleMenu(genreMenu, yearMenu);
                });
            }

            // Handle Selection
            document.querySelectorAll('.filter-option').forEach(option => {
                option.addEventListener('click', () => {
                    const type = option.getAttribute('data-type');
                    const value = option.getAttribute('data-value');
                    
                    if (type === 'year') {
                        document.getElementById('selected-year').textContent = value;
                        yearMenu.classList.add('opacity-0', 'translate-y-2', 'pointer-events-none');
                    } else {
                        document.getElementById('selected-genre').textContent = value;
                        genreMenu.classList.add('opacity-0', 'translate-y-2', 'pointer-events-none');
                    }

                    applyFilters();
                });
            });

            function applyFilters() {
                const selectedYear = document.getElementById('selected-year').textContent;
                const selectedGenre = document.getElementById('selected-genre').textContent;
                
                const allCards = document.querySelectorAll('.film-card-trigger');
                const visibleCards = [];
                
                allCards.forEach(card => {
                    const itemYear = card.getAttribute('data-year');
                    const itemGenre = card.getAttribute('data-genre');
                    
                    let matchYear = (selectedYear === 'Any' || itemYear === selectedYear);
                    let matchGenre = (selectedGenre === 'Any' || itemGenre === selectedGenre);
                    
                    if (matchYear && matchGenre) {
                        card.style.display = 'block';
                        visibleCards.push(card);
                    } else {
                        card.style.display = 'none';
                    }
                });

                let N = visibleCards.length;
                let layoutClasses = [];
                let remaining = N;
                
                while (remaining > 0) {
                    if (remaining >= 5) {
                        // Pola dasar: 2 film (1-1) lalu 3 film (0.5-1-0.5)
                        layoutClasses.push('col-span-2', 'col-span-2', 'col-span-1', 'col-span-2', 'col-span-1');
                        remaining -= 5;
                    } else if (remaining === 4) {
                        // Sisa 4: 2 film lalu 2 film
                        layoutClasses.push('col-span-2', 'col-span-2', 'col-span-2', 'col-span-2');
                        remaining = 0;
                    } else if (remaining === 3) {
                        // Sisa 3: 1 baris berisi 3 film
                        layoutClasses.push('col-span-1', 'col-span-2', 'col-span-1');
                        remaining = 0;
                    } else if (remaining === 2) {
                        // Sisa 2: 1 baris berisi 2 film
                        layoutClasses.push('col-span-2', 'col-span-2');
                        remaining = 0;
                    } else if (remaining === 1) {
                        // Sisa 1: di tengah dengan ukuran 1
                        layoutClasses.push('col-span-2 col-start-2');
                        remaining = 0;
                    }
                }

                visibleCards.forEach((card, index) => {
                    // Reset class grid sebelumnya
                    card.classList.remove('col-span-1', 'col-span-2', 'col-span-3', 'col-start-2');
                    
                    // Assign class sesuai urutan logika layout
                    const classToApply = layoutClasses[index];
                    if (classToApply) {
                        card.classList.add(...classToApply.split(' '));
                    }
                });
            }

            // Init filters on load
            applyFilters();

            // ─── INTERACTIVE BG ──────────────────────────────
            (function() {
                let mouseX = window.innerWidth / 2;
                let mouseY = window.innerHeight / 2;
                let bgX = mouseX;
                let bgY = mouseY;

                document.addEventListener('mousemove', (e) => {
                    mouseX = e.clientX;
                    mouseY = e.clientY;
                });

                gsap.ticker.add(() => {
                    // Background gradient interpolation
                    bgX += (mouseX - bgX) * 0.05;
                    bgY += (mouseY - bgY) * 0.05;
                    document.body.style.setProperty('--mx', (bgX / window.innerWidth * 100) + '%');
                    document.body.style.setProperty('--my', (bgY / window.innerHeight * 100) + '%');
                });
            })();

            // Close on outside click
            document.addEventListener('click', () => {
                [yearMenu, genreMenu].forEach(m => {
                    if (m) m.classList.add('opacity-0', 'translate-y-2', 'pointer-events-none');
                });
            });
        });
    </script>


@endpush