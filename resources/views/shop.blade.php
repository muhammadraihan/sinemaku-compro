@extends('layouts.app')

@section('title', 'Shop | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

<style>
  :root {
    --merch-bg: #ffffff;
    --merch-text: #0a0a0a;
    --merch-muted: #888888;
    --merch-gutter: clamp(16px, 4vw, 40px);
    --merch-max-w: 1600px;
  }

  body {
    background-color: var(--merch-bg) !important;
    color: var(--merch-text) !important;
  }

  #nav-overlay-gradient {
    display: block !important; /* Revert to standard visible gradient */
  }

  /* Standard navbar look */
  #unified-navbar {
    filter: none !important;
  }

  .merch-page {
    padding-bottom: 120px;
    background-color: var(--merch-bg);
  }

  /* ===== HERO BILLBOARD ===== */
  .merch-hero {
    width: 100%;
    height: clamp(60vh, 85vh, 1000px);
    position: relative;
    overflow: hidden;
    background: #f8f8f8;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
  }

  .merch-hero__img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 8vh 10vw;
    transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .merch-hero:hover .merch-hero__img {
    transform: scale(1.04);
  }

  .merch-hero__overlay {
    position: absolute;
    bottom: 6vh;
    left: var(--merch-gutter);
    z-index: 10;
  }

  .merch-hero__title {
    font-size: clamp(24px, 4vw, 56px);
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -0.03em;
    margin-bottom: 20px;
    line-height: 0.95;
  }

  .btn-buy-now {
    display: inline-flex;
    padding: 14px 28px;
    background: var(--merch-text);
    color: #fff;
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-decoration: none;
    transition: all 0.3s;
  }

  .btn-buy-now:hover {
    background: #444;
    transform: translateY(-2px);
  }

  /* ===== COLLECTION HEADERS ===== */
  .merch-collection-header {
    padding: 60px var(--merch-gutter) 20px;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
  }

  .collection-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    color: var(--merch-muted);
  }

  /* ===== PRODUCT GRID ===== */
  .merch-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2px; /* Tight A24 style grid */
    padding: 0 var(--merch-gutter);
    max-width: var(--merch-max-w);
    margin: 0 auto;
  }

  .merch-card {
    position: relative;
    padding-bottom: 40px;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: var(--merch-text);
    transition: opacity 0.3s;
  }

  .merch-card__media {
    width: 100%;
    aspect-ratio: 1;
    overflow: hidden;
    background: #f9f9f9;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 15%;
  }

  .merch-card__media img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .merch-card:hover .merch-card__media img {
    transform: scale(1.1);
  }

  .merch-card__info {
    padding: 10px 0;
  }

  .merch-card__title {
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    margin: 0 0 6px;
    letter-spacing: 0.05em;
    line-height: 1.4;
  }

  .merch-card__price {
    font-size: 12px;
    font-weight: 400;
    color: var(--merch-muted);
    margin-bottom: 16px;
    display: block;
  }

  /* ===== CAROUSEL / RAK ===== */
  .merch-carousel-container {
    width: 100%;
    overflow-x: auto;
    display: flex;
    gap: 20px;
    padding: 0 var(--merch-gutter) 40px;
    scrollbar-width: none;
  }

  .merch-carousel-container::-webkit-scrollbar {
    display: none;
  }

  .merch-card--carousel {
    flex: 0 0 clamp(280px, 30vw, 400px);
  }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 1200px) {
    .merch-grid { grid-template-columns: repeat(3, 1fr); }
  }

  @media (max-width: 800px) {
    .merch-grid { grid-template-columns: repeat(2, 1fr); }
    .merch-hero { height: 50vh; }
    .merch-hero__img { padding: 4vh 6vw; }
  }

  @media (max-width: 480px) {
    .merch-grid { grid-template-columns: 1fr; }
    .merch-card--carousel { flex: 0 0 80vw; }
  }

  /* Reveal Animations */
  .reveal { opacity: 0; transform: translateY(20px); transition: all 1s cubic-bezier(0.16, 1, 0.3, 1); }
  .reveal.is-inview { opacity: 1; transform: translateY(0); }
</style>

