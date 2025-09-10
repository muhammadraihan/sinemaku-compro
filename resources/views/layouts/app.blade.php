<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Sinemaku Pictures')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{-- <link rel="stylesheet" href="{{ asset('css/main.css') }}"> --}}
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/sinemaku_horizontal.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/sinemaku_horizontal.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/sinemaku_horizontal.png') }}">
    <link rel="shortcut icon" href="{{ asset('img/sinemaku_horizontal.png') }}">



  <style>
    /* ========= Base ========= */
    * { box-sizing: border-box; }
    html, body {
      margin: 0; padding: 0; width: 100%;
      min-height: 100vh; overflow-x: hidden;
      background: #fff;                 /* ✅ background putih global */
      color: #0f0f0f;                   /* teks default */
    }

    :root{
      --space-xs: 8px;
      --space-sm: 12px;
      --space-md: 20px;
      --space-lg: 32px;
      --space-xl: 48px;
      --space-2xl: 72px;
      --maxw: 1280px;
      --bp-lg: 1200px;
      --bp-md: 992px;
      --bp-sm: 768px;
      --bp-xs: 560px;
    }

    .homepage{
      min-width: 100vw;
      min-height: 100vh;
      margin: 0; padding: 0; position: relative;
      overflow-x: hidden;
      background: #fff;                 /* ✅ fallback putih untuk wrapper */
    }

    /* ========= HERO ========= */
    .hero-slider{ position: relative; min-height: 100vh; overflow: hidden; }
    .hero-slider .hero-section{
      position: absolute; inset: 0; opacity: 0; pointer-events: none; transition: opacity .6s ease;
    }
    .hero-slider .hero-section.is-active{ opacity: 1; pointer-events: auto; }

    /* meta hero */
    .hero-meta{
      position: absolute; left: 50%; bottom: clamp(80px, 30vh, 300px);
      transform: translateX(-50%); z-index: 3;
      display: inline-flex; align-items: center; gap: clamp(6px, 1.5vw, 15px);
      padding: 10px 16px; color: #f5f5f5; font-family: 'Inter', sans-serif; font-weight: 300;
      font-size: clamp(10px, 1.3vw, 15px);
    }
    .hero-meta .meta-dot{ font-size: clamp(10px, 1.5vw, 15px); line-height: 1; margin: 0 2px; }
    .hero-meta .meta-year,.hero-meta .meta-cast{ white-space: nowrap; }
    ._01-04{
      position: absolute; left: clamp(16px, 4vw, 40px); bottom: clamp(16px, 5vh, 80px);
      color: #f5f5f5; font-family: 'Inter', sans-serif; font-weight: 400; font-size: clamp(12px, 1.8vw, 20px); z-index: 3;
    }
    ._2023, .div, .starring-prilly-latuconsina{ display: none !important; }

    .hero-bg, .temp-imagehc-vht-6-1{
      position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; display: block;
    }
    .temp-imagehc-vht-6-1{ left: 0; top: 0; right: 0; bottom: 0; aspect-ratio: auto; }

    .hero-gradient{
      position: absolute; inset: 0; width: 100%; height: 100%;
      pointer-events: none; background: linear-gradient(to top, rgba(0,0,0,0.90) 0%, rgba(0,0,0,0.10) 65%); z-index: 1;
    }

    .rectangle-5{
      position: absolute; inset: 0; width: 100%; height: 100%;
      background: rgba(40,39,39,0.5);   /* overlay hero (biarkan; tidak memengaruhi body putih) */
    }

    .hero-content{
      position: absolute; inset: 0; z-index: 2; display: flex; flex-direction: column;
      justify-content: center; align-items: center; color: #fff; padding: var(--space-lg); text-align: center;
    }

    /* Header overlay */
    .menu-hamburger-md,.interface-search-magnifying-glass{
      position: absolute; top: clamp(16px, 3.5vw, 49px);
      width: clamp(28px, 4.5vw, 41px); height: clamp(28px, 4.5vw, 41px);
      overflow: visible; aspect-ratio: 1; z-index: 3;
    }
    .menu-hamburger-md{ left: clamp(16px, 3.5vw, 41px); }
    .interface-search-magnifying-glass{ right: clamp(16px, 3.5vw, 41px); left: auto; }

    .sinemaku-pictures{
      position: absolute; top: clamp(18px, 4.5vw, 54px); left: 50%; transform: translateX(-50%);
      color: #f5f5f5; font-family: "Inter-ExtraBold", sans-serif; font-weight: 800; font-size: clamp(16px, 2.3vw, 24px); white-space: nowrap;
    }

    .bolehkah-sekali-saja-ku-menangis{
      position: absolute; left: 50%; transform: translateX(-50%); top: clamp(140px, 28vh, 293px);
      color: #f5f5f5; font-family: 'DM Serif Display', serif; font-weight: 400; letter-spacing: -0.02em; line-height: 0.95;
      font-size: clamp(42px, 9vw, 96px); text-align: center; padding: 0 var(--space-md); max-width: min(1200px, 92vw);
    }

    /* ===== Coming Soon “Apple TV”-like ===== */
