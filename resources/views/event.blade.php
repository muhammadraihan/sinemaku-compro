@extends('layouts.app')

@section('title', 'Events | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

@push('head')
<style>
    body { background-color: #f6f6ed !important; }
</style>
@endpush

{{-- ============================================================
EDITORIAL WRAPPER
============================================================ --}}
<div id="editorial-wrapper" class="text-brand-deepbreath relative w-full font-sans min-h-screen">

    {{-- ============================================================
    HEADER
    ============================================================ --}}
    <section class="pt-40 md:pt-48 px-8 md:px-16 max-w-[1800px] mx-auto relative z-10">
        <div class="border-b hairline-border pb-12 mb-20">
            <h2 class="font-serif text-6xl md:text-8xl text-brand-deepbreath leading-none tracking-tight">
                Our <span class="italic text-brand-orange">Events.</span>
            </h2>
        </div>
    </section>

    {{-- ============================================================
    EVENT LIST (GROUPED BY CATEGORY WITH INDEX HEADERS)
    ============================================================ --}}
    <section class="px-8 md:px-16 pb-32 max-w-[1800px] mx-auto relative z-10" id="event-list">
        @php
            // Group events by category
            $groupedEvents = $event->groupBy('event_kategori_uuid');
            $catIndex = 1;
        @endphp

        @if($groupedEvents->count() > 0)
            <div class="flex flex-col gap-32 md:gap-48">
                @foreach($groupedEvents as $catUuid => $events)
                    @php
                        $categoryName = $events->first()->eventKategori->name ?? 'Events';
                    @endphp
                    
                    <div class="category-block flex flex-col gap-16 md:gap-24">
                        <!-- Category Header with Index -->
                        <div class="flex items-baseline gap-6 md:gap-10 border-b hairline-border pb-8 reveal-text">
                            <span class="font-sans text-xl md:text-2xl font-bold text-brand-orange/40">{{ str_pad($catIndex++, 2, '0', STR_PAD_LEFT) }}</span>
                            <h3 class="font-serif text-4xl md:text-6xl text-brand-deepbreath">{{ $categoryName }}</h3>
                        </div>

                        <div class="flex flex-col gap-24 md:gap-40">
                            @foreach($events as $index => $item)
                                @php
                                    // Alternate row direction for editorial rhythm within category
                                    $flexDir = ($index % 2 != 0) ? 'md:flex-row-reverse' : 'md:flex-row';
                                @endphp
                                <article class="event-row flex flex-col {{ $flexDir }} items-stretch gap-8 md:gap-20 group relative" id="event-row-{{ $catUuid }}-{{ $index }}">
                                    
                                    <!-- Media / Poster -->
                                    <div class="w-full md:w-[45%] shrink-0 reveal-image">
                                        <a href="{{ route('detail-event', $item->slug) }}" class="block w-full aspect-[4/5] md:aspect-[3/4] overflow-hidden rounded-[2rem] bg-tint-2/20 cursor-none hover-target shadow-xl">
                                            <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->judul }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-1000 ease-[cubic-bezier(0.16,1,0.3,1)]">
                                        </a>
                                    </div>

                                    <!-- Content (Sticky Wrapper) -->
                                    <div class="w-full md:w-[55%] py-4 md:py-12 relative">
                                        <div class="sticky-content w-full md:sticky md:top-40 reveal-text">
                                            <!-- Meta -->
                                            <div class="flex gap-4 items-center font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/50 mb-6 md:mb-8">
                                                <span class="text-brand-orange">{{ $categoryName }}</span>
                                                <span class="opacity-30">•</span>
                                                <span>{{ \Carbon\Carbon::parse($item->tgl_event)->format('d M Y') }}</span>
                                            </div>

                                            <!-- Title -->
                                            <h2 class="font-serif text-5xl md:text-7xl leading-[0.9] text-brand-deepbreath tracking-tight mb-6 md:mb-8 group-hover:text-brand-orange transition-colors duration-500">
                                                <a href="{{ route('detail-event', $item->slug) }}" class="cursor-none hover-target">@i18n($item, 'judul')</a>
                                            </h2>

                                            <!-- Excerpt -->
                                            <div class="font-sans text-base md:text-lg font-light text-brand-deepbreath/70 leading-relaxed mb-10 md:mb-12 max-w-2xl line-clamp-3">
                                                {{ $item->title }}
                                            </div>

                                            <!-- CTA -->
                                            <a href="{{ route('detail-event', $item->slug) }}" class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath border-b border-brand-deepbreath/30 pb-2 hover:border-brand-deepbreath hover:text-brand-orange transition-all cursor-none hover-target inline-flex items-center gap-4 self-start">
                                                <span data-i18n="label_explore_event">Explore Event</span> <span class="iconify" data-icon="lucide:arrow-right"></span>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-40 text-center font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40">
                No events available at this moment.
            </div>
        @endif
    </section>

</div>

{{-- Scripts --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        // Reveal Animations using GSAP for better control
        document.querySelectorAll('.reveal-text, .reveal-image').forEach(el => {
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
    }
});
</script>

@include('components.footer')

@endsection
