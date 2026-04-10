@extends('layouts.app')
@section('title', 'About — Sinemaku Pictures')

@section('content')

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
                @php
                    // Check if current URL matches the item URL
                    $isActive = request()->is(ltrim($item['url'], '/'));
                @endphp
                <a href="{{ $item['url'] }}"
                    class="menu-link opacity-0 -translate-x-8 transition-colors duration-300 {{ $isActive ? 'text-white' : 'text-white/40 hover:text-white/80' }}">
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
    <div class="fixed top-0 left-0 w-full h-[140px] z-[290] pointer-events-none"
        style="background: linear-gradient(to bottom, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 40%, transparent 100%);"></div>

    <nav class="fixed top-0 left-0 w-full z-[300]
                        flex justify-between items-center
                        px-4 md:px-12 py-6 md:py-8">

        {{-- Hamburger Button (Left) --}}
        <button id="menu-open-btn" class="flex flex-col items-start justify-center gap-1.5 group
                               text-white hover:opacity-75 transition-opacity cursor-pointer">
            <span class="block w-6 h-[1.5px] bg-white transition-all duration-300"></span>
            <span class="block w-6 h-[1.5px] bg-white transition-all duration-300"></span>
            <span class="block w-6 h-[1.5px] bg-white transition-all duration-300"></span>
        </button>

        {{-- Center: Brand --}}
        <a href="/" class="absolute left-1/2 -translate-x-1/2
                                    text-white text-sm
                                    tracking-[0.3em] uppercase font-light
                                    whitespace-nowrap transition-opacity hover:opacity-80">
            sinemaku pictures
        </a>

        {{-- Right: Get in Touch --}}
        {{-- Mobile: icon only, no border --}}
        <a id="nav-cta-mobile" href="#get-in-touch" class="text-white hover:opacity-70 transition-opacity"
           aria-label="Get in touch">
            <x-icons.mail class="w-7 h-7" />
        </a>
        {{-- Desktop: text + capsule --}}
        <a id="nav-cta-desktop" href="#get-in-touch" class="text-xs tracking-widest uppercase text-white
                          border border-white/40 px-5 py-2.5 rounded-full
                          hover:bg-white hover:text-black transition-colors duration-300
                          items-center whitespace-nowrap">
            get in touch
        </a>
    </nav>


    {{-- ============================================================
    1. HERO SECTION
    ============================================================ --}}
    <section id="about-hero" class="relative w-full overflow-hidden flex items-center"
        style="height: 100dvh; min-height: 600px;">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('photo/20250911070125.photo.jpg') }}" alt="Sinemaku Studio"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>

        <div class="relative z-20 w-full max-w-7xl mx-auto px-6 md:px-16 pt-20">
            <div class="max-w-2xl">
                <p
                    class="hero-sub font-sans text-white text-lg md:text-xl font-medium mt-8 mb-0 opacity-0 translate-y-8 leading-none max-w-lg">
                    about sinemaku pictures
                </p>

                <h1 class="hero-tagline font-sans font-bold text-white leading-[1.1] md:leading-[0.9] mt-2 mb-6 opacity-0 translate-y-12"
                    style="font-size: clamp(3rem, 11vw, 6.5rem);">
                    Here Comes<br>The Fun
                </h1>

                <div class="flex flex-row flex-wrap items-center gap-3 md:gap-5 hero-actions opacity-0 translate-y-8">
                    <a href="#about-intro"
                        class="inline-block text-center bg-white text-black px-6 sm:px-10 py-2 md:py-2.5 text-[10px] sm:text-xs font-bold tracking-[0.2em] hover:bg-gray-200 transition-colors duration-300 rounded-none border border-white">
                        ABOUT OUR COMPANY
                    </a>

                    <a href="#about-team"
                        class="inline-block text-center text-white px-6 sm:px-10 py-2 md:py-2.5 text-[10px] sm:text-xs font-bold tracking-[0.2em] hover:bg-white/10 transition-colors duration-300 rounded-none border border-white/30">
                        MEET OUR TEAM
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
    2. INTRO SECTION - Who We Are
    ============================================================ --}}
    <section id="about-intro" class="bg-white py-24 md:py-36 px-6 md:px-16"
        style="padding-left: clamp(1.25rem, 6vw, 10rem); padding-right: clamp(1.25rem, 6vw, 10rem);">
        <div class="max-w-[1540px] mx-auto grid grid-cols-1 lg:grid-cols-[1fr_2fr] gap-12 lg:gap-24 items-start">
            <div class="sticky top-32" data-gsap="fade-up">
                <span class="text-gray-200 font-display italic leading-none m-0 block"
                    style="font-size: clamp(5rem, 10vw, 8rem);">
                    EST. 2020
                </span>
            </div>
            <div class="flex flex-col flex-1" data-gsap="fade-up">
                <p class="text-gray-800 text-lg md:text-xl lg:text-2xl leading-[1.8] font-light mb-12 max-w-4xl">
                    Berdiri dengan semangat memberdayakan generasi baru pencerita, Sinemaku Pictures hadir untuk mengubah
                    lanskap perfilman Indonesia. Kami bukan tentang tradisi yang kaku, melainkan tentang ruang eksplorasi di
                    mana imajinasi liar dirayakan dan suara-suara segar didengar. Keseruan ada pada prosesnya.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 sm:gap-6">
                    <span
                        class="inline-flex items-center gap-3 text-xs tracking-widest text-gray-500 uppercase font-medium bg-gray-50 py-3 px-6 border border-gray-100 rounded-full w-max">
                        <x-icons.film class="w-4 h-4" /> Film & Seri
                    </span>
                    <span
                        class="inline-flex items-center gap-3 text-xs tracking-widest text-gray-500 uppercase font-medium bg-gray-50 py-3 px-6 border border-gray-100 rounded-full w-max">
                        <x-icons.users class="w-4 h-4" /> Komunitas
                    </span>
                    <span
                        class="inline-flex items-center gap-3 text-xs tracking-widest text-gray-500 uppercase font-medium bg-gray-50 py-3 px-6 border border-gray-100 rounded-full w-max">
                        <x-icons.zap class="w-4 h-4" /> Inovasi Visual
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
    3. MISSION STATEMENT
    ============================================================ --}}
    <section id="about-mission" class="bg-[#0a0a0a] py-32 md:py-48 px-6 md:px-16"
        style="padding-left: clamp(1.25rem, 6vw, 10rem); padding-right: clamp(1.25rem, 6vw, 10rem);">
        <div class="max-w-6xl mx-auto flex flex-col items-center text-center">
            <span class="text-xs tracking-[0.25em] uppercase text-gray-500 font-medium mb-10" data-gsap="fade-up">Visi &
                Misi</span>

            <div class="w-full h-[1px] bg-white/10 mb-16" data-gsap="fade-up"></div>

            <h2 class="font-display italic text-white leading-[1.2] tracking-tight max-w-5xl"
                style="font-size: clamp(2rem, 5vw, 4.5rem);" data-gsap="fade-up">
                Menjadi rumah produksi yang tak pernah berhenti <span class="text-white/50">bermain-main dengan ide
                    gila</span>, menceritakan realitas dengan sentuhan magis, dan terus merajut komunitas <span
                    class="text-white/50">yang hidup bersama setiap karya</span> yang kami lepaskan.
            </h2>

            <div class="w-full h-[1px] bg-white/10 mt-16" data-gsap="fade-up"></div>
        </div>
    </section>

    {{-- ============================================================
    4. TEAM GALLERY MOSAIC
    ============================================================ --}}
    <section id="about-team" class="bg-white py-24 md:py-36 px-6 md:px-16"
        style="padding-left: clamp(1.25rem, 6vw, 10rem); padding-right: clamp(1.25rem, 6vw, 10rem);">
        <div class="max-w-[1540px] mx-auto">
            <div class="mb-16" data-gsap="fade-up">
                <span class="text-xs tracking-[0.25em] uppercase text-gray-400 font-medium block mb-4">Team</span>
                <h2 class="text-4xl md:text-5xl font-display text-gray-900 tracking-tight">Orang-orang di balik kamera.</h2>
            </div>

            <!-- Dynamic Grid Layout -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 auto-rows-[250px]">
                <!-- Item 1 (Span 2 cols, Span 2 rows) -->
                <div class="gallery-item relative overflow-hidden group sm:col-span-2 sm:row-span-2 bg-gray-200">
                    <img src="{{ asset('photo/20250911070125.photo.jpg') }}" alt="Sinemaku Team"
                        class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.03]">
                    <div
                        class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="gallery-item relative overflow-hidden group bg-gray-200">
                    <img src="{{ asset('photo/20250831080926.jpg') }}" alt="Behind the scenes"
                        class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.03]">
                    <div
                        class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                </div>

                <!-- Item 3 (Span 2 rows vertical) -->
                <div class="gallery-item relative overflow-hidden group row-span-2 bg-gray-200">
                    <img src="{{ asset('photo/20250904015648.jpeg') }}" alt="Set photo"
                        class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.03]">
                    <div
                        class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="gallery-item relative overflow-hidden group bg-gray-200">
                    <img src="{{ asset('photo/20250831074325.jpg') }}" alt="Fun moment"
                        class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.03]">
                    <div
                        class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                </div>

                <!-- Item 5 (Span 2 cols) -->
                <div class="gallery-item relative overflow-hidden group sm:col-span-2 lg:col-span-2 bg-gray-200">
                    <img src="{{ asset('photo/20250902092841.jpg') }}" alt="Sinemaku Event"
                        class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.03]"
                        style="object-position: center 30%;">
                    <div
                        class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                </div>

                <!-- Item 6 -->
                <div class="gallery-item relative overflow-hidden group bg-gray-200">
                    <img src="{{ asset('photo/20250911070349.photo.jpg') }}" alt="Crew on set"
                        class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.03]">
                    <div
                        class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
    5. NUMBERS / MILESTONES
    ============================================================ --}}
    <section id="about-numbers" class="bg-[#0a0a0a] py-24 border-y border-white/5"
        style="padding-left: clamp(1.25rem, 6vw, 10rem); padding-right: clamp(1.25rem, 6vw, 10rem);">
        <div class="max-w-[1540px] mx-auto">
            <div
                class="grid grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 divide-x-0 lg:divide-x divide-white/10 text-center lg:text-left">
                <div class="stat-block lg:px-8 first:pl-0" data-gsap="fade-up">
                    <p class="font-display text-5xl md:text-7xl text-white mb-2">XX+</p>
                    <p class="text-sm tracking-widest uppercase text-gray-500">Karya Film</p>
                </div>
                <div class="stat-block lg:px-8" data-gsap="fade-up">
                    <p class="font-display text-5xl md:text-7xl text-white mb-2">{{ date('Y') - 2020 }}</p>
                    <p class="text-sm tracking-widest uppercase text-gray-500">Tahun Berdiri</p>
                </div>
                <div class="stat-block lg:px-8" data-gsap="fade-up">
                    <p class="font-display text-5xl md:text-7xl text-white mb-2">XX+</p>
                    <p class="text-sm tracking-widest uppercase text-gray-500">Anggota Komunitas</p>
                </div>
                <div class="stat-block lg:px-8" data-gsap="fade-up">
                    <p class="font-display text-5xl md:text-7xl text-white mb-2">XX+</p>
                    <p class="text-sm tracking-widest uppercase text-gray-500">Kota Roadshow</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
    6. WHAT WE DO
    ============================================================ --}}
    <section id="about-what-we-do" class="bg-[#fafafa] py-24 md:py-36 px-6 md:px-16"
        style="padding-left: clamp(1.25rem, 6vw, 10rem); padding-right: clamp(1.25rem, 6vw, 10rem);">
        <div class="max-w-[1540px] mx-auto">
            <div class="mb-16 md:mb-24 flex flex-col items-center text-center" data-gsap="fade-up">
                <span class="text-xs tracking-[0.25em] uppercase text-gray-400 font-medium block mb-4">What We Do</span>
                <h2 class="text-3xl md:text-5xl font-display text-gray-900 tracking-tight max-w-2xl">Bukan hanya sekadar
                    membuat karya.</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-10 border border-gray-100 hover:shadow-xl hover:shadow-black/5 transition-shadow duration-300 group"
                    data-gsap="fade-up">
                    <div
                        class="h-12 w-12 bg-gray-50 rounded-full flex items-center justify-center mb-8 text-gray-800 group-hover:bg-black group-hover:text-white transition-colors duration-300">
                        <x-icons.film class="w-5 h-5" />
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-4">Film & Seri web</h3>
                    <p class="text-gray-500 leading-relaxed font-light">Eksplorasi cerita layar lebar dan seri web dengan
                        narasi segar, menghadirkan estetika visual yang menantang batas-batas konvensional.</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-10 border border-gray-100 hover:shadow-xl hover:shadow-black/5 transition-shadow duration-300 group"
                    data-gsap="fade-up">
                    <div
                        class="h-12 w-12 bg-gray-50 rounded-full flex items-center justify-center mb-8 text-gray-800 group-hover:bg-black group-hover:text-white transition-colors duration-300">
                        <x-icons.monitor class="w-5 h-5" />
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-4">Tayangan Televisi</h3>
                    <p class="text-gray-500 leading-relaxed font-light">Menghadirkan kisah-kisah hangat untuk ruang keluarga
                        melalui produksi televisi yang berkualitas dan dekat dengan realitas sehari-hari.</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-10 border border-gray-100 hover:shadow-xl hover:shadow-black/5 transition-shadow duration-300 group"
                    data-gsap="fade-up">
                    <div
                        class="h-12 w-12 bg-gray-50 rounded-full flex items-center justify-center mb-8 text-gray-800 group-hover:bg-black group-hover:text-white transition-colors duration-300">
                        <x-icons.users class="w-5 h-5" />
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-4">Komunitas & Event</h3>
                    <p class="text-gray-500 leading-relaxed font-light">Rantai penghubung antarsineas dan penonton lewat
                        Sinemaku Day, workshop, nobar bincang karya, dan program kerelawanan.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
    7. GET IN TOUCH CTA
    ============================================================ --}}
    <section id="get-in-touch" class="bg-[#0a0a0a] py-32 md:py-48 px-6 text-center">
        <div class="max-w-3xl mx-auto flex flex-col items-center" data-gsap="fade-up">
            <span class="text-xs tracking-[0.2em] uppercase text-gray-500 font-medium mb-6">Kolaborasi</span>
            <h2 class="font-display italic text-white text-4xl md:text-6xl mb-12">Ada proyek hebat yang bisa dikerjakan
                bersama?</h2>

            <a href="mailto:hello@sinemakupictures.com"
                class="feature-cta !text-white !border-white/50 hover:!border-white group">
                <span class="group-hover:text-gray-300 transition-colors">hello@sinemakupictures.com</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4 ml-2 group-hover:text-gray-300 transition-colors">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>
    </section>

    {{-- Footer --}}
    @include('components.footer')


    {{-- ============================================================
    STYLES & SCRIPTS
    ============================================================ --}}
    <style>
        /* ── Nav CTA: responsive ── */
        #nav-cta-mobile {
            display: inline-flex;
            line-height: 1;
            align-items: center;
        }

        #nav-cta-desktop {
            display: none;
        }

        @media (min-width: 768px) {
            #nav-cta-mobile {
                display: none;
            }

            #nav-cta-desktop {
                display: inline-flex;
            }
        }

        /* ── Scroll indicator ── */
        @keyframes scrollDown {
            0% {
                top: -40%;
            }

            100% {
                top: 140%;
            }
        }

        /* ── Sidebar backdrop ── */
        #sidebar-backdrop {
            transition: opacity 0.4s ease;
        }

        #sidebar-backdrop.open {
            opacity: 1;
            pointer-events: auto;
        }

        /* ── feature-cta override for dark bg ── */
        .feature-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            font-weight: 500;
            border-bottom: 1px solid;
            padding-bottom: 4px;
            transition: all 400ms ease;
            text-decoration: none;
        }

        .feature-cta:hover {
            gap: 16px;
        }
    </style>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Sidebar menu elements
                const sidebarBtn = document.getElementById('menu-open-btn');
                const sidebarMenu = document.getElementById('sidebar-menu');
                const sidebarBackdrop = document.getElementById('sidebar-backdrop');

                // Reusable animation timeline for sidebar
                const tl = gsap.timeline({ paused: true, reversed: true });

                tl.to(sidebarMenu, {
                    x: 0,
                    duration: 0.6,
                    ease: 'power3.inOut'
                })
                    // Stagger in links
                    .to('.menu-link', {
                        x: 0,
                        opacity: 1,
                        duration: 0.5,
                        stagger: 0.05,
                        ease: 'power2.out'
                    }, "-=0.3")
                    // Fade in socials
                    .to('.menu-socials', {
                        opacity: 1,
                        duration: 0.4
                    }, "-=0.2");

                function toggleMenu() {
                    const isOpen = !tl.reversed();
                    if (isOpen) { // Closing
                        tl.reverse();
                        sidebarBackdrop.classList.remove('open');
                        document.body.style.overflow = '';

                        // Transform hamburger lines back
                        const spans = sidebarBtn.querySelectorAll('span');
                        spans[0].style.transform = 'none';
                        spans[1].style.opacity = '1';
                        spans[2].style.transform = 'none';
                    } else { // Opening
                        tl.play();
                        sidebarBackdrop.classList.add('open');
                        document.body.style.overflow = 'hidden';

                        // Transform hamburger to 'X'
                        const spans = sidebarBtn.querySelectorAll('span');
                        spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                        spans[1].style.opacity = '0';
                        spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
                    }
                }

                sidebarBtn.addEventListener('click', toggleMenu);
                sidebarBackdrop.addEventListener('click', toggleMenu);

                // GSAP Scroll Animations
                gsap.registerPlugin(ScrollTrigger);

                // Hero Animation Sequence
                gsap.to('.hero-eyebrow', {
                    opacity: 1,
                    y: 0,
                    duration: 1,
                    ease: 'power3.out',
                    delay: 0.3
                });

                gsap.to('.hero-tagline', {
                    y: 0,
                    opacity: 1,
                    duration: 1.2,
                    ease: 'power4.out',
                    delay: 0.5
                });

                gsap.to('.hero-actions', {
                    y: 0,
                    opacity: 1,
                    duration: 1,
                    ease: 'power3.out',
                    delay: 0.8
                });

                gsap.to('.hero-sub', {
                    y: 0,
                    opacity: 1,
                    duration: 1,
                    ease: 'power3.out',
                    delay: 0.6
                });

                // MatchMedia for respecting 'prefers-reduced-motion'
                let mm = gsap.matchMedia();

                mm.add("(prefers-reduced-motion: no-preference)", () => {
                    const fadeUpElements = document.querySelectorAll('[data-gsap="fade-up"]');
                    fadeUpElements.forEach(el => {
                        gsap.fromTo(el,
                            { y: 40, opacity: 0 },
                            {
                                y: 0,
                                opacity: 1,
                                duration: 0.8,
                                ease: 'power3.out',
                                scrollTrigger: {
                                    trigger: el,
                                    start: 'top 85%',
                                    toggleActions: 'play none none none'
                                }
                            }
                        );
                    });

                    // Stagger gallery items
                    gsap.fromTo('.gallery-item',
                        { y: 30, opacity: 0 },
                        {
                            y: 0,
                            opacity: 1,
                            duration: 0.8,
                            stagger: 0.1,
                            ease: 'power3.out',
                            scrollTrigger: {
                                trigger: '#about-team',
                                start: 'top 75%'
                            }
                        }
                    );
                });
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    @endpush
@endsection