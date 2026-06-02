@extends('layouts.app')

@section('title', (isset($careers->position) ? $careers->position : $casting->pemeran) . ' | Sinemaku Pictures')

@section('content')

@include('partials.navbar', ['navTheme' => 'event'])

@push('head')
<style>
    
    /* Clean career content styling */
    .career-content h2, .career-content h3 {
        font-family: 'PeckhamPress', sans-serif;
        text-transform: uppercase;
        font-size: 2.25rem;
        margin-top: 3.5rem;
        margin-bottom: 1.5rem;
        color: #0E1633;
        letter-spacing: -0.02em;
    }
    .career-content h4 {
        font-family: 'Instrument Serif', serif;
        font-size: 1.75rem;
        font-style: italic;
        color: #F36B21;
        margin-top: 2rem;
    }
    .career-content p {
        font-family: 'Helvetica', 'Arial', sans-serif;
        font-size: 1rem;
        line-height: 1.7;
        color: rgba(14, 22, 51, 0.7);
        margin-bottom: 1.5rem;
    }
    .career-content ul {
        margin-bottom: 2.5rem;
        padding-left: 0.5rem;
    }
    .career-content li {
        margin-bottom: 0.75rem;
        position: relative;
        list-style: none;
        padding-left: 1.75rem;
        color: rgba(14, 22, 51, 0.8);
    }
    .career-content li::before {
        content: "—";
        position: absolute;
        left: 0;
        color: #F36B21;
        font-weight: bold;
    }
    .career-content strong {
        color: #0E1633;
    }
    .career-content a {
        color: #F36B21;
        text-decoration: underline;
        text-underline-offset: 4px;
        transition: opacity 0.3s;
    }
    .career-content a:hover {
        opacity: 0.7;
    }
</style>
@endpush

