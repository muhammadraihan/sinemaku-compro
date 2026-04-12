@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@section('content')

@include('partials.navbar')
<style>

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
    font:800 clamp(28px,3vw,36px)/1.08;

    padding:18px clamp(16px,5vw,64px);
    margin:0 0 clamp(12px,1.2vw,18px);
  }

  /* ===== Grid ===== */
  .stories-grid{
    display:grid;
    grid-template-columns: 1fr;
    gap:30px; /* edge-to-edge antar kartu */
  }

  /* ===== Card (3 kolom: gambar | konten | pita) ===== */
  .article-card{
    display:grid;
    grid-template-columns: minmax(200px,var(--mediaW)) 1fr var(--ribbonW);
    align-items:stretch;
    background:var(--surface);
    border-top:1px solid var(--line);
    border-bottom:1px solid var(--line);
  }

  /* Kiri: gambar diberi padding agar “sinematik” */
  .article-card .thumb{
    display:block; overflow:hidden;
    border-right:1px solid var(--line);
    padding: clamp(14px, 2.4vw, 28px);
    background:#fff;
  }
  .article-card .thumb img{
    width:100%; height: clamp(100px, 18vw, 220px);
    object-fit:cover; display:block;
    box-shadow:0 12px 28px rgba(2,8,23,.14);
    transform:scale(1); transition:transform .55s cubic-bezier(.2,.8,.2,1);
  }
  .article-card:hover .thumb img{ transform:scale(1.03); }

  /* Tengah: konten */
  .card-body{
    padding: clamp(18px,2.6vw,30px) clamp(16px,5vw,56px);
    display:grid; gap:12px; align-content:start;
  }
  .card-title{
    font:700 clamp(20px, 2vw, 24px)/1.2;

    color:#111; text-decoration:none; letter-spacing:.1px;
    padding-top: 20px;
  }
  
  /* Title link sizes to its text only */
.card-title{
  position: relative;
  display: inline-block !important;   /* override any global rule */
  width: fit-content;                  /* shrink to text */
  max-width: 100%;
  text-decoration: none;
  font:700 clamp(20px, 2vw, 24px)/1.2;

  color:#111; letter-spacing:.1px;
  padding-top:20px;
  justify-self: start;                 /* if inside CSS Grid */
}

/* animated underline */
.card-title::after{
  content:"";
  position:absolute;
  left:0;
  bottom:-4px;
  height:2px;
  width:0;                             /* start hidden */
  background:#111;
  transition:width .3s ease;
}
.card-title:hover::after{ width:100%; } /* now 100% = text width */

  .card-excerpt{
    color:#3b3b3b; line-height:1.6; max-width: 80ch;
  }

  /* meta row (waktu & lokasi) */
  .card-meta{ display:flex; flex-wrap:wrap; gap:10px 12px; }
  .meta-chip{
    display:inline-flex; align-items:center; gap:8px;
    padding:6px 10px; border:1px solid var(--line); border-radius:6px;
    background:#fff; font:600 12px/1; color:#111;

  }

  /* Kanan: pita vertikal klikable */
  .card-actions{
    border-left:1px solid var(--line);
    background:#0c1118;
    display:flex; align-items:center; justify-content:center;
  }
  .card-actions a{
    writing-mode: vertical-rl; transform:rotate(180deg);
    width:100%; height:30%;
    display:flex; align-items:center; justify-content:center;
    color:#fff; text-decoration:none;
    font:800 12px/1; letter-spacing:.16em; text-transform:uppercase;

    transition:background .18s ease;
    white-space: nowrap;
  }
  .card-actions a:hover{ 
      background: #111;
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 10px 24px rgba(0,0,0,.08);
      width:100%; height:30%;
    }

  /* ===== Responsive ===== */
  @media (max-width:1180px){
    :root{ --mediaW: 400px; --ribbonW: 68px; }
  }
  @media (max-width:900px){
    :root{ --mediaW: 340px; --ribbonW: 60px; }
  }
  @media (max-width:760px){
    .article-card{ grid-template-columns: 1fr; }
    .article-card .thumb{ border-right:0; padding: clamp(10px,3vw,16px); }
    .article-card .thumb img{ height: clamp(180px, 44vw, 240px); }
    .card-actions{
      order:3; border-left:0; background:transparent;
      padding: 0 clamp(16px,5vw,24px) 16px;
      justify-content:flex-start;
    }
    .card-actions a{
      writing-mode: horizontal-tb; transform:none;
      background:#111; border-radius:999px; padding:12px 16px; width:auto; height:auto;
      letter-spacing:.08em;
    }
  }

  /* ===== Reveal on Scroll (cinematic) ===== */
  .reveal{opacity:0; transform:translateY(20px); transition:opacity .6s ease, transform .6s cubic-bezier(.2,.7,.2,1);} 
  .reveal-x{opacity:0; transform:translateX(24px); transition:opacity .6s ease, transform .6s cubic-bezier(.2,.7,.2,1);} 
  .reveal-x.left{ transform: translateX(-24px); }
  .reveal.is-in, .reveal-x.is-in{ opacity:1; transform:none; }

  /* Small stagger helper */
  .reveal-stagger > *{ opacity:0; transform:translateY(18px); transition:opacity .6s, transform .6s cubic-bezier(.2,.7,.2,1); }
  .reveal-stagger.is-in > *{ opacity:1; transform:none; }
  .reveal-stagger.is-in > *{ transition-delay: var(--rd, 0ms); }

  /* Respect reduced motion */
  @media (prefers-reduced-motion: reduce){
    .reveal, .reveal-x, .reveal-stagger > *{ opacity:1 !important; transform:none !important; transition:none !important; }
  }
  .reveal-m,
