@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')

<style>
  /* ---------- NAVBAR (tetap) ---------- */
  .navbar-logo{
    position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);
    font-family:'Inter',Arial,sans-serif; font-size:1.11rem; font-weight:800;
    letter-spacing:1.7px; color:#070707; text-shadow:0 1px 5px rgba(0,0,0,.09);
    text-transform:uppercase; line-height:1; white-space:nowrap;
    pointer-events:auto;          /* <-- boleh diklik */
  text-decoration:none;         /* hilangkan underline */
  padding:10px 14px;            /* area klik nyaman */
  z-index:2;                    /* pastikan di atas bg navbar */
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
    font: 600 12px/1 'Inter',system-ui,Arial; letter-spacing:.01em;
    color:#4B5563; text-transform:uppercase; margin-bottom:10px;
  }
  .featured-title{
    font-family:"Inter",sans-serif; font-weight:800; line-height:.95;
    letter-spacing:-.01em; margin:0 0 clamp(10px,1.8vw,14px);
    font-size: clamp(22px, 3.0vw, 40px); color:#0A0A0A;
  }
  .featured-excerpt{
    font-family:"Inter",sans-serif; color:#4a4a4a; font-size: clamp(14px, 1.1vw, 16px);
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
    font-family:"Inter",sans-serif; margin-top:10px; display:inline-flex; align-items:center; gap:12px; padding:16px 22px;
  border-radius:10px; background:#fff; color:#111; text-decoration:none; font-weight:500; font-size:13px;
  letter-spacing:.2px; box-shadow:0 10px 24px rgba(0,0,0,.156);
  transition:transform .18s, box-shadow .18s, background .2s; width:auto; max-width: 160px;
  }
  .btn-primary svg{ width:16px; height:16px; }
  .btn-primary:hover{ background: #111;
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 10px 24px rgba(0,0,0,.08); }

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
    font: 300 clamp(15px,2.0vw,25px)/1.2 "Inter", sans-serif;
      letter-spacing:.2px;
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
    font-family:"Inter",sans-serif;margin:8px 0 12px; color:#4b5563; font-size:14px; line-height:1.6;
    display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;
  }
  .card-meta{ display:flex; gap:12px; flex-wrap:wrap; }

  /* ============ Responsive stack ============ */
  @media (max-width: 1024px){
    .article-featureds{
      grid-template-columns: 1fr;
      height:auto; min-height:auto; max-height:none;
    }
    /* --- Stack order on small screens: IMAGE first, then TEXT --- */
    .featured-media{ order:1; }
    .featured-body{ order:2; border-radius:18px; }
    /* add a little spacing under the image */
    .featured-media{ margin-bottom: 12px; }
  }
  @media (max-width: 640px){
    .stories-grid{ grid-template-columns: 1fr; }
  }
  @media (max-width: 640px){
    .featured-media {
      margin-top:50px;
    }
    .featured-media img{
      height: auto;
      min-height: 0;
      object-fit: cover;
    }
    .featured-title{
      font-size: clamp(22px, 6vw, 28px);
    }
    .featured-excerpt{
      font-size: 14px;
      line-height: 1.4;
    }
  }

  /* ===================== Reveal on Scroll (Articles) ===================== */
  @media (prefers-reduced-motion: no-preference){
    .reveal{
      opacity: 0;
      transform: translateY(18px);
      transition: opacity .56s cubic-bezier(.22,.61,.36,1),
                  transform .56s cubic-bezier(.22,.61,.36,1);
      will-change: opacity, transform;
    }
    /* stagger via --reveal-delay var (ms) */
    .reveal[data-delay]{ transition-delay: calc(var(--reveal-delay, 0ms)); }
    .reveal.is-in{
      opacity: 1;
      transform: none;
    }

    /* Slightly different motion for hero halves */
    .reveal-x{
      opacity: 0;
      transform: translateX(24px);
      transition: opacity .64s cubic-bezier(.22,.61,.36,1),
                  transform .64s cubic-bezier(.22,.61,.36,1);
      will-change: opacity, transform;
    }
    .reveal-x.is-in{ opacity:1; transform:none; }

    /* Safety: when animations disabled */
    .no-motion .reveal,
    .no-motion .reveal-x{
      opacity: 1 !important;
      transform: none !important;
      transition: none !important;
    }
  }
  .reveal-m {
  opacity: 1 !important;
  transform: none !important;
  transition: none !important;
}
</style>


