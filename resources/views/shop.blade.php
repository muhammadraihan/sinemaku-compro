@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')

<style>
/* ---------- NAV ---------- */
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

/* ---------- HERO DETAIL PRODUK ---------- */
.shop-detail{ padding:clamp(32px,4.5vw,72px) 0; background:#fff; color:#131313; }
.shop-detail__container{
  width:min(1280px,92vw);
  margin:0 auto;
  display:grid;
  gap:clamp(20px,3.2vw,48px);
  grid-template-columns:1.2fr 1fr;
  align-items:start;
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
  font-weight:500;
  line-height:.95;
  letter-spacing:-.5px;
  font-size:clamp(28px,3.2vw,44px);
  margin-top:clamp(0px,1vw,8px);
}
@media (min-width: 961px){
  .shop-detail__title{ margin-top: 144px; }
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
  --shelf-gap: clamp(14px, 2.2vw, 32px);
}
.kategori{
  display:block;
  width:var(--shelf-max);
  margin:clamp(18px,3.6vw,28px) auto 6px;
  font:600 10px/1 Inter,Arial,sans-serif;
  letter-spacing:.16em;
  text-transform:uppercase;
  color:#6a6a6a;
}
.shop-detail__divider2{
  width:var(--shelf-max);
  margin:0 auto clamp(10px,1.6vw,16px);
  height:1px;
  background:#111;
  opacity:.18;
  border:0;
}

/* ---------- SHELF (CAROUSEL) ala A24 ---------- */
.related-products{
  width:var(--shelf-max);
  margin:0 auto clamp(16px,2.2vw,24px);
}
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
  padding:0 12px 8px; scroll-padding-inline:12px; scrollbar-width:none;
}
.carousel-track::-webkit-scrollbar{ display:none; }

