@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')
<style>
  /* ===== Global page background putih ===== */
  html, body { background:#fff; color:#0A0A0A; }

  /* ---------- NAVBAR (tetap) ---------- */


  :root{
    --ink:#0A0A0A;
    --muted:#6b7280;
    --line:#e6e6e6;
    --surface:#ffffff;
    --mediaW: 460px;
    --ribbonW: 74px;
  }

  /* ===== Base spacing (safe area) ===== */
  .event-page{
    padding: clamp(88px, 11vh, 120px) 0 56px;
    color: var(--ink);
    background:#fff; /* putih */
  }

  .event-list .section-heading{
    font:800 clamp(28px,3vw,36px)/1.08 Inter,system-ui;
    padding:18px clamp(16px,5vw,64px);
    margin:0 0 clamp(12px,1.2vw,18px);
  }

  .stories-grid{ display:grid; grid-template-columns: 1fr; gap:30px; }

  /* ============== CAREERS STYLES ============== */
  .careers{ background:#fff; padding: clamp(40px,6vw,72px) 0; margin-top: 40px;}
  .careers-wrap{ max-width: 1120px; margin:0 auto; padding:0 20px;}
  .judul-karir{
    font: 700 clamp(20px,3vw,30px)/1.08 "Inter", system-ui, sans-serif;
    margin: 0 0 clamp(20px,3vw,28px);
  }

  .job-grid{ display:grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 28px; margin-top: 30px; }
  @media (max-width: 920px){ .job-grid{ grid-template-columns: 1fr; } }

  .job-card{
    border:1px solid #eef0f3; border-radius: 12px; background:#fff;
    box-shadow: 0 6px 22px rgba(10,10,20,.05);
    padding: 22px; transition: box-shadow .2s ease, transform .08s ease;
  }
  .job-card:hover{ box-shadow:0 14px 36px rgba(10,10,20,.09); transform: translateY(-1px); }

  .job-head{ display:flex; align-items:center; justify-content:space-between; gap: 12px; }
  .job-title{ font: 700 20px/1.25 Inter, system-ui; color:#121316; margin:0; }
  .job-time{ display:flex; align-items:center; gap:8px; color:#7b818c; font:500 13.5px/1 Inter, system-ui; white-space:nowrap; }
  .job-time svg{ width:18px; height:18px; color:#9aa0a6; }

  .job-meta{ color:#5b606a; font:600 14px/1.6 Inter, system-ui; margin:6px 0 8px; }
  .job-desc{ color:#2b2f36; font: 400 14.5px/1.65 Inter, system-ui; margin:0 0 12px; }

  .job-tags{ display:flex; flex-wrap:wrap; gap:8px; margin-bottom: 14px; }
  .tag{ display:inline-flex; align-items:center; padding:6px 10px; border-radius:8px; background:#f1f3f6; color:#475160; font:600 12.5px/1 Inter, system-ui; }
  .tag-green{ background:#e9f8ec; color:#149b43; }

  .job-foot{ display:flex; align-items:center; gap:10px; padding-top:12px; border-top:1px solid #f0f1f3; flex-wrap:nowrap; }
  .job-location{ display:flex; align-items:center; gap:8px; color:#5a6270; font:600 13.5px/1 Inter, system-ui; flex:1 1 auto; min-width:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
  .job-location svg{ width:18px; height:18px; flex:0 0 18px; color:#9aa0a6; }
  
  .job-cta{
    display:inline-flex; align-items:center; gap:10px;
    background:#f7f8fa; color:#0f1115; border:1px solid #eceef2;
    height:40px; padding:0 14px; border-radius:10px; font:700 12.5px/1 Inter, system-ui;
    text-decoration:none; text-transform:uppercase; letter-spacing:.3px;
    transition: background .2s ease, box-shadow .2s ease, transform .08s ease;
    white-space:nowrap;            /* keep on one line */
    flex:0 0 auto;                 /* prevent shrinking */
  }
  .job-cta svg{ width:18px; height:18px; }
  .job-cta:hover{ background:#fff; box-shadow:0 8px 20px rgba(10,10,20,.08); }
  .job-cta:active{ transform: translateY(1px); }
  .job-cta{ margin-left:auto; }

  @media (max-width: 480px){
    .job-cta{ height:36px; padding:0 12px; gap:8px; font:700 11.5px/1 Inter, system-ui; letter-spacing:.2px; }
    .job-cta svg{ width:16px; height:16px; }
    .job-foot{ gap:8px; }
    .job-location{ max-width: 60%; }
  }
  /* ============== CASTING STYLES ============== */
  .castings{ background:#fff; padding: clamp(32px,4.5vw,56px) 0; }
  .castings-wrap{ max-width: 1120px; margin:0 auto; padding:0 20px; overflow-y: auto; max-height: calc(4 * 120px);}
  .castings-title{
    font: 700 clamp(20px,3vw,30px)/1.08 "Inter", system-ui, sans-serif;
    margin:0 0 clamp(18px,3vw,26px);
    margin-left: 200px;
  }
  @media (max-width: 720px){
    .castings-title{
      margin-left: 20px;
    }
  }
  @media (min-width: 721px) and (max-width: 1120px){
    .castings-title{ margin-left: 20px; }
  }

  .cast-card{
    position: relative; border:1px solid #eef0f3; border-radius: 12px;
    padding: 22px clamp(18px,2.8vw,24px); background:#fff;
    box-shadow: 0 6px 22px rgba(10,10,20,.05); margin-bottom: 20px;
  }
  .cast-card:hover{ box-shadow:0 14px 36px rgba(10,10,20,.09); }

  .cast-head{ display:flex; align-items:center; justify-content:space-between; gap:12px; }
  .cast-title{ font:700 20px/1.25 Inter, system-ui; margin:0; color:#101316; }
  .cast-time{ display:flex; align-items:center; gap:8px; color:#7b818c; font:500 13.5px/1 Inter, system-ui; white-space:nowrap; }
  .cast-time svg{ width:18px; height:18px; color:#9aa0a6; }

  .cast-desc{ color:#2b2f36; font:400 14.5px/1.65 Inter, system-ui; margin:10px 0 12px; }
  .cast-project{ margin-top: 10px; display:flex; align-items:center; gap:8px; color:#69707e; font:400 13.5px/1 Inter, system-ui; margin-bottom:10px; }
  .cast-project svg{ width:16px; height:16px; color:#a0a6af; }

  .cast-tags{
    display:flex;
    flex-wrap:wrap;
    gap:8px 10px;
    margin-top: 8px;
  }
  .chip{
    background:#f2f5f9; color:#4f5a6a; border:1px solid #e6ebf2;
    font:600 12.5px/1 Inter, system-ui; padding:7px 10px; border-radius:8px; margin-top: 0;
  }

  @media (max-width: 720px){
    .cast-card{
      padding: 18px 16px;
    }
    .cast-project{
      margin: 6px 0 6px;
      font-size: 13px;
    }
    .cast-tags{
      display:flex;
      flex-wrap:wrap;
      gap:8px;              /* compact spacing */
    }
    .chip{
      padding: 6px 10px;
      font-size: 12px;
      flex:0 0 auto;          /* prevent stretching; width = content */
      width:auto;
    }
    .cast-cta{
      position: static;
      transform: none;
      margin-top: 12px;
      width: 100%;
      justify-content: center;
    }
  }

  .cast-cta{
    position:absolute; right: clamp(18px,2.8vw,24px); top: 75%; transform: translateY(-50%);
    display:inline-flex; align-items:center; gap:10px; height:40px; padding:0 14px;
    border-radius:10px; background:#f7f8fa; color:#0f1115; border:1px solid #eceef2;
    font:800 12.5px/1 Inter, system-ui; text-decoration:none; letter-spacing:.35px;
    transition: background .2s ease, box-shadow .2s ease, transform .08s ease;
  }
  .cast-cta svg{ width:18px; height:18px; }
  .cast-cta:hover{ background:#fff; box-shadow:0 8px 20px rgba(10,10,20,.08); }
  .cast-cta:active{ transform: translate(0,-49%); }

  @media (max-width: 720px){
    .cast-cta{ position: static; transform:none; margin-top:14px; display:inline-flex; }
  }
  /* ===== Scroll-reveal cinematic animations (careers & castings) ===== */
  .reveal{opacity:0; transform:translateY(18px); transition:opacity .68s cubic-bezier(.2,.7,.2,1), transform .68s cubic-bezier(.2,.7,.2,1), filter .68s cubic-bezier(.2,.7,.2,1); will-change:opacity,transform,filter;}
  .reveal.is-inview{opacity:1; transform:none; filter:none;}
  /* optional stagger: each element can get a CSS var --d (delay) */
  .reveal{ transition-delay: var(--d, 0ms); }
  /* Respect reduced motion */
  @media (prefers-reduced-motion: reduce){
    .reveal{ opacity:1 !important; transform:none !important; filter:none !important; transition:none !important; }
  }
  .reveal-m,
.reveal-y,
.reveal-x {
  opacity: 1 !important;
  transform: none !important;
  transition: none !important;
}
</style>

<!-- ============== CAREERS: OPEN POSITIONS ============== -->
<section class="careers" id="careers">
  <div class="careers-wrap">
    <h2 class="judul-karir reveal">Open Positions</h2>

    <div class="job-grid">
      @foreach ($careers as $item)
        <article class="job-card reveal">
          <header class="job-head">
            <h3 class="job-title">{{ $item->position }}</h3>
            <span class="job-time">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 7v5h4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.8"/></svg>
              {{ $item->created_at->diffForHumans() }}
            </span>
          </header>

          <div class="job-meta">{{ $item->tim }}</div>

          <div class="job-tags">
            <span class="tag tag-green">{{ $item->status }}</span>
            <span class="tag">{{ $item->tim }}</span>
          </div>

          <footer class="job-foot">
            <div class="job-location">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22s7-6.1 7-12a7 7 0 1 0-14 0c0 5.9 7 12 7 12Zm0-9a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" fill="currentColor"/></svg>
              {{ $item->location }}
            </div>
            <a class="job-cta" href="{{ route('detail-careers', $item->slug) }}">
              See Details
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
          </footer>
        </article>
      @endforeach
    </div>
  </div>
</section>

<!-- ============== CASTING: CURRENT CASTINGS ============== -->
<section class="castings" id="castings">
  <h2 class="castings-title reveal">Current Castings</h2>
  <div class="castings-wrap">
    @foreach ($casting as $item)
      <article class="cast-card reveal">
        <header class="cast-head">
          <h3 class="cast-title">{{ $item->pemeran }}</h3>
          <span class="cast-time">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 7v5h4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.8"/></svg>
            {{ $item->created_at->diffForHumans() }}
          </span>
        </header>

        <div class="cast-project">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 3h12a2 2 0 0 1 2 2v13l-4-2-4 2-4-2-4 2V5a2 2 0 0 1 2-2Z" fill="currentColor"/></svg>
          {{ $item->judul_film }}
        </div>

          <div class="cast-tags">
            <span class="chip">{{ $item->gender == 'L' ? 'Pria' : 'Wanita' }}</span>
            <span class="chip">{{ $item->umur }} years</span>
            <span class="chip">{{ $item->location }}</span>
          </div>

        <a class="cast-cta" href="{{ route('detail-careers', $item->slug) }}">
          SEE DETAILS
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </article>
    @endforeach
  </div>
</section>
<script>
(function(){
  // Observer to toggle .is-inview
  const io = ('IntersectionObserver' in window) ? new IntersectionObserver((entries)=>{
    entries.forEach((e)=>{
      if(e.isIntersecting){
        e.target.classList.add('is-inview');
        io.unobserve(e.target);
      }
    });
  }, {root:null, rootMargin:'0px 0px -10% 0px', threshold:0.08}) : null;

  // Collect all revealable elements
  const reveals = Array.from(document.querySelectorAll('.reveal'));

  // Stagger per group (job cards & cast cards)
  const jobs = Array.from(document.querySelectorAll('.job-card.reveal'));
  jobs.forEach((el, i)=> el.style.setProperty('--d', (120 + i*80) + 'ms'));

  const casts = Array.from(document.querySelectorAll('.cast-card.reveal'));
  casts.forEach((el, i)=> el.style.setProperty('--d', (120 + i*80) + 'ms'));

  // Headings: a little sooner
  const heads = Array.from(document.querySelectorAll('.judul-karir.reveal, .castings-title.reveal'));
  heads.forEach((el)=> el.style.setProperty('--d', '40ms'));

  // Observe or enable immediately if no IO
  reveals.forEach((el)=>{
    if(io){ io.observe(el); }
    else{ el.classList.add('is-inview'); }
  });
})();
</script>