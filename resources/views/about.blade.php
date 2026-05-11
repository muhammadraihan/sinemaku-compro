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
                            orange: '#F36B21', // Autumn Leaf
                            navy: '#22397A',   // Regal Navy
                        },
                        shade: {
                            1: '#F36B21',
                            2: '#0E1633',
                            3: '#040827',
                        },
                        tint: {
                            1: '#FFE4D9', // Orange tint
                            2: '#8E95B7', // Navy tint
                            3: '#FFF6F9', // Background cream
                        }
                    },
                    fontFamily: {
                        serif: ['var(--brand-serif)', 'serif'],
                        sans: ['Helvetica', 'Arial', 'sans-serif'],
                        peckham: ['PeckhamPress', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    @php
    $brandSerif = "'Instrument Serif', serif";
    @endphp

    <style>
        @font-face {
            font-family: 'PeckhamPress';
            src: url('{{ asset('fonts/PeckhamPress.otf') }}') format('opentype');
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Instrument Serif';
            src: url('{{ asset('fonts/instrument-serif/InstrumentSerif-Regular.ttf') }}') format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: 'Instrument Serif';
            src: url('{{ asset('fonts/instrument-serif/InstrumentSerif-Italic.ttf') }}') format('truetype');
            font-weight: 400;
            font-style: italic;
            font-display: swap;
        }

        .font-serif,
        .font-serif * {
            font-family: {!! $brandSerif !!} !important;
        }
    </style>

    <!-- Iconify -->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <!-- GSAP Scripts (Moved to head for earlier availability) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <style>
        ::selection {
            background-color: #F36B21;
            color: #FFF6F9;
        }

        body {
            background-color: #FFF6F9;
            color: #22397A;
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
                    ellipse 50vw 50vh at var(--mx, 25%) var(--my, 55%),
                    rgba(243, 107, 33, 0.4) 0%,
                    transparent 60%
                );
            filter: blur(80px);
            opacity: 0.5;
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
            opacity: 0.05;
        }

        @keyframes float-blob-1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            40%       { transform: translate(4%, 3%) scale(1.06); }
            70%       { transform: translate(-3%, 5%) scale(0.96); }
        }

        #leak-1 {
            background: radial-gradient(circle, #F36B21 0%, transparent 70%);
            animation: float-blob-1 18s ease-in-out infinite;
        }

        /* ── TYPOGRAPHY & LAYOUT ── */
        .vertical-text {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
        }

        .hairline-border {
            border-color: rgba(34, 57, 122, 0.1);
        }

        /* ── CUSTOM CURSOR (EDITORIAL RING) ── */
        #cursor-ring {
            position: fixed;
            top: 0;
            left: 0;
            width: 30px;
            height: 30px;
            border: 1px solid #F36B21;
            border-radius: 50%;
            pointer-events: none;
            z-index: 999999;
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s, background-color 0.3s;
            mix-blend-mode: multiply;
        }

        #cursor-dot {
            position: fixed;
            top: 0;
            left: 0;
            width: 8px;
            height: 8px;
            background-color: transparent;
            backdrop-filter: invert(1) grayscale(1) contrast(100);
            border-radius: 50%;
            pointer-events: none;
            z-index: 1000000;
            transform: translate(-50%, -50%);
        }

        /* ── SLIDER HERO STYLES ── */
        .hero-slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        .hero-slide.active {
            opacity: 1;
        }
        .hero-overlay {
            background: linear-gradient(to bottom, rgba(243, 107, 33, 0.4), rgba(4, 8, 39, 0.6));
        }
    </style>
</head>

