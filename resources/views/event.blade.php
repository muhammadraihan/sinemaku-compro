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

  :root{
    --ink:#0A0A0A;
    --muted:#6b7280;
    --chip:#f3f4f6;
    --surface:#ffffff;
    --line:#ececec;
    --radius:16px;
    --shadow:0 12px 30px rgba(16,24,40,.08);

    /* baru: kontrol lebar & kolom tombol */
    --contentMax: 1200px;
    --ctaW: 220px; /* lebar kolom tombol kanan */
  }

  /* ============ Base ============ */
  .event-page{
    padding: clamp(16px, 4vw, 48px) clamp(16px, 5vw, 64px);
    color: var(--ink);
    background:
      radial-gradient(1200px 400px at 10% -10%, #f8fafc 0%, transparent 60%),
      radial-gradient(1200px 400px at 90% -10%, #f8fafc 0%, transparent 60%);
  }

  /* ============ HERO ala Lumospace ============ */
  .article-featureds{
    display:grid;
    grid-template-columns: 1.1fr 1fr;
    gap: clamp(18px,3.6vw,40px);
    align-items:center;
    margin: clamp(28px,6vw,56px) 0;
    isolation:isolate;
  }
  .featured-body{
    background:#f6f8fb;
    border:1px solid var(--line);
    border-radius: calc(var(--radius) + 6px);
    padding: clamp(20px,3.4vw,44px);
    box-shadow: var(--shadow);
  }
  .featured-body::before{
    content:"Events";
    display:inline-block;
    margin-bottom:12px;
    padding:8px 12px;
    background:var(--chip);
    color:#111;
    border-radius:999px;
    font:600 12px/1 'Inter',system-ui,Arial;
    letter-spacing:.02em;
  }
  .featured-title{
    margin:0 0 10px;
    font:800 clamp(28px,4vw,44px)/1.02 'Inter',system-ui,Arial;
    letter-spacing:-.01em;
  }
  .featured-excerpt{
    color:#475569;
    font-size: clamp(14px,1.1vw,16px);
    line-height:1.7;
    margin:0 0 16px;
    max-width:60ch;
  }
  .featured-meta{
    display:flex; flex-wrap:wrap; gap:10px 12px;
    margin: 10px 0 6px;
  }
  .meta-chip{
    display:inline-flex; align-items:center; gap:8px;
    padding:8px 12px; border-radius:999px; background:var(--chip);
    color:#111; font:600 12px/1 'Inter',system-ui,Arial;
  }

  .btn-outline{
    margin-top:14px;
    display:inline-flex; align-items:center; gap:10px;
    padding:12px 16px; border-radius:999px;
    background:#111; color:#fff; text-decoration:none; font:700 13px/1 'Inter',Arial;
    box-shadow:0 10px 24px rgba(0,0,0,.16);
    transition:transform .18s, box-shadow .18s, background .2s, color .2s;
  }
  .btn-outline:hover{ transform:translateY(-2px); background:#000; }

  .featured-media{
    position:relative; border-radius: calc(var(--radius) + 6px);
    overflow:hidden; background:var(--surface);
    border:1px solid var(--line); box-shadow:var(--shadow);
  }
  .featured-media img{
    width:100%; height: clamp(240px, 42vw, 420px); object-fit:cover; display:block;
    transform:scale(1); transition:transform .6s cubic-bezier(.2,.8,.2,1);
  }
  .featured-media:hover img{ transform:scale(1.04); }

  /* ============ LIST / CARDS ala Lumospace ============ */

  /* pusatkan konten All Event */
  .event-list,
  .event-list .section-heading{
    max-width: var(--contentMax);
    margin-inline: auto;
  }

  .event-list .section-heading{
    font:800 clamp(22px,2vw,30px)/1.05 'Inter',sans-serif;
    margin: clamp(8px, 2vw, 18px) 0 clamp(14px, 2.4vw, 20px);
  }

  .stories-grid{
    display:grid;
    grid-template-columns: 1fr;
    gap: clamp(14px, 1.8vw, 18px);
  }

  .article-card{
    display:grid;
    grid-template-columns: minmax(420px, 30px) 1fr; /* kiri gambar, kanan konten */
    align-items:stretch;
    border:1px solid var(--line);
    background:var(--surface);
    border-radius: calc(var(--radius) + 2px);
    overflow:hidden;
    box-shadow:0 8px 24px rgba(2,8,23,.06);
    position:relative;
    min-height: 200px;
    transition:transform .18s ease, box-shadow .2s ease;
  }
  .article-card:hover{ transform:translateY(-3px); box-shadow:0 18px 44px rgba(2,8,23,.10); }

  .article-card .thumb{
    display:block; overflow:hidden; border-right:1px solid var(--line);
  }
  .article-card .thumb img{
    width:100%; height: clamp(100px,45vw,200px); object-fit:cover; /* tinggi konsisten */
    transform:scale(1); transition:transform .6s cubic-bezier(.2,.8,.2,1);
  }
  .article-card:hover .thumb img{ transform:scale(1.05); }

  .card-body{
    position:relative;
    padding: clamp(14px,1.6vw,18px) clamp(16px,2vw,24px);
    /* sisakan ruang untuk kolom tombol di kanan */
    padding-right: calc(var(--ctaW) + 28px);
    padding-top: 35px;
    display:grid; align-content:start; gap:8px;
  }
  .card-title{
    font:550 18px/1.15 'Inter',sans-serif;
    color:#111; text-decoration:none; letter-spacing:.2px;
  }
  .card-title:hover{ text-decoration:underline; }

  .card-excerpt{
    margin: 4px 0 10px; color:#4b5563; font:400 14px/1.55 'Inter',sans-serif;
    display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
    max-width: 70ch;
  }
  .card-meta{ display:flex; flex-wrap:wrap; gap:10px; }
  .card-meta .meta-chip{
    background:var(--chip); color:#111; border-radius:999px; padding:7px 10px;
    font:600 12px/1 'Inter',sans-serif;
  }

  /* ====== KOLOM TOMBOL di tengah-kanan ====== */
  .card-actions{
    position:absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    width: var(--ctaW);                  /* area tombol */
    display:flex; flex-direction:column; gap:12px;
    align-items:flex-end;
  }
  .card-actions a{
    display:inline-flex; align-items:center; justify-content:center;
    padding:12px 16px; border-radius:999px;
    font:700 12.5px/1 'Inter',sans-serif; text-decoration:none;
    transition:transform .18s ease, box-shadow .2s ease, background .2s ease, color .2s ease, border-color .2s ease;
    white-space:nowrap;
  }
  .btn-see{
    background:#fff; color:#111; border:1px solid var(--line);
    box-shadow:0 4px 12px rgba(2,8,23,.06);
  }
  .btn-see:hover{ transform:translateY(-2px); box-shadow:0 12px 20px rgba(16,24,40,.10); }
  .btn-buy{
    background:#111; color:#fff; border:1px solid #111;
    box-shadow:0 10px 24px rgba(0,0,0,.16);
  }
  .btn-buy:hover{ transform:translateY(-2px); }

  /* ============ Responsive ============ */
  @media (max-width: 1024px){
    .article-featureds{ grid-template-columns: 1fr; }
    .featured-body{ order:1; }
    .featured-media{ order:2; }
    .featured-media img{ height: clamp(220px, 48vw, 420px); }
  }
  @media (max-width: 760px){
    .article-card{ grid-template-columns: 1fr; }
    .article-card .thumb{ border-right:0; aspect-ratio:16/9; }
    .card-body{ padding-right: 16px; }
    .card-actions{
      position:static; transform:none; width:auto;
      align-items:flex-start; flex-direction:row; gap:10px; margin-top:8px;
    }
  }
</style>


<section class="event-page">

  <!-- ============ Featured / Hero ============ -->
  <div class="article-featureds">
    <div class="featured-media">
      <img src="{{ asset('img/artikel.jpeg') }}" alt="Featured article">
    </div>

    <div class="featured-body">
      <h1 class="featured-title">Sinemaku Pictures Siap Rilis Tiga Film Baru di Tahun 2024</h1>
      <p class="featured-excerpt">
        Sinemaku Pictures sebagai rumah produksi yang berdiri hampir lima tahun,
        terus menunjukkan berbagai karyanya di industri film Tanah Air. Selain itu,
        Umay Shahab dan Prilly Latuconsina selaku pendiri Sinemaku Pictures,
        di awal tahun ini menghadirkan satu acara bertajuk, Sinemaku Day.
      </p>

      <div class="featured-meta">
        <span class="meta-chip">
          <!-- Calendar -->
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-label="Calendar" xmlns="http://www.w3.org/2000/svg">
            <rect x="3" y="4" width="18" height="17" rx="3" stroke="currentColor" stroke-width="2" />
            <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <line x1="3" y1="9" x2="21" y2="9" stroke="currentColor" stroke-width="2" />
          </svg> 11 Jan 2024
        </span>
        <span class="meta-chip">
          <!-- Clock -->
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-label="Clock" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
            <line x1="12" y1="12" x2="12" y2="7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <line x1="12" y1="12" x2="16" y2="14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg> 19.00 WIB
        </span>
        <span class="meta-chip">
          <!-- Location -->
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-label="Location" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="2"/>
          </svg> Grand Cinema Jakarta
        </span>
      </div>

      <a href="{{ route('detail-event') }}" class="btn-outline">
        SEE EVENT DETAIL
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
    </div>
  </div>

  <!-- ============ All Event ============ -->
  <div class="event-list">
    <h2 class="section-heading">All Event</h2>

    <div class="stories-grid">
      <!-- CARD 1 -->
      <article class="article-card">
        <a href="{{ route('detail-event') }}" class="thumb">
          <img src="{{ asset('img/artikel3.jpg') }}" alt="Artikel 1">
        </a>
        <div class="card-body">
          <a href="{{ route('detail-event') }}" class="card-title">
            Sinemaku Pictures Siap Rilis Tiga Film Baru di Tahun 2024
          </a>
          <p class="card-excerpt">
            Dalam acara yang digelar berbarengan dengan Festival Perayaan Mati Rasa,
            Sinemaku mengumumkan deretan film yang siap mereka rilis pada 2025 ini.
          </p>
          <div class="card-meta">
            <span class="meta-chip">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="17" rx="3" stroke="currentColor" stroke-width="2" /><line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="3" y1="9" x2="21" y2="9" stroke="currentColor" stroke-width="2" /></svg>
              11 Jan 2024
            </span>
            <span class="meta-chip">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><line x1="12" y1="12" x2="12" y2="7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="12" y1="12" x2="16" y2="14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
              19.00 WIB
            </span>
            <span class="meta-chip">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="2"/></svg>
              Grand Cinema Jakarta
            </span>
          </div>

          <!-- tombol nyata -->
          <div class="card-actions">
            <a href="{{ route('detail-event') }}" class="btn-see">See Details</a>
            <a href="{{ route('detail-event') }}" class="btn-buy">Buy a ticket</a>
          </div>
        </div>
      </article>

      <!-- CARD 2 -->
      <article class="article-card">
        <a href="{{ route('detail-event') }}" class="thumb">
          <img src="{{ asset('img/artikel4.jpg') }}" alt="Artikel 2">
        </a>
        <div class="card-body">
          <a href="{{ route('detail-event') }}" class="card-title">
            Behind the Scenes: Creative Affair & Sinemaku Day
          </a>
          <p class="card-excerpt">
            Intip momen di balik layar, sesi diskusi, serta penampilan spesial yang
            membuka mata soal proses kreatif dan kolaborasi.
          </p>
          <div class="card-meta">
            <span class="meta-chip"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="17" rx="3" stroke="currentColor" stroke-width="2" /><line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="3" y1="9" x2="21" y2="9" stroke="currentColor" stroke-width="2" /></svg> 11 Jan 2024</span>
            <span class="meta-chip"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><line x1="12" y1="12" x2="12" y2="7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="12" y1="12" x2="16" y2="14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg> 19.00 WIB</span>
            <span class="meta-chip"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="2"/></svg> Grand Cinema Jakarta</span>
          </div>

          <div class="card-actions">
            <a href="{{ route('detail-event') }}" class="btn-see">See Details</a>
            <a href="{{ route('detail-event') }}" class="btn-buy">Buy a ticket</a>
          </div>
        </div>
      </article>

      <!-- CARD 3 -->
      <article class="article-card">
        <a href="{{ route('detail-event') }}" class="thumb">
          <img src="{{ asset('img/artikel5.jpg') }}" alt="Artikel 3">
        </a>
        <div class="card-body">
          <a href="{{ route('detail-event') }}" class="card-title">
            Premiere Recap: Antusiasme Penonton & Momen Ikonik
          </a>
          <p class="card-excerpt">
            Sorotan dari malam pemutaran perdana – reaksi penonton, sesi Q&amp;A, dan momen yang bikin merinding.
          </p>
          <div class="card-meta">
            <span class="meta-chip"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="17" rx="3" stroke="currentColor" stroke-width="2" /><line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="3" y1="9" x2="21" y2="9" stroke="currentColor" stroke-width="2" /></svg> 11 Jan 2024</span>
            <span class="meta-chip"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><line x1="12" y1="12" x2="12" y2="7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="12" y1="12" x2="16" y2="14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg> 19.00 WIB</span>
            <span class="meta-chip"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="2"/></svg> Grand Cinema Jakarta</span>
          </div>

          <div class="card-actions">
            <a href="{{ route('detail-event') }}" class="btn-see">See Details</a>
            <a href="{{ route('detail-event') }}" class="btn-buy">Buy a ticket</a>
          </div>
        </div>
      </article>
    </div>
  </div>

</section>
