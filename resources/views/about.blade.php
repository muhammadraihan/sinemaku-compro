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
            background-color: #F1F1F1;
            color: #25225E;
            margin: 0;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            cursor: none;
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
            filter: blur(150px);
            opacity: 0.15;
            pointer-events: none;
            z-index: 0;
            transition: transform 2s cubic-bezier(0.23, 1, 0.32, 1);
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

        ::selection {
            background-color: #25225E;
            color: #F1F1F1;
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
    </style>
</head>

<body class="font-sans">

    <!-- Efek Grain & Light Leak Global -->
    <div class="cinematic-grain"></div>
    <div id="leak-1" class="light-leak w-[50vw] h-[50vw] bg-brand-orange top-[-10vw] left-[-10vw]"></div>
    <div id="leak-2" class="light-leak w-[40vw] h-[40vw] bg-shade-1 bottom-10 right-[-10vw]"></div>

    <!-- Custom Cursor -->
    <div id="cursor-ring"></div>
    <div id="cursor-dot"></div>

    <!-- ── MINIMALIST HEADER ── -->
    <nav
        class="fixed top-0 left-0 w-full z-[300] flex justify-between items-start px-8 md:px-16 py-10 mix-blend-multiply text-brand-deepbreath">
        <a href="{{ url('/') }}"
            class="font-serif text-3xl tracking-tight leading-none cursor-none relative z-10 hover-target">
            Sinemaku<br>Pictures.
        </a>

        <div class="flex gap-16 font-sans text-[10px] tracking-[0.25em] uppercase font-bold text-brand-deepbreath/60">
            <div class="hidden md:flex flex-col gap-2">
                <span>Est. 2020</span>
                <span>Jakarta, ID</span>
            </div>
            <button id="menu-btn"
                class="hover:text-brand-orange transition-colors cursor-none hover-target relative z-10">
                [ Menu ]
            </button>
        </div>
    </nav>

    <!-- FULLSCREEN MENU OVERLAY -->
    <div id="fullscreen-menu"
        class="fixed inset-0 bg-tint-3 z-[400] flex flex-col justify-center px-8 md:px-32 transform -translate-y-full transition-transform duration-1000 ease-[cubic-bezier(0.85,0,0.15,1)]">
        <button id="close-menu-btn"
            class="absolute top-10 right-8 md:right-16 font-sans text-[10px] tracking-[0.25em] uppercase font-bold text-brand-deepbreath hover:text-brand-orange cursor-none hover-target">
            [ Close ]
        </button>

        <div class="flex flex-col space-y-2 font-serif text-6xl md:text-8xl text-brand-deepbreath">
            <a href="{{ url('/') }}"
                class="hover:italic hover:text-brand-orange transition-all cursor-none hover-target origin-left inline-block w-max">Home</a>
            <a href="#manifesto"
                class="hover:italic hover:text-brand-orange transition-all cursor-none hover-target origin-left inline-block w-max"
                onclick="document.getElementById('close-menu-btn').click();">Manifesto</a>
            <a href="#crew"
                class="hover:italic hover:text-brand-orange transition-all cursor-none hover-target origin-left inline-block w-max"
                onclick="document.getElementById('close-menu-btn').click();">The Crew</a>
            <a href="#contact"
                class="hover:italic hover:text-brand-orange transition-all cursor-none hover-target origin-left inline-block w-max"
                onclick="document.getElementById('close-menu-btn').click();">Contact</a>
        </div>
    </div>

    <!-- 1. EDITORIAL HERO SECTION -->
    <section class="relative w-full min-h-[100svh] flex flex-col justify-center px-8 md:px-16 pt-32 pb-16 z-10">
        <div class="flex flex-col md:flex-row justify-between items-end gap-12 w-full max-w-[1600px] mx-auto">

            <!-- Huge Typography -->
            <div class="w-full md:w-3/4">
                @php
                    $titleId = $settings['about_hero_title'] ?? "Here Comes\nThe Fun.";
                    $titleEn = $settings['about_hero_title_en'] ?? "Here Comes\nThe Fun.";

                    if (!function_exists('renderEditorialTagline')) {
                        function renderEditorialTagline($title)
                        {
                            $lines = explode("\n", str_replace(["<br />", "<br>"], "\n", $title));
                            $html = '';
                            if (count($lines) > 0) {
                                $html .= trim($lines[0]) . "<br>";
                            }
                            if (count($lines) > 1) {
                                $html .= '<span class="italic text-brand-orange pl-[5vw]">' . trim($lines[1]) . '</span>';
                            }
                            return $html;
                        }
                    }
                @endphp
                <h1
                    class="font-serif text-[15vw] md:text-[12vw] leading-[0.8] text-brand-deepbreath tracking-tighter m-0 hero-reveal">
                    <span class="tagline-container tagline-id" data-tagline-lang="id">
                        {!! renderEditorialTagline($titleId) !!}
                    </span>
                    <span class="tagline-container tagline-en" data-tagline-lang="en" style="display:none;">
                        {!! renderEditorialTagline($titleEn) !!}
                    </span>
                </h1>
            </div>

            <!-- Context Text -->
            <div class="w-full md:w-1/4 pb-4 hero-reveal">
                @php
                    $subId = $settings['about_hero_subtitle'] ?? 'Sebuah ruang bermain bagi generasi baru pencerita yang berani mendobrak tradisi kaku demi mengubah lanskap perfilman Indonesia.';
                    $subEn = $settings['about_hero_subtitle_en'] ?? 'A playground for a new generation of storytellers who dare to break rigid traditions to change the landscape of Indonesian cinema.';
                @endphp
                <p class="font-sans text-xs md:text-sm font-light leading-relaxed text-brand-deepbreath/70">
                    <span class="dynamic-i18n" data-lang-id="{{ $subId }}"
                        data-lang-en="{{ $subEn }}">{{ $subId }}</span>
                </p>
                <div
                    class="mt-8 pt-4 border-t hairline-border flex justify-between font-sans text-[9px] tracking-widest uppercase text-brand-deepbreath/50">
                    <span>Scroll to explore</span>
                    <span>↓</span>
                </div>
            </div>
        </div>

        <!-- Hero Cinematic Image -->
        <div class="mt-16 w-full flex justify-center hero-reveal max-w-[1600px] mx-auto">
            <div class="editorial-image-container w-full md:w-[60%] aspect-[21/9] bg-tint-2/30">
                <img src="{{ isset($settings['about_hero_image']) ? asset($settings['about_hero_image']) : 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=2000&auto=format&fit=crop' }}"
                    alt="Cinematic Setup" class="editorial-image para-img">
            </div>
        </div>
    </section>

    <!-- 2. MANIFESTO (MUSEUM LAYOUT) -->
    <section id="manifesto" class="py-32 px-8 md:px-16 z-10 relative bg-tint-3">
        <div class="border-t hairline-border pt-12 flex flex-col md:flex-row gap-12 md:gap-32 max-w-[1600px] mx-auto">

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

    <!-- 3. THE CREW (ASYMMETRICAL PRINT GRID) -->
    <section id="crew" class="py-32 px-8 md:px-16 z-10 relative bg-tint-3">
        <div class="max-w-[1600px] mx-auto">
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
                        @php
                            $settings['about_team_heading'] = isset($settings['about_team_heading']) ? $settings['about_team_heading'] : 'Orang-orang di<br>balik <span class="italic text-brand-orange">kamera.</span>';
                            $settings['about_team_heading_en'] = isset($settings['about_team_heading_en']) ? $settings['about_team_heading_en'] : 'The people<br>behind the <span class="italic text-brand-orange">camera.</span>';
                        @endphp
                        <span class="dynamic-i18n" data-lang-id="{!! $settings['about_team_heading'] !!}"
                            data-lang-en="{!! $settings['about_team_heading_en'] !!}">{!! $settings['about_team_heading'] !!}</span>
                    </h2>
                </div>
            </div>

            <!-- Print/Editorial Grid Container -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-y-24 md:gap-x-12 relative pb-20">

                <!-- Prilly L. -->
                <div
                    class="md:col-start-6 md:col-span-6 flex items-end gap-6 group hover-target cursor-none reveal-image">
                    <div
                        class="vertical-text font-sans text-[10px] tracking-[0.3em] uppercase text-brand-deepbreath/40 pb-4">
                        Founder / Producer</div>
                    <div class="w-full editorial-image-container aspect-[3/4] bg-tint-2/20">
                        <img src="{{ isset($settings['about_team_image_1']) ? asset($settings['about_team_image_1']) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=1200&auto=format&fit=crop' }}"
                            class="editorial-image para-img" alt="Prilly L.">
                    </div>
                    <h3
                        class="absolute top-1/2 left-[-10%] md:left-auto md:right-[40%] transform -translate-y-1/2 font-serif text-7xl md:text-9xl text-tint-3 mix-blend-difference italic opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none z-20">
                        Prilly L.</h3>
                </div>

                <!-- Crew 2 -->
                <div
                    class="md:col-start-2 md:col-span-3 flex items-end gap-4 group hover-target cursor-none mt-0 md:-mt-32 reveal-image">
                    <div
                        class="vertical-text font-sans text-[10px] tracking-[0.3em] uppercase text-brand-deepbreath/40 pb-4">
                        Director</div>
                    <div class="w-full editorial-image-container aspect-[4/5] bg-tint-2/20">
                        <img src="{{ isset($settings['about_team_image_2']) ? asset($settings['about_team_image_2']) : 'https://images.unsplash.com/photo-1499996860823-5214fcc65f8f?q=80&w=800&auto=format&fit=crop' }}"
                            class="editorial-image para-img" alt="Crew">
                    </div>
                </div>

                <!-- Crew 3 -->
                <div
                    class="md:col-start-4 md:col-span-5 flex items-start gap-4 group hover-target cursor-none mt-12 md:mt-0 reveal-image">
                    <div class="w-full editorial-image-container aspect-square bg-tint-2/20">
                        <img src="{{ isset($settings['about_team_image_3']) ? asset($settings['about_team_image_3']) : 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=1000&auto=format&fit=crop' }}"
                            class="editorial-image para-img" alt="Crew">
                    </div>
                    <div
                        class="vertical-text font-sans text-[10px] tracking-[0.3em] uppercase text-brand-deepbreath/40 pt-4">
                        Cinematographer</div>
                </div>

                <!-- Crew 4 -->
                <div
                    class="md:col-start-8 md:col-span-5 flex items-end gap-4 group hover-target cursor-none mt-12 md:-mt-40 reveal-image">
                    <div
                        class="vertical-text font-sans text-[10px] tracking-[0.3em] uppercase text-brand-deepbreath/40 pb-4">
                        Art Director</div>
                    <div class="w-full editorial-image-container aspect-[16/9] bg-tint-2/20">
                        <img src="{{ isset($settings['about_team_image_4']) ? asset($settings['about_team_image_4']) : 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=800&auto=format&fit=crop' }}"
                            class="editorial-image para-img" alt="Crew">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. WHAT WE DO (MINIMAL TABLE) -->
    <section class="py-32 px-8 md:px-16 z-10 relative bg-tint-3">
        <div class="max-w-[1600px] mx-auto border-t hairline-border pt-12 flex flex-col md:flex-row gap-12 md:gap-32">
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
                        class="group flex flex-col md:flex-row justify-between items-start md:items-center py-10 md:py-16 border-b hairline-border cursor-none hover-target list-row">
                        <h3
                            class="font-serif text-5xl md:text-7xl text-brand-deepbreath group-hover:italic group-hover:text-brand-orange transition-all duration-500">
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
                        class="group flex flex-col md:flex-row justify-between items-start md:items-center py-10 md:py-16 border-b hairline-border cursor-none hover-target list-row">
                        <h3
                            class="font-serif text-5xl md:text-7xl text-brand-deepbreath group-hover:italic group-hover:text-brand-orange transition-all duration-500">
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
                        class="group flex flex-col md:flex-row justify-between items-start md:items-center py-10 md:py-16 border-b hairline-border cursor-none hover-target list-row">
                        <h3
                            class="font-serif text-5xl md:text-7xl text-brand-deepbreath group-hover:italic group-hover:text-brand-orange transition-all duration-500">
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

    <!-- FOOTER (COLOPHON STYLE) -->
    <footer id="contact" class="bg-tint-3 pt-32 pb-12 px-8 md:px-16 z-20 relative">
        <div class="max-w-[1600px] mx-auto border-t hairline-border pt-16 flex flex-col items-center text-center mb-32">
            <span
                class="font-sans text-[10px] tracking-[0.3em] uppercase font-bold text-brand-deepbreath/40 mb-8 block">
                @php
                    $collabEyebrow = $settings['about_collab_eyebrow'] ?? 'Kolaborasi';
                    $collabEyebrowEn = $settings['about_collab_eyebrow_en'] ?? 'Collaboration';
                @endphp
                <span class="dynamic-i18n" data-lang-id="{{ $collabEyebrow }}"
                    data-lang-en="{{ $collabEyebrowEn }}">{{ $collabEyebrow }}</span>
            </span>
            <a href="mailto:hello@sinemakupictures.com"
                class="font-serif text-5xl md:text-8xl text-brand-deepbreath hover:italic hover:text-brand-orange transition-all duration-500 cursor-none hover-target">
                hello@sinemakupictures.com
            </a>
        </div>

        <div
            class="max-w-[1600px] mx-auto w-full flex flex-col md:flex-row justify-between items-end gap-12 border-t hairline-border pt-8">
            <div
                class="flex gap-8 md:gap-16 font-sans text-[9px] font-bold uppercase tracking-[0.2em] text-brand-deepbreath/60">
                <a href="#" class="hover:text-brand-orange transition-colors cursor-none hover-target">Instagram</a>
                <a href="#" class="hover:text-brand-orange transition-colors cursor-none hover-target">YouTube</a>
                <a href="#" class="hover:text-brand-orange transition-colors cursor-none hover-target">Twitter</a>
            </div>

            <div class="flex flex-col items-end gap-2 text-right">
                <h1 class="font-serif text-2xl text-brand-deepbreath m-0">Sinemaku Pictures</h1>
                <span class="font-sans text-[9px] tracking-[0.2em] uppercase text-brand-deepbreath/40">© 2026 Hak Cipta
                    Dilindungi</span>
            </div>
        </div>
    </footer>

    <!-- GSAP Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <script>
        gsap.registerPlugin(ScrollTrigger);

        // 1. Editorial Custom Cursor (Ring & Dot)
        const cursorRing = document.getElementById('cursor-ring');
        const cursorDot = document.getElementById('cursor-dot');

        let mouseX = window.innerWidth / 2;
        let mouseY = window.innerHeight / 2;
        let ringX = mouseX;
        let ringY = mouseY;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;

            gsap.to(cursorDot, {
                x: mouseX,
                y: mouseY,
                duration: 0.1,
                ease: "none"
            });
        });

        gsap.ticker.add(() => {
            ringX += (mouseX - ringX) * 0.15;
            ringY += (mouseY - ringY) * 0.15;
            gsap.set(cursorRing, { x: ringX, y: ringY });
        });

        const hoverTargets = document.querySelectorAll('.hover-target, a, button');
        hoverTargets.forEach(target => {
            target.addEventListener('mouseenter', () => {
                gsap.to(cursorRing, { scale: 1.8, backgroundColor: 'rgba(255, 177, 80, 0.2)', duration: 0.3 });
                gsap.to(cursorDot, { scale: 0, duration: 0.2 });
            });
            target.addEventListener('mouseleave', () => {
                gsap.to(cursorRing, { scale: 1, backgroundColor: 'transparent', duration: 0.3 });
                gsap.to(cursorDot, { scale: 1, duration: 0.2 });
            });
        });

        // 2. Subtle Light Leak Parallax
        const leak1 = document.getElementById('leak-1');
        const leak2 = document.getElementById('leak-2');

        document.addEventListener('mousemove', (e) => {
            const x = (e.clientX / window.innerWidth - 0.5) * 100;
            const y = (e.clientY / window.innerHeight - 0.5) * 100;

            gsap.to(leak1, { x: x * 1.5, y: y * 1.5, duration: 3, ease: "power1.out" });
            gsap.to(leak2, { x: -x * 2, y: -y * 2, duration: 4, ease: "power1.out" });
        });

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

        gsap.utils.toArray('.reveal-image').forEach(img => {
            gsap.from(img, {
                scrollTrigger: { trigger: img, start: "top 85%" },
                y: 50, opacity: 0, duration: 1.5, ease: "power2.out"
            });
        });

        gsap.utils.toArray('.list-row').forEach((row, i) => {
            gsap.from(row, {
                scrollTrigger: { trigger: row, start: "top 90%" },
                opacity: 0, y: 20, duration: 1, delay: i * 0.1, ease: "power2.out"
            });
        });

        // 5. Fullscreen Menu Logic
        const menuBtn = document.getElementById('menu-btn');
        const closeMenuBtn = document.getElementById('close-menu-btn');
        const menu = document.getElementById('fullscreen-menu');
        const links = menu.querySelectorAll('a');

        menuBtn.addEventListener('click', () => {
            menu.style.transform = 'translateY(0)';
            gsap.fromTo(links,
                { y: 50, opacity: 0, skewY: 5 },
                { y: 0, opacity: 1, skewY: 0, duration: 1, stagger: 0.1, ease: "power4.out", delay: 0.4 }
            );
        });

        closeMenuBtn.addEventListener('click', () => {
            menu.style.transform = 'translateY(-100%)';
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
    </script>
</body>

</html>