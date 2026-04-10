@extends('layouts.app')
@section('title', 'About — Sinemaku Pictures')

@section('content')

    @include('partials.navbar')



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
    2. INTRO SECTION - Who We Are (Studio Antelope Style - High Contrast)
    ============================================================ --}}
    <section id="about-intro" class="bg-white px-6 md:px-16" style="
                                                                                        padding-top:    clamp(12rem, 20vh, 22rem);
                                                                                        padding-bottom: clamp(12rem, 20vh, 22rem);
                                                                                        padding-left: clamp(1.25rem, 6vw, 10rem); padding-right: clamp(1.25rem, 6vw, 10rem);
                                                                                    ">

        <div class="max-w-4xl mb-12 md:mb-24" data-gsap="fade-up">
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold leading-[1.15] text-black tracking-tight">
                Sinemaku Pictures hadir untuk memberdayakan generasi baru pencerita dan mengubah lanskap perfilman
                Indonesia.
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-20" data-gsap="fade-up">

            <div class="flex flex-col">
                <h3 class="text-2xl font-bold mb-6 text-black">Company</h3>
                <p class="text-black font-serif leading-relaxed mb-8 text-sm md:text-base">
                    Pelajari bagaimana Sinemaku beroperasi. Jelajahi identitas kami, pendekatan kami, dan peran kami dalam
                    membina sineas muda untuk ekosistem film Indonesia.
                </p>
                <a href="#"
                    class="flex items-center gap-2 text-black font-bold text-sm hover:gap-4 transition-all duration-300">
                    <span class="leading-none">→</span> Read More
                </a>
            </div>

            <div class="flex flex-col">
                <h3 class="text-2xl font-bold mb-6 text-black">Team</h3>
                <p class="text-black font-serif leading-relaxed mb-8 text-sm md:text-base">
                    Kenali tim dan kolaborator yang membentuk kami. Pelajari tentang orang-orang di balik proyek kami, peran
                    mereka, dan nilai-nilai yang memandu cara kami bekerja.
                </p>
                <a href="#about-team"
                    class="flex items-center gap-2 text-black font-bold text-sm hover:gap-4 transition-all duration-300">
                    <span class="leading-none">→</span> Read More
                </a>
            </div>

            <div class="flex flex-col">
                <h3 class="text-2xl font-bold mb-6 text-black">For Press</h3>
                <p class="text-black font-serif leading-relaxed mb-8 text-sm md:text-base">
                    Temukan informasi resmi tentang Sinemaku Pictures, termasuk latar belakang perusahaan, press kit, logo,
                    dan kontak media untuk jurnalis.
                </p>
                <span class="flex items-center gap-2 text-black font-bold text-sm">
                    <span class="leading-none">→</span> Coming Soon
                </span>
            </div>
        </div>
    </section>

    {{-- ============================================================
    2.5 TEAMS PHOTO SECTION (Edge to Edge)
    ============================================================ --}}
    <section id="about-teams-photo" class="relative w-full overflow-hidden" style="height: 100dvh; min-height: 400px;">
        <!-- Background Image -->
        <img src="{{ asset('photo/20250911070349.photo.jpg') }}" alt="Meet the team"
            style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; display: block;">

        <!-- Subtle dark gradient at the bottom for text legibility -->
        <div
            style="position: absolute; left: 0; right: 0; bottom: 0; height: 50%; background: linear-gradient(to top, rgba(0,0,0,0.6), transparent); pointer-events: none;">
        </div>

        <!-- Text Link Bottom Right -->
        <div style="position: absolute; bottom: 3rem; right: 10vw; z-index: 10;">
            <a href="#about-team"
                style="color: white; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.2em; text-transform: uppercase; text-decoration: none; transition: all 0.3s;"
                onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                meet our team ...
            </a>
        </div>
    </section>

    {{-- ============================================================
    3. MISSION STATEMENT (Premium Editorial Style)
    ============================================================ --}}
    <section id="about-mission" class="bg-white px-6 md:px-16" style="
                        padding-top:    clamp(14rem, 25vh, 28rem);
                        padding-bottom: clamp(5rem, 8vh, 10rem);
                        padding-left: clamp(1.25rem, 6vw, 10rem); padding-right: clamp(1.25rem, 6vw, 10rem);
                    ">

        {{-- Container tetap di tengah dengan mx-auto --}}
        <div class="max-w-6xl mx-auto flex flex-col items-center">

            <p class="text-black text-lg md:text-xl lg:text-2xl leading-[1.8] tracking-wider font-serif text-left max-w-4xl"
                data-gsap="fade-up">
                Sinemaku Pictures bukan sekadar rumah produksi, melainkan ruang bermain bagi generasi baru pencerita
                yang berani mendobrak tradisi kaku demi mengubah lanskap perfilman Indonesia. Kami percaya bahwa cerita
                terbaik lahir dari keberanian mengeksplorasi ide-ide gila dan menyulap realitas menjadi magis di layar
                lebar, tanpa pernah melupakan semangat kolaborasi yang menghidupkan komunitas di setiap napas
                produksinya. Bagi kami, keseriusan dalam mengejar kualitas visual premium hanyalah separuh cerita;
                separuh lainnya adalah tentang merayakan imajinasi dan memastikan bahwa di setiap prosesnya,
                <span class="italic font-bold text-black">Here Comes The Fun.</span>
            </p>
        </div>
    </section>

    {{-- ============================================================
    4. TEAM GALLERY MOSAIC
    ============================================================ --}}
    <section id="about-team" class="bg-white px-6 md:px-16" style="
                    padding-top:    clamp(12rem, 20vh, 22rem);
                    padding-bottom: clamp(12rem, 20vh, 22rem);
                    padding-left: clamp(1.25rem, 6vw, 10rem); padding-right: clamp(1.25rem, 6vw, 10rem);
                ">
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
    <section id="about-numbers" class="bg-[#0a0a0a] border-y border-white/5" style="
                                                                                        padding-top:    clamp(12rem, 20vh, 22rem);
                                                                                        padding-bottom: clamp(12rem, 20vh, 22rem);
                                                                                        padding-left: clamp(1.25rem, 6vw, 10rem); padding-right: clamp(1.25rem, 6vw, 10rem);
                                                                                    ">
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
    <section id="about-what-we-do" class="bg-[#fafafa] px-6 md:px-16" style="
                                                                                        padding-top:    clamp(12rem, 20vh, 22rem);
                                                                                        padding-bottom: clamp(12rem, 20vh, 22rem);
                                                                                        padding-left: clamp(1.25rem, 6vw, 10rem); padding-right: clamp(1.25rem, 6vw, 10rem);
                                                                                    ">
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
    <section id="get-in-touch" class="bg-[#0a0a0a] px-6 text-center" style="
                                                                                        padding-top:    clamp(14rem, 25vh, 28rem);
                                                                                        padding-bottom: clamp(14rem, 25vh, 28rem);
                                                                                    ">
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
        /* ── Scroll indicator ── */
        @keyframes scrollDown {
            0% {
                top: -40%;
            }

            100% {
                top: 140%;
            }
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