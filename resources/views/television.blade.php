@extends('layouts.app')

@section('title', 'Television | Sinemaku Pictures')

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
        <section
            class="relative w-full h-[100svh] pt-28 md:pt-32 pb-12 px-8 md:px-16 flex flex-col justify-end z-10 max-w-[1800px] mx-auto">

            <!-- Slides Container -->
            <div id="hero-slider-container" class="absolute inset-0 px-8 md:px-16 pt-28 md:pt-32 pb-24 flex items-center">

                @foreach($film as $i => $item)
                    @php
                        $video_id = '';
                        if (!empty($item->link) && preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $item->link, $match)) {
                            $video_id = $match[1];
                        }
                    @endphp
                    <div
                        class="hero-slide absolute inset-0 px-8 md:px-16 pt-28 md:pt-32 pb-28 md:pb-32 flex flex-col-reverse md:flex-row items-end md:items-center justify-between w-full h-full {{ $i === 0 ? 'opacity-100 visible z-20 pointer-events-auto' : 'opacity-0 invisible z-10 pointer-events-none' }}">

                        <!-- Kiri: Teks -->
                        <div class="hero-slide-text w-full md:w-[45%] z-30 pb-4 md:pb-0 flex-shrink-0 relative">
                            <span class="block font-sans text-[10px] tracking-[0.3em] uppercase text-brand-orange slide-meta">
                                {{ \Carbon\Carbon::parse($item->release_date)->format('Y') }} • @i18n($item, 'genre')
                            </span>
                            <div class="overflow-hidden mt-4 pb-2">
                                <h1
                                    class="slide-title font-serif text-[10vw] md:text-[7vw] leading-[0.9] text-brand-deepbreath tracking-tighter">
                                    <a href="{{ route('detail-television', $item->slug) }}"
                                        class="hover-target cursor-none hover:text-brand-orange transition-colors duration-300">
                                        @i18n($item, 'title')
                                    </a>
                                </h1>
                            </div>
                            <p
                                class="slide-desc font-sans text-xs md:text-sm font-light leading-relaxed text-brand-deepbreath/60 mt-4 md:mt-8 max-w-sm opacity-0">
                                Durasi: {{ $item->duration }} Menit.
                            </p>
                        </div>

                        <!-- Kanan: Gambar Frame -->
                        <div
                            class="w-full md:w-[50%] flex-1 md:h-[80vh] min-h-[30vh] flex justify-end items-center relative mb-4 md:mb-0 z-10 cursor-none">

                            {{-- Gambar Container (Absolute terhadap flex container) --}}
                            <div
                                class="hero-img-box slide-image-container absolute right-0 h-full w-full md:w-[85%] overflow-hidden bg-tint-2/20 z-10">

                                {{-- Play Button --}}
                                @if($video_id)
                                    <button
                                        class="play-btn-hero absolute inset-0 z-20 flex items-center justify-center opacity-0 hover-target"
                                        data-video="{{ $video_id }}">
                                        <div
                                            class="play-btn-circle w-20 h-20 md:w-24 md:h-24 rounded-full border border-white/40 bg-white/10 backdrop-blur-md flex items-center justify-center text-white shadow-2xl">
                                            <span class="iconify w-8 h-8 md:w-10 md:h-10 ml-1" data-icon="lucide:play"
                                                data-inline="false"></span>
                                        </div>
                                    </button>
                                @endif

                                <img src="{{ asset('photo/' . $item->photo) }}"
                                    class="slide-image w-full h-full object-cover"
                                    alt="@i18n($item, 'title')">

                                <div
                                    class="cinematic-overlay absolute inset-0 bg-gradient-to-r from-brand-deepbreath/90 via-brand-deepbreath/40 to-transparent opacity-0 z-10 pointer-events-none">
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>

            <!-- Hero Navigation Controls -->
            <div class="relative z-30 flex justify-between items-center border-t hairline-border pt-6 mt-auto">

                <!-- Indicators Dinamis -->
                <div class="flex gap-2 md:gap-4 font-serif text-2xl md:text-3xl text-brand-deepbreath/40"
                    id="hero-indicators">
                    @foreach($film as $i => $item)
                        <button
                            class="slide-indicator hover-target cursor-none transition-colors {{ $i === 0 ? 'text-brand-deepbreath' : 'hover:text-brand-deepbreath' }}"
                            data-index="{{ $i }}">
                            {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                        </button>
                    @endforeach
                </div>

                <!-- Next / Prev -->
                <div
                    class="flex gap-3 md:gap-8 font-sans text-[9px] md:text-[10px] tracking-[0.2em] md:tracking-[0.3em] uppercase font-bold text-brand-deepbreath">
                    <button id="hero-prev"
                        class="hover-target cursor-none hover:text-brand-orange transition-colors whitespace-nowrap">[ Prev
                        ]</button>
                    <button id="hero-next"
                        class="hover-target cursor-none hover:text-brand-orange transition-colors whitespace-nowrap">[ Next
                        ]</button>
                </div>

            </div>
        </section>

        {{-- ============================================================
        2. ALL FILMS CATALOGUE (MASONRY GRID)
        ============================================================ --}}
        <section class="py-32 px-8 md:px-16 z-10 relative max-w-[1800px] mx-auto">

            <!-- Header -->
            <div class="px-0 border-b hairline-border pb-12 mb-16">
                <h2 class="font-serif text-6xl md:text-8xl text-brand-deepbreath leading-none tracking-tight">
                    <span data-i18n="page_tv_1">Katalog</span>
                    <span data-i18n="page_tv_2" class="italic text-brand-orange">TV.</span>
                </h2>
            </div>
            <!-- The Grid (Alternating Rows 2-3) -->
            @php
                $rows = [];
                $offset = 0;
                $rowNum = 0;
                $items = $genre->all(); 
                while ($offset < count($items)) {
                    $take = ($rowNum % 2 === 0) ? 2 : 3;
                    $chunk = array_slice($items, $offset, $take);
                    if (!empty($chunk)) $rows[] = ['type' => $rowNum % 2, 'items' => $chunk];
                    $offset += $take;
                    $rowNum++;
                }
            @endphp

            <style>
                :root { --cg: 16px; }
                .film-row-container {
                    --fw: calc((100vw - (4 * var(--cg))) / 2);
                    --hw: calc(var(--fw) / 2);
                }
                .film-img-full { width: var(--fw); flex-shrink: 0; }
                .film-img-half { width: var(--hw); flex-shrink: 0; }
                @media (max-width: 768px) { :root { --cg: 8px; } }
            </style>

            <div class="w-full overflow-hidden flex flex-col film-row-container" style="gap: var(--cg);">
                @foreach($rows as $row)
                    <div class="flex w-full justify-center" style="height: clamp(250px, 35vw, 600px); gap: var(--cg);">
                        @foreach($row['items'] as $i => $item)
                            @php
                                $isHalf = ($row['type'] === 1 && ($i === 0 || $i === 2));
                                $widthClass = $isHalf ? 'film-img-half' : 'film-img-full';
                            @endphp
                            <a href="{{ route('detail-television', $item->slug) }}" class="relative group cursor-none hover-target overflow-hidden rounded-xl {{ $widthClass }}">
                                <img src="{{ asset('photo/' . $item->photo) }}"
                                     class="w-full h-full object-cover transition-all duration-1000 ease-expo"
                                     alt="@i18n($item, 'title')">

                                {{-- Title Overlay --}}
                                @if(!$isHalf)
                                <div class="absolute bottom-6 left-8 z-20 pointer-events-none mix-blend-difference text-[#f6f6ed] group-hover:opacity-0 transition-opacity duration-300">
                                    <h4 class="font-serif text-3xl md:text-5xl leading-none drop-shadow-md">@i18n($item, 'title')</h4>
                                </div>
                                @endif

                                {{-- Hover Overlay --}}
                                <div class="absolute inset-0 bg-brand-deepbreath/95 flex flex-col justify-between p-6 md:p-10 opacity-0 group-hover:opacity-100 transition-all duration-500 backdrop-blur-sm">
                                    <div class="overflow-hidden">
                                        <span class="block font-sans text-[9px] md:text-[10px] tracking-[0.3em] uppercase text-brand-orange transform -translate-y-full group-hover:translate-y-0 transition-transform duration-500 delay-100">
                                            @i18n($item, 'genre')
                                        </span>
                                    </div>
                                    <div class="flex-grow flex items-center">
                                        <h3 class="font-serif text-2xl md:text-5xl text-white leading-tight">
                                            <span class="italic block group-hover:text-brand-orange transition-colors">@i18n($item, 'title')</span>
                                        </h3>
                                    </div>
                                    <div class="border-t border-white/10 pt-4 md:pt-6 flex justify-between items-end">
                                        <div class="flex flex-col gap-1">
                                            <span class="font-sans text-[8px] md:text-[9px] tracking-widest uppercase text-white/40">Year</span>
                                            <span class="font-sans text-xs md:text-sm text-white">{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}</span>
                                        </div>
                                        <div class="flex flex-col gap-1 text-right">
                                            <span class="font-sans text-[8px] md:text-[9px] tracking-widest uppercase text-white/40">Duration</span>
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
            color: #25225E;
        }

        .text-brand-orange {
            color: #FFB150;
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
            color: #25225E;
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
            const slides = document.querySelectorAll('.hero-slide');
            const indicators = document.querySelectorAll('.slide-indicator');
            const prevBtn = document.getElementById('hero-prev');
            const nextBtn = document.getElementById('hero-next');

            if (slides.length > 0) {
                let currentSlide = 0;
                let isAnimating = false;

                // Setup awal untuk semua slide agar aman tidak saling tumpuk
                slides.forEach((slide, idx) => {
                    const title = slide.querySelector('.slide-title');
                    const desc = slide.querySelector('.slide-desc');
                    const img = slide.querySelector('.slide-image-container');

                    if (idx === 0) {
                        gsap.set(title, { yPercent: 100 });
                        gsap.set(desc, { opacity: 0 });
                        gsap.set(img, { x: '0%', opacity: 1, scale: 1 });

                        // Animasikan slide pertama saat masuk halaman
                        gsap.to(title, { yPercent: 0, duration: 1.5, ease: "power4.out", delay: 0.2 });
                        gsap.to(desc, { opacity: 1, duration: 1, delay: 0.8 });
                    } else {
                        // Sembunyikan dengan aman sisa slide di bawah mask
                        gsap.set(title, { yPercent: 100 });
                        gsap.set(desc, { opacity: 0 });
                        gsap.set(img, { x: '20%', opacity: 0, scale: 0.9 });
                    }
                });

                function goToSlide(index) {
                    if (isAnimating || index === currentSlide || slides.length <= 1) return;
                    isAnimating = true;

                    const outgoing = slides[currentSlide];
                    const incoming = slides[index];

                    // Update indicators state
                    indicators[currentSlide].classList.remove('text-brand-deepbreath');
                    indicators[currentSlide].classList.add('text-brand-deepbreath/40');
                    indicators[index].classList.remove('text-brand-deepbreath/40');
                    indicators[index].classList.add('text-brand-deepbreath');

                    // PENTING: Bersihkan inline style opacity dari GSAP animasi sebelumnya
                    gsap.set(incoming, { clearProps: "opacity" });

                    // Aktifkan visibilitas incoming slide dengan Tailwind Utilities
                    incoming.classList.remove('opacity-0', 'invisible', 'z-10', 'pointer-events-none');
                    incoming.classList.add('opacity-100', 'visible', 'z-20', 'pointer-events-auto');

                    // Pindahkan outgoing ke layer bawah
                    outgoing.classList.remove('z-20');
                    outgoing.classList.add('z-10');

                    const incomingTitle = incoming.querySelector('.slide-title');
                    const incomingDesc = incoming.querySelector('.slide-desc');
                    const incomingImg = incoming.querySelector('.slide-image-container');
                    const outgoingImg = outgoing.querySelector('.slide-image-container');

                    // Reset status incoming teks ke posisi tersembunyi
                    gsap.set(incomingTitle, { yPercent: 100 });
                    gsap.set(incomingDesc, { opacity: 0 });
                    gsap.set(incomingImg, { x: '20%', opacity: 0, scale: 0.9 });

                    // Animation Timeline
                    const tl = gsap.timeline({
                        onComplete: () => {
                            // Nonaktifkan kembali visibilitas outgoing setelah transisi selesai
                            outgoing.classList.remove('opacity-100', 'visible', 'pointer-events-auto');
                            outgoing.classList.add('opacity-0', 'invisible', 'pointer-events-none');

                            // PENTING: Bersihkan juga setelah animasi selesai agar bersih untuk putaran berikutnya
                            gsap.set(outgoing, { clearProps: "opacity" });

                            currentSlide = index;
                            isAnimating = false;
                        }
                    });

                    // Outgoing fade out
                    tl.to(outgoing, { opacity: 0, duration: 1, ease: "power2.inOut" }, 0);
                    tl.to(outgoingImg, { x: '-10%', duration: 1, ease: "power2.inOut" }, 0);

                    // Incoming animate in
                    tl.to(incomingImg, { x: '0%', opacity: 1, scale: 1, duration: 1.2, ease: "power3.out" }, 0.2);
                    tl.to(incomingTitle, { yPercent: 0, duration: 1.2, ease: "power4.out" }, 0.4);
                    tl.to(incomingDesc, { opacity: 1, duration: 1 }, 0.8);
                }

                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        let next = currentSlide + 1;
                        if (next >= slides.length) next = 0;
                        goToSlide(next);
                    });
                }

                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        let prev = currentSlide - 1;
                        if (prev < 0) prev = slides.length - 1;
                        goToSlide(prev);
                    });
                }

                indicators.forEach((btn, idx) => {
                    btn.addEventListener('click', () => goToSlide(idx));
                });
            }

            /* ─── 2. CINEMATIC HOVER LOGIC ─── */
            // Hover langsung pada image box — ketika image melebar,
            // mouse tetap di atas image sehingga mouseleave tidak terpicu prematur.
            document.querySelectorAll('.hero-img-box').forEach(imgBox => {
                const slide = imgBox.closest('.hero-slide');
                if (!slide) return;

                imgBox.addEventListener('mouseenter', () => {
                    // Kalkulasi akurat pixel untuk mencapai ujung viewport
                    // Memperhitungkan max-width container, padding, dan scrollbar
                    const parentRect = imgBox.parentElement.getBoundingClientRect();
                    const viewportWidth = document.documentElement.clientWidth;
                    const distanceToRight = viewportWidth - parentRect.right;

                    imgBox.style.setProperty('--right-offset', `-${distanceToRight}px`);
                    imgBox.style.setProperty('--cinematic-width', `${viewportWidth}px`);

                    slide.classList.add('cinematic');
                });

                imgBox.addEventListener('mouseleave', () => {
                    slide.classList.remove('cinematic');
                });
            });

            // Play button click
            document.querySelectorAll('.play-btn-hero').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const videoId = btn.getAttribute('data-video');
                    if (videoId) openHeroTrailer(videoId);
                });
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
        });
    </script>
@endpush