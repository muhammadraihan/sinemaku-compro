@extends('layouts.app')

@section('title', 'Shop | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

@push('head')
<style>
    /* White background for the whole page */
    body { background-color: #FFFFFF !important; }
    
    /* Clean transition for product images */
    .product-card .img-container img {
        transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .product-card:hover .img-container img {
        transform: scale(1.04);
    }

    /* Override navbar style for white page if needed */
    #editorial-wrapper {
        background-color: #FFFFFF;
    }
</style>
@endpush

{{-- ============================================================
EDITORIAL WRAPPER (Pure White)
============================================================ --}}
<div id="editorial-wrapper" class="text-brand-deepbreath relative w-full font-sans min-h-screen">

    {{-- ============================================================
    HEADER SECTION
    ============================================================ --}}
    <section class="pt-40 md:pt-48 px-6 md:px-16 max-w-[1600px] mx-auto relative z-10 bg-white">
        <div class="flex flex-col items-center text-center border-b hairline-border pb-12 mb-16 md:mb-24 gap-6">
            <span class="font-sans text-[9px] tracking-[0.4em] uppercase font-bold text-brand-orange block">
                Sinemaku Store
            </span>
            <h2 class="font-serif text-5xl md:text-8xl text-brand-deepbreath leading-[0.8] tracking-tighter">
                <span>The</span> <span class="italic text-brand-orange">Collection.</span>
            </h2>
        </div>
    </section>

    {{-- ============================================================
    STRUCTURED GRID (Clean & Minimalist)
    ============================================================ --}}
    <section class="px-6 md:px-16 pb-40 max-w-[1600px] mx-auto relative z-10 bg-white">
        <!-- 
            3-Column Grid on Desktop
            2-Column Grid on Mobile
        -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-x-8 gap-y-16 md:gap-x-12 md:gap-y-24 items-start">
            @foreach ($all_merchandise as $index => $product)
            <a href="{{ route('detail-shop', $product->slug) }}" class="product-card group cursor-none hover-target flex flex-col gap-6 reveal-item">
                
                <!-- Image Container (Matches Image Background) -->
                <div class="img-container w-full aspect-square md:aspect-[3/4] bg-white flex items-center justify-center relative overflow-hidden">
                    <img src="{{ asset('photo/' . $product->photo) }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-contain">
                </div>
                
                <!-- Info Container (Smaller Typography) -->
                <div class="flex flex-col gap-1 px-1">
                    <span class="font-sans text-[8px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40">
                        {{ $product->merchandise }}
                    </span>
                    <h3 class="font-serif text-xl md:text-2xl text-brand-deepbreath leading-tight group-hover:text-brand-orange transition-colors">
                        @i18n($product, 'name')
                    </h3>
                    <span class="font-sans text-[10px] md:text-xs font-bold text-brand-deepbreath/60 tracking-wider">
                        {{ $product->harga ? 'Rp ' . number_format($product->harga, 0, ',', '.') : 'TBA' }}
                    </span>
                </div>
                
            </a>
            @endforeach
        </div>
    </section>

</div>

{{-- Scripts --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap === 'undefined') return;

    gsap.registerPlugin(ScrollTrigger);

    // List Items Staggered Reveal
    document.querySelectorAll('.reveal-item').forEach(el => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: "top 90%",
            },
            y: 30,
            opacity: 0,
            duration: 1,
            ease: "power2.out"
        });
    });
});
</script>
@endpush

@include('components.footer')

@endsection