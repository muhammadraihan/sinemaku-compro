@extends('layouts.app')

@section('title', $shop->name . ' | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

@push('head')
<style>
    /* White background for the whole page */
    body { background-color: #FFFFFF !important; }
    
    /* Elegant typography for description */
    .shop-description {
        font-family: 'Helvetica', sans-serif;
        font-size: 1.1rem;
        line-height: 1.8;
        color: rgba(37, 34, 94, 0.8);
    }
    .shop-description p { margin-bottom: 1.5rem; }
    .shop-description h2, .shop-description h3 {
        font-family: 'Instrument Serif', serif;
        font-size: 2.5rem;
        margin-top: 3rem;
        margin-bottom: 1.5rem;
        color: #25225E;
        font-style: italic;
    }
</style>
@endpush

{{-- ============================================================
EDITORIAL WRAPPER (Pure White)
============================================================ --}}
<div id="editorial-wrapper" class="text-brand-deepbreath relative w-full font-sans min-h-screen pt-40 md:pt-48 pb-32 bg-white">

    <div class="max-w-[1600px] mx-auto px-8 md:px-16">
        
        <!-- Main Product Info Grid -->
        <div class="flex flex-col lg:flex-row gap-20 lg:gap-32 items-start mb-32">
            
            <!-- Left: Product Image -->
            <div class="w-full lg:w-3/5 reveal-text">
                <div class="w-full aspect-square bg-white flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('photo/' . $shop->photo) }}" alt="{{ $shop->name }}" class="w-full h-full object-contain">
                </div>
            </div>

            <!-- Right: Product Meta (Sticky) -->
            <aside class="w-full lg:w-2/5 lg:sticky lg:top-40 reveal-rec">
                <div class="flex flex-col gap-8">
                    <div class="flex flex-col gap-4">
                        <span class="font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-orange block">
                            {{ $shop->merchandise }}
                        </span>
                        <h1 class="font-serif text-5xl md:text-7xl text-brand-deepbreath leading-[0.9] tracking-tighter mb-4">
                            @i18n($shop, 'name')
                        </h1>
                        <div class="font-sans text-2xl md:text-3xl font-bold text-brand-deepbreath/40">
                            {{ $shop->harga ? 'Rp ' . number_format($shop->harga, 0, ',', '.') : 'TBA' }}
                        </div>
                    </div>

                    <div class="border-t hairline-border pt-8 mb-8">
                        <a href="{{ $shop->link }}" target="_blank" class="w-full bg-brand-deepbreath text-white font-sans text-xs tracking-[0.2em] uppercase font-bold py-6 px-12 hover:bg-brand-orange transition-all duration-500 cursor-none hover-target shadow-xl text-center block">
                            Buy Now
                        </a>
                        <p class="font-sans text-[10px] text-brand-deepbreath/40 mt-6 uppercase tracking-widest text-center">
                            Purchases are handled via our official store platforms.
                        </p>
                    </div>

                    <!-- Short Description or Features if any -->
                    <div class="shop-description text-sm opacity-80">
                        <!-- We can put small meta info here -->
                    </div>
                </div>
            </aside>
        </div>

        <!-- Detailed Description -->
        <div class="max-w-4xl border-t hairline-border pt-20 reveal-text">
            <h2 class="font-serif text-4xl text-brand-deepbreath italic mb-12">Product Details</h2>
            <div class="shop-description">
                @i18n($shop, 'detail')
            </div>
        </div>

    </div>

    {{-- ============================================================
    RELATED PRODUCTS
    ============================================================ --}}
    <section class="pt-40 pb-20 px-8 md:px-16 max-w-[1600px] mx-auto bg-white">
        <div class="border-b hairline-border pb-8 mb-20 reveal-text">
            <h2 class="font-serif text-4xl md:text-5xl text-brand-deepbreath italic">You Might Also Like</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-x-8 gap-y-16 items-start">
            @foreach ($all_shop->take(4) as $index => $item)
            <a href="{{ route('detail-shop', $item->slug) }}" class="product-card group cursor-none hover-target flex flex-col gap-4 reveal-item">
                <div class="w-full aspect-square bg-white flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->name }}" class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-105">
                </div>
                <div class="flex flex-col gap-1 items-center text-center">
                    <h3 class="font-serif text-xl text-brand-deepbreath group-hover:text-brand-orange transition-colors">@i18n($item, 'name')</h3>
                    <span class="font-sans text-[10px] font-bold text-brand-deepbreath/40">
                        {{ $item->harga ? 'Rp ' . number_format($item->harga, 0, ',', '.') : 'TBA' }}
                    </span>
                </div>
            </a>
            @endforeach
        </div>

        <div class="flex justify-center mt-32 reveal-text">
            <a href="{{ route('shop') }}" class="font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-deepbreath border-b border-brand-deepbreath/20 pb-2 hover:border-brand-orange hover:text-brand-orange transition-all">
                View All Merchandise
            </a>
        </div>
    </section>

</div>

{{-- Scripts --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap === 'undefined') return;

    gsap.registerPlugin(ScrollTrigger);

    // Reveal Animations
    document.querySelectorAll('.reveal-text, .reveal-rec, .reveal-item').forEach(el => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: "top 90%",
            },
            y: 40,
            opacity: 0,
            duration: 1.2,
            ease: "power3.out"
        });
    });
});
</script>
@endpush

@include('components.footer')

@endsection