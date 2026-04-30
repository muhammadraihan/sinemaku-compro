@extends('layouts.app')

@section('title', 'Articles | Sinemaku Pictures')

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
    HEADER & FILTERS
    ============================================================ --}}
    <section class="pt-40 md:pt-48 px-8 md:px-16 max-w-[1800px] mx-auto relative z-10">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end border-b hairline-border pb-12 mb-20 gap-8">
            <h2 class="font-serif text-6xl md:text-8xl text-brand-deepbreath leading-none tracking-tight">
                <span data-i18n="page_articles_1">Our</span> <span data-i18n="page_articles_2" class="italic text-brand-orange">Articles.</span>
            </h2>

            <div class="flex gap-6 font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40 flex-wrap" id="article-filters">
                @foreach($artikel_kategori as $cat)
                <button class="filter-btn border-b border-transparent hover:text-brand-deepbreath pb-1 hover-target cursor-none transition-all" data-filter="{{ $cat->uuid }}">{{ $cat->name }}</button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
    ARTICLE LIST (ALTERNATING BENTO)
    ============================================================ --}}
    <section class="px-8 md:px-16 pb-32 max-w-[1800px] mx-auto relative z-10" id="article-list">
        @php
            $displayItems = collect();
            if($articles) $displayItems->push($articles);
            foreach($all_articles as $item) $displayItems->push($item);
        @endphp

        @if($displayItems->count() > 0)
            <div class="flex flex-col gap-24 md:gap-40">
                @foreach($displayItems as $index => $item)
                @php
                    $isEven = $index % 2 != 0; 
                    $flexDir = $isEven ? 'md:flex-row-reverse' : 'md:flex-row';
                    $url = ($item->kategori == 'external') ? $item->link : route('detail-articles', $item->slug);
                    $target = ($item->kategori == 'external') ? '_blank' : '_self';
                @endphp
                <article class="article-row flex flex-col {{ $flexDir }} items-stretch gap-8 md:gap-20 group relative" data-category="{{ $item->artikel_kategori_uuid }}" id="article-row-{{ $index }}">
                    
                    <!-- Media / Poster -->
                    <div class="w-full md:w-[45%] shrink-0 reveal-image">
                        <a href="{{ $url }}" target="{{ $target }}" class="block w-full aspect-[4/5] md:aspect-[3/4] overflow-hidden rounded-[2rem] bg-tint-2/20 cursor-none hover-target shadow-xl">
                            <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->judul }}" loading="lazy" class="w-full h-full object-cover grayscale contrast-110 group-hover:grayscale-0 group-hover:scale-105 transition-all duration-1000 ease-[cubic-bezier(0.16,1,0.3,1)]">
                        </a>
                    </div>

                    <!-- Content (Sticky Wrapper) -->
                    <div class="w-full md:w-[55%] py-4 md:py-12 relative">
                        <div class="sticky-content w-full md:sticky md:top-40 reveal-text">
                            <!-- Meta -->
                            <div class="flex gap-4 items-center font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/50 mb-6 md:mb-8">
                                @if($item->artikelKategori)
                                    <span class="text-brand-orange">{{ $item->artikelKategori->name }}</span>
                                    <span class="opacity-30">•</span>
                                @endif
                                <span>{{ $item->penulis }}</span>
                                <span class="opacity-30">•</span>
                                <span>{{ \Carbon\Carbon::parse($item->tgl_rilis)->format('d M Y') }}</span>
                            </div>

                            <!-- Title -->
                            <h2 class="font-serif text-5xl md:text-7xl leading-[0.9] text-brand-deepbreath tracking-tight mb-6 md:mb-8 group-hover:text-brand-orange transition-colors duration-500">
                                <a href="{{ $url }}" target="{{ $target }}" class="cursor-none hover-target">@i18n($item, 'judul')</a>
                            </h2>

                            <!-- Excerpt -->
                            <div class="font-sans text-base md:text-lg font-light text-brand-deepbreath/70 leading-relaxed mb-10 md:mb-12 max-w-2xl line-clamp-4">
                                @i18n($item, 'title')
                            </div>

                            <!-- CTA -->
                            <a href="{{ $url }}" target="{{ $target }}" class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath border-b border-brand-deepbreath/30 pb-2 hover:border-brand-deepbreath hover:text-brand-orange transition-all cursor-none hover-target inline-flex items-center gap-4 self-start">
                                <span data-i18n="label_read_story">Read Story</span> <span class="iconify" data-icon="lucide:arrow-right"></span>
                            </a>
                        </div>
                    </div>

                </article>
                @endforeach
            </div>
        @else
            <div class="py-40 text-center font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40">
                No articles available at this moment.
            </div>
        @endif
    </section>

</div>

{{-- Scripts --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        // Reveal Animations using GSAP
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

    // Filtering Logic (Toggle System)
    const btns = document.querySelectorAll('.filter-btn');
    const rows = document.querySelectorAll('.article-row');
    let activeFilter = 'all';

    btns.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.getAttribute('data-filter');
            
            if (activeFilter === filter) {
                activeFilter = 'all';
                btn.classList.remove('text-brand-deepbreath', 'border-brand-deepbreath');
                btn.classList.add('border-transparent', 'text-brand-deepbreath/40');
            } else {
                btns.forEach(b => {
                    b.classList.remove('text-brand-deepbreath', 'border-brand-deepbreath');
                    b.classList.add('border-transparent', 'text-brand-deepbreath/40');
                });
                btn.classList.add('text-brand-deepbreath', 'border-brand-deepbreath');
                btn.classList.remove('border-transparent', 'text-brand-deepbreath/40');
                activeFilter = filter;
            }

            rows.forEach(row => {
                const category = row.getAttribute('data-category');
                if (activeFilter === 'all' || category === activeFilter) {
                    row.style.display = 'flex';
                    if (typeof ScrollTrigger !== 'undefined') ScrollTrigger.refresh();
                } else {
                    row.style.display = 'none';
                    if (typeof ScrollTrigger !== 'undefined') ScrollTrigger.refresh();
                }
            });
        });
    });
});
</script>

@include('components.footer')

@endsection