<div class="merch-page">

  <!-- HERO BILLBOARD (Random Product) -->
  @if($shop)
  <section class="merch-hero reveal">
    <img src="{{ asset('photo/' . $shop->photo) }}" alt="{{ $shop->name }}" class="merch-hero__img">
    <div class="merch-hero__overlay">
      <h2 class="merch-hero__title">{{ $shop->name }}</h2>
      <a href="{{ $shop->link }}" target="_blank" class="btn-buy-now">Buy Now</a>
    </div>
  </section>
  @endif

  <!-- COLLECTIONS -->
  @foreach ($merchandise as $index => $item)
    <div class="merch-collection-header reveal">
      <span class="collection-label">{{ $item->merchandise }} Collection</span>
    </div>

    {{-- Mix of Carousel (first few) and Grid (rest) --}}
    @if($index < 2)
      <!-- HORIZONTAL CAROUSEL RACK -->
      <div class="merch-carousel-container reveal">
        @foreach ($all_merchandise as $product)
          @if ($product->merchandise == $item->merchandise)
            <div class="merch-card merch-card--carousel">
              <a href="{{ route('detail-shop', $product->slug) }}" class="merch-card__media">
                <img src="{{ asset('photo/' . $product->photo) }}" alt="{{ $product->name }}" loading="lazy">
              </a>
              <div class="merch-card__info">
                <a href="{{ route('detail-shop', $product->slug) }}" style="text-decoration:none; color:inherit;">
                  <h3 class="merch-card__title">{{ $product->name }}</h3>
                </a>
                <span class="merch-card__price">
                  {{ $product->harga ? 'Rp' . number_format($product->harga, 0, ',', '.') : 'Price on request' }}
                </span>
                <a href="{{ $product->link }}" target="_blank" class="btn-buy-now" style="font-size:9px; padding: 10px 18px;">Buy Now</a>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    @else
      <!-- STANDARD IMAGE-DOMINANT GRID -->
      <div class="merch-grid reveal">
        @foreach ($all_merchandise as $product)
          @if ($product->merchandise == $item->merchandise)
            <div class="merch-card">
              <a href="{{ route('detail-shop', $product->slug) }}" class="merch-card__media">
                <img src="{{ asset('photo/' . $product->photo) }}" alt="{{ $product->name }}" loading="lazy">
              </a>
              <div class="merch-card__info">
                <a href="{{ route('detail-shop', $product->slug) }}" style="text-decoration:none; color:inherit;">
                  <h3 class="merch-card__title">{{ $product->name }}</h3>
                </a>
                <span class="merch-card__price">
                  {{ $product->harga ? 'Rp' . number_format($product->harga, 0, ',', '.') : 'Price on request' }}
                </span>
                <a href="{{ $product->link }}" target="_blank" class="btn-buy-now" style="font-size:9px; padding: 10px 18px;">Buy Now</a>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    @endif
  @endforeach

  <!-- SHOP BY CATEGORY -->
  <div class="merch-collection-header reveal" style="margin-top: 80px; border-top: 1px solid #eee;">
    <span class="collection-label">Shop By Category</span>
  </div>
  <div class="merch-grid reveal">
    @foreach ($kategorishop as $cat)
       @php $firstProd = $all_merchandise->where('kategorishop', $cat->uuid)->first(); @endphp
       @if($firstProd)
       <div class="merch-card">
          <a href="{{ route('detail-kategori', $cat->uuid) }}" class="merch-card__media">
            <img src="{{ asset('photo/' . $firstProd->photo) }}" alt="{{ $cat->name }}">
          </a>
          <div class="merch-card__info">
            <a href="{{ route('detail-kategori', $cat->uuid) }}" style="text-decoration:none; color:inherit;">
              <h3 class="merch-card__title">{{ strtoupper($cat->name) }}</h3>
            </a>
            <a href="{{ route('detail-kategori', $cat->uuid) }}" class="btn-buy-now" style="font-size:9px; padding: 10px 18px; background:transparent; color: #111; border: 1px solid #111;">Explore All</a>
          </div>
       </div>
       @endif
    @endforeach
  </div>

</div>

<script>
  (function() {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-inview');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
  })();
</script>

@include('components.footer')

@endsection