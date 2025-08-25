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

    /* ====== Layout base ====== */
    .article-detail {
      padding: 48px 0 72px;
      background: #fff;
      color: #0d0d0d;
    }
    .article-detail .container {
      max-width: 1120px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* ====== Header ====== */
    .article-head {
      margin-bottom: 28px;
      margin-top: 100px;
    }
    .article-title {
      font-family: "Inter", sans-serif;
      line-height: .95;
      letter-spacing: 0.5px;
      font-size: clamp(28px, 3.6vw, 40px);
      margin: 0 0 12px;
    }
    .article-sublead {
      font-size: 15.5px;
      line-height: 1.7;
      color: #444;
      margin: 0 0 14px;
    }

    .article-meta {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
      font-size: 14px;
      color: #6b7280;
    }
    .meta-item { display: inline-flex; gap: 8px; align-items: center; }
    .meta-dot { opacity: .5; }
    .meta-actions { margin-left: auto; }
    .btn-icon {
      width: 34px; height: 34px;
      display: grid; place-items: center;
      border-radius: 8px;
      border: 1px solid rgba(0,0,0,.08);
      background: #fff;
      cursor: pointer;
      transition: transform .18s, box-shadow .18s;
    }
    .btn-icon:hover { transform: translateY(-1px); box-shadow: 0 6px 22px rgba(0,0,0,.08); }

    /* ====== Grid ====== */
    .article-grid {
      display: grid;
      grid-template-columns: 1.6fr .9fr;
      gap: clamp(22px, 4vw, 40px);
    }

    /* ====== Content ====== */
    .article-content { min-width: 0; }
    .article-figure {
      margin-top: 50px;
      margin-right: 180px;
      margin-left: 100px;
      border-radius: 14px;
      overflow: hidden;
      background: #f5f6f7;
    }
    .article-figure img {
      width: 100%;
      height: clamp(260px, 46vw, 420px);
      object-fit: cover;
      display: block;
    }
    .article-figure figcaption {
      padding: 8px 12px;
      font-size: 12px;
      color: #8b8b8b;
    }

    .article-content p {
      font-size: 16px;
      line-height: 1.85;
      color: #2b2b2b;
      margin: 0 0 16px;
    }
    .article-content a { color: #0d63ff; text-decoration: none; }
    .article-content a:hover { text-decoration: underline; }

    .article-content h3 {
      font-family: "Inter", sans-serif;
      line-height: .95;
      letter-spacing: 0.5px;
      margin: 26px 0 12px;
      font-size: 22px;
    }
    .article-content ol { padding-left: 20px; margin: 0 0 18px; }
    .article-content li { margin: 6px 0; }

    /* ====== Sidebar ====== */
    .article-sidebar {
      min-width: 0;
    }
    .related-title {
      font-family: "Inter", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      line-height: .95;
      letter-spacing: 0.5px;
      font-weight: 700;
      letter-spacing: .2px;
      font-size: 15px;
      color: #111;
      margin: 4px 0 12px;
    }
    .related-card {
      display: grid;
      grid-template-columns: 96px 1fr;
      gap: 12px;
      padding: 10px;
      border-radius: 12px;
      text-decoration: none;
      color: inherit;
      transition: background .18s, transform .18s, box-shadow .18s;
    }
    .related-card + .related-card { margin-top: 6px; }
    .related-card:hover {
      background: #fafafa;
      transform: translateY(-1px);
      box-shadow: 0 10px 26px rgba(0,0,0,.06);
    }
    .related-card img {
      width: 96px; height: 72px; object-fit: cover; border-radius: 10px; background: #eee;
    }
    .rel-body {
      font-family: "Inter", sans-serif;
      line-height: .95;
      letter-spacing: 0.5px;
      display: grid; 
      gap: 4px; 
      align-content: center;
    }
    .rel-title {
      font-size: 14px;
      line-height: 1.35;
      font-weight: 600;
    }
    .rel-meta {
      font-size: 12px;
      color: #6b7280;
    }

    /* ====== Responsive ====== */
    @media (max-width: 980px) {
      .article-grid { grid-template-columns: 1fr; }
      .meta-actions { margin-left: 0; }
      .article-figure img { height: clamp(220px, 58vw, 360px); }
    }

</style>
<!-- ========== ARTICLE DETAIL ========== -->
<section class="article-detail">
  <div class="container">

    <!-- Header -->
    <header class="article-head">
      <h1 class="article-title">
        Sinemaku Pictures Siap Rilis Tiga Film Baru di Tahun 2024
      </h1>

      <p class="article-sublead">
        Sinemaku Pictures sebagai rumah produksi yang berdiri hampir lima tahun, memang terus menunjukkan berbagai karyanya di industri film Tanah Air. Selain itu, Umay Shahab dan Prilly Latuconsina selaku pendiri Sinemaku Pictures, di awal tahun ini menghadirkan satu acara bertajuk, Sinemaku Day.
      </p>

      <div class="article-meta">
        <span class="meta-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4Zm0 2c-3.33 0-6 2.24-6 5v1h12v-1c0-2.76-2.67-5-6-5Z" fill="currentColor"/></svg>
          Nindi Widya Wati
        </span>
        <span class="meta-dot">•</span>
        <span class="meta-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M7 2h10a2 2 0 0 1 2 2v16l-7-3-7 3V4a2 2 0 0 1 2-2Z" fill="currentColor"/></svg>
          11 Jan 2024
        </span>
      </div>

      <figure class="article-figure">
          <img src="{{ asset('img/artikel3.jpg') }}" alt="Sinemaku Day" />
          <figcaption>Dok. Sinemaku Day 2024</figcaption>
        </figure>
    </header>

    <!-- Body + Sidebar -->
    <div class="article-grid">

      <!-- Content -->
      <article class="article-content">

        <p>Rumah produksi yang didirikan Umay Shahab dan Prilly Latuconsina, <a href="#">Sinemaku Pictures</a> mengumumkan tiga judul film terbaru. Film bergenre horor hingga komedi itu akan diproduksi dan tayang pada 2024.</p>

        <p>“Pada tahun 2024, Sinemaku Pictures punya genre baru yang akan kami eksplorasi. Sebelumnya kami berfokus pada drama tapi film-film Sinemaku Pictures tahun ini akan lebih kaya akan cerita dan genre,” kata Prilly Latuconsina dalam acara Sinemaku Day yang digelar pada Rabu, 10 Januari 2024.</p>

        <h3>3 Judul Film Terbaru Sinemaku Pictures di 2024</h3>
        <ol>
          <li><strong>Temurun</strong> (Horror) — Disutradarai Inarah Syarafina.</li>
          <li><strong>Bolehkah Sekali Saja Ku Menangis</strong> (Comedy Drama) — Disutradarai Reka Wijaya.</li>
          <li><strong>Mati Rasa</strong> (Drama) — Disutradarai Bryan Domani.</li>
        </ol>

        <p>Ketiga film tersebut akan diproduksi secara bertahap sepanjang tahun 2024 dan ditargetkan siap tayang di bioskop pada kuartal terakhir tahun ini.</p>
      </article>

      <!-- Sidebar -->
      <aside class="article-sidebar">
        <h4 class="related-title">Related Articles</h4>

        <a class="related-card" href="{{ route('detail-articles') }}">
          <img src="{{ asset('img/artikel4.jpg') }}" alt="" />
          <div class="rel-body">
            <div class="rel-title">Behind the Scenes: Creating Midnight’s Atmospheric Score</div>
            <div class="rel-meta">2 min read • 09 Jan 2024</div>
          </div>
        </a>

        <a class="related-card" href="{{ route('detail-articles') }}">
          <img src="{{ asset('img/artikel5.jpg') }}" alt="" />
          <div class="rel-body">
            <div class="rel-title">Casting Notes: Building Authentic Chemistry On Screen</div>
            <div class="rel-meta">4 min read • 05 Jan 2024</div>
          </div>
        </a>

        <a class="related-card" href="{{ route('detail-articles') }}">
          <img src="{{ asset('img/artikel1.jpg') }}" alt="" />
          <div class="rel-body">
            <div class="rel-title">Neon Dreams: From Script to Premiere Night</div>
            <div class="rel-meta">3 min read • 29 Dec 2023</div>
          </div>
        </a>
      </aside>
    </div>
  </div>
</section>


