@extends('layouts.app')

@section('title', $films->title . ' | Sinemaku Pictures')

@section('content')

    @include('partials.navbar')

    {{-- ============================================================
    EDITORIAL WRAPPER
    Consistent with Film & About pages
    ============================================================ --}}
    <div id="editorial-wrapper" class="text-brand-deepbreath relative w-full font-sans">

        {{-- ============================================================
        1. CINEMATIC HERO SECTION
        ============================================================ --}}
        <section class="relative w-full h-[90vh] md:h-[100vh] flex flex-col justify-end overflow-hidden z-10">
            <!-- Background Image with Parallax -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('photo/' . $films->photo) }}" 
                     alt="{{ $films->title }}" 
                     class="w-full h-[120%] object-cover filter grayscale contrast-110 brightness-75 hero-parallax-img"
                     style="transform: translateY(-10%);">
                <div class="absolute inset-0 bg-gradient-to-t from-[#F1F1F1] via-transparent to-transparent opacity-80"></div>
                <div class="absolute inset-0 bg-brand-deepbreath/20 mix-blend-multiply"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 px-8 md:px-16 pb-20 max-w-[1800px] mx-auto w-full">
                <div class="flex flex-col md:flex-row items-end justify-between gap-8">
                    <div class="w-full md:w-2/3">
                        <span class="block font-sans text-[10px] tracking-[0.4em] uppercase text-brand-orange mb-6 hero-reveal">
                            {{ \Carbon\Carbon::parse($films->release_date)->format('Y') }} • @i18n($films, 'genre')
                        </span>
                        <h1 class="font-serif text-[12vw] md:text-[8vw] leading-[0.85] text-brand-deepbreath tracking-tighter hero-reveal">
                            <span class="block">@i18n($films, 'title')</span>
                        </h1>
                    </div>
                    
                    @php
                        $video_id = '';
                        if (!empty($films->link) && preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $films->link, $match)) {
                            $video_id = $match[1];
                        }
                    @endphp

                    @if($video_id)
                    <div class="w-full md:w-auto hero-reveal">
                        <button onclick="openHeroTrailer('{{ $video_id }}')" 
                                class="group flex items-center gap-6 hover-target cursor-none">
                            <div class="w-20 h-20 md:w-24 md:h-24 rounded-full border border-brand-deepbreath/20 flex items-center justify-center group-hover:bg-brand-deepbreath group-hover:text-white transition-all duration-500">
                                <span class="iconify w-8 h-8" data-icon="lucide:play"></span>
                            </div>
                            <span class="font-sans text-[10px] tracking-[0.3em] uppercase font-bold text-brand-deepbreath">Watch Trailer</span>
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </section>

        {{-- ============================================================
        2. FILM METADATA (ASYMMETRICAL STRIP)
        ============================================================ --}}
        <section class="py-24 px-8 md:px-16 z-10 relative bg-[#F1F1F1]/80 backdrop-blur-md">
            <div class="max-w-[1800px] mx-auto border-t border-b border-brand-deepbreath/10 py-16 grid grid-cols-1 md:grid-cols-4 gap-12">
                
                <div class="metadata-item">
                    <span class="font-sans text-[9px] tracking-[0.3em] uppercase text-brand-deepbreath/40 block mb-4">Director</span>
                    <h3 class="font-serif text-3xl text-brand-deepbreath italic">{{ $films->director }}</h3>
                </div>

                <div class="metadata-item">
                    <span class="font-sans text-[9px] tracking-[0.3em] uppercase text-brand-deepbreath/40 block mb-4">Cast</span>
                    <div class="flex flex-col gap-1">
                        @foreach(array_slice(explode(',', $films->cast), 0, 3) as $cast)
                            <span class="font-sans text-sm font-medium text-brand-deepbreath">{{ trim($cast) }}</span>
                        @endforeach
                        @if(count(explode(',', $films->cast)) > 3)
                            <span class="font-sans text-[10px] text-brand-orange italic mt-1">and more...</span>
                        @endif
                    </div>
                </div>

                <div class="metadata-item">
                    <span class="font-sans text-[9px] tracking-[0.3em] uppercase text-brand-deepbreath/40 block mb-4">Duration</span>
                    <h3 class="font-sans text-2xl font-light text-brand-deepbreath">{{ $films->duration }} <span class="text-sm uppercase tracking-widest opacity-40">Min</span></h3>
                </div>

                <div class="metadata-item">
                    <span class="font-sans text-[9px] tracking-[0.3em] uppercase text-brand-deepbreath/40 block mb-4">Language</span>
                    <h3 class="font-sans text-2xl font-light text-brand-deepbreath">Bahasa Indonesia</h3>
                </div>

            </div>
        </section>

        {{-- ============================================================
        3. SYNOPSIS & CORE VISUAL
        ============================================================ --}}
        <section class="py-32 px-8 md:px-16 z-10 relative">
            <div class="max-w-[1800px] mx-auto flex flex-col md:flex-row gap-20 md:gap-32 items-center">
                
                <!-- Poster Side (Editorial Frame) -->
                <div class="w-full md:w-2/5 reveal-image">
                    <div class="aspect-[2/3] w-full rounded-[2.5rem] overflow-hidden shadow-2xl bg-tint-2/20">
                        <img src="{{ asset('photo/' . $films->poster) }}" 
                             alt="{{ $films->title }} Poster"
                             class="w-full h-full object-cover grayscale contrast-110 hover:grayscale-0 transition-all duration-1000">
                    </div>
                </div>

                <!-- Text Side -->
                <div class="w-full md:w-3/5">
                    <span class="font-sans text-[10px] tracking-[0.4em] uppercase text-brand-orange block mb-8">The Narrative.</span>
                    <div class="font-serif text-xl md:text-2xl leading-[1.8] font-light text-brand-deepbreath/80 split-text-synopsis max-w-3xl">
                        @i18n($films, 'sinopsis')
                    </div>
                </div>

            </div>
        </section>

        {{-- ============================================================
        4. STILL SHOTS (EDITORIAL BENTO)
        ============================================================ --}}
        <section class="py-32 px-8 md:px-16 z-10 relative bg-brand-deepbreath text-white rounded-t-[4rem] -mt-20">
            <div class="max-w-[1800px] mx-auto mb-20">
                <div class="flex justify-between items-end border-b border-white/10 pb-12">
                    <h2 class="font-serif text-6xl md:text-8xl tracking-tighter italic">Still <span class="text-brand-orange not-italic">Shots.</span></h2>
                    <span class="font-sans text-[10px] tracking-[0.4em] uppercase opacity-40 pb-4">Gallery 01</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-10 max-w-[1800px] mx-auto">
                @php
                    $shots = $films->stillShots;
                    if($shots->count() == 0) {
                        // Fallback dummy shots if empty
                        $shots = collect([
                            (object)['photo' => 'https://picsum.photos/seed/1/1200/800'],
                            (object)['photo' => 'https://picsum.photos/seed/2/800/1200'],
                            (object)['photo' => 'https://picsum.photos/seed/3/1200/800'],
                            (object)['photo' => 'https://picsum.photos/seed/4/1200/800'],
                        ]);
                    }
                @endphp

                @foreach($shots as $idx => $shot)
                    @php
                        $span = 'md:col-span-6';
                        $aspect = 'aspect-video';
                        if($idx % 4 == 1) { $span = 'md:col-span-4'; $aspect = 'aspect-[3/4]'; }
                        elseif($idx % 4 == 2) { $span = 'md:col-span-8'; $aspect = 'aspect-video'; }
                        elseif($idx % 4 == 3) { $span = 'md:col-span-6'; $aspect = 'aspect-[16/10]'; }
                    @endphp
                    <div class="{{ $span }} {{ $aspect }} overflow-hidden rounded-[2rem] reveal-shot group cursor-none hover-target">
                        <img src="{{ str_contains($shot->photo, 'http') ? $shot->photo : asset('photo/' . $shot->photo) }}" 
                             class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" 
                             alt="Still Shot">
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ============================================================
        5. RECOMMENDATIONS (SIMILAR STORIES)
        ============================================================ --}}
        <section class="py-32 px-8 md:px-16 z-10 relative bg-[#F1F1F1]">
            <div class="max-w-[1800px] mx-auto mb-20 border-t border-brand-deepbreath/10 pt-16">
                <h2 class="font-serif text-5xl text-brand-deepbreath tracking-tight">You might also <span class="italic text-brand-orange">enjoy.</span></h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 max-w-[1800px] mx-auto">
                @foreach ($all_film->where('id', '!=', $films->id)->take(4) as $item)
                    <a href="{{ route('detail-film', $item->slug) }}" class="group block cursor-none hover-target reveal-rec">
                        <div class="aspect-[4/5] w-full overflow-hidden rounded-[2rem] bg-tint-2/20 mb-6">
                            <img src="{{ asset('photo/' . $item->photo) }}" 
                                 class="w-full h-full object-cover grayscale contrast-110 group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700"
                                 alt="@i18n($item, 'title')">
                        </div>
                        <h4 class="font-serif text-2xl text-brand-deepbreath leading-tight group-hover:text-brand-orange transition-colors">@i18n($item, 'title')</h4>
                        <span class="font-sans text-[10px] tracking-[0.2em] uppercase text-brand-deepbreath/40 mt-2 block">
                            {{ \Carbon\Carbon::parse($item->release_date)->format('Y') }} • @i18n($item, 'genre')
                        </span>
                    </a>
                @endforeach
            </div>
        </section>

    </div> {{-- End Editorial Wrapper --}}

    {{-- ============================================================
    TRAILER MODAL (Consistent with Film Page)
    ============================================================ --}}
    <div id="hero-trailer-modal" class="fixed inset-0 z-[20000] bg-black opacity-0 pointer-events-none transition-opacity duration-500 flex items-center justify-center p-4 md:p-16">
        <button onclick="closeHeroTrailer()" class="absolute top-8 right-8 text-white text-4xl hover:text-brand-orange transition-colors z-[20010]">&times;</button>
        <div class="w-full max-w-6xl aspect-video bg-black relative shadow-2xl overflow-hidden">
            <iframe id="hero-trailer-iframe" src="" class="absolute inset-0 w-full h-full border-0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>

    @include('components.footer')

