@extends('layouts.app')

@section('title', 'Careers | Sinemaku Pictures')

@section('content')

@include('partials.navbar', ['navTheme' => 'event'])

@push('head')
<style>
</style>
@endpush

{{-- ============================================================
EDITORIAL WRAPPER
============================================================ --}}
<div id="editorial-wrapper" class="text-brand-deepbreath relative w-full font-sans min-h-screen pt-32 pb-40">

    <div class="max-w-[1600px] mx-auto px-6 md:px-10">
        
        {{-- 1. PAGE HEADER (Centered) --}}
        <div class="text-center mb-24 reveal-text">
            <h1 class="font-instrument italic text-2xl md:text-5xl lg:text-6xl text-brand-orange leading-[0.8] tracking-tight lowercase">
                Explore Your <span class="font-peckham not-italic uppercase text-brand-orange tracking-tighter">CAREER</span> Opportunities
            </h1>
        </div>

        {{-- 2. CATEGORY BOXES --}}
        <div class="flex flex-col gap-6 md:gap-8 mx-auto">
            
            {{-- BOX 1: INTERNSHIP (ORANGE) --}}
            @php
                $firstIntern = $careers->filter(fn($c) => str_contains(strtolower($c->position), 'intern'))->first();
                $internUrl = $firstIntern ? route('detail-careers', $firstIntern->slug) : '#latest-openings';
            @endphp
            <a href="{{ $internUrl }}" class="career-card group relative bg-brand-orange rounded-xl p-8 md:p-12 overflow-hidden transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl hover:shadow-brand-orange/30 shadow-xl shadow-brand-orange/20 reveal-item block cursor-none hover-target">
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                    <div class="max-w-2xl">
                        <h2 class="font-peckham text-3xl md:text-5xl text-white uppercase leading-none mb-2">
                            INTERNSHIP <span class="font-instrument italic text-xl md:text-3xl normal-case opacity-90">for College Student</span>
                        </h2>
                        <p class="font-sans text-xs md:text-sm text-white/80 leading-relaxed line-clamp-2">
                            Gain hands-on experience in the film industry. We open opportunities for passionate students to learn and grow with our creative teams across various departments.
                        </p>
                    </div>
                    <div class="px-8 py-3 rounded-full border border-white/40 text-white font-sans text-[10px] tracking-[0.2em] font-bold uppercase group-hover:bg-white group-hover:text-brand-orange transition-all duration-300">
                        LEARN MORE
                    </div>
                </div>
            </a>

            {{-- BOX 2: OPEN CASTING (NAVY) --}}
            @php
                $firstCasting = $casting->first();
                $castingUrl = $firstCasting ? route('detail-careers', $firstCasting->slug) : '#latest-openings';
            @endphp
            <a href="{{ $castingUrl }}" class="career-card group relative bg-[#0E1633] rounded-xl p-8 md:p-12 overflow-hidden transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl hover:shadow-black/40 shadow-xl shadow-black/20 reveal-item block cursor-none hover-target">
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                    <div class="max-w-2xl">
                        <h2 class="font-peckham text-3xl md:text-5xl text-white uppercase leading-none mb-2">
                            OPEN CASTING <span class="font-instrument italic text-xl md:text-3xl normal-case opacity-90">for public</span>
                        </h2>
                        <p class="font-sans text-xs md:text-sm text-white/80 leading-relaxed line-clamp-2">
                            We are always looking for new faces and extraordinary talents. Browse our latest projects and find your chance to shine on the big screen.
                        </p>
                    </div>
                    <div class="px-8 py-3 rounded-full border border-white/40 text-white font-sans text-[10px] tracking-[0.2em] font-bold uppercase group-hover:bg-white group-hover:text-brand-navy transition-all duration-300">
                        LEARN MORE
                    </div>
                </div>
            </a>

            {{-- BOX 3: VOLUNTEER (LIGHT) --}}
            @php
                $firstVolun = $careers->filter(fn($c) => str_contains(strtolower($c->position), 'volunteer'))->first();
                $volunUrl = $firstVolun ? route('detail-careers', $firstVolun->slug) : '#latest-openings';
            @endphp
            <a href="{{ $volunUrl }}" class="career-card group relative bg-white border border-brand-navy/5 rounded-xl p-8 md:p-12 overflow-hidden transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl hover:shadow-brand-navy/10 shadow-xl shadow-brand-navy/5 reveal-item block cursor-none hover-target">
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                    <div class="max-w-2xl">
                        <h2 class="font-peckham text-3xl md:text-5xl text-brand-orange uppercase leading-none mb-2">
                            VOLUNTEER <span class="font-instrument italic text-xl md:text-3xl normal-case text-brand-navy opacity-60">for upcoming events</span>
                        </h2>
                        <p class="font-sans text-xs md:text-sm text-brand-navy/60 leading-relaxed line-clamp-2">
                            Be part of our vibrant community and help us bring cinematic magic to life. Perfect for those who love events, production, and networking.
                        </p>
                    </div>
                    <div class="px-8 py-3 rounded-full border border-brand-navy/20 text-brand-navy font-sans text-[10px] tracking-[0.2em] font-bold uppercase group-hover:bg-brand-navy group-hover:text-white transition-all duration-300">
                        LEARN MORE
                    </div>
                </div>
            </a>

        </div>

        {{-- 3. CURRENT OPENINGS (Existing List but redesigned) --}}
        <div id="latest-openings" class="mt-40 mx-auto scroll-mt-32">
            <h4 class="font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-deepbreath/40 mb-12 border-b hairline-border pb-6 flex justify-between items-end">
                <span>LATEST OPENINGS</span>
                <span class="text-brand-orange">{{ $careers->count() + $casting->count() }} TOTAL</span>
            </h4>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12">
                @foreach ($careers->take(4) as $item)
                <a href="{{ route('detail-careers', $item->slug) }}" class="group flex justify-between items-center py-8 border-b hairline-border cursor-none hover-target reveal-text">
                    <div class="flex flex-col gap-1">
                        <span class="font-sans text-[8px] tracking-[0.2em] font-bold text-brand-orange uppercase">{{ $item->tim }}</span>
                        <h5 class="font-serif text-2xl text-brand-navy group-hover:text-brand-orange transition-colors">@i18n($item, 'position')</h5>
                    </div>
                    <span class="iconify text-xl opacity-20 group-hover:opacity-100 group-hover:translate-x-2 transition-all" data-icon="lucide:arrow-right"></span>
                </a>
                @endforeach
                
                @foreach ($casting->take(4) as $item)
                <a href="{{ route('detail-careers', $item->slug) }}" class="group flex justify-between items-center py-8 border-b hairline-border cursor-none hover-target reveal-text">
                    <div class="flex flex-col gap-1">
                        <span class="font-sans text-[8px] tracking-[0.2em] font-bold text-brand-orange uppercase">{{ $item->judul_film }}</span>
                        <h5 class="font-serif text-2xl text-brand-navy group-hover:text-brand-orange transition-colors">@i18n($item, 'pemeran')</h5>
                    </div>
                    <span class="iconify text-xl opacity-20 group-hover:opacity-100 group-hover:translate-x-2 transition-all" data-icon="lucide:arrow-right"></span>
                </a>
                @endforeach
            </div>
        </div>

    </div>

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
