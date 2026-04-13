@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@section('content')

@include('partials.navbar')
<style>


    :root {
      --merch-bg: #ffffff;
      --merch-text: #0a0a0a;
      --merch-muted: #888888;
      --merch-gutter: clamp(32px, 8vw, 100px);
      --merch-max-w: 1600px;
    }

    body {
      background-color: var(--merch-bg) !important;
      color: var(--merch-text) !important;
    }


    /* Layout wrapper */
    .shop-detail {
      padding: clamp(80px, 10vw, 160px) 0;
      background: var(--merch-bg);
      color: var(--merch-text);
    }

    .shop-detail__container {
      max-width: var(--merch-max-w);
      margin: 0 auto;
      padding: 0 var(--merch-gutter);
      display: grid;
      grid-template-columns: 1.5fr 1fr; /* Larger image column as requested */
      gap: 100px;
      align-items: start;
    }

    /* Media (gambar) */
    .shop-detail__media {
      background: #ffffff;
      border-radius: 0;
      box-shadow: none;
      padding: 0;
    }

    .shop-detail__media img {
      width: 100%;
      height: auto;
      max-height: 85vh;
      object-fit: contain;
      display: block;
    }

    /* Info */
    .shop-detail__info { 
      padding-top: 40px;
      position: sticky;
      top: 120px;
    }

    .shop-detail__title {
      font-weight: 800;
      line-height: .9;
      letter-spacing: -0.04em;
      font-size: clamp(32px, 4.5vw, 72px);
      text-transform: uppercase;
      margin-bottom: 24px;
    }

    .shop-detail__price {
      font-weight: 500;
      line-height: 1;
      letter-spacing: -0.02em;
      font-size: clamp(18px, 2vw, 28px);
      color: var(--merch-muted);
      margin-bottom: 40px;
    }

    /* CTA button */
    .btn-buy-now {
      display: inline-flex;
      padding: 18px 52px;
      background: var(--merch-text);
      color: #fff;
      text-transform: uppercase;
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 0.15em;
      text-decoration: none;
      transition: all 0.3s;
    }

    .btn-buy-now:hover {
      background: #333;
      transform: translateY(-2px);
    }

    .shop-detail__note {
      line-height: 1.6;
      letter-spacing: 0.05em;
      color: var(--merch-muted);
      font-size: 11px;
      text-transform: uppercase;
      margin-top: 40px;
    }

    /* Divider */
    .shop-detail__divider {
      border: none;
      height: 1px;
      background: #eee;
      margin: 60px 0;
    }
    .detail{
    font: 300 14px/1.25;
    }

 /* ====== ABOUT LAYOUT ====== */
.shop-about{
  padding: 10px var(--merch-gutter) 80px;
  background: #ffffff; 
  color: #0f1111;
  width: 100%; /* Ensure full background width to remove black sides */
}

.shop-about__grid {
  max-width: 768px; /* Narrow text column */
  margin: 0 auto;
}

/* ====== CARD ====== */
.shop-card{
  border:none;
  border-radius:0;
  background:#ffffff;
  box-shadow:none;
  padding:0;
}
.shop-card__head{
  display:flex; align-items:center; gap:12px;
  margin-bottom: clamp(10px, 2vw, 16px);
}
.shop-card__title{
  margin:0;
  font-weight: 700;
  font-size: clamp(14px, 1.2vw, 16px);
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: #888888; /* Gray bold as requested */
}

/* ====== TYPOGRAPHY (prose) ====== */
.shop-desc{
  white-space: normal;
  font-weight: 700; /* Bold as requested */
  font-size: 16px;
  line-height: 1.75;
  color: var(--merch-text);
}
.shop-desc p{ 
  font-size: 1.25rem;
  font-weight: 700; /* Bold as requested */
  line-height: 1.6;
  margin-bottom: 1rem; 
}

.shop-desc h2 {

    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1.6;
    margin-bottom: 1rem;
  }
  .shop-desc h3 {

    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1.6;
    margin-bottom: 1rem;
  }
  .shop-desc blockquote {

    font-size: 1.25rem;
    font-weight: 500;
    line-height: 1.6;
    margin-bottom: 1rem;
  }

  .shop-desc ul {

    font-size: 1.25rem;
    font-weight: 300;
    line-height: 1.6;
    margin-bottom: 1rem;
  }

