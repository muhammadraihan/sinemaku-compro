@extends('layouts.app')

@section('title', 'About — Sinemaku Pictures')

@push('head')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
        ::selection {
            background-color: #F36B21;
            color: #FFF6F9;
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

        :root {
            --crew-row-h: clamp(300px, 40vw, 650px);
        }
        .crew-h { height: var(--crew-row-h); }
        @media (max-width: 768px) {
            :root { --crew-row-h: 300px; }
        }
    </style>
@endpush

@section('content')

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
    <section id="manifesto" class="py-16 md:py-24 px-12 md:px-32 z-10 relative bg-creme-leaks">
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
                    <div class="crew-overlay absolute inset-0 bg-brand-navy/60 flex flex-col items-center justify-center text-center p-4 opacity-100">
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

        @if(isset($rest) && count($rest) > 0)
        <!-- Rest of the grid (Masonry continues) -->
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
        @endif
    </section>

    @include('components.footer')

@endsection

@push('scripts')
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

        // Manifesto Section Reveal
        gsap.from(".manifesto-reveal", {
            scrollTrigger: {
                trigger: "#manifesto",
                start: "top 80%",
            },
            y: 50,
            opacity: 0,
            duration: 1.5,
            ease: "power3.out"
        });

        // Masonry Zoom In Animation & Text Fading
        if (document.querySelector('#crew-masonry-wrapper')) {
            let crewTl = gsap.timeline({
                scrollTrigger: {
                    trigger: "#crew-masonry-wrapper",
                    start: "center center",
                    end: "+=300%", 
                    scrub: 1.5, 
                    pin: true 
                }
            });

            // Start grid at normal scale, zoom in to center image (scale 3.5)
            crewTl.fromTo(".crew-grid", 
                { scale: 1, transformOrigin: "center center" }, 
                { scale: 3.5, transformOrigin: "center center", ease: "power2.inOut", duration: 1.5 }
            );

            // Other elements in the grid disappear as we zoom in
            crewTl.fromTo(".crew-grid > div:not(.crew-center-img)", 
                { opacity: 1 }, 
                { opacity: 0, ease: "power2.inOut", duration: 1.5 },
                "<"
            );

            // Ensure text and overlay start visible
            gsap.set(".crew-overlay", { opacity: 1 });
            gsap.set(".crew-text-reveal", { opacity: 1, y: 0 });

            // Fade out the text and overlay smoothly as it zooms in
            crewTl.to(".crew-text-reveal", { opacity: 0, duration: 1.2, ease: "power2.out" }, "<");
            crewTl.to(".crew-overlay", { opacity: 0, duration: 1.5, ease: "power2.inOut" }, "<");

            crewTl.to({}, {duration: 0.2});
        }

        // Initialize Hero Slideshow
        const heroSwiper = new Swiper('.hero-swiper', {
            effect: 'fade',
            fadeEffect: { crossFade: true },
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            speed: 500, 
        });

        // The cursor and interactive BG are now managed globally by layouts/app.blade.php
    </script>
@endpush
