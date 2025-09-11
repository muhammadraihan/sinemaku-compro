@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')
<style>
    .navbar-logo {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    font-family: 'Inter', Arial, sans-serif;
    font-size: 1.11rem;      /* Lebih kecil dan ramping */
    font-weight: 800;
    letter-spacing: 1.7px;
    color: #070707;
    text-shadow: 0 1px 5px rgba(0,0,0,0.09);
    white-space: nowrap;
    text-transform: uppercase;
    line-height: 1;
    pointer-events:auto;          /* <-- boleh diklik */
  text-decoration:none;         /* hilangkan underline */
  padding:10px 14px;            /* area klik nyaman */
  z-index:2;                    /* pastikan di atas bg navbar */
    }
    .icon-hamburger rect {
    fill: #070707;
    }
    .icon-search circle {
    stroke: #070707;
    }
    .icon-search line {
    stroke: #070707;
    }

    /* Layout wrapper */
    .shop-detail {
    padding: clamp(32px, 4.5vw, 72px) 0;
    background: #fff;
    color: #131313;
    }

    .shop-detail__container {
    width: min(1280px, 92vw);
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: clamp(28px, 4vw, 64px);
    align-items: start;
    }

    /* Media (gambar) */
    .shop-detail__media {
    background: #f6f7f8;
    border-radius: 14px;
    box-shadow: 0 10px 28px rgba(0,0,0,.06);
    padding: clamp(14px, 2vw, 22px);
    }

    .shop-detail__media img {
    width: 100%;
    height: clamp(360px, 48vw, 640px);
    object-fit: contain;       /* gambar tidak ter-crop */
    display: block;
    border-radius: 10px;
    }

    /* Info */
    .shop-detail__info { padding-top: 6px; }

    .shop-detail__title {
    font-family: "Inter", sans-serif;
    font-weight: 800;
    line-height: .95;
    letter-spacing: -1px;
    font-size: clamp(28px, 3.2vw, 44px);
    margin-top: 150px;
    }

    .shop-detail__price {
    font-family: "Inter", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
    font-weight: 500;
    line-height: .95;
    letter-spacing: -0.5px;
    font-size: clamp(18px, 1.6vw, 22px);
    margin: 6px 0 24px;
    }

    /* CTA button */
    .shop-detail__cta {
    margin-top: 10px;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 16px 22px;
    border-radius: 10px;
    background: #fff;
    color: #111;
    text-decoration: none;
    font-weight: 700;
    letter-spacing: .2px;
    transition: transform .18s ease, box-shadow .18s ease, background .2s ease;
    box-shadow: 0 5px 12px rgba(0, 0, 0, 0.156);
    }

    .shop-detail__cta svg {
    width: 20px; height: 20px;
    transition: transform .22s ease;
    }

    .shop-detail__cta:hover {
    transform: translateY(-1px);
    box-shadow: 0 14px 34px rgba(0,0,0,.18);
    }

    .shop-detail__cta:hover svg { transform: translateX(4px); }

    .shop-detail__note {
    font-family: "Inter", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
    line-height: .95;
    letter-spacing: -0.5px;
    color: #6f6f6f;
    font-size: 13px;
    margin-top: 40px;
    }

    /* Divider + bullets */
    .shop-detail__divider {
    border: none;
    height: 1px;
    background: #ececec;
    margin: 16px 0 18px;
    }

    .shop-detail__divider2 {
    border: none;
    height: 1px;
    background: #ececec;
    /* margin: 16px 0 18px; */
    margin-left: 100px;
    margin-right: 100px;
    }

    .shop-detail__bullets {
    list-style: none;
    padding: 0; margin: 0;
    display: grid;
    gap: 12px;
    font-size: 15px;
    color: #2a2a2a;
    }

    .shop-detail__bullets li {
    display: flex;
    align-items: center;
    gap: 12px;
    }

    .shop-detail__bullets .ico {
    display: inline-flex;
    width: 28px; height: 28px;
    border-radius: 8px;
    background: #f0f2f4;
    color: #1a1a1a;
    align-items: center; justify-content: center;
    }

    .shop-detail__bullets .ico svg {
    width: 16px; height: 16px;
    }

    /* Responsive */
    @media (max-width: 960px) {
    .shop-detail__container {
        grid-template-columns: 1fr;
    }
    .shop-detail__media img {
        height: clamp(320px, 60vw, 520px);
    }
    }
    .detail{
    font: 300 14px/1.25 Inter, Arial, sans-serif;
    }

 /* ====== ABOUT LAYOUT ====== */
.shop-about{
  padding: clamp(28px, 5vw, 64px) clamp(16px, 5vw, 64px);
  background:#fff; 
  color:#0f1115;
  margin-top: -40px;     /* ⬅️ naikkan card lebih dekat */
}

/* pastikan tidak ada garis separator global */
.shop-about::before,
.shop-about::after{
  content:none !important;
  display:none !important;
  border:0 !important;
}
.articles-section + .shop-about,
.site-footer + .shop-about{
  border-top:none !important;
}

