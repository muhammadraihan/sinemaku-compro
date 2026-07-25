@extends('layouts.app')

@section('title', $shop->name . ' | Sinemaku Pictures')

@section('content')

{{-- 1. CSS STYLES (Matching Shop List Page) --}}
@push('head')
<style>
    html {
        background-color: #FFF6F9 !important;
    }
    body {
        background-color: transparent !important;
        color: #22397A !important;
    }

    /* Interactive BG Setup */
    #interactive-bg {
        background: radial-gradient(
            ellipse 50vw 50vh at var(--mx, 25%) var(--my, 55%),
            rgba(243, 107, 33, 0.25) 0%,
            transparent 60%
        ) !important;
        filter: blur(80px) !important;
        opacity: 0.6 !important;
    }

    .font-peckham { font-family: 'PeckhamPress', sans-serif; }
    .font-serif { font-family: 'Instrument Serif', serif; }

    /* Product Details Styles */
    .product-img-main {
        border-radius: 1rem;
        background-color: #22397A;
        overflow: hidden;
        aspect-ratio: 1/1.2;
    }

    .shop-description {
        font-family: 'Helvetica', sans-serif;
        font-size: 1rem;
        line-height: 1.6;
        color: rgba(34, 57, 122, 0.8);
    }
    .shop-description p { margin-bottom: 1.5rem; }

    /* Related Products grid matches shop list */
    .product-img-container {
        position: relative;
        overflow: hidden;
        border-radius: 1rem;
        aspect-ratio: 1/1.2;
        background-color: #22397A;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .product-card:hover .product-img-container {
        transform: translateY(-8px);
    }
    .product-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.9;
        transition: transform 0.8s ease;
    }
    .product-card:hover img {
        transform: scale(1.05);
        opacity: 1;
    }
</style>
@endpush

{{-- 2. NAVBAR --}}
@include('partials.navbar', ['navTheme' => 'event'])

<div id="shop-detail-wrapper" class="relative z-10 pt-40 md:pt-48 pb-32 px-8 md:px-16">
    <div class="max-w-[1600px] mx-auto">
        
        {{-- ============================================================
        MAIN PRODUCT INFO
        ============================================================ --}}
        <div class="flex flex-col lg:flex-row gap-12 md:gap-20 items-start mb-32">
            
            {{-- Left: Product Image --}}
            <div class="w-full lg:w-1/2 reveal-item">
                <div class="product-img-main shadow-2xl flex items-center justify-center">
                    <img src="{{ asset('photo/' . $shop->photo) }}" alt="{{ $shop->name }}" class="w-full h-full object-cover" fetchpriority="high" decoding="async">
                </div>
            </div>

            {{-- Right: Product Metadata & Actions --}}
            <aside class="w-full lg:w-1/2 lg:sticky lg:top-40 reveal-item">
                <div class="flex flex-col gap-6">
                    
                    {{-- Title & Price --}}
                    <div class="flex flex-col gap-2 border-b border-brand-navy/10 pb-8">
                        <span class="font-sans text-[10px] uppercase tracking-widest text-brand-navy/40 font-bold block">
                            {{ $shop->merchandise ?: 'Apparel' }}
                        </span>
                        
                        <h1 class="font-peckham text-brand-navy text-4xl md:text-[4vw] leading-[1.1] tracking-tighter uppercase">
                            @i18n($shop, 'name')
                        </h1>
                        
                        <div class="font-sans text-xl md:text-2xl font-bold text-brand-navy/90 mt-2">
                            {{ $shop->harga ? 'Rp ' . number_format($shop->harga, 0, ',', '.') : 'TBA' }}
                        </div>
                    </div>

                    {{-- Description --}}
                    @if($shop->detail)
                    <div class="pt-4 reveal-item">
                        <div class="shop-description">
                            @i18n($shop, 'detail')
                        </div>
                    </div>
                    @endif

                    {{-- Actions --}}
                    <div class="pt-8 mt-4">
                        <a href="{{ $shop->link }}" target="_blank" class="w-full bg-brand-navy text-white font-sans text-xs tracking-[0.2em] uppercase font-bold py-5 px-12 hover:bg-brand-orange transition-all duration-500 cursor-none hover-target shadow-xl text-center block rounded-md">
                            Buy Now
                        </a>
                        <p class="font-sans text-[9px] text-brand-navy/40 mt-4 uppercase tracking-widest text-center">
                            Purchases are handled via our official store platforms.
                        </p>
                    </div>

                </div>
            </aside>
        </div>

        {{-- ============================================================
        RELATED PRODUCTS (Using exactly the same layout as the shop page)
        ============================================================ --}}
        @if($all_shop->count() > 0)
        <div class="pt-20 border-t border-brand-navy/10">
            {{-- Section Header --}}
            <header class="mb-12 md:mb-16 text-left reveal-item">
                <h2 class="font-peckham text-brand-navy text-2xl md:text-[2vw] uppercase leading-[1.1] tracking-tighter">
                    <span class="block">More</span>
                    <span class="block text-brand-navy/30">Collections.</span>
                </h2>
            </header>

            {{-- Product Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-x-3 md:gap-x-6 gap-y-12">
                @foreach ($all_shop as $product)
                <a href="{{ route('detail-shop', $product->slug) }}" class="product-card group cursor-none hover-target flex flex-col reveal-item">
                    {{-- Product Thumbnail --}}
                    <div class="product-img-container mb-6 shadow-lg">
                        <img src="{{ asset('photo/' . $product->photo) }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-cover">
                    </div>
                    
                    {{-- Product Info --}}
                    <div class="flex flex-col gap-1 px-1">
                        {{-- Price --}}
                        <span class="font-sans text-[10px] md:text-xs font-bold text-brand-navy/90 mb-1">
                            {{ $product->harga ? 'Rp' . number_format($product->harga, 0, ',', '.') : 'Rp999.999' }}
                        </span>
                        
                        {{-- Title --}}
                        <h3 class="font-sans text-[11px] md:text-sm font-bold text-brand-navy leading-[1.2] uppercase tracking-tight group-hover:text-brand-orange transition-colors">
                            @i18n($product, 'name')
                        </h3>
                        
                        {{-- Category --}}
                        <span class="font-sans text-[9px] md:text-[10px] uppercase tracking-widest text-brand-navy/40 font-bold mt-1">
                            {{ $product->merchandise ?: 'Apparel' }}
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
            
            <div class="flex justify-center mt-20 reveal-item">
                <a href="{{ route('shop') }}" class="font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-navy border-b border-brand-navy/20 pb-2 hover:border-brand-orange hover:text-brand-orange transition-all cursor-none hover-target">
                    View All Collections
                </a>
            </div>
        </div>
        @endif

    </div>
</div>

{{-- Scripts --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap === 'undefined') return;

    gsap.registerPlugin(ScrollTrigger);

    // Staggered Reveal Animations
    const items = document.querySelectorAll('.reveal-item');
    if (items.length > 0) {
        gsap.from(items, {
            scrollTrigger: {
                trigger: items[0],
                start: "top 95%",
            },
            y: 30,
            opacity: 0,
            duration: 1,
            stagger: 0.1,
            ease: "power2.out"
        });
    }
});
</script>
@endpush

@include('components.footer')

@endsection
