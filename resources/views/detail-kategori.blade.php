@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')

<style>
/* ---------- NAVBAR (tetap) ---------- */
.navbar-logo{
  position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);
  font-family:'Inter',Arial,sans-serif; font-size:1.11rem; font-weight:800;
  letter-spacing:1.7px; color:#070707; text-shadow:0 1px 5px rgba(0,0,0,.09);
 text-transform:uppercase; line-height:1; white-space:nowrap;
  pointer-events:auto;          /* <-- boleh diklik */
  text-decoration:none;         /* hilangkan underline */
  padding:10px 14px;            /* area klik nyaman */
  z-index:2;                    /* pastikan di atas bg navbar */
}
.icon-hamburger rect{ fill:#070707; }
.icon-search circle,.icon-search line{ stroke:#070707; }

/* ---------- COLLECTION ALA A24 ---------- */
:root{
  --wrap: min(1400px, 94vw);
  --gap: clamp(20px, 2.6vw, 48px);
  --ink: #0f0f0f;   /* <— perbaiki typo (#) */
  --sub: #B2B1B9;
}

.collection{ width:var(--wrap); margin: clamp(20px,5vw,68px) auto 80px; }

.collection-grid{
  display:grid;
  grid-template-columns: repeat(12, minmax(0,1fr));
  gap: var(--gap);
  align-items:start;
  grid-auto-flow:dense;
  grid-gap: var(--gap);
}

/* ===== HERO: kecil + title kiri atas + span 2 baris (agar 4 tile di kanan) ===== */
.collection-hero{
  grid-column: 1 / span 6;
  grid-row: span 2;
  position: relative;
  isolation:isolate;
}
.collection-hero .hero-media{
  aspect-ratio: 4 / 5;
  width:100%; display:grid; place-items:center;
}
.collection-hero .hero-media img{
  width: 82%; height:auto; object-fit:contain; display:block;
  max-width: 100%;
}
.collection-hero .hero-title{
  position:absolute; top:clamp(12px,2.4vw,28px); left:clamp(12px,2.4vw,28px);
  margin:0; font:700 clamp(22px,3.6vw,44px)/.9 'Inter',system-ui,Arial; letter-spacing:.02em;
  color:#000; z-index:2;
}

/* ===== TILE PRODUK POLOS ===== */
.product-tile{ grid-column: span 3; }

.product-media{
  aspect-ratio:1/1; width:100%;
  display:flex; align-items:center; justify-content:center;
}
.product-media img{
  width: clamp(180px, 82%, 92%);
  height: clamp(180px, 82%, 92%);
  object-fit:contain; object-position:center; display:block;
  transition: transform .18s ease;
}
.product-tile:hover .product-media img{ transform: translateY(-2px); }

.product-name{
  margin: 10px 0 6px;
  font-family: 'Inter', Arial, sans-serif;
  font-size: clamp(13px, 0.5vw, 16px);
  font-weight: 200;
  line-height: 1.1;
  letter-spacing: 0;
  color: var(--ink);
  transition: color .18s ease;        /* <— biar halus saat berubah warna */
}

.product-price{
  margin: 0;
  font-family: 'Inter', Arial, sans-serif;
  font-size: clamp(12px, 0.5vw, 13px);
  font-weight: 500;
  line-height: 1;
  color: var(--sub);
}

/* Hover effect ala A24:
   Saat seluruh tile di-hover/focus-within, nama produk menjadi warna harga */
.product-tile:hover .product-name,
.product-tile:focus-within .product-name{
  color: var(--sub);
}

/* ---------- RESPONSIVE ---------- */
@media (max-width:1200px){
  .collection-hero{ grid-column:1 / span 8; }
  .product-tile{ grid-column: span 4; }
}
@media (max-width:900px){
  .collection-grid{ gap: clamp(18px,4vw,36px); grid-gap: clamp(18px,4vw,36px); }
  .collection-hero{ 
    grid-column:1 / span 12; 
    grid-row: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .collection-hero .hero-media{ aspect-ratio:16/9; }
  .collection-hero .hero-title{
    position: static;
    margin-top: 52px;
    text-align: center;
    font: 700 clamp(16px, 3vw, 24px)/1 'Inter', system-ui, Arial;
    letter-spacing: .02em;
    color: #000;
    z-index: auto;
  }
  .product-tile{ grid-column: span 6; }
}
@media (max-width:520px){
  .collection-grid{ gap: 12px; grid-gap: 12px; }
  .product-tile{ grid-column:1 / -1; }
  .product-media img{
    max-width: 70%;
    height: auto;
    margin: 0 auto;
  }
  .product-name, .product-price {
    text-align: center;
  }
}

/* ===== Cinematic reveal animations (A24-ish) ===== */
.reveal,
.reveal-x{
  opacity: 0;
  transform: translateY(18px);
  transition:
    opacity .66s cubic-bezier(.22,.61,.36,1),
    transform .66s cubic-bezier(.22,.61,.36,1);
  will-change: opacity, transform;
}
.reveal-x{
  transform: translateX(-22px);
}
.reveal.is-visible,
.reveal-x.is-visible{
  opacity: 1;
  transform: none;
}

/* Optional container stagger: each direct child fades in sequentially */
.reveal-stagger > *{
  opacity: 0;
  transform: translateY(18px);
  transition:
    opacity .66s cubic-bezier(.22,.61,.36,1),
    transform .66s cubic-bezier(.22,.61,.36,1);
  will-change: opacity, transform;
}
.reveal-stagger.is-visible > *{
  opacity: 1;
  transform: none;
}

/* Respect reduced motion */
@media (prefers-reduced-motion: reduce){
  .reveal, .reveal-x,
  .reveal-stagger > *{
    opacity: 1 !important;
    transform: none !important;
    transition: none !important;
  }
}
.reveal-m {
  opacity: 1 !important;
  transform: none !important;
  transition: none !important;
}
</style>

<section class="collection">
  <div class="collection-grid">
    {{-- HERO --}}
    <article class="collection-hero">
      <h1 class="hero-title reveal-x">{{ strtoupper($title->Categories->name) }}</h1>
      <div class="hero-media reveal">
        <img src="https://i.imgur.com/X1io1iz.jpeg" alt="Apparel">
      </div>
    </article>

    {{-- TILES --}}
    @foreach ($shop as $item)
        <article class="product-tile reveal">
          <a href="{{ route('detail-shop', $item->slug) }}" class="product-media"><img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->name }}"></a>
          <h3 class="product-name">{{ $item->name }}</h3>
          <p class="product-price">{{ $item->harga ? 'Rp'.''.str_replace(',', '.', number_format($item->harga)) : ''; }}</p>
        </article>
    @endforeach
  </div>
</section>
<script>
(function(){
  // Skip if prefers-reduced-motion
  const reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduce) return;

  const els = document.querySelectorAll('.reveal, .reveal-x, .reveal-stagger');
  if (!els.length) return;

  const io = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting){
        const el = entry.target;
        el.classList.add('is-visible');

        // Stagger for container: apply delay to each child once
        if (el.classList.contains('reveal-stagger')) {
          Array.from(el.children).forEach((child, i) => {
            child.style.transitionDelay = (80 * i) + 'ms';
          });
        }

        obs.unobserve(el); // animate once
      }
    });
  }, { threshold: 0.16, rootMargin: '0px 0px -4% 0px' });

  els.forEach(el => io.observe(el));
})();
</script>