@endsection

@push('head')
    <style>
        .text-brand-deepbreath { color: #25225E; }
        .text-brand-orange { color: #FFB150; }
        .bg-tint-2 { background-color: #CACAEF; }
        .ease-expo { transition-timing-function: cubic-bezier(0.19, 1, 0.22, 1); }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof gsap === 'undefined') return;
            
            gsap.registerPlugin(ScrollTrigger);

            // 1. Hero Reveal Animations
            gsap.from(".hero-reveal", {
                y: 50,
                opacity: 0,
                duration: 1.2,
                stagger: 0.2,
                ease: "power4.out",
                delay: 0.3
            });

            // 2. Hero Parallax
            gsap.to(".hero-parallax-img", {
                y: "20%",
                ease: "none",
                scrollTrigger: {
                    trigger: ".film-hero",
                    start: "top top",
                    end: "bottom top",
                    scrub: true
                }
            });

            // 3. Metadata staggered reveal
            gsap.from(".metadata-item", {
                scrollTrigger: {
                    trigger: ".detail-strip",
                    start: "top 85%",
                },
                y: 30,
                opacity: 0,
                duration: 1,
                stagger: 0.1,
                ease: "power3.out"
            });

            // 4. Reveal Images & Grid items
            const reveals = ['.reveal-image', '.reveal-shot', '.reveal-rec'];
            reveals.forEach(selector => {
                gsap.from(selector, {
                    scrollTrigger: {
                        trigger: selector,
                        start: "top 90%",
                    },
                    y: 60,
                    opacity: 0,
                    duration: 1.5,
                    stagger: 0.1,
                    ease: "expo.out"
                });
            });

            // 5. Synopsis Reveal (Fade in words feel)
            gsap.from(".split-text-synopsis", {
                scrollTrigger: {
                    trigger: ".split-text-synopsis",
                    start: "top 85%",
                },
                opacity: 0,
                y: 30,
                duration: 1.5,
                ease: "power3.out"
            });

            /* ─── TRAILER MODAL LOGIC ─── */
            window.openHeroTrailer = function(videoId) {
                const modal = document.getElementById('hero-trailer-modal');
                const iframe = document.getElementById('hero-trailer-iframe');
                if (modal && iframe) {
                    iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
                    modal.classList.remove('opacity-0', 'pointer-events-none');
                    modal.classList.add('opacity-100', 'pointer-events-auto');
                    document.body.style.overflow = 'hidden';
                }
            };

            window.closeHeroTrailer = function() {
                const modal = document.getElementById('hero-trailer-modal');
                const iframe = document.getElementById('hero-trailer-iframe');
                if (modal && iframe) {
                    iframe.src = '';
                    modal.classList.add('opacity-0', 'pointer-events-none');
                    modal.classList.remove('opacity-100', 'pointer-events-auto');
                    document.body.style.overflow = '';
                }
            };

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeHeroTrailer();
            });
        });
    </script>
@endpush