.reveal-y,
.reveal-x {
  opacity: 1 !important;
  transform: none !important;
  transition: none !important;
}
</style>

<section class="event-page">

  <!-- ====== All Event (edge-to-edge) ====== -->
  <div class="event-list">
    <h2 class="section-heading reveal">Events</h2>

    <div class="stories-grid">
      @foreach ($event as $item)
          <article class="article-card reveal">
            <a href="{{ route('detail-event', $item->slug) }}" class="thumb reveal-x left">
              <img src="{{ asset('photo/' . $item->photo) }}" alt="Artikel 1">
            </a>

            <div class="card-body reveal-stagger">
              <a href="{{ route('detail-event', $item->slug) }}" class="card-title">
                {{ $item->judul }}
              </a>
              <p class="card-excerpt">
                {{ $item->title }}
              </p>
              <div class="card-meta">
                <!-- waktu -->
                <span class="meta-chip">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <!-- badan kalender -->
                    <rect x="3" y="5" width="18" height="16" rx="2"
                          stroke="currentColor" stroke-width="2"/>
                    <!-- cincin atas -->
                    <line x1="8"  y1="3" x2="8"  y2="7"
                          stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <line x1="16" y1="3" x2="16" y2="7"
                          stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <!-- garis pemisah header -->
                    <line x1="3"  y1="11" x2="21" y2="11"
                          stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  </svg>

                  {{ \Carbon\Carbon::parse($item->tgl_event)->format('d M Y') }}
                </span>
                <!-- lokasi -->
                <span class="meta-chip">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z"
                          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="2"/>
                  </svg>
                  {{ $item->location }}
                </span>
              </div>
            </div>

            <div class="card-actions reveal-x">
              <a href="{{ route('detail-event', $item->slug) }}">SEE EVENT DETAIL</a>
            </div>
          </article>
      @endforeach
    </div>
  </div>

</section>
<script>
(function(){
  const supportsIO = 'IntersectionObserver' in window;
  if(!supportsIO) {
    document.querySelectorAll('.reveal, .reveal-x, .reveal-stagger').forEach(el=>el.classList.add('is-in'));
    return;
  }

  const io = new IntersectionObserver((entries)=>{
    entries.forEach(entry=>{
      if(entry.isIntersecting){
        const el = entry.target;
        // If it's a stagger container, apply staggered delays to children
        if(el.classList.contains('reveal-stagger')){
          const kids = Array.from(el.children);
          kids.forEach((child, i)=>{
            child.style.setProperty('--rd', (i*80)+'ms');
            // ensure each child has a base transition
            child.classList.add('reveal');
            requestAnimationFrame(()=>child.classList.add('is-in'));
          });
        }
        el.classList.add('is-in');
        io.unobserve(el);
      }
    });
  }, { root:null, rootMargin:'0px 0px -5% 0px', threshold:0.08 });

  document.querySelectorAll('.reveal, .reveal-x, .reveal-stagger').forEach(el=>io.observe(el));
})();
</script>

@include('components.footer')
@endsection