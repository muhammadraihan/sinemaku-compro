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
  --ink: #111;
  --sub: #757575;
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
  grid-column: 1 / span 6;   /* setengah layar */
  grid-row: span 2;          /* >>> ini kunci 4 tile di kanan (2×2) <<< */
  position: relative;
  isolation:isolate;
}
.collection-hero .hero-media{
  aspect-ratio: 4 / 5;       /* proporsi ramping */
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
.product-tile{ grid-column: span 3; }   /* 4 per baris di total 12 kolom (kanan hero 6 kolom => 2 per baris) */

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
  margin:10px 0 6px;
  font:500 clamp(14px,1.35vw,18px)/1.2 'Inter',Arial,sans-serif; color:var(--ink); letter-spacing:.2px;
}
.product-price{
  margin:0; font:600 clamp(12px,1.05vw,14px)/1 'Inter',Arial,sans-serif; color:var(--sub);
}

/* ---------- RESPONSIVE ---------- */
@media (max-width:1200px){
  .collection-hero{ grid-column:1 / span 8; }
  .product-tile{ grid-column: span 4; } /* 3 kolom */
}
@media (max-width:900px){
  .collection-grid{ gap: clamp(18px,4vw,36px); }
  .collection-hero{ grid-column:1 / span 12; grid-row: span 1; } /* di mobile tidak perlu 2 baris */
  .collection-hero .hero-media{ aspect-ratio:16/9; }
  .product-tile{ grid-column: span 6; } /* 2 kolom */
}
@media (max-width:520px){
  .product-tile{ grid-column:1 / -1; } /* 1 kolom */
}
</style>

<section class="collection">
  <div class="collection-grid">
    {{-- HERO (kiri, kecil, span 2 baris) --}}
    <article class="collection-hero">
      <h1 class="hero-title">APPAREL</h1>
      <div class="hero-media">
        <img src="{{ asset('img/baju-pmr.jpg') }}" alt="Apparel">
      </div>
    </article>

    {{-- 4 tile pertama akan otomatis mengisi area kanan hero (2×2) --}}
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

    {{-- sisanya lanjut ke baris berikutnya --}}
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