/* ====== CARD ====== */
.shop-card{
  border:1px solid #eceef2;
  border-radius:16px;
  background:#ffffff;
  box-shadow:0 10px 28px rgba(15,17,21,.06);
  padding:clamp(18px,2.8vw,28px) clamp(18px,3vw,32px);
}
.shop-card__head{
  display:flex; align-items:center; gap:12px;
  margin-bottom: clamp(10px, 2vw, 16px);
}
.shop-card__title{
  margin:0;
  font: 700 clamp(18px, 2.6vw, 24px)/1.15 "Inter", system-ui, Arial, sans-serif;
  letter-spacing:-.01em;
}

/* ====== TYPOGRAPHY (prose) ====== */
.shop-desc{
  white-space: normal;
  font: 400 16px/1.75 "Inter", system-ui, -apple-system, Arial, sans-serif;
  color:#2a2f35;
}
.shop-desc p{ 
  font-size: 1.25rem;
  font-weight: 300;
  line-height: 1.6;
  margin-bottom: 1rem; 
}

.shop-desc h2 {
    font-family: 'Inter', sans-serif;
    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1.6;
    margin-bottom: 1rem;
  }
  .shop-desc h3 {
    font-family: 'Inter', sans-serif;
    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1.6;
    margin-bottom: 1rem;
  }
  .shop-desc blockquote {
    font-family: 'Inter', sans-serif;
    font-size: 1.25rem;
    font-weight: 500;
    line-height: 1.6;
    margin-bottom: 1rem;
  }

  .shop-desc ul {
    font-family: 'Inter', sans-serif;
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
    .plain-list{ font-family:"Inter",sans-serif; list-style:none; margin:0; padding:0; display:grid; gap:10px; color:#222 }

    .related-products {
    width: min(1280px, 92vw);
    margin: clamp(40px, 6vw, 80px) auto 0;
    }

    .rp__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: clamp(18px, 2.8vw, 28px);
    }

    .rp__title {
    font-family: "Inter", sans-serif;
    font-size: 500 clamp(14px,2vw,25px)/1.08 "Inter", sans-serif;
    line-height: 1.1;
    margin: 0;
    line-height: .95;
    letter-spacing: 0.5px;
    font-weight: 500px;
    }

    .rp__viewall {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    color: #141414;
    font-weight: 600;
    padding: 10px 12px;
    border-radius: 10px;
    transition: background .18s ease, transform .18s ease;
    }
    .rp__viewall svg { width: 20px; height: 20px; transition: transform .2s ease; }
    .rp__viewall:hover { background: #f2f3f4; transform: translateY(-1px); }
    .rp__viewall:hover svg { transform: translateX(4px); }

    .rp__grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: clamp(22px, 3.2vw, 36px);
    margin-bottom: 100px;
    justify-items: center;
    }

    /* Card */
    .rp-card {
    text-decoration: none;
    color: inherit;
    display: grid;
    gap: 14px;
    max-width: 320px;
    margin: 0 auto;
    justify-items: center;
    }

    .rp-card__media {
    background: #fafafa;
    border-radius: 14px;
    padding: clamp(14px, 2vw, 22px);
    height: clamp(220px, 22vw, 280px);   /* tinggi area media */
    display: grid;
    place-items: center;
    box-shadow: 0 10px 28px rgba(0,0,0,.05);
    transition: transform .18s ease, box-shadow .18s ease;
    }
    .rp-card__media img {
    width: 100%;
    height: 100%;
    object-fit: contain;               /* gambar tidak ter-crop */
    }
    .rp-card:hover .rp-card__media {
    transform: translateY(-4px);
    box-shadow: 0 14px 38px rgba(0,0,0,.08);
    }

    .rp-card__meta {
  font-family: "Inter", sans-serif;
  line-height: 1.4;
  letter-spacing: 0.5px;
  text-align: left;   /* ubah dari center ke left */
}

.rp-card__name {
  font-size: clamp(10px, 1.0vw, 14px);
  color: #222;
  margin-bottom: 6px;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  min-height: 2.6em;
}

.rp-card__price {
  font-weight: 600;
  font-size: clamp(12px, 1.2vw, 16px);
}

    /* Responsive */
    @media (max-width: 1100px) {
    .rp__grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 780px) {
    .rp__grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 640px){
      .rp__grid{
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
        justify-items: center;
      }
      .rp-card{
        max-width: 240px;
        text-align: center;
      }
      .rp-card__meta{ text-align: center; }
      .rp-card__media{
        height: clamp(150px, 40vw, 200px);
        padding: 10px;
      }
      .rp-card__name{ font-size: 13px; }
      .rp-card__price{ font-size: 13px; }
    }
    @media (max-width: 400px) {
    .rp__grid { grid-template-columns: 1fr; }
    }


/* ======= Responsive refinements for Detail Shop ======= */
@media (max-width: 1024px){
  .shop-detail{ padding: 28px 0; }
  .shop-detail__container{ grid-template-columns: 1fr; gap: 18px; }
  .shop-detail__media{ order: 1; }
  .shop-detail__media img{ height: clamp(280px, 62vw, 520px); }
  .shop-detail__info{ order: 2; }
  .shop-detail__title{ margin-top: 12px; }
  .shop-detail__price{ margin: 8px 0 16px; }
  .shop-detail__cta{ width: 100%; justify-content: center; }
  .shop-detail__bullets{ gap: 10px; font-size: 14px; }
  .shop-detail__bullets .ico{ width: 24px; height: 24px; }
  .shop-detail__bullets .ico svg{ width: 14px; height: 14px; }
  .shop-detail__note{ margin-top: 22px; line-height: 1.4; }
  .shop-detail__divider2{ margin-left: 16px; margin-right: 16px; }
  .shop-about{ padding: 24px 16px 40px; }
  .shop-card{ padding: 16px 16px 18px; }
  .shop-card__title{ font-size: 20px; }
}

@media (max-width: 640px){
  .shop-detail{ padding: 20px 0; }
  .shop-detail__media {margin-top:50px;}
  .shop-detail__media img{ height: clamp(220px, 58vw, 420px); }
  .shop-detail__title{ font-size: clamp(22px, 6.2vw, 32px); margin-top: 8px; }
  .shop-detail__price{ font-size: 16px; }
  .shop-detail__cta{ padding: 14px 18px; }
  .shop-detail__note{ font-size: 12.5px; }

  .rp__grid{ grid-template-columns: 1fr; gap: 16px; }
  .rp-card__media{ height: clamp(180px, 56vw, 260px); padding: 12px; }
  .rp-card__name{ font-size: 14px; }
  .rp-card__price{ font-size: 14px; }
}

@media (max-width: 400px){
  .shop-detail__media img{ height: clamp(200px, 60vw, 360px); }
  .rp-card__media{ height: clamp(160px, 54vw, 220px); padding: 10px; }
}
 /* Responsive font for "You Might Also Like" title on mobile */
 @media (max-width: 640px){
      .rp__title {
        font-size: 16px;
      }
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
    <div class="shop-detail__info reveal-y" data-reveal="0.1">
      <h1 class="shop-detail__title reveal-y" data-reveal="0.12">
        {{ $shop->name }}
      </h1>

      <div class="shop-detail__price reveal-y" data-reveal="0.16">{{ $shop->harga ? 'Rp'.''.str_replace(',', '.', number_format($shop->harga)) : ''; }}</div>

      <a
        class="shop-detail__cta reveal-y" data-reveal="0.20"
        href="{{ $shop->link }}" 
        target="_blank" 
        rel="noopener"
      >
        <span class="detail">BUY NOW</span>
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>

      <p class="shop-detail__note reveal-y" data-reveal="0.24">
        Purchases are handled via our official store on external platforms.
      </p>

      <hr class="shop-detail__divider reveal-y" data-reveal="0.28"/>

      <ul class="shop-detail__bullets reveal-stagger" data-stagger="90">
        <li class="reveal-y">
          <span class="ico">
            <svg viewBox="0 0 24 24">
              <path d="M3 7h18v10H3zM3 7l9 6 9-6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span class="detail">Free shipping on orders over $25</span>
        </li>
        <li class="reveal-y">
          <span class="ico">
            <svg viewBox="0 0 24 24">
              <path d="M12 22s8-4.5 8-12a8 8 0 10-16 0c0 7.5 8 12 8 12z" fill="none" stroke="currentColor" stroke-width="1.8"/>
              <circle cx="12" cy="10" r="2" fill="currentColor"/>
            </svg>
          </span>
          <span class="detail">Secure payment & buyer protection</span>
        </li>
        <li class="reveal-y">
          <span class="ico">
            <svg viewBox="0 0 24 24">
              <path d="M4 7h16v10H4zM8 7V5h8v2" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M9 12h6M9 15h6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
          </span>
          <span class="detail">30-day return policy</span>
        </li>
      </ul>
    </div>
  </div>
</section>

<hr class="shop-detail__divider2"/>

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
  <div class="rp__header reveal-y" data-reveal="0.06">
    <h2 class="rp__title">You Might Also Like</h2>

    <a href="{{ route('shop') }}" class="rp__viewall">
      <span class="detail">View All</span>
      <svg viewBox="0 0 24 24" aria-hidden="true">
        <path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </a>
  </div>

  <div class="rp__grid reveal-stagger" data-stagger="80">
    @foreach ($all_shop as $item)
        <a href="{{ route('detail-shop', $item->slug) }}" class="rp-card reveal-y">
          <img src="{{ asset('photo/' . $item->photo) }}" class="rp-card__media">
            <div class="rp-card__meta">
              <div class="rp-card__name">{{ $item->name }}</div>
              <div class="rp-card__price">{{ $item->harga ? 'Rp'.''.str_replace(',', '.', number_format($item->harga)) : ''; }}</div>
            </div>
          </a>
    @endforeach
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