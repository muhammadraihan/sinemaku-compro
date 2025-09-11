@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')
<script>document.documentElement.classList.add('js');</script>
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
    text-transform: uppercase;
    line-height: 1;
    pointer-events:auto;          /* <-- boleh diklik */
  text-decoration:none;         /* hilangkan underline */
  padding:10px 14px;            /* area klik nyaman */
  z-index:2;                    /* pastikan di atas bg navbar */
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
      margin: 48px auto 96px;
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
      height: auto;
      aspect-ratio: 16 / 9;
      object-fit: cover;
      display: block;
    }

    .event-info{
      margin-top: 40px;
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
    margin-top:10px; display:inline-flex; align-items:center; gap:12px; padding:16px 22px;
  border-radius:10px; background:#fff; color:#111; text-decoration:none;
  font: 700 13px/1.2 Inter, system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
  letter-spacing:.2px; box-shadow:0 10px 24px rgba(0,0,0,.156);
  transition:transform .18s, box-shadow .18s, background .2s; width:auto; max-width: 260px;
  }
  .btn-primary:hover{ background: #111;
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 10px 24px rgba(0,0,0,.08); }
      
    .btn-primary:active{ transform: translateY(0); opacity:.9; }
    /* .btn-primary .arrow{ width:18px;height:18px; stroke:#111; fill:none; stroke-width:2; } */

    .purchase-note{
      margin: 12px 0 0;
      color: var(--muted);
      font: 400 12px/1.4 Inter, system-ui;
    }

    /* Garis pemisah antar section */
.event-divider {
  border: 0;
  height: 1px;
  background: #e5e5e5;     /* warna abu tipis */
  margin: 60px auto;       /* jarak atas-bawah */
  width: 100%;        /* biar gak selebar layar */
}

    /* About */
.event-about {
  margin: 64px auto 80px;
  max-width: 820px;
  padding: 0 18px;
}

.event-about h2 {
  font: 600 clamp(22px, 2.4vw, 30px)/1.25 'Inter', sans-serif;
  margin: 0 0 22px;
  letter-spacing: -0.2px;
  color: #0f1115;
}

.event-about p {
  font: 400 16px/1.8 'Inter', system-ui, sans-serif;
  color: #333;
  margin: 0 0 20px;
  font-size: 1.25rem;
  font-weight: 300;
  line-height: 1.6;
  margin-bottom: 1rem;
}

/* Quote */
.event-about blockquote {
  margin: 32px 0;
  padding: 20px 24px;
  background: #fafafa;
  border-left: 4px solid #000;
  border-radius: 12px;
  font: italic 500 17px/1.65 'Inter', system-ui, sans-serif;
  color: #111;
  position: relative;
}
.event-about blockquote::before {
  content: "“";
  font-size: 42px;
  line-height: 1;
  position: absolute;
  left: 12px;
  top: 8px;
  color: #aaa;
}
.event-about blockquote footer {
  margin-top: 10px;
  text-align: right;
  font: 600 14px/1.4 'Inter', system-ui, sans-serif;
  color: #666;
}

