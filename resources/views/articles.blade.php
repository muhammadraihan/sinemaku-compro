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

    /* ============ Base ============ */
    .articles-page{
      padding: clamp(16px, 4vw, 48px) clamp(16px, 5vw, 64px);
      color: #0A0A0A;
    }

    /* ============ Featured ============ */
    .article-featureds{
      font-family: 'Inter', Arial, sans-serif;
      line-height: .95;
      letter-spacing: 0.5px;
      margin-top: 80px;
      display: grid;
      grid-template-columns: 1.1fr 1fr;
      gap: clamp(16px, 4vw, 32px);
      align-items: start;
      margin-bottom: clamp(28px, 6vw, 56px);
    }
    .featured-media{
      position: relative;
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,.08);
    }
    .featured-media img{
      width: 100%;
      height: clamp(240px, 42vw, 420px);
      object-fit: cover;
      display: block;
      transform: scale(1);
      transition: transform .6s cubic-bezier(.2,.8,.2,1);
    }
    .featured-media:hover img{ transform: scale(1.04); }

    .featured-body{
      margin-top: 60px;
      padding-top: clamp(4px, 1vw, 12px);
    }
    .featured-title{
      font-family: "Inter", sans-serif;
      line-height: .95;
      letter-spacing: 0.5px;
      font-weight: 700;
      font-size: clamp(22px, 2.2vw, 32px);
      margin: 0 0 clamp(8px, 2vw, 14px);
    }
    .featured-excerpt{
      color: #4a4a4a;
      font-size: clamp(14px, 1.1vw, 16px);
      line-height: 1.7;
      margin: 0 0 14px;
    }
    .featured-meta{
      display: flex;
      flex-wrap: wrap;
      gap: 10px 14px;
      margin-bottom: 18px;
    }
    .meta-chip{
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: #f3f5f7;
      color: #374151;
      border-radius: 999px;
      padding: 6px 10px;
      font-size: 13px;
    }

    .btn-outline{
      font-family: "Inter", sans-serif;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 16px;
      border: 1.5px solid #11111126;
      border-radius: 2px;
      color: #111;
      font-weight: 400;
      text-decoration: none;
      transition: transform .2s, background .25s, color .25s, box-shadow .25s;
    }
    .btn-outline:hover{
      background: #111;
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 10px 24px rgba(0,0,0,.08);
    }

    /* ============ All Stories ============ */
    .articles-list .section-heading{
      font-family: "Inter", sans-serif;
      font-weight: 700;
      font-size: clamp(22px, 2vw, 30px);
      margin: clamp(8px, 2vw, 18px) 0 clamp(14px, 3vw, 22px);
    }
    .stories-grid{
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: clamp(14px, 2vw, 24px);
    }

    .article-card{
      display: grid;
      grid-template-rows: auto 1fr;
      border-radius: 14px;
      overflow: hidden;
      background: #fff;
      box-shadow: 0 6px 24px rgba(0,0,0,.06);
      transition: transform .18s ease, box-shadow .2s ease;
    }
    .article-card:hover{
      transform: translateY(-4px);
      box-shadow: 0 14px 44px rgba(0,0,0,.10);
    }
    .article-card .thumb{
      display: block;
      aspect-ratio: 16/9;
      overflow: hidden;
    }
    .article-card .thumb img{
      width: 100%;
      height: 100%;
      object-fit: cover;
      transform: scale(1);
      transition: transform .6s cubic-bezier(.2,.8,.2,1);
    }
    .article-card:hover .thumb img{ transform: scale(1.06); }

    .card-body{
      padding: 16px 16px 14px 16px;
    }
    .card-title{
      font-family: "Inter", sans-serif;
      line-height: .95;
      letter-spacing: 0.5px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      font-weight: 700;
      color: #111;
      text-decoration: none;
      font-size: 17px;
    }
    .card-title:hover{ text-decoration: underline; }

    .card-excerpt{
      font-family: "Inter", sans-serif;
      margin: 8px 0 12px;
      color: #4b5563;
      font-size: 14px;
      line-height: 1.6;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    .card-meta{
      font-family: "Inter", sans-serif;
      line-height: .95;
      letter-spacing: 0.5px;
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
    }

    /* ============ Responsive ============ */
    @media (max-width: 1024px){
      .article-featured{ grid-template-columns: 1fr; }
      .featured-media img{ height: clamp(220px, 48vw, 420px); }
      .stories-grid{ grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 640px){
      .stories-grid{ grid-template-columns: 1fr; }
    }

</style>
<!-- =================== ARTICLES PAGE =================== -->
<section class="articles-page">

  <!-- ============ Featured / Hero ============ -->
  <div class="article-featureds">
    <div class="featured-media">
      <img src="{{ asset('img/artikel.jpeg') }}" alt="Featured article">
    </div>

    <div class="featured-body">
      <h1 class="featured-title">
        Sinemaku Pictures Siap Rilis Tiga Film Baru di Tahun 2024
      </h1>

      <p class="featured-excerpt">
        Sinemaku Pictures sebagai rumah produksi yang berdiri hampir lima tahun,
        terus menunjukkan berbagai karyanya di industri film Tanah Air. Selain
        itu, Umay Shahab dan Prilly Latuconsina selaku pendiri Sinemaku Pictures,
        di awal tahun ini menghadirkan satu acara bertajuk, Sinemaku Day.
      </p>

      <div class="featured-meta">
        <span class="meta-chip">
          <!-- user icon -->
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-3.866 0-7 3.134-7 7h2c0-2.761 2.239-5 5-5s5 2.239 5 5h2c0-3.866-3.134-7-7-7z"/></svg>
          Nindi Widya Wati
        </span>
        <span class="meta-chip">
          <!-- calendar icon -->
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2v2H5a2 2 0 0 0-2 2v2h18V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7zm14 8H3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10z"/></svg>
          11 Jan 2024
        </span>
      </div>

      <a href="{{ route('detail-articles') }}" class="btn-outline">
        READ FULL STORY
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path d="M5 12h14M13 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    </div>
  </div>

  <!-- ============ All Stories ============ -->
  <div class="articles-list">
    <h2 class="section-heading">All Stories</h2>

    <div class="stories-grid">
      <!-- CARD -->
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
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-3.866 0-7 3.134-7 7h2c0-2.761 2.239-5 5-5s5 2.239 5 5h2c0-3.866-3.134-7-7-7z"/></svg>
              Nindi Widya Wati
            </span>
            <span class="meta-chip">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2v2H5a2 2 0 0 0-2 2v2h18V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7zm14 8H3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10z"/></svg>
              11 Jan 2024
            </span>
          </div>
        </div>
      </article>

      <!-- CARD -->
      <article class="article-card">
        <a href="{{ route('detail-articles') }}" class="thumb">
          <img src="{{ asset('img/artikel4.jpg') }}" alt="Artikel 2">
        </a>
        <div class="card-body">
          <a href="{{ route('detail-articles') }}" class="card-title">
            Behind the Scenes: Creative Affair & Sinemaku Day
          </a>
          <p class="card-excerpt">
            Intip momen di balik layar, sesi diskusi, serta penampilan spesial
            yang membuka mata soal proses kreatif dan kolaborasi.
          </p>
          <div class="card-meta">
            <span class="meta-chip">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-3.866 0-7 3.134-7 7h2c0-2.761 2.239-5 5-5s5 2.239 5 5h2c0-3.866-3.134-7-7-7z"/></svg>
              Nindi Widya Wati
            </span>
            <span class="meta-chip">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2v2H5a2 2 0 0 0-2 2v2h18V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7zm14 8H3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10z"/></svg>
              11 Jan 2024
            </span>
          </div>
        </div>
      </article>

      <!-- CARD -->
      <article class="article-card">
        <a href="{{ route('detail-articles') }}" class="thumb">
          <img src="{{ asset('img/artikel5.jpg') }}" alt="Artikel 3">
        </a>
        <div class="card-body">
          <a href="{{ route('detail-articles') }}" class="card-title">
            Premiere Recap: Antusiasme Penonton & Momen Ikonik
          </a>
          <p class="card-excerpt">
            Sorotan dari malam pemutaran perdana – reaksi penonton, sesi Q&amp;A,
            dan momen yang bikin merinding.
          </p>
          <div class="card-meta">
            <span class="meta-chip">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-3.866 0-7 3.134-7 7h2c0-2.761 2.239-5 5-5s5 2.239 5 5h2c0-3.866-3.134-7-7-7z"/></svg>
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
