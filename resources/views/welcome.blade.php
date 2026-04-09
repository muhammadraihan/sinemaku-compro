@extends('layouts.app')

@section('content')

    @php
        $slides = $films->take(5);
        $first = $slides->first();
    @endphp

    {{-- ============================================================
    SIDEBAR MENU (slides in from left)
    ============================================================ --}}
    <div id="sidebar-menu"
        class="fixed top-0 left-0 w-[300px] md:w-[380px] h-full bg-[#0a0a0a] z-[200] flex flex-col justify-center px-10 md:px-14 border-r border-white/10 pt-20 transform -translate-x-full">
        @php
            $menuItems = [
                ['title' => 'About', 'url' => '/about'],
                ['title' => 'Film', 'url' => '/movies'],
                ['title' => 'Serial Web', 'url' => '/serial'],
                ['title' => 'Televisi', 'url' => '/tv'],
                ['title' => 'Dokumenter', 'url' => '/documentary'],
                ['title' => 'Events', 'url' => '/events'],
                ['title' => 'Merch', 'url' => '/shop'],
                ['title' => 'Komunitas', 'url' => '/community'],
                ['title' => 'Artikel', 'url' => '/articles'],
                ['title' => 'Karir', 'url' => '/jobs'],
            ];
        @endphp
        <div class="flex flex-col space-y-4 text-left font-display font-medium text-3xl text-white">
            @foreach($menuItems as $item)
                <a href="{{ $item['url'] }}"
                    class="menu-link opacity-0 -translate-x-8 hover:text-white/40 transition-colors duration-300">
                    {{ $item['title'] }}
                </a>
            @endforeach
        </div>
        <div
            class="mt-16 flex space-x-6 opacity-0 menu-socials items-center text-white/50 text-[10px] tracking-widest uppercase">
            <a href="#" class="hover:text-white transition-colors">IG</a>
            <a href="#" class="hover:text-white transition-colors">X</a>
            <a href="#" class="hover:text-white transition-colors">YT</a>
        </div>
    </div>

    {{-- Sidebar Backdrop --}}
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/50 z-[199] opacity-0 pointer-events-none"></div>


    {{-- ============================================================
    TOP NAV BAR
    ============================================================ --}}
    {{-- Dark top gradient to guarantee nav visibility over any background --}}
    <div class="fixed top-0 left-0 w-full h-[140px] z-[290] pointer-events-none"
        style="background: linear-gradient(to bottom, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 40%, transparent 100%);"></div>

    <nav class="fixed top-0 left-0 w-full z-[300]
                        flex justify-between items-center
                        px-6 md:px-12 py-8">

        {{-- Hamburger Button (Left) --}}
        <button id="menu-open-btn" class="flex flex-col items-start justify-center gap-1.5 group
                               text-white hover:opacity-75 transition-opacity cursor-pointer">
            <span class="block w-6 h-[1.5px] bg-white transition-all duration-300"></span>
            <span class="block w-6 h-[1.5px] bg-white transition-all duration-300"></span>
            <span class="block w-6 h-[1.5px] bg-white transition-all duration-300"></span>
        </button>

        {{-- Center: Brand --}}
        <a href="/" class="absolute left-1/2 -translate-x-1/2
                                    text-white text-xs md:text-sm
                                    tracking-[0.3em] uppercase font-light
                                    whitespace-nowrap transition-opacity hover:opacity-80">
            sinemaku pictures
        </a>

        {{-- Right: Get in Touch --}}
        <a href="#get-in-touch" class="text-[10px] md:text-xs tracking-widest uppercase text-white
                          border border-white/40 px-5 py-2.5 rounded-full
                          hover:bg-white hover:text-black transition-colors duration-300
                          inline-flex items-center">
            get in touch
        </a>
    </nav>


    {{-- ============================================================
    HERO SECTION — A24 Hover-List Style
    ============================================================ --}}
    <section id="hero" class="relative w-full overflow-hidden bg-[#0a0a0a]" style="height: 100dvh; min-height: 560px;">

        {{-- ── Background layers (one per film) ── --}}
        @php
            // Distinct dark gradient per slot as fallback
            $fallbacks = [
                'from-[#1c1c2e] via-[#16213e] to-[#0f3460]',
                'from-[#1a1a1a] via-[#2d1b33] to-[#0d0d0d]',
                'from-[#0d1b2a] via-[#1b2a3b] to-[#112233]',
                'from-[#1a0a0a] via-[#2d1010] to-[#0d0505]',
                'from-[#0a1a0a] via-[#1a2d1a] to-[#050d05]',
            ];
        @endphp
        <div class="absolute inset-0 z-0">
            @foreach($slides as $i => $film)
                @php $fb = $fallbacks[$i] ?? 'from-[#1a1a1a] to-[#0a0a0a]'; @endphp
                <div class="hero-bg absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat
                                                transition-opacity duration-700 ease-in-out" data-index="{{ $i }}" style="background-image: url('{{ asset('photo/' . $film->photo) }}');
                                                opacity: {{ $i === 0 ? '1' : '0' }};">
                    {{-- Fallback gradient shown when image is missing/loading --}}
                    <div class="absolute inset-0 -z-[1] bg-gradient-to-br {{ $fb }}"></div>
                    {{-- Dark overlay for text legibility --}}
                    <div class="absolute inset-0 bg-black/50"></div>
                </div>
            @endforeach
        </div>

        {{-- ── Cinematic vignette (bottom fade) ── --}}
        <div class="absolute inset-0 z-[1] pointer-events-none"
            style="background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.1) 45%, transparent 70%);">
        </div>


        {{-- ── Film list (bottom-left, A24 style) ── --}}
        {{-- Bottom gradient to ensure text readability --}}
        <div class="absolute inset-x-0 bottom-0 z-[5] pointer-events-none"
            style="height: 55%; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.3) 60%, transparent 100%);">
        </div>

        <div class="absolute z-[10]
                            bottom-10 left-6
                            md:bottom-12 md:left-10
                            lg:left-14">

            <ul id="film-list" class="list-none m-0 p-0">
                @foreach($slides as $i => $film)
                    @php
                        $year = \Carbon\Carbon::parse($film->release_date)->format('Y');
                    @endphp
                    <li class="film-item flex items-baseline cursor-pointer select-none" data-index="{{ $i }}"
                        style="padding: 1px 0; gap: 0.75rem;">

                        {{-- Film Title --}}
                        <span class="film-title font-display font-medium tracking-tight text-white
                                                         transition-opacity duration-500 ease-out" style="font-size: clamp(1.25rem, 3.2vw, 2.8rem);
                                                         line-height: 1.05;
                                                         opacity: {{ $i === 0 ? '1' : '0.3' }};">
                            {{ $film->title }}
                        </span>

                        {{-- Year badge — small superscript style like A24 --}}
                        <span class="film-year font-light tracking-wider shrink-0 text-white" style="font-size: 0.625rem;
                                                         opacity: {{ $i === 0 ? '0.6' : '0' }};
                                                         transition: opacity 0.5s ease;">
                            {{ $year }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- ── Scroll down indicator (bottom-right) ── --}}
        <div class="absolute bottom-10 right-8 md:right-12 z-[10] hidden md:flex flex-col items-center gap-2">
            <div class="w-[1px] h-12 bg-white/20 relative overflow-hidden">
                <div id="scroll-line" class="absolute top-0 w-full bg-white/60"
                    style="height: 40%; animation: scrollDown 2s ease-in-out infinite;"></div>
            </div>
            <span class="text-white/30 text-[9px] tracking-[0.2em] uppercase"
                style="writing-mode: vertical-lr">scroll</span>
        </div>

    </section>


    {{-- ============================================================
    BELOW-HERO — Tagline
    ============================================================ --}}
    <section id="featured" class="w-full bg-white text-[#0a0a0a]
                            py-28 md:py-40 px-6 md:px-14 lg:px-20">

        <h2 class="font-display font-medium uppercase leading-[0.88] tracking-tighter
                           text-[11vw] md:text-[7.5vw] lg:text-8xl mb-16 md:mb-24
                           max-w-5xl" data-gsap="fade-up">
            Here comes<br>the fun.
        </h2>

        <div class="w-full h-px bg-[#0a0a0a]/10 mb-10 md:mb-14" data-gsap="fade-up"></div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-8" data-gsap="fade-up">
            <p class="max-w-md font-light text-sm md:text-base leading-relaxed text-[#0a0a0a]/60">
                We are a collective of filmmakers, visionaries, and storytellers —
                pushing boundaries in modern cinematic narratives.
            </p>
            <a href="/about" class="text-[11px] uppercase tracking-widest font-medium
                              border-b border-[#0a0a0a] pb-1
                              hover:text-[#0a0a0a]/50 hover:border-[#0a0a0a]/50
                              transition-all whitespace-nowrap">
                Our Story →
            </a>
        </div>
    </section>


    {{-- Footer --}}
    @include('components.footer')


    {{-- ============================================================
    STYLES
    ============================================================ --}}
    <style>
        /* Scroll-indicator animation */
        @keyframes scrollDown {
            0% {
                top: -40%;
            }

            100% {
                top: 140%;
            }
        }

        /* Sidebar backdrop transition */
        #sidebar-backdrop {
            transition: opacity 0.4s ease;
        }

        #sidebar-backdrop.open {
            opacity: 1;
            pointer-events: auto;
        }

        /* Sidebar transition is handled by GSAP */
        #sidebar-menu {
            /* No transition here to avoid conflicts with GSAP */
        }

        /* Film list hover cursor on desktop */
        @media (hover: hover) {
            .film-item:hover .film-title {
                opacity: 1 !important;
            }
        }

        /* Mobile: make all titles more visible */
        @media (max-width: 767px) {
            .film-title {
                font-size: clamp(1.6rem, 7.5vw, 2.2rem) !important;
            }

            .film-item {
                padding: 2px 0;
            }
        }
    </style>

