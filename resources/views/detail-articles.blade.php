@extends('layouts.app')

@section('title', $article->judul . ' | Sinemaku Articles')

@section('content')

@include('partials.navbar')

@push('head')
<style>
    body { background-color: #f6f6ed !important; }
    
    /* Clean article content styling */
    .article-content h2, .article-content h3 {
        font-family: 'Instrument Serif', serif;
        font-size: 2.5rem;
        margin-top: 3.5rem;
        margin-bottom: 1.5rem;
        color: #0f6ab0;
        font-style: italic;
    }
    .article-content p {
        font-family: 'Helvetica', sans-serif;
        font-size: 1.15rem;
        line-height: 1.8;
        color: rgba(37, 34, 94, 0.8);
        margin-bottom: 2rem;
    }
    .article-content img {
        border-radius: 0.75rem;
        margin: 3rem 0;
        width: 100%;
        height: auto;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    .article-content blockquote {
        border-left: 4px solid #f46a21;
        padding-left: 2rem;
        font-family: 'Instrument Serif', serif;
        font-size: 2rem;
        font-style: italic;
        color: #0f6ab0;
        margin: 3rem 0;
        line-height: 1.3;
    }
</style>
@endpush

{{-- ============================================================
EDITORIAL WRAPPER
============================================================ --}}
<div id="editorial-wrapper" class="text-brand-deepbreath relative w-full font-sans min-h-screen">

    {{-- ============================================================
    HERO SECTION (Parallax)
    ============================================================ --}}
    <section class="relative w-full h-[60vh] md:h-[80vh] overflow-hidden flex items-end pt-20">
        <!-- Parallax Image -->
        <div class="absolute inset-0 w-full h-[120%] -top-[10%] z-0">
            <img src="{{ asset('photo/' . $article->photo) }}" alt="{{ $article->judul }}" 
                 class="hero-parallax-img w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-t from-[#f6f6ed] via-[#f6f6ed]/20 to-transparent z-10"></div>
        </div>

        <!-- Title Overlay -->
        <div class="relative z-20 px-8 md:px-16 max-w-[1800px] mx-auto w-full pb-16 md:pb-24">
            <div class="flex flex-col gap-6 md:gap-8 max-w-5xl reveal-text">
                <span class="font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-orange block">
                    {{ $article->artikelKategori->name ?? 'Article' }}
                </span>
                <h1 class="font-serif text-5xl md:text-8xl text-brand-deepbreath leading-[0.9] tracking-tighter">
                    @i18n($article, 'judul')
                </h1>
            </div>
        </div>
    </section>

    {{-- ============================================================
    ARTICLE BODY
    ============================================================ --}}
    <section class="px-8 md:px-16 pb-40 max-w-[1800px] mx-auto relative z-10">
        
        <div class="flex flex-col lg:flex-row gap-20 lg:gap-32 items-start">
            
            <!-- Left: Content Column -->
            <main class="w-full lg:w-[65%] reveal-text">
                <!-- Meta Info Mobile -->
                <div class="flex lg:hidden flex-wrap gap-8 font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40 mb-12 pb-12 border-b hairline-border">
                    <div class="flex flex-col gap-2">
                        <span class="text-brand-orange/50" data-i18n="label_author">Written By</span>
                        <span class="text-brand-deepbreath">{{ $article->penulis }}</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <span class="text-brand-orange/50" data-i18n="label_date">Released On</span>
                        <span class="text-brand-deepbreath">{{ \Carbon\Carbon::parse($article->tgl_rilis)->format('d M Y') }}</span>
                    </div>
                </div>

                <!-- Main Text -->
                <article class="article-content">
                    @i18n($article, 'detail')
                </article>

                <!-- External Source (Subtle) -->
                @if($article->kategori == 'external' && $article->link)
                <div class="mt-16 pt-8 border-t hairline-border">
                    <a href="{{ $article->link }}" target="_blank" class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40 hover:text-brand-orange transition-all cursor-none hover-target inline-flex items-center gap-3">
                        <span data-i18n="label_read_full_story">Read Full Story</span> <span class="iconify" data-icon="lucide:external-link"></span>
                    </a>
                </div>
                @endif
            </main>

            <!-- Right: Sidebar Column (Sticky) -->
            <aside class="w-full lg:w-[35%] lg:sticky lg:top-40 reveal-rec">
                
                <!-- Meta Info Desktop -->
                <div class="hidden lg:flex flex-col gap-12 mb-20 border-b hairline-border pb-12">
                    <div class="flex flex-col gap-2">
                        <span class="font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-orange" data-i18n="label_author">Author</span>
                        <span class="font-serif text-3xl text-brand-deepbreath italic">{{ $article->penulis }}</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <span class="font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-orange" data-i18n="label_date">Date</span>
                        <span class="font-serif text-3xl text-brand-deepbreath italic">{{ \Carbon\Carbon::parse($article->tgl_rilis)->format('d M Y') }}</span>
                    </div>
                </div>

                <!-- Top Stories Widget -->
                <div>
                    <h4 class="font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-deepbreath/40 mb-10 border-b hairline-border pb-4" data-i18n="label_top_stories">Top Stories</h4>
                    <div class="flex flex-col gap-12">
                        @foreach ($all_article->take(5) as $item)
                        <a href="{{ route('detail-articles', $item->slug) }}" class="group flex gap-6 items-start cursor-none hover-target">
                            <div class="w-24 md:w-32 aspect-square shrink-0 overflow-hidden rounded-xl bg-tint-2/20">
                                <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover transition-all duration-700">
                            </div>
                            <div class="flex flex-col gap-2">
                                <span class="font-sans text-[8px] tracking-[0.2em] uppercase font-bold text-brand-orange/60">{{ $item->artikelKategori->name ?? 'Update' }}</span>
                                <h5 class="font-serif text-xl md:text-2xl text-brand-deepbreath group-hover:text-brand-orange transition-colors leading-tight">@i18n($item, 'judul')</h5>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Back to Articles -->
                <div class="mt-20 pt-12 border-t hairline-border">
                    <a href="{{ route('articles') }}" class="font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-deepbreath/60 hover:text-brand-orange transition-colors flex items-center gap-4">
                        <span class="iconify" data-icon="lucide:arrow-left"></span> <span data-i18n="label_back_to_articles">Back to Articles</span>
                    </a>
                </div>

            </aside>

        </div>

    </section>

</div>

{{-- Scripts --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap === 'undefined') return;

    gsap.registerPlugin(ScrollTrigger);

    // 1. Hero Parallax
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

    // 2. Content Reveals
    document.querySelectorAll('.reveal-text, .reveal-rec').forEach(el => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: "top 90%",
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

