@extends('layouts.app')

@section('title', 'Careers | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

@push('head')
<style>
    body { background-color: #EDECEA !important; }
</style>
@endpush

{{-- ============================================================
EDITORIAL WRAPPER
============================================================ --}}
<div id="editorial-wrapper" class="text-brand-deepbreath relative w-full font-sans min-h-screen">

    {{-- ============================================================
    HERO SECTION (Clean Editorial)
    ============================================================ --}}
    <section class="relative w-full h-[50vh] md:h-[60vh] overflow-hidden flex items-center justify-center pt-20">
        <!-- Content Overlay -->
        <div class="relative z-20 text-center px-8 max-w-6xl mx-auto">
            <div class="flex flex-col items-center">
                <span class="hero-reveal font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-orange mb-8 block">
                    Join the Family
                </span>
                <h1 class="hero-reveal font-serif text-6xl md:text-9xl text-brand-deepbreath leading-[0.85] tracking-tighter mb-8">
                    <span data-i18n="page_careers_1">Our</span> <span data-i18n="page_careers_2" class="italic text-brand-orange">Careers.</span>
                </h1>
            </div>
        </div>
    </section>

    {{-- ============================================================
    OPEN POSITIONS SECTION
    ============================================================ --}}
    <section class="pb-32 px-8 md:px-16 max-w-[1800px] mx-auto relative z-10">
        <!-- Section Header (Static) -->
        <div class="flex items-start gap-8 mb-16 md:mb-24 reveal-text">
            <div class="flex flex-col">
                <span class="font-serif text-7xl md:text-9xl text-brand-deepbreath/10 leading-none">01</span>
                <div class="flex items-center gap-4 -mt-4 md:-mt-8">
                    <span class="vertical-text font-sans text-[9px] tracking-[0.4em] uppercase font-bold text-brand-orange">Opportunities</span>
                    <h2 class="font-serif text-4xl md:text-6xl text-brand-deepbreath italic" data-i18n="label_open_positions">Open Positions</h2>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:pl-32 lg:pl-48">
            @foreach ($careers as $index => $item)
            <a href="{{ route('detail-careers', $item->slug) }}" class="group flex flex-col md:flex-row justify-between items-start md:items-center py-12 md:py-20 border-b hairline-border hover:bg-brand-deepbreath/[0.02] transition-all duration-700 cursor-none hover-target reveal-item" style="transition-delay: {{ $index * 0.1 }}s">
                <div class="flex flex-col gap-4">
                    <h3 class="font-serif text-3xl md:text-5xl text-brand-deepbreath group-hover:text-brand-orange transition-colors duration-500">@i18n($item, 'position')</h3>
                    <div class="flex gap-6 font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40">
                        <span>{{ $item->tim }}</span>
                        <span class="opacity-30">•</span>
                        <span>{{ $item->location }}</span>
                        <span class="opacity-30">•</span>
                        <span>Posted {{ $item->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="mt-8 md:mt-0 opacity-20 group-hover:opacity-100 group-hover:translate-x-4 transition-all duration-700">
                    <span class="iconify text-4xl" data-icon="lucide:arrow-right"></span>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    {{-- ============================================================
    CASTING CALLS SECTION
    ============================================================ --}}
    <section class="pb-40 px-8 md:px-16 max-w-[1800px] mx-auto relative z-10">
        <!-- Section Header (Static) -->
        <div class="flex items-start gap-8 mb-16 md:mb-24 reveal-text">
            <div class="flex flex-col">
                <span class="font-serif text-7xl md:text-9xl text-brand-deepbreath/10 leading-none">02</span>
                <div class="flex items-center gap-4 -mt-4 md:-mt-8">
                    <span class="vertical-text font-sans text-[9px] tracking-[0.4em] uppercase font-bold text-brand-orange">Castings</span>
                    <h2 class="font-serif text-4xl md:text-6xl text-brand-deepbreath italic" data-i18n="label_casting_calls">Casting Calls</h2>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:pl-32 lg:pl-48">
            @foreach ($casting as $index => $item)
            <a href="{{ route('detail-careers', $item->slug) }}" class="group flex flex-col md:flex-row justify-between items-start md:items-center py-12 md:py-20 border-b hairline-border hover:bg-brand-deepbreath/[0.02] transition-all duration-700 cursor-none hover-target reveal-item" style="transition-delay: {{ $index * 0.1 }}s">
                <div class="flex flex-col gap-4">
                    <h3 class="font-serif text-3xl md:text-5xl text-brand-deepbreath group-hover:text-brand-orange transition-colors duration-500">@i18n($item, 'pemeran')</h3>
                    <div class="flex flex-wrap gap-6 font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40">
                        <span class="text-brand-orange">{{ $item->judul_film }}</span>
                        <span class="opacity-30">•</span>
                        <span>{{ $item->gender == 'L' ? 'Male' : 'Female' }}</span>
                        <span class="opacity-30">•</span>
                        <span>{{ $item->umur }} Yrs</span>
                        <span class="opacity-30">•</span>
                        <span>{{ $item->location }}</span>
                    </div>
                </div>
                <div class="mt-8 md:mt-0 opacity-20 group-hover:opacity-100 group-hover:translate-x-4 transition-all duration-700">
                    <span class="iconify text-4xl" data-icon="lucide:arrow-right"></span>
                </div>
            </a>
            @endforeach
        </div>
    </section>

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

    // 2. Section Headings Reveal
    document.querySelectorAll('.reveal-text').forEach(el => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: "top 90%",
            },
            y: 30,
            opacity: 0,
            duration: 1,
            ease: "power3.out"
        });
    });

    // 3. List Items Staggered Reveal
    document.querySelectorAll('.reveal-item').forEach(el => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: "top 95%",
            },
            y: 40,
            opacity: 0,
            duration: 1.2,
            ease: "power4.out"
        });
    });
});
</script>
@endpush

@include('components.footer')

@endsection