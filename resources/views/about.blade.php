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
            /* :root { --crew-row-h: clamp(160px, 45vw, 300px); } */
            #crew-masonry-wrapper, .crew-pin-container {
                min-height: 105svh;
            }
        }

        /* ── LIGHTBOX STYLES ── */
        #crew-lightbox {
            transition: opacity 0.4s ease;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
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
                <div class="swiper-slide h-full">
                        <img src="../img/p.home/_DSF0103.JPG" alt="Sinemaku Hero" class="w-full h-full object-cover">
                    </div>
                <div class="swiper-slide h-full">
                        <img src="../img/p.home/_DSF0100.JPG" alt="Sinemaku Hero" class="w-full h-full object-cover">
                    </div>
                <div class="swiper-slide h-full">
                        <img src="../img/p.home/_ARM1294.jpg" alt="Sinemaku Hero" class="w-full h-full object-cover">
                    </div>
                <div class="swiper-slide h-full">
                        <img src="../img/p.home/_ARM1263.jpg" alt="Sinemaku Hero" class="w-full h-full object-cover">
                    </div>
                <div class="swiper-slide h-full">
                        <img src="../img/p.home/_ARM0127.JPG" alt="Sinemaku Hero" class="w-full h-full object-cover">
                    </div>
                <div class="swiper-slide h-full">
                        <img src="https://images.unsplash.com/photo-1782462657114-b32970083601?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Sinemaku Hero" class="w-full h-full object-cover">
                    </div>
                <div class="swiper-slide h-full">
                        <img src="https://images.unsplash.com/photo-1782467478138-af977ef413a0?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Sinemaku Hero" class="w-full h-full object-cover">
                    </div>
                <div class="swiper-slide h-full">
                        <img src="https://images.unsplash.com/photo-1782461749373-6871697a2e96?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Sinemaku Hero" class="w-full h-full object-cover">
                    </div>
                <div class="swiper-slide h-full">
                        <img src="https://images.unsplash.com/photo-1782461123214-60fc14fe050d?q=80&w=1332&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Sinemaku Hero" class="w-full h-full object-cover">
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
                <h1 class="hero-reveal flex flex-col items-center gap-y-4 pointer-events-none drop-shadow-sm text-center md:grid md:grid-cols-[max-content_max-content] md:gap-x-6 md:gap-y-1 md:items-baseline md:text-left">
                    <!-- Row 1: HERE Comes -->
                    <span class="font-peckham text-[10vw] md:text-[9.5vw] text-white uppercase leading-[0.75] tracking-tighter md:text-right">HERE</span>

                    <span class="font-serif not-italic text-[10vw] md:text-[9.5vw] text-white leading-[0.75]">Comes</span>

                    <!-- Row 2: (Empty), The FUN. -->
                    <span class="hidden md:inline"></span>

                    <div class="flex items-baseline gap-x-2 md:gap-x-5">
                        <span class="font-serif not-italic text-[10vw] md:text-[9.5vw] text-white leading-[0.75]">The</span>
                        <span class="font-peckham text-[10vw] md:text-[9.5vw] text-white uppercase leading-[0.75] tracking-tighter">FUN.</span>
                    </div>
                </h1>
            </div>
        </div>
    </section>

    <!-- 2. MANIFESTO (EDITORIAL LAYOUT) -->
    <section id="manifesto" class="py-16 md:py-24 px-6 md:px-32 z-10 relative bg-creme-leaks">
        <!-- Top Metadata -->
        <div class="w-full flex flex-col items-center text-center">
            <div class="max-w-xl">
            <span class="font-peckham text-[6.5vw] sm:text-[3vw] md:text-[3vw] text-2xl text-brand-orange uppercase block mb-10 tracking-tighter">
                TESIS
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
                     $rawText ='[ps]KALAU DIPIKIR-PIKIR,[/ps] [s]yang bikin seseorang[/s][s]sampai ke titik tertentu sering kali bukan soal bakatnya,[/s] [s]tapi soal apakah  dia pernah dapat[/s] [ps]kesempatan.[/ps] [s]Banyak cerita bagus yang akhirnya ga kemana-mana,[/s] [s]bukan karena ceritanya kurang, tapi karena[/s] [ps]belum ketemu ruang buat didengar.[/ps]';

                    // Parse [ps] tags — Peckham tapi ukuran lebih kecil
                    $parsedText = preg_replace_callback('/\[ps\](.*?)\[\/ps\]/', function($matches) {
                        return '<span class="font-peckham text-[4.5vw] sm:text-[2vw] md:text-[2.5vw] text-xl text-lg text-brand-navy uppercase leading-[1.1] tracking-tighter">' . $matches[1] . '</span>';
                    }, $rawText);

                    // Parse [p] tags
                    $parsedText = preg_replace_callback('/\[p\](.*?)\[\/p\]/', function($matches) {
                        return '<span class="font-peckham text-[5vw] sm:text-[3vw] md:text-[3vw] text-xl text-brand-navy uppercase leading-[1.1] tracking-tighter">' . $matches[1] . '</span>';
                    }, $parsedText);

                    // Parse [s] tags
                    $parsedText = preg_replace_callback('/\[s\](.*?)\[\/s\]/', function($matches) {
                        return '<span class="font-serif text-[5.5vw] md:text-[2.5vw] text-brand-orange leading-relaxed">' . $matches[1] . '</span>';
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
        <span class="font-peckham text-[6.5vw] sm:text-[3vw] md:text-[3vw] text-2xl text-brand-orange uppercase block mb-10 tracking-tighter">
                Mengapa Kami Ada?
            </span>
    </div>

    <div class="w-full flex flex-col items-center text-center">
        <h2 class="flex flex-col items-center max-w-5xl mx-auto">

            <div class="flex flex-wrap justify-center gap-x-2 md:gap-x-4 gap-y-1 md:gap-y-2 items-baseline">
                @php
                    $rawText = '[s]Tidak semua perjalanan dimulai dari tempat yang sama.[/s]
                                [s]Yang membedakan sering kali bukan bakat, melainkan kesempatan.[/s]
                                [s]Karena itu,[/s]
                                [p]Sinemaku Picture[/p]
                                [s]memilih untuk menjaga satu hal yang sederhana:[/s]
                                [s]Sebuah pintu yang tetap terbuka bagi setiap kemungkinan yang lahir dari sebuah pertemuan.[/s]';

                    // Parse [ps]
                    $parsedText = preg_replace_callback('/\[ps\](.*?)\[\/ps\]/', function($matches) {
                        return '<span class="font-peckham text-[4.5vw] sm:text-[2vw] md:text-[2.5vw] text-brand-navy uppercase leading-[1.1] tracking-tighter">' . $matches[1] . '</span>';
                    }, $rawText);

                    // Parse [p]
                    $parsedText = preg_replace_callback('/\[p\](.*?)\[\/p\]/', function($matches) {
                        return '<span class="font-peckham text-[5vw] sm:text-[3vw] md:text-[3vw] text-brand-navy uppercase leading-[1.1] tracking-tighter">' . $matches[1] . '</span>';
                    }, $parsedText);

                    // Parse [s]
                    $parsedText = preg_replace_callback('/\[s\](.*?)\[\/s\]/', function($matches) {
                        return '<span class="font-serif text-[5.5vw] md:text-[2.5vw] text-brand-orange leading-relaxed">' . $matches[1] . '</span>';
                    }, $parsedText);
                @endphp

                {!! $parsedText !!}
            </div>

        </h2>
    </div>
</div>
    </section>

    <!-- 2.5 SECONDARY CREW PHOTO (Zoom Out Masonry Grid) -->
    <section id="crew-masonry-wrapper" class="relative w-full bg-black z-10 overflow-hidden">
        <div class="crew-title px-6 md:px-32 pt-4 md:pt-6 pb-1 md:pb-2 w-full flex justify-between items-start">
            <span class="font-peckham text-4xl md:text-3xl text-[#8E95B7] uppercase block mb-10 tracking-tighter">
                CREW
            </span>
        </div>
        <div class="crew-pin-container w-full flex flex-col items-center bg-black">
            <div class="crew-grid w-full grid grid-cols-12 gap-2 md:gap-4 p-2 md:p-4 pb-2 md:pb-4">
                @php
                    $crewMembers = collect($settings)
                        ->filter(fn($v, $k) => str_starts_with($k, 'about_team_image_') && !empty($v))
                        ->map(function ($v, $k) use ($settings) {
                            $id = str_replace('about_team_image_', '', $k);
                            return [
                                'img'   => str_starts_with($v, 'http') ? $v : asset($v),
                                'name'  => $settings["about_team_name_$id"] ?? 'Shooting Crew',
                                'role'  => $settings["about_team_role_$id"] ?? 'Team Member',
                                'index' => (int)$id,
                            ];
                        })
                        ->sortBy('index')
                        ->values()
                        ->toArray();

                    if(count($crewMembers) === 0) {
                        $crewMembers = [
                            ['img' => 'https://images.unsplash.com/photo-1781848867555-63318ed5b745?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'name' => 'Crew', 'role' => 'Role'],
                            ['img' => 'https://images.unsplash.com/photo-1781849752864-50265e8f3adb?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'name' => 'Crew', 'role' => 'Role'],
                            ['img' => 'https://images.unsplash.com/photo-1781690194004-5205b8bf5a6e?q=80&w=1332&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'name' => 'Crew', 'role' => 'Role'],
                            ['img' => 'https://images.unsplash.com/photo-1781849433941-53cbe20bcc5a?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'name' => 'Crew', 'role' => 'Role'],
                            ['img' => 'https://images.unsplash.com/photo-1781849699308-4e6ec029640c?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'name' => 'Crew', 'role' => 'Role'],
                            ['img' => 'https://images.unsplash.com/photo-1781849621181-ea3a7b8995ea?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'name' => 'Crew', 'role' => 'Role']
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
                <div class="col-span-4 md:col-span-6 crew-h rounded-xl md:rounded-3xl overflow-hidden relative group crew-card cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1782461781578-e251ea8b3709?q=80&w=1331&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-full object-cover transition duration-700">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end">
                        <h3 class="font-sans text-white text-lg md:text-xl font-bold uppercase tracking-tight">{{ $top6[0]['name'] }}</h3>
                        <span class="font-serif text-brand-orange text-xs md:text-sm italic">{{ $top6[0]['role'] }}</span>
                    </div>
                </div>
                <div class="col-span-4 md:col-span-6 crew-h rounded-xl md:rounded-3xl overflow-hidden relative group crew-card cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1782470000712-a5560cc1d34b?q=80&w=1331&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-full object-cover transition duration-700">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end">
                        <h3 class="font-sans text-white text-lg md:text-xl font-bold uppercase tracking-tight">{{ $top6[1]['name'] }}</h3>
                        <span class="font-serif text-brand-orange text-xs md:text-sm italic">{{ $top6[1]['role'] }}</span>
                    </div>
                </div>

                <!-- Row 2 (CENTER ROW) -->
                <div class="col-span-4 md:col-span-3 crew-h rounded-xl md:rounded-3xl overflow-hidden relative group crew-card cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1782471133909-215458ae73a5?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-full object-cover transition duration-700">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end">
                        <h3 class="font-sans text-white text-sm md:text-lg font-bold uppercase tracking-tight">{{ $top6[2]['name'] }}</h3>
                        <span class="font-serif text-brand-orange text-[10px] md:text-xs italic">{{ $top6[2]['role'] }}</span>
                    </div>
                </div>

                <div class="crew-center-img col-span-12 md:col-span-6 crew-h rounded-xl md:rounded-3xl overflow-hidden relative shadow-2xl">
                    @php
                        $secondaryImg = $settings['about_secondary_image'] ?? 'https://images.unsplash.com/photo-1509023464722-18d996393ca8?q=80&w=2000&auto=format&fit=crop';
                    @endphp
                    <img src="https://images.unsplash.com/photo-1781849433941-53cbe20bcc5a?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-full object-cover">
                    <div class="crew-overlay absolute inset-0 bg-brand-navy/60 flex flex-col items-center justify-center text-center p-4 opacity-100 pointer-events-none">
                        <h2 class="crew-text-reveal font-peckham text-white text-[5vw] md:text-[3vw] uppercase leading-none tracking-tighter shadow-sm" style="line-height: 0.9;">THE PEOPLE</h2>
                        <span class="crew-text-reveal font-serif text-white text-[3vw] md:text-[2vw] italic my-2 md:my-4 shadow-sm" style="line-height: 0.9;">behind the</span>
                        <h2 class="crew-text-reveal font-peckham text-white text-[5vw] md:text-[3vw] uppercase leading-none tracking-tighter shadow-sm" style="line-height: 0.9;">CAMERA.</h2>
                    </div>
                </div>

                <div class="col-span-4 md:col-span-3 crew-h rounded-xl md:rounded-3xl overflow-hidden relative group crew-card cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1782472910168-5730f7459a35?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-full object-cover transition duration-700">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end">
                        <h3 class="font-sans text-white text-sm md:text-lg font-bold uppercase tracking-tight">{{ $top6[3]['name'] }}</h3>
                        <span class="font-serif text-brand-orange text-[10px] md:text-xs italic">{{ $top6[3]['role'] }}</span>
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="col-span-4 md:col-span-6 crew-h rounded-xl md:rounded-3xl overflow-hidden relative group crew-card cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1782472605035-59a2a93fb95f?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-full object-cover transition duration-700">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end">
                        <h3 class="font-sans text-white text-lg md:text-xl font-bold uppercase tracking-tight">{{ $top6[4]['name'] }}</h3>
                        <span class="font-serif text-brand-orange text-xs md:text-sm italic">{{ $top6[4]['role'] }}</span>
                    </div>
                </div>
                <div class="col-span-4 md:col-span-6 crew-h rounded-xl md:rounded-3xl overflow-hidden relative group crew-card cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1782472414798-e590a88e4836?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-full object-cover transition duration-700">
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
                    <div class="group {{ $isTwo ? 'col-span-6' : 'col-span-6 md:col-span-4' }} crew-h rounded-xl md:rounded-3xl overflow-hidden relative crew-card cursor-pointer">
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

    <!-- Crew Photo Lightbox Markup -->
    <div id="crew-lightbox" class="fixed inset-0 z-[1000] hidden items-center justify-center bg-black/85 opacity-0 pointer-events-none">
        <!-- Backdrop blank space for closing -->
        <div id="crew-lightbox-backdrop" class="absolute inset-0 cursor-zoom-out"></div>

        <!-- Lightbox Content Container -->
        <div id="crew-lightbox-content" class="relative max-w-[90vw] md:max-w-[85vw] max-h-[85vh] flex flex-col items-center justify-center z-10 scale-95 opacity-0 pointer-events-auto">
            <!-- Close Button -->
            <button id="crew-lightbox-close" class="absolute -top-12 right-0 md:-right-12 text-white/70 hover:text-white transition-colors duration-300 text-3xl font-bold cursor-pointer bg-transparent border-0 outline-none p-2 flex items-center justify-center z-20" aria-label="Close">
                <span class="iconify" data-icon="material-symbols:close-rounded"></span>
            </button>

            <!-- Image Frame -->
            <div id="crew-lightbox-frame" class="w-full h-full rounded-2xl md:rounded-3xl overflow-hidden shadow-2xl relative bg-neutral-900 border border-white/10 flex items-center justify-center">
                <img id="crew-lightbox-img" src="" alt="Crew Member" class="max-w-[90vw] md:max-w-[85vw] max-h-[75vh] md:max-h-[70vh] object-contain">

                <!-- Info Overlay in Lightbox -->
                <div class="absolute bottom-0 left-0 w-full p-4 md:p-6 bg-gradient-to-t from-black/90 via-black/40 to-transparent flex flex-col justify-end pointer-events-none">
                    <h3 id="crew-lightbox-name" class="font-sans text-white text-lg md:text-2xl font-bold uppercase tracking-tight leading-none"></h3>
                    <span id="crew-lightbox-role" class="font-serif text-brand-orange text-xs md:text-sm italic mt-1.5 leading-none"></span>
                </div>
            </div>
        </div>
    </div>

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
            // Function to calculate the required zoom scale dynamically
            function calculateZoomScale() {
                const centerImg = document.querySelector('.crew-center-img');
                if (centerImg) {
                    const imgW = centerImg.offsetWidth;
                    const imgH = centerImg.offsetHeight;
                    if (imgW > 0 && imgH > 0) {
                        const scaleX = window.innerWidth / imgW;
                        const scaleY = window.innerHeight / imgH;
                        // Use the maximum of scaleX and scaleY to ensure "cover" fit,
                        // and add a 15% safety margin to cover device notches, scrollbars, or address bars.
                        const calculatedScale = Math.max(scaleX, scaleY) * 1.15;

                        // Enforce a minimum scale of 3.5 on desktop/PC (width > 768px) to prevent
                        // empty black space below the grid on scroll/unpin.
                        if (window.innerWidth > 768) {
                            return Math.max(3.5, calculatedScale);
                        }
                        return calculatedScale;
                    }
                }
                // Fallback scales if elements are not yet fully measured/rendered
                return window.innerWidth <= 768 ? 4.5 : 3.5;
            }

            let mm = gsap.matchMedia();

            // Mobile/Tablet Configuration (Pin at very top to prevent cream background gaps)
            mm.add("(max-width: 768px)", () => {
                let crewTl = gsap.timeline({
                    scrollTrigger: {
                        trigger: "#crew-masonry-wrapper",
                        start: "top top", // Pin at exactly the top of the viewport
                        end: "+=300%",
                        scrub: 1.5,
                        pin: true,
                        invalidateOnRefresh: true
                    }
                });

                // crewTl.fromTo(".crew-grid",
                //     { scale: 1, transformOrigin: "center center" },
                //     { scale: () => calculateZoomScale(), transformOrigin: "center center", ease: "power2.inOut", duration: 1.5 }
                // );

                // crewTl.fromTo([".crew-grid > div:not(.crew-center-img)", ".crew-title"],
                //     { opacity: 1 },
                //     { opacity: 0, ease: "power2.inOut", duration: 1.5 },
                //     "<"
                // );

                gsap.set(".crew-overlay", { opacity: 1 });
                // gsap.set(".crew-text-reveal", { opacity: 1, y: 0 });

                // crewTl.to(".crew-text-reveal", { opacity: 0, duration: 1.2, ease: "power2.out" }, "<");
                crewTl.to(".crew-overlay", { opacity: 0, duration: 1.5, ease: "power2.inOut" }, "<");
                crewTl.to({}, {duration: 0.2});
            });

            // Desktop Configuration (Pin at center for balanced layout)
            mm.add("(min-width: 769px)", () => {
                let crewTl = gsap.timeline({
                    scrollTrigger: {
                        trigger: "#crew-masonry-wrapper",
                        start: "center center", // Pin at center of screen
                        end: "+=300%",
                        scrub: 1.5,
                        pin: true,
                        invalidateOnRefresh: true
                    }
                });

                // crewTl.fromTo(".crew-grid",
                //     { scale: 1, transformOrigin: "center center" },
                //     { scale: () => calculateZoomScale(), transformOrigin: "center center", ease: "power2.inOut", duration: 1.5 }
                // );

                // crewTl.fromTo([".crew-grid > div:not(.crew-center-img)", ".crew-title"],
                //     { opacity: 1 },
                //     { opacity: 0, ease: "power2.inOut", duration: 1.5 },
                //     "<"
                // );

                gsap.set(".crew-overlay", { opacity: 1 });
                gsap.set(".crew-text-reveal", { opacity: 1, y: 0 });

                crewTl.to(".crew-text-reveal", { opacity: 0, duration: 1.2, ease: "power2.out" }, "<");
                crewTl.to(".crew-overlay", { opacity: 0, duration: 1.5, ease: "power2.inOut" }, "<");
                crewTl.to({}, {duration: 0.2});
            });
        }

        // Initialize Hero Slideshow
        const heroSwiper = new Swiper('.hero-swiper', {
            effect: 'fade',
            fadeEffect: { crossFade: true },
            loop: true,
            autoplay: {
                delay: 1800,
                disableOnInteraction: false,
            },
            speed: 500,
        });

        // ─── CREW LIGHTBOX PREVIEW SYSTEM ─────────────────────────────
        const crewLightbox = document.getElementById('crew-lightbox');
        const crewLightboxContent = document.getElementById('crew-lightbox-content');
        const crewLightboxFrame = document.getElementById('crew-lightbox-frame');
        const crewLightboxImg = document.getElementById('crew-lightbox-img');
        const crewLightboxName = document.getElementById('crew-lightbox-name');
        const crewLightboxRole = document.getElementById('crew-lightbox-role');
        const crewLightboxClose = document.getElementById('crew-lightbox-close');
        const crewLightboxBackdrop = document.getElementById('crew-lightbox-backdrop');

        let activeOriginalImg = null;
        let isLightboxAnimating = false;
        let currentScale = 1;
        let translateX = 0;
        let translateY = 0;

        let isDragging = false;
        let startX = 0, startY = 0;
        let startTranslateX = 0, startTranslateY = 0;

        function lockScroll() {
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
        }

        // Custom function to check if document has vertical scrollbar
        function hasScrollbar() {
            return document.documentElement.scrollHeight > window.innerHeight;
        }

        // Get scrollbar width to prevent layout shift
        function getScrollbarWidth() {
            return window.innerWidth - document.documentElement.clientWidth;
        }

        function unlockScroll() {
            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        }

        // Open Lightbox
        function openLightbox(card) {
            if (isLightboxAnimating) return;
            isLightboxAnimating = true;

            const img = card.querySelector('img');
            const h3 = card.querySelector('h3');
            const span = card.querySelector('span');

            if (!img || !h3 || !span) {
                isLightboxAnimating = false;
                return;
            }

            activeOriginalImg = img;
            const originalRect = img.getBoundingClientRect();

            // Set content
            crewLightboxImg.src = img.src;
            crewLightboxName.innerText = h3.innerText;
            crewLightboxRole.innerText = span.innerText;

            // Reset zoom & translation state
            currentScale = 1;
            translateX = 0;
            translateY = 0;
            gsap.set(crewLightboxFrame, { scale: 1, x: 0, y: 0 });
            gsap.set(crewLightboxImg, { scale: 1, x: 0, y: 0 });
            crewLightboxFrame.style.cursor = 'pointer';

            // Calculate target centered dimensions mathematically to avoid layout reflow lag
            const naturalW = img.naturalWidth || originalRect.width;
            const naturalH = img.naturalHeight || originalRect.height;
            const aspect = naturalW / naturalH;
            const vw = window.innerWidth;
            const vh = window.innerHeight;

            // Max dimensions matching Tailwind: max-w-[90vw] md:max-w-[85vw], max-h-[75vh] md:max-h-[70vh]
            const maxW = vw > 768 ? vw * 0.85 : vw * 0.90;
            const maxH = vw > 768 ? vh * 0.70 : vh * 0.75;

            let targetW = maxW;
            let targetH = targetW / aspect;

            if (targetH > maxH) {
                targetH = maxH;
                targetW = targetH * aspect;
            }

            // Top and left coordinates relative to viewport
            const targetTop = (vh - targetH) / 2;
            const targetLeft = (vw - targetW) / 2;

            // Set dimensions explicitly on image element so flex parent aligns perfectly
            crewLightboxImg.style.width = `${targetW}px`;
            crewLightboxImg.style.height = `${targetH}px`;
            crewLightboxImg.style.aspectRatio = `${naturalW} / ${naturalH}`;

            // Prevent layout shift: add padding equivalent to scrollbar width
            if (hasScrollbar()) {
                const sbWidth = getScrollbarWidth();
                document.body.style.paddingRight = `${sbWidth}px`;
            }

            // Initialize Lightbox Layout (hidden overlay but flex & opacity 0)
            gsap.set(crewLightbox, { display: 'flex', opacity: 0, pointerEvents: 'auto' });
            gsap.set(crewLightboxContent, { opacity: 0, scale: 0.98 });
            gsap.set(crewLightboxImg, { opacity: 0 });

            // Create temporary animation clone
            const clone = document.createElement('img');
            clone.src = img.src;
            clone.style.position = 'fixed';
            clone.style.top = originalRect.top + 'px';
            clone.style.left = originalRect.left + 'px';
            clone.style.width = originalRect.width + 'px';
            clone.style.height = originalRect.height + 'px';
            clone.style.objectFit = 'cover';
            clone.style.borderRadius = window.getComputedStyle(card).borderRadius || '24px';
            clone.style.zIndex = '1001';
            clone.style.pointerEvents = 'none';
            document.body.appendChild(clone);

            // Lock page scroll
            lockScroll();

            // Fade original image slightly to indicate focus
            img.style.opacity = '0.2';

            const tl = gsap.timeline({
                onComplete: () => {
                    // Show final lightbox layout, delete clone
                    gsap.set(crewLightboxImg, { opacity: 1 });
                    clone.remove();
                    isLightboxAnimating = false;
                }
            });

            // Fade in black backdrop
            tl.to(crewLightbox, {
                opacity: 1,
                duration: 0.45,
                ease: 'power2.out'
            }, 0);

            // Animate clone bounds to target centered layout bounds (using exponential ease for buttery smoothness)
            tl.to(clone, {
                top: targetTop,
                left: targetLeft,
                width: targetW,
                height: targetH,
                borderRadius: '24px',
                duration: 0.6,
                ease: 'power4.out'
            }, 0);

            // Fade in borders and text information frame smoothly during transition (instead of popping)
            tl.to(crewLightboxContent, {
                opacity: 1,
                scale: 1,
                duration: 0.5,
                ease: 'power3.out'
            }, 0.1);
        }

        // Close Lightbox
        function closeLightbox() {
            if (isLightboxAnimating || !activeOriginalImg) return;
            isLightboxAnimating = true;

            // Reset scale/translations first to get clean, unzoomed target bounding rect
            gsap.set(crewLightboxFrame, { scale: 1, x: 0, y: 0 });

            const originalRect = activeOriginalImg.getBoundingClientRect();

            // Re-calculate target rect mathematically to ensure precise dimensions and positions without reflow
            const naturalW = activeOriginalImg.naturalWidth || originalRect.width;
            const naturalH = activeOriginalImg.naturalHeight || originalRect.height;
            const aspect = naturalW / naturalH;
            const vw = window.innerWidth;
            const vh = window.innerHeight;
            const maxW = vw > 768 ? vw * 0.85 : vw * 0.90;
            const maxH = vw > 768 ? vh * 0.70 : vh * 0.75;
            let targetW = maxW;
            let targetH = targetW / aspect;
            if (targetH > maxH) {
                targetH = maxH;
                targetW = targetH * aspect;
            }
            const targetTop = (vh - targetH) / 2;
            const targetLeft = (vw - targetW) / 2;

            // Create temporary animation clone
            const clone = document.createElement('img');
            clone.src = crewLightboxImg.src;
            clone.style.position = 'fixed';
            clone.style.top = targetTop + 'px';
            clone.style.left = targetLeft + 'px';
            clone.style.width = targetW + 'px';
            clone.style.height = targetH + 'px';
            clone.style.objectFit = 'cover';
            clone.style.borderRadius = '24px';
            clone.style.zIndex = '1001';
            clone.style.pointerEvents = 'none';
            document.body.appendChild(clone);

            // Hide actual lightbox content image
            gsap.set(crewLightboxImg, { opacity: 0 });

            const tl = gsap.timeline({
                onComplete: () => {
                    clone.remove();
                    gsap.set(crewLightbox, { display: 'none', pointerEvents: 'none' });

                    // Reset opacity of original image in grid
                    if (activeOriginalImg) {
                        activeOriginalImg.style.opacity = '';
                        activeOriginalImg = null;
                    }

                    // Unlock page scroll
                    unlockScroll();
                    isLightboxAnimating = false;
                }
            });

            // Fade out the surrounding text overlay and container borders
            tl.to(crewLightboxContent, {
                opacity: 0,
                scale: 0.98,
                duration: 0.35,
                ease: 'power2.in'
            }, 0);

            // Fade out black backdrop
            tl.to(crewLightbox, {
                opacity: 0,
                duration: 0.45,
                ease: 'power2.inOut'
            }, 0);

            // Animate clone bounds back to original grid bounds
            tl.to(clone, {
                top: originalRect.top,
                left: originalRect.left,
                width: originalRect.width,
                height: originalRect.height,
                borderRadius: window.getComputedStyle(activeOriginalImg.parentElement).borderRadius || '24px',
                duration: 0.55,
                ease: 'power3.inOut'
            }, 0);
        }

        // Attach click listener to each crew card
        document.querySelectorAll('.crew-card').forEach(card => {
            card.addEventListener('click', () => {
                openLightbox(card);
            });
        });

        // Close on backdrop click, close button click, or Escape key
        crewLightboxBackdrop.addEventListener('click', closeLightbox);
        crewLightboxClose.addEventListener('click', closeLightbox);
        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && crewLightbox.style.display === 'flex') {
                closeLightbox();
            }
        });

        // ─── ZOOM ON SCROLL/WHEEL SYSTEM ──────────────────────────────
        // Apply zoom to the entire Frame (crewLightboxFrame) to zoom all components (image + frame) without cropping
        crewLightbox.addEventListener('wheel', (e) => {
            if (crewLightbox.style.display !== 'flex') return;
            e.preventDefault();

            const zoomSpeed = 0.08;
            if (e.deltaY < 0) {
                // Zoom In
                currentScale = Math.min(4, currentScale + zoomSpeed);
            } else {
                // Zoom Out
                currentScale = Math.max(1, currentScale - zoomSpeed);
            }

            // Adjust cursor based on scale
            crewLightboxFrame.style.cursor = currentScale > 1 ? 'grab' : 'pointer';

            // If we zoomed back to 1, reset x/y panning offsets
            if (currentScale === 1) {
                translateX = 0;
                translateY = 0;
            } else {
                // Keep translations in check if we downscale
                const maxPanX = (currentScale - 1) * crewLightboxFrame.offsetWidth / 2;
                const maxPanY = (currentScale - 1) * crewLightboxFrame.offsetHeight / 2;
                translateX = Math.max(-maxPanX, Math.min(maxPanX, translateX));
                translateY = Math.max(-maxPanY, Math.min(maxPanY, translateY));
            }

            gsap.to(crewLightboxFrame, {
                scale: currentScale,
                x: translateX,
                y: translateY,
                duration: 0.25,
                ease: "power2.out"
            });
        }, { passive: false });

        // ─── TOUCH PINCH TO ZOOM SYSTEM ───────────────────────────────
        let touchStartDist = 0;
        let initialScale = 1;

        crewLightbox.addEventListener('touchstart', (e) => {
            if (e.touches.length === 2 && crewLightbox.style.display === 'flex') {
                touchStartDist = Math.hypot(
                    e.touches[0].clientX - e.touches[1].clientX,
                    e.touches[0].clientY - e.touches[1].clientY
                );
                initialScale = currentScale;
            }
        });

        crewLightbox.addEventListener('touchmove', (e) => {
            if (e.touches.length === 2 && touchStartDist > 0 && crewLightbox.style.display === 'flex') {
                e.preventDefault();
                const dist = Math.hypot(
                    e.touches[0].clientX - e.touches[1].clientX,
                    e.touches[0].clientY - e.touches[1].clientY
                );
                const factor = dist / touchStartDist;
                currentScale = Math.max(1, Math.min(4, initialScale * factor));

                crewLightboxFrame.style.cursor = currentScale > 1 ? 'grab' : 'pointer';

                if (currentScale === 1) {
                    translateX = 0;
                    translateY = 0;
                }

                gsap.to(crewLightboxFrame, {
                    scale: currentScale,
                    x: translateX,
                    y: translateY,
                    duration: 0.1,
                    ease: "none"
                });
            }
        }, { passive: false });

        crewLightbox.addEventListener('touchend', (e) => {
            if (e.touches.length < 2) {
                touchStartDist = 0;
            }
        });

        // ─── DRAG & PAN ZOOMED IMAGE SYSTEM ───────────────────────────
        // Mouse drag panning on the whole frame
        crewLightboxFrame.addEventListener('mousedown', (e) => {
            if (currentScale > 1 && crewLightbox.style.display === 'flex') {
                isDragging = true;
                startX = e.clientX;
                startY = e.clientY;
                startTranslateX = translateX;
                startTranslateY = translateY;
                crewLightboxFrame.style.cursor = 'grabbing';
                e.preventDefault();
            }
        });

        window.addEventListener('mousemove', (e) => {
            if (isDragging && currentScale > 1 && crewLightbox.style.display === 'flex') {
                const dx = e.clientX - startX;
                const dy = e.clientY - startY;

                const maxPanX = (currentScale - 1) * crewLightboxFrame.offsetWidth / 2;
                const maxPanY = (currentScale - 1) * crewLightboxFrame.offsetHeight / 2;

                translateX = Math.max(-maxPanX, Math.min(maxPanX, startTranslateX + dx));
                translateY = Math.max(-maxPanY, Math.min(maxPanY, startTranslateY + dy));

                gsap.to(crewLightboxFrame, {
                    x: translateX,
                    y: translateY,
                    duration: 0.1,
                    ease: "power2.out"
                });
            }
        });

        window.addEventListener('mouseup', () => {
            if (isDragging) {
                isDragging = false;
                crewLightboxFrame.style.cursor = currentScale > 1 ? 'grab' : 'pointer';
            }
        });

        // Touch drag panning on the whole frame
        let touchStartX = 0, touchStartY = 0;
        let isTouchDragging = false;

        crewLightboxFrame.addEventListener('touchstart', (e) => {
            if (e.touches.length === 1 && currentScale > 1 && crewLightbox.style.display === 'flex') {
                isTouchDragging = true;
                touchStartX = e.touches[0].clientX;
                touchStartY = e.touches[0].clientY;
                startTranslateX = translateX;
                startTranslateY = translateY;
            }
        });

        crewLightboxFrame.addEventListener('touchmove', (e) => {
            if (isTouchDragging && e.touches.length === 1 && currentScale > 1 && crewLightbox.style.display === 'flex') {
                const dx = e.touches[0].clientX - touchStartX;
                const dy = e.touches[0].clientY - touchStartY;

                const maxPanX = (currentScale - 1) * crewLightboxFrame.offsetWidth / 2;
                const maxPanY = (currentScale - 1) * crewLightboxFrame.offsetHeight / 2;

                translateX = Math.max(-maxPanX, Math.min(maxPanX, startTranslateX + dx));
                translateY = Math.max(-maxPanY, Math.min(maxPanY, startTranslateY + dy));

                gsap.to(crewLightboxFrame, {
                    x: translateX,
                    y: translateY,
                    duration: 0.1,
                    ease: "power2.out"
                });
            }
        });

        crewLightboxFrame.addEventListener('touchend', () => {
            isTouchDragging = false;
        });

        // The cursor and interactive BG are now managed globally by layouts/app.blade.php
    </script>
@endpush