.cs-scroll{
  padding: clamp(28px,4vw,40px) clamp(16px,5vw,40px);
  border-radius: 18px;
  margin-bottom: 34px;
}
.cs-scroll-head{
  display:flex; justify-content:space-between; align-items:center; margin-bottom:1px;
}
.cs-scroll-head h2{
  font: 200 13px/1.2 'Inter', Arial, sans-serif; color:#7F8487; letter-spacing:.01em; text-transform:uppercase; margin-bottom:20px;
}
.cs-scroll-seeall{
  display:inline-flex; align-items:center; justify-content:center;
  height:34px; padding:0 14px; border-radius:999px;
  background:#ffffff; color:#374151; text-decoration:none; font:600 13px/1 Inter,system-ui;
  box-shadow:0 4px 12px rgba(0,0,0,.06); transition:.2s;
}
.cs-scroll-seeall:hover{ background:#f3f4f6; }

/* track */
.cs-row{
  display:flex; gap:18px;
  overflow-x:auto; overscroll-behavior-x:contain; scroll-snap-type:x mandatory;
  padding-bottom:6px;
}
.cs-row::-webkit-scrollbar{ display:none; }  /* sembunyikan scrollbar */

/* card */
.cs-tile{
  flex:0 0 300px;                 /* lebar kartu */
  background: rgba(255,255,255,.78);
  backdrop-filter: blur(8px);
  border: 1px solid #e6e9ee;
  border-radius: 18px;
  scroll-snap-align:start;
  transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
}
.cs-tile:hover{ transform: translateY(-4px); border-color:#d6dbe3; }

.cs-link{ display:block; color:inherit; text-decoration:none; }

/* media 16:9 */
.cs-tile-media{
  position:relative; margin:10px; border-radius:9px; overflow:hidden; background:#0a0a0a;
  box-shadow: inset 0 0 0 1px rgba(255,255,255,.06);
}
/* release date tag */
.cs-date{
  position:absolute; top:10px; left:10px;
  background:#c1121f;             /* merah */
  color:#fff;
  font:500 9px/1 Inter,system-ui;
  letter-spacing:.01em;
  text-transform:uppercase;
  padding:6px 10px;
  border-radius:8px;
  box-shadow:0 4px 10px rgba(0,0,0,.25);
  border:1px solid rgba(0,0,0,.15);
}
.cs-tile-media::before{ content:""; display:block; aspect-ratio:16/9; }
.cs-tile-media img{
  position:absolute; inset:0; width:100%; height:100%; object-fit:cover; transform:scale(1.02);
  transition: transform .35s cubic-bezier(.2,.7,.2,1), filter .35s;
}
.cs-tile:hover .cs-tile-media img{ transform:scale(1.06); filter:contrast(1.04) saturate(1.04); }

/* caption */
.cs-tile-caption{ padding: 8px 14px 14px; }
.cs-tile-title{ margin:0 0 4px; font:600 13px/1.2 Inter,system-ui; color:#111; letter-spacing:.02em; }
.cs-tile-sub{ margin:0; font:400 12px/1.45 Inter,system-ui; color:#6b7280; }

/* responsive */
@media (max-width:560px){
  .cs-tile{ flex-basis: 76vw; }
}

/* ======== Section Film ======== */
.nr-rail{ background:#fff; padding: 28px clamp(16px,5vw,56px) 40px;}
.nr-rail-head{
  display:flex; align-items:center; justify-content:space-between; gap:16px; margin-bottom:1px;
}
.nr-rail-title{
  text-align: left;font: 500 14px/1.2 'Inter', Arial, sans-serif; color:#7F8487; letter-spacing:.01em; text-transform:uppercase; margin-bottom:1px;
}
.nr-rail-viewall{ text-align: left;font: 200 12px/1.2 'Inter', Arial, sans-serif; color:#7F8487; letter-spacing:.01em; text-transform:uppercase;margin-bottom:1px; }
.nr-rail-viewall:hover{ transform: translateX(4px); }

/* === perbaikan stacking & klikability untuk kedua rail (Films/Series) === */
.nr-rail-wrap,
.sr-rail-wrap{
  position: relative;
  overflow: visible;             /* pastikan tombol tidak ter-clipping */
}
/* ruang di sisi kiri–kanan untuk tombol */
.nr-track,
.sr-track{
  padding-inline: 48px;          /* sesuaikan dengan lebar tombol */
}
/* tombol selalu di atas segalanya */
.nr-nav,
.sr-nav{
  z-index: 20;                    /* > fade & > card */
}

/* track: horizontal, snap, fixed column width */
.nr-track{
  display:grid;
  grid-auto-flow: column;
  grid-auto-columns: clamp(170px, 19vw, 230px);
  gap: clamp(12px,2vw,18px);
  overflow-x:auto; overflow-y:visible;
  padding: 6px 0 4px;
  scroll-snap-type: x mandatory;
  -webkit-overflow-scrolling: touch;
  scrollbar-width: none;
}
.nr-track::-webkit-scrollbar{ display:none; }

.nr-item{ scroll-snap-align: start; list-style:none; }

.nr-card{ display:block; color:inherit; text-decoration:none;}
.nr-media{
  margin:0 0 10px; position:relative; border-radius:0px; overflow:hidden;
  background:#eee; aspect-ratio: 2 / 3;
  transition: transform .25s ease, box-shadow .25s ease;
}
.nr-media img{
  position:absolute; inset:0; width:100%; height:100%; object-fit:cover; display:block;
  transform: scale(1); transition: transform .5s cubic-bezier(.2,.7,.2,1), filter .3s ease;
}
.nr-card:hover .nr-media{ transform: translateY(-3px); box-shadow: 0 18px 36px rgba(0,0,0,.08); }
.nr-card:hover .nr-media img{ transform: scale(1.04); }

/* year pill */
.nr-year{
  position:absolute; right:8px; top:8px;
  background:#111; color:#fff; font:700 11px/1 "Inter";
  padding:6px 9px; border-radius:999px; opacity:.95;
}

/* caption */
.nr-caption{ text-align:left; }
.nr-name,
.nr-sub{
  margin:0 0 4px; font:600 13px/1.2 Inter,system-ui; color:#111; letter-spacing:.02em;  text-transform: uppercase;
}
.nr-sub{ font:500 11px/1.2 "Inter"; color:#6b7280; text-align: center; }

/* nav buttons */
.nr-nav{
  position:absolute; top:50%; transform: translateY(-50%);
  width:36px; height:36px; border-radius:999px; border:1px solid #e5e7eb;
  background:#fff; color:#111; display:grid; place-items:center; cursor:pointer;
  box-shadow: 0 6px 18px rgba(0,0,0,.08);
  transition: transform .18s ease, box-shadow .18s ease, background .18s ease;
}
.nr-prev{ left:-6px; } .nr-next{ right:-6px; }
.nr-nav:hover{ transform: translateY(-50%) scale(1.04); box-shadow:0 10px 24px rgba(0,0,0,.12); }
.nr-nav[disabled]{ opacity:.35; pointer-events:none; }

/* edge fade (subtle) */
/* fade hanya visual, jangan menghalangi klik
.nr-fade,
.sr-fade{
  z-index: 5;
  pointer-events: none;
} */

.nr-fade-left{ left:0; background:linear-gradient(90deg,#fff,rgba(255,255,255,0)); }
.nr-fade-right{ right:0; background:linear-gradient(270deg,#fff,rgba(255,255,255,0)); }

/* responsive tweak */
@media (max-width:600px){
  .nr-nav{ display:none; }
  .nr-rail{ padding-left:16px; padding-right:16px; }
}
/* kartu & media di bawah tombol
.nr-card, .sr-card,
.nr-media, .sr-media{
  position: relative;
  z-index: 1;
} */
/* --- NO BORDER for film/series cards --- */
.nr-card, .sr-card{
  border: none !important;
}

.nr-media, .sr-media{
  border: 0 !important;
  box-shadow: none !important;   /* matikan inset frame lawas */
  background: #f5f5f5;           /* placeholder netral */
}

/* img selalu bersih, tanpa outline/border */
.nr-media img, .sr-media img{
  display:block;
  width:100%;
  height:100%;
  object-fit:cover;
  border:0 !important;
  outline:0 !important;
}

    /* ========= Section Shop ========= */
    .feature-sidetext{ padding: 40px 56px 72px; background: #fff; }
    .feature-wrap{ display:grid; grid-template-columns: 1fr 1.15fr; align-items:start; gap:48px; max-width:1600px; margin:0 auto; }
    .feature-eyebrow{ text-align: left;font: 500 14px/1.2 'Inter', Arial, sans-serif; color:#7F8487; letter-spacing:.01em; text-transform:uppercase; margin-bottom:1px; }
    .feature-title{
      margin:0 0 36px; font-family:'Inter', Arial, sans-serif; font-weight:300; line-height:1.2; color:#0d0d0d;
      font-size: clamp(28px, 5vw, 48px); letter-spacing:-0.5px;
      display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden; text-overflow:ellipsis;
    }
    .feature-cta{ display:inline-flex; align-items:center; gap:16px; color:#111; margin-top:36px; text-decoration:none; transition:color .2s; }
    .feature-cta .cta-line{ width:88px; height:2px; background: currentColor; position:relative; transition: width .25s cubic-bezier(.55,0,.25,1); }
    .feature-cta .cta-line::after{ content:""; position:absolute; right:-12px; top:50%; width:12px; height:12px; border-right:2px solid currentColor; border-top:2px solid currentColor; transform: translateY(-50%) rotate(45deg); }
    .feature-cta .cta-label{ font:300 20px/1.2 'Inter', Arial, sans-serif; letter-spacing:.02em; }
    .feature-cta:hover{ color:#000; }
    .feature-cta:hover .cta-line{ width:110px; }
    .feature-media{ position:relative; display:block; text-decoration:none; color:inherit; cursor:pointer; }
    .feature-media::before{ content:""; position:absolute; inset:0; background:#ececec; border-radius:10px; transform: translate(12px,12px); z-index:0; transition: transform .45s cubic-bezier(.22,.61,.36,1); }
    .feature-media-frame{
      position:relative; background:#f1f1f1; border-radius:8px;
      box-shadow: 0 0 0 10px #fff inset, 0 1px 0 0 #e5e5e5 inset;
      padding:10px; z-index:1; transition: transform .45s cubic-bezier(.22,.61,.36,1), box-shadow .45s cubic-bezier(.22,.61,.36,1);
    }
    .feature-media-frame::before{ content:""; display:block; aspect-ratio: 16/9; }
    .feature-media-frame > img{ position:absolute; inset:10px; width: calc(100% - 20px); height: calc(100% - 20px); object-fit: cover; border-radius:4px; transition: transform .55s cubic-bezier(.22,.61,.36,1); will-change: transform; }
    .feature-media:hover .feature-media-frame{ transform: translateY(-6px); box-shadow: 0 16px 40px rgba(0,0,0,.16), 0 6px 16px rgba(0,0,0,.08); }
    .feature-media:hover .feature-media-frame > img{ transform: scale(1.035); }
    .feature-media:hover::before{ transform: translate(16px,16px); }

    @media (max-width: 1200px){
      .feature-wrap{ grid-template-columns: 1fr; gap: 32px; }
      .feature-title{ margin-bottom: 24px; }
    }
    @media (max-width: 640px){
      .feature-sidetext{ padding: 28px 20px 52px; }
      .feature-cta .cta-label{ font-size: 18px; }
      .feature-cta .cta-line{ width: 64px; }
    }

    /* ========= Articles ========= */
    .articles-section{ padding: 60px 80px; background:#fff;}
    .articles-header{ display:flex; justify-content:space-between; align-items:center; gap: var(--space-md); margin-bottom: 2px; }
    .articles-header h2{
      text-align: left;font: 500 14px/1.2 'Inter', Arial, sans-serif; color:#7F8487; letter-spacing:.01em; text-transform:uppercase; margin-bottom:1px;
    } 
    .view-all{ text-align: left;font: 200 12px/1.2 'Inter', Arial, sans-serif; color:#7F8487; letter-spacing:.01em; text-transform:uppercase; margin-bottom:1px; }
    .view-all:hover{ transform: translateX(4px); }

    .article-featured{ position:relative; overflow:hidden; border-radius:10px; }
    .article-featured img{ width:100%; border-radius:10px; display:block; transition: transform .35s ease; }
    .article-featured:hover img{ transform: scale(1.03); }
    .article-featured::after{
      content:""; position:absolute; inset:0;
      background: linear-gradient(to top, rgba(21,21,21,0.94) 20%, rgba(0,0,0,0) 70%); z-index:1;
    }
    .article-featured-text{
      position:absolute; bottom:20px; left:20px; right:20px; color:#fff; z-index:2; font: 300 15px/1.2 'Inter', Arial, sans-serif;
    }
    .article-featured-text h3{ font: 600 25px/1.2 'Inter', Arial, sans-serif; margin: 0 0 6px; }

    .article-list{ display:flex; flex-direction:column; gap:20px; background:#ffffff; border-radius: 18px; padding: 16px; box-shadow: 0 8px 28px rgba(0,0,0,.08); }
    .article-item img{ width: 64px; height: 64px; border-radius: 14px; object-fit: cover; flex: 0 0 64px; }
    .article-item h4{ margin: 0 0 6px; font: 400 13px/1.2 'Inter', Arial, sans-serif; color: #111; }
    .article-item .date{ display: inline-block; font-size: 12px; font-weight: 600; color: #64748b; background: #eef2f7; padding: 6px 10px; border-radius: 999px; }
    .article-featured, .article-featured img{ border-radius: 18px; }
    a { text-decoration: none; color: inherit; }
    .articles-grid{
      display:grid; grid-template-columns: minmax(0, 1.7fr) minmax(0, 1fr); gap:40px; align-items:start;
    }
    .article-item-link{ display:flex; gap:16px; align-items:center; text-decoration:none; color:inherit; width:100%; }
    .article-item{ background:transparent; box-shadow:none; padding:10px 8px; border-radius:12px; }
    .article-item:hover{ background:#f8fafc; transform:translateY(-2px); }
    @media (max-width: 992px){ .articles-grid{ grid-template-columns:1fr; } }

    /* ===================== ARTICLES – RESPONSIVE REFINEMENT ===================== */
/* container width & padding */
.articles-section{
  max-width: var(--maxw);
  margin: 0 auto;
  padding: clamp(28px,5vw,64px) clamp(16px,5vw,32px);
}

/* header */
.articles-header{
  gap: 12px;
  margin-bottom: clamp(14px,2.5vw,22px);
}
.articles-header h2{
  margin: 0;
}

/* grid: featured kiri, list kanan → stack di tablet/phone */
.articles-grid{
  display: grid;
  grid-template-columns: minmax(0, 1.6fr) minmax(0, .9fr);
  gap: clamp(16px,3.2vw,32px);
  align-items: start;
}
@media (max-width: 1024px){
  .articles-grid{ grid-template-columns: 1fr; }
}

/* featured card: jaga rasio & overlay */
.article-featured{
  position: relative;
  overflow: hidden;
  border-radius: 16px;
}
.article-featured::after{ border-radius: inherit; }
.article-featured img{
  width: 100%;
  height: auto;
  aspect-ratio: 16 / 9;
  object-fit: cover;
  display: block;
  border-radius: inherit;
}
.article-featured-text{
  bottom: clamp(10px,2.4vw,18px);
  left: clamp(10px,2.4vw,18px);
  right: clamp(10px,2.4vw,18px);
}
.article-featured-text h3{
  font-size: clamp(15px,2.3vw,20px);
  line-height: 1.2;
  margin: 0 0 6px;
}

/* list container: hilangkan card box-shadow di mobile, jadikan grid rapi */
.article-list{
  background: transparent;
  box-shadow: none;
  padding: 0;
  display: grid;
  gap: 12px;
}
@media (min-width: 640px){
  .article-list{ gap: 14px; }
}

/* list item layout: thumbnail kiri, teks kanan; responsif ukuran gambar */
.article-item{
  padding: 8px;
  border-radius: 12px;
  transition: background .18s ease, transform .18s ease;
}
.article-item:hover{ background: #f8fafc; transform: translateY(-1px); }

/* link jadi grid dua kolom (thumb + text) */
.article-item-link{
  display: grid;
  grid-template-columns: 80px 1fr;
  gap: 12px;
  align-items: center;
  width: 100%;
}
@media (min-width: 640px){
  .article-item-link{ grid-template-columns: 96px 1fr; gap: 14px; }
}
@media (min-width: 1024px){
  .article-item-link{ grid-template-columns: 110px 1fr; gap: 16px; }
}

/* thumbnail */
.article-item img{
  width: 100%;
  height: auto;
  aspect-ratio: 1 / 1;
  object-fit: cover;
  border-radius: 12px;
}

/* teks: clamp supaya tak meluber */
.article-item h4{
  font-size: clamp(11px,1.8vw,15px);
  line-height: 1.2;
  margin: 0 0 6px;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.article-item .date{
  display: inline-block;
  font-size: 12px;
  font-weight: 600;
  padding: 6px 10px;
  border-radius: 999px;
  background: #eef2f7;
  color: #64748b;
}

@media (max-width: 640px){
  .article-item h4{
  font-size: clamp(13px,2.0vw,17px);
  line-height: 1.2;
  margin: 0 0 6px;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
}
/* kecilkan padding section di layar sangat kecil */
@media (max-width: 420px){
  .articles-section{ padding-inline: 12px;}
}

/* prefer reduced motion – matikan animasi non-esensial */
@media (prefers-reduced-motion: reduce){
  .article-featured img,
  .article-item,
  .article-item img{ transition: none !important; }
}

    /* ========= Spotlight ========= */
    .spotlight{ padding: 24px 0; }
    .spotlight__frame{ position:relative; overflow:hidden; }
    .spotlight__image{ width:100%; height: clamp(320px, 55vw, 700px); object-fit:cover; display:block; transform: scale(1); transition: transform .9s cubic-bezier(.2,.6,.2,1); }
    .spotlight__overlay{
      content:""; position:absolute; inset:0;
      background: linear-gradient(to top, rgba(0,0,0,0.75) 12%, rgba(0,0,0,0.45) 28%, rgba(0,0,0,0.08) 60%, rgba(0,0,0,0) 85%); pointer-events:none;
    }
    .spotlight__content{
      position:absolute; left: clamp(16px, 4vw, 48px); bottom: clamp(14px, 3.5vw, 46px); right: clamp(16px, 6vw, 72px);
      color:#fff; z-index:2;
    }
    .spotlight__eyebrow{ display:inline-block; font: 300 12px/1.2 'Inter', system-ui, -apple-system, Arial, sans-serif; text-transform:uppercase; opacity:.9; margin-bottom: 10px; }
    .spotlight__title{
      margin:0; font-family:"Inter", Arial, serif; font-weight:500; letter-spacing:-0.5px; line-height:.95;
      font-size: clamp(28px, 7.2vw, 88px); text-shadow: 0 2px 18px rgba(0,0,0,.35);
    }
    .spotlight__frame:hover .spotlight__image{ transform: scale(1.03); }

    /* ========= Careers ========= */
.careers-section{ padding:64px 0 90px; background:#fff; }
.careers-wrap{ max-width:1430px; margin:0 auto; padding:0 24px; }

.careers-title{
  text-align: left;font: 500 14px/1.2 'Inter', Arial, sans-serif; color:#7F8487; letter-spacing:.01em; text-transform:uppercase; margin-bottom:5px;
}
.careers-subtitle{
  text-align:center; font-family:'Inter', sans-serif; font-size: clamp(14px, 2.2vw, 18px); color:#444; margin-bottom: 28px; line-height:1.5;
}

/* Grid */
.careers-grid{
  display:grid; gap:28px;
  grid-template-columns:repeat(3,1fr);
}
@media (max-width:1050px){ .careers-grid{ grid-template-columns:repeat(2,1fr); } }
@media (max-width:680px){  .careers-grid{ grid-template-columns:1fr; } }

/* Card – minimal sinematik */
.career-card{
  position:relative;
  background:#fff;
  border:1px solid #eee;
  border-radius:8px;
  padding:20px 20px 18px;
  box-shadow:0 6px 18px rgba(0,0,0,.05);
  transition:transform .28s ease, box-shadow .28s ease, border-color .28s ease;
  overflow:hidden;
}
/* accent kiri tipis (film-festival vibe) */
.career-card::before{
  content:"";
  position:absolute; left:0; top:0; bottom:0;
  width:3px; background:#111; transform:scaleY(.12);
  transform-origin:top; transition:transform .35s ease;
  opacity:.9;
}
.career-card:hover{
  transform:translateY(-3px);
  box-shadow:0 10px 26px rgba(0,0,0,.07);
  border-color:#e9e9e9;
}
.career-card:hover::before{ transform:scaleY(1); }

.career-card__body{ padding:2px 2px 0; }

/* Tipografi ala judul poster */
.career-role{
  margin:0 0 8px;
  font:600 clamp(14px,1.2vw,18px)/1.2 "Inter", system-ui, Arial, sans-serif;
  text-transform:uppercase; letter-spacing:.01em; color:#0f1115;
}
.career-dept{
  font:400 14px/1.2 "Inter", system-ui, Arial, sans-serif;
  font-style:italic; color:#6b7683; margin-bottom:12px;
}

/* Meta */
.career-meta{ display:flex; align-items:center; gap:14px; margin-bottom:10px; }
.career-loc{
  display:inline-flex; align-items:center; gap:8px;
  color:#6b7683; font:500 13.5px/1.2 "Inter", system-ui, Arial, sans-serif;
}
.loc-ic{ width:16px; height:16px; opacity:.9; }

/* Divider halus */
.career-sep{
  border:0; height:1px; background:#eee; margin:14px 0 12px;
}

/* CTA – ghost → solid on hover */
.career-apply{
  display:inline-flex; align-items:center; justify-content:center; gap:10px;
  width:100%; height:46px;
  border-radius:8px;
  border:1.6px solid #111;
  background:transparent; color:#111;
  font:400 14px/1.2 "Inter", system-ui, Arial, sans-serif;
  text-decoration:none; cursor:pointer;
  transition:background .22s ease, color .22s ease, transform .18s ease, box-shadow .18s ease;
}
.career-apply__ic{ width:18px; height:18px; }
.career-apply:hover{
  background:#111; color:#fff;
  transform:translateY(-1px);
  box-shadow:0 10px 18px rgba(0,0,0,.14);
}

/* Footer (link View All) – editorial underline */
.careers-footer{ margin-top:clamp(40px,10vw,100px); display:flex; justify-content:center; }
.careers-viewall{
  display:inline-flex; align-items:center; gap:10px;
  background:transparent; color:#111; padding:8px 2px;
  font:400 15px/1 "Inter", system-ui, Arial, sans-serif;
  text-decoration:none; text-transform:uppercase; letter-spacing:.08em;
  position:relative; border-radius:0; transition:color .25s ease;
}
.careers-viewall::after{
  content:""; position:absolute; left:0; bottom:-3px; width:100%; height:1.5px;
  background:#111; transform:scaleX(0); transform-origin:right; transition:transform .3s ease;
}
.careers-viewall:hover::after{ transform:scaleX(1); transform-origin:left; }
.careers-view{ margin:0 0 8px; font:500 16px/1.25 "Inter", system-ui, Arial, sans-serif; color:#111; }

    /* ========= Join Member ========= */
    .join-member{ margin-top: -60px; background:#fff; color:#000; padding: clamp(64px, 10vw, 120px) 20px; text-align:center; }
    .join-member-inner{ max-width: 800px; margin: 0 auto; }
    .join-member-title{ font-family:'Inter', sans-serif; font-weight:500; margin-bottom: 16px; letter-spacing:-0.5px; line-height:1; font-size: clamp(28px, 7vw, 60px); }
    .join-member-desc{ font-family:'Inter', sans-serif; font-size: clamp(14px, 2.2vw, 18px); color:#444; margin-bottom: 28px; line-height:1.5; }
    .join-member-btn{ background:#000; color:#fff; font-weight:600; border:none; padding: 16px 28px; font-size:16px; border-radius:4px; cursor:pointer; transition:.3s; }
    .join-member-btn:hover{ background:#333; transform: translateY(-2px); }
    .join-member-btn {
  background: transparent;    /* pastikan transparan */
  border: none;               /* tidak ada border */
  padding: 6px 2px;
  font: 400 15px/1 "Inter", sans-serif;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: #111;
  position: relative;
  cursor: pointer;
  text-decoration: none;      /* hilangkan underline bawaan link */
}

.join-member-btn::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: -3px;               /* jarak garis dari teks */
  width: 100%;
  height: 1.5px;
  background: #111;
  transform: scaleX(0);       /* mulai dari 0 */
  transform-origin: right;
  transition: transform .3s ease;
}

.join-member-btn:hover {
  background: transparent;    /* cegah muncul background hitam */
  color: #111;                /* warna teks tetap */
}

.join-member-btn:hover::after {
  transform: scaleX(1);       /* animasi muncul garis */
  transform-origin: left;
}

    /* ========= Footer ========= */
    .site-footer{ background:#0A0B0C; color:#cfd8e3; padding:72px 24px 28px; }
        .site-footer a{ color:#e6eef8; text-decoration:none; }
        .site-footer a:hover{ color:#ffffff; }
        .footer-inner{
            max-width:1280px; margin:0 auto 28px;
            display:grid; grid-template-columns: 1.2fr 1fr 1fr; gap:54px;
        }
        .footer-brand .brand-head{ display:flex; align-items:center; gap:12px; }
        .brand-icon{ flex:0 0 auto; }
        .brand-name{
            font-family:'Inter', Arial, sans-serif; font-size:28px; font-weight:800; letter-spacing:-0.5px; line-height:.95; color:#fff;
        }
        .brand-tagline{ margin-top:18px; line-height:1.7; color:#98a7b8; max-width:620px; }

        .footer-title{ font-family:'Inter', Arial, sans-serif; font-weight:700; color:#fff; margin:2px 0 16px; }
        .nav-cols{ display:grid; grid-template-columns: 1fr 1fr; gap:32px; }
        .footer-links{ list-style:none; margin:0; padding:0; }
        .footer-links li{ margin:12px 0; }
        .footer-links a{ font-size:16px; color:#cfd8e3; transition: transform .2s, color .2s; display:inline-block; }
        .footer-links a:hover{ color:#fff; transform: translateX(4px); }

        .contact-item{ display:flex; align-items:center; gap:10px; margin:12px 0; }
        .ci{ opacity:.85; }
        .follow-title{ margin-top:18px; font-weight:600; color:#fff; }
        .socials{ display:flex; gap:14px; margin-top:10px; }
        .social-btn{
            width:44px; height:44px; display:grid; place-items:center;
            background:#18202b; border-radius:6px; border:1px solid rgba(255,255,255,.06);
            transition: transform .18s, background .18s, box-shadow .18s;
        }
        .social-btn:hover{ background:#222c3a; transform: translateY(-2px); box-shadow:0 6px 20px rgba(0,0,0,.35); }

        .footer-divider{
            max-width:1280px; margin:18px auto 22px;
            height:1px; background: linear-gradient(90deg, rgba(255,255,255,.06), rgba(255,255,255,.08), rgba(255,255,255,.06));
        }
        .footer-bottom{
            max-width:1280px; margin:0 auto;
            display:grid; grid-template-columns: 1.2fr auto auto; align-items:center; gap:18px;
            font-size:14px; color:#9fb0c2;
        }
        .legal{ list-style:none; display:flex; gap:22px; margin:0; padding:0; flex-wrap: wrap; }
        .legal a{ color:#b9c7d6; } .legal a:hover{ color:#fff; }
        .copy,.est{ white-space:nowrap; }

        @media (max-width: 1024px){
            .footer-inner{ grid-template-columns: 1fr 1fr; }
            .footer-brand{ grid-column: 1 / -1; }
        }
        @media (max-width: 720px){
            .footer-inner{ grid-template-columns: 1fr; gap:36px; }
            .footer-bottom{ grid-template-columns: 1fr; gap:10px; text-align:center; }
            .legal{ justify-content:center; }
            .copy,.est{ justify-self:center; white-space: normal; }
        }

/* === Hero judul + meta sejajar kiri-bawah === */
.hero-content {
  position: absolute !important;
  left: clamp(16px, 4vw, 48px) !important;
  bottom: clamp(28px, 6vh, 60px) !important;
  right: clamp(16px, 6vw, 72px) !important;

  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
  justify-content: flex-end !important;

  text-align: left !important;
  padding: 0 !important;
  z-index: 2;
}

/* Judul (now contains meta inline) */
.bolehkah-sekali-saja-ku-menangis {
  position: static !important;
  transform: none !important;
  margin: 0 !important;
  text-align: left !important;
  font: clamp(30px, 6.2vw, 58px) 'Inter', Arial, sans-serif;;
  line-height: 0.95;
  max-width: min(1200px, 92vw);
  white-space: normal; /* Allow title to wrap naturally */
}

/* Meta (tahun • cast) embedded inline after title */
.hero-meta {
  position: static !important;
  transform: none !important;
  margin: 0 0 0 clamp(6px, 1.5vw, 14px) !important; /* Gap from title text */
  padding: 0 !important;

  display: inline-flex; /* Keep internal flex for meta items */
  align-items: baseline; /* Align meta items with title baseline */
  gap: clamp(6px, 1.5vw, 14px);
  color: #f5f5f5;
  font-size: clamp(14px, 1.6vw, 18px);
  white-space: nowrap; /* Prevent meta from wrapping internally */
  vertical-align: baseline; /* Ensure alignment with title text */
}

/* Mobile tweak */
@media (max-width: 640px) {
  .bolehkah-sekali-saja-ku-menangis {
    font-size: clamp(24px, 7vw, 36px) !important;
  }
  .hero-meta {
    font-size: 12px !important;
    margin-left: clamp(4px, 1vw, 8px) !important; /* Tighter gap on mobile */
  }
}
  </style>
</head>
<body>

  @yield('content')
</body>

<!-- ======================= FOOTER ======================= -->
<footer class="site-footer">
    <div class="footer-inner">
        <!-- Brand / About -->
        <div class="footer-brand">
            <div class="brand-head">
                <!-- Film icon -->
                <svg class="brand-icon" width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <rect x="3" y="4" width="18" height="16" rx="2" stroke="white" stroke-width="2"/>
                    <rect x="6" y="7" width="3" height="3" rx="1" fill="white"/>
                    <rect x="6" y="14" width="3" height="3" rx="1" fill="white"/>
                    <rect x="15" y="7" width="3" height="3" rx="1" fill="white"/>
                    <rect x="15" y="14" width="3" height="3" rx="1" fill="white"/>
                </svg>
                <span class="brand-name">SINEMAKU PICTURES</span>
            </div>
            <p class="brand-tagline">
                Creating cinematic experiences that challenge conventions and inspire new perspectives.
                We are storytellers, dreamers, and rebels with cameras.
            </p>
        </div>

        <!-- Navigation -->
        <nav class="footer-nav">
            <h4 class="footer-title">Navigation</h4>
            <div class="nav-cols">
                <ul class="footer-links">
                    <li><a href="{{ route('welcome') }}">Home</a></li>
                    <li><a href="{{ route('series') }}">Series</a></li>
                    <li><a href="{{ route('articles') }}">Articles</a></li>
                    <li><a href="{{ route('careers') }}">Careers</a></li>
                </ul>
                <ul class="footer-links">
                    <li><a href="{{ route('film') }}">Films</a></li>
                    <li><a href="{{ route('shop') }}">Shop</a></li>
                    <li><a href="{{ route('event') }}">Events</a></li>
                </ul>
            </div>
        </nav>

        <!-- Connect -->
        <div class="footer-connect">
            <h4 class="footer-title">Connect</h4>

            <div class="contact-item">
                <!-- mail -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="ci">
                    <path d="M4 6h16v12H4z" stroke="#cfd8e3" stroke-width="1.8" />
                    <path d="M4 6l8 6 8-6" stroke="#cfd8e3" stroke-width="1.8" fill="none"/>
                </svg>
                <a href="mailto:hello@sinemakupictures.com">hello@sinemakupictures.com</a>
            </div>

            <div class="contact-item">
                <!-- pin -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="ci">
                    <path d="M12 21s7-5.2 7-11a7 7 0 1 0-14 0c0 5.8 7 11 7 11z" stroke="#cfd8e3" stroke-width="1.8"/>
                    <circle cx="12" cy="10" r="2.4" fill="#cfd8e3"/>
                </svg>
                <span>Jakarta, Indonesia</span>
            </div>

            <div class="follow-title">Follow Us</div>
            <div class="socials">
                <a class="social-btn" href="#" aria-label="Instagram">
                    <!-- instagram -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="3" width="18" height="18" rx="5" stroke="#e6eef8" stroke-width="1.6"/>
                        <circle cx="12" cy="12" r="4" stroke="#e6eef8" stroke-width="1.6"/>
                        <circle cx="17.5" cy="6.5" r="1.2" fill="#e6eef8"/>
                    </svg>
                </a>
                <a class="social-btn" href="#" aria-label="YouTube">
                    <!-- youtube -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <rect x="2.5" y="6" width="19" height="12" rx="4" stroke="#e6eef8" stroke-width="1.6"/>
                        <path d="M10 9v6l5-3-5-3z" fill="#e6eef8"/>
                    </svg>
                </a>
                <a class="social-btn" href="#" aria-label="Twitter/X">
                    <!-- twitter/x (simple) -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M4 4l16 16M20 4L4 20" stroke="#e6eef8" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="footer-divider"></div>

    <div class="footer-bottom">
        <div class="copy">© 2024 Sinemaku Pictures. All rights reserved.</div>
        <ul class="legal">
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
            <li><a href="#">Cookies</a></li>
        </ul>
        <div class="est">EST. 2020&nbsp; • &nbsp;JAKARTA</div>
    </div>
</footer>
</html>