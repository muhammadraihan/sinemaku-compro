@extends('layouts.app')

@section('title', 'Documentaries | Sinemaku Pictures')

@section('content')

    @include('partials.navbar')

    <style>

    </style>



    {{-- ============================================================
    EDITORIAL WRAPPER
    Menjaga gaya kanvas terang (Tint 3) khusus untuk halaman ini
    ============================================================ --}}
    <div id="editorial-wrapper" class="text-brand-deepbreath relative w-full font-sans">

        {{-- ============================================================
        1. EDITORIAL HERO SLIDESHOW
        ============================================================ --}}
        <section class="relative w-full h-[100svh] overflow-hidden z-20">
            <!-- Background Images Container -->
            <div id="hero-bg-container" class="absolute inset-0 z-0">
                @foreach(collect($documentary)->take(3) as $i => $item)
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
                        @foreach(collect($documentary)->take(3) as $i => $item)
                            <div class="film-nav-item group cursor-none hover-target" data-index="{{ $i }}">
                                <a href="{{ route('detail-documentary', $item->slug) }}" class="block">
                                    <div class="relative" style="max-width: min(35vw, 80vw);">
                                        <h2 class="film-title font-peckham font-bold text-3xl md:text-4xl lg:text-5xl uppercase leading-[0.95] transition-all duration-300 {{ $i === 0 ? 'text-white' : 'text-white/40' }}">
                                            <span class="title-text">@i18n($item, 'title')</span>
                                        </h2>
                                        <div class="film-meta absolute top-0 flex flex-col gap-0.5 pl-3 pt-2 whitespace-nowrap pointer-events-none" style="left: 0; opacity: 1;">
                                            @if(\Carbon\Carbon::parse($item->release_date)->isFuture())
                                                <span class="font-sans text-[8px] md:text-[10px] tracking-widest uppercase text-brand-orange leading-none">Upcoming</span>
                                            @endif
                                            <span class="film-meta-text font-sans font-bold text-[11px] md:text-[12px] tracking-widest uppercase leading-none transition-all duration-300 {{ $i === 0 ? 'text-white' : 'text-white/40' }}">{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }} | @i18n($item, 'genre')</span>
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
        <section class="py-32 z-10 relative max-w-[100vw] bg-creme-leaks">

            <!-- Header & Filter -->
            <div class="px-8 md:px-16 flex flex-col items-center mb-16 max-w-[1800px] mx-auto text-center">
                <h2 class="font-instrument italic text-4xl md:text-6xl text-brand-navy leading-none tracking-tight mb-12">
                    Our <span class="font-peckham not-italic text-brand-orange uppercase mx-1">Documentary</span> Catalogue
                </h2>

                <!-- Dual Filter Dropdown -->
                <div class="inline-flex items-center border border-brand-orange/30 rounded-full bg-brand-orange/5 p-1 relative z-50">
                    <div class="flex items-center">
                        <!-- Year Dropdown -->
                        <div class="relative group/filter">
                            <div id="filter-year-trigger" class="px-6 py-2 flex flex-col items-center border-r border-brand-orange/20 cursor-pointer hover:bg-brand-orange/10 transition-colors rounded-l-full">
                                <span class="text-[9px] uppercase tracking-widest text-brand-navy/40 leading-none mb-1">Release Year</span>
                                <span id="selected-year" class="text-sm font-sans text-brand-navy font-bold leading-none">Any</span>
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
                                <span id="selected-genre" class="text-sm font-sans text-brand-navy font-bold leading-none">Any</span>
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

            <div id="catalogue-grid" class="w-full grid grid-cols-2 md:grid-cols-4 px-4 md:px-8" style="gap: var(--cg); grid-auto-rows: clamp(250px, 30vw, 600px);">
                @foreach($genre as $item)
                    <a href="{{ route('detail-documentary', $item->slug) }}"
                        class="catalogue-card relative group cursor-none hover-target overflow-hidden rounded-2xl bg-brand-navy transition-all duration-500"
                        data-year="{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}"
                        data-genre="{{ $item->genre }}"
                        data-trailer="{{ $item->link }}"
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

                                {{-- Metadata Overlay - Right Side (hover only) --}}
                                <div class="card-meta-container absolute top-0 right-0 bottom-0 w-1/3 flex flex-col p-6 text-right z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    <div class="flex flex-col gap-4">
                                        <div class="flex flex-col">
                                            <span class="meta-label uppercase tracking-tighter text-white/40">Release Date</span>
                                            <span class="meta-value uppercase text-white tracking-wide font-sans">
                                                {{ \Carbon\Carbon::parse($item->release_date)->isFuture() ? 'xx Sep 2025' : \Carbon\Carbon::parse($item->release_date)->format('d M Y') }}
                                            </span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="meta-label uppercase tracking-tighter text-white/40">Directed By</span>
                                            <span class="meta-value uppercase text-white tracking-wide font-sans">{{ $item->director ?: 'N/A' }}</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="meta-label uppercase tracking-tighter text-white/40">Written By</span>
                                            <span class="meta-value uppercase text-white tracking-wide font-sans">{{ $item->writer ?: 'N/A' }}</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="meta-label uppercase tracking-tighter text-white/40">Starring</span>
                                            <span class="meta-value uppercase text-white leading-tight font-sans">
                                                @php
                                                    $casts = array_filter(explode(',', $item->cast));
                                                    $displayCasts = array_slice($casts, 0, 2);
                                                @endphp
                                                {{ implode(', ', $displayCasts) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Title & Year --}}
                                {{-- .is-wide   → judul besar (kiri bawah) --}}
                                {{-- .is-narrow  → judul compact (kiri atas) --}}
                                <div class="card-title-block absolute z-20 pointer-events-auto select-none transition-transform duration-500 group-hover:-translate-y-2">
                                    <span class="block font-sans text-[10px] md:text-xs text-white/60 mb-2 tracking-widest">{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}</span>
                                    <h4 class="card-title font-peckham leading-[0.85] text-white uppercase">
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

        /* ── WIDE vs NARROW card title & metadata sizing ── */
        /* Judul */
        .catalogue-card.is-wide .card-title {
            font-size: clamp(1.4rem, 4vw, 4.5rem);
            max-width: 60%;
            word-break: keep-all;
            overflow-wrap: normal;
        }
        .catalogue-card.is-narrow .card-title {
            font-size: clamp(0.75rem, 2.2vw, 2.2rem);
            max-width: 100%;
            word-break: keep-all;
            overflow-wrap: normal;
        }
        .catalogue-card .card-title {
            font-size: clamp(0.85rem, 2.8vw, 2.6rem);
            max-width: 60%;
            word-break: keep-all;
            overflow-wrap: normal;
        }

        /* Judul Posisi */
        /* Wide: judul bawah-kiri, meta kanan → batasi lebar agar tidak bertabrakan */
        .catalogue-card .card-title-block {
            bottom: 2rem;
            left: 2rem;
            right: auto;
            /* Max width = 100% - meta width (33%) - padding kanan meta (1.25rem) - gap (0.5rem) */
            max-width: calc(60% - 1rem);
        }
        /* Narrow: judul atas-kiri, meta bawah-kanan → batasi tinggi agar tidak bertabrakan */
        .catalogue-card.is-narrow .card-title-block {
            top: 1.5rem;
            bottom: auto;
            left: 1.25rem;
            right: 1.25rem;
            max-width: 100%;
            /* Batasi tinggi maksimum agar tidak melampaui area meta di bawah */
            max-height: 45%;
            overflow: hidden;
        }

        /* Metadata (Overlay Kanan) */
        /* Wide: meta panel di kanan, lebar max 38% agar tidak makan area judul di kiri */
        .catalogue-card .card-meta-container {
            justify-content: flex-end;
            width: 38% !important;
            padding: 1.25rem !important;
            max-height: calc(100% - 1.5rem);
            overflow: hidden;
        }
        /* Narrow: meta di bawah, lebar lebih besar karena posisi berbeda */
        .catalogue-card.is-narrow .card-meta-container {
            top: auto !important;
            bottom: 0 !important;
            width: 85% !important;
            max-height: 58%;
        }
        .catalogue-card .card-meta-container .flex-col.gap-4 {
            gap: 0.5rem !important;
        }
        .catalogue-card .meta-label {
            font-size: 8px !important;
        }
        /* Nilai meta: bisa turun baris agar tidak overflow ke area judul */
        .catalogue-card .meta-value {
            font-size: 11px !important;
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        /* Desktop only (≥1280px): perbesar sedikit agar lebih terbaca */
        @media (min-width: 1280px) {
            .catalogue-card .meta-label {
                font-size: clamp(9px, 0.9vw, 11px) !important;
            }
            .catalogue-card .meta-value {
                font-size: clamp(12px, 1.1vw, 14px) !important;
            }
        }

        @media (max-width: 767px) {
            .catalogue-card .card-meta-container {
                padding: 0.75rem !important;
                padding-bottom: 1.25rem !important;
            }
            .catalogue-card .card-meta-container .flex-col.gap-4 {
                gap: 0.3rem !important;
            }
            .catalogue-card .meta-label {
                font-size: 7.5px !important;
                line-height: 1.1 !important;
            }
            .catalogue-card .meta-value {
                font-size: 10px !important;
                line-height: 1.2 !important;
                word-break: break-word;
                overflow-wrap: break-word;
            }
        }

        /* Mirror hover state when trailer is playing (for touch/drag) */
        .catalogue-card.trailer-active .card-meta-container {
            opacity: 1 !important;
        }
        .catalogue-card.trailer-active .card-title-block {
            transform: translateY(-0.5rem);
        }
        .catalogue-card.trailer-active .film-card-img {
            opacity: 0.6;
            transform: scale(1.05);
        }
        .catalogue-card.trailer-active > div[class*="bg-gradient-to-t"] {
            opacity: 0 !important;
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
                        const meta = nav.querySelector('.film-meta-text');
                        if (i == index) {
                            h2.classList.remove('text-white/40');
                            h2.classList.add('text-white');
                            if (meta) {
                                meta.classList.remove('text-white/40');
                                meta.classList.add('text-white');
                            }
                        } else {
                            h2.classList.remove('text-white');
                            h2.classList.add('text-white/40');
                            if (meta) {
                                meta.classList.remove('text-white');
                                meta.classList.add('text-white/40');
                            }
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
            window.addEventListener('resize', () => {
                alignFilmMeta();
                applyFilters();
            });

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

                const allCards = document.querySelectorAll('.catalogue-card');
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

                let isMobileLayout = window.innerWidth <= 768;

                if (isMobileLayout) {
                    let isRowOfTwo = true;
                    while (remaining > 0) {
                        if (isRowOfTwo) {
                            if (remaining >= 2) {
                                layoutClasses.push('col-span-1', 'col-span-1');
                                remaining -= 2;
                            } else {
                                layoutClasses.push('col-span-2');
                                remaining = 0;
                            }
                            isRowOfTwo = false;
                        } else {
                            layoutClasses.push('col-span-2');
                            remaining -= 1;
                            isRowOfTwo = true;
                        }
                    }
                } else {
                    let isRowOfThree = true;
                    let threeRowAlternate = false;

                    while (remaining > 0) {
                        if (isRowOfThree) {
                            if (remaining >= 3) {
                                if (!threeRowAlternate) {
                                    layoutClasses.push('col-span-2', 'col-span-1', 'col-span-1');
                                } else {
                                    layoutClasses.push('col-span-1', 'col-span-1', 'col-span-2');
                                }
                                threeRowAlternate = !threeRowAlternate;
                                remaining -= 3;
                            } else {
                                if (!threeRowAlternate) {
                                    if (remaining === 2) {
                                        layoutClasses.push('col-span-2', 'col-span-1');
                                    } else if (remaining === 1) {
                                        layoutClasses.push('col-span-2');
                                    }
                                } else {
                                    if (remaining === 2) {
                                        layoutClasses.push('col-span-1', 'col-span-1');
                                    } else if (remaining === 1) {
                                        layoutClasses.push('col-span-1');
                                    }
                                }
                                remaining = 0;
                            }
                            isRowOfThree = false;
                        } else {
                            if (remaining >= 2) {
                                layoutClasses.push('col-span-2', 'col-span-2');
                                remaining -= 2;
                            } else {
                                if (remaining === 1) {
                                    layoutClasses.push('col-span-2');
                                }
                                remaining = 0;
                            }
                            isRowOfThree = true;
                        }
                    }
                }

                visibleCards.forEach((card, index) => {
                    // Reset class grid sebelumnya
                    card.classList.remove('col-span-1', 'col-span-2', 'col-span-3', 'col-start-2', 'is-wide', 'is-narrow');

                    // Assign class sesuai urutan logika layout
                    const classToApply = layoutClasses[index];
                    if (classToApply) {
                        card.classList.add(...classToApply.split(' '));
                    }

                    // Toggle is-wide / is-narrow agar CSS bisa menyesuaikan ukuran judul
                    const isWide = classToApply && classToApply.includes('col-span-2');
                    card.classList.add(isWide ? 'is-wide' : 'is-narrow');
                });
            }

            // Init filters on load
            applyFilters();



            // Close on outside click
            document.addEventListener('click', () => {
                [yearMenu, genreMenu].forEach(m => {
                    if (m) m.classList.add('opacity-0', 'translate-y-2', 'pointer-events-none');
                });
            });

            /* ─── 6. AUTO PLAY YOUTUBE TRAILER ON HOVER ─── */
            function getYouTubeId(url) {
                if(!url) return null;
                const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                const match = url.match(regExp);
                return (match && match[2].length === 11) ? match[2] : null;
            }

            document.querySelectorAll('.catalogue-card').forEach(card => {
                let iframeContainer = null;
                let timeoutId = null;
                let isTrailerPlaying = false;

                function startTrailer() {
                    if (isTrailerPlaying) return;
                    const trailerUrl = card.getAttribute('data-trailer');
                    const videoId = getYouTubeId(trailerUrl);
                    if (videoId) {
                        // Stop all other playing trailers first
                        document.querySelectorAll('.catalogue-card').forEach(otherCard => {
                            if (otherCard !== card && otherCard.stopTrailer) {
                                otherCard.stopTrailer();
                            }
                        });

                        iframeContainer = document.createElement('div');
                        iframeContainer.className = 'absolute inset-0 w-full h-full overflow-hidden pointer-events-none z-[5] opacity-0 transition-opacity duration-700 bg-brand-navy';

                        const rect = card.getBoundingClientRect();
                        let iframeW = rect.width;
                        let iframeH = iframeW * (9/16);
                        if (iframeH < rect.height) {
                            iframeH = rect.height;
                            iframeW = iframeH * (16/9);
                        }

                        const finalW = iframeW * 1.6;
                        const finalH = iframeH * 1.6;

                        const iframe = document.createElement('iframe');
                        iframe.className = 'absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none opacity-60 max-w-none';
                        iframe.style.width = finalW + 'px';
                        iframe.style.height = finalH + 'px';
                        iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1&controls=0&rel=0&loop=1&playlist=${videoId}&playsinline=1&modestbranding=1&disablekb=1`;
                        iframe.allow = 'autoplay; encrypted-media';
                        iframe.frameBorder = '0';

                        iframeContainer.appendChild(iframe);

                        const img = card.querySelector('.film-card-img');
                        if(img) {
                            img.parentNode.insertBefore(iframeContainer, img.nextSibling);
                        }

                        iframe.onload = () => {
                            iframeContainer.classList.remove('opacity-0');
                            iframeContainer.classList.add('opacity-100');
                        };
                        isTrailerPlaying = true;
                        card.classList.add('trailer-active');
                    }
                }

                function stopTrailer() {
                    if (timeoutId) clearTimeout(timeoutId);
                    if (iframeContainer) {
                        iframeContainer.classList.remove('opacity-100');
                        iframeContainer.classList.add('opacity-0');
                        const currentContainer = iframeContainer;
                        setTimeout(() => {
                            if (currentContainer && currentContainer.parentNode) {
                                currentContainer.parentNode.removeChild(currentContainer);
                            }
                        }, 700);
                        iframeContainer = null;
                    }
                    isTrailerPlaying = false;
                    card.classList.remove('trailer-active');
                }

                // Expose stop function to stop from other cards
                card.stopTrailer = stopTrailer;

                // Desktop Hover
                card.addEventListener('mouseenter', () => {
                    if (window.matchMedia('(hover: hover)').matches) {
                        timeoutId = setTimeout(startTrailer, 400);
                    }
                });

                card.addEventListener('mouseleave', () => {
                    if (window.matchMedia('(hover: hover)').matches) {
                        stopTrailer();
                    }
                });

                // Mobile Touch Support
                let touchStartX = 0;
                let touchStartY = 0;
                let touchMoved = false;
                let lastTouchTime = 0;
                let touchTimeoutId = null;
                let wasPlayingBeforeTouch = false;

                card.addEventListener('touchstart', (e) => {
                    lastTouchTime = Date.now();
                    wasPlayingBeforeTouch = isTrailerPlaying;

                    const touch = e.touches[0];
                    touchStartX = touch.clientX;
                    touchStartY = touch.clientY;
                    touchMoved = false;

                    // Trigger the trailer after a short 150ms touch hold (even if scrolling/dragging)
                    if (touchTimeoutId) clearTimeout(touchTimeoutId);
                    touchTimeoutId = setTimeout(() => {
                        startTrailer();
                    }, 150);
                }, { passive: true });

                card.addEventListener('touchmove', (e) => {
                    const touch = e.touches[0];
                    if (Math.abs(touch.clientX - touchStartX) > 10 || Math.abs(touch.clientY - touchStartY) > 10) {
                        touchMoved = true;
                    }
                }, { passive: true });

                card.addEventListener('touchend', () => {
                    // Prevent trailer play if it was a very quick swipe/flick (less than 150ms)
                    if (Date.now() - lastTouchTime < 150) {
                        if (touchTimeoutId) {
                            clearTimeout(touchTimeoutId);
                            touchTimeoutId = null;
                        }
                    }
                }, { passive: true });

                card.addEventListener('touchcancel', () => {
                    if (touchTimeoutId) {
                        clearTimeout(touchTimeoutId);
                        touchTimeoutId = null;
                    }
                }, { passive: true });

                card.addEventListener('click', (e) => {
                    const isTouchClick = (Date.now() - lastTouchTime < 1000) || (e.pointerType === 'touch');

                    if (isTouchClick) {
                        if (touchTimeoutId) {
                            clearTimeout(touchTimeoutId);
                            touchTimeoutId = null;
                        }

                        if (touchMoved) return; // Scrolling: do not navigate

                        if (e.target.closest('.card-title-block')) {
                            // Tapping title text always navigates immediately
                            return;
                        }

                        // Tapping the card background
                        if (wasPlayingBeforeTouch) {
                            // Already playing before this touch: navigate on second tap
                            return;
                        } else {
                            // First tap: prevent navigation and ensure trailer plays
                            e.preventDefault();
                            startTrailer();
                        }
                    }
                });
            });

        });
    </script>


@endpush
