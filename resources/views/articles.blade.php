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

  /* ============ Base ============ */
  .articles-page{
    padding: clamp(16px, 4vw, 48px) clamp(16px, 5vw, 64px);
    color:#0A0A0A;
  }

  /* ======================================
     FEATURED / HERO — landscape ala Relay
     ====================================== */
  :root{
    --hero-h: 524px;      /* tinggi hero yang diminta */
  }

  .article-featureds{
    display:grid;
    grid-template-columns: 1.1fr 1fr;    /* teks kiri, gambar kanan */
    gap: clamp(18px, 3.5vw, 40px);
    align-items: stretch;
    margin-top: clamp(32px, 6vw, 72px);
    margin-bottom: clamp(28px, 6vw, 56px);

    /* default (tablet/mobile) biarkan fleksibel */
    min-height: clamp(320px, 42vw, 520px);
  }

  /* Lock ke 1666 × 524 di desktop besar */
  @media (min-width: 1200px){
    .article-featureds{
      max-width: 1666px;   /* lebar target */
      height: var(--hero-h);
      min-height: var(--hero-h);
      max-height: var(--hero-h);
      margin-left: auto;
      margin-right: auto;
    }
    .featured-media,
    .featured-body{ height: 100%; }
    .featured-media img{ height: 100%; min-height: 100%; object-fit: cover; }
  }

  /* urutkan: teks kiri, gambar kanan (tanpa ubah HTML) */
  .featured-body{ order:1; }
  .featured-media{ order:2; }

  /* Panel teks kiri (squircle) */
  .featured-body{
    background:#f8f9fa;
    border-radius: 18px 0 clamp(80px, 10vw, 140px) 18px;
    padding: clamp(20px, 3.6vw, 48px);
    display:flex; flex-direction:column; justify-content:center;
    box-shadow: 0 8px 26px rgba(16,24,40,.06);
  }
  .eyebrow{
    font: 600 12px/1 'Inter',system-ui,Arial; letter-spacing:.18em;
    color:#4B5563; text-transform:uppercase; margin-bottom:10px;
  }
  .featured-title{
    font-family:"Inter",sans-serif; font-weight:800; line-height:.95;
    letter-spacing:-.01em; margin:0 0 clamp(10px,1.8vw,14px);
    font-size: clamp(28px, 3.4vw, 44px); color:#0A0A0A;
  }
  .featured-excerpt{
    color:#4a4a4a; font-size: clamp(14px, 1.1vw, 16px);
    line-height:1.1; margin: 0 0 16px; max-width: 54ch;
  }
  .featured-meta{ display:flex; gap:12px 14px; flex-wrap:wrap; margin-bottom:14px; }
  .meta-chip{
    display:inline-flex; align-items:center; gap:8px;
    background:#F3F5F7; color:#374151; border-radius:999px;
    padding:6px 10px; font-size:13px;
  }

  /* ====== Tombol Read More (diperkecil) ====== */
  .btn-primary{
    display:inline-flex; align-items:center; gap:8px;
    padding:8px 12px;                 /* lebih kecil */
    font-size:14px; font-weight:100;
    border-radius:12px;
    background:#2563EB; color:#fff; text-decoration:none;
    box-shadow:0 8px 18px rgba(37,99,235,.18);
    width:auto; max-width: 240px;     /* cegah memanjang */
    inline-size: fit-content;          /* pastikan sekecil kontennya */
    transition:transform .2s, box-shadow .25s, background .25s;
  }
  .btn-primary svg{ width:16px; height:16px; }
  .btn-primary:hover{ transform:translateY(-2px); background:#1D4ED8; }

  /* Media kanan (crop rounded) */
  .featured-media{
    position:relative; border-radius:18px; overflow:hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
  }
  .featured-media img{
    width:100%; height:100%; object-fit:cover; display:block;
    transform:scale(1); transition:transform .6s cubic-bezier(.2,.8,.2,1);
  }
  .featured-media:hover img{ transform:scale(1.04); }

  /* ======= list card (biarkan seperti sebelumnya) ======= */
  .articles-list .section-heading{
    font-family:"Inter",sans-serif; font-weight:800;
    font-size: clamp(22px, 2vw, 30px);
    margin: clamp(8px, 2vw, 18px) 0 clamp(14px, 3vw, 22px);
  }
  .stories-grid{
    display:grid; grid-template-columns: repeat(3, 1fr);
    gap: clamp(14px, 2vw, 24px);
  }
  .article-card{
    display:grid; grid-template-rows:auto 1fr;
    border-radius:14px; overflow:hidden; background:#fff;
    box-shadow:0 6px 24px rgba(0,0,0,.06);
    transition:transform .18s, box-shadow .2s;
  }
  .article-card:hover{ transform:translateY(-4px); box-shadow:0 14px 44px rgba(0,0,0,.10); }
  .article-card .thumb{ aspect-ratio:16/9; overflow:hidden; display:block; }
  .article-card .thumb img{
    width:100%; height:100%; object-fit:cover;
    transform:scale(1); transition:transform .6s cubic-bezier(.2,.8,.2,1);
  }
  .article-card:hover .thumb img{ transform:scale(1.06); }
  .card-body{ padding:16px; }
  .card-title{
    font-family:"Inter",sans-serif; font-weight:800; color:#111; text-decoration:none;
    font-size:17px; line-height:1.1; letter-spacing:.2px;
    display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
  }
  .card-title:hover{ text-decoration:underline; }
  .card-excerpt{
    margin:8px 0 12px; color:#4b5563; font-size:14px; line-height:1.6;
    display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;
  }
  .card-meta{ display:flex; gap:12px; flex-wrap:wrap; }

  /* ============ Responsive stack ============ */
  @media (max-width: 1024px){
    .article-featureds{ grid-template-columns: 1fr; height:auto; min-height:auto; max-height:none; }
    .featured-body{ order:1; border-radius:18px; }
    .featured-media{ order:2; }
  }
  @media (max-width: 640px){
    .stories-grid{ grid-template-columns: 1fr; }
  }
</style>


<section class="articles-page">

  <!-- ===== Featured / Hero (landscape) ===== -->
  <div class="article-featureds">
    <!-- TEKS KIRI -->
    <div class="featured-body">
      <div class="eyebrow">Featured</div>
      <h1 class="featured-title">Sinemaku Pictures Siap Rilis Tiga Film Baru di Tahun 2024</h1>

      <p class="featured-excerpt">
        Sinemaku Pictures sebagai rumah produksi yang berdiri hampir lima tahun, terus menunjukkan
        berbagai karyanya di industri film Tanah Air. Selain itu, Umay Shahab dan Prilly
        Latuconsina selaku pendiri Sinemaku Pictures, di awal tahun ini menghadirkan satu acara bertajuk,
        Sinemaku Day.
      </p>

      <div class="featured-meta">
        <span class="meta-chip">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm0 2c-3.87 0-7 3.13-7 7h2c0-2.76 2.24-5 5-5s5 2.24 5 5h2c0-3.87-3.13-7-7-7z"/></svg>
          Nindi Widya Wati
        </span>
        <span class="meta-chip">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2v2H5a2 2 0 0 0-2 2v2h18V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7zm14 8H3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10z"/></svg>
          11 Jan 2024
        </span>
      </div>

      <a href="{{ route('detail-articles') }}" class="btn-primary">
        Read More
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path d="M5 12h14M13 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    </div>

    <!-- GAMBAR KANAN -->
    <div class="featured-media">
      <img src="{{ asset('img/artikel.jpeg') }}" alt="Featured article">
    </div>
  </div>

  <!-- ===== All Stories (cards) — tak diubah besar-besarnya ===== -->
  <div class="articles-list">
    <h2 class="section-heading">All Stories</h2>

    <div class="stories-grid">
      <!-- CARD 1 -->
      <article class="article-card">
        <a href="{{ route('detail-articles') }}" class="thumb">
          <img src="{{ asset('img/artikel3.jpg') }}" alt="Artikel 1">
        </a>
        <div class="card-body">
          <a href="{{ route('detail-articles') }}" class="card-title">
            Sinemaku Pictures Siap Rilis Tiga Film Baru di Tahun 2024
          </a>
          <p class="card-excerpt">
            Dalam acara yang digelar berbarengan dengan Festival Perayaan Mati Rasa,
            Sinemaku mengumumkan deretan film yang siap mereka rilis pada 2025 ini.
          </p>
          <div class="card-meta">
            <span class="meta-chip">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm0 2c-3.87 0-7 3.13-7 7h2c0-2.76 2.24-5 5-5s5 2.24 5 5h2c0-3.87-3.13-7-7-7z"/></svg>
              Nindi Widya Wati
            </span>
            <span class="meta-chip">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2v2H5a2 2 0 0 0-2 2v2h18V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7zm14 8H3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10z"/></svg>
              11 Jan 2024
            </span>
          </div>
        </div>
      </article>

      <!-- CARD 2 -->
      <article class="article-card">
        <a href="{{ route('detail-articles') }}" class="thumb">
          <img src="{{ asset('img/artikel4.jpg') }}" alt="Artikel 2">
        </a>
        <div class="card-body">
          <a href="{{ route('detail-articles') }}" class="card-title">
            Behind the Scenes: Creative Affair & Sinemaku Day
          </a>
          <p class="card-excerpt">
            Intip momen di balik layar, sesi diskusi, serta penampilan spesial yang
            membuka mata soal proses kreatif dan kolaborasi.
          </p>
          <div class="card-meta">
            <span class="meta-chip">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm0 2c-3.87 0-7 3.13-7 7h2c0-2.76 2.24-5 5-5s5 2.24 5 5h2c0-3.87-3.13-7-7-7z"/></svg>
              Nindi Widya Wati
            </span>
            <span class="meta-chip">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2v2H5a2 2 0 0 0-2 2v2h18V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7zm14 8H3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10z"/></svg>
              11 Jan 2024
            </span>
          </div>
        </div>
      </article>

      <!-- CARD 3 -->
      <article class="article-card">
        <a href="{{ route('detail-articles') }}" class="thumb">
          <img src="{{ asset('img/artikel5.jpg') }}" alt="Artikel 3">
        </a>
        <div class="card-body">
          <a href="{{ route('detail-articles') }}" class="card-title">
            Premiere Recap: Antusiasme Penonton & Momen Ikonik
          </a>
          <p class="card-excerpt">
            Sorotan dari malam pemutaran perdana – reaksi penonton, sesi Q&amp;A, dan momen yang bikin merinding.
          </p>
          <div class="card-meta">
            <span class="meta-chip">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm0 2c-3.87 0-7 3.13-7 7h2c0-2.76 2.24-5 5-5s5 2.24 5 5h2c0-3.87-3.13-7-7-7z"/></svg>
              Nindi Widya Wati
            </span>
            <span class="meta-chip">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2v2H5a2 2 0 0 0-2 2v2h18V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7zm14 8H3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10z"/></svg>
              11 Jan 2024
            </span>
          </div>
        </div>
      </article>
    </div>
  </div>

</section>