/* dll tetap sama (list, heading, tabel, blockquote, img, code) */

    /* meta list */
    .meta-list{ list-style:none; margin:0; padding:0; display:grid; gap:12px }
    .meta-list li{ display:flex; align-items:center; gap:12px; color:#333 }
    .meta-list .ico{ width:22px; height:22px; display:grid; place-items:center; color:#566; }
    .meta-list .ico svg{ width:22px; height:22px; fill:#889; opacity:.9 }

    /* simple list */
    .plain-list{ list-style:none; margin:0; padding:0; display:grid; gap:10px; color:#222 }

  /* Related Products Refinement */
  .related-products {
    max-width: var(--merch-max-w);
    margin: 0 auto;
    width: 100%;
    background: #fff;
    padding: 120px 0 60px; /* Vertical padding only on the wrapper */
  }

  .rp__header {
    margin-bottom: 60px;
    position: relative;
    padding: 0 var(--merch-gutter) 15px; /* Add horizontal padding here */
  }

  .rp__title {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--merch-text);
    margin: 0;
  }

  .rp__title::after {
    content: "";
    position: absolute;
    left: var(--merch-gutter); /* Start underline from content edge */
    bottom: 0;
    width: 25ch; /* Long minimalist underline */
    height: 1px;
    background: var(--merch-text);
    opacity: 0.2;
  }

  .rp__viewall {
    margin-top: 32px;
    display: inline-flex;
    padding: 12px 32px;
    background: var(--merch-text);
    color: #fff;
    text-transform: uppercase;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-decoration: none;
    transition: all 0.3s;
  }

  .rp__viewall:hover {
    background: #333;
    transform: translateY(-2px);
  }

  .rp__grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 40px 20px;
    width: 100%;
    padding: 0 var(--merch-gutter); /* Add horizontal padding here */
  }

  .rp-card {
    flex: 0 0 calc(25% - 15px);
    min-width: 280px;
    text-decoration: none;
    color: var(--merch-text);
    text-align: left;
    transition: opacity 0.3s;
  }

  .rp-card__media {
    width: 100%;
    aspect-ratio: 1;
    overflow: hidden;
    background: #ffffff !important;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .rp-card__media img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rp-card:hover .rp-card__media img {
    transform: scale(1.1);
  }

  .rp-card__name {
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 6px;
    letter-spacing: 0.05em;
  }

  .rp-card__price {
    font-size: 12px;
    color: var(--merch-muted);
  }

  @media (max-width: 1200px) {
    .rp-card { flex: 0 0 calc(33.333% - 14px); }
  }

  @media (max-width: 900px) {
    .rp-card { flex: 0 0 calc(50% - 10px); }
  }

  @media (max-width: 600px) {
    .rp-card { flex: 0 1 100%; }
    .rp__header { padding-bottom: 10px; }
  }

/* ===== Scroll-reveal (cinematic) ===== */
html.js .reveal-y{
  opacity:0;
  transform: translate3d(0,22px,0);
  transition: opacity .6s cubic-bezier(.2,.7,.2,1), transform .6s cubic-bezier(.2,.7,.2,1);
  will-change: opacity, transform;
}
html.js .reveal-x{
  opacity:0;
  transform: translate3d(-22px,0,0);
  transition: opacity .6s cubic-bezier(.2,.7,.2,1), transform .6s cubic-bezier(.2,.7,.2,1);
  will-change: opacity, transform;
}
html.js .is-revealed{
  opacity:1 !important;
  transform:none !important;
}
/* optional stagger container */
.reveal-stagger{ --stagger: 90ms; }
@media (prefers-reduced-motion: reduce){
  html.js .reveal-y,
  html.js .reveal-x{
    opacity:1 !important; transform:none !important; transition:none !important;
  }
}
.reveal-m,
.reveal-y,
.reveal-x {
  opacity: 1 !important;
  transform: none !important;
  transition: none !important;
}
</style>
<section class="shop-detail">
  <div class="shop-detail__container">
    <!-- Media / Foto Produk -->
    <div class="shop-detail__media reveal-y" data-reveal="0.05">
      <!-- ganti src sesuai asset Anda -->
      <img src="{{ asset('photo/' . $shop->photo) }}" alt="Kaos Perayaan Mati Rasa" />
    </div>

    <!-- Info Produk -->
    <div class="shop-detail__info">
      <h1 class="shop-detail__title">
        {{ $shop->name }}
      </h1>

      <div class="shop-detail__price">{{ $shop->harga ? 'Rp'.''.str_replace(',', '.', number_format($shop->harga)) : '' }}</div>

      <a
        id="buyNowBtn"
        class="btn-buy-now"
        href="{{ $shop->link }}"
        target="_blank"
        rel="noopener noreferrer nofollow external"
        aria-label="Buy Now (opens in a new tab)"
      >
        <span>BUY NOW</span>
      </a>

      <p class="shop-detail__note">
        Purchases are handled via our official store on external platforms.
      </p>

    </div>
  </div>
</section>

<!-- ========= ABOUT SHOP ========= -->
<section class="shop-about">
  <div class="shop-about__grid">
    <!-- LEFT COLUMN -->
    <div class="shop-about__main">

      <article class="shop-card reveal-y" data-reveal="0.08">
        <header class="shop-card__head">
          <h2 class="shop-card__title">Description</h2>
        </header>

        <!-- JANGAN pakai <p> untuk detail yang berisi list/heading.
             Pakai <div> agar semua markup bawaan tetap valid. -->
        <div class="shop-desc">
          {!! $shop->detail !!}
        </div>
      </article>

    </div>
  </div>
</section>

<section class="related-products">
  <div class="rp__header">
    <h2 class="rp__title">You Might Also Like</h2>
  </div>

  <div class="rp__grid">
    @foreach ($all_shop as $item)
        <a href="{{ route('detail-shop', $item->slug) }}" class="rp-card">
          <div class="rp-card__media">
            <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->name }}">
          </div>
          <div class="rp-card__meta">
            <div class="rp-card__name">{{ $item->name }}</div>
            <div class="rp-card__price">{{ $item->harga ? 'Rp'.''.str_replace(',', '.', number_format($item->harga)) : '' }}</div>
          </div>
        </a>
    @endforeach
  </div>

  <div style="text-align: center; margin-top: 40px;">
    <a href="{{ route('shop') }}" class="rp__viewall">
      <span>View All</span>
    </a>
  </div>
