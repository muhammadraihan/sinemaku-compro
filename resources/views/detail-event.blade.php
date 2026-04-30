@extends('layouts.app')

@section('title', $event->judul . ' | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

{{-- ============================================================
EDITORIAL WRAPPER
============================================================ --}}
<div id="editorial-wrapper" class="text-brand-deepbreath relative w-full font-sans bg-[#EDECEA] min-h-screen">

    {{-- ============================================================
    HERO SECTION (Editorial Parallax)
    ============================================================ --}}
    <section class="relative w-full h-[80vh] md:h-screen overflow-hidden flex items-center justify-center pt-20">
        <!-- Parallax Background Image -->
        <div class="absolute inset-0 w-full h-[120%] -top-[10%] z-0">
            <img src="{{ asset('photo/' . $event->photo) }}" alt="{{ $event->judul }}" 
                 class="hero-parallax-img w-full h-full object-cover grayscale contrast-110 opacity-60">
            <div class="absolute inset-0 bg-gradient-to-b from-[#EDECEA]/0 via-[#EDECEA]/20 to-[#EDECEA] z-10"></div>
        </div>

        <!-- Content Overlay -->
        <div class="relative z-20 text-center px-8 max-w-6xl mx-auto">
            <div class="flex flex-col items-center">
                <span class="hero-reveal font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-orange mb-8 block">
                    {{ \Carbon\Carbon::parse($event->tgl_event)->format('F d, Y') }}
                </span>
                <h1 class="hero-reveal font-serif text-6xl md:text-9xl text-brand-deepbreath leading-[0.85] tracking-tighter mb-12">
                    @i18n($event, 'judul')
                </h1>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center gap-4 opacity-40">
            <div class="w-[1px] h-20 bg-brand-deepbreath origin-top scale-y-0 scroll-line"></div>
        </div>
    </section>

    {{-- ============================================================
    DETAIL STRIP (Metadata & Share)
    ============================================================ --}}
    <section class="detail-strip border-y hairline-border py-8 md:py-12 px-8 md:px-16 z-20 relative bg-[#EDECEA]">
        <div class="max-w-[1800px] mx-auto flex flex-wrap justify-between items-center gap-8">
            <div class="flex flex-wrap gap-12 md:gap-24">
                <!-- Date -->
                <div class="metadata-item flex flex-col gap-2">
                    <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40">Date</span>
                    <span class="font-sans text-xs md:text-sm font-bold text-brand-deepbreath uppercase tracking-wider">
                        {{ \Carbon\Carbon::parse($event->tgl_event)->format('d M Y') }}
                    </span>
                </div>

                <!-- Category -->
                @if($event->eventKategori)
                <div class="metadata-item flex flex-col gap-2">
                    <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40">Category</span>
                    <span class="font-sans text-xs md:text-sm font-bold text-brand-deepbreath uppercase tracking-wider">
                        {{ $event->eventKategori->name }}
                    </span>
                </div>
                @endif

                <!-- Share -->
                <div class="metadata-item flex flex-col gap-2">
                    <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40">Share</span>
                    <div class="flex gap-4">
                        <a href="#" class="text-brand-deepbreath hover:text-brand-orange transition-colors cursor-none hover-target">
                            <span class="iconify" data-icon="simple-icons:instagram" data-width="16"></span>
                        </a>
                        <a href="#" class="text-brand-deepbreath hover:text-brand-orange transition-colors cursor-none hover-target">
                            <span class="iconify" data-icon="simple-icons:x" data-width="16"></span>
                        </a>
                        <a href="#" class="text-brand-deepbreath hover:text-brand-orange transition-colors cursor-none hover-target">
                            <span class="iconify" data-icon="lucide:link" data-width="16"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
    EDITORIAL CONTENT (Sticky Narrative)
    ============================================================ --}}
    <section id="synopsis-section" class="py-32 px-8 md:px-16 z-10 relative">
        <div class="max-w-[1800px] mx-auto flex flex-col md:flex-row gap-20 md:gap-32 items-stretch">

            <!-- Poster Side (Editorial Frame) -->
            <div class="w-full md:w-[45%] reveal-image">
                <div class="aspect-[4/5] md:aspect-[3/4] w-full rounded-[2.5rem] overflow-hidden shadow-2xl bg-tint-2/20">
                    <img src="{{ asset('photo/' . $event->photo) }}" alt="{{ $event->judul }}"
                         class="w-full h-full object-cover grayscale contrast-110 hover:grayscale-0 transition-all duration-1000">
                </div>
            </div>

            <!-- Text Side (Sticky Content) -->
            <div class="w-full md:w-[55%] relative">
                <div class="sticky-content md:sticky md:top-40 w-full reveal-text">
                    <span class="font-sans text-[10px] tracking-[0.4em] uppercase text-brand-orange block mb-8">The Event.</span>
                    <div class="font-serif text-2xl md:text-3xl leading-[1.6] font-light text-brand-deepbreath/80 max-w-3xl detail-content">
                        @i18n($event, 'detail')
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ============================================================
    DISCOVER MORE (Bento Grid)
    ============================================================ --}}
    @if($all_event->count() > 0)
    <section class="py-32 px-8 md:px-16 border-t hairline-border bg-tint-3/30 relative z-10">
        <div class="max-w-[1800px] mx-auto">
            <div class="flex justify-between items-end mb-16">
                <h3 class="font-serif text-5xl md:text-7xl text-brand-deepbreath tracking-tighter italic">
                    Discover <span class="text-brand-orange not-italic">More.</span>
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                @foreach($all_event->take(3) as $item)
                <a href="{{ route('detail-event', $item->slug) }}" class="group reveal-rec flex flex-col gap-6 cursor-none hover-target">
                    <div class="aspect-[16/10] overflow-hidden rounded-3xl bg-tint-2/20 shadow-lg">
                        <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->judul }}" 
                             class="w-full h-full object-cover grayscale contrast-110 group-hover:grayscale-0 group-hover:scale-105 transition-all duration-1000">
                    </div>
                    <div>
                        <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40 mb-2 block">
                            {{ \Carbon\Carbon::parse($item->tgl_event)->format('F d, Y') }}
                        </span>
                        <h4 class="font-serif text-2xl text-brand-deepbreath leading-tight group-hover:text-brand-orange transition-colors">
                            @i18n($item, 'judul')
                        </h4>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</div>

{{-- Scripts --}}
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
            trigger: ".hero-parallax-img",
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

    // 4. Content Reveals
    document.querySelectorAll('.reveal-text, .reveal-image, .reveal-rec').forEach(el => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: "top 90%",
            },
            y: 50,
            opacity: 0,
            duration: 1.2,
            ease: "power4.out"
        });
    });

    // 5. Scroll Line Animation
    gsap.to(".scroll-line", {
        scaleY: 1,
        duration: 1.5,
        ease: "expo.inOut",
        repeat: -1,
        repeatDelay: 0.5
    });
});
</script>
@endpush

@include('components.footer')

@endsection