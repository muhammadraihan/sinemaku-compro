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
    .title{
    margin: 0 0 36px;
    font-family: 'Inter', Arial, sans-serif;
    font-weight: 300;
    line-height: .95;
    color: #0d0d0d;
    /* ukuran fleksibel: kecil di mobile, besar di desktop */
    font-size: 25px;
    letter-spacing: -0.5px;
    margin-top: 100px;
    margin-left: 55px;
    }
    .feature-text{
    margin-top: 300px;
    }
    .feature-title{
    margin: 0 0 36px;
    font-family: 'Inter', Arial, sans-serif;
    font-weight: 300;
    line-height: .95;
    color: #0d0d0d;
    /* ukuran fleksibel: kecil di mobile, besar di desktop */
    font-size: clamp(40px, 6vw, 112px);
    letter-spacing: -0.5px;
    }
    .feature-media-frame2{
    position: relative;
    background: #f1f1f1;
    border-radius: 8px;
    /* bingkai tipis seperti mockup */
    box-shadow:
        0 0 0 10px #fff inset,      /* inner white mat */
        0 1px 0 0 #e5e5e5 inset;    /* garis tipis abu-abu */
    padding: 10px;                /* jarak ke gambar */
    }
    .feature-media-frame2::before{
    /* memberi proporsi landscape stabil mirip screenshot */
    content:"";
    display:block;
    aspect-ratio: 9/12  ;
    }
    .feature-media-frame2 > img{
    position: absolute;
    inset: 10px;                  /* sejajar dengan padding container */
    width: calc(100% - 20px);
    height: calc(100% - 20px);
    object-fit: cover;            /* penuh, seperti contoh */
    border-radius: 4px;
    }
    /* pastikan frame di atas “kertas” abu-abu */
    .feature-media-frame2{
    position: relative;
    z-index: 1;
    transition: transform .45s cubic-bezier(.22,.61,.36,1),
                box-shadow .45s cubic-bezier(.22,.61,.36,1);
    /* box-shadow inset yg sudah kamu punya tetap jalan;
        ini menambah drop shadow lembut saat hover */
    }

    /* animasi gambar di dalam frame */
    .feature-media-frame2 > img{
    transition: transform .55s cubic-bezier(.22,.61,.36,1);
    will-change: transform;
    }

    /* efek saat hover: frame sedikit terangkat + gambar zoom ringan,
    “kertas” abu-abu ikut bergeser untuk memberi rasa depth */
    .feature-media:hover .feature-media-frame2{
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(0,0,0,.16), 0 6px 16px rgba(0,0,0,.08);
    }

    .feature-media:hover .feature-media-frame2 > img{
    transform: scale(1.035);
    }

    .feature-media:hover::before{
    transform: translate(16px,16px); /* offset abu-abu sedikit bertambah */
    }


    /* ====== Responsive ====== */
    @media (max-width: 1200px){
    .feature-wrap{
        grid-template-columns: 1fr; /* stack */
        gap: 32px;
    }
    .feature-title{ margin-bottom: 24px; }
    .feature-media-frame2::before{ aspect-ratio: 16/9; }
    }
    @media (max-width: 640px){
    .feature-sidetext{ padding: 28px 20px 52px; }
    .feature-cta .cta-label{ font-size: 18px; }
    .feature-cta .cta-line{ width: 64px; }
    }

    /* ===== All Films ===== */
    .allfilms{
    max-width: 1360px;
    margin: 24px auto 96px;
    padding: 0 24px;
    }

    .allfilms-head{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:16px;
    margin-bottom: 18px;
    }
    .allfilms-title{
      font: 400 18px/1.35 Inter,Arial,sans-serif;
      letter-spacing:.0px; margin:0;
    }

    .allfilms-filters{ display:flex; gap:10px; flex-wrap:wrap; padding-top:10px; }
    .chip{
    border:1px solid rgba(0,0,0,.12);
    background:#f5f6f7;
    color:#111;
    font: 300 14px/1 Inter, Arial, sans-serif;
    padding:8px 14px;
    border-radius:10px;
    cursor:pointer;
    transition: all .2s ease;
    }
    .chip:hover{ background:#eceff1; }
    .chip.is-active{
    background:#111;
    color:#fff;
    border-color:#111;
    }

    .allfilms-grid{
    display:grid;
    grid-template-columns: repeat(5, minmax(0,1fr));
    gap: 34px 28px;
    margin-top: 16px;
    }
    @media (max-width: 1200px){
    .allfilms-grid{ grid-template-columns: repeat(3, minmax(0,1fr)); }
    }
    @media (max-width: 800px){
    .allfilms-title{ font-size: 44px; }
    .allfilms-grid{ grid-template-columns: repeat(2, minmax(0,1fr)); }
    }
    @media (max-width: 520px){
    .allfilms-grid{ grid-template-columns: 1fr; }
    }

    /* Card */
    .filmitem-link{ text-decoration:none; color:inherit; display:block; }
    .filmitem-media{
    position:relative;
    /* aspect-ratio: 9/12  ; */
    margin-left: 1px;
    width: 250px;
    height: 400px;
    overflow:hidden;
    border-radius: 12px;
    background:#111;
    box-shadow: 0 14px 28px rgba(0,0,0,.06);
    transition: transform .35s cubic-bezier(.2,.7,.2,1), box-shadow .35s;
    }
    .filmitem-media img{
    width:100%; 
    height:100%;
    object-fit:cover; 
    display:block;
    transform: scale(1.02);
    transition: transform .6s cubic-bezier(.18,.72,.18,1);
    }

    .filmitem-link:hover .filmitem-media{
    transform: translateY(-4px);
    box-shadow: 0 28px 50px rgba(0,0,0,.12);
    }
    .filmitem-link:hover .filmitem-media img{ transform: scale(1.06); }

    /* Optional overlay info */
    .filmitem-media.has-overlay .film-badge{
    position:absolute; left:12px; top:12px;
    background: rgba(17,17,17,.82);
    color:#fff; font:600 12px/1 Inter,Arial,sans-serif;
    letter-spacing:.05em;
    padding:7px 10px; border-radius:8px;
    }
    .filmitem-media.has-overlay .film-rate{
    position:absolute; right:12px; top:12px;
    background: #fff; color:#111;
    font:700 12px/1 Inter,Arial,sans-serif;
    padding:7px 10px; border-radius:8px;
    }
    .filmitem-media.has-overlay .film-play{
    position:absolute; left:14px; bottom:14px;
    width:36px; height:36px; border-radius:50%;
    display:grid; place-items:center;
    background: rgba(255,255,255,.92);
    color:#111; font-weight:700;
    transition: transform .2s ease;
    }
    .filmitem-link:hover .film-play{ transform: scale(1.07); }

    .filmitem-media.has-overlay .film-dir{
    position:absolute; right:12px; bottom:12px;
    color:#fff; font:500 12px/1.2 Inter,Arial,sans-serif;
    text-shadow: 0 1px 5px rgba(0,0,0,.45);
    }

    /* Caption */
    .filmitem-caption{ margin-top: 12px; }
    .filmitem-title{
      margin:0 0 4px; font:600 13px/1.2 Inter,system-ui; color:#111; letter-spacing:.02em;  text-transform: uppercase;
    }
    .filmitem-year{ color:#444; font: 300 11px/1 Inter,Arial,sans-serif; }

    /* Hide when filtered */
    .filmitem.is-hidden{ display:none; }

    /* ===== Overlay detail pada hover ===== */
    .filmitem-media.has-overlay { position: relative; }

    /* Lapisan gradasi + wadah teks */
    .film-detail{
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    gap: 6px;
    padding: 16px;
    /* gradasi dari bawah ke atas supaya teks terbaca */
    background: linear-gradient(
        to top,
        rgba(0,0,0,.78) 12%,
        rgba(0,0,0,.35) 46%,
        rgba(0,0,0,.08) 70%,
        rgba(0,0,0,0) 100%
    );
    /* start state: sedikit turun + transparan */
    opacity: 0;
    transform: translateY(10px);
    transition:
        opacity .36s cubic-bezier(.2,.7,.2,1),
        transform .36s cubic-bezier(.2,.7,.2,1);
    pointer-events: none; /* biar klik tetap tembus ke link */
    }

    /* baris teks di dalam overlay */
    .film-detail-row{
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 8px 10px;
    align-items: baseline;
    }
    .film-detail-label{
    color: rgba(255,255,255,.78);
    font: 300 11px/1 Inter, Arial, sans-serif;
    letter-spacing: .08em;
    text-transform: uppercase;
    }
    .film-detail-value{
    color: #fff;
    font: 300 14px/1.25 Inter, Arial, sans-serif;
    }

    /* Tampilkan saat hover (desktop/hover devices) */
    @media (hover: hover) and (pointer: fine){
    .filmitem-link:hover .film-detail{
        opacity: 1;
        transform: translateY(0);
    }

    /* kalau ada badge & rating, ikut halus juga */
    .filmitem-link .film-badge,
    .filmitem-link .film-rate{
        transform: translateY(-6px);
        opacity: 0;
        transition: opacity .25s ease, transform .25s ease;
    }
    .filmitem-link:hover .film-badge,
    .filmitem-link:hover .film-rate{
        transform: translateY(0);
        opacity: 1;
    }
    }

    @media (hover: none){
    /* Mobile/touch: HIDE overlay completely */
    .film-detail{ display: none !important; }
    }

    /* Sedikit responsif untuk density konten */
    @media (max-width: 520px){
    .film-detail{ padding: 14px; gap: 4px; }
    .film-detail-value{ font-size: 13px; }
    .film-detail-label{ font-size: 10px; }
    }

    /* ====================== A24-style overlay ====================== */
/* 1) Kartu: pakai rasio 2:3 & full width cell */
.allfilms-grid .filmitem-media{
  width: 100% !important;
  height: auto !important;
  aspect-ratio: 2 / 3;
  margin: 0;
  border-radius: 12px;
  overflow: hidden;
  position: relative;
}
.allfilms-grid .filmitem-media img{
  width: 100%; height: 100%; object-fit: cover; display: block;
  transform: scale(1.02);
  transition: transform .6s cubic-bezier(.18,.72,.18,1);
}

/* 2) Gradient gelap seluruh poster (muncul saat hover desktop) */
.allfilms-grid .filmitem-media::before{
  content:"";
  position:absolute; inset:0;
  background: rgba(0,0,0,.34);   /* tingkat dasar */
  opacity: 0;                    /* default non-hover */
  transition: opacity .36s cubic-bezier(.2,.7,.2,1);
  pointer-events: none;
  z-index: 0;
}
.allfilms-grid .filmitem-media::after{
  content:"";
  position:absolute; inset:0;
  background: linear-gradient(
    to top,
    rgba(0,0,0,.55) 0%,
    rgba(0,0,0,.22) 38%,
    rgba(0,0,0,.22) 62%,
    rgba(0,0,0,.72) 100%
  );
  opacity: 0;
  transition: opacity .36s cubic-bezier(.2,.7,.2,1);
  pointer-events: none;
}
/* Saat hover: keduanya aktif → efek gelap merata + tebal di tepi */
.allfilms-grid .filmitem:hover .filmitem-media::before{ opacity: 1; }
.allfilms-grid .filmitem:hover .filmitem-media::after { opacity: 1; }

/* (Opsional) mobile: selalu sedikit gelap agar teks terbaca */
@media (max-width: 768px){
  .allfilms-grid .filmitem-media::before{ opacity: .35; }
  .allfilms-grid .filmitem-media::after { opacity: .8;  }
}

/* (Opsional) respect reduced motion */
@media (prefers-reduced-motion: reduce){
  .allfilms-grid .filmitem-media::before,
  .allfilms-grid .filmitem-media::after{ transition: none; }
}

/* 3) Blok teks kiri-atas (bukan panel rounded) */
.film-detail{
  position: absolute;
  top: clamp(24px, 14%, 84px);          /* posisi vertikal ala A24 */
  left: clamp(16px, 2.6vw, 32px);
  right: auto; bottom: auto;
  max-width: min(72%, 540px);
  z-index: 2;

  /* tampilkan sebagai daftar blok, bukan grid 2 kolom */
  display: grid;
  grid-template-columns: 1fr;
  gap: clamp(10px, 1.6vw, 18px);

  padding: 0;                          /* tidak ada kotak/panel */
  background: none !important;
  border: 0 !important;
  border-radius: 0 !important;
  backdrop-filter: none !important;
  box-shadow: none !important;

  /* animasi muncul */
  opacity: 0;
  transform: translateY(8px);
  transition: opacity .36s cubic-bezier(.2,.7,.2,1),
              transform .36s cubic-bezier(.2,.7,.2,1);
  pointer-events: none;                 /* klik tetap ke link kartu */
}
@media (hover:hover) and (pointer:fine){
  .filmitem-link:hover .film-detail{
    opacity: 1;
    transform: translateY(0);
  }
}
@media (hover:none){
  .film-detail{ opacity: 1; transform: none; }
}

/* 4) Tipografi label & value ala A24 */
.film-detail-row{ display: block; }    /* label di atas value */
.film-detail-label{
  display:block;
  color: rgba(255,255,255,.68);
  font: 600 clamp(12px,.8vw,12px)/1.15 Inter, Arial, sans-serif;
  letter-spacing: .08em;
  text-transform: uppercase;
  margin-bottom: clamp(4px,.5vw,6px);
}
.film-detail-value{
  display:block;
  color:#fff;
  font: 500 clamp(14px,1.25vw,14px)/1.35 Inter, Arial, sans-serif;
  text-shadow: 0 1px 2px rgba(0,0,0,.25);
  word-break: break-word;              /* nama pemain panjang aman */
}
/* nilai pertama (tanggal rilis) sedikit lebih tebal */
.film-detail .film-detail-row:nth-of-type(1) .film-detail-value{ font-weight: 650; }

/* 5) Badge & rating tetap smooth */
@media (hover:hover) and (pointer:fine){
  .filmitem-link .film-badge, .filmitem-link .film-rate{
    transform: translateY(-6px);
    opacity: 0;
    transition: opacity .25s ease, transform .25s ease;
  }
  .filmitem-link:hover .film-badge, .filmitem-link:hover .film-rate{
    transform: translateY(0);
    opacity: 1;
  }
}

/* 6) Grid responsif (opsional biar mirip spacing A24) */
.allfilms-grid{ grid-template-columns: repeat(4, minmax(0,1fr)); }
@media (max-width:1200px){ .allfilms-grid{ grid-template-columns: repeat(3,1fr); } }
@media (max-width:800px){  .allfilms-grid{ grid-template-columns: repeat(2,1fr); } }
@media (max-width:520px){  .allfilms-grid{ grid-template-columns: 1fr; } }

/* ---- tempatkan overlay di atas gambar, di bawah teks ---- */
.allfilms-grid .filmitem-media{
  position: relative;
  isolation: isolate; /* bikin stacking context sendiri */
}

/* Layer gelap merata */
.allfilms-grid .filmitem-media::before{
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,.35); /* dasar */
  opacity: 0;                  /* desktop: muncul saat hover */
  z-index: 1;                  /* di atas IMG, di bawah teks */
  transition: opacity .36s cubic-bezier(.2,.7,.2,1);
}

/* Gradient dari bawah ke atas */
.allfilms-grid .filmitem-media::after{
  content:"";
  position:absolute; inset:0;
  background: linear-gradient(
    to top,
    rgba(0,0,0,.82) 18%,
    rgba(0,0,0,.40) 46%,
    rgba(0,0,0,.08) 70%,
    rgba(0,0,0,0) 100%
  );
  opacity: 0;                 /* desktop: muncul saat hover */
  z-index: 1;
  transition: opacity .36s cubic-bezier(.2,.7,.2,1);
  pointer-events: none;
}

/* Teks overlay tetap di atas overlay */
.film-detail, .film-badge, .film-rate{ z-index: 2; }

/* Hover (device dengan hover) */
@media (hover:hover) and (pointer:fine){
  .filmitem-link:hover .filmitem-media::before{ opacity: .45; } /* gelap merata */
  .filmitem-link:hover .filmitem-media::after{  opacity: 1;    } /* + gradient */
  /* opsional: tambah sedikit gelap dari gambar */
  .filmitem-link:hover .filmitem-media img{ filter: brightness(.65) contrast(1.02); }
}

/* Perangkat sentuh: jangan tampilkan layer gelap */
@media (hover:none){
  .allfilms-grid .filmitem-media::before,
  .allfilms-grid .filmitem-media::after{ opacity: 0 !important; }
}

.filmitem.is-hidden{ display:none !important; }

/* ===================== Mobile-first responsive refinements (Films) ===================== */
@media (max-width: 680px){
  /* Page title spacing */
  .title{
    margin-left: 16px;
    margin-top: 72px;
    margin-bottom: 2px;
    font-size: 20px;
  }

  /* Spotlight (COMING SOON) – tighter & stacked */
  .feature-sidetext{ padding: 12px 14px 18px; }
  .feature-wrap{ grid-template-columns: 1fr; gap: 12px; }
  .feature-text{ margin-top: 0; }
  .feature-title{ font-size: clamp(24px, 7.2vw, 32px); margin: 0 0 6px; line-height: 1.05; }
  /* tighter CTA + year next to title on small screens */
  .feature-title .feature-eyebrow{ margin-left: 8px; font-size: 14px; position: relative; top: -2px; }
  .feature-cta{ margin-top: 6px; }
  .feature-cta .cta-line{ width: 44px; }
  .feature-media-frame2{ padding: 4px; border-radius: 8px; }
  .feature-media-frame2::before{ aspect-ratio: 16/9; }

  /* Section container & header */
  .allfilms{
    padding: 0 16px;
    margin: 12px auto 40px;
  }
  .allfilms-head{
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 8px;
  }
  .allfilms-title{ font-size: 14px; }

  /* Chips: horizontal scroll on small screens */
  .allfilms-filters{
    width: 100%;
    gap: 8px;
    padding-top: 4px;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
    white-space: nowrap;
  }
  .allfilms-filters::-webkit-scrollbar{ display:none; }
  .chip{
    font-size: 12px;
    padding: 7px 10px;
    flex: 0 0 auto;       /* keep width tight for scroll */
    border-radius: 9px;
  }

  /* Grid: 2 columns → 1 column on very small devices */
  .allfilms-grid{
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 14px 12px;
    margin-top: 10px;
  }
  @media (max-width: 420px){
    .allfilms-grid{ grid-template-columns: 1fr; }
  }

  /* Card media & caption */
  .filmitem-caption{ margin-top: 8px; }
  .filmitem-title{ font: 600 13px/1.3 Inter, Arial, sans-serif; }
  .filmitem-year{ font-size: 10.5px; }

  /* Overlay on mobile: hidden for cleaner cards */
  .film-detail{ display: none !important; }
  .allfilms-grid .filmitem-media::before,
  .allfilms-grid .filmitem-media::after{ opacity: 0 !important; }
}
/* Extra-small tweaks */
@media (max-width: 360px){
  .chip{ padding: 6px 9px; font-size: 11px; }
  .filmitem-title{ font-size: 12.5px; }
}
</style>
{{-- ================== SECTION SPOTLIGHT ================== --}}
<h3 class="title">COMING SOON</h3>
@foreach ($coming_soon as $i => $item)
    @if($loop->odd)
        <section class="feature-sidetext" id="podcast">
          <div class="feature-wrap">
              <!-- Kolom Kiri: Teks -->
              <div class="feature-text">
              {{-- <div class="feature-eyebrow">SHOP</div> --}}
              <h2 class="feature-title">
                  {{ $item->title }} <span class="feature-eyebrow">{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}</span></h2>

              <a href="{{ route('detail-film', $item->slug) }}" class="feature-cta" aria-label="Detail">
                  <span class="cta-line" aria-hidden="true"></span>&nbsp;
                  <span class="cta-label">DETAIL</span>
              </a>
              </div>

              <!-- Kolom Kanan: Media -->
              <a href="{{ route('detail-film', $item->slug) }}" class="feature-media">
              <div class="feature-media-frame2">
                  <img
                  src="{{ asset('photo/' . $item->poster) }}"
                  alt="{{ $item->title }}">
              </div>
              </a>
          </div>
      </section>
    @else
        <section class="feature-sidetext" id="podcast">
          <div class="feature-wrap">
              <!-- Foto -->
              <a href="{{ route('detail-film', $item->slug) }}" class="feature-media">
                  <div class="feature-media-frame2">
                      <img src="{{ asset('photo/' . $item->poster) }}" alt="Creative Affair">
                  </div>
              </a>
              <!-- Teks -->
              <div class="feature-text">
                  <h2 class="feature-title">{{ $item->title }} <span class="feature-eyebrow">{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}</span></h2>
                  <a href="{{ route('detail-film', $item->slug) }}" class="feature-cta" aria-label="Detail">
                      <span class="cta-line" aria-hidden="true"></span>&nbsp;
                      <span class="cta-label">DETAIL</span>
                  </a>
              </div>
          </div>
      </section>
    @endif
@endforeach

{{-- ================== SECTION ALL FILMS ================== --}}
<section class="allfilms">
  <div class="allfilms-head">
    <h2 class="allfilms-title">All Films</h2>

    <div class="allfilms-filters" role="tablist" aria-label="Filter films by genre">
      <button class="chip is-active" data-filter="all" role="tab" aria-selected="true">All</button>
      {{-- @foreach ($genre as $item)
        <button class="chip" data-filter="{{ strtolower(trim($item->genre)) }}" role="tab">{{ $item->genre }}</button>
      @endforeach --}}
      @foreach ($chipGenres as $g)
        <button class="chip" data-filter="{{ $g }}">{{ ucwords($g) }}</button>
      @endforeach
    </div>
  </div>

  <div class="allfilms-grid">
    @foreach ($genre as $item)
      <article class="filmitem" data-genres='@json($item->genres_array)'>
        {{-- <article class="filmitem" data-genre="{{ strtolower($item->genre) }}"> --}}
          <a href="{{ route('detail-film', $item->slug) }}" class="filmitem-link">
              <figure class="filmitem-media has-overlay">
              <img src="{{ asset('photo/' . $item->poster) }}"
                  alt="{{ $item->title }}" loading="lazy">

              <!-- badge/rate opsional (boleh dihapus kalau tidak dipakai) -->
              <span class="film-badge">{{ $item->genre }}</span>

              <!-- DETAIL OVERLAY (baru) -->
              <div class="film-detail">
                  <div class="film-detail-row">
                  <span class="film-detail-label">RELEASE DATE</span>
                  <span class="film-detail-value">{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}</span>
                  </div>
                  <div class="film-detail-row">
                  <span class="film-detail-label">WRITTEN & DIRECTED BY</span>
                  <span class="film-detail-value">{{ $item->director }}</span>
                  </div>
                  <div class="film-detail-row">
                  <span class="film-detail-label">STARRING</span>
                  <span class="film-detail-value">{{ $item->cast }}</span>
                  </div>
              </div>
              </figure>

              <div class="filmitem-caption">
              <h3 class="filmitem-title">{{ $item->title }}</h3>
              <div class="filmitem-year">{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}</div>
              </div>
          </a>
      </article>
    @endforeach

    <!-- Tambah film lain di sini, set data-genre sesuai: drama | thriller | sci-fi | romance -->
  </div>
</section>

<script>
(function(){
  const scope = document.querySelector('.allfilms') || document;
  const chips = scope.querySelectorAll('.chip');
  const cards = scope.querySelectorAll('.filmitem');

  function setActive(btn){
    chips.forEach(c => {
      const on = c === btn;
      c.classList.toggle('is-active', on);
      c.setAttribute('aria-selected', on ? 'true' : 'false');
    });
  }

  function applyFilter(key){
    cards.forEach(card => {
      // BACA ARRAY GENRE dari data-genres='["drama","thriller",...]'
      let genres = [];
      try { genres = JSON.parse(card.dataset.genres || '[]'); } catch(e){}
      const match = (key === 'all') ? true : genres.includes(key);
      card.classList.toggle('is-hidden', !match);
    });
  }

  chips.forEach(btn => {
    btn.addEventListener('click', () => {
      const key = (btn.dataset.filter || '').toLowerCase();
      setActive(btn);
      applyFilter(key);
    });
    // akses keyboard
    btn.addEventListener('keydown', e => {
      if(e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
    });
  });

  // initial state
  const first = scope.querySelector('.chip.is-active') || chips[0];
  if(first){
    setActive(first);
    applyFilter((first.dataset.filter || '').toLowerCase());
  }
})();
</script>
