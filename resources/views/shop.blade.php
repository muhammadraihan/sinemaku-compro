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
    font-weight: 500;
    line-height: .95;
    letter-spacing: -0.5px;
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
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.156);
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
      padding: clamp(28px, 6vw, 72px) clamp(16px, 5vw, 64px);
      background:#fff; color:#111;
    }
    .shop-about__grid{
      display:grid; grid-template-columns: 1.45fr .82fr; gap: clamp(24px,4vw,48px);
    }
    @media (max-width: 980px){
      .shop-about__grid{ grid-template-columns: 1fr; }
    }

    .h2{
        font-family:"Inter",sans-serif; 
        font-size: clamp(28px,4.6vw,56px); 
        font-weight: 500;
        line-height: .95;
        letter-spacing: -0.5px;
        margin-left: 150px;
        margin-top: -10px;
    }
    .h3{ font-family:"Inter",system-ui,Arial,sans-serif; font-size: clamp(18px,2.2vw,22px); margin: 0 0 .8em; font-weight: 700 }
    .lead{ 
    font-family:"Inter",sans-serif; 
    font-weight: 100px;
    font-size: clamp(15px,2.1vw,18px); 
    line-height: .95;
    letter-spacing: 0.5px;
    color:#525050; 
    margin-bottom: 26px ;
    margin-left: 150px;
    
    /* line-height: .95; */
    }
    
    .shop-about__two{
      display:grid; grid-template-columns: 1fr 1fr; gap: clamp(16px,2.8vw,22px); margin: 22px 0;
    }
    @media (max-width: 720px){ .shop-about__two{ grid-template-columns: 1fr; } }

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
    font-size: clamp(22px, 3vw, 40px);
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
    }

    /* Card */
    .rp-card {
    text-decoration: none;
    color: inherit;
    display: grid;
    gap: 14px;
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
    line-height: .95;
    letter-spacing: 0.5px;
    text-align: center;
    }
    .rp-card__name {
    font-size: clamp(14px, 1.4vw, 18px);
    color: #222;
    margin-bottom: 6px;
    }
    .rp-card__price {
    font-weight: 800;
    font-size: clamp(14px, 1.4vw, 18px);
    }

    /* Responsive */
    @media (max-width: 1100px) {
    .rp__grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 780px) {
    .rp__grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 480px) {
    .rp__grid { grid-template-columns: 1fr; }
    }


</style>
<section class="shop-detail">
  <div class="shop-detail__container">
    <!-- Media / Foto Produk -->
    <div class="shop-detail__media">
      <!-- ganti src sesuai asset Anda -->
      <img src="{{ asset('img/baju-pmr.jpg') }}" alt="Kaos Perayaan Mati Rasa" />
    </div>

    <!-- Info Produk -->
    <div class="shop-detail__info">
      <h1 class="shop-detail__title">
        Kaos film<br/>Perayaan Mati Rasa
      </h1>

      <div class="shop-detail__price">Rp175.000,-</div>

      <a
        class="shop-detail__cta"
        href="https://tokopedia.com/" 
        target="_blank" 
        rel="noopener"
      >
        <span class="detail">BUY NOW ON TOKOPEDIA</span>
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>

      <p class="shop-detail__note">
        Purchases are handled via our official store on external platforms.
      </p>

      <hr class="shop-detail__divider"/>

      <ul class="shop-detail__bullets">
        <li>
          <span class="ico">
            <svg viewBox="0 0 24 24">
              <path d="M3 7h18v10H3zM3 7l9 6 9-6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span class="detail">Free shipping on orders over $25</span>
        </li>
        <li>
          <span class="ico">
            <svg viewBox="0 0 24 24">
              <path d="M12 22s8-4.5 8-12a8 8 0 10-16 0c0 7.5 8 12 8 12z" fill="none" stroke="currentColor" stroke-width="1.8"/>
              <circle cx="12" cy="10" r="2" fill="currentColor"/>
            </svg>
          </span>
          <span class="detail">Secure payment & buyer protection</span>
        </li>
        <li>
          <span class="ico">
            <svg viewBox="0 0 24 24">
              <path d="M4 7h16v10H4zM8 7V5h8v2" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M9 12h6M9 15h6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
          </span>
          <spam class="detail">30-day return policy</spam>
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
      <h2 class="h2">About the Film</h2>

      <p class="lead">
        Midnight explores the fragile boundary between consciousness and dreams through the eyes
        of Detective Sarah Chen, who finds herself trapped in a case that defies logic. As she
        delves deeper into the investigation, the city around her begins to shift and change,
        reflecting her own psychological state. The film combines practical effects with
        innovative cinematography to create a truly immersive experience that challenges audiences
        to question what they see.
      </p>
    </div>
  </div>
</section>

<section class="related-products">
  <div class="rp__header">
    <h2 class="rp__title">You Might Also Like</h2>

    <a href="/shop" class="rp__viewall">
      <span class="detail">View All</span>
      <svg viewBox="0 0 24 24" aria-hidden="true">
        <path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </a>
  </div>

  <div class="rp__grid">
    <!-- Item 1 -->
    <a href="/shop/tee-mati-rasa" class="rp-card">
    <img src="{{ asset('img/baju-pmr.jpg') }}" class="rp-card__media">
      <div class="rp-card__meta">
        <div class="rp-card__name">Kaos Perayaan Mati Rasa</div>
        <div class="rp-card__price">Rp175.000,-</div>
      </div>
    </a>

    <!-- Item 2 -->
    <a href="/shop/tee-mati-rasa" class="rp-card">
        <img src="{{ asset('img/temp-imagehc-vht-6-10.png') }}" class="rp-card__media">
      <div class="rp-card__meta">
        <div class="rp-card__name">Kaos Perayaan Mati Rasa</div>
        <div class="rp-card__price">Rp175.000,-</div>
      </div>
    </a>

    <!-- Item 3 -->
    <a href="/shop/tee-mati-rasa" class="rp-card">
        <img src="{{ asset('img/poster_kbds.jpg') }}" class="rp-card__media">
      <div class="rp-card__meta">
        <div class="rp-card__name">Kaos Perayaan Mati Rasa</div>
        <div class="rp-card__price">Rp175.000,-</div>
      </div>
    </a>

    <!-- Item 4 -->
    <a href="/shop/tee-mati-rasa" class="rp-card">
        <img src="{{ asset('img/baju-pmr.jpg') }}" class="rp-card__media">
      <div class="rp-card__meta">
        <div class="rp-card__name">Kaos Perayaan Mati Rasa</div>
        <div class="rp-card__price">Rp175.000,-</div>
      </div>
    </a>
  </div>
</section>
