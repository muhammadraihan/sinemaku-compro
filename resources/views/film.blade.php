@extends('layouts.app')

@section('title', 'Our Films | Sinemaku Pictures')

@section('content')

    @include('partials.navbar')

    {{-- ============================================================
    EDITORIAL WRAPPER
    Menjaga gaya kanvas terang (Tint 3) khusus untuk halaman ini
    ============================================================ --}}
    <div id="editorial-wrapper" class="bg-tint-3 text-brand-deepbreath relative overflow-hidden w-full font-sans">

        {{-- ============================================================
        1. EDITORIAL HERO SLIDESHOW
        ============================================================ --}}
        <section
            class="relative w-full h-[100svh] pt-32 pb-12 px-8 md:px-16 flex flex-col justify-end z-10 max-w-[1800px] mx-auto">

            <!-- Slides Container -->
            <div id="hero-slider-container" class="absolute inset-0 px-8 md:px-16 pt-32 pb-24 flex items-center">

                @foreach($film as $i => $item)
                    <div
                        class="hero-slide absolute inset-0 px-8 md:px-16 pt-32 pb-32 flex flex-col-reverse md:flex-row items-end md:items-center justify-between w-full h-full {{ $i === 0 ? 'opacity-100 visible z-20 pointer-events-auto' : 'opacity-0 invisible z-10 pointer-events-none' }}">

                        <!-- Kiri: Teks -->
                        <div class="w-full md:w-[45%] z-20 pb-10 md:pb-0">
                            <span class="block font-sans text-[10px] tracking-[0.3em] uppercase text-brand-orange slide-meta">
                                {{ \Carbon\Carbon::parse($item->release_date)->format('Y') }} • @i18n($item, 'genre')
                            </span>
                            <!-- Masking Teks dengan Overflow Hidden -->
                            <div class="overflow-hidden mt-4 pb-2">
                                <h1
                                    class="font-serif text-[12vw] md:text-[7vw] leading-[0.9] text-brand-deepbreath tracking-tighter slide-title">
                                    <a href="{{ route('detail-film', $item->slug) }}"
                                        class="hover-target cursor-none hover:text-brand-orange transition-colors">
                                        @i18n($item, 'title')
                                    </a>
                                </h1>
                            </div>
                            <p
                                class="font-sans text-sm font-light leading-relaxed text-brand-deepbreath/60 mt-8 max-w-sm slide-desc opacity-0">
                                {{-- Jika ada sinopsis singkat dari CMS, bisa diletakkan di sini. Sementara menggunakan Durasi.
                                --}}
                                Durasi: {{ $item->duration }} Menit.
                            </p>
                        </div>

                        <!-- Kanan: Gambar Frame -->
                        <div class="w-full md:w-[50%] h-[50vh] md:h-[80vh] flex justify-end items-center relative">
                            <a href="{{ route('detail-film', $item->slug) }}"
                                class="w-full md:w-[85%] h-full bg-tint-2/20 overflow-hidden relative slide-image-container hover-target cursor-none group block">
                                <img src="{{ asset('photo/' . $item->photo) }}"
                                    class="w-full h-full object-cover filter grayscale contrast-110 slide-image group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700"
                                    alt="@i18n($item, 'title')">
                            </a>
                        </div>

                    </div>
                @endforeach

            </div>

            <!-- Hero Navigation Controls -->
            <div class="relative z-30 flex justify-between items-end border-t hairline-border pt-6 mt-auto">

                <!-- Indicators Dinamis -->
                <div class="flex gap-4 font-serif text-3xl text-brand-deepbreath/40" id="hero-indicators">
                    @foreach($film as $i => $item)
                        <button
                            class="slide-indicator hover-target cursor-none transition-colors {{ $i === 0 ? 'text-brand-deepbreath' : 'hover:text-brand-deepbreath' }}"
                            data-index="{{ $i }}">
                            {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                        </button>
                    @endforeach
                </div>

                <!-- Next / Prev -->
                <div class="flex gap-8 font-sans text-[10px] tracking-[0.3em] uppercase font-bold text-brand-deepbreath">
                    <button id="hero-prev" class="hover-target cursor-none hover:text-brand-orange transition-colors">[ Prev
                        ]</button>
                    <button id="hero-next" class="hover-target cursor-none hover:text-brand-orange transition-colors">[ Next
                        ]</button>
                </div>

            </div>
        </section>

        {{-- ============================================================
        2. ALL FILMS CATALOGUE (MASONRY GRID)
        ============================================================ --}}
        <section class="py-32 px-8 md:px-16 z-10 relative max-w-[1800px] mx-auto">

            <!-- Header & Filters Dinamis -->
            <div
                class="flex flex-col lg:flex-row justify-between items-start lg:items-end border-b hairline-border pb-12 mb-16 gap-8">
                <h2 class="font-serif text-6xl md:text-8xl text-brand-deepbreath leading-none tracking-tight">Katalog <span
                        class="italic text-brand-orange">Karya.</span></h2>

                <div class="flex gap-6 font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40 flex-wrap"
                    id="film-filters">
                    <button
                        class="filter-btn text-brand-deepbreath border-b border-brand-deepbreath pb-1 hover-target cursor-none transition-all"
                        data-filter="all">
                        Semua
                    </button>

                    @foreach ($chipGenres as $g)
                        <button
                            class="filter-btn border-b border-transparent hover:text-brand-deepbreath pb-1 hover-target cursor-none transition-all"
                            data-filter="{{ strtolower(trim($g)) }}">
                            {{ ucwords($g) }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- The Grid (Menggunakan CSS Columns) -->
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-8 md:gap-16 space-y-16" id="film-grid">

                @foreach ($genre as $index => $item)
                    @php
                        // Variasi Aspect Ratio secara acak terstruktur agar Masonry terlihat estetis & tidak monoton
                        $aspectClasses = ['aspect-[2/3]', 'aspect-[3/4]', 'aspect-[4/5]'];
                        $aspect = $aspectClasses[$index % 3];
                    @endphp

                    <a href="{{ route('detail-film', $item->slug) }}"
                        class="film-card block break-inside-avoid group cursor-none hover-target"
                        data-genres='@json($item->genres_array)'>
                        <div class="w-full {{ $aspect }} overflow-hidden mb-6 bg-tint-2/20 relative">
                            <img src="{{ asset('photo/' . $item->poster) }}"
                                class="w-full h-full object-cover filter grayscale contrast-110 group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700"
                                alt="@i18n($item, 'title')">
                        </div>
                        <h3
                            class="font-serif text-4xl text-brand-deepbreath group-hover:italic group-hover:text-brand-orange transition-colors leading-tight">
                            @i18n($item, 'title')
                        </h3>
                        <p class="font-sans text-[10px] tracking-[0.2em] uppercase text-brand-deepbreath/50 mt-3">
                            {{ \Carbon\Carbon::parse($item->release_date)->format('Y') }} • @i18n($item, 'genre')
                        </p>
                    </a>
                @endforeach

            </div>
        </section>

    </div> {{-- End Editorial Wrapper --}}

    @include('components.footer')

@endsection

{{-- ============================================================
STYLES & SCRIPTS
============================================================ --}}
@push('styles')
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

            /* ─── 2. LOGIKA FILTER KATALOG (JSON ARRAY PARSING) ─── */
            const filterBtns = document.querySelectorAll('.filter-btn');
            const filmCards = document.querySelectorAll('.film-card');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // UI Active State
                    filterBtns.forEach(b => {
                        b.classList.remove('text-brand-deepbreath', 'border-brand-deepbreath');
                        b.classList.add('border-transparent');
                    });
                    btn.classList.add('text-brand-deepbreath', 'border-brand-deepbreath');
                    btn.classList.remove('border-transparent');

                    const filterValue = btn.getAttribute('data-filter').toLowerCase().trim();

                    // Animate Out & In dengan GSAP
                    gsap.to(filmCards, {
                        scale: 0.95,
                        opacity: 0,
                        duration: 0.4,
                        stagger: 0.05,
                        onComplete: () => {
                            filmCards.forEach(card => {
                                let genres = [];
                                try {
                                    // Parse JSON array genre dari attribute
                                    genres = JSON.parse(card.getAttribute('data-genres') || '[]');
                                } catch (e) { }

                                // Cek apakah filter terpilih ada di dalam array genre film ini
                                const match = (filterValue === 'all') || genres.map(g => g.toLowerCase().trim()).includes(filterValue);

                                card.style.display = match ? 'block' : 'none';
                            });

                            ScrollTrigger.refresh(); // Sangat penting agar letak scroll Masonry kembali akurat

                            // Animate In untuk yang match saja
                            const visibleCards = Array.from(filmCards).filter(c => c.style.display === 'block');
                            gsap.to(visibleCards, {
                                scale: 1,
                                opacity: 1,
                                duration: 0.5,
                                stagger: 0.1,
                                ease: "power2.out"
                            });
                        }
                    });
                });
            });

            /* ─── 3. INITIAL SCROLL REVEAL UNTUK KARTU FILM ─── */
            gsap.matchMedia().add('(prefers-reduced-motion: no-preference)', () => {
                gsap.utils.toArray('.film-card').forEach(card => {
                    gsap.from(card, {
                        scrollTrigger: {
                            trigger: card,
                            start: "top 85%",
                        },
                        y: 50,
                        opacity: 0,
                        duration: 1.2,
                        ease: "power2.out"
                    });
                });
            });
        });
    </script>
@endpush