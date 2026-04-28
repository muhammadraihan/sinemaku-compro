<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About — Sinemaku Pictures</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Configuration based on Design Guide -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            orange: '#FFB150',
                            deepbreath: '#25225E',
                        },
                        shade: {
                            1: '#DB5F10',
                            2: '#0E1633',
                            3: '#000000',
                        },
                        tint: {
                            1: '#FFD8A8',
                            2: '#CACAEF',
                            3: '#F1F1F1',
                        }
                    },
                    fontFamily: {
                        serif: ['"Instrument Serif"', 'serif'],
                        sans: ['Helvetica', 'Arial', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">

    <!-- Iconify -->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <style>
        body {
            background-color: #EDECEA;
            color: #25225E;
            margin: 0;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            cursor: none;
        }

        /* ── INTERACTIVE GRADIENT BACKGROUND ── */
        #interactive-bg {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background:
                radial-gradient(
                    ellipse 70vw 70vh at var(--mx, 25%) var(--my, 55%),
                    rgba(255, 177, 80, 0.25) 0%,
                    transparent 70%
                ),
                radial-gradient(
                    ellipse 55vw 55vh at calc(100% - var(--mx, 25%)) calc(100% - var(--my, 55%)),
                    rgba(37, 34, 94, 0.15) 0%,
                    transparent 70%
                );
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
            opacity: 0.10;
        }

        @keyframes float-blob-1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            40%       { transform: translate(4%, 3%) scale(1.06); }
            70%       { transform: translate(-3%, 5%) scale(0.96); }
        }
        @keyframes float-blob-2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            35%       { transform: translate(-5%, -2%) scale(1.04); }
            65%       { transform: translate(3%, -4%) scale(0.98); }
        }

        #leak-1 {
            background: radial-gradient(circle, #FFB150 0%, transparent 70%);
            animation: float-blob-1 18s ease-in-out infinite;
        }

        #leak-2 {
            background: radial-gradient(circle, #25225E 0%, transparent 70%);
            animation: float-blob-2 24s ease-in-out infinite;
        }

        /* ── TYPOGRAPHY & LAYOUT ── */
        .vertical-text {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
        }

        .hairline-border {
            border-color: rgba(37, 34, 94, 0.15);
        }

        .editorial-image-container {
            overflow: hidden;
            position: relative;
        }

        .editorial-image {
            width: 100%;
            height: 120%;
            /* Untuk parallax */
            object-fit: cover;
            filter: grayscale(100%) contrast(1.1);
            transition: filter 0.8s ease;
        }

        .editorial-image-container:hover .editorial-image {
            filter: grayscale(0%) contrast(1.05);
        }

        /* Sembunyikan scrollbar native untuk kesan bersih */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #F1F1F1;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(37, 34, 94, 0.2);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(37, 34, 94, 0.5);
        }

        /* ── CUSTOM CURSOR (EDITORIAL RING) ── */
        #cursor-ring {
            position: fixed;
            top: 0;
            left: 0;
            width: 30px;
            height: 30px;
            border: 1px solid #FFB150;
            border-radius: 50%;
            pointer-events: none;
            z-index: 10000;
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s, background-color 0.3s;
            mix-blend-mode: multiply;
        }

        #cursor-dot {
            position: fixed;
            top: 0;
            left: 0;
            width: 4px;
            height: 4px;
            background-color: #25225E;
            border-radius: 50%;
            pointer-events: none;
            z-index: 10000;
            transform: translate(-50%, -50%);
        }

        /* ── SMOOTH ITALIC ANIMATION ── */
        .smooth-italic {
            display: inline-block;
            transform-origin: center;
            animation: unskewToNormal 0.4s forwards;
        }
        .smooth-italic:hover,
        .group:hover .group-smooth-italic {
            animation: skewToItalic 0.4s forwards;
        }
        .group-smooth-italic {
            display: inline-block;
            transform-origin: center;
            animation: unskewToNormal 0.4s forwards;
        }

        @keyframes skewToItalic {
            0% { transform: skewX(0deg) scale(1); font-style: normal; }
            49% { transform: skewX(-12deg) scale(1); font-style: normal; }
            50% { transform: skewX(0deg) scale(0.94); font-style: italic; }
            100% { transform: skewX(0deg) scale(0.94); font-style: italic; }
        }
        @keyframes unskewToNormal {
            0% { transform: skewX(0deg) scale(0.94); font-style: italic; }
            49% { transform: skewX(0deg) scale(0.94); font-style: italic; }
            50% { transform: skewX(-12deg) scale(1); font-style: normal; }
            100% { transform: skewX(0deg) scale(1); font-style: normal; }
        }

        /* ── HERO IMAGE HOVER FIX ── */
        .hero-image-container:hover .hero-img-grayscale {
            opacity: 0 !important;
            transition: opacity 0.7s ease;
        }
    </style>