/* kartu produk */
.product-card{ scroll-snap-align:start; display:grid; gap:10px; text-align:left; color:#111; }
.product-card a{ display:block; text-decoration:none; color:inherit; }
.product-card{ gap:8px; }
.product-card img{
  width:100%; height:auto; aspect-ratio:4/3; object-fit:contain;
  border-radius:12px; padding:clamp(14px,2vw,22px); box-shadow:0 10px 24px rgba(0,0,0,.05);
  transition:transform .18s, box-shadow .18s;
  background: transparent !important;
  box-shadow: none !important;
  padding: 0 !important;
  border-radius: 0 !important;
}
.product-card:hover img{ transform:translateY(-3px); box-shadow:0 12px 30px rgba(0,0,0,.08); }
.product-card .title{ margin:6px 0 2px; font:400 12px/1.35 Inter,Arial,sans-serif; }
.product-card .price{ margin:0; color:#444; font:300 11px/1 Inter,Arial,sans-serif; }

/* tombol panah */
.carousel-btn{
  position:absolute;
  top:40%;
  transform:translateY(-50%);
  width:44px;
  height:44px;
  display:grid;
  place-items:center;
  border-radius:50%;
  border:1px solid rgba(0,0,0,.12);
  background:#fff;
  color:#111;
  box-shadow:0 6px 18px rgba(0,0,0,.08);
  cursor:pointer;
  transition:background .18s,color .18s,transform .18s;
  z-index:10;
}
.carousel-btn:hover{ background:#111; color:#fff; }
.prev-btn{ left:16px; }
.next-btn{ right:16px; }
.carousel-btn[disabled]{ opacity:.35; pointer-events:none; }

@media (max-width:640px){
  :root{ --shelf-col: clamp(220px, 78vw, 360px); }
  .prev-btn{ left:8px; } .next-btn{ right:8px; }
}

@media (max-width: 560px){
  .shop-detail{ padding: 24px 0; }
  .shop-detail__container{ gap:6px;  background: transparent !important; }
  .shop-detail__media{ background: transparent !important;}
  .shop-detail__title{ font-size: clamp(22px, 7vw, 32px); margin-top: clamp(24px, 14vw, 68px); }
  .shop-detail__note{ font-size: 12.5px; margin:16px 0; }
  :root{ --shelf-col: clamp(220px, 82vw, 360px); --shelf-gap: 12px; }
  .carousel-btn{ top:34%; width:38px; height:38px; }
  .kategori{ margin:16px auto 6px; }
  .shop-detail__divider2{ margin:0 auto 10px; }
  .product-card .title{ font-size:12.5px; }
  .product-card .price{ font-size:11.5px; }

  /* extra breathing room so CTA doesn't collide on mobile */
  .shop-detail__info{ padding-top: 6px; }
  .shop-detail__cta{ margin-top: clamp(14px, 4.8vw, 24px); }
  /* when multiple category containers stack, add spacing between blocks */
  .shop-detail__container + .shop-detail__container{ margin-top: clamp(12px, 4vw, 20px); }
}

@media (min-width: 561px) and (max-width: 960px){
  .shop-detail__title{ margin-top: clamp(16px, 6vw, 40px); }
}

/* ===================== SCROLL REVEAL (Cinematic) ===================== */
@media (prefers-reduced-motion: no-preference){
  .reveal{
    opacity:0;
    transform: translateY(22px);
    filter: blur(.1px);
    transition:
      opacity .72s cubic-bezier(.22,.61,.36,1),
      transform .72s cubic-bezier(.22,.61,.36,1),
      filter .72s cubic-bezier(.22,.61,.36,1);
    will-change: opacity, transform, filter;
  }
  .reveal.is-inview{
    opacity:1;
    transform:none;
    filter:none;
  }
  /* Stagger: apply to container, children will animate berurutan */
  .reveal-stagger > *{
    opacity:0;
    transform: translateY(18px);
    transition:
      opacity .6s cubic-bezier(.22,.61,.36,1),
      transform .6s cubic-bezier(.22,.61,.36,1);
    will-change: opacity, transform;
  }
  .reveal-stagger.is-inview > *{
    opacity:1;
    transform:none;
  }
  /* Delay per child via CSS var --i, set dari JS */
  .reveal-stagger.is-inview > *{
    transition-delay: calc(var(--i, 0) * 90ms);
  }
}
@media (prefers-reduced-motion: reduce){
  .reveal, .reveal-stagger > *{ opacity:1 !important; transform:none !important; filter:none !important; }
}
</style>
<section class="shop-detail">
  <div class="shop-detail__container">
    <div class="shop-detail__media">
      <img src="{{ asset('photo/' . $shop->photo) }}" alt="Kaos Perayaan Mati Rasa" />
    </div>
    <div class="shop-detail__info">
      <h1 class="shop-detail__title">{{ $shop->name }}</h1>
      <p class="shop-detail__note">
        {{ $shop->judul }}
      </p>
      <div class="shop-detail__price">{{ $shop->harga ? 'Rp'.''.str_replace(',', '.', number_format($shop->harga)) : ''; }}</div>
      <a class="shop-detail__cta" href="{{ route('detail-shop', $shop->slug) }}" rel="noopener">
        <span class="detail">VIEW PRODUCT</span>
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
    </div>
  </div>
</section>

@foreach ($merchandise as $item)
    <span class="kategori">{{ $item->merchandise }} COLLECTION</span>
      <hr class="shop-detail__divider2"/>

      {{-- ====== RAK 1 ====== --}}
      <section class="related-products">
        <div class="carousel-wrapper">
          {{-- <button class="carousel-btn prev-btn" aria-label="Sebelumnya">&#10094;</button> --}}
          <div class="carousel-track">
            @foreach ($all_merchandise as $items)
                @if ($items->merchandise == $item->merchandise)
                    <div class="product-card">
                      <a href="{{ route('detail-shop', $items->slug) }}">
                        <img src="{{ asset('photo/' . $items->photo) }}" alt="{{ $items->kategorishop }}"><p class="title">{{ $items->name }}</p><p class="price">{{ $items->harga ? 'Rp'.''.str_replace(',', '.', number_format($items->harga)) : ''; }}</p>
                      </a>
                    </div>
                @endif
            @endforeach
          </div>
          {{-- <button class="carousel-btn next-btn" aria-label="Berikutnya">&#10095;</button> --}}
        </div>
      </section>

      <br><br><br>
@endforeach

<span class="kategori">SHOP BY CATEGORY</span>
<hr class="shop-detail__divider2"/>

<section class="shop-detail">
  @foreach ($kategorishop as $item)
    @foreach ($all_merchandise as $items)
      @if ($item->uuid == $items->kategorishop)
          <div class="shop-detail__container">
            <div class="shop-detail__media"><img src="{{ asset('photo/' . $items->photo) }}" alt="{{ $item->name }}" /></div>
            <div class="shop-detail__info">
              <h1 class="shop-detail__title">{{ strtoupper($item->name) }}</h1>
              <a class="shop-detail__cta" href="{{ route('detail-kategori', $item->uuid) }}" rel="noopener">
                <span class="detail">VIEW PRODUCT</span>
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </a>
            </div>
          </div>
          @break
      @endif
    @endforeach
  @endforeach
</section>

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
// ===== Scroll Reveal (Cinematic) =====
(function(){
  const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if(reduce) return;

  // Helper: add 'reveal' to single targets and 'reveal-stagger' to lists
  const singleSelectors = [
    '.shop-detail',                     // section header blocks
    '.shop-detail__container',
    '.shop-detail__info',
    '.shop-detail__media',
    '.kategori',
    '.shop-detail__divider2',
    '.related-products'
  ];

  const listSelectors = [
    '.carousel-track',                  // product lists (you might also like racks)
    '.shop-detail__container .shop-detail__info', // title + button (for subtle stagger)
  ];

  // Mark singles
  singleSelectors.forEach(sel => {
    document.querySelectorAll(sel).forEach(el => el.classList.add('reveal'));
  });

  // Mark lists & assign child delays
  listSelectors.forEach(sel => {
    document.querySelectorAll(sel).forEach(list => {
      list.classList.add('reveal-stagger');
      const kids = list.matches('.carousel-track')
        ? list.querySelectorAll('.product-card')
        : list.children;

      kids.forEach((child, i) => {
        child.style.setProperty('--i', i);
      });
    });
  });

  // Also stagger product-card internals (title + price) for a nicer feel
  document.querySelectorAll('.product-card').forEach(card => {
    card.classList.add('reveal-stagger');
    [...card.children].forEach((child, i) => child.style.setProperty('--i', i));
  });

  // Observer
  const io = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if(entry.isIntersecting){
        entry.target.classList.add('is-inview');
        obs.unobserve(entry.target);
      }
    });
  }, {
    root: null,
    threshold: 0.12,
    rootMargin: '0px 0px -10% 0px'
  });

  // Observe all
  document.querySelectorAll('.reveal, .reveal-stagger').forEach(el => io.observe(el));
})();
</script>