<section class="articles-page">

  <!-- ===== Featured / Hero (landscape) ===== -->
  <div class="article-featureds">
    <!-- TEKS KIRI -->
    <div class="featured-body">
      <div class="eyebrow">Featured</div>
      <h1 class="featured-title">{{ $articles->judul }}</h1>

      <p class="featured-excerpt">
        {{ $articles->title }}
      </p>

      <div class="featured-meta">
        <span class="meta-chip">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm0 2c-3.87 0-7 3.13-7 7h2c0-2.76 2.24-5 5-5s5 2.24 5 5h2c0-3.87-3.13-7-7-7z"/></svg>
          {{ $articles->penulis }}
        </span>
        <span class="meta-chip">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2v2H5a2 2 0 0 0-2 2v2h18V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7zm14 8H3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10z"/></svg>
          {{ \Carbon\Carbon::parse($articles->tgl_rilis)->format('d M Y') }}
        </span>
      </div>

      <a href="{{ route('detail-articles', $articles->slug) }}" class="btn-primary">
        READ MORE
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path d="M5 12h14M13 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    </div>

    <!-- GAMBAR KANAN -->
    <div class="featured-media">
      <img src="{{ asset('photo/' . $articles->photo) }}" alt="Featured article">
    </div>
  </div>

  <!-- ===== All Stories (cards) — tak diubah besar-besarnya ===== -->
  <div class="articles-list">
    <h2 class="section-heading">All Stories</h2>

    <div class="stories-grid">
      @foreach ($all_articles as $item)
        @if($item->kategori == 'external')
          <article class="article-card">
            <a href="{{ $item->link }}" class="thumb">
              <img src="{{ asset('photo/' . $item->photo) }}" alt="Artikel 1">
            </a>
            <div class="card-body">
              <a href="{{ $item->link }}" class="card-title">
                {{ $item->judul }}
              </a>
              <p class="card-excerpt">
                {{ $item->title }}
              </p>
              <div class="card-meta">
                <span class="meta-chip">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm0 2c-3.87 0-7 3.13-7 7h2c0-2.76 2.24-5 5-5s5 2.24 5 5h2c0-3.87-3.13-7-7-7z"/></svg>
                  {{ $item->penulis }}
                </span>
                <span class="meta-chip">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2v2H5a2 2 0 0 0-2 2v2h18V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7zm14 8H3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10z"/></svg>
                  {{ \Carbon\Carbon::parse($item->tgl_rilis)->format('d M Y') }}
                </span>
              </div>
            </div>
          </article>
        @else
          <article class="article-card">
            <a href="{{ route('detail-articles', $item->slug) }}" class="thumb">
              <img src="{{ asset('photo/' . $item->photo) }}" alt="Artikel 1">
            </a>
            <div class="card-body">
              <a href="" class="card-title">
                {{ $item->judul }}
              </a>
              <p class="card-excerpt">
                {{ $item->title }}
              </p>
              <div class="card-meta">
                <span class="meta-chip">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm0 2c-3.87 0-7 3.13-7 7h2c0-2.76 2.24-5 5-5s5 2.24 5 5h2c0-3.87-3.13-7-7-7z"/></svg>
                  {{ $item->penulis }}
                </span>
                <span class="meta-chip">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2v2H5a2 2 0 0 0-2 2v2h18V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7zm14 8H3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10z"/></svg>
                  {{ \Carbon\Carbon::parse($item->tgl_rilis)->format('d M Y') }}
                </span>
              </div>
            </div>
          </article>
        @endif
            
      @endforeach
    </div>
  </div>

</section>
<script>
(function(){
  // Respect reduced motion
  const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (prefersReduced) {
    document.documentElement.classList.add('no-motion');
    return;
  }

  // Collect elements to reveal:
  // - Featured wrapper and its two halves
  // - Each article card inside All Stories
  const toReveal = [];

  const hero = document.querySelector('.article-featureds');
  if (hero) {
    // add class to the whole wrapper (fade up)
    hero.classList.add('reveal');
    hero.style.setProperty('--reveal-delay', '60ms');
    toReveal.push(hero);

    // and stagger both halves (text and image) sliding from side
    const left = hero.querySelector('.featured-body');
    const right = hero.querySelector('.featured-media');
    if (left) { left.classList.add('reveal-x'); left.style.setProperty('--reveal-delay', '120ms'); toReveal.push(left); }
    if (right){ right.classList.add('reveal-x'); right.style.setProperty('--reveal-delay', '220ms'); toReveal.push(right); }
  }

  // Cards
  const cards = document.querySelectorAll('.stories-grid .article-card');
  cards.forEach((card, i) => {
    card.classList.add('reveal');
    // stagger every card 60ms
    card.style.setProperty('--reveal-delay', (60 * (i % 6)) + 'ms');
    toReveal.push(card);
  });

  if (!toReveal.length) return;

  // IntersectionObserver
  const io = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-in');
        io.unobserve(entry.target);
      }
    });
  }, {
    root: null,
    rootMargin: '0px 0px -10% 0px',
    threshold: 0.18
  });

  toReveal.forEach(el => io.observe(el));

  // Re-observe on resize/orientation change (layout shifts)
  let roTimer = null;
  window.addEventListener('resize', () => {
    clearTimeout(roTimer);
    roTimer = setTimeout(() => {
      document.querySelectorAll('.reveal:not(.is-in), .reveal-x:not(.is-in)').forEach(el => {
        try { io.observe(el); } catch(e){}
      });
    }, 180);
  });
})();
</script>