/* Gambar di dalam deskripsi event */
.event-about img {
  max-width: 100%;
  height: auto;
  border-radius: 14px;
  display: block;
  margin: 24px auto;
  box-shadow: 0 8px 28px rgba(0,0,0,0.08);
  object-fit: cover;
}

    /* Responsive */
    @media (max-width: 980px){
      .event-hero{ grid-template-columns: 1fr; gap: 24px; }
      .event-media img{ height: auto; aspect-ratio: 16 / 9; }
      .event-info{ margin-top: 0; }
      .event-about{ max-width: 100%; }
    }
    @media (max-width: 560px){
      .event-detail{ padding: 0 16px; }
      .event-media img{ height: auto; aspect-ratio: 16 / 9; border-radius: 12px; }
      .event-title{ font-size: clamp(22px, 6.4vw, 28px); }
      .btn-primary{ width: 100%; justify-content: center; }
    }

    .detail{
    font: 300 14px/1.25 Inter, Arial, sans-serif;
    }

    /* ===== OTHER EVENTS ===== */
    .other-events{
      max-width: 1220px;
      margin: 52px auto;
      padding: 0 24px;
      color: #101010;
    }
    .oe-head{
      display:flex; align-items:center; justify-content:space-between;
      gap:16px; margin-bottom:18px;
    }
    .other-events h2{
      font: 500 clamp(14px,2vw,25px)/1.08 "Inter", sans-serif;
      letter-spacing:.2px; margin:0;
      margin-bottom:20px;
    }
    .oe-viewall{
      display:inline-flex; align-items:center; gap:10px;
      color:#111; text-decoration:none; font:450 15px/1 Inter, system-ui;
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
      font: 500 clamp(14px,1.5vw,20px)/1.25 "Inter", sans-serif;
      margin:0 0 6px;
    }
    .oe-date{
      display:block; font: 500 13px/1.4 "Inter", sans-serif;
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


  /* ===== Reveal animation (cinematic) ===== */
  .js .reveal{
    opacity:0;
    transform:translateY(22px);
    transition:opacity .7s cubic-bezier(.2,.7,.2,1), transform .7s cubic-bezier(.2,.7,.2,1);
    will-change: opacity, transform;
  }
  .js .reveal-x{
    opacity:0;
    transform:translateX(-26px);
    transition:opacity .7s cubic-bezier(.2,.7,.2,1), transform .7s cubic-bezier(.2,.7,.2,1);
    will-change: opacity, transform;
  }
  .reveal.is-visible,
  .reveal-x.is-visible{
    opacity:1;
    transform:none;
  }

  /* Stagger container: children will get incremental delays via JS */
  .js .reveal-stagger > *{
    opacity:0;
    transform:translateY(22px);
    transition:opacity .7s cubic-bezier(.2,.7,.2,1), transform .7s cubic-bezier(.2,.7,.2,1);
    will-change: opacity, transform;
  }
  .reveal-stagger.is-visible > *{
    opacity:1;
    transform:none;
  }

  /* Respect reduced motion */
  @media (prefers-reduced-motion: reduce){
    .reveal,
    .reveal-x,
    .reveal-stagger > *{
      opacity:1 !important;
      transform:none !important;
      transition:none !important;
    }
  }
  .reveal-m,
.reveal-y,
.reveal-x {
  opacity: 1 !important;
  transform: none !important;
  transition: none !important;
}
</style>
<!-- ====== DETAIL EVENT ====== -->
<section class="event-detail">
  <div class="event-hero">
    <!-- LEFT: Poster / Foto event -->
    <figure class="event-media reveal">
      <img src="{{ asset('photo/' . $event->photo) }}" alt="{{ $event->judul }}" />
    </figure>

    <!-- RIGHT: Title + meta + CTA -->
    <aside class="event-info reveal-x">
      <h1 class="event-title">{{ $event->judul }}</h1>

      <ul class="event-meta">
        <li>
          <!-- calendar -->
          <svg viewBox="0 0 24 24" class="i"><rect x="3" y="5" width="18" height="16" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="8" y1="3" x2="8" y2="7"/><line x1="16" y1="3" x2="16" y2="7"/></svg>
          <span class="detail">{{ \Carbon\Carbon::parse($event->tgl_event)->format('d M Y') }}</span>
        </li>
        <li>
          <!-- clock -->
          <svg viewBox="0 0 24 24" class="i"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
          <span class="detail">{{ $event->jam_event }} WIB</span>
        </li>
        <li>
          <!-- location -->
          <svg viewBox="0 0 24 24" class="i"><path d="M12 22s7-7.2 7-12a7 7 0 1 0-14 0c0 4.8 7 12 7 12Z"/><circle cx="12" cy="10" r="2.5"/></svg>
          <span class="detail">{{ $event->location }}</span>
        </li>
        <li>
          <!-- ticket -->
          <svg viewBox="0 0 24 24" class="i"><rect x="3" y="7" width="18" height="10" rx="2" ry="2"/><path d="M9 7v10M15 7v10"/></svg>
          <span class="detail">{{ $event->harga ? 'Rp'.''.str_replace(',', '.', number_format($event->harga)) : ''; }}</span>
        </li>
      </ul>

      <a href="{{ $event->link }}" class="btn-primary">
      BUY NOW
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path d="M5 12h14M13 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>

      <p class="purchase-note">
        Purchases are handled via our official store on external platforms.
      </p>
    </aside>
  </div>

  <hr class="event-divider">

  <!-- ABOUT -->
  <div class="event-about reveal">
    {!! $event->detail !!}
  </div>
</section>

<!-- ===== OTHER EVENTS ===== -->
<section class="other-events">
  <div class="oe-head reveal-x">
    <h2>Other Events</h2>
    <a class="oe-viewall" href="{{ route('event') }}">
      View All
      <svg viewBox="0 0 24 24" class="oe-arrow"><path d="M5 12h14m-6-7 7 7-7 7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
  </div>

  <div class="oe-grid reveal-stagger">
    @foreach ($all_event as $item)
        <article class="oe-card">
          <a href="{{ route('detail-event', $item->slug) }}" class="oe-link">
            <figure class="oe-media">
              <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->judul }}">
            </figure>
            <h3 class="oe-title">{{ $item->judul }}</h3>
            <time class="oe-date" datetime="{{ \Carbon\Carbon::parse($item->tgl_event)->format('Y-m-d') }}">{{ \Carbon\Carbon::parse($item->tgl_event)->format('M, d Y') }}</time>
          </a>
        </article>
    @endforeach
  </div>
</section>

<script>
(function(){
  // basic reveal
  const els = document.querySelectorAll('.reveal, .reveal-x, .reveal-stagger');
  if(!('IntersectionObserver' in window) || !els.length) {
    els.forEach(el => el.classList.add('is-visible'));
    return;
  }

  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if(entry.isIntersecting){
        const el = entry.target;
        // Stagger children if container has reveal-stagger
        if(el.classList.contains('reveal-stagger')){
          [...el.children].forEach((child, i) => {
            child.style.transitionDelay = (i * 90) + 'ms';
          });
        }
        el.classList.add('is-visible');
        io.unobserve(el);
      }
    });
  }, { threshold: 0.12 });

  els.forEach(el => io.observe(el));
})();
</script>
