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

    <!-- Swiper CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

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
        
        <!-- Background Slideshow -->
        <div class="absolute inset-0 swiper hero-swiper">
            <div class="swiper-wrapper">
                @if($heroSlides && count($heroSlides) > 0)
                    @foreach($heroSlides as $slide)
                    <div class="swiper-slide h-full">
                        <img src="{{ asset($slide->image_path) }}" alt="Sinemaku Hero" class="w-full h-full object-cover">
                    </div>
                    @endforeach
                @else
                    <div class="swiper-slide h-full">
                        <img src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=2000&auto=format&fit=crop" alt="Sinemaku Hero" class="w-full h-full object-cover">
                    </div>
                @endif
            </div>

            <!-- Intensive Editorial Orange Overlays -->
            <div class="absolute inset-0 z-10 pointer-events-none bg-[#F36B21] opacity-60 mix-blend-multiply"></div>
            <div class="absolute inset-0 z-10 pointer-events-none bg-[#F36B21] opacity-30 mix-blend-color"></div>
            <div class="absolute inset-0 z-10 pointer-events-none bg-gradient-to-b from-transparent via-[#F36B21]/10 to-brand-orange/40"></div>
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

    <!-- 2. MANIFESTO (EDITORIAL LAYOUT) -->
    <section id="manifesto" class="py-16 md:py-24 px-12 md:px-32 z-10 relative">
        <!-- Top Metadata -->
        <div class="flex justify-between items-start mb-16">
            <span class="font-peckham text-[10px] tracking-[0.2em] uppercase font-bold text-brand-orange">
                01 — Misi
            </span>
        </div>

        <!-- Big Editorial Statement -->
        <div class="w-full flex flex-col items-center text-center mb-20">
            <h2 class="manifesto-reveal flex flex-col items-center max-w-5xl mx-auto">
                @php
                    $headingId = $settings['about_identity_heading'] ?? 'SINEMAKU PICTURES hadir untuk memberdayakan generasi baru pencerita dan mengubah lanskap perfilman Indonesia.';
                    $words = explode(' ', $headingId);
                @endphp
                
                <div class="flex flex-wrap justify-center gap-x-2 md:gap-x-4 gap-y-1 md:gap-y-2 items-baseline">
                    @php
                        $rawText = $settings['about_identity_heading'] ?? '[p]SINEMAKU[/p] [p]PICTURES[/p] [s]hadir untuk[/s] [s]memberdayakan[/s] [p]GENERASI[/p] [s]baru[/s] [p]PENCERITA[/p] [s]dan[/s] [s]mengubah[/s] [p]LANSKAP[/p] [s]perfilman Indonesia.[/s]';
                        
                        // Parse [p] tags
                        $parsedText = preg_replace_callback('/\[p\](.*?)\[\/p\]/', function($matches) {
                            return '<span class="font-peckham text-[3.5vw] md:text-[3vw] text-brand-navy uppercase leading-[1.1] tracking-tighter">' . $matches[1] . '</span>';
                        }, $rawText);
                        
                        // Parse [s] tags
                        $parsedText = preg_replace_callback('/\[s\](.*?)\[\/s\]/', function($matches) {
                            return '<span class="font-serif text-[4vw] md:text-[3.5vw] text-[#8E95B7] leading-[1.1]">' . $matches[1] . '</span>';
                        }, $parsedText);
                    @endphp
                    
                    {!! $parsedText !!}
                </div>
            </h2>
        </div>

        <!-- Divider Line -->
        <div class="w-full h-[2px] bg-brand-navy/20 mb-20 max-w-[80vw] mx-auto"></div>

        <!-- Detailed Description -->
        <div class="w-full flex flex-col items-center text-center">
            <div class="max-w-xl">
                <span class="font-peckham text-2xl md:text-3xl text-brand-navy uppercase block mb-8 tracking-tighter">
                    @php
                        $studioLabel = $settings['about_studio_label'] ?? 'Company.';
                    @endphp
                    {{ strtoupper($studioLabel) }}
                </span>
                <p class="font-sans text-sm md:text-base font-light leading-relaxed text-brand-navy/70">
                    @php
                        $studioBody = $settings['about_studio_body'] ?? 'Pelajari bagaimana Sinemaku beroperasi. Jelajahi identitas kami, pendekatan kami, dan peran kami dalam membina sineas muda untuk ekosistem film Indonesia.';
                    @endphp
                    {{ $studioBody }}
                </p>
            </div>
        </div>
    </section>

    <!-- 2.5 SECONDARY CREW PHOTO (Zoom Out Masonry Grid) -->
    <style>
        :root {
            --crew-row-h: clamp(300px, 40vw, 650px);
        }
        .crew-h { height: var(--crew-row-h); }
        @media (max-width: 768px) {
            :root { --crew-row-h: 300px; }
        }
    </style>
    <section id="crew-masonry-wrapper" class="relative w-full bg-black z-10 overflow-hidden">
        <div class="crew-pin-container w-full flex flex-col items-center justify-center bg-black">
            <div class="crew-grid w-full grid grid-cols-12 gap-2 md:gap-4 p-2 md:p-4 pb-2 md:pb-4">
                @php
                    $crewMembers = collect($settings)
                        ->filter(fn($v, $k) => str_starts_with($k, 'about_team_image_') && !empty($v))
                        ->map(function ($v, $k) use ($settings) {
                            $id = str_replace('about_team_image_', '', $k);
                            return [
                                'img'   => str_starts_with($v, 'http') ? $v : asset($v),
                                'name'  => $settings["about_team_name_$id"] ?? 'Sinemaku Crew',
                                'role'  => $settings["about_team_role_$id"] ?? 'Team Member',
                                'index' => (int)$id,
                            ];
                        })
                        ->sortBy('index')
                        ->values()
                        ->toArray();

                    if(count($crewMembers) === 0) {
                        $crewMembers = [
                            ['img' => 'https://images.unsplash.com/photo-1598899134739-24c46f58b8c0?q=80&w=1000&auto=format&fit=crop', 'name' => 'Crew', 'role' => 'Role'],
                            ['img' => 'https://images.unsplash.com/photo-1601513445506-2ab0d4fb4229?q=80&w=1000&auto=format&fit=crop', 'name' => 'Crew', 'role' => 'Role'],
                            ['img' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?q=80&w=800&auto=format&fit=crop', 'name' => 'Crew', 'role' => 'Role'],
                            ['img' => 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=800&auto=format&fit=crop', 'name' => 'Crew', 'role' => 'Role'],
                            ['img' => 'https://images.unsplash.com/photo-1585150917027-eeb32aebbd3a?q=80&w=1000&auto=format&fit=crop', 'name' => 'Crew', 'role' => 'Role'],
                            ['img' => 'https://images.unsplash.com/photo-1509023464722-18d996393ca8?q=80&w=1000&auto=format&fit=crop', 'name' => 'Crew', 'role' => 'Role']
                        ];
                    }
                    
                    $top6 = $crewMembers;
                    while(count($top6) < 6) {
                        $top6 = array_merge($top6, $crewMembers);
                    }
                    $top6 = array_slice($top6, 0, 6);
                    
                    $rest = array_slice($crewMembers, 6);
                @endphp
                
                <!-- Row 1 -->
                <div class="col-span-6 crew-h rounded-xl md:rounded-3xl overflow-hidden relative group">
                    <img src="{{ $top6[0]['img'] }}" class="w-full h-full object-cover transition duration-700">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end">
                        <h3 class="font-sans text-white text-lg md:text-xl font-bold uppercase tracking-tight">{{ $top6[0]['name'] }}</h3>
                        <span class="font-serif text-brand-orange text-xs md:text-sm italic">{{ $top6[0]['role'] }}</span>
                    </div>
                </div>
                <div class="col-span-6 crew-h rounded-xl md:rounded-3xl overflow-hidden relative group">
                    <img src="{{ $top6[1]['img'] }}" class="w-full h-full object-cover transition duration-700">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end">
                        <h3 class="font-sans text-white text-lg md:text-xl font-bold uppercase tracking-tight">{{ $top6[1]['name'] }}</h3>
                        <span class="font-serif text-brand-orange text-xs md:text-sm italic">{{ $top6[1]['role'] }}</span>
                    </div>
                </div>

                <!-- Row 2 (CENTER ROW) -->
                <div class="col-span-3 crew-h rounded-xl md:rounded-3xl overflow-hidden relative group">
                    <img src="{{ $top6[2]['img'] }}" class="w-full h-full object-cover transition duration-700">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end">
                        <h3 class="font-sans text-white text-sm md:text-lg font-bold uppercase tracking-tight">{{ $top6[2]['name'] }}</h3>
                        <span class="font-serif text-brand-orange text-[10px] md:text-xs italic">{{ $top6[2]['role'] }}</span>
                    </div>
                </div>
                
                <div class="crew-center-img col-span-6 crew-h rounded-xl md:rounded-3xl overflow-hidden relative shadow-2xl">
                    @php
                        $secondaryImg = $settings['about_secondary_image'] ?? 'https://images.unsplash.com/photo-1509023464722-18d996393ca8?q=80&w=2000&auto=format&fit=crop';
                    @endphp
                    <img src="{{ asset($secondaryImg) }}" class="w-full h-full object-cover">
                    <div class="crew-overlay absolute inset-0 bg-brand-navy/60 flex flex-col items-center justify-center text-center p-4 opacity-0">
                        <h2 class="crew-text-reveal font-peckham text-white text-[5vw] md:text-[3vw] uppercase leading-none tracking-tighter shadow-sm" style="line-height: 0.9;">THE PEOPLE</h2>
                        <span class="crew-text-reveal font-serif text-white text-[3vw] md:text-[2vw] italic my-2 md:my-4 shadow-sm" style="line-height: 0.9;">behind the</span>
                        <h2 class="crew-text-reveal font-peckham text-white text-[5vw] md:text-[3vw] uppercase leading-none tracking-tighter shadow-sm" style="line-height: 0.9;">CAMERA.</h2>
                    </div>
                </div>

                <div class="col-span-3 crew-h rounded-xl md:rounded-3xl overflow-hidden relative group">
                    <img src="{{ $top6[3]['img'] }}" class="w-full h-full object-cover transition duration-700">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end">
                        <h3 class="font-sans text-white text-sm md:text-lg font-bold uppercase tracking-tight">{{ $top6[3]['name'] }}</h3>
                        <span class="font-serif text-brand-orange text-[10px] md:text-xs italic">{{ $top6[3]['role'] }}</span>
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="col-span-6 crew-h rounded-xl md:rounded-3xl overflow-hidden relative group">
                    <img src="{{ $top6[4]['img'] }}" class="w-full h-full object-cover transition duration-700">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end">
                        <h3 class="font-sans text-white text-lg md:text-xl font-bold uppercase tracking-tight">{{ $top6[4]['name'] }}</h3>
                        <span class="font-serif text-brand-orange text-xs md:text-sm italic">{{ $top6[4]['role'] }}</span>
                    </div>
                </div>
                <div class="col-span-6 crew-h rounded-xl md:rounded-3xl overflow-hidden relative group">
                    <img src="{{ $top6[5]['img'] }}" class="w-full h-full object-cover transition duration-700">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end">
                        <h3 class="font-sans text-white text-lg md:text-xl font-bold uppercase tracking-tight">{{ $top6[5]['name'] }}</h3>
                        <span class="font-serif text-brand-orange text-xs md:text-sm italic">{{ $top6[5]['role'] }}</span>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Rest of the Crew Grid -->
    @if(isset($rest) && count($rest) > 0)
    <section class="crew-rest-section w-full bg-black z-10 pb-24">
        <div class="w-full grid grid-cols-12 gap-2 md:gap-4 px-2 md:px-4 pt-0">
            @php
                $patternIndex = 0;
                $restIndex = 0;
            @endphp
            @while($restIndex < count($rest))
                @php
                    $isTwo = ($patternIndex % 2 === 0);
                    $take = $isTwo ? 2 : 3;
                    $chunk = array_slice($rest, $restIndex, $take);
                    $restIndex += $take;
                    $patternIndex++;
                @endphp
                @foreach($chunk as $member)
                    <div class="group {{ $isTwo ? 'col-span-6' : 'col-span-4' }} crew-h rounded-xl md:rounded-3xl overflow-hidden relative">
                        <img src="{{ $member['img'] }}" class="w-full h-full object-cover transition duration-700">
                        <div class="absolute bottom-0 left-0 w-full p-4 md:p-8 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end">
                            <h3 class="font-sans text-white text-xl md:text-3xl font-bold uppercase tracking-tight">{{ $member['name'] }}</h3>
                            <span class="font-serif text-brand-orange text-sm md:text-lg italic">{{ $member['role'] }}</span>
                        </div>
                    </div>
                @endforeach
            @endwhile
        </div>
    </section>
    @endif



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

        // Masonry Zoom Out Animation & Text Sequencing
        if (document.querySelector('#crew-masonry-wrapper')) {
            let crewTl = gsap.timeline({
                scrollTrigger: {
                    trigger: "#crew-masonry-wrapper",
                    start: "center center",
                    end: "+=300%", // Extended scrolling distance for multi-phase sequence
                    scrub: 1.5, // Super smooth scrub
                    pin: true // pin the wrapper itself
                }
            });

            // Phase 1: Start zoomed in, scale down to form grid
            crewTl.fromTo(".crew-grid", 
                { scale: 3.5, transformOrigin: "center center" }, 
                { scale: 1, transformOrigin: "center center", ease: "power3.inOut", duration: 1.2 }
            );

            // Phase 1b: Surrounding images subtly fade in so we don't see ugly edges during extreme zoom
            crewTl.fromTo(".crew-grid > div:not(.crew-center-img)", 
                { opacity: 0 }, 
                { opacity: 1, ease: "power3.inOut", duration: 1.2 },
                "<" // Sync exactly with Phase 1
            );

            // Phase 2: Fade in the dark overlay background to make text readable
            crewTl.to(".crew-overlay", { opacity: 1, duration: 0.3, ease: "power2.inOut" }, "+=0.1");

            // Phase 3: Staggered text reveal ("THE PEOPLE", "behind the", "CAMERA.")
            gsap.set(".crew-text-reveal", { opacity: 0, y: 40 });
            crewTl.to(".crew-text-reveal", { opacity: 1, y: 0, duration: 0.6, stagger: 0.2, ease: "power2.out" });
            
            // Add a slight blank duration at the end so it holds for a moment before unpinning
            crewTl.to({}, {duration: 0.4});
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

            // Initialize Hero Slideshow
            const heroSwiper = new Swiper('.hero-swiper', {
                effect: 'fade',
                fadeEffect: { crossFade: true },
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                speed: 500, // 0.5 detik crossfade
            });
        })();
    </script>
</body>

</html>
