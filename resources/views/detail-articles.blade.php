@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')

<style>
/* ---------------- NAV tetapkan ---------------- */
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

/* ---------------- THEME ---------------- */
:root{
  --wrap: min(1180px, 94vw);
  --ink: #0f0f0f;
  --muted: #6b7280;
  --line: #e5e7eb;
  --bg: #ffff;
  --paper: #fff;
  --radius: 14px;
  --shadow: 0 14px 40px rgba(0,0,0,.10);
}
*{box-sizing:border-box}
body{background:var(--bg)}

/* ---------------- PAGE ---------------- */
.article-detail{ padding: 28px 0 80px; color:var(--ink); }
.article-detail .container{ width:var(--wrap); margin:0 auto; }

/* ---------------- HERO ---------------- */
.article-head{ margin-top: 86px; margin-bottom: 22px; }
.hero-media{
  /* full-bleed hero */
  width: 90vw;
  margin-left: calc(50% - 45vw);
  margin-right: calc(50% - 45vw);
  margin-bottom: clamp(20px, 3.2vw, 56px);
  border-radius: 0;
  overflow: hidden;
  box-shadow: none;
  background: #000;
}

.hero-media img{
  width: 100%;
  height: clamp(300px, 45vw, 560px);
  object-fit: cover;
  object-position: center;
  display: block;
  transform: none;
  transition: transform .6s cubic-bezier(.2,.8,.2,1);
}

.hero-media:hover img{ transform: scale(1.02); }

.breadcrumbs{
  font: 500 12.5px/1 'Inter',system-ui,Arial; color:var(--muted); display:flex; gap:8px; align-items:center;
  margin: 6px 2px 10px;
}
.breadcrumbs a{ color:inherit; text-decoration:none }
.breadcrumbs .sep{ opacity:.6 }

.article-title{
  font: 500 clamp(26px,3.2vw,40px)/1.15 'Inter',system-ui,Arial;
  letter-spacing: -.01em; margin: 4px 0 10px;
}
.article-sublead{ display:none; } /* tak dipakai pada gaya ini */