{{-- ============================================================
EDITORIAL WRAPPER
============================================================ --}}
<div id="editorial-wrapper" class="text-brand-deepbreath relative w-full font-sans min-h-screen pt-32 pb-40">

    <div class="max-w-[1600px] mx-auto px-6 md:px-12">
        
        {{-- 1. PAGE HEADER (Centered) --}}
        <header class="text-center mb-24 md:mb-32 reveal-text">
            <span class="font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-orange mb-6 block">
                Career Opportunity
            </span>
            <h1 class="font-instrument italic text-3xl md:text-5xl lg:text-6xl text-brand-navy leading-none mb-4 lowercase">
                Join our family as
            </h1>
            <h2 class="font-peckham uppercase text-5xl md:text-8xl lg:text-9xl text-brand-orange leading-[0.8] tracking-tighter">
                @if(isset($careers->position))
                    @i18n($careers, 'position')
                @else
                    @i18n($casting, 'pemeran')
                @endif
            </h2>
            <div class="mt-12 flex items-center justify-center gap-4">
                <div class="h-[1px] w-12 bg-brand-navy/20"></div>
                <span class="font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-navy/40">
                    {{ $careers->tim ?? $casting->judul_film }}
                </span>
                <div class="h-[1px] w-12 bg-brand-navy/20"></div>
            </div>
        </header>

        {{-- 2. MAIN CONTENT GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 md:gap-24 items-start">
            
            {{-- LEFT COLUMN: DETAIL CONTENT --}}
            <main class="lg:col-span-8 career-content reveal-text">
                <div class="prose prose-brand-navy max-w-none">
                    @if(isset($careers->detail))
                        @i18n($careers, 'detail')
                    @else
                        @i18n($casting, 'detail')
                    @endif
                </div>
            </main>

            {{-- RIGHT COLUMN: SIDEBAR --}}
            <aside class="lg:col-span-4 lg:sticky lg:top-40 reveal-rec">
                <div class="bg-white border border-brand-navy/5 rounded-2xl p-8 md:p-12 shadow-xl shadow-brand-navy/5 relative overflow-hidden">
                    
                    <h3 class="font-peckham text-2xl text-brand-navy uppercase mb-10 tracking-tight flex items-center gap-3">
                        <span class="w-2 h-2 rounded-full bg-brand-orange"></span>
                        Job Summary
                    </h3>

                    <div class="flex flex-col gap-8">
                        {{-- Location --}}
                        <div class="flex flex-col gap-2">
                            <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-brand-navy/30">Location</span>
                            <span class="text-xl font-serif text-brand-navy italic">{{ $careers->location ?? $casting->location }}</span>
                        </div>

                        @if (!empty($careers->status))
                            <div class="h-[1px] w-full bg-brand-navy/5"></div>
                            {{-- Type --}}
                            <div class="flex flex-col gap-2">
                                <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-brand-navy/30">Contract Type</span>
                                <span class="text-xl font-serif text-brand-navy italic">{{ $careers->status }}</span>
                            </div>
                            <div class="h-[1px] w-full bg-brand-navy/5"></div>
                            {{-- Experience --}}
                            <div class="flex flex-col gap-2">
                                <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-brand-navy/30">Requirement</span>
                                <span class="text-lg font-sans text-brand-navy/70 leading-snug">{{ $careers->pengalaman }}</span>
                            </div>
                        @else
                            <div class="h-[1px] w-full bg-brand-navy/5"></div>
                            {{-- Shoot Date --}}
                            <div class="flex flex-col gap-2">
                                <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-brand-navy/30">Shoot Date</span>
                                <span class="text-xl font-serif text-brand-navy italic">{{ \Carbon\Carbon::parse($casting->shoot_date)->format('d M Y') }}</span>
                            </div>
                            <div class="h-[1px] w-full bg-brand-navy/5"></div>
                            {{-- Gender / Age --}}
                            <div class="flex flex-col gap-2">
                                <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-brand-navy/30">Profile</span>
                                <span class="text-xl font-serif text-brand-navy italic">{{ $casting->gender == 'L' ? 'Male' : 'Female' }}, {{ $casting->umur }} Yrs</span>
                            </div>
                            <div class="h-[1px] w-full bg-brand-navy/5"></div>
                            {{-- Deadline --}}
                            <div class="flex flex-col gap-2">
                                <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-brand-orange/60">Application Deadline</span>
                                <span class="text-xl font-peckham text-brand-orange uppercase">{{ \Carbon\Carbon::parse($casting->deadline)->format('d M Y') }}</span>
                            </div>
                        @endif

                        {{-- CTA BUTTON --}}
                        <a href="{{ $careers->link ?? $casting->link }}" target="_blank" class="mt-6 bg-brand-navy text-white font-sans text-[10px] tracking-[0.2em] uppercase font-bold py-5 px-8 text-center rounded-xl hover:bg-brand-orange transition-all duration-500 cursor-none hover-target shadow-lg shadow-brand-navy/10">
                            Apply Now
                        </a>
                    </div>
                </div>

                {{-- SIMILAR OPENINGS --}}
                <div class="mt-16 px-4">
                    <h4 class="font-instrument italic text-3xl text-brand-navy/40 mb-8 border-b border-brand-navy/5 pb-4">Other Openings</h4>
                    <div class="flex flex-col gap-8">
                        @if (!empty($careers->status))
                            @foreach ($all_careers->take(3) as $item)
                                <a href="{{ route('detail-careers', $item->slug) }}" class="group flex flex-col gap-1 cursor-none hover-target">
                                    <h5 class="font-peckham text-xl text-brand-navy group-hover:text-brand-orange transition-colors uppercase leading-none">@i18n($item, 'position')</h5>
                                    <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-brand-navy/30">{{ $item->tim }} · {{ $item->location }}</span>
                                </a>
                            @endforeach
                        @else
                            @foreach ($all_casting->take(3) as $item)
                                <a href="{{ route('detail-careers', $item->slug) }}" class="group flex flex-col gap-1 cursor-none hover-target">
                                    <h5 class="font-peckham text-xl text-brand-navy group-hover:text-brand-orange transition-colors uppercase leading-none">@i18n($item, 'pemeran')</h5>
                                    <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-brand-navy/30">{{ $item->judul_film }} · {{ $item->location }}</span>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </aside>

        </div>

    </div>

</div>

{{-- Scripts --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap === 'undefined') return;

    gsap.registerPlugin(ScrollTrigger);

    // 1. Content Reveals
    document.querySelectorAll('.reveal-text, .reveal-rec').forEach(el => {
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
});
</script>
@endpush

@include('components.footer')

@endsection