</section>
<script>
(function(){
  // enable JS flag
  document.documentElement.classList.add('js');

  // helper: read float seconds from data-reveal
  function getDelay(el){
    var d = el.getAttribute('data-reveal');
    return d ? Math.max(0, parseFloat(d)) : 0;
  }

  // IntersectionObserver
  var io = null;
  try{
    io = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          var el = entry.target;
          // stagger support (parent drives children)
          if(el.classList.contains('reveal-stagger')){
            var items = el.querySelectorAll('.reveal-y, .reveal-x');
            var base = parseInt(el.getAttribute('data-stagger') || '90', 10);
            items.forEach(function(child, i){
              child.style.transitionDelay = (i * base / 1000) + 's';
              // small extra per-item offset if child has data-reveal
              var extra = getDelay(child);
              if(extra) child.style.transitionDelay = (i * base / 1000 + extra) + 's';
              requestAnimationFrame(function(){ child.classList.add('is-revealed'); });
              io.unobserve(child);
            });
          }

          // self reveal
          el.style.transitionDelay = getDelay(el) + 's';
          requestAnimationFrame(function(){ el.classList.add('is-revealed'); });
          io.unobserve(el);
        }
      });
    }, { rootMargin: '0px 0px -5% 0px', threshold: 0.12 });
  }catch(e){ /* older browsers: reveal everything */ }

  // observe
  var targets = document.querySelectorAll('.reveal-y, .reveal-x, .reveal-stagger');
  targets.forEach(function(t){
    if(io){ io.observe(t); }
    else{ t.classList.add('is-revealed'); }
  });
})();
</script>
<script>
(function(){
  var el = document.getElementById('buyNowBtn');
  if (!el) return;
  el.addEventListener('click', function(e){
    // Normalize any interceptors by explicitly opening a new tab/window
    var url = this.getAttribute('href');
    if (!url) return;
    e.preventDefault();
    // Use noopener for security; Safari-compatible fallback
    var w = window.open(url, '_blank', 'noopener');
    if (w) { try { w.opener = null; } catch(_){} }
  }, { capture: true });
})();
</script>

@include('components.footer')
@endsection