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
    --line:#e6e6e6;
    --surface:#ffffff;

    /* layout */
    --mediaW: 460px;     /* lebar kolom gambar (desktop) */
    --ribbonW: 74px;     /* lebar pita vertikal kanan */
  }

  /* ===== Base (safe-area agar tidak nabrak navbar) ===== */
  .event-page{
    padding: clamp(88px, 11vh, 120px) 0 56px; /* top diberi ruang */
    color: var(--ink);
    background:#fff;
  }

  /* ===== Heading strip (tanpa tanggal di kanan) ===== */
  .event-list .section-heading{
    font:800 clamp(28px,3vw,36px)/1.08 Inter,system-ui;
    padding:18px clamp(16px,5vw,64px);
    margin:0 0 clamp(12px,1.2vw,18px);
  }

  /* ===== Grid ===== */
  .stories-grid{
    display:grid;
    grid-template-columns: 1fr;
    gap:30px; /* edge-to-edge antar kartu */
  }

  /* ============== CAREERS STYLES ============== */
  .careers{ background:#fff; padding: clamp(40px,6vw,72px) 0; margin-top: 40px;}
  .careers-wrap{ max-width: 1120px; margin:0 auto; padding:0 20px;}
  .judul-karir{
    font: 700 clamp(22px,3vw,36px)/1.08 "Libre Baskerville", serif;
    margin: 0 0 clamp(20px,3vw,28px);
  }

  /* Grid */
  .job-grid{
    display:grid;
    grid-template-columns: repeat(2, minmax(0,1fr));
    gap: 28px;
    margin-top: 30px;
  }
  @media (max-width: 920px){
    .job-grid{ grid-template-columns: 1fr; }
  }

  /* Card */
  .job-card{
    border:1px solid #eef0f3;
    border-radius: 12px;
    background:#fff;
    box-shadow: 0 6px 22px rgba(10,10,20,.05);
    padding: 22px;
    transition: box-shadow .2s ease, transform .08s ease;
  }
  .job-card:hover{ box-shadow:0 14px 36px rgba(10,10,20,.09); transform: translateY(-1px); }

  /* Header */
  .job-head{ display:flex; align-items:center; justify-content:space-between; gap: 12px; }
  .job-title{
    font: 700 20px/1.25 Inter, system-ui; color:#121316; margin:0;
  }
  .job-time{
    display:flex; align-items:center; gap:8px;
    color:#7b818c; font:500 13.5px/1 Inter, system-ui; white-space:nowrap;
  }
  .job-time svg{ width:18px; height:18px; color:#9aa0a6; }

  /* Meta & desc */
  .job-meta{ color:#5b606a; font:600 14px/1.6 Inter, system-ui; margin:6px 0 8px; }
  .job-desc{ color:#2b2f36; font: 400 14.5px/1.65 Inter, system-ui; margin:0 0 12px; }

  /* Tags */
  .job-tags{ display:flex; flex-wrap:wrap; gap:8px; margin-bottom: 14px; }
  .tag{
    display:inline-flex; align-items:center;
    padding:6px 10px; border-radius:8px;
    background:#f1f3f6; color:#475160; font:600 12.5px/1 Inter, system-ui;
  }
  .tag-green{ background:#e9f8ec; color:#149b43; }

  /* Footer */
  .job-foot{
    display:flex; align-items:center; justify-content:space-between; gap:12px;
    padding-top: 12px; border-top:1px solid #f0f1f3;
  }
  .job-location{
    display:flex; align-items:center; gap:8px; color:#5a6270; font:600 13.5px/1 Inter, system-ui;
  }
  .job-location svg{ width:18px; height:18px; color:#9aa0a6; }

  /* CTA */
  .job-cta{
    display:inline-flex; align-items:center; gap:10px;
    background:#f7f8fa; color:#0f1115; border:1px solid #eceef2;
    height:40px; padding:0 14px; border-radius:10px; font:700 12.5px/1 Inter, system-ui;
    text-decoration:none; text-transform:uppercase; letter-spacing:.3px;
    transition: background .2s ease, box-shadow .2s ease, transform .08s ease;
  }
  .job-cta svg{ width:18px; height:18px; }
  .job-cta:hover{ background:#fff; box-shadow:0 8px 20px rgba(10,10,20,.08); }
  .job-cta:active{ transform: translateY(1px); }

  /* ============== CASTING STYLES ============== */
  .castings{ background:#fff; padding: clamp(32px,4.5vw,56px) 0; }
  .castings-wrap{ max-width: 1120px; margin:0 auto; padding:0 20px; }
  .castings-title{
    font: 700 clamp(22px,3vw,36px)/1.08 "Libre Baskerville", serif;
    margin:0 0 clamp(18px,3vw,26px);
  }

  /* Card */
  .cast-card{
    position: relative;
    border:1px solid #eef0f3;
    border-radius: 12px;
    padding: 22px clamp(18px,2.8vw,24px);
    background:#fff;
    box-shadow: 0 6px 22px rgba(10,10,20,.05);
    margin-bottom: 20px;
  }
  .cast-card:hover{ box-shadow:0 14px 36px rgba(10,10,20,.09); }

  /* Header */
  .cast-head{ display:flex; align-items:center; justify-content:space-between; gap:12px; }
  .cast-title{ font:700 20px/1.25 Inter, system-ui; margin:0; color:#101316; }
  .cast-time{
    display:flex; align-items:center; gap:8px; color:#7b818c; font:500 13.5px/1 Inter, system-ui; white-space:nowrap;
  }
  .cast-time svg{ width:18px; height:18px; color:#9aa0a6; }

  /* Content */
  .cast-desc{ color:#2b2f36; font:400 14.5px/1.65 Inter, system-ui; margin:10px 0 12px; }

  .cast-project{
    margin-top: 10px;
    display:flex; align-items:center; gap:8px;
    color:#69707e; font:400 13.5px/1 Inter, system-ui; margin-bottom:10px;
  }
  .cast-project svg{ width:16px; height:16px; color:#a0a6af; }

  /* Chips */
  .cast-tags{ display:flex; flex-wrap:wrap; gap:10px; }
  .chip{
    background:#f2f5f9; color:#4f5a6a; border:1px solid #e6ebf2;
    font:600 12.5px/1 Inter, system-ui; padding:7px 10px; border-radius:8px;
    margin-top: 20px;
  }

  /* CTA button (right) */
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

  /* Responsive: move CTA under content on small screens */
  @media (max-width: 720px){
    .cast-cta{
      position: static; transform:none; margin-top:14px;
      display:inline-flex;
    }
  }

</style>
<!-- ============== CAREERS: OPEN POSITIONS ============== -->
<section class="careers" id="careers">
  <div class="careers-wrap">
    <h2 class="judul-karir">Open Positions</h2>

    <div class="job-grid">
      @foreach ($careers as $item)
          <article class="job-card">
            <header class="job-head">
              <h3 class="job-title">{{ $item->position }}</h3>
              <span class="job-time">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 7v5h4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.8"/></svg>
                {{ $item->created_at->diffForHumans() }}
              </span>
            </header>

            <div class="job-meta">{{ $item->tim }}</div>
            {{-- <p class="job-desc">
              {!! $item->detail !!}
            </p> --}}

            <div class="job-tags">
              <span class="tag tag-green">{{ $item->status }}</span>
              <span class="tag">{{ $item->tim }}</span>
            </div>

            <footer class="job-foot">
              <div class="job-location">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22s7-6.1 7-12a7 7 0 1 0-14 0c0 5.9 7 12 7 12Zm0-9a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" fill="currentColor"/></svg>
                {{ $item->location }}
              </div>
              <a class="job-cta" href="{{ route('detail-careers', $item->uuid) }}">
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
  <div class="castings-wrap">
    <h2 class="castings-title">Current Castings</h2>

    @foreach ($casting as $item)
        <article class="cast-card">
          <header class="cast-head">
            <h3 class="cast-title">{{ $item->pemeran }}</h3>
            <span class="cast-time">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 7v5h4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.8"/></svg>
              {{ $item->created_at->diffForHumans() }}
            </span>
          </header>

          {{-- <p class="cast-desc">
            {!! $item->detail !!}
          </p> --}}

          <div class="cast-project">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 3h12a2 2 0 0 1 2 2v13l-4-2-4 2-4-2-4 2V5a2 2 0 0 1 2-2Z" fill="currentColor"/></svg>
            {{ $item->judul_film }}
          </div>

          <div class="cast-tags">
            <span class="chip">{{ $item->gender }}</span>
            <span class="chip">{{ $item->umur }} years</span>
            <span class="chip">{{ $item->location }}</span>
          </div>

          <a class="cast-cta" href="{{ route('detail-careers', $item->uuid) }}">
            SEE DETAILS
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </article>
    @endforeach
  </div>
</section>