<body class="font-sans">

    <!-- Interactive Gradient Background -->
    <div id="interactive-bg"></div>

    <!-- Efek Grain & Light Leak Global -->
    <div class="cinematic-grain"></div>
    <div id="leak-1" class="light-leak w-[50vw] h-[50vw] top-[-10vw] left-[-10vw]"></div>

    <!-- Custom Cursor -->
    <div id="cursor-ring"></div>
    <div id="cursor-dot"></div>

    <!-- ── MINIMALIST HEADER ── -->
    @include('partials.navbar')

    <!-- 1. EDITORIAL HERO SECTION -->
    <section id="hero-section" class="relative w-full h-[100svh] overflow-hidden z-10 bg-brand-navy">
        @php
            $heroImage = $settings['about_hero_image'] ?? 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=2000&auto=format&fit=crop';
        @endphp
        <div class="absolute inset-0">
            <img src="{{ asset($heroImage) }}" alt="Sinemaku Hero" class="w-full h-full object-cover">
            <!-- Intensive Editorial Orange Overlays -->
            <div class="absolute inset-0 bg-[#F36B21] opacity-60 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-[#F36B21] opacity-30 mix-blend-color"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#F36B21]/10 to-brand-orange/40"></div>
        </div>

        {{-- Hero Content Overlay --}}
        <div class="relative z-30 w-full h-full flex flex-col justify-center px-4 md:px-12 text-white">
            <div class="w-full flex flex-col items-center">
                <h1 class="hero-reveal grid grid-cols-[max-content_max-content] gap-x-2 md:gap-x-6 gap-y-0 md:gap-y-1 items-baseline pointer-events-none drop-shadow-sm">
                    <!-- Row 1: HERE Comes -->
                    <span class="font-peckham text-[10vw] md:text-[9.5vw] text-white uppercase leading-[0.75] tracking-tighter text-right">HERE</span>
                    
                    <span class="font-serif not-italic text-[10vw] md:text-[9.5vw] text-white leading-[0.75]">Comes</span>

                    <!-- Row 2: (Empty), The FUN. -->
                    <span></span>

                    <div class="flex items-baseline gap-x-2 md:gap-x-5">
                        <span class="font-serif not-italic text-[10vw] md:text-[9.5vw] text-white leading-[0.75]">The</span>
                        <span class="font-peckham text-[10vw] md:text-[9.5vw] text-white uppercase leading-[0.75] tracking-tighter">FUN.</span>
                    </div>
                </h1>
            </div>
        </div>
    </section>

    <!-- 2. MANIFESTO (MUSEUM LAYOUT) -->
    <section id="manifesto" class="pt-8 pb-[40vh] px-8 md:px-16 z-10 relative">
        <div class="border-t hairline-border pt-12 flex flex-col md:flex-row gap-12 md:gap-32">

            <!-- Section Marker -->
            <div class="w-full md:w-1/12 manifesto-marker">
                <span class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-orange block mb-4">
                    01 — Misi
                </span>
            </div>

            <!-- Content Area -->
            <div class="w-full md:w-11/12 flex flex-col gap-24">
                <h2
                    class="font-serif text-4xl md:text-6xl lg:text-7xl leading-[1.1] text-brand-deepbreath tracking-tight max-w-4xl manifesto-title split-text">
                    @php
                        $defaultIdHeading = 'Sinemaku Pictures hadir untuk memberdayakan generasi baru pencerita dan mengubah lanskap perfilman Indonesia.';
                        $settings['about_identity_heading'] = isset($settings['about_identity_heading']) ? $settings['about_identity_heading'] : $defaultIdHeading;
                        $settings['about_identity_heading_en'] = isset($settings['about_identity_heading_en']) ? $settings['about_identity_heading_en'] : 'Sinemaku Pictures is here to empower a new generation of storytellers and change the landscape of Indonesian cinema.';
                    @endphp
                    @i18n($settings, 'about_identity_heading')
                </h2>

                <div class="flex flex-col md:flex-row gap-16 md:gap-32 w-full md:w-4/5 ml-auto">
                    <div class="flex-1 manifesto-col-1">
                        <span class="font-serif italic text-3xl text-brand-orange mb-6 block">
                            @php
                                $settings['about_studio_label'] = isset($settings['about_studio_label']) ? $settings['about_studio_label'] : 'Company.';
                                $settings['about_studio_label_en'] = isset($settings['about_studio_label_en']) ? $settings['about_studio_label_en'] : 'Company.';
                            @endphp
                            @i18n($settings, 'about_studio_label')
                        </span>
                        <p class="font-sans text-sm md:text-base font-light leading-loose text-brand-deepbreath/80 split-text">
                            @php
                                $defaultStudioBody = 'Pelajari bagaimana Sinemaku beroperasi. Jelajahi identitas kami, pendekatan kami, dan peran kami dalam membina sineas muda untuk ekosistem film Indonesia.';
                                $settings['about_studio_body'] = isset($settings['about_studio_body']) ? $settings['about_studio_body'] : $defaultStudioBody;
                                $settings['about_studio_body_en'] = isset($settings['about_studio_body_en']) ? $settings['about_studio_body_en'] : 'Learn how Sinemaku operates. Explore our identity, our approach, and our role in nurturing young filmmakers for the Indonesian film ecosystem.';
                            @endphp
                            @i18n($settings, 'about_studio_body')
                        </p>
                    </div>
                    <div class="flex-1 manifesto-col-2">
                        <span class="font-serif italic text-3xl text-brand-orange mb-6 block">Culture.</span>
                        <p class="font-sans text-sm md:text-base font-light leading-loose text-brand-deepbreath/80 split-text">
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
    <section class="secondary-photo-section relative w-full h-[60vh] md:h-[75vh] overflow-hidden z-10 mt-24">
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

    <!-- 3. THE CREW (HORIZONTAL PAN GRID) -->
    <section id="crew" class="py-32 z-10 relative max-w-[100vw] overflow-hidden">
        <div class="w-full">
            <div class="border-t hairline-border pt-12 flex flex-col md:flex-row gap-12 md:gap-32 mb-24 px-8 md:px-16">
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

            <!-- Alternating Crew Grid: odd rows = 2 full, even rows = ½+1+½ -->
            @php
                $crewMembers = collect($settings)
                    ->filter(fn($v, $k) => str_starts_with($k, 'about_team_image_') && !empty($v))
                    ->map(function ($v, $k) use ($settings) {
                        $id = str_replace('about_team_image_', '', $k);
                        return [
                            'img'   => $v,
                            'name'  => $settings["about_team_name_$id"] ?? ($id == 1 ? 'Prilly Latuconsina' : 'Sinemaku Crew'),
                            'role'  => $settings["about_team_role_$id"] ?? ($settings["about_team_role_{$id}_en"] ?? ($id == 1 ? 'Founder / Producer' : 'Team Member')),
                            'index' => $id,
                        ];
                    })
                    ->sortBy('index')
                    ->values()
                    ->toArray();

                if (empty($crewMembers)) {
                    $defaultNames = ['Prilly Latuconsina', 'Umar Shahab', 'Monty Tiwa', 'Yahni Damayanti', 'Sinemaku Crew'];
                    $defaultRoles = ['Founder / Producer', 'Founder / Director', 'Creative Director', 'Producer', 'Team Member'];
                    for ($i = 1; $i <= 5; $i++) {
                        $crewMembers[] = [
                            'img'   => "photo/about_crew_$i.png",
                            'name'  => $defaultNames[$i - 1] ?? 'Sinemaku Crew',
                            'role'  => $defaultRoles[$i - 1] ?? 'Team Member',
                            'index' => $i,
                        ];
                    }
                }

                // Chunk into alternating rows: 2, 3, 2, 3 ...
                $rows    = [];
                $offset  = 0;
                $rowNum  = 0;
                while ($offset < count($crewMembers)) {
                    $take    = ($rowNum % 2 === 0) ? 2 : 3;
                    $chunk   = array_slice($crewMembers, $offset, $take);
                    if (!empty($chunk)) $rows[] = ['type' => $rowNum % 2, 'items' => $chunk];
                    $offset += $take;
                    $rowNum++;
                }
            @endphp

            {{-- CSS: crew gap variable → spacing from edge = gap between images --}}
            <style>
                :root { --cg: 16px; }

                /* Full image width based on Row 2 filling 100vw with 4 gaps */
                /* Row 2: gap + 0.5W + gap + W + gap + 0.5W + gap = 2W + 4cg = 100vw */
                .crew-row-container {
                    --fw: calc((100vw - (4 * var(--cg))) / 2);
                    --hw: calc(var(--fw) / 2);
                }

                .crew-img-full { width: var(--fw); flex-shrink: 0; }
                .crew-img-half { width: var(--hw); flex-shrink: 0; }

                @media (max-width: 768px) {
                    :root { --cg: 8px; }
                }
            </style>

            <div class="w-full overflow-hidden flex flex-col crew-row-container" style="gap: var(--cg);">
                @foreach($rows as $row)
                    @if($row['type'] === 0)
                        {{-- ODD ROW: 2 full images, centered --}}
                        <div class="flex w-full justify-center" style="height: clamp(200px, 26vw, 420px); gap: var(--cg);">
                            @foreach($row['items'] as $member)
                                <div class="relative group cursor-none hover-target overflow-hidden rounded-xl crew-img-full">
                                    <img src="{{ asset($member['img']) }}"
                                         class="w-full h-full object-cover transition-all duration-700"
                                         alt="{{ $member['name'] }}">
                                    <div class="absolute inset-0 bg-brand-deepbreath/90 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                        <div class="text-center px-8">
                                            <h3 class="font-serif text-2xl md:text-5xl text-white leading-none translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                                {{ $member['name'] }}
                                            </h3>
                                            <span class="block mt-3 font-sans text-[10px] tracking-[0.3em] uppercase text-brand-orange translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100">
                                                {{ $member['role'] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        {{-- EVEN ROW: ½ | 1 | ½ images, centered to fill 100vw with gaps --}}
                        <div class="flex w-full justify-center" style="height: clamp(200px, 26vw, 420px); gap: var(--cg);">
                            @foreach($row['items'] as $i => $member)
                                <div class="relative group cursor-none hover-target overflow-hidden rounded-xl {{ ($i == 1) ? 'crew-img-full' : 'crew-img-half' }}">
                                    <img src="{{ asset($member['img']) }}"
                                         class="w-full h-full object-cover transition-all duration-700"
                                         alt="{{ $member['name'] }}">
                                    <div class="absolute inset-0 bg-brand-deepbreath/90 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                        <div class="text-center px-8">
                                            <h3 class="font-serif text-xl md:text-4xl text-white leading-none translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                                {{ $member['name'] }}
                                            </h3>
                                            <span class="block mt-3 font-sans text-[10px] tracking-[0.3em] uppercase text-brand-orange translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100">
                                                {{ $member['role'] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- 4. WHAT WE DO (MODERN GRID) -->
    <section class="py-32 px-8 md:px-16 z-10 relative">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-24">
                <span class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-orange block mb-6">
                    @php
                        $settings['about_wwd_eyebrow'] = $settings['about_wwd_eyebrow'] ?? '03 — Fokus';
                        $settings['about_wwd_eyebrow_en'] = $settings['about_wwd_eyebrow_en'] ?? '03 — Focus';
                    @endphp
                    @i18n($settings, 'about_wwd_eyebrow')
                </span>
                <h2 class="font-serif text-5xl md:text-7xl text-brand-deepbreath max-w-4xl mx-auto leading-tight">
                    @php
                        $settings['about_wwd_heading'] = $settings['about_wwd_heading'] ?? 'Lebih dari sekadar menciptakan karya.';
                        $settings['about_wwd_heading_en'] = $settings['about_wwd_heading_en'] ?? 'More than just creating works.';
                    @endphp
                    @i18n($settings, 'about_wwd_heading')
                </h2>
            </div>

            <!-- Grid -->
            <div id="wwd-grid" class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                @php
                    $wwdItems = [
                        [
                            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/></svg>',
                            'title_key' => 'about_values_1_title',
                            'body_key' => 'about_values_1_body',
                            'default_title' => 'Film & Seri Web',
                            'default_title_en' => 'Film & Web Series',
                            'default_body' => 'Estetika visual yang menantang batas-batas konvensional.',
                            'default_body_en' => 'Visual aesthetics that challenge conventional boundaries.'
                        ],
                        [
                            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
                            'title_key' => 'about_values_2_title',
                            'body_key' => 'about_values_2_body',
                            'default_title' => 'Tayangan Televisi',
                            'default_title_en' => 'Television Shows',
                            'default_body' => 'Kisah hangat untuk ruang keluarga yang dekat dengan realitas.',
                            'default_body_en' => 'Warm stories for the family room that are close to reality.'
                        ],
                        [
                            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                            'title_key' => 'about_values_3_title',
                            'body_key' => 'about_values_3_body',
                            'default_title' => 'Komunitas & Event',
                            'default_title_en' => 'Community & Events',
                            'default_body' => 'Rantai penghubung antarsineas lewat Sinemaku Day.',
                            'default_body_en' => 'Connecting filmmakers through Sinemaku Day.'
                        ]
                    ];
                @endphp

                @foreach($wwdItems as $item)
                    <div class="bg-white/40 backdrop-blur-sm border border-white/30 p-10 md:p-12 rounded-xl group hover:bg-white/80 transition-[background-color,box-shadow] duration-500 hover:shadow-2xl reveal-card">
                        <div class="w-14 h-14 bg-brand-deepbreath/5 rounded-full flex items-center justify-center text-brand-deepbreath mb-8 group-hover:bg-brand-orange group-hover:text-white transition-colors duration-500">
                            {!! $item['icon'] !!}
                        </div>
                        <h3 class="font-serif text-2xl md:text-3xl text-brand-deepbreath mb-4">
                            @php
                                $settings[$item['title_key']] = $settings[$item['title_key']] ?? $item['default_title'];
                                $settings[$item['title_key'].'_en'] = $settings[$item['title_key'].'_en'] ?? $item['default_title_en'];
                            @endphp
                            @i18n($settings, $item['title_key'])
                        </h3>
                        <p class="font-sans text-sm md:text-base font-light leading-relaxed text-brand-deepbreath/60">
                            @php
                                $settings[$item['body_key']] = $settings[$item['body_key']] ?? $item['default_body'];
                                $settings[$item['body_key'].'_en'] = $settings[$item['body_key'].'_en'] ?? $item['default_body_en'];
                            @endphp
                            @i18n($settings, $item['body_key'])
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('components.footer')


    <script>
        // GSAP is already loaded in the head
        gsap.registerPlugin(ScrollTrigger);



        // ─── REVEAL ANIMATIONS ──────────────────────────────────────────
        // Initial Hero Reveal
        gsap.from(".hero-reveal", {
            y: 60,
            opacity: 0,
            duration: 2,
            stagger: 0.3,
            ease: "expo.out",
            delay: 0.5
        });

        // Company Section Reveal
        gsap.from("#company-section .hero-reveal", {
            scrollTrigger: {
                trigger: "#company-section",
                start: "top 80%",
            },
            y: 50,
            opacity: 0,
            duration: 1.5,
            stagger: 0.2,
            ease: "power3.out"
        });

        // People Section Reveal
        gsap.from("#people-section .group", {
            scrollTrigger: {
                trigger: "#people-section",
                start: "top 70%",
            },
            y: 100,
            opacity: 0,
            duration: 1.5,
            stagger: 0.15,
            ease: "power4.out"
        });

        // What We Do Reveal (If still present)
        if (document.querySelector('.reveal-card')) {
            gsap.from('.reveal-card', {
                scrollTrigger: {
                    trigger: '.reveal-card',
                    start: "top 85%",
                },
                y: 40,
                opacity: 0,
                duration: 1.2,
                stagger: 0.2,
                ease: "power3.out"
            });
        }

        // ─── CUSTOM CURSOR & INTERACTIVE BG ──────────────────────────────
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

                // Background gradient interpolation
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
                            backgroundColor: "rgba(243, 107, 33, 0.1)",
                            duration: 0.4, ease: "power2.out"
                        });
                        gsap.to(cursorDot, { scale: 0.5, duration: 0.2 });
                    });
                    target.addEventListener('mouseleave', () => {
                        gsap.to(cursorRing, {
                            width: 30, height: 30,
                            backgroundColor: "transparent",
                            duration: 0.4, ease: "power2.out"
                        });
                        gsap.to(cursorDot, { scale: 1, duration: 0.2 });
                    });
                });
            }
            bindHovers();
            setInterval(bindHovers, 2000);
        })();
    </script>
</body>

</html>
