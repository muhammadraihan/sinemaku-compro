@extends('layouts.app')

@section('title', 'Articles | Sinemaku Pictures')

@section('content')

@include('partials.navbar', ['navTheme' => 'event'])

<style>


    .font-peckham { font-family: 'PeckhamPress', sans-serif; }
    .font-serif { font-family: 'Instrument Serif', serif; }

    .article-title {
        line-height: 0.9;
        letter-spacing: -0.02em;
    }

    .filter-btn {
        transition: all 0.4s ease;
    }
    .filter-btn.active {
        background-color: #F36B21;
        color: white;
        border-color: #F36B21;
    }
    
    .search-input::placeholder {
        color: #22397A;
        opacity: 0.5;
    }

    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>


<div id="editorial-wrapper" class="relative w-full min-h-screen pt-40 md:pt-48 pb-40 px-8 md:px-16 max-w-[1800px] mx-auto z-10">
    
    {{-- ============================================================
    FILTERS & SEARCH
    ============================================================ --}}
    <div class="flex flex-col items-center gap-10 mb-20 md:mb-32">
        {{-- Category Pills --}}
        <div class="flex flex-wrap justify-center gap-4">
            <button class="category-filter filter-btn active px-8 py-3 rounded-full border border-brand-orange/20 text-[10px] font-bold tracking-[0.2em] uppercase cursor-none hover-target" data-category="all">ALL</button>
            <button class="category-filter filter-btn px-8 py-3 rounded-full border border-brand-orange/20 text-[10px] font-bold tracking-[0.2em] uppercase cursor-none hover-target" data-category="PRESS RELEASE">PRESS RELEASE</button>
            <button class="category-filter filter-btn px-8 py-3 rounded-full border border-brand-orange/20 text-[10px] font-bold tracking-[0.2em] uppercase cursor-none hover-target" data-category="ARTICLES">ARTICLES</button>
        </div>

        {{-- Sort & Search --}}
        <div class="flex flex-col md:flex-row gap-4 w-full max-w-[700px]">
            {{-- Sort Dropdown --}}
            <div class="flex-1 relative group">
                <div id="sort-trigger" class="w-full h-full bg-[#F36B21]/10 border border-[#F36B21]/40 rounded-[1.5rem] px-8 py-4 flex flex-col justify-center cursor-none hover-target">
                    <span class="text-[8px] uppercase font-bold tracking-widest opacity-50 mb-0.5">Sort by</span>
                    <div class="flex items-center justify-between">
                        <span id="current-sort" class="text-xs font-bold text-[#22397A]">Newest to Old</span>
                        <svg class="w-4 h-4 text-[#22397A]/40 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
                {{-- Sort Menu --}}
                <div id="sort-menu" class="absolute top-full left-0 w-full mt-2 bg-white rounded-2xl shadow-2xl border border-[#F36B21]/10 p-2 opacity-0 pointer-events-none transform -translate-y-2 transition-all duration-300 z-50">
                    <button class="sort-option w-full text-left px-6 py-3 rounded-xl hover:bg-brand-orange/5 text-xs font-bold text-brand-navy transition-colors" data-sort="newest">Newest to Old</button>
                    <button class="sort-option w-full text-left px-6 py-3 rounded-xl hover:bg-brand-orange/5 text-xs font-bold text-brand-navy transition-colors" data-sort="oldest">Oldest to Newest</button>
                </div>
            </div>

            {{-- Search Bar --}}
            <div class="flex-[1.5] relative group">
                <div class="w-full bg-[#F36B21]/10 border border-[#F36B21]/40 rounded-[1.5rem] px-8 py-4 flex items-center justify-between cursor-none hover-target focus-within:ring-2 focus-within:ring-brand-orange/20 transition-all">
                    <div class="flex flex-col flex-1">
                        <span class="text-[8px] uppercase font-bold tracking-widest opacity-50 mb-0.5">SEARCH ARTICLES</span>
                        <input type="text" id="article-search" class="bg-transparent border-none p-0 focus:ring-0 text-xs font-bold text-[#22397A] outline-none w-full" placeholder="Type title here...">
                    </div>
                    <svg class="w-5 h-5 text-[#22397A]/40 group-hover:text-brand-orange transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================
    ARTICLE LIST
    ============================================================ --}}
    <div id="articles-container" class="flex flex-col gap-32 md:gap-48 relative">
        @php
            $displayItems = collect();
            if($articles) {
                if($articles instanceof \Illuminate\Support\Collection || is_array($articles)) {
                    foreach($articles as $a) $displayItems->push($a);
                } else {
                    $displayItems->push($articles);
                }
            }
            if(isset($all_articles)) {
                foreach($all_articles as $item) $displayItems->push($item);
            }
            
            $itemsList = $displayItems->unique('uuid');
        @endphp

        @if($itemsList->count() > 0)
            @foreach($itemsList as $index => $item)
                @php
                    $isReverse = ($index % 2 != 0);
                    $url = route('detail-articles', $item->slug);
                    $categoryName = $item->artikelKategori->name ?? 'NEWS';
                    
                    // Extract titles manually for search functionality
                    $titleId = $item->judul ?? '';
                    $titleEn = $item->judul_en ?? $titleId;
                    $searchTerms = strtolower($titleId . ' ' . $titleEn);
                @endphp
                
                <article class="article-card flex flex-col {{ $isReverse ? 'md:flex-row-reverse' : 'md:flex-row' }} items-center gap-10 md:gap-24 group transition-all duration-500" 
                    data-category="{{ $categoryName }}" 
                    data-date="{{ \Carbon\Carbon::parse($item->tgl_rilis)->timestamp }}"
                    data-title="{{ $searchTerms }}">
                    
                    {{-- Text Content --}}
                    <div class="flex-1 w-full flex flex-col {{ $isReverse ? 'items-start md:items-end text-left md:text-right' : 'items-start' }}">
                        <div class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-navy/40 mb-6 flex items-center gap-3">
                            <span>{{ \Carbon\Carbon::parse($item->tgl_rilis)->format('d M Y') }}</span>
                            <span class="opacity-30">•</span>
                            <span class="text-brand-orange">{{ $categoryName }}</span>
                        </div>

                        <h2 class="font-peckham text-4xl md:text-7xl text-brand-orange leading-[0.85] mb-10 group-hover:scale-[1.02] transition-transform duration-700 uppercase tracking-tighter">
                            <a href="{{ $url }}" class="cursor-none hover-target">@i18n($item, 'judul')</a>
                        </h2>

                        <a href="{{ $url }}" class="bg-brand-orange text-white font-sans text-[10px] tracking-[0.2em] uppercase font-bold py-5 px-12 rounded-full hover:scale-105 transition-all shadow-xl shadow-brand-orange/20 cursor-none hover-target">
                            Read More
                        </a>
                    </div>

                    {{-- Image --}}
                    <div class="flex-1 w-full aspect-video md:aspect-[16/10] overflow-hidden rounded-[1rem] md:rounded-[1.5rem] shadow-2xl relative">
                        <a href="{{ $url }}" class="block w-full h-full cursor-none hover-target">
                            <img src="{{ asset('photo/' . $item->photo) }}" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-1000" alt="{{ $item->judul }}">
                        </a>
                    </div>
                </article>
            @endforeach
        @endif

        {{-- No Results --}}
        <div id="no-results" class="hidden py-40 text-center font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-navy/40">
            No articles match your criteria.
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('articles-container');
        const articles = Array.from(document.querySelectorAll('.article-card'));
        const searchInput = document.getElementById('article-search');
        const sortTrigger = document.getElementById('sort-trigger');
        const sortMenu = document.getElementById('sort-menu');
        const currentSortLabel = document.getElementById('current-sort');
        const filterBtns = document.querySelectorAll('.category-filter');
        const noResults = document.getElementById('no-results');

        let currentCategory = 'all';
        let currentSearch = '';
        let currentSort = 'newest';
        let searchTimer = null;

        // ── FILTER & DISPLAY ──────────────────────────────────────
        function updateDisplay() {
            let visibleCount = 0;
            // Batch all reads first, then all writes (avoid layout thrashing)
            const results = articles.map(el => ({
                el,
                show: (currentCategory === 'all' || el.dataset.category === currentCategory)
                      && el.dataset.title.includes(currentSearch)
            }));

            results.forEach(({ el, show }) => {
                if (show) {
                    el.classList.remove('hidden');
                    visibleCount++;
                } else {
                    el.classList.add('hidden');
                }
            });

            noResults.classList.toggle('hidden', visibleCount > 0);
            // NOTE: No ScrollTrigger.refresh() — it's extremely expensive and not needed here
        }

        // Search — debounced 150ms so it only runs after typing stops
        searchInput.addEventListener('input', (e) => {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                currentSearch = e.target.value.toLowerCase().trim();
                updateDisplay();
            }, 150);
        });

        // Category filter
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentCategory = btn.dataset.category;
                updateDisplay();
            });
        });

        // ── SORT DROPDOWN ──────────────────────────────────────────
        let sortOpen = false;

        sortTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            sortOpen = !sortOpen;
            if (sortOpen) {
                sortMenu.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-2');
            } else {
                sortMenu.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
            }
        });

        document.querySelectorAll('.sort-option').forEach(opt => {
            opt.addEventListener('click', (e) => {
                e.stopPropagation();
                const newSort = opt.dataset.sort;
                if (newSort === currentSort) {
                    // Close menu without doing anything
                    sortMenu.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
                    sortOpen = false;
                    return;
                }
                currentSort = newSort;
                currentSortLabel.textContent = opt.textContent.trim();

                // Sort array
                articles.sort((a, b) => {
                    const dateA = parseInt(a.dataset.date);
                    const dateB = parseInt(b.dataset.date);
                    return currentSort === 'newest' ? dateB - dateA : dateA - dateB;
                });

                // Batch DOM append via fragment to avoid multiple reflows
                const frag = document.createDocumentFragment();
                articles.forEach(el => frag.appendChild(el));
                container.appendChild(frag);

                updateDisplay();

                // Close menu
                sortMenu.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
                sortOpen = false;
            });
        });

        document.addEventListener('click', () => {
            if (sortOpen) {
                sortMenu.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
                sortOpen = false;
            }
        });

        // ── GSAP SCROLL ANIMATIONS ─────────────────────────────────
        if (typeof gsap !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
            
            // Set initial state for GPU layers
            gsap.set('.article-card', { y: 30, opacity: 0, force3D: true });

            gsap.utils.toArray('.article-card').forEach(el => {
                gsap.to(el, {
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 90%',
                        once: true
                    },
                    y: 0,
                    opacity: 1,
                    duration: 0.6,
                    ease: 'power4.out',
                    force3D: true,
                    onComplete: () => { el.style.willChange = 'auto'; }
                });
            });
        }
    });
</script>

@include('components.footer')

@endsection


