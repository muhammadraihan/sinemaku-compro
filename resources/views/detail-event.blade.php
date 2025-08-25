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

    /* ====== Event Detail ====== */
    :root{
      --ink:#0b0b0b;
      --muted:#6f6c78;
      --surface:#f7f7f7;
      --stroke:#8a8790;
      --white:#111;
      --btn:#fff;
    }

    .event-detail{
      max-width: 1180px;
      /* margin: 48px auto 96px; */
      margin-left: 230px;
      padding: 0 20px;
      color: var(--ink);
    }

    .event-hero{
      margin-top: 150px;
      display: grid;
      grid-template-columns: 1.2fr .9fr;
      gap: 42px;
      align-items: start;
    }

    .event-media{
      margin: 0;
      background: var(--surface);
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 8px 28px rgba(0,0,0,.08);
    }
    .event-media img{
      width: 100%;
      height: 520px;
      object-fit: cover;
      display: block;
    }

    .event-info{
      margin-top: 240px;
      padding-top: 8px;
    }

    .event-title{
      font: 500 clamp(26px, 3.2vw, 36px)/1.1 'Inter', sans-serif;
      letter-spacing: .05px;
      margin: 0 0 18px;
    }

    .event-meta{
      list-style: none;
      padding: 0;
      margin: 0 0 22px;
      display: grid;
      gap: 12px;
    }
    .event-meta li{
      display: flex;
      align-items: center;
      gap: 10px;
      color: var(--ink);
      font: 500 16px/1.3 Inter, system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    }
    .event-meta .i{
      width: 20px;
      height: 20px;
      stroke: var(--stroke);
      fill: none;
      stroke-width: 2;
      flex: 0 0 20px;
    }

    .btn-primary{
      display: inline-flex;
      align-items: center;
      gap: 10px;
      background: var(--btn);
      color: var(--white);
      padding: 14px 22px;
      border: 1.5px solid #11111126;
      text-decoration: none;
      font: 500 14px/1 Inter, system-ui;
      letter-spacing: .3px;
      transition: transform .18s ease, box-shadow .18s ease, opacity .18s ease;
      will-change: transform;
    }
    .btn-primary:hover{ transform: translateY(-1px); box-shadow: 0 10px 24px rgba(0,0,0,.15); }
    .btn-primary:active{ transform: translateY(0); opacity:.9; }
    .btn-primary .arrow{ width:18px;height:18px; stroke:#111; fill:none; stroke-width:2; }

    .purchase-note{
      margin: 12px 0 0;
      color: var(--muted);
      font: 400 12px/1.4 Inter, system-ui;
    }

    /* About */
    .event-about{
      margin-top: 56px;
      max-width: 900px;
    }
    .event-about h2{
      font: 500 clamp(24px, 3vw, 32px)/1.1 'Inter', sans-serif;
      margin: 0 0 16px;
    }
    .event-about p{
      font: 400 16px/1.75 Inter, system-ui;
      color: #2a2a2a;
      margin: 0 0 16px;
    }
    .event-about blockquote{
      margin: 24px 0;
      padding: 18px 20px;
      background: var(--surface);
      border-left: 4px solid #222;
      border-radius: 10px;
      font: 500 16px/1.6 Inter, system-ui;
    }
    .event-about blockquote footer{
      font: 600 14px/1.4 Inter, system-ui;
      color: var(--muted);
      margin-top: 6px;
    }

    /* Responsive */
    @media (max-width: 980px){
      .event-hero{ grid-template-columns: 1fr; }
      .event-media img{ height: 420px; }
      .event-about{ max-width: 100%; }
    }
    @media (max-width: 560px){
      .event-media img{ height: 300px; }
      .btn-primary{ width: 100%; justify-content: center; }
    }

    .detail{
    font: 300 14px/1.25 Inter, Arial, sans-serif;
    }

    /* ===== OTHER EVENTS ===== */
    .other-events{
      max-width: 1220px;
      margin: 72px auto;
      padding: 0 24px;
      color: #101010;
    }
    .oe-head{
      display:flex; align-items:center; justify-content:space-between;
      gap:16px; margin-bottom:28px;
    }
    .other-events h2{
      font: 500 clamp(28px,3.6vw,44px)/1.08 "Inter", sans-serif;
      letter-spacing:.2px; margin:0;
    }
    .oe-viewall{
      display:inline-flex; align-items:center; gap:10px;
      color:#111; text-decoration:none; font:600 18px/1 Inter, system-ui;
      opacity:.92; transition:opacity .2s ease, transform .2s ease;
    }
    .oe-viewall:hover{ opacity:1; transform:translateX(2px); }
    .oe-viewall .oe-arrow{ width:22px; height:22px; }

    .oe-grid{
      display:grid;
      grid-template-columns: repeat(3, minmax(0,1fr));
      gap:38px;
    }

    /* Card */
    .oe-card{ }
    .oe-link{ color:inherit; text-decoration:none; display:block; }
    .oe-media{
      margin:0 0 16px; border-radius:16px; overflow:hidden;
      background:#f3f3f3; position:relative;
      aspect-ratio: 16 / 9;     /* fix rasio gambar */
    }
    .oe-media img{
      position:absolute; inset:0;
      width:100%; height:100%; object-fit:cover;
      transform: scale(1);
      transition: transform .45s cubic-bezier(.2,.7,.2,1);
    }
    .oe-card:hover .oe-media img{ transform: scale(1.03); }

    .oe-title{
      font: 500 clamp(18px,2.1vw,24px)/1.25 "Inter", sans-serif;
      margin:0 0 6px;
    }
    .oe-date{
      display:block; font: 500 18px/1.4 "Inter", sans-serif;
      color:#111;
    }

    /* Responsive */
    @media (max-width: 1100px){
      .oe-grid{ grid-template-columns: repeat(2, minmax(0,1fr)); }
    }
    @media (max-width: 680px){
      .oe-grid{ grid-template-columns: 1fr; gap:26px; }
      .oe-date{ font-weight: 700; }
    }


</style>
<!-- ====== DETAIL EVENT ====== -->
<section class="event-detail">
  <div class="event-hero">
    <!-- LEFT: Poster / Foto event -->
    <figure class="event-media">
      <img src="{{ asset('img/artikel3.jpg') }}" alt="Midnight Premiere" />
    </figure>

    <!-- RIGHT: Title + meta + CTA -->
    <aside class="event-info">
      <h1 class="event-title">Midnight Premiere</h1>

      <ul class="event-meta">
        <li>
          <!-- calendar -->
          <svg viewBox="0 0 24 24" class="i"><rect x="3" y="5" width="18" height="16" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="8" y1="3" x2="8" y2="7"/><line x1="16" y1="3" x2="16" y2="7"/></svg>
          <span class="detail">11 Jan 2024</span>
        </li>
        <li>
          <!-- clock -->
          <svg viewBox="0 0 24 24" class="i"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
          <span class="detail">19.00 WIB</span>
        </li>
        <li>
          <!-- location -->
          <svg viewBox="0 0 24 24" class="i"><path d="M12 22s7-7.2 7-12a7 7 0 1 0-14 0c0 4.8 7 12 7 12Z"/><circle cx="12" cy="10" r="2.5"/></svg>
          <span class="detail">Grand Cinema Jakarta</span>
        </li>
        <li>
          <!-- ticket -->
          <svg viewBox="0 0 24 24" class="i"><rect x="3" y="7" width="18" height="10" rx="2" ry="2"/><path d="M9 7v10M15 7v10"/></svg>
          <span class="detail">Rp150.000,-</span>
        </li>
      </ul>

      <a class="btn-primary" href="https://loket.com" target="_blank" rel="noopener">
        BUY NOW ON LOKET.COM
        <svg viewBox="0 0 24 24" class="arrow"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
      </a>

      <p class="purchase-note">
        Purchases are handled via our official store on external platforms.
      </p>
    </aside>
  </div>

  <!-- ABOUT -->
  <div class="event-about">
    <h2>About This Event</h2>
    <p>
      Join us for an unforgettable evening as we premiere our latest psychological
      thriller "Midnight" in an exclusive screening that promises to be as captivating
      as the film itself.
    </p>
    <p>
      This special premiere event will feature an intimate Q&amp;A session with the cast
      and crew, offering unique insights into the creative process behind this haunting
      masterpiece. Following the screening, guests are invited to a sophisticated
      reception where you can mingle with fellow film enthusiasts and industry
      professionals.
    </p>
    <blockquote>
      “Midnight represents our boldest creative vision yet – a film that challenges
      audiences to question the nature of reality itself.”
      <footer>— Elena Rodriguez, Director</footer>
    </blockquote>
    <p>
      The evening will conclude with an exclusive behind-the-scenes presentation,
      featuring never-before-seen footage from the production and commentary from
      our cinematographer and sound designer.
    </p>
  </div>
</section>

<!-- ===== OTHER EVENTS ===== -->
<section class="other-events">
  <div class="oe-head">
    <h2>Other Events</h2>
    <a class="oe-viewall" href="{{ route('event') }}">
      View All
      <svg viewBox="0 0 24 24" class="oe-arrow"><path d="M5 12h14m-6-7 7 7-7 7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
  </div>

  <div class="oe-grid">
    <!-- Card -->
    <article class="oe-card">
      <a href="/events/kaos-perayaan-1" class="oe-link">
        <figure class="oe-media">
          <img src="{{ asset('img/artikel3.jpg') }}" alt="Kaos Perayaan Mati Rasa">
        </figure>
        <h3 class="oe-title">Kaos Perayaan Mati Rasa</h3>
        <time class="oe-date" datetime="2024-04-18">April 18, 2024</time>
      </a>
    </article>

    <article class="oe-card">
      <a href="/events/kaos-perayaan-2" class="oe-link">
        <figure class="oe-media">
          <img src="{{ asset('img/artikel3.jpg') }}" alt="Kaos Perayaan Mati Rasa">
        </figure>
        <h3 class="oe-title">Kaos Perayaan Mati Rasa</h3>
        <time class="oe-date" datetime="2024-04-18">April 18, 2024</time>
      </a>
    </article>

    <article class="oe-card">
      <a href="/events/kaos-perayaan-3" class="oe-link">
        <figure class="oe-media">
          <img src="{{ asset('img/artikel3.jpg') }}" alt="Kaos Perayaan Mati Rasa">
        </figure>
        <h3 class="oe-title">Kaos Perayaan Mati Rasa</h3>
        <time class="oe-date" datetime="2024-04-18">April 18, 2024</time>
      </a>
    </article>
  </div>
</section>

