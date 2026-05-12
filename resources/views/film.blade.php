@extends('layouts.app')

@section('title', 'Our Films | Sinemaku Pictures')

@section('content')

    @include('partials.navbar')

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

            <!-- Header -->
            <div class="px-8 md:px-16 border-b hairline-border pb-12 mb-16 max-w-[1800px] mx-auto">
                <h2 class="font-instrument italic text-5xl md:text-7xl text-brand-navy leading-none tracking-tight">
                    Our <span class="font-peckham not-italic text-brand-orange uppercase ml-2">Film</span> Catalogue.
                </h2>
            </div>

            <!-- The Grid (Alternating Rows 2-3) -->
            @php
                $rows = [];
                $offset = 0;
                $rowNum = 0;
                $items = $genre->all(); // Assuming $genre is the collection of films
                while ($offset < count($items)) {
                    $take = ($rowNum % 2 === 0) ? 2 : 3;
                    $chunk = array_slice($items, $offset, $take);
                    if (!empty($chunk))
                        $rows[] = ['type' => $rowNum % 2, 'items' => $chunk];
                    $offset += $take;
                    $rowNum++;
                }
            @endphp

            <style>
                :root {
                    --cg: 16px;
                }

                .film-row-container {
                    --fw: calc((100vw - (4 * var(--cg))) / 2);
                    --hw: calc(var(--fw) / 2);
                }

                .film-img-full {
                    width: var(--fw);
                    flex-shrink: 0;
                }

                .film-img-half {
                    width: var(--hw);
                    flex-shrink: 0;
                }

                @media (max-width: 768px) {
                    :root {
                        --cg: 8px;
                    }
                }
            </style>

            <div class="w-full overflow-hidden flex flex-col film-row-container" style="gap: var(--cg);">
                @foreach($rows as $row)
                    <div class="flex w-full justify-center" style="height: clamp(180px, 22vw, 450px); gap: var(--cg);">
                        @foreach($row['items'] as $i => $item)
                            @php
                                $isMiddle = ($row['type'] === 1 && $i === 1);
                                $isHalf = ($row['type'] === 1 && ($i === 0 || $i === 2));
                                $widthClass = $isHalf ? 'film-img-half' : 'film-img-full';
                            @endphp
                            <a href="{{ route('detail-film', $item->slug) }}"
                                class="film-card-trigger relative group cursor-none hover-target overflow-hidden rounded-xl {{ $widthClass }}"
                                data-slug="{{ $item->slug }}" data-photo="{{ asset('photo/' . $item->photo) }}"
                                data-title="{{ $item->title }}" data-url="{{ route('detail-film', $item->slug) }}">
                                <img src="{{ asset('photo/' . $item->photo) }}"
                                    class="film-card-img w-full h-full object-cover transition-all duration-1000 ease-expo"
                                    alt="@i18n($item, 'title')">

                                {{-- Title Overlay (Always Visible on Bottom Left for Full images) --}}
                                @if(!$isHalf)
                                    <div
                                        class="absolute bottom-6 left-8 z-20 pointer-events-none text-brand-orange group-hover:opacity-0 transition-opacity duration-300">
                                        <h4 class="font-serif text-3xl md:text-5xl leading-none drop-shadow-md">@i18n($item, 'title')
                                        </h4>
                                    </div>
                                @endif

                                {{-- A24-Style Hover Details Overlay --}}
                                <div
                                    class="absolute inset-0 bg-brand-deepbreath/95 flex flex-col justify-between p-6 md:p-10 opacity-0 group-hover:opacity-100 transition-all duration-500 backdrop-blur-sm">
                                    <div class="overflow-hidden">
                                        <span
                                            class="block font-sans text-[9px] md:text-[10px] tracking-[0.3em] uppercase text-brand-orange transform -translate-y-full group-hover:translate-y-0 transition-transform duration-500 delay-100">
                                            @i18n($item, 'genre')
                                        </span>
                                    </div>
                                    <div class="flex-grow flex items-center">
                                        <h3 class="font-serif text-2xl md:text-5xl text-white leading-tight">
                                            <span class="italic block group-hover:text-brand-orange transition-colors">@i18n($item,
                                                'title')</span>
                                        </h3>
                                    </div>
                                    <div class="border-t border-white/10 pt-4 md:pt-6 flex justify-between items-end">
                                        <div class="flex flex-col gap-1">
                                            <span
                                                class="font-sans text-[8px] md:text-[9px] tracking-widest uppercase text-white/40">Year</span>
                                            <span
                                                class="font-sans text-xs md:text-sm text-white">{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}</span>
                                        </div>
                                        <div class="flex flex-col gap-1 text-right">
                                            <span
                                                class="font-sans text-[8px] md:text-[9px] tracking-widest uppercase text-white/40">Duration</span>
                                            <span class="font-sans text-xs md:text-sm text-white">{{ $item->duration }} Min.</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
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
            background-color: #F1F1F1;
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
        });
    </script>


@endpush