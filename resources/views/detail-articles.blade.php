@extends('layouts.app')

@section('title', $article->judul . ' | Sinemaku Articles')

@section('content')

@include('partials.navbar', ['navTheme' => 'event'])

@push('head')
<style>
    
    /* Premium Editorial Typography */
    .article-content h2, .article-content h3 {
        font-family: 'Instrument Serif', serif;
        font-size: clamp(2rem, 5vw, 3.5rem);
        margin-top: 4rem;
        margin-bottom: 2rem;
        color: #22397A;
        font-style: italic;
        line-height: 1.1;
    }
    .article-content p {
        font-family: 'Helvetica', sans-serif;
        font-size: 1.25rem;
        line-height: 1.9;
        color: #22397A;
        opacity: 0.9;
        margin-bottom: 2.5rem;
        letter-spacing: -0.01em;
    }
    .article-content img {
        border-radius: 2rem;
        margin: 4rem 0;
        width: 100%;
        height: auto;
        box-shadow: 0 30px 60px rgba(34, 57, 122, 0.1);
    }
    .article-content blockquote {
        border-left: 2px solid #f46a21;
        padding-left: 3rem;
        font-family: 'Instrument Serif', serif;
        font-size: 2.5rem;
        font-style: italic;
        color: #f46a21;
        margin: 4rem 0;
        line-height: 1.2;
    }
</style>
@endpush

{{-- ============================================================
EDITORIAL WRAPPER (Redesign based on image)
============================================================ --}}
<div id="editorial-wrapper" class="text-brand-deepbreath relative w-full font-sans min-h-screen pt-32 pb-40">

    <div class="max-w-7xl mx-auto px-8 md:px-20 lg:px-24">
        
        {{-- 1. FEATURED IMAGE --}}
        <div class="relative w-full mb-8 reveal-image">
            <div class="aspect-[16/9] md:aspect-[21/9] w-full rounded-2xl md:rounded-3xl overflow-hidden shadow-2xl bg-tint-2/20">
                <img src="{{ asset('photo/' . $article->photo) }}" alt="{{ $article->judul }}" 
                     class="w-full h-full object-cover">
            </div>
            
            {{-- Photo Credits --}}
            <div class="mt-4 flex justify-start">
                <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40">
                    PHOTOS BY {{ $article->penulis }}
                </span>
            </div>
        </div>

        {{-- Separator Line --}}
        <div class="w-full h-px bg-brand-deepbreath/10 mb-16"></div>

        {{-- 2. ARTICLE HEADERS (Centered) --}}
        <div class="max-w-5xl mx-auto text-center mb-20 flex flex-col items-center gap-8 reveal-text">
            
            {{-- Category --}}
            <span class="font-sans text-[10px] md:text-[12px] tracking-[0.4em] uppercase font-black text-brand-orange">
                {{ $article->artikelKategori->name ?? 'PRODUCTIVITY' }}
            </span>

            {{-- Main Title --}}
            <h1 class="font-peckham text-2xl md:text-5xl lg:text-6xl text-brand-navy leading-[0.85] tracking-tighter uppercase max-w-4xl">
                {{ $article->judul }}
            </h1>

            {{-- Lead / Summary --}}
            <p class="font-sans text-sm md:text-lg lg:text-xl text-brand-navy font-bold leading-tight tracking-[0.1em] uppercase max-w-3xl opacity-80">
                {{ $article->title }}
            </p>
        </div>

        {{-- 3. META ROW & CONTENT --}}
        <div class="max-w-4xl mx-auto">
            
            {{-- Meta Row --}}
            <div class="w-full pt-6 pb-6 border-y hairline-border flex justify-between items-center mb-16 font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/60 reveal-text">
                <div class="flex items-center gap-8">
                    <div class="flex flex-col">
                        <span class="text-brand-orange/60 mb-1">BY AUTHOR</span>
                        <span class="text-brand-navy">{{ $article->penulis }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-brand-orange/60 mb-1">DATE</span>
                        <span class="text-brand-navy">{{ \Carbon\Carbon::parse($article->tgl_rilis)->format('j M Y') }}</span>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 relative">
                    <span>SHARE</span>
                    <button id="share-article-btn" 
                        data-title="{{ $article->judul }}" 
                        data-url="{{ url()->current() }}"
                        class="w-8 h-8 rounded-full bg-brand-navy/10 flex items-center justify-center hover:bg-brand-orange hover:text-white transition-all cursor-none hover-target outline-none">
                        <span class="iconify" data-icon="lucide:share-2"></span>
                    </button>
                    
                    {{-- Toast Notification --}}
                    <div id="share-toast" class="absolute -top-10 right-0 bg-brand-navy text-white text-[9px] px-3 py-1 rounded-full opacity-0 pointer-events-none transition-all duration-300 transform translate-y-2">
                        LINK COPIED
                    </div>
                </div>
            </div>

            {{-- Main Article Content --}}
            <article class="article-content reveal-text prose prose-lg md:prose-xl max-w-none">
                {!! $article->detail !!}
            </article>

            {{-- Source Link if External --}}
            @if($article->kategori == 'external' && $article->link)
            <div class="mt-20 pt-10 border-t hairline-border text-center">
                <a href="{{ $article->link }}" target="_blank" class="font-sans text-[10px] tracking-[0.4em] uppercase font-black text-brand-orange hover:text-brand-navy transition-all cursor-none hover-target inline-flex items-center gap-4">
                    READ FULL STORY <span class="iconify" data-icon="lucide:external-link"></span>
                </a>
            </div>
            @endif

            {{-- Back to Articles --}}
            <div class="mt-32 text-center">
                <a href="{{ route('articles') }}" class="font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-deepbreath/40 hover:text-brand-orange transition-colors flex items-center justify-center gap-4 group">
                    <span class="iconify transition-transform group-hover:-translate-x-2" data-icon="lucide:arrow-left"></span> 
                    BACK TO ARTICLES
                </a>
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

    // 1. Image Reveal
    gsap.from(".reveal-image", {
        y: 60,
        opacity: 0,
        duration: 1.5,
        ease: "power4.out",
        delay: 0.2
    });

    // 2. Content Reveals
    document.querySelectorAll('.reveal-text').forEach(el => {
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

    // 3. Share Functionality
    const shareBtn = document.getElementById('share-article-btn');
    const shareToast = document.getElementById('share-toast');

    if (shareBtn) {
        shareBtn.addEventListener('click', async () => {
            const title = shareBtn.getAttribute('data-title');
            const url = shareBtn.getAttribute('data-url');

            if (navigator.share) {
                try {
                    await navigator.share({
                        title: title,
                        url: url
                    });
                } catch (err) {
                    console.log('Share cancelled or failed');
                }
            } else {
                // Fallback: Copy to Clipboard
                try {
                    await navigator.clipboard.writeText(url);
                    
                    // Show Toast
                    shareToast.classList.remove('opacity-0', 'translate-y-2');
                    shareToast.classList.add('opacity-100', 'translate-y-0');
                    
                    setTimeout(() => {
                        shareToast.classList.add('opacity-0', 'translate-y-2');
                        shareToast.classList.remove('opacity-100', 'translate-y-0');
                    }, 2000);
                } catch (err) {
                    console.error('Failed to copy link');
                }
            }
        });
    }
});
</script>
@endpush

@include('components.footer')

@endsection

