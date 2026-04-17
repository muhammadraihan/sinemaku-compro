@extends('layouts.app')
@section('title', 'About — Sinemaku Pictures')

@section('content')

    {{-- ============================================================
    TOGGLE: ubah $introEnabled ke false untuk menonaktifkan intro.
    Satu baris ini cukup untuk mengaktifkan/menonaktifkan animasi.
    ============================================================ --}}
    @php $introEnabled = true; @endphp

    @if($introEnabled)
    {{-- ============================================================
    CINEMATIC INTRO OVERLAY
    Each word is a separate animated block. Each visible char has a
    data-ci matching the corresponding hero h1 char for the FLIP morph.
    Layout: "Here [gap] Comes / [indent] The [gap] Fun."
    ============================================================ --}}
    <div id="intro-overlay" class="fixed inset-0 z-[200] overflow-hidden" style="pointer-events: auto;">

        {{-- The dark background — this is the ONLY thing that slides down --}}
        <div id="intro-bg" class="absolute inset-0" style="background: #0b0a1a; z-index: 1;"></div>
        {{-- Diagonal stripe pattern --}}
        <div class="absolute inset-0 pointer-events-none" style="z-index: 2;
            background-image: repeating-linear-gradient(45deg, transparent, transparent 30px, rgba(237,149,32,0.04) 30px, rgba(237,149,32,0.04) 62px);"></div>
        {{-- Radial amber glow from left --}}
        <div class="absolute inset-0 pointer-events-none" style="z-index: 2;
            background: radial-gradient(ellipse 90% 65% at 20% 50%, rgba(237,149,32,0.07) 0%, transparent 65%);"></div>
        {{-- Bottom amber vignette (like the image) --}}
        <div class="absolute bottom-0 left-0 right-0 pointer-events-none" style="z-index: 2; height: 45%;
            background: linear-gradient(to top, rgba(90,35,0,0.65), transparent);"></div>

        {{-- TEXT LAYER: stays in viewport when BG slides down --}}
        <div class="absolute inset-0 pointer-events-none" style="z-index: 10;
            display: flex; flex-direction: column; justify-content: center;
            padding: 0 4vw;">

            {{--
                CHAR INDEX MAP (must match hero h1 char order):
                "Here Comes" → H=0 e=1 r=2 e=3 [space=4, hidden] C=5 o=6 m=7 e=8 s=9
                "The Fun."   → T=10 h=11 e=12 [space=13, hidden] F=14 u=15 n=16 .=17
            --}}

            {{-- LINE 1: "Here" left, "Comes" pushed right (both fly from right) --}}
            <div style="display: flex; align-items: baseline; width: 100%;">
                <div id="w-here" style="display: inline-block;
                    font-family: 'Libre Baskerville', serif;
                    font-size: clamp(3.2rem, 11vw, 7.5rem);
                    color: #ed9520; font-weight: 700; line-height: 1.05;
                    white-space: nowrap; will-change: transform;"><span class="ichar" data-ci="0">H</span><span class="ichar" data-ci="1">e</span><span class="ichar" data-ci="2">r</span><span class="ichar" data-ci="3">e</span></div>

                <div id="w-comes" style="display: inline-block; margin-left: auto; margin-right: 6%;
                    font-family: 'Libre Baskerville', serif;
                    font-size: clamp(3.2rem, 11vw, 7.5rem);
                    color: #ed9520; font-weight: 700; line-height: 1.05;
                    white-space: nowrap; will-change: transform;"><span class="ichar" data-ci="5">C</span><span class="ichar" data-ci="6">o</span><span class="ichar" data-ci="7">m</span><span class="ichar" data-ci="8">e</span><span class="ichar" data-ci="9">s</span></div>
            </div>

            {{-- LINE 2: "The" indented, "Fun." far right (both fly from left) --}}
            <div style="display: flex; align-items: baseline; width: 100%;">
                <div id="w-the" style="display: inline-block; margin-left: 21%;
                    font-family: 'Libre Baskerville', serif;
                    font-size: clamp(3.2rem, 11vw, 7.5rem);
                    color: #ed9520; font-weight: 700; line-height: 1.05;
                    white-space: nowrap; will-change: transform;"><span class="ichar" data-ci="10">T</span><span class="ichar" data-ci="11">h</span><span class="ichar" data-ci="12">e</span></div>

                <div id="w-fun" style="display: inline-block; margin-left: auto;
                    font-family: 'Libre Baskerville', serif;
                    font-size: clamp(3.2rem, 11vw, 7.5rem);
                    color: #ed9520; font-weight: 700; line-height: 1.05;
                    white-space: nowrap; will-change: transform;"><span class="ichar" data-ci="14">F</span><span class="ichar" data-ci="15">u</span><span class="ichar" data-ci="16">n</span><span class="ichar" data-ci="17">.</span></div>
            </div>

        </div>
    </div>
    @endif {{-- $introEnabled --}}

    @include('partials.navbar')



    {{-- ============================================================
    1. HERO SECTION
    ============================================================ --}}
    <section id="about-hero" class="relative w-full overflow-hidden flex items-center"
        style="height: 100dvh; min-height: 600px;">
        <div class="absolute inset-0 z-0">
            <img src="{{ isset($settings['about_hero_image']) ? asset($settings['about_hero_image']) : asset('photo/about_hero.png') }}" alt="Sinemaku Crew"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>

        <div class="relative z-20 w-full max-w-7xl mx-auto px-6 md:px-16 pt-20">
            <div class="max-w-2xl">
                <p id="hero-sub"
                    class="font-sans text-white text-lg md:text-xl font-medium mt-8 mb-0 leading-none max-w-lg"
                    style="opacity: 0; transform: translateY(20px);">
                    {{ $settings['about_hero_subtitle'] ?? 'about sinemaku pictures' }}
                </p>

                {{--
                    Hero title: each character is wrapped for the FLIP morph animation.
                    PHP generates markup without any whitespace between spans
                    (font-size:0 on .hline eliminates the inline-block gap bug).
                    data-ci must match the ichar data-ci values in the intro overlay.
                --}}
                <h1 id="hero-tagline"
                    class="font-sans font-bold text-white mt-2 mb-6"
                    style="font-size: clamp(3rem, 11vw, 6.5rem); line-height: 1.1; opacity: 0;">
                    @php
                        $rawTitle  = $settings['about_hero_title'] ?? "Here Comes\nThe Fun.";
                        $hlines    = explode("\n", str_replace(["<br />","<br>"], "\n", nl2br(e($rawTitle))));
                        $hci       = 0;
                        $hHtml     = '';
                        foreach ($hlines as $hl) {
                            $hl = trim($hl);
                            if (!strlen($hl)) continue;
                            // font-size:0 kills whitespace gaps between inline-block spans
                            $hHtml .= '<span class="hline" style="display:block;font-size:0;line-height:1.1;">';
                            foreach (mb_str_split($hl) as $hch) {
                                $disp   = $hch === ' ' ? '&nbsp;' : htmlspecialchars($hch, ENT_HTML5, 'UTF-8');
                                $hHtml .= '<span class="hchar" data-ci="'.$hci.'" style="display:inline-block;'
                                        . 'font-size:clamp(3rem,11vw,6.5rem);font-weight:700;line-height:1.1;'
                                        . 'opacity:0;">'.$disp.'</span>';
                                $hci++;
                            }
                            $hHtml .= '</span>';
                        }
                    @endphp
                    {!! $hHtml !!}
                </h1>

                <div id="hero-actions" class="flex flex-row flex-wrap items-center gap-3 md:gap-5" style="opacity: 0; transform: translateY(20px);">
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
                {{ $settings['about_identity_heading'] ?? 'Sinemaku Pictures hadir untuk memberdayakan generasi baru pencerita dan mengubah lanskap perfilman Indonesia.' }}
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-20" data-gsap="fade-up">

            <div class="flex flex-col">
                <h3 class="text-2xl font-bold mb-6 text-black">{{ $settings['about_studio_label'] ?? 'Company' }}</h3>
                <p class="text-black leading-relaxed mb-8 text-sm md:text-base">
                    {{ $settings['about_studio_body'] ?? 'Pelajari bagaimana Sinemaku beroperasi. Jelajahi identitas kami, pendekatan kami, dan peran kami dalam membina sineas muda untuk ekosistem film Indonesia.' }}
                </p>
                <a href="#"
                    class="flex items-center gap-2 text-black font-bold text-sm hover:gap-4 transition-all duration-300">
                    <span class="leading-none">→</span> Read More
                </a>
            </div>

            <div class="flex flex-col">
                <h3 class="text-2xl font-bold mb-6 text-black">Team</h3>
                <p class="text-black leading-relaxed mb-8 text-sm md:text-base">
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
                <p class="text-black leading-relaxed mb-8 text-sm md:text-base">
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
        <img src="{{ isset($settings['about_secondary_image']) ? asset($settings['about_secondary_image']) : asset('photo/about_secondary.png') }}" alt="Meet the team"
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

            <p class="text-black text-lg md:text-xl lg:text-2xl leading-[1.8] tracking-wider text-left max-w-4xl"
                data-gsap="fade-up">
                {!! nl2br(e($settings['about_mission_statement'] ?? "Sinemaku Pictures bukan sekadar rumah produksi, melainkan ruang bermain bagi generasi baru pencerita yang berani mendobrak tradisi kaku demi mengubah lanskap perfilman Indonesia.\n\nKami percaya bahwa cerita terbaik lahir dari keberanian mengeksplorasi ide-ide gila dan menyulap realitas menjadi magis di layar lebar, tanpa pernah melupakan semangat kolaborasi yang menghidupkan komunitas di setiap napas produksinya.\n\nBagi kami, keseriusan dalam mengejar kualitas visual premium hanyalah separuh cerita; separuh lainnya adalah tentang merayakan imajinasi dan memastikan bahwa di setiap prosesnya, Here Comes The Fun.")) !!}
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
                    <img src="{{ isset($settings['about_team_image_1']) ? asset($settings['about_team_image_1']) : asset('photo/about_hero.png') }}" alt="Sinemaku Team"
                        class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.03]">
                    <div
                        class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="gallery-item relative overflow-hidden group bg-gray-200">
                    <img src="{{ isset($settings['about_team_image_2']) ? asset($settings['about_team_image_2']) : asset('photo/about_crew_1.png') }}" alt="Behind the scenes"
                        class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.03]">
                    <div
                        class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                </div>

                <!-- Item 3 (Span 2 rows vertical) -->
                <div class="gallery-item relative overflow-hidden group row-span-2 bg-gray-200">
                    <img src="{{ isset($settings['about_team_image_3']) ? asset($settings['about_team_image_3']) : asset('photo/about_crew_2.png') }}" alt="Set photo"
                        class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.03]">
                    <div
                        class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="gallery-item relative overflow-hidden group bg-gray-200">
                    <img src="{{ isset($settings['about_team_image_4']) ? asset($settings['about_team_image_4']) : asset('photo/about_crew_3.png') }}" alt="Fun moment"
                        class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.03]">
                    <div
                        class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                </div>

                <!-- Item 5 (Span 2 cols) -->
                <div class="gallery-item relative overflow-hidden group sm:col-span-2 lg:col-span-2 bg-gray-200">
                    <img src="{{ isset($settings['about_team_image_5']) ? asset($settings['about_team_image_5']) : asset('photo/about_crew_4.png') }}" alt="Sinemaku Event"
                        class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.03]"
                        style="object-position: center 30%;">
                    <div
                        class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                </div>

                <!-- Item 6 -->
                <div class="gallery-item relative overflow-hidden group bg-gray-200">
                    <img src="{{ isset($settings['about_team_image_6']) ? asset($settings['about_team_image_6']) : asset('photo/about_crew_5.png') }}" alt="Crew on set"
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
                    <h3 class="text-xl font-medium text-gray-900 mb-4">{{ $settings['about_values_1_title'] ?? 'Film & Seri web' }}</h3>
                    <p class="text-gray-500 leading-relaxed font-light">{{ $settings['about_values_1_body'] ?? 'Eksplorasi cerita layar lebar dan seri web dengan narasi segar, menghadirkan estetika visual yang menantang batas-batas konvensional.' }}</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-10 border border-gray-100 hover:shadow-xl hover:shadow-black/5 transition-shadow duration-300 group"
                    data-gsap="fade-up">
                    <div
                        class="h-12 w-12 bg-gray-50 rounded-full flex items-center justify-center mb-8 text-gray-800 group-hover:bg-black group-hover:text-white transition-colors duration-300">
                        <x-icons.monitor class="w-5 h-5" />
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-4">{{ $settings['about_values_2_title'] ?? 'Tayangan Televisi' }}</h3>
                    <p class="text-gray-500 leading-relaxed font-light">{{ $settings['about_values_2_body'] ?? 'Menghadirkan kisah-kisah hangat untuk ruang keluarga melalui produksi televisi yang berkualitas dan dekat dengan realitas sehari-hari.' }}</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-10 border border-gray-100 hover:shadow-xl hover:shadow-black/5 transition-shadow duration-300 group"
                    data-gsap="fade-up">
                    <div
                        class="h-12 w-12 bg-gray-50 rounded-full flex items-center justify-center mb-8 text-gray-800 group-hover:bg-black group-hover:text-white transition-colors duration-300">
                        <x-icons.users class="w-5 h-5" />
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-4">{{ $settings['about_values_3_title'] ?? 'Komunitas & Event' }}</h3>
                    <p class="text-gray-500 leading-relaxed font-light">{{ $settings['about_values_3_body'] ?? 'Rantai penghubung antarsineas dan penonton lewat Sinemaku Day, workshop, nobar bincang karya, dan program kerelawanan.' }}</p>
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
            0%   { top: -40%; }
            100% { top: 140%; }
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
        .feature-cta:hover { gap: 16px; }

        /* Mobile: skip the overlay entirely */
        @media (max-width: 768px) {
            #intro-overlay { display: none !important; }
        }
    </style>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', () => {

            gsap.registerPlugin(ScrollTrigger);

            // Injected from PHP — change $introEnabled in blade to toggle the animation
            const INTRO_ENABLED = {{ $introEnabled ? 'true' : 'false' }};

            /* ================================================================
               DESKTOP CINEMATIC INTRO  (viewport > 768 px)

               Timeline:
               0.00s  – Words fly in from opposite sides (different easing per word)
               ~1.1s  – All words settled  →  hold ~1 second
               2.10s  – #intro-bg slides DOWN alone (the text chars stay put)
               2.15s  – Each intro char (ichar) performs a FLIP:
                          • Moves from its current viewport position to the
                            matching hero char's (hchar) viewport position
                          • Scales to match hero char size
                          • Color transitions orange → white
               2.75s  – Hero chars (.hchar) crossfade IN while intro chars fade OUT
               3.10s  – Intro overlay hidden; hero sub-heading + CTA fade in
            ================================================================ */
            if (INTRO_ENABLED && window.innerWidth > 768) {

                const wHere    = document.getElementById('w-here');
                const wComes   = document.getElementById('w-comes');
                const wThe     = document.getElementById('w-the');
                const wFun     = document.getElementById('w-fun');
                const introBg  = document.getElementById('intro-bg');
                const overlay  = document.getElementById('intro-overlay');
                const heroTag  = document.getElementById('hero-tagline');
                const heroSub  = document.getElementById('hero-sub');
                const heroAct  = document.getElementById('hero-actions');

                // Set starting positions via GSAP (overrides any inline CSS transforms)
                gsap.set(wHere,  { x: '115vw' });
                gsap.set(wComes, { x: '125vw' });   // slightly more offset → stagger feel
                gsap.set(wThe,   { x: '-115vw' });
                gsap.set(wFun,   { x: '-125vw' });

                const tl = gsap.timeline({ defaults: { overwrite: 'auto' } });

                // ── PHASE 1: Fly in — different easing per word ──────────────────
                tl.to(wHere,  { x: 0, duration: 0.9,  ease: 'expo.out'   }, 0);
                tl.to(wComes, { x: 0, duration: 1.1,  ease: 'power4.out' }, 0.08);
                tl.to(wThe,   { x: 0, duration: 1.0,  ease: 'expo.out'   }, 0.05);
                tl.to(wFun,   { x: 0, duration: 1.15, ease: 'circ.out'   }, 0.14);

                // ── PHASE 2: Hold (gap in timeline ~1 second) ──────────────────
                // Last word settles ≈ t=1.15+0.14=1.29s → next action at t=2.1s

                // ── PHASE 3a: Background slides DOWN alone ────────────────────
                tl.to(introBg, {
                    yPercent: 100,
                    duration: 0.9,
                    ease: 'expo.inOut'
                }, 2.1);

                // ── PHASE 3b: FLIP — intro chars move to hero char positions ──
                //   Fired as a callback so we can measure live rects
                tl.set(heroTag, { opacity: 1 }, 2.1);  // h1 visible (chars still opacity:0)

                tl.call(() => {
                    const ichars = document.querySelectorAll('.ichar');

                    ichars.forEach((ic) => {
                        const ci = parseInt(ic.dataset.ci, 10);
                        const hc = document.querySelector('.hchar[data-ci="' + ci + '"]');
                        if (!hc) return;

                        const ir = ic.getBoundingClientRect();
                        const hr = hc.getBoundingClientRect();
                        if (!ir.width || !hr.width) return;

                        // Center-to-center delta (works correctly with scale)
                        const dx = (hr.left + hr.width  / 2) - (ir.left + ir.width  / 2);
                        const dy = (hr.top  + hr.height / 2) - (ir.top  + ir.height / 2);
                        const sx = hr.width  / ir.width;
                        const sy = hr.height / ir.height;

                        // Stagger outward from char index
                        const delay = ci * 0.018;

                        gsap.to(ic, {
                            x: dx, y: dy,
                            scaleX: sx, scaleY: sy,
                            color: '#ffffff',
                            duration: 0.75,
                            ease: 'expo.inOut',
                            delay: delay
                        });
                    });

                    // Cross-fade: hero chars fade IN, intro chars fade OUT
                    const crossAt = 0.55;   // seconds after callback fires
                    gsap.to('.hchar', {
                        opacity: 1,
                        duration: 0.3,
                        stagger: { each: 0.018, from: 'start' },
                        delay: crossAt
                    });
                    gsap.to('.ichar', {
                        opacity: 0,
                        duration: 0.25,
                        delay: crossAt + 0.05
                    });

                    // Remove overlay after everything settles
                    gsap.delayedCall(crossAt + 0.6, () => {
                        overlay.style.display = 'none';
                    });

                }, [], 2.15);

                // ── PHASE 4: Supporting hero elements ────────────────────────
                tl.to(heroSub, {
                    y: 0, opacity: 1,
                    duration: 0.7, ease: 'power3.out'
                }, 3.15);
                tl.to(heroAct, {
                    y: 0, opacity: 1,
                    duration: 0.7, ease: 'power3.out'
                }, 3.35);

            } else {
                /* ============================================================
                   INTRO DISABLED or MOBILE: no overlay, just reveal hero cleanly
                ============================================================ */
                const heroTag = document.getElementById('hero-tagline');
                const heroSub = document.getElementById('hero-sub');
                const heroAct = document.getElementById('hero-actions');

                gsap.set(heroTag, { opacity: 1 });
                gsap.to('.hchar', {
                    opacity: 1,
                    duration: 0.7, stagger: 0.018,
                    ease: 'power3.out', delay: 0.4
                });
                gsap.to(heroSub, {
                    y: 0, opacity: 1,
                    duration: 0.6, ease: 'power3.out', delay: 0.9
                });
                gsap.to(heroAct, {
                    y: 0, opacity: 1,
                    duration: 0.6, ease: 'power3.out', delay: 1.1
                });
            }

            /* ================================================================
               SCROLL ANIMATIONS
            ================================================================ */
            gsap.matchMedia().add('(prefers-reduced-motion: no-preference)', () => {
                document.querySelectorAll('[data-gsap="fade-up"]').forEach(el => {
                    gsap.fromTo(el,
                        { y: 40, opacity: 0 },
                        {
                            y: 0, opacity: 1,
                            duration: 0.8, ease: 'power3.out',
                            scrollTrigger: {
                                trigger: el, start: 'top 85%',
                                toggleActions: 'play none none none'
                            }
                        }
                    );
                });
                gsap.fromTo('.gallery-item',
                    { y: 30, opacity: 0 },
                    {
                        y: 0, opacity: 1,
                        duration: 0.8, stagger: 0.1, ease: 'power3.out',
                        scrollTrigger: { trigger: '#about-team', start: 'top 75%' }
                    }
                );
            });
        });
        </script>
    @endpush
@endsection