.meta-row{
  display:flex; align-items:center; gap:12px; flex-wrap:wrap;
  font: 500 14px/1.2 'Inter',system-ui,Arial; color:var(--muted);
  padding: 6px 0 2px; border-bottom: 1px solid var(--line);
  padding-bottom: 14px;
}
.meta-chip{
  display:inline-flex; align-items:center; gap:8px; padding:6px 10px; border-radius:999px;
  background:#eef2f7; color:#374151; font-size:12.5px; font-family:'Inter',Arial,sans-serif;
}
.meta-dot{ opacity:.5 }
.meta-brand{ font-weight:700; color:#111 ;font-family:'Inter',Arial,sans-serif; }
.meta-right{ margin-left:auto; display:flex; gap:8px; align-items:center }
.btn-share{
  width:34px; height:34px; display:grid; place-items:center; border-radius:8px;
  border:1px solid var(--line); background:#fff; cursor:pointer;
  transition:transform .18s, box-shadow .18s, background .2s;
}
.btn-share:hover{ transform:translateY(-1px); box-shadow:0 8px 22px rgba(0,0,0,.08); background:#fafafa }

/* better word-wrap in narrow screens */
.article-title,
.article-content{
  overflow-wrap: anywhere;
  word-break: normal;
}

/* ---------------- GRID ---------------- */
.article-grid{
  display:grid; grid-template-columns: 1.65fr .9fr; gap: clamp(22px, 3.8vw, 42px); align-items:start;
  margin-top: 18px;
}
@media (max-width: 980px){
  .article-grid{ grid-template-columns:1fr; }
  .meta-right{ margin-left:0 }
}
@media (max-width: 980px){
  .widget{ position: static; top: auto; }
}

/* ========== KEMBALIKAN FRAME ARTIKEL (kartu) ========== */
.article-grid{ gap: clamp(22px, 3.2vw, 42px); }   /* beri jarak dg sidebar */

/* ---------------- CONTENT ---------------- */
/* Pastikan kontainer memotong isi jika lebih besar */
.article-content{
  background: var(--paper);            /* latar kartu */
  border: 1px solid var(--line);       /* garis frame */
  border-radius: var(--radius);        /* sudut */
  box-shadow: 0 5px 8px rgba(2,8,23,.06); /* bayangan halus */
  padding: clamp(16px,2.2vw,22px) clamp(18px,2.4vw,26px);
  overflow: hidden;                    /* gambar tetap di dalam kartu */
}

/* jaga semua media tetap di dalam kartu */
.article-content :where(img, video, iframe){
  max-width:100% !important;
  height:auto !important;
  display:block;
}
/* Jika ada inline style width/height dari editor */
.article-content img[style*="width"],
.article-content img[width]{
  max-width: 100% !important;
  height: auto !important;
}
/* Figure bawaan editor */
.article-content figure{
  margin: 14px 0;
  border-radius: 12px;
  overflow: hidden;                  /* crop sudut */
  background: #f2f3f5;
  border: 1px solid var(--line);
}
.article-content figure img{ display:block; }
.article-content p{
  font: 400 16px/1.85 'Inter',system-ui,Arial; color:#2b2b2b; margin: 0 0 16px;
}
.article-content a{ font-family:'Inter',Arial,sans-serif; color:#0d63ff; text-decoration:none }
.article-content a:hover{ text-decoration:underline }
.article-content h2,.article-content h3{
  font: 800 22px/1.15 'Inter',system-ui,Arial; margin: 26px 0 10px;
}

/* tables & code blocks inside editor content */
.article-content table{
  width: 100%;
  border-collapse: collapse;
  margin: 14px 0;
  display: table;
}
.article-content th,
.article-content td{
  border: 1px solid var(--line);
  padding: 10px;
  text-align: left;
  vertical-align: top;
}
.article-content pre{
  background: #0b0b0b0d;
  border: 1px solid var(--line);
  border-radius: 10px;
  padding: 12px;
  overflow: auto;
}
.article-content code{
  font-family:'Inter',Arial,sans-serif;
  font-size: 90%;
}

/* Embed (YouTube, dll.) agar responsif */
.article-content iframe{
  width: 100% !important;
  aspect-ratio: 16 / 9;
  border: 0;
}
/* Quote highlight ala news */
.key-quote{
  border-left: 4px solid #111; padding: 10px 12px; margin: 12px 0 16px; background:#fafafa;
  font: 700 18px/1.45 'Inter',system-ui,Arial; color:#111;
}

/* Image & caption in body */
.figure{
  margin: 14px 0; border-radius: 12px; overflow:hidden; background:#f2f3f5; border:1px solid var(--line)
}
.figure img{ width:100%; height: clamp(200px, 38vw, 360px); object-fit:cover; display:block }
.figure figcaption{ padding:8px 12px; font: 500 12px/1.4 'Inter',system-ui,Arial; color:#7b7b7b }

/* Two-column list block */
.list-block{
  background:#fafafa; border:1px solid var(--line); border-radius:12px; padding:14px;
}
.list-block h4{ margin: 0 0 10px; font: 600 15px/1.2 'Inter',system-ui,Arial; }
.cols-2{ columns: 2; column-gap: 35px; padding-left: 18px; }
.cols-2 li{ break-inside: avoid; margin:6px 0; }
@media (max-width: 720px){ .cols-2{ columns:1 } }

/* ---------------- SIDEBAR ---------------- */
.article-sidebar{ min-width:0; }
.widget{
  position: sticky; top: 92px;
  display:grid; gap:12px; background:var(--paper); padding:16px; border-radius: var(--radius);
  border:1px solid var(--line);
}
.widget-title{ font:500 15px/1.2 'Inter',system-ui,Arial; margin:0 0 4px; }

.story-mini{
  display:grid; grid-template-columns: 92px 1fr; gap:12px; text-decoration:none; color:inherit;
  padding:10px; border-radius:12px; transition: background .18s, transform .18s, box-shadow .18s;
}
.story-mini:hover{ background:#fafafa; transform:translateY(-1px); box-shadow:0 10px 24px rgba(0,0,0,.06) }
.story-mini img{ width:92px; height:72px; object-fit:cover; border-radius:10px; background:#eee }
.story-meta{ font:300 12px/1.2 'Inter',system-ui,Arial; color:var(--muted) }
.story-title{ font-size: clamp(12px,1.5vw,15px); font-family:"Inter",sans-serif; font-weight:400; margin-bottom:6px; margin-top: 10px}

/* Tiny helpers */
.badge{ display:inline-flex; align-items:center; gap:6px; padding:5px 10px; color:var(--ink); border-radius:999px; font:500 15px/1 'Inter',system-ui,Arial }
.hr{ height:1px; background:var(--line); border:0; margin: 14px 0; }

/* --- Jarak antara HERO dan blok judul/meta --- */
.hero-media{
  /* full-bleed yang kemarin */
  width:90vw;
  margin-left:calc(50% - 45vw);
  margin-right:calc(50% - 45vw);

  /* 👉 tambahkan jarak bawah */
  margin-bottom: clamp(20px, 3.2vw, 56px);
}

/* Kalau hero-mu pakai <figure class="article-figure">, pakai ini juga */
.article-figure{
  margin-bottom: clamp(20px, 3.2vw, 56px) !important;
  /* opsional: reset margin lain supaya rapi */
  /* margin-top: 0; margin-left: 0; margin-right: 0; */
}

@media (max-width: 720px){
  .article-title{
    font-size: clamp(18px, 5.8vw, 25px);
    line-height: 1.2;
    text-align: center;
  }
  .meta-row{
    gap: 10px;
  }
  .story-mini{
    grid-template-columns: 76px 1fr;
  }
  .story-mini img{
    width: 76px; height: 60px;
  }
}

/* ================= Scroll Reveal (Detail Article) ================= */
/* Hide only when JS is enabled */
.js .reveal-y{ opacity:0; transform: translateY(18px); transition: opacity .3s cubic-bezier(.2,.7,.2,1), transform .3s cubic-bezier(.2,.7,.2,1); }
.js .reveal-x{ opacity:0; transform: translateX(18px); transition: opacity .3s cubic-bezier(.2,.7,.2,1), transform .3s cubic-bezier(.2,.7,.2,1); }
.js .reveal-stagger > *{ opacity:0; transform: translateY(14px); transition: opacity .3s cubic-bezier(.2,.7,.2,1), transform .3s cubic-bezier(.2,.7,.2,1); }

.is-visible{ opacity:1 !important; transform:none !important; }

/* Reduced motion: show everything without animation */
@media (prefers-reduced-motion: reduce){
  .reveal-y, .reveal-x, .reveal-stagger > *{ opacity:1 !important; transform:none !important; transition:none !important; }
}
</style>
<script>document.documentElement.classList.add('js');</script>

<section class="article-detail">
  <div class="container">

    <!-- HERO -->
    <header class="article-head">
      <figure class="hero-media reveal-y">
        <img src="{{ asset('photo/' . $article->photo) }}" alt="Sinemaku Day">
      </figure>

      <!-- <nav class="breadcrumbs">
        <a href="#">Home</a> <span class="sep">›</span>
        <a href="#">World</a>
      </nav> -->

      <h1 class="article-title reveal-y" data-reveal="0.06">{{ $article->judul }}</h1>

      <div class="meta-row reveal-y" data-reveal="0.12">
        <span class="meta-brand">Sinemaku Article</span>
        <span class="meta-dot">•</span>
        <span class="meta-item">by {{ $article->penulis }}</span>
        <span class="meta-dot">•</span>
        <span class="meta-item">{{ \Carbon\Carbon::parse($article->tgl_rilis)->format('d M Y') }}</span>
        <span class="meta-dot">•</span>

        {{-- <div class="meta-right">
          <button class="btn-share" title="Share to X" aria-label="Share to X">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.5 3h-3.1l-3 4.3L9.3 3H5.5l5 7.3L5 21h3.1l3.4-4.9 3.4 4.9H19l-5.3-7.6L18.5 3Z"/></svg>
          </button>
          <button class="btn-share" title="Share to Facebook" aria-label="Share to Facebook">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M13 22v-8h2.8l.4-3H13V9.1c0-.9.3-1.5 1.6-1.5H16V5.1c-.3 0-1.2-.1-2.2-.1-2.2 0-3.8 1.3-3.8 3.9V11H7v3h3v8h3Z"/></svg>
          </button>
          <button class="btn-share" title="Copy Link" aria-label="Copy link">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M3 12a5 5 0 0 1 5-5h4v2H8a3 3 0 0 0 0 6h4v2H8a5 5 0 0 1-5-5Zm8-3h5a5 5 0 1 1 0 10h-5v-2h5a3 3 0 1 0 0-6h-5V9Z"/></svg>
          </button>
        </div> --}}
      </div>
    </header>

    <!-- GRID -->
    <div class="article-grid">

      <!-- CONTENT -->
      <article class="article-content reveal-y" data-reveal="0.14">
        {!! $article->detail !!}
      </article>

      <!-- SIDEBAR -->
      <aside class="article-sidebar">
        <div class="widget reveal-y reveal-stagger" data-reveal="0.18">
          <div class="badge">Top Stories</div>

          @foreach ($all_article as $item)
            @if ($item->kategori == 'external')
              <a class="story-mini" href="{{ url($item->link) }}">
                <img src="{{ asset('photo/' . $item->photo) }}" alt="">
                <div>
                  <div class="story-title">{{ $item->judul }}</div>
                  <div class="story-meta">{{ \Carbon\Carbon::parse($item->tgl_rilis)->format('d M Y') }}</div>
                </div>
              </a>
            @else
              <a class="story-mini" href="{{ route('detail-articles', $item->slug) }}">
                <img src="{{ asset('photo/' . $item->photo) }}" alt="">
                <div>
                  <div class="story-title">{{ $item->judul }}</div>
                  <div class="story-meta">{{ \Carbon\Carbon::parse($item->tgl_rilis)->format('d M Y') }}</div>
                </div>
              </a>
            @endif
                
          @endforeach
        </div>
      </aside>

    </div>
  </div>
</section>
<script>
(function(){
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return; // no animation for reduce-motion
  const io = new IntersectionObserver((entries)=>{
    entries.forEach((e)=>{
      if(e.isIntersecting){
        const el = e.target;
        const delay = parseFloat(el.getAttribute('data-reveal')||'0');
        el.style.transitionDelay = delay ? delay+'s' : '';
        el.classList.add('is-visible');
        io.unobserve(el);
      }
    });
  },{
    root:null, threshold:0.16, rootMargin:'0px 0px -8% 0px'
  });

  document.querySelectorAll('.reveal-y, .reveal-x').forEach(el=>io.observe(el));

  // Stagger children of containers marked with .reveal-stagger
  document.querySelectorAll('.reveal-stagger').forEach(box=>{
    const kids = Array.from(box.children);
    kids.forEach((kid, i)=>{
      kid.style.transitionDelay = (parseFloat(box.getAttribute('data-reveal')||'0') + i*0.06) + 's';
      io.observe(kid);
    });
    // Also reveal the container itself if it also has reveal-y/x
    if(box.classList.contains('reveal-y')||box.classList.contains('reveal-x')) io.observe(box);
  });
})();
</script>
