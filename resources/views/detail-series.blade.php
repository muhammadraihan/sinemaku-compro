@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')
<style>
    /* ==== Reveal Animation ==== */
    /* Default: desktop/tablet show content immediately */
    .reveal-y,
    .reveal-x{
      opacity: 1;
      transform: none;
      transition: opacity 0.7s cubic-bezier(.5,.1,.25,1), transform 0.7s cubic-bezier(.5,.1,.25,1);
      will-change: opacity, transform;
    }
    /* Mobile-only: start hidden for reveal */
    @media (max-width: 640px){
      .reveal-y{ opacity: 0; transform: translateY(36px); }
      .reveal-x{ opacity: 0; transform: translateX(36px); }
    }
    .is-revealed {
      opacity: 1 !important;
      transform: none !important;
    }
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

    /* ===== Film Detail: HERO ===== */
    .film-hero{
      margin-top: 85px;
      position: relative;
      min-height: 100vh;
      color: #fff;
      display: flex;
      align-items: flex-end;
      padding: 24px clamp(16px, 4vw, 56px) clamp(28px, 6.5vw, 72px);
      background-image:
        linear-gradient(270deg, rgba(0,0,0,.25) 0%, rgba(0,0,0,.45) 40%, rgba(0, 0, 0, 0.858) 80%, rgba(0, 0, 0, 0.928) 100%),
        var(--hero-bg);
      background-size: cover;
      background-position: center;
      overflow: hidden;
    }

    /* breadcrumb */
    .film-hero__crumbs{
      position: absolute; top: 14px; left: clamp(12px, 3.6vw, 40px);
      font-size: 13px; letter-spacing: .2px; opacity: .9;
    }
    .film-hero__crumbs a{ color:#d6d6d6; text-decoration:none }
    .film-hero__crumbs a:hover{ text-decoration:underline }
    .film-hero__crumbs .current{ color:#fff }
    .film-hero__crumbs span{ margin:0 8px; color:#bdbdbd }

    /* content */
    .film-hero__inner{ max-width: 1060px }
    .film-hero__title{
      font-family: "Inter", sans-serif;
      font-weight: 500;
      line-height: .95;
      font-size: clamp(30px, 6vw, 90px);
      margin: 0 0 .3em 0;
      text-shadow: 0 10px 40px rgba(0,0,0,.45);
    }

    .film-hero__meta{
      display:flex; flex-wrap:wrap; gap:12px; align-items:center;
      font-size: clamp(14px, 1.8vw, 18px);
      color:#e6e6e6; opacity:.95; margin-bottom: 16px;
    }
    .film-hero__meta .dot{ opacity:.5 }

    .film-hero__meta .genre{
      font-family: "Inter", sans-serif;
      font-weight: 500;
      line-height: .95;
      font-size: 15px;
      text-shadow: 0 10px 40px rgba(0,0,0,.45);
    }

    .film-hero__rating{ display:flex; align-items:center; gap:14px; margin-bottom: 18px }
    .stars{ display:flex; gap:6px }
    .star{ width:20px; height:20px; fill:transparent; stroke:#ffd965; stroke-width:1.4 }
    .star.filled{ fill:#ffd965; stroke:#ffd965 }
    .score{
      color:#eaeaea; 
      font-weight:500; 
      font-size:16px;
      font-family: "Inter", sans-serif;
    }

    .film-hero__desc{
      font-family: "Inter", sans-serif;
      max-width: 900px;
      font-size: clamp(15px, 2.1vw, 20px);
      line-height: 1.7;
      color:#f1f1f1;
      margin: 10px 0 26px 0;
      text-shadow: 0 6px 22px rgba(0,0,0,.35);
      font-weight:300; 
    }

    /* buttons */
    .btn{
      display:inline-flex; align-items:center; gap:12px;
      padding: 16px 22px;
      font-weight: 700; letter-spacing:.3px;
      border-radius: 10px; border: 1.5px solid rgba(255,255,255,.2);
      background: rgba(255,255,255,.06);
      color:#fff; cursor:pointer;
      transition: transform .18s ease, background .25s ease, border-color .25s ease, box-shadow .25s ease;
      backdrop-filter: blur(6px);
      text-decoration: none;
    }
    .btn:hover{ transform: translateY(-1px); background: rgba(255,255,255,.12); border-color: rgba(255,255,255,.35); box-shadow: 0 10px 26px rgba(0,0,0,.28) }
    .btn:active{ transform: translateY(0) }

    .btn--primary{
    margin-top:10px; display:inline-flex; align-items:center; gap:12px; padding:16px 22px;
  border-radius:10px; background:#fff; color:#111; text-decoration:none; font-weight:700; font-size:13px;
  letter-spacing:.2px; box-shadow:0 10px 24px rgba(0,0,0,.156);
  transition:transform .18s, box-shadow .18s, background .2s; width:auto; max-width: 200px;
  }
  .btn--primary svg{ width:16px; height:16px; }
  .btn--primary:hover{ margin-top:10px; display:inline-flex; align-items:center; gap:12px; padding:16px 22px;
  border-radius:10px; background:linear-gradient(180deg, #1a1d22, #0f1115); color:#fff; text-decoration:none; font-weight:700; font-size:13px;
  letter-spacing:.2px; box-shadow: 0 12px 30px rgba(0,0,0,.35), inset 0 1px 0 rgba(255,255,255,.06); border:1px solid #20242a;
  transition:transform .18s, box-shadow .18s, background .2s; width:auto; max-width: 200px; position:relative; overflow:hidden; }
    .btn--ghost{ background:transparent }

    .btn--secondary{
    margin-top:10px; display:inline-flex; align-items:center; gap:12px; padding:16px 22px;
  border-radius:10px; background:linear-gradient(180deg, #1a1d22, #0f1115); color:#fff; text-decoration:none; font-weight:700; font-size:13px;
  letter-spacing:.2px; box-shadow: 0 12px 30px rgba(0,0,0,.35), inset 0 1px 0 rgba(255,255,255,.06); border:1px solid #20242a;
  transition:transform .18s, box-shadow .18s, background .2s; width:auto; max-width: 200px; position:relative; overflow:hidden;
  }
  .btn--secondary svg{ width:16px; height:16px; }
  .btn--secondary:hover{ background: #fff;
      color: #111;
      transform: translateY(-2px);
      box-shadow: 0 10px 24px rgba(0,0,0,.08); }
    .btn--ghost{ background:transparent }

    .film-hero__actions{
      font-family: "Inter", sans-serif;
      display:flex; 
      gap:14px; 
      flex-wrap:wrap
    }

    .btn .play{ width:18px; height:18px; fill:currentColor }

    /* small screens */
    @media (max-width: 640px){
      .film-hero{ min-height: 70vh; padding-bottom: 48px }
      .film-hero__inner{ max-width: 95% }
    }

    /* ====== ABOUT LAYOUT ====== */
    .film-about{
      padding: clamp(28px, 6vw, 72px) clamp(16px, 5vw, 64px);
      background:#fff; color:#111;
    }
    .film-about__grid{
      display:grid; grid-template-columns: 1.45fr .82fr; gap: clamp(24px,4vw,48px);
      grid-template-columns: minmax(0, 1.45fr) minmax(0, .82fr);
    }
    /* Kolom kiri tidak boleh memaksa lebar */
.film-about__main{ min-width:0; }
/* Gambar di dalam sinopsis / konten kiri selalu mengikuti frame */
.film-about__main img,
.film-about__main figure img{
  max-width: 100%;
  height: auto;
  display: block;
  border-radius: 12px;            /* opsional biar rapi */
  box-shadow: 0 8px 24px rgba(0,0,0,.06); /* opsional */
  margin: 14px 0;                 /* jarak vertikal */
}
    @media (max-width: 980px){
      .film-about__grid{ grid-template-columns: 1fr; }
    }

    .h2{ font-family:"Inter",sans-serif; font-size: clamp(18px,2.0vw,30px); line-height:1.05; margin: 0 0 .4em }
    .h3{ font-family:"Inter",system-ui,Arial,sans-serif; font-size: clamp(13px,1.8vw,16px); margin: 0 0 .8em; font-weight: 500 }
    .lead{ 
    font-family:"Inter",sans-serif; 
    font-weight: 500px;
    font-size: clamp(14px,2.0vw,16px); 
    line-height: 1.9; 
    color:#2c2c2c; 
    margin-bottom: 26px ;
    letter-spacing: -0.5px;
    /* line-height: .95; */
    }
    
    .film-about__two{
      display:grid; grid-template-columns: 1fr 1fr; gap: clamp(16px,2.8vw,22px); margin: 22px 0;
    }
    @media (max-width: 720px){ .film-about__two{ grid-template-columns: 1fr; } }

    /* meta list */
    .meta-list{ list-style:none; margin:0; padding:0; display:grid; gap:12px }
    .meta-list li{ display:flex; align-items:center; gap:12px; color:#333 }
    .meta-list .ico{ width:22px; height:22px; display:grid; place-items:center; color:#566; }
    .meta-list .ico svg{ width:22px; height:22px; fill:#889; opacity:.9 }

    /* simple list */
    .plain-list{ font-family:"Inter",sans-serif; list-style:none; margin:0; padding:0; display:grid; gap:10px; color:#222 }

    /* awards */
    .awards-list{ list-style:none; margin:0; padding:0; display:grid; gap:10px }
    .awards-list .star{ width:18px; height:18px; display:inline-grid; place-items:center; margin-right:8px }
    .awards-list .star svg{ width:18px; height:18px; fill:#ffd965; }
    .awards-list li{ display:flex; align-items:center; color:#2d2d2d }

    /* sidebar */
    .film-about__side{ position: relative }
    .suggest-card{
      position: sticky; top: 90px;
      padding: clamp(14px,2.5vw,22px);
      border-radius: 16px;
      border:1px solid #eee;
      background:#fafafa;
      box-shadow: 0 12px 28px rgba(0,0,0,.05);
    }
    .suggest-item{
      display:flex; gap:12px; padding:12px; margin:8px 0;
      border-radius: 12px; text-decoration:none; color:#141414;
      transition: background .2s, transform .18s;
    }
    .suggest-item:hover{ background:#fff; transform: translateY(-1px) }
    .suggest-item img{
      width:78px; height:78px; border-radius:10px; object-fit:cover;
      box-shadow: 0 6px 16px rgba(0,0,0,.08);
    }
    .suggest-item .title{ font-size: clamp(12px,1.5vw,15px); font-family:"Inter",sans-serif; font-weight:400; margin-bottom:6px; margin-top: 20px}
    .small{ font-size:11px }
    .muted{ color:#6a6a6a }
    .rating{ display:flex; align-items:center; gap:6px; margin-top:3px }
    .rating svg{ width:14px; height:14px; fill:#ffd965 }

    /* ===== Tablet/iPad refinements for "You Might Also Like" ===== */
    @media (min-width: 768px) and (max-width: 968px){
      .suggest-card{
        padding: 20px 22px;
        border-radius: 18px;
      }
      .suggest-item{
        gap: 16px;
        padding: 14px;
      }
      .suggest-item img{
        width: 120px;
        height: 120px;
        border-radius: 12px;
      }
      .suggest-item .title{
        font-size: 18px;       /* bigger title for readability */
        line-height: 1.25;
        margin: 4px 0 6px;
      }
      .suggest-item .small{
        font-size: 13.5px;     /* slightly larger meta */
      }
      .btn-wide{
        padding: 16px;         /* a bit larger button */
        gap: 12px;
        font-size: 14px;
      }
    }

    /* button */
    .btn-wide{
      margin-top: 14px; display:flex; justify-content:center; align-items:center; gap:10px;
      background:#111; color:#fff; text-decoration:none;
      border-radius: 12px; padding:14px; font-weight:800; letter-spacing:.4px;
      transition: transform .18s, box-shadow .22s, background .22s;
    }
    .btn-wide:hover{ transform: translateY(-1px); box-shadow: 0 12px 26px rgba(0,0,0,.16); background:#000 }
    .btn-wide .arr{ width:18px; height:18px; fill:#fff }
    .detail{
    font: 500 12px/1.25 Inter, Arial, sans-serif;
    }

    /* ===== Mobile refinements for Film Detail ===== */
@media (max-width: 560px){
  .film-hero{ min-height: 72vh; padding: 18px 16px 44px; }
  .film-hero__title{ font-size: clamp(26px, 10vw, 40px); }
  .film-hero__meta{ gap:8px; font-size: 14px; }
  .film-hero__actions{ gap:10px; }
  .btn{ padding: 12px 16px; border-radius: 9px; font-size: 12px; }
  .btn--primary, .btn--secondary{ max-width: none; }
  .film-card{margin-top:20px;}
}

/* Improve sticky card offset on small screens (navbar overlap) */
@media (max-width: 980px){
  .suggest-card{ top: 76px; }
}
.reveal-m,
.reveal-y,
.reveal-x {
  opacity: 1 !important;
  transform: none !important;
  transition: none !important;
}
.lead p {
  font-size: 1.00rem;
  font-weight: 300;
  line-height: 1.6;
  margin-bottom: 1rem;
}

.lead h2 {
    font-family: 'Inter', sans-serif;
    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1.6;
    margin-bottom: 1rem;
  }
  .lead h3 {
    font-family: 'Inter', sans-serif;
    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1.6;
    margin-bottom: 1rem;
  }
  .lead blockquote {
    font-family: 'Inter', sans-serif;
    font-size: 1.00rem;
    font-weight: 500;
    line-height: 1.6;
    margin-bottom: 1rem;
  }

  .lead ul {
    font-family: 'Inter', sans-serif;
    font-size: 1.00rem;
    font-weight: 300;
    line-height: 1.6;
    margin-bottom: 1rem;
  }

</style>
<!-- ===== Film Detail: HERO ===== -->
<section class="film-hero" style="--hero-bg: url({{ asset('photo/' . $film->photo) }})">

  <!-- Content -->
  <div class="film-hero__inner">
    <h1 class="film-hero__title reveal-y">{{ $film->title }}</h1>

    <div class="film-hero__meta reveal-y">
      <span class="genre">{{ \Carbon\Carbon::parse($film->release_date)->format('Y') }}</span>
      <span class="dot">•</span>
      <span class="genre">{{ $film->genre }}</span>
      <span class="dot">•</span>
      <span class="genre">{{ $film->season }} Season</span>
      <span class="dot">•</span>
      <span class="genre">{{ $film->episode }} Episode</span>
    </div>

    {{-- <div class="film-hero__rating">
      <div class="stars" aria-label="4.8 out of 5">
        <!-- bintang terisi -->
        <svg viewBox="0 0 24 24" class="star filled"><path d="M12 2l2.9 6.9 7.1.6-5.4 4.6 1.7 7-6.3-3.9-6.3 3.9 1.7-7L2 9.5l7.1-.6L12 2z"/></svg>
        <svg viewBox="0 0 24 24" class="star filled"><path d="M12 2l2.9 6.9 7.1.6-5.4 4.6 1.7 7-6.3-3.9-6.3 3.9 1.7-7L2 9.5l7.1-.6L12 2z"/></svg>
        <svg viewBox="0 0 24 24" class="star filled"><path d="M12 2l2.9 6.9 7.1.6-5.4 4.6 1.7 7-6.3-3.9-6.3 3.9 1.7-7L2 9.5l7.1-.6L12 2z"/></svg>
        <svg viewBox="0 0 24 24" class="star filled"><path d="M12 2l2.9 6.9 7.1.6-5.4 4.6 1.7 7-6.3-3.9-6.3 3.9 1.7-7L2 9.5l7.1-.6L12 2z"/></svg>
        <!-- bintang kosong -->
        <svg viewBox="0 0 24 24" class="star"><path d="M12 2l2.9 6.9 7.1.6-5.4 4.6 1.7 7-6.3-3.9-6.3 3.9 1.7-7L2 9.5l7.1-.6L12 2z"/></svg>
      </div>
      <span class="score">4.8/5</span>
    </div> --}}

    {{-- <p class="film-hero__desc">
      In the begining of a sleepless city, a detective unravels a mystery that blurs the line
      between reality and nightmare. As midnight approaches, time becomes the enemy, and every
      shadow holds a secret that could change everything. A psychological thriller that questions
      the nature of perception and truth.
    </p> --}}

    <div class="film-hero__actions">
      <a href="{{ $film->link }}" class="btn btn--primary reveal-x">
        <svg viewBox="0 0 24 24" class="play"><path d="M8 5v14l11-7z"/></svg>
        Trailer
      </a>
      @if (!empty($film->link_watch))
        <a href="{{ $film->link_watch }}" class="btn btn--secondary reveal-x">
          Watch Now
        </a>
      @endif
    </div>
  </div>
</section>

  <!-- ========= ABOUT THE FILM / DETAILS / CAST / AWARDS + SIDEBAR ========= -->
  <section class="film-about">
    <div class="film-about__grid">
      <!-- LEFT COLUMN -->
      <div class="film-about__main">
        <!-- Details + Cast -->
        <div class="film-about__two">
          <div class="film-card reveal-y">
            <h3 class="h3">Series Details</h3>
            <ul class="meta-list">
              <li>
                <span class="ico">
                  <!-- calendar -->
                  <svg viewBox="0 0 24 24"><path d="M7 2v2H5a2 2 0 0 0-2 2v2h18V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7zm14 8H3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10z"/></svg>
                </span>
                <span class="detail">Release Date: <strong>{{ \Carbon\Carbon::parse($film->release_date)->format('M d, Y') }}</strong></span>
              </li>
              <li>
                <span class="ico">
                  <!-- clock -->
                  <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="1.8"
                      stroke-linecap="round" stroke-linejoin="round">
                    {{-- <title>Season</title> --}}
                    <!-- tiga layer bertumpuk -->
                    <path d="M12 4L20 8l-8 4L4 8l8-4Z"/>
                    <path d="M20 12l-8 4-8-4"/>
                    <path d="M20 16l-8 4-8-4"/>
                  </svg>

                </span>
                <span class="detail">Season: <strong>{{ $film->season }} Season</strong></span>
              </li>
              <li>
                <span class="ico">
                  <!-- clock -->
                  <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="1.8"
                      stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                    <path d="M10 9l6 3-6 3z"/> <!-- play -->
                    <!-- garis kecil seperti “progress bar” -->
                    <path d="M5 7h4"/>
                  </svg>

                </span>
                <span class="detail">Episode: <strong>{{ $film->episode }} Episode</strong></span>
              </li>
              <li>
                <span class="ico">
                  <!-- director / user -->
                  <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="1.8"
                      stroke-linecap="round" stroke-linejoin="round">
                    <title>Episode</title>
                    <!-- clapperboard atas -->
                    <path d="M3 6h18v4H3z"/>
                    <path d="M6 6l2-3h4l2 3"/>
                    <!-- body filmstrip -->
                    <rect x="3" y="10" width="18" height="11" rx="2"/>
                    <!-- garis horizontal (tiap baris episode/scene) -->
                    <path d="M3 15h18"/>
                  </svg>
                </span>
                <span class="detail">Director: <strong>{{ $film->director }}</strong></span>
              </li>
            </ul>
          </div>

          <div class="film-card reveal-y">
            <h3 class="h3">Cast</h3>
            <ul class="plain-list">
             @php
                $all_cast = explode(',', $film->cast);
              @endphp
              @foreach ($all_cast as $item)
                  <li>{{ $item }}</li>
              @endforeach
            </ul>
          </div>
        </div>
        <br>
        {{-- <h2 class="h2">About the Film</h2> --}}

        <div class="lead reveal-y">
          {!! $film->sinopsis !!}
        </div>
      </div>

      <!-- RIGHT COLUMN / SIDEBAR -->
      <aside class="film-about__side">
        <div class="suggest-card reveal-y">
          <h3 class="h3">You Might Also Like</h3>

          @foreach ($all_film as $item)
              <a class="suggest-item reveal-y" href="{{ route('detail-series', $item->slug) }}">
                <img src="{{ asset('photo/' . $item->poster) }}" alt="" loading="lazy">
                <div>
                  <div class="title">{{ $item->title }}</div>
                  <div class="small muted detail">{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }} • {{ $item->genre }}</div>
                  {{-- <div class="small rating">
                    <svg viewBox="0 0 24 24"><path d="M12 2l2.9 6.9 7.1.6-5.4 4.6 1.7 7-6.3-3.9-6.3 3.9 1.7-7L2 9.5l7.1-.6L12 2z"/></svg>
                    4.6
                  </div> --}}
                </div>
              </a>
          @endforeach

          <a class="btn-wide reveal-y" href="{{ route('series') }}">
            <span class="detail">VIEW ALL SERIES</span>
            <svg viewBox="0 0 24 24" class="arr"><path d="M13 5l7 7-7 7M4 12h16"/></svg>
          </a>
        </div>
      </aside>
    </div>
  </section>



<!-- Reveal Animation Script (Mobile Only)
<script>
  (function(){
    const isMobile = window.matchMedia('(max-width: 640px)').matches;
    const nodes = document.querySelectorAll('.reveal-y, .reveal-x');

    if (!isMobile) {
      // Desktop/tablet: reveal everything immediately (prevent hidden content)
      nodes.forEach(el => el.classList.add('is-revealed'));
      return;
    }

    // Mobile: lazy reveal on scroll
    const options = { threshold: 0.18 };
    const onReveal = (entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-revealed');
          obs.unobserve(entry.target);
        }
      });
    };
    const observer = new IntersectionObserver(onReveal, options);
    nodes.forEach(el => observer.observe(el));
  })();
</script> -->