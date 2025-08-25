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
    margin-bottom: 40px;
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

    .kategori{
    font: 300 14px/1.25 Inter, Arial, sans-serif;
    margin-left: 100px;
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

    .carousel-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }

    .carousel-track {
      display: flex;
      gap: 24px;
      overflow-x: auto;
      scroll-behavior: smooth;
      scrollbar-width: none; /* Firefox */
    }
    .carousel-track::-webkit-scrollbar {
      display: none; /* Chrome/Safari */
    }

    .product-card {
      min-width: 220px;
      flex-shrink: 0;
      text-align: center;
    }
    .product-card img {
      width: 450px;
      height: 450px;         /* atur sesuai kebutuhan, misal 200–300px */
      object-fit: contain;     /* isi penuh kotak, crop kalau perlu */
      border-radius: 10px;
      display: block;
    }

    .product-card .title {
      margin-top: 10px;
      font-weight: 500;
    }
    .product-card .price {
      font-weight: bold;
      margin-top: 5px;
    }

    .carousel-btn {
      position: absolute;
      top: 40%;
      transform: translateY(-50%);
      background: rgba(255, 255, 255, 0.8);
      border: none;
      cursor: pointer;
      padding: 10px 15px;
      font-size: 24px;
      border-radius: 50%;
      transition: all 0.3s ease;
    }
    .carousel-btn:hover {
      background: black;
      color: white;
    }
    .prev-btn {
      left: -10px;
    }
    .next-btn {
      right: -10px;
    }

</style>
<section class="shop-detail">
  <div class="shop-detail__container">
    <!-- Media / Foto Produk -->
    <div class="shop-detail__media">
      <!-- ganti src sesuai asset Anda -->
      <img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa" />
    </div>

    <!-- Info Produk -->
    <div class="shop-detail__info">
      <h1 class="shop-detail__title">
        Kaos film<br/>Perayaan Mati Rasa
      </h1>

      <p class="shop-detail__note">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Faucibus interdum posuere lorem ipsum dolor sit amet. Venenatis urna cursus eget nunc scelerisque viverra mauris. At in tellus integer feugiat scelerisque. Eu sem integer vitae justo eget magna. Volutpat blandit aliquam etiam erat velit scelerisque in. Amet luctus venenatis lectus magna fringilla. Non tellus orci ac auctor augue mauris. Egestas fringilla phasellus faucibus scelerisque eleifend donec. Elit duis tristique sollicitudin nibh sit amet.
      </p>

      <div class="shop-detail__price">Rp 175.000,-</div>

      <a
        class="shop-detail__cta"
        href="{{ route('detail-shop') }}" 
        rel="noopener"
      >
        <span class="detail">VIEW PRODUCT</span>
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    </div>
  </div>
</section>

<span class="kategori">KATEGORI (PERAYAAN MATI RASA)</span>
<hr class="shop-detail__divider2"/>

<!-- ========= KATEGORI SHOP 1 ========= -->
<section class="related-products">
  <div class="carousel-wrapper">
    <!-- Tombol kiri -->
    <button class="carousel-btn prev-btn">&#10094;</button>

    <!-- Container produk -->
    <div class="carousel-track">
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasa</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasa</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasa</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasa</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasas</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasass</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasass</p>
        <p class="price">Rp175.000,-</p>
      </div>
    </div>

    <!-- Tombol kanan -->
    <button class="carousel-btn next-btn">&#10095;</button>
  </div>
</section>
<br><br><br>

<span class="kategori">KATEGORI (PERAYAAN MATI RASA)</span>
<hr class="shop-detail__divider2"/>

<!-- ========= KATEGORI SHOP 2 ========= -->
<section class="related-products">
  <div class="carousel-wrapper">
    <!-- Tombol kiri -->
    <button class="carousel-btn prev-btn">&#10094;</button>

    <!-- Container produk -->
    <div class="carousel-track">
      <div class="product-card">
        <img src="{{ asset('img/sepatu.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasa</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/sepatu2.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasa</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/sepatu3.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasa</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasa</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasas</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasass</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasass</p>
        <p class="price">Rp175.000,-</p>
      </div>
    </div>

    <!-- Tombol kanan -->
    <button class="carousel-btn next-btn">&#10095;</button>
  </div>
</section>
<br><br><br>

<span class="kategori">KATEGORI (PERAYAAN MATI RASA)</span>
<hr class="shop-detail__divider2"/>

<!-- ========= KATEGORI SHOP 3 ========= -->
<section class="related-products">
  <div class="carousel-wrapper">
    <!-- Tombol kiri -->
    <button class="carousel-btn prev-btn">&#10094;</button>

    <!-- Container produk -->
    <div class="carousel-track">
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasa</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasa</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasa</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasa</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasas</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasass</p>
        <p class="price">Rp175.000,-</p>
      </div>
      <div class="product-card">
        <img src="{{ asset('img/image-10.png') }}" alt="Kaos">
        <p class="title">Kaos Perayaan Mati Rasass</p>
        <p class="price">Rp175.000,-</p>
      </div>
    </div>

    <!-- Tombol kanan -->
    <button class="carousel-btn next-btn">&#10095;</button>
  </div>
</section>

<br><br><br>

<span class="kategori">SHOP BY CATEGORY</span>
<hr class="shop-detail__divider2"/>

<!-- ========= KATEGORI SHOP ALL ========= -->
<section class="shop-detail">
  <div class="shop-detail__container">
    <!-- Media / Foto Produk -->
    <div class="shop-detail__media">
      <!-- ganti src sesuai asset Anda -->
      <img src="{{ asset('img/image-10.png') }}" alt="Kaos Perayaan Mati Rasa" />
    </div>

    <!-- Info Produk -->
    <div class="shop-detail__info">
      <h1 class="shop-detail__title">
        APPAREL 
      </h1>

      <a
        class="shop-detail__cta"
        href="{{ route('detail-kategori') }}" 
        rel="noopener"
      >
        <span class="detail">VIEW PRODUCT</span>
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    </div>
  </div>
  <div class="shop-detail__container">
    <!-- Media / Foto Produk -->
    <div class="shop-detail__media">
      <!-- ganti src sesuai asset Anda -->
      <img src="{{ asset('img/sepatu3.png') }}" alt="Kaos Perayaan Mati Rasa" />
    </div>

    <!-- Info Produk -->
    <div class="shop-detail__info">
      <h1 class="shop-detail__title">
        SEPATU
      </h1>

      <a
        class="shop-detail__cta"
        href="{{ route('detail-kategori') }}" 
        rel="noopener"
      >
        <span class="detail">VIEW PRODUCT</span>
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    </div>
  </div>
</section>

<script>
  const track = document.querySelector(".carousel-track");
  const prevBtn = document.querySelector(".prev-btn");
  const nextBtn = document.querySelector(".next-btn");

  nextBtn.addEventListener("click", () => {
    track.scrollBy({ left: 250, behavior: "smooth" });
  });

  prevBtn.addEventListener("click", () => {
    track.scrollBy({ left: -250, behavior: "smooth" });
  });

</script>