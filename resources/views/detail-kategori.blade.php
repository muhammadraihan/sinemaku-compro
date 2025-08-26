@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')

<style>
/* ---------- NAVBAR (tetap) ---------- */
.navbar-logo{
  position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);
  font-family:'Inter',Arial,sans-serif; font-size:1.11rem; font-weight:800;
  letter-spacing:1.7px; color:#070707; text-shadow:0 1px 5px rgba(0,0,0,.09);
  pointer-events:none; text-transform:uppercase; line-height:1; white-space:nowrap;
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
  .collection-grid{ gap: clamp(18px,4vw,36px); }
  .collection-hero{ grid-column:1 / span 12; grid-row: span 1; }
  .collection-hero .hero-media{ aspect-ratio:16/9; }
  .product-tile{ grid-column: span 6; }
}
@media (max-width:520px){
  .product-tile{ grid-column:1 / -1; }
}
</style>

<section class="collection">
  <div class="collection-grid">
    {{-- HERO --}}
    <article class="collection-hero">
      <h1 class="hero-title">APPAREL</h1>
      <div class="hero-media">
        <img src="{{ asset('img/image-10.png') }}" alt="Apparel">
      </div>
    </article>

    {{-- TILES --}}
    <article class="product-tile">
      <a href="{{ route('detail-shop') }}" class="product-media"><img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa"></a>
      <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
      <p class="product-price">Rp175.000,-</p>
    </article>

    <article class="product-tile">
      <a href="{{ route('detail-shop') }}" class="product-media"><img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa"></a>
      <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
      <p class="product-price">Rp175.000,-</p>
    </article>

    <article class="product-tile">
      <a href="{{ route('detail-shop') }}" class="product-media"><img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa"></a>
      <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
      <p class="product-price">Rp175.000,-</p>
    </article>

    <article class="product-tile">
      <a href="{{ route('detail-shop') }}" class="product-media"><img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa"></a>
      <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
      <p class="product-price">Rp175.000,-</p>
    </article>

    {{-- Tambahan contoh --}}
    <article class="product-tile">
      <a href="{{ route('detail-shop') }}" class="product-media"><img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa"></a>
      <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
      <p class="product-price">Rp175.000,-</p>
    </article>

    <article class="product-tile">
      <a href="{{ route('detail-shop') }}" class="product-media"><img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa"></a>
      <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
      <p class="product-price">Rp175.000,-</p>
    </article>

    <article class="product-tile">
      <a href="{{ route('detail-shop') }}" class="product-media"><img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa"></a>
      <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
      <p class="product-price">Rp175.000,-</p>
    </article>

    <article class="product-tile">
      <a href="{{ route('detail-shop') }}" class="product-media"><img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa"></a>
      <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
      <p class="product-price">Rp175.000,-</p>
    </article>
  </div>
</section>
