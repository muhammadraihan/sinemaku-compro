@extends('layouts.app')

@section('title', (isset($careers->position) ? $careers->position : $casting->pemeran) . ' | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

@push('head')
<style>
    body { background-color: #f6f6ed !important; }
    
    /* Clean career content styling */
    .career-content h2, .career-content h3 {
        font-family: 'Instrument Serif', serif;
        font-size: 2.5rem;
        margin-top: 3rem;
        margin-bottom: 1.5rem;
        color: #25225E;
        font-style: italic;
    }
    .career-content p {
        font-family: 'Helvetica', sans-serif;
        font-size: 1.1rem;
        line-height: 1.8;
        color: rgba(37, 34, 94, 0.8);
        margin-bottom: 1.5rem;
    }
    .career-content ul {
        margin-bottom: 2rem;
        padding-left: 1.5rem;
    }
    .career-content li {
        margin-bottom: 0.75rem;
        position: relative;
        list-style: none;
        padding-left: 1.5rem;
    }
    .career-content li::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0.6em;
        width: 6px;
        height: 6px;
        background: #FFB150;
        border-radius: 50%;
    }
</style>
@endpush

{{-- ============================================================
EDITORIAL WRAPPER
============================================================ --}}
<div id="editorial-wrapper" class="text-brand-deepbreath relative w-full font-sans min-h-screen pt-40 md:pt-48 pb-32">

    <div class="max-w-[1800px] mx-auto px-8 md:px-16">
        
        <!-- Header -->
        <header class="mb-20 md:mb-32 reveal-text">
            <span class="font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-orange mb-8 block">
                Opportunities
            </span>
            <h1 class="font-serif text-6xl md:text-9xl text-brand-deepbreath leading-[0.9] tracking-tighter mb-8 max-w-5xl">
                @if(isset($careers->position))
                    @i18n($careers, 'position')
                @else
                    @i18n($casting, 'pemeran')
                @endif
            </h1>
            <div class="font-sans text-lg md:text-2xl text-brand-deepbreath/40 uppercase tracking-widest font-bold">
                {{ $careers->tim ?? $casting->judul_film }}
            </div>
        </header>

        <!-- Main Layout -->
        <div class="flex flex-col lg:flex-row gap-20 lg:gap-40 items-start">
            
            <!-- Content Column -->
            <main class="w-full lg:w-2/3 career-content reveal-text">
                @if(isset($careers->detail))
                    @i18n($careers, 'detail')
                @else
                    @i18n($casting, 'detail')
                @endif
            </main>

            <!-- Sidebar Column (Sticky) -->
            <aside class="w-full lg:w-1/3 lg:sticky lg:top-40 reveal-rec">
                <div class="bg-brand-deepbreath text-[#f6f6ed] p-12 md:p-16 rounded-[3rem] shadow-2xl relative overflow-hidden">
                    <!-- Background Accent -->
                    <div class="absolute -top-20 -right-20 w-64 h-64 bg-brand-orange/10 rounded-full blur-3xl"></div>
                    
                    <div class="relative z-10 flex flex-col gap-12">
                        <!-- Metadata List -->
                        <div class="flex flex-col gap-8">
                            <!-- Location -->
                            <div class="flex flex-col gap-2">
                                <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-white/40">Location</span>
                                <span class="text-xl font-bold tracking-tight">{{ $careers->location ?? $casting->location }}</span>
                            </div>

                            @if (!empty($careers->status))
                                <!-- Type -->
                                <div class="flex flex-col gap-2 border-t border-white/10 pt-8">
                                    <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-white/40">Type</span>
                                    <span class="text-xl font-bold tracking-tight">{{ $careers->status }}</span>
                                </div>
                                <!-- Experience -->
                                <div class="flex flex-col gap-2 border-t border-white/10 pt-8">
                                    <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-white/40">Experience</span>
                                    <span class="text-xl font-bold tracking-tight">{{ $careers->pengalaman }}</span>
                                </div>
                            @else
                                <!-- Shoot Date -->
                                <div class="flex flex-col gap-2 border-t border-white/10 pt-8">
                                    <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-white/40">Shoot Date</span>
                                    <span class="text-xl font-bold tracking-tight">{{ \Carbon\Carbon::parse($casting->shoot_date)->format('d M Y') }}</span>
                                </div>
                                <!-- Gender / Age -->
                                <div class="flex flex-col gap-2 border-t border-white/10 pt-8">
                                    <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-white/40">Gender / Age</span>
                                    <span class="text-xl font-bold tracking-tight">{{ $casting->gender == 'L' ? 'Male' : 'Female' }}, {{ $casting->umur }} Yrs</span>
                                </div>
                                <!-- Deadline -->
                                <div class="flex flex-col gap-2 border-t border-white/10 pt-8">
                                    <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-white/40">Deadline</span>
                                    <span class="text-xl font-bold tracking-tight text-brand-orange">{{ \Carbon\Carbon::parse($casting->deadline)->format('d M Y') }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- CTA -->
                        <a href="{{ $careers->link ?? $casting->link }}" target="_blank" class="bg-[#f6f6ed] text-brand-deepbreath font-sans text-xs tracking-[0.2em] uppercase font-bold py-6 px-8 text-center hover:bg-brand-orange hover:text-white transition-all duration-500 cursor-none hover-target shadow-xl" data-i18n="label_apply_now">
                            Apply For This Position
                        </a>
                    </div>
                </div>

                <!-- Others Section -->
                <div class="mt-20">
                    <h4 class="font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-deepbreath/40 mb-8 border-b hairline-border pb-4" data-i18n="label_other_openings">Other Openings</h4>
                    <div class="flex flex-col gap-8">
                        @if (!empty($careers->status))
                            @foreach ($all_careers->take(3) as $item)
                                <a href="{{ route('detail-careers', $item->slug) }}" class="group flex flex-col gap-2 cursor-none hover-target">
                                    <span class="font-serif text-2xl text-brand-deepbreath group-hover:text-brand-orange transition-colors">@i18n($item, 'position')</span>
                                    <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/30">{{ $item->tim }} · {{ $item->location }}</span>
                                </a>
                            @endforeach
                        @else
                            @foreach ($all_casting->take(3) as $item)
                                <a href="{{ route('detail-careers', $item->slug) }}" class="group flex flex-col gap-2 cursor-none hover-target">
                                    <span class="font-serif text-2xl text-brand-deepbreath group-hover:text-brand-orange transition-colors">@i18n($item, 'pemeran')</span>
                                    <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/30">{{ $item->judul_film }} · {{ $item->location }}</span>
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