@endsection


{{-- ============================================================
SCRIPTS
============================================================ --}}
@push('scripts')
    {{-- ScrollTrigger (load after GSAP which is in

    <head>) --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js" defer></script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {

                /* ─────────────────────────────────────────
                   1. SIDEBAR MENU
                ───────────────────────────────────────── */
                const sidebar = document.getElementById('sidebar-menu');
                const backdrop = document.getElementById('sidebar-backdrop');
                const openBtn = document.getElementById('menu-open-btn');
                const menuLinks = document.querySelectorAll('.menu-link');
                const menuSocials = document.querySelector('.menu-socials');
                let menuOpen = false;

                function openMenu() {
                    menuOpen = true;
                    backdrop.classList.add('open');
                    document.body.style.overflow = 'hidden';

                    // GSAP Animation
                    gsap.to(sidebar, { x: 0, duration: 0.8, ease: "power4.out" });
                    gsap.to(menuLinks, { x: 0, opacity: 1, duration: 0.6, stagger: 0.05, ease: "power3.out", delay: 0.2 });
                    gsap.to(menuSocials, { opacity: 1, duration: 0.6, delay: 0.5 });
                }

                function closeMenu() {
                    menuOpen = false;
                    backdrop.classList.remove('open');
                    document.body.style.overflow = '';

                    // GSAP Animation reverse
                    gsap.to(menuSocials, { opacity: 0, duration: 0.3 });
                    gsap.to(menuLinks, { x: -20, opacity: 0, duration: 0.3, stagger: -0.05, ease: "power3.in" });
                    gsap.to(sidebar, { x: "-100%", duration: 0.8, ease: "power4.inOut", delay: 0.1 });
                }

                openBtn.addEventListener('click', () => {
                    if (menuOpen) {
                        closeMenu();
                    } else {
                        openMenu();
                    }
                });
                backdrop.addEventListener('click', closeMenu);

                // Close on Escape key
                document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });


                /* ─────────────────────────────────────────
                   2. HERO HOVER-LIST — background switcher
                ───────────────────────────────────────── */
                const filmItems = document.querySelectorAll('.film-item');
                const heroBgs = document.querySelectorAll('.hero-bg');
                const filmTitles = document.querySelectorAll('.film-title');
                const filmYears = document.querySelectorAll('.film-year');

                let activeIdx = 0;

                function activateFilm(idx) {
                    if (idx === activeIdx) return;

                    // — Background crossfade —
                    heroBgs.forEach((bg, i) => {
                        bg.style.opacity = (i === idx) ? '1' : '0';
                    });

                    // — Title opacity —
                    filmTitles.forEach((t, i) => {
                        t.style.opacity = (i === idx) ? '1' : '0.25';
                    });
                    filmYears.forEach((y, i) => {
                        y.style.opacity = (i === idx) ? '0.7' : '0';
                    });

                    activeIdx = idx;
                }

                // Desktop: hover to switch
                filmItems.forEach((item, idx) => {
                    item.addEventListener('mouseenter', () => activateFilm(idx));
                });

                // Mobile / touch: tap to switch
                filmItems.forEach((item, idx) => {
                    item.addEventListener('touchstart', (e) => {
                        e.preventDefault();
                        activateFilm(idx);
                    }, { passive: false });
                });

                /* ─────────────────────────────────────────
                   3. GSAP ScrollTrigger — tagline reveal
                ───────────────────────────────────────── */
                function initScrollAnimations() {
                    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
                    gsap.registerPlugin(ScrollTrigger);

                    document.querySelectorAll('[data-gsap="fade-up"]').forEach(el => {
                        gsap.fromTo(el,
                            { y: 48, opacity: 0 },
                            {
                                y: 0, opacity: 1,
                                duration: 1,
                                ease: 'power3.out',
                                scrollTrigger: { trigger: el, start: 'top 88%' }
                            }
                        );
                    });
                }

                // ScrollTrigger may load after DOMContentLoaded if deferred
                if (typeof ScrollTrigger !== 'undefined') {
                    initScrollAnimations();
                } else {
                    // Retry after a tick for deferred script
                    setTimeout(initScrollAnimations, 300);
                }

            });
        </script>
@endpush