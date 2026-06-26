@extends('layouts.app')

@section('title', 'Shop | Sinemaku Pictures')

@section('content')

{{-- 1. CSS STYLES (Copied/Adapted from detail-event for consistency) --}}
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

    /* Custom styles for Shop Page */
    .shop-title-line {
        display: block;
        line-height: 0.9;
        letter-spacing: -0.05em;
    }

    .product-img-container {
        position: relative;
        overflow: hidden;
        border-radius: 1rem;
        aspect-ratio: 1/1.2;
        background-color: #22397A; /* Dark navy as shown in placeholder */
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .product-card:hover .product-img-container {
        transform: translateY(-8px);
    }

    .product-card img {
        width: 100%;
        height: 100%;
        object-cover: cover;
        opacity: 0.9;
        transition: transform 0.8s ease;
    }

    .product-card:hover img {
        transform: scale(1.05);
        opacity: 1;
    }
</style>

{{-- 2. NAVBAR --}}
@include('partials.navbar', ['navTheme' => 'event'])

<div id="shop-page-wrapper" class="relative z-10 pt-48 pb-32 px-8 md:px-16">
    <div class="max-w-[1600px] mx-auto">

        @php
            $chunks = $all_merchandise->chunk(4);
        @endphp

        @foreach($chunks as $i => $chunk)
            {{-- Section Header (Alternating) --}}
            <header class="mb-16 md:mb-20 {{ $i % 2 == 1 ? 'text-right' : 'text-left' }}">
                <h2 class="font-peckham text-brand-navy text-3xl md:text-[2.5vw] uppercase leading-[1.1] tracking-tighter">
                    <span class="block text-brand-navy/30">Sinemaku.</span>
                    <span class="block text-brand-navy/20">Pictures.</span>
                    <span class="block">Collections.</span>
                </h2>
            </header>

            {{-- Product Grid (1 Row of 4) --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-x-3 md:gap-x-6 gap-y-12 mb-32">
                @foreach ($chunk as $product)
                <a href="{{ route('detail-shop', $product->slug) }}" class="product-card group cursor-none hover-target flex flex-col">
                    {{-- Product Thumbnail --}}
                    <div class="product-img-container mb-6 shadow-xl">
                        <img src="{{ asset('photo/' . $product->photo) }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-cover">
                    </div>

                    {{-- Product Info (Editorial Layout) --}}
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
        @endforeach

    </div>
</div>

@include('components.footer')

@endsection