</head>

<body class="font-sans">

    <!-- Interactive Gradient Background -->
    <div id="interactive-bg"></div>

    <!-- Efek Grain & Light Leak Global -->
    <div class="cinematic-grain"></div>
    <div id="leak-1" class="light-leak w-[50vw] h-[50vw] top-[-10vw] left-[-10vw]"></div>
    <div id="leak-2" class="light-leak w-[40vw] h-[40vw] bottom-10 right-[-10vw]"></div>

    <!-- Custom Cursor -->
    <div id="cursor-ring"></div>
    <div id="cursor-dot"></div>



    <!-- ── MINIMALIST HEADER ── -->
    @include('partials.navbar')

    <!-- 1. EDITORIAL HERO SECTION -->
    <section id="hero-section" class="relative w-full h-[100svh] flex flex-col justify-start px-8 md:px-16 pt-32 pb-16 z-10 overflow-hidden">
        <!-- Text Container (z-30) -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-12 w-full z-30 relative hero-text-wrapper pointer-events-none">
            <!-- Huge Typography -->
            <div class="w-full md:w-3/4">
                <h1 class="hero-title font-serif text-[15vw] md:text-[12vw] leading-[0.8] text-brand-deepbreath tracking-tighter m-0 hero-reveal">
                    <span class="tagline-container tagline-id" data-tagline-lang="id">
                        Here Comes<br><span class="hero-title-italic italic text-brand-orange pl-[5vw]">The Fun.</span>
                    </span>
                    <span class="tagline-container tagline-en" data-tagline-lang="en" style="display:none;">
                        Here Comes<br><span class="hero-title-italic italic text-brand-orange pl-[5vw]">The Fun.</span>
                    </span>
                </h1>
            </div>

            <!-- Context Text -->
            <div class="w-full md:w-1/4 pb-4 hero-reveal hero-context">
                @php
                    $subId = $settings['about_hero_subtitle'] ?? 'Sebuah ruang bermain bagi generasi baru pencerita yang berani mendobrak tradisi kaku demi mengubah lanskap perfilman Indonesia.';
                    $subEn = $settings['about_hero_subtitle_en'] ?? 'A playground for a new generation of storytellers who dare to break rigid traditions to change the landscape of Indonesian cinema.';
                @endphp
                <p class="font-sans text-xs md:text-sm font-light leading-relaxed text-brand-deepbreath/70">
                    <span class="tagline-container tagline-id" data-tagline-lang="id">
                        {{ $subId }}
                    </span>
                    <span class="tagline-container tagline-en" data-tagline-lang="en" style="display:none;">
                        {{ $subEn }}
                    </span>
                </p>
                <div class="hero-scroll-indicator mt-8 pt-4 border-t hairline-border flex justify-between font-sans text-[9px] tracking-widest uppercase text-brand-deepbreath/50">
                    <span>Scroll to explore</span>
                    <span>↓</span>
                </div>
            </div>
        </div>

        <!-- Absolute Image Container (z-20) -->
        <div class="hero-image-container group absolute bottom-4 md:bottom-16 left-1/2 -translate-x-1/2 w-[90%] aspect-[16/9] md:aspect-none md:w-[60%] md:h-[45vh] z-20 overflow-hidden rounded-md cursor-none hover-target shadow-2xl">
            <div class="hero-image-overlay absolute inset-0 bg-brand-deepbreath/60 opacity-0 z-10 pointer-events-none"></div>
            
            <!-- Base Image (Full Color) -->
            <img src="{{ isset($settings['about_hero_image']) ? asset($settings['about_hero_image']) : 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=2000&auto=format&fit=crop' }}"
                alt="Cinematic Setup" class="absolute inset-0 w-full h-full object-cover z-0 hero-img-inner pointer-events-none">
                
            <!-- Grayscale Overlay (Fades out on hover and scroll) -->
            <img src="{{ isset($settings['about_hero_image']) ? asset($settings['about_hero_image']) : 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=2000&auto=format&fit=crop' }}"
                alt="Cinematic Setup Grayscale" class="absolute inset-0 w-full h-full object-cover z-0 hero-img-grayscale filter grayscale contrast-110 transition-opacity duration-700 group-hover:opacity-0 pointer-events-none">
        </div>
    </section>

    <!-- 2. MANIFESTO (MUSEUM LAYOUT) -->
    <section id="manifesto" class="py-32 px-8 md:px-16 z-10 relative">
        <div class="border-t hairline-border pt-12 flex flex-col md:flex-row gap-12 md:gap-32">

            <!-- Section Marker -->
            <div class="w-full md:w-1/12">
                <span class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-orange block mb-4">
                    01 — Misi
                </span>
            </div>

            <!-- Content Area -->
            <div class="w-full md:w-11/12 flex flex-col gap-24">
                <h2
                    class="font-serif text-4xl md:text-6xl lg:text-7xl leading-[1.1] text-brand-deepbreath tracking-tight max-w-4xl text-reveal">
                    @php
                        $defaultIdHeading = 'Sinemaku Pictures hadir untuk memberdayakan generasi baru pencerita dan mengubah lanskap perfilman Indonesia.';
                        $settings['about_identity_heading'] = isset($settings['about_identity_heading']) ? $settings['about_identity_heading'] : $defaultIdHeading;
                        $settings['about_identity_heading_en'] = isset($settings['about_identity_heading_en']) ? $settings['about_identity_heading_en'] : 'Sinemaku Pictures is here to empower a new generation of storytellers and change the landscape of Indonesian cinema.';
                    @endphp
                    @i18n($settings, 'about_identity_heading')
                </h2>

                <div class="flex flex-col md:flex-row gap-16 md:gap-32 w-full md:w-4/5 ml-auto">
                    <div class="flex-1 text-reveal">
                        <span class="font-serif italic text-3xl text-brand-orange mb-6 block">
                            @php
                                $settings['about_studio_label'] = isset($settings['about_studio_label']) ? $settings['about_studio_label'] : 'Company.';
                                $settings['about_studio_label_en'] = isset($settings['about_studio_label_en']) ? $settings['about_studio_label_en'] : 'Company.';
                            @endphp
                            @i18n($settings, 'about_studio_label')
                        </span>
                        <p class="font-sans text-sm md:text-base font-light leading-loose text-brand-deepbreath/80">
                            @php
                                $defaultStudioBody = 'Pelajari bagaimana Sinemaku beroperasi. Jelajahi identitas kami, pendekatan kami, dan peran kami dalam membina sineas muda untuk ekosistem film Indonesia.';
                                $settings['about_studio_body'] = isset($settings['about_studio_body']) ? $settings['about_studio_body'] : $defaultStudioBody;
                                $settings['about_studio_body_en'] = isset($settings['about_studio_body_en']) ? $settings['about_studio_body_en'] : 'Learn how Sinemaku operates. Explore our identity, our approach, and our role in nurturing young filmmakers for the Indonesian film ecosystem.';
                            @endphp
                            @i18n($settings, 'about_studio_body')
                        </p>
                    </div>
                    <div class="flex-1 text-reveal">
                        <span class="font-serif italic text-3xl text-brand-orange mb-6 block">Culture.</span>
                        <p class="font-sans text-sm md:text-base font-light leading-loose text-brand-deepbreath/80">
                            @php
                                $defaultMission = "Kami percaya bahwa cerita terbaik lahir dari keberanian mengeksplorasi ide-ide gila dan menyulap realitas menjadi magis di layar lebar, tanpa pernah melupakan semangat kolaborasi.";
                                $settings['about_mission_statement'] = isset($settings['about_mission_statement']) ? $settings['about_mission_statement'] : $defaultMission;
                                $settings['about_mission_statement_en'] = isset($settings['about_mission_statement_en']) ? $settings['about_mission_statement_en'] : "We believe the best stories are born from the courage to explore crazy ideas and magically transform reality onto the big screen.";
                            @endphp
                            @i18n($settings, 'about_mission_statement')
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 2.5 SECONDARY CREW PHOTO (Edge-to-Edge Parallax) -->
    <section class="secondary-photo-section relative w-full h-[60vh] md:h-[75vh] overflow-hidden z-10">
        @php
            $secondaryImg = $settings['about_secondary_image'] ?? null;
        @endphp
        @if($secondaryImg)
        <img src="{{ asset($secondaryImg) }}"
            alt="Sinemaku Team"
            class="secondary-para-img absolute left-0 w-full object-cover"
            style="height: 150%; top: 0;">
        @else
        <img src="https://images.unsplash.com/photo-1509023464722-18d996393ca8?q=80&w=2000&auto=format&fit=crop"
            alt="Sinemaku Team"
            class="secondary-para-img absolute left-0 w-full object-cover"
            style="height: 150%; top: 0;">
        @endif
    </section>

    <!-- 3. THE CREW (ASYMMETRICAL PRINT GRID) -->
    <section id="crew" class="py-32 px-8 md:px-16 z-10 relative">
        <div class="w-full">
            <div class="border-t hairline-border pt-12 flex flex-col md:flex-row gap-12 md:gap-32 mb-24">
                <div class="w-full md:w-1/12">
                    <span
                        class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-orange block mb-4">
                        02 — Kru
                    </span>
                </div>
                <div class="w-full md:w-11/12">
                    <h2
                        class="font-serif text-5xl md:text-8xl leading-none text-brand-deepbreath tracking-tighter text-reveal">
                        <span class="tagline-container tagline-id" data-tagline-lang="id">
                            Orang-orang di<br>balik <span class="italic text-brand-orange">kamera.</span>
                        </span>
                        <span class="tagline-container tagline-en" data-tagline-lang="en" style="display:none;">
                            The people<br>behind the <span class="italic text-brand-orange">camera.</span>
                        </span>
                    </h2>
                </div>
            </div>

            <!-- Dynamic Editorial Grid Container -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-y-32 md:gap-x-12 relative pb-20">
                @php
                    // Truly dynamic detection from CMS settings
                    $crewMembers = collect($settings)
                        ->filter(fn($v, $k) => str_starts_with($k, 'about_team_image_') && !empty($v))
                        ->map(function ($v, $k) use ($settings) {
                            $id = str_replace('about_team_image_', '', $k);
                            return [
                                'img' => $v,
                                'name' => $settings["about_team_name_$id"] ?? ($id == 1 ? 'Prilly Latuconsina' : 'Sinemaku Crew'),
                                'role' => $settings["about_team_role_$id"] ?? ($settings["about_team_role_{$id}_en"] ?? ($id == 1 ? 'Founder / Producer' : 'Team Member')),
                                'index' => $id
                            ];
                        })
                        ->sortBy('index')
                        ->values()
                        ->toArray();

                    // Fallback if no images in CMS, use the files mentioned by user
                    if (empty($crewMembers)) {
                        $defaultNames = ['Prilly Latuconsina', 'Umar Shahab', 'Monty Tiwa', 'Yahni Damayanti', 'Sinemaku Crew'];
                        $defaultRoles = ['Founder / Producer', 'Founder / Director', 'Creative Director', 'Producer', 'Team Member'];
                        for ($i = 1; $i <= 5; $i++) {
                            $crewMembers[] = [
                                'img' => "photo/about_crew_$i.png",
                                'name' => $defaultNames[$i - 1] ?? 'Sinemaku Crew',
                                'role' => $defaultRoles[$i - 1] ?? 'Team Member',
                                'index' => $i
                            ];
                        }
                    }
                @endphp

                @foreach($crewMembers as $index => $member)
                    @php
                        // Cycle through the 4 patterns from about_new3.html
                        $pattern = $index % 4;
                        $colSpan = '';
                        $colStart = '';
                        $marginTop = '';
                        $aspect = '';

                        switch ($pattern) {
                            case 0: // Large, offset right (Prilly style)
                                $colStart = 'md:col-start-6';
                                $colSpan = 'md:col-span-6';
                                $aspect = 'aspect-[3/4]';
                                break;
                            case 1: // Small, offset left
                                $colStart = 'md:col-start-2';
                                $colSpan = 'md:col-span-3';
                                $aspect = 'aspect-[4/5]';
                                $marginTop = 'md:-mt-32';
                                break;
                            case 2: // Medium, center alignment
                                $colStart = 'md:col-start-4';
                                $colSpan = 'md:col-span-5';
                                $aspect = 'aspect-square';
                                $marginTop = 'md:mt-12';
                                break;
                            case 3: // Landscape, bottom right
                                $colStart = 'md:col-start-8';
                                $colSpan = 'md:col-span-5';
                                $aspect = 'aspect-[16/9]';
                                $marginTop = 'md:-mt-40';
                                break;
                        }
                    @endphp

                    <div class="{{ $colStart }} {{ $colSpan }} {{ $marginTop }} flex items-end gap-6 reveal-image group cursor-none hover-target sticky top-8 h-fit">
                        <div class="flex items-end">
                            @if(!empty($member['name']))
                                <div
                                    class="vertical-text font-serif text-3xl md:text-5xl text-brand-deepbreath pb-4 mr-3 whitespace-nowrap">
                                    {{ $member['name'] }}
                                </div>
                            @endif
                            @if(!empty($member['role']))
                                <div
                                    class="vertical-text font-sans text-[10px] tracking-[0.3em] uppercase text-brand-deepbreath/40 pb-4">
                                    {{ $member['role'] }}
                                </div>
                            @endif
                        </div>

                        <div class="w-full editorial-image-container {{ $aspect }} bg-tint-2/20">
                            <img src="{{ asset($member['img']) }}" class="editorial-image para-img"
                                alt="{{ $member['name'] }}">
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- 4. WHAT WE DO (MINIMAL TABLE) -->
    <section class="py-32 px-8 md:px-16 z-10 relative">
        <div class="border-t hairline-border pt-12 flex flex-col md:flex-row gap-12 md:gap-32">
            <div class="w-full md:w-1/12">
                <span class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-orange block mb-4">
                    @php
                        $settings['about_wwd_eyebrow'] = $settings['about_wwd_eyebrow'] ?? '03 — Fokus';
                        $settings['about_wwd_eyebrow_en'] = $settings['about_wwd_eyebrow_en'] ?? '03 — Focus';
                    @endphp
                    @i18n($settings, 'about_wwd_eyebrow')
                </span>
            </div>

            <div class="w-full md:w-11/12">
                <div class="flex flex-col">

                    <a href="#"
                        class="group flex flex-col md:flex-row justify-between items-start md:items-center py-10 md:py-16 border-b hairline-border list-row cursor-none hover-target">
                        <h3
                            class="font-serif text-5xl md:text-7xl text-brand-deepbreath group-hover:text-brand-orange transition-colors duration-500 group-smooth-italic">
                            @php
                                $settings['about_values_1_title'] = $settings['about_values_1_title'] ?? 'Film & Seri Web';
                                $settings['about_values_1_title_en'] = $settings['about_values_1_title_en'] ?? 'Film & Web Series';
                            @endphp
                            @i18n($settings, 'about_values_1_title')
                        </h3>
                        <p
                            class="font-sans font-light text-sm text-brand-deepbreath/50 md:w-1/3 mt-4 md:mt-0 leading-relaxed text-left md:text-right group-hover:text-brand-deepbreath transition-colors">
                            @php
                                $settings['about_values_1_body'] = $settings['about_values_1_body'] ?? 'Estetika visual yang menantang batas-batas konvensional.';
                                $settings['about_values_1_body_en'] = $settings['about_values_1_body_en'] ?? 'Visual aesthetics that challenge conventional boundaries.';
                            @endphp
                            @i18n($settings, 'about_values_1_body')
                        </p>
                    </a>

                    <a href="#"
                        class="group flex flex-col md:flex-row justify-between items-start md:items-center py-10 md:py-16 border-b hairline-border list-row cursor-none hover-target">
                        <h3
                            class="font-serif text-5xl md:text-7xl text-brand-deepbreath group-hover:text-brand-orange transition-colors duration-500 group-smooth-italic">
                            @php
                                $settings['about_values_2_title'] = $settings['about_values_2_title'] ?? 'Tayangan Televisi';
                                $settings['about_values_2_title_en'] = $settings['about_values_2_title_en'] ?? 'Television Shows';
                            @endphp
                            @i18n($settings, 'about_values_2_title')
                        </h3>
                        <p
                            class="font-sans font-light text-sm text-brand-deepbreath/50 md:w-1/3 mt-4 md:mt-0 leading-relaxed text-left md:text-right group-hover:text-brand-deepbreath transition-colors">
                            @php
                                $settings['about_values_2_body'] = $settings['about_values_2_body'] ?? 'Kisah hangat untuk ruang keluarga yang dekat dengan realitas.';
                                $settings['about_values_2_body_en'] = $settings['about_values_2_body_en'] ?? 'Warm stories for the family room that are close to reality.';
                            @endphp
                            @i18n($settings, 'about_values_2_body')
                        </p>
                    </a>

                    <a href="#"
                        class="group flex flex-col md:flex-row justify-between items-start md:items-center py-10 md:py-16 border-b hairline-border list-row cursor-none hover-target">
                        <h3
                            class="font-serif text-5xl md:text-7xl text-brand-deepbreath group-hover:text-brand-orange transition-colors duration-500 group-smooth-italic">
                            @php
                                $settings['about_values_3_title'] = $settings['about_values_3_title'] ?? 'Komunitas & Event';
                                $settings['about_values_3_title_en'] = $settings['about_values_3_title_en'] ?? 'Community & Events';
                            @endphp
                            @i18n($settings, 'about_values_3_title')
                        </h3>
                        <p
                            class="font-sans font-light text-sm text-brand-deepbreath/50 md:w-1/3 mt-4 md:mt-0 leading-relaxed text-left md:text-right group-hover:text-brand-deepbreath transition-colors">
                            @php
                                $settings['about_values_3_body'] = $settings['about_values_3_body'] ?? 'Rantai penghubung antarsineas lewat Sinemaku Day.';
                                $settings['about_values_3_body_en'] = $settings['about_values_3_body_en'] ?? 'Connecting filmmakers through Sinemaku Day.';
                            @endphp
                            @i18n($settings, 'about_values_3_body')
                        </p>
                    </a>

                </div>
            </div>
        </div>
    </section>

    @include('components.footer')

    <!-- GSAP Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <script>
        gsap.registerPlugin(ScrollTrigger);

        // ─── HERO SCROLL ANIMATION ──────────────────────────────────────
        let heroTl = gsap.timeline({
            scrollTrigger: {
                trigger: "#hero-section",
                start: "top top",
                end: "+=80%", // Increased scroll distance to accommodate the hold
                pin: true,
                scrub: 1, // Smooth scrub
            }
        });

        // Expand image
        heroTl.to(".hero-image-container", {
            width: "96vw",
            height: "94vh",
            bottom: "3vh", // Vertically center
            borderRadius: "24px",
            duration: 0.8, // Finish at 80% of scroll
            ease: "none"
        }, 0);

        // Darken overlay
        heroTl.to(".hero-image-overlay", {
            opacity: 0.7,
            duration: 0.8,
            ease: "none"
        }, 0);

        // Color text to white/bright
        heroTl.to(".hero-title", {
            color: "#F1F1F1", // tint-3
            duration: 0.8,
            ease: "none"
        }, 0);

        // Fade out context text
        heroTl.to(".hero-context", {
            opacity: 0,
            y: -20,
            duration: 0.4, // Finish earlier
            ease: "none"
        }, 0);

        // Move text block down significantly for better composition
        heroTl.to(".hero-text-wrapper", {
            y: "30vh", // Keeping user's manual change
            duration: 0.8,
            ease: "none"
        }, 0);

        // Animate image to full color automatically during scroll by fading out grayscale layer
        heroTl.to(".hero-img-grayscale", {
            opacity: 0,
            duration: 0.8,
            ease: "none"
        }, 0);
        
        // Slightly scale images to give parallax feel
        heroTl.fromTo(".hero-img-inner", 
            { scale: 1.1 },
            { scale: 1, duration: 0.8, ease: "none" }, 
        0);
        heroTl.fromTo(".hero-img-grayscale", 
            { scale: 1.1 },
            { scale: 1, duration: 0.8, ease: "none" }, 
        0);

        // Add a "hold" period where nothing happens for the last 20% of scroll
        heroTl.to({}, { duration: 0.2 });
        // ────────────────────────────────────────────────────────────────

        // 2. Subtle Light Leak Parallax (Simplified for Performance)
        const leak1 = document.getElementById('leak-1');
        const leak2 = document.getElementById('leak-2');

        // Mouse move logic removed to prevent lag caused by filter:blur animations

        // 3. Image Parallax
        gsap.utils.toArray('.editorial-image-container').forEach(container => {
            const img = container.querySelector('.para-img');
            gsap.to(img, {
                yPercent: 15,
                ease: "none",
                scrollTrigger: {
                    trigger: container,
                    start: "top bottom",
                    end: "bottom top",
                    scrub: true
                }
            });
        });

        // 3.5 Secondary Crew Photo Parallax
        // Image is 150% tall. When section enters from bottom: show top of image (y=0).
        // When section exits at top: show bottom of image (y=-50%).
        const secondaryImg = document.querySelector('.secondary-para-img');
        if (secondaryImg) {
            gsap.fromTo(secondaryImg,
                { y: "0%" },
                {
                    y: "-50%",
                    ease: "none",
                    scrollTrigger: {
                        trigger: '.secondary-photo-section',
                        start: "top bottom",
                        end: "bottom top",
                        scrub: true
                    }
                }
            );
        }

        // 4. Reveal Animations
        gsap.from(".hero-reveal", {
            y: 40, opacity: 0, stagger: 0.2, duration: 1.5, ease: "expo.out", delay: 0.2
        });

        gsap.utils.toArray('.text-reveal').forEach(text => {
            gsap.from(text, {
                scrollTrigger: { trigger: text, start: "top 85%" },
                y: 30, opacity: 0, duration: 1.5, ease: "power3.out"
            });
        });

        // 4. Dynamic Crew Member "Stacking Cards" Animation
        const crewCards = gsap.utils.toArray('.reveal-image');
        crewCards.forEach((card, i) => {
            const nextCard = crewCards[i + 1];
            
            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: card,
                    // Start animation when it enters viewport
                    start: "top bottom", 
                    // End when the NEXT card has entered significantly
                    endTrigger: nextCard || card,
                    end: nextCard ? "top 20%" : "bottom top-=500",
                    scrub: 1,
                }
            });

            tl.fromTo(card, 
                { 
                    y: 250, 
                    rotation: i % 2 === 0 ? -8 : 8,
                    opacity: 0,
                    scale: 0.85
                },
                { 
                    y: 0, 
                    rotation: 0,
                    opacity: 1,
                    scale: 1,
                    duration: 0.25, // Entry phase
                    ease: "power2.out"
                }
            )
            // It will now stay "sticky" due to CSS 'sticky top-32'
            // We just wait for the right moment to trigger the exit
            .to(card, {
                y: -600, // Accelerated exit
                rotation: i % 2 === 0 ? 5 : -5,
                opacity: 0,
                duration: 0.35, // Exit phase
                ease: "power2.in"
            }, "+=0.5"); // The hold duration
        });

        gsap.utils.toArray('.list-row').forEach((row, i) => {
            gsap.from(row, {
                scrollTrigger: { trigger: row, start: "top 90%" },
                opacity: 0, y: 20, duration: 1, delay: i * 0.1, ease: "power2.out"
            });
        });



        // ─── LANGUAGE SYNC FOR HERO TAGLINE ───────────────────────────
        function syncTaglineWithLang() {
            const currentLang = (window.__i18n && window.__i18n.getCurrent)
                ? window.__i18n.getCurrent()
                : (localStorage.getItem('SINEMAKU_LANG') || 'id');

            document.querySelectorAll('.tagline-container').forEach(el => {
                el.style.display = (el.dataset.taglineLang === currentLang) ? 'block' : 'none';
            });
        }

        if (window.__langToggle) {
            const oldToggle = window.__langToggle;
            window.__langToggle = function () {
                oldToggle();
                syncTaglineWithLang();
            };
        }

        syncTaglineWithLang();

        // ─── CUSTOM CURSOR LOGIC ──────────────────────────────────────
        (function() {
            const cursorRing = document.getElementById('cursor-ring');
            const cursorDot = document.getElementById('cursor-dot');
            if(!cursorRing || !cursorDot) return;

            let mouseX = window.innerWidth / 2;
            let mouseY = window.innerHeight / 2;
            let ringX = mouseX;
            let ringY = mouseY;
            let bgX = mouseX;
            let bgY = mouseY;

            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                gsap.to(cursorDot, { x: mouseX, y: mouseY, duration: 0.1, ease: "none" });
            });

            gsap.ticker.add(() => {
                // Ring interpolation
                ringX += (mouseX - ringX) * 0.15;
                ringY += (mouseY - ringY) * 0.15;
                gsap.set(cursorRing, { x: ringX, y: ringY });

                // Background gradient interpolation (smoother/slower)
                bgX += (mouseX - bgX) * 0.05;
                bgY += (mouseY - bgY) * 0.05;
                document.body.style.setProperty('--mx', (bgX / window.innerWidth * 100) + '%');
                document.body.style.setProperty('--my', (bgY / window.innerHeight * 100) + '%');
            });

            function bindHovers() {
                const hoverTargets = document.querySelectorAll('.hover-target, a, button');
                hoverTargets.forEach(target => {
                    if (target.dataset.cursorBound) return;
                    target.dataset.cursorBound = "true";
                    
                    target.addEventListener('mouseenter', () => {
                        gsap.to(cursorRing, {
                            width: 60, height: 60,
                            backgroundColor: "rgba(255, 177, 80, 0.15)",
                            duration: 0.4, ease: "power2.out"
                        });
                    });
                    target.addEventListener('mouseleave', () => {
                        gsap.to(cursorRing, {
                            width: 30, height: 30,
                            backgroundColor: "transparent",
                            duration: 0.4, ease: "power2.out"
                        });
                    });
                });
            }
            bindHovers();
            // Re-bind occasionally if dynamic content
            setTimeout(bindHovers, 1000);
        })();
    </script>
</body>

</html>