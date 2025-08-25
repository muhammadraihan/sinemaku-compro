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
    pointer-events: none;
    text-transform: uppercase;
    line-height: 1;
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

    :root{
      --page-pad: clamp(16px, 3.5vw, 56px);
      --card-radius: 14px;
      --shadow: 0 10px 28px rgba(0,0,0,.08);
    }

    /* Judul kanan atas */
    .category-hero{
      margin-top: 60px;
      display:flex;
      justify-content:flex-end;
      padding: 24px var(--page-pad) 8px;
    }
    .category-title{
      font-family: 'Inter', Arial, sans-serif;
      font-size: clamp(28px, 3.8vw, 44px);
      font-weight: 500;
      line-height: .95;
      letter-spacing: 0.5px;
    }

    /* Grid kategori */
    .category-grid{
      padding: 6px var(--page-pad) 56px;
      display:grid;
      grid-template-columns: repeat(12, 1fr);
      grid-auto-rows: 1fr;
      gap: clamp(14px, 1.8vw, 22px);
      align-items: start;
    }

    /* Kartu */
    .product-card{
      grid-column: span 3; /* default item kecil: 4 kolom = 12/3 */
      background:#fff;
      border-radius: var(--card-radius);
      box-shadow: var(--shadow);
      padding: clamp(12px, 1.6vw, 16px);
      transition: transform .22s ease, box-shadow .22s ease;
    }
    .product-card:hover{
      transform: translateY(-4px);
      box-shadow: 0 16px 36px rgba(0,0,0,.12);
    }

    /* Featured besar */
    .product-card.featured{
      grid-column: 6 / span 7;      /* mulai kolom ke-6, lebar 7 kolom (kira-kira seperti layout contoh) */
      grid-row: span 2;              /* tinggi 2 baris */
      display:flex;
      flex-direction:column;
      justify-content:flex-start;
    }

    /* Thumb seragam */
    .product-thumb{
      width: 100%;
      aspect-ratio: 1 / 1;           /* seragam kotak */
      border-radius: 10px;
      background:#f7f7f7;
      display:flex;
      align-items:center;
      justify-content:center;
      overflow:hidden;
    }
    .product-card.featured .product-thumb{
      aspect-ratio: 4 / 3;           /* featured lebih melebar */
      border-radius: 12px;
    }
    .product-thumb img{
      width: 100%;
      height: 100%;
      object-fit: contain;           /* tidak crop; ganti ke cover jika mau penuh */
      display:block;
    }

    /* Nama & harga */
    .product-name{
      font-family: 'Inter', Arial, sans-serif;
      font-size: clamp(14px, 1.4vw, 18px);
      font-weight: 500;
      margin: 12px 6px 4px;
      line-height: .95;
      letter-spacing: 0.5px;
    }
    .product-price{
      font-family: 'Inter', Arial, sans-serif;
      font-weight: 100;
      margin: 0 6px 2px;
      line-height: .95;
      letter-spacing: 0.5px;
    }

    /* Responsif */
    @media (max-width: 1100px){
      .product-card{ grid-column: span 4; } /* 3 kolom */
      .product-card.featured{ grid-column: span 8; }
    }
    @media (max-width: 820px){
      .category-title{ justify-self:flex-start; }
      .category-grid{
        grid-template-columns: repeat(8, 1fr);
      }
      .product-card{ grid-column: span 4; } /* 2 kolom */
      .product-card.featured{
        grid-column: span 8;
        grid-row: span 1;
      }
    }
    @media (max-width: 560px){
      .category-grid{
        grid-template-columns: repeat(4, 1fr);
      }
      .product-card{ grid-column: span 4; } /* 1 kolom */
    }

</style>
<section class="category-hero">
  <h1 class="category-title">APPARELS</h1>
</section>

<section class="category-grid">
  <!-- Featured (besar) -->
  <article class="product-card featured">
    <div class="product-thumb">
      <img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa">
    </div>
  </article>

  <!-- Item kecil -->
  <article class="product-card">
    <a href="{{ route('detail-shop') }}">
      <div class="product-thumb">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa">
      </div>
    </a>
    <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
    <div class="product-price">Rp175.000,-</div>
  </article>

  <article class="product-card">
    <a href="{{ route('detail-shop') }}">
      <div class="product-thumb">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa">
      </div>
    </a>
    <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
    <div class="product-price">Rp175.000,-</div>
  </article>

  <article class="product-card">
    <a href="{{ route('detail-shop') }}">
      <div class="product-thumb">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa">
      </div>
    </a>
    <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
    <div class="product-price">Rp175.000,-</div>
  </article>

  <article class="product-card">
    <a href="{{ route('detail-shop') }}">
      <div class="product-thumb">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa">
      </div>
    </a>
    <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
    <div class="product-price">Rp175.000,-</div>
  </article>

  <article class="product-card">
    <a href="{{ route('detail-shop') }}">
      <div class="product-thumb">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa">
      </div>
    </a>
    <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
    <div class="product-price">Rp175.000,-</div>
  </article>

  <article class="product-card">
    <a href="{{ route('detail-shop') }}">
      <div class="product-thumb">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa">
      </div>
    </a>
    <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
    <div class="product-price">Rp175.000,-</div>
  </article>

  <article class="product-card">
    <a href="{{ route('detail-shop') }}">
      <div class="product-thumb">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa">
      </div>
    </a>
    <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
    <div class="product-price">Rp175.000,-</div>
  </article>

  <article class="product-card">
    <a href="{{ route('detail-shop') }}">
      <div class="product-thumb">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa">
      </div>
    </a>
    <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
    <div class="product-price">Rp175.000,-</div>
  </article>

  <article class="product-card">
    <a href="{{ route('detail-shop') }}">
      <div class="product-thumb">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa">
      </div>
    </a>
    <h3 class="product-name">Kaos Perayaan Mati Rasa</h3>
    <div class="product-price">Rp175.000,-</div>
  </article>
</section>
