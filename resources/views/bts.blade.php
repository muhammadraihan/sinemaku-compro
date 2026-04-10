@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')

<style>


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

/* ---------- HERO DETAIL PRODUK ---------- */
.shop-detail{ padding:clamp(32px,4.5vw,72px) 0; background:#fff; color:#131313; }
.shop-detail__container{
  width:min(1280px,92vw); margin:0 auto; display:grid; gap:clamp(28px,4vw,64px);
  grid-template-columns:1.2fr 1fr; align-items:start;
}
@media (max-width:960px){ .shop-detail__container{ grid-template-columns:1fr; } }
.shop-detail__media{
  background:#f6f7f8; border-radius:14px; box-shadow:0 10px 28px rgba(0,0,0,.06);
  padding:clamp(14px,2vw,22px);
}
.shop-detail__media img{
  width:100%; height:clamp(360px,48vw,640px); object-fit:contain; display:block; border-radius:10px;
}
.shop-detail__info{ padding-top:6px; }
.shop-detail__title{
  font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
  font-weight:500; line-height:.95; letter-spacing:-.5px;
  font-size:clamp(28px,3.2vw,44px); margin-top:150px;
}
.shop-detail__price{
  font:500 clamp(18px,1.6vw,22px)/.95 Inter,system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
  margin:6px 0 24px;
}
.shop-detail__cta{
  margin-top:10px; display:inline-flex; align-items:center; gap:12px; padding:16px 22px;
  border-radius:10px; background:#fff; color:#111; text-decoration:none; font-weight:700; font-size:13px;
  letter-spacing:.2px; box-shadow:0 10px 24px rgba(0,0,0,.156);
  transition:transform .18s, box-shadow .18s, background .2s;
}
.shop-detail__cta:hover{ transform:translateY(-1px); box-shadow:0 14px 34px rgba(0,0,0,.18); }
.shop-detail__cta:hover{
      background: #111;
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 10px 24px rgba(0,0,0,.08);
    }
.shop-detail__cta svg{ width:20px; height:20px; transition:transform .22s; }
.shop-detail__cta:hover svg{ transform:translateX(4px); }
.shop-detail__note{
  font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
  line-height:1.5; letter-spacing:-.2px; color:#6f6f6f; font-size:13px; margin:40px 0;
}

/* Hero tanpa kartu / background */
.shop-detail__media{
  background: transparent !important;
  box-shadow: none !important;
  padding: 0 !important;
  border-radius: 0 !important;
}

.shop-detail__media img{
  background: transparent !important;
  border-radius: 0 !important;
  width: 100%;
  height: clamp(360px, 48vw, 640px);
  object-fit: contain;
  display: block;
  margin: 0 auto; /* center */
}

/* ---------- SECTION HEADER KATEGORI ---------- */
:root{
  --shelf-max: min(1280px, 92vw);
  --shelf-col: clamp(220px, 23vw, 300px);
  --shelf-gap: 12px;
}
.kategori{
  display:block; width:var(--shelf-max);
  margin:16px auto 4px;
  font:600 10px/1 Inter,Arial,sans-serif; letter-spacing:.16em; text-transform:uppercase; color:#6a6a6a;
}
.shop-detail__divider2{ width:var(--shelf-max); margin: 0 auto 12px; height:1px; background:#111; opacity:.18; border:0; }

/* ---------- SHELF (CAROUSEL) ala A24 ---------- */
.related-products{ width:var(--shelf-max); margin:0 auto; }
.carousel-wrapper{ position:relative; z-index:0; }

/* fade di tepi (tidak menghalangi klik) */
.carousel-wrapper::before,
.carousel-wrapper::after{
  content:""; position:absolute; top:0; bottom:0; width:40px; pointer-events:none; z-index:1;
  background:linear-gradient(to right, #fff, rgba(255,255,255,0));
}
.carousel-wrapper::before{ left:0; }
.carousel-wrapper::after{
  right:0; background:linear-gradient(to left, #fff, rgba(255,255,255,0));
}

/* track horizontal */
.carousel-track{
  display:grid; grid-auto-flow:column; grid-auto-columns:var(--shelf-col); gap:var(--shelf-gap);
  overflow-x:auto; scroll-snap-type:x mandatory; -webkit-overflow-scrolling:touch;
  padding: 0 6px 8px; scroll-padding-inline:12px; scrollbar-width:none;
}
.carousel-track::-webkit-scrollbar{ display:none; }

/* kartu produk */
.product-card{ scroll-snap-align:start; display:grid; gap:5px; text-align:left; color:#111; }
.product-card img{
  width:100%; height:auto; aspect-ratio:4/3; object-fit:contain;
  border-radius:12px; padding:clamp(14px,2vw,22px); box-shadow:0 10px 24px rgba(0,0,0,.05);
  transition:transform .18s, box-shadow .18s;
  background: transparent !important;
  box-shadow: none !important;
  padding: 0 !important;
  border-radius: 0 !important;
}
.product-card:hover img{ transform:translateY(-4px); box-shadow:0 14px 38px rgba(0,0,0,.08); }
.product-card .title{ margin:6px 0 2px; font:400 12px/1.35 Inter,Arial,sans-serif; }
.product-card .price{ margin:0; color:#444; font:300 11px/1 Inter,Arial,sans-serif; }

/* tombol panah */
.carousel-btn{
  position: absolute;
  top: 35%;               /* turunkan dari default 50% → 40% agar naik */
  transform: translateY(-50%);
  width: 44px;
  height: 44px;
  display: grid;
  place-items: center;
  border-radius: 50%;
  border: 1px solid rgba(0,0,0,.12);
  background: #fff;
  color: #111;
  box-shadow: 0 6px 18px rgba(0,0,0,.08);
  cursor: pointer;
  transition: background .18s, color .18s, transform .18s;
  z-index: 5;
}
.carousel-btn:hover{ background:#111; color:#fff; }
.prev-btn{ left:16px; }
.next-btn{ right:16px; }
.carousel-btn[disabled]{ opacity:.35; pointer-events:none; }

@media (max-width:640px){
  :root{ --shelf-col: clamp(220px, 78vw, 360px); }
  .prev-btn{ left:8px; } .next-btn{ right:8px; }
}

/* Kecilkan ukuran video tanpa mengecilkan rak */
.product-card iframe {
  width: 100%;
  aspect-ratio: 16 / 9;   /* jaga proporsi */
  height: auto;
  border: 0;
  border-radius: 14px;
  box-shadow: 0 8px 20px rgba(0,0,0,.08);
  background: #000;
  transform-origin: center top;    /* pusat pengecilan */
  margin: 0 auto;                  /* center */
}

/* beri jarak antar card */
.product-card {
  scroll-snap-align: start;
  display: grid;
  gap: 10px;
  padding: 12px 0;                 /* jarak vertikal antar card */
}

/* caption & waktu agar lebih rapi */
.product-card .title {
  margin-top: 8px;
  font: 600 13px/1.4 Inter, system-ui;
  color: #111;
}
.product-card .price {
  font: 500 11.5px/1.3 Inter, system-ui;
  color: #7b7f86;
}

/* Section wrapper per kategori */
.bts-category{ margin: 24px auto 28px; }             /* atur rapatnya di sini */
.kategori{ margin: 12px auto 6px; }
.shop-detail__divider2{
  width:var(--shelf-max);
  margin: 0 auto 12px;             /* ⬅️ tadi salah tulis mmargin */
  height:1px; background:#111; opacity:.18; border:0;
}
.related-products{ width:var(--shelf-max); margin:0 auto 10px; }

/* jarak antar kartu */
:root{ --shelf-gap: 10px; }        /* lebih rapat */

/* Tombol panah (sudah kamu naikkan) */
.carousel-btn{ top: 35%; }

/* =========================
   2) Judul & waktu sejajar dengan frame
   =========================
   Jangan pakai transform: scale pada iframe karena visual mengecil,
   tapi layout lebarnya tetap penuh → teks terlihat “keluar”.
   Pakai wrapper .video-frame dengan lebar yang memang lebih kecil.
*/
.video-frame{
  width: 88%;                      /* kecilkan video secara layout */
  aspect-ratio: 16/9;
  margin: 0 auto;                  /* center */
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 8px 20px rgba(0,0,0,.08);
  background: #000;
}
.video-frame iframe{
  width: 100%;
  height: 100%;
  border: 0;
  display: block;
}

/* Teks sekarang sejajar persis dengan lebar frame */
.product-card{ display:grid; gap:8px; }
.product-card .title{ font:600 13px/1.4 Inter,system-ui; margin:4px auto 0; width:88%; }
.product-card .price{ font:500 11.5px/1.3 Inter,system-ui; color:#7b7f86; margin:0 auto; width:88%; }

/* pastikan wrapper tidak memberi bezel */
.video-frame{
  position: relative;
  width: 88%;              /* ukuran yang kamu mau */
  aspect-ratio: 16 / 9;
  margin: 0 auto;
  border-radius: 16px;
  overflow: hidden;
  background: transparent; /* jangan #000 supaya tidak terlihat sebagai bezel */
}

/* isi frame = full bleed */
.video-frame iframe{
  position: absolute;
  inset: 0;               /* top/right/bottom/left: 0 */
  width: 100%;
  height: 100%;
  border: 0;
  display: block;
  border-radius: 0;       /* radius ikut wrapper */
  transform: none !important;   /* override kalau masih ada scale lama */
  padding: 0 !important;        /* override kalau ada padding bawaan */
  background: transparent !important;
}

/* =============================
   Reveal on scroll – Cinematic
   ============================= */
.reveal{
  opacity: 0;
  transform: translateY(24px);
  transition: opacity .6s cubic-bezier(.2,.7,.2,1),
              transform .6s cubic-bezier(.2,.7,.2,1);
  will-change: opacity, transform;
}
.reveal.is-in{ opacity:1; transform:none; }

/* Horizontal slide variant (optional) */
.reveal-x{ opacity:0; transform: translateX(-28px); transition: opacity .6s cubic-bezier(.2,.7,.2,1), transform .6s cubic-bezier(.2,.7,.2,1); will-change: opacity, transform; }
.reveal-x.is-in{ opacity:1; transform:none; }

/* Stagger container: children fade-in sequentially */
.reveal-stagger > *{
  opacity: 0;
  transform: translateY(18px);
  transition: opacity .55s cubic-bezier(.2,.7,.2,1),
              transform .55s cubic-bezier(.2,.7,.2,1);
  will-change: opacity, transform;
}
.reveal-stagger.is-in > *{ opacity: 1; transform: none; }

/* Accessibility: disable motion for users who prefer reduced motion */
@media (prefers-reduced-motion: reduce){
  .reveal, .reveal-x, .reveal-stagger > *{
    opacity: 1 !important;
    transform: none !important;
    transition: none !important;
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
<h3 class="title reveal">BEHIND THE SCENES</h3>

{{-- @foreach ($film as $item)
<section class="bts-category">   <!-- ⬅️ wrapper per kategori -->
  <span class="kategori">{{ $item->title }}</span>
  <hr class="shop-detail__divider2"/>

  <section class="related-products">
    <div class="carousel-wrapper">
      <button class="carousel-btn prev-btn" aria-label="Sebelumnya">&#10094;</button>
      <div class="carousel-track">
        @foreach ($bts as $items)
          @if ($items->judul == $item->uuid)
            <div class="product-card">
              <div class="video-frame">           <!-- ⬅️ wrapper video (lihat #2) -->
                <iframe
                  src="https://www.youtube.com/embed/{{ $items->link }}"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                  allowfullscreen></iframe>
              </div>
              <p class="title">{{ $items->caption }}</p>
              <p class="price">{{ $items->created_at->diffForHumans() }}</p>
            </div>
          @endif
        @endforeach
      </div>
      <button class="carousel-btn next-btn" aria-label="Berikutnya">&#10095;</button>
    </div>
  </section>
</section>
@endforeach --}}

@foreach ($judul as $items)
  @foreach ($film as $item)
  @if ($item->uuid == $items->judul)
      <section class="bts-category reveal">   <!-- ⬅️ wrapper per kategori -->
        <span class="kategori reveal-x">{{ $item->title }}</span>
        <hr class="shop-detail__divider2"/>

        <section class="related-products">
          <div class="carousel-wrapper">
            <button class="carousel-btn prev-btn" aria-label="Sebelumnya">&#10094;</button>
            <div class="carousel-track reveal-stagger">
              @foreach ($bts as $value)
                @if ($value->judul == $item->uuid)
                  <div class="product-card">
                    <div class="video-frame">           <!-- ⬅️ wrapper video (lihat #2) -->
                      {{-- <iframe
                        src="https://www.youtube.com/embed/{{ $value->link }}"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe> --}}
                        {!! $value->link !!}
                    </div>
                    <p class="title">{{ $value->caption }}</p>
                    <p class="price">{{ $value->created_at->diffForHumans() }}</p>
                  </div>
                @endif
              @endforeach
            </div>
            <button class="carousel-btn next-btn" aria-label="Berikutnya">&#10095;</button>
          </div>
        </section>
      </section>
  @endif
  @endforeach
@endforeach

<script>
/* Carousel controller untuk semua rak */
document.querySelectorAll('.carousel-wrapper').forEach((wrap) => {
  const track = wrap.querySelector('.carousel-track');
  const prev  = wrap.querySelector('.prev-btn');
  const next  = wrap.querySelector('.next-btn');

  function step(){
    const card = track.querySelector('.product-card');
    if(!card) return 0;
    const gap  = parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap || 24);
    return card.getBoundingClientRect().width + gap;
  }
  function update(){
    const max = track.scrollWidth - track.clientWidth - 1;
    prev.disabled = track.scrollLeft <= 0;
    next.disabled = track.scrollLeft >= max;
  }
  prev.addEventListener('click', () => track.scrollBy({ left: -step(), behavior: 'smooth' }));
  next.addEventListener('click', () => track.scrollBy({ left:  step(), behavior: 'smooth'  }));
  track.addEventListener('scroll', update, { passive:true });
  window.addEventListener('resize', update);
  // init
  setTimeout(update, 0);
});
</script>
<script>
// =============================
// Reveal-on-scroll for BTS page
// =============================
(function(){
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (prefersReduced) return; // respect user settings

  const io = new IntersectionObserver((entries)=>{
    entries.forEach(entry=>{
      if(entry.isIntersecting){
        const el = entry.target;
        el.classList.add('is-in');

        // If it's a stagger container, add delay to children
        if(el.classList.contains('reveal-stagger')){
          const kids = Array.from(el.children);
          kids.forEach((child, i)=>{
            child.style.transitionDelay = (90 * i) + 'ms';
          });
        }
        io.unobserve(el); // fire once
      }
    });
  }, { rootMargin: '0px 0px -10% 0px', threshold: 0.12 });

  // Observe all reveal elements
  document.querySelectorAll('.reveal, .reveal-x, .reveal-stagger').forEach(el=> io.observe(el));
})();
</script>