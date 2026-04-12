@extends('layouts.app')

@section('title', 'Shop | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

<style>
  :root {
    --merch-bg: #ffffff;
    --merch-text: #0a0a0a;
    --merch-muted: #888888;
    --merch-gutter: clamp(32px, 8vw, 100px); /* Increased padding */
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
    position: relative;
    overflow: hidden;
    background: #ffffff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-bottom: 60px;
    padding-top: 100px; /* Space from navbar */
    padding-bottom: 80px;
    max-width: var(--merch-max-w);
    margin: 0 auto;
  }

  .merch-hero__img-link {
    width: 100%;
    display: flex;
    justify-content: center;
    text-decoration: none;
    transition: opacity 0.5s ease;
  }

  .merch-hero__img-link:hover {
    opacity: 0.95;
  }

  .merch-hero__img {
    width: 100%;
    height: clamp(50vh, 70vh, 800px);
    object-fit: contain;
    padding: 0 var(--merch-gutter);
    transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .merch-hero:hover .merch-hero__img {
    transform: scale(1.04);
  }

  .merch-hero__info {
    width: 100%;
    padding: 0 var(--merch-gutter);
    text-align: left; /* Reverted to left-aligned */
    margin-top: 40px;
  }

  .merch-hero__title {
    font-size: clamp(28px, 5vw, 64px);
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -0.04em;
    margin-bottom: 32px;
    line-height: 0.9;
    max-width: 1000px;
    color: var(--merch-text);
  }

  .merch-hero__title a {
    text-decoration: none;
    color: inherit;
    transition: opacity 0.3s;
  }

  .merch-hero__title a:hover {
    opacity: 0.7;
  }

  .btn-buy-now {
    display: inline-flex;
    padding: 16px 36px;
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
    background: #333;
    transform: translateY(-2px);
  }

  /* ===== COLLECTION SECTIONS ===== */
  .merch-collection-section {
    max-width: var(--merch-max-w);
    margin: 0 auto;
    width: 100%;
  }

  .merch-collection-header {
    padding: 100px var(--merch-gutter) 40px;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
  }

  .collection-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    color: var(--merch-text) !important; /* Explicit black */
    position: relative;
    display: inline-block;
    padding-bottom: 12px;
  }

  /* Persistent Underline (approx 20+ chars) */
  .collection-label::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 28ch; /* 20+ chars */
    height: 1px;
    background: var(--merch-text);
    opacity: 0.2;
  }

  /* ===== PRODUCT GRID ===== */
  .merch-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Center the products below hero */
    gap: 40px 20px;
    padding: 0 var(--merch-gutter);
    width: 100%;
  }

  .merch-card {
    position: relative;
    flex: 0 0 calc(25% - 15px);
    min-width: 280px;
    padding-bottom: 40px;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: var(--merch-text);
    transition: opacity 0.3s;
    text-align: left; /* Card info stays left-aligned */
  }

  @media (max-width: 1200px) {
    .merch-card { flex: 0 0 calc(33.333% - 14px); }
  }

  @media (max-width: 900px) {
    .merch-card { flex: 0 0 calc(50% - 10px); }
  }

  @media (max-width: 600px) {
    .merch-card { flex: 0 1 100%; }
  }

  .merch-card__media {
    width: 100%;
    aspect-ratio: 1;
    overflow: hidden;
    background: #ffffff !important; /* Force true white background */
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none !important;
    box-shadow: none !important;
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
    display: flex;
    flex-wrap: wrap; /* Changed from overflow-x to wrap to center better */
    justify-content: center; 
    gap: 40px 20px;
    padding: 0 var(--merch-gutter) 80px;
  }

  .merch-card--carousel {
    flex: 0 0 calc(25% - 15px);
    min-width: 280px;
    max-width: 400px;
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
    <a href="{{ route('detail-shop', $shop->slug) }}" class="merch-hero__img-link">
      <img src="{{ asset('photo/' . $shop->photo) }}" alt="{{ $shop->name }}" class="merch-hero__img">
    </a>
    <div class="merch-hero__info">
      <h2 class="merch-hero__title">
        <a href="{{ route('detail-shop', $shop->slug) }}">{{ $shop->name }}</a>
      </h2>
      <a href="{{ $shop->link }}" target="_blank" class="btn-buy-now">Buy Now</a>
    </div>
  </section>
  @endif

  <!-- COLLECTIONS -->
  @foreach ($merchandise as $index => $item)
    <section class="merch-collection-section">
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
    </section>
  @endforeach

  <!-- SHOP BY CATEGORY -->
  <section class="merch-collection-section">
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
  </section>

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