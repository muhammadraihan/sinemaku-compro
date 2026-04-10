@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')
<style>
  /* ---------- NAVBAR (tetap) ---------- */


  :root {
    --ink: #0A0A0A;
    --muted: #6b7280;
    --line: #e6e6e6;
    --surface: #ffffff;

    /* layout */
    --mediaW: 460px;
    /* lebar kolom gambar (desktop) */
    --ribbonW: 74px;
    /* lebar pita vertikal kanan */
  }

  /* ===== Base (safe-area agar tidak nabrak navbar) ===== */
  .event-page {
    padding: clamp(88px, 11vh, 120px) 0 56px;
    /* top diberi ruang */
    color: var(--ink);
    background: #fff;
  }

  /* ===== Heading strip (tanpa tanggal di kanan) ===== */
  .event-list .section-heading {
    font: 800 clamp(28px, 3vw, 36px)/1.08 Inter, system-ui;
    padding: 18px clamp(16px, 5vw, 64px);
    margin: 0 0 clamp(12px, 1.2vw, 18px);
  }

  /* ===== Grid ===== */
  .stories-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 30px;
    /* edge-to-edge antar kartu */
  }

  /* ===== SECTION DETAIL CAREER ===== */
  .jobdetail {
    margin-top: 100px;
    background: #fff;
    padding: clamp(24px, 4vw, 40px) 0;
  }

  .jobdetail__wrap {
    max-width: 1120px;
    margin: 0 auto;
    padding: 0 20px;
    display: grid;
    grid-template-columns: 1.5fr .9fr;
    gap: 34px;
  }

  @media (max-width:960px) {
    .jobdetail__wrap {
      grid-template-columns: 1fr;
    }
  }

  /* Left */
  .jobdetail__topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
  }

  .btn-back {
    display: inline-flex;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    align-items: center;
    justify-content: center;
    color: #42454d;
    background: #f3f4f6;
    border: 1px solid #eceef2;
  }

  .btn-back:hover {
    background: #fff;
    box-shadow: 0 8px 20px rgba(10, 10, 20, .08);
  }

  .btn-pill {
    margin-left: 0px;
    margin-bottom: 10px;
    padding: .45rem .7rem;
    border-radius: 8px;
    background: #f3e7b8;
    color: #6a5312;
    font: 700 12.5px/1 Inter, system-ui;
    text-decoration: none;
    border: 1px solid #eadf9a;
  }

  .jobdetail__title {
    font: 700 clamp(25px, 4.2vw, 35px)/1.1 "Libre Baskerville", serif;
    margin: .2rem 0;
  }

  .jobdetail__dept {
    color: #727a86;
    font: 400 14px/1.2 Inter, system-ui;
    margin-bottom: 10px;
  }

  .jobdetail__meta {
    display: flex;
    flex-wrap: wrap;
    gap: 14px 18px;
    margin: 25px 0 28px;
    padding: 0;
  }

  .jobdetail__meta li {
    list-style: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #505763;
    background: #f7f8fa;
    border: 1px solid #eceef2;
    padding: 8px 12px;
    border-radius: 10px;
    font: 600 13px/1 Inter, system-ui;
  }

  .jobdetail__meta svg {
    width: 18px;
    height: 18px;
    color: #9aa0a6
  }

  /* Typo sections */
  .h2 {
    font: 700 22px/1.24 Inter, system-ui;
    margin: 18px 0 8px;
    color: #111317;
  }

  .h3 {
    font: 700 16.5px/1.2 Inter, system-ui;
    margin: 16px 0 8px;
    color: #111317;
  }

  .jobdetail__main p {
    color: #2b2f36;
    font: 400 14.8px/1.7 Inter, system-ui;
    margin: 0 0 12px;
  }

  .list {
    padding-left: 1.2rem;
    margin: 0 0 18px;
  }

  .list li {
    margin: 6px 0;
    color: #2b2f36;
    font: 400 14.6px/1.65 Inter, system-ui;
  }

  /* Sidebar */
  .jobdetail__side {
    position: relative;
  }

  @media (min-width:961px) {
    .jobdetail__side {
      position: sticky;
      top: 24px;
      height: fit-content;
    }
  }

  .applybox {
    border: 1px solid #eceef2;
    border-radius: 14px;
    background: #fff;
    padding: 18px 16px;
    box-shadow: 0 8px 24px rgba(10, 10, 20, .06);
    margin-bottom: 28px;
  }

  .applybox h4 {
    font: 800 15px/1.1 Inter, system-ui;
    margin: 0 0 10px;
    color: #101317;
  }

  .applybox__meta {
    margin: 0 0 12px;
    padding: 0;
    display: grid;
    gap: 1px;
  }

  .applybox__meta li {
    margin-top: 12px;
    list-style: none;
    display: flex;
    gap: 12px;
    align-items: center;
    color: #505763;
    font: 600 13px/1.1 Inter, system-ui;
  }

  .applybox__meta svg {
    width: 18px;
    height: 18px;
    color: #9aa0a6
  }

  .btn-apply {
    padding: 0 20px;
    width: auto;
    max-width: max-content;
    margin-top: 5px;
    margin-bottom: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    height: 44px;
    border-radius: 10px;
    border: 1px solid #e8e9ed;
    background: #111317;
    color: #fff;
    font: 800 12.8px/1 Inter, system-ui;
    letter-spacing: .3px;
    text-decoration: none;
  }

  .btn-apply:hover {
    filter: brightness(1.03);
    box-shadow: 0 10px 24px rgba(10, 10, 20, .18);
  }

  .btn-apply svg {
    width: 18px;
    height: 18px;
    color: currentColor
  }

  .applybox__note {
    margin: 10px 0 0;
    color: #7a808b;
    font: 300 11px/1.45 Inter, system-ui
  }

  /* Others */
  .others {
    border: 1px solid #eceef2;
    border-radius: 14px;
    background: #fff;
    padding: 18px 16px;
    box-shadow: 0 8px 24px rgba(10, 10, 20, .06);
    margin-bottom: 28px;
  }

  .others h4 {
    font: 600 15px/1.1 Inter, system-ui;
    margin: 0 0 8px
  }

  .mini {
    display: flex;
    align-items: flex-start;
    /* biar tinggi tak dipaksa sejajar */
    justify-content: space-between;
    gap: 18px;
    /* sedikit lebih rapat */
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #eef0f3;
    text-decoration: none;
    color: inherit;
    margin: 8px 0;
  }

  .mini__text {
    flex: 1 1 auto;
    /* ambil sisa ruang */
    min-width: 0;
    /* <— kunci agar boleh wrap di flex */
  }

  .mini:hover {
    background: #fafbfc;
    border-color: #e6e9ef
  }

  .mini__title {
    font: 700 13px/1.25 Inter, system-ui;
    color: #111317;
    overflow-wrap: anywhere;
    /* bungkus kata panjang */
    word-break: break-word;
  }

  .mini__meta {
    margin-top: 8px;
    font: 600 10px/1.25 Inter, system-ui;
    color: #6f7783;
    overflow-wrap: anywhere;
    word-break: break-word;
  }

  /* badge jangan menyusut & tetap di kanan */
  /* --- Badge base (tidak mengubah warna) --- */
  .mini__badge,
  .mini__badge_danger {
    flex: 0 0 auto;
    /* jangan menyusut */
    display: inline-flex;
    align-items: center;
    white-space: nowrap;
    padding: 6px 10px;
    border-radius: 8px;
  }

  /* Normal badge (kuning) */
  .mini__badge {
    font: 600 10px/1 Inter, system-ui;
    background: #f3e7b8;
    color: #6a5312;
    border: 1px solid #eadf9a;
  }

  /* Danger badge (merah) — frame merah kembali */
  .mini__badge_danger {
    font: 800 12px/1 Inter, system-ui;
    background: #f3b8b8;
    color: #6a1212;
    border: 1px solid #ea9a9a;
  }

  /* responsif: jika sempit, badge turun ke baris bawah */
  @media (max-width:520px) {
    .mini {
      flex-wrap: wrap;
    }

    .mini__badge,
    .mini__badge_danger {
      margin-top: 8px;
    }
  }

  /* ===== Scroll-reveal (cinematic) ===== */
  html.js .reveal-y {
    opacity: 0;
    transform: translateY(18px);
    transition: opacity .6s cubic-bezier(.22, .61, .36, 1), transform .6s cubic-bezier(.22, .61, .36, 1);
    will-change: opacity, transform;
  }

  html.js .reveal-x {
    opacity: 0;
    transform: translateX(18px);
    transition: opacity .6s cubic-bezier(.22, .61, .36, 1), transform .6s cubic-bezier(.22, .61, .36, 1);
    will-change: opacity, transform;
  }

  html.js .is-revealed {
    opacity: 1 !important;
    transform: none !important;
  }

  /* Stagger container: anak-anak di-animate berurutan */
  html.js .reveal-stagger>* {
    opacity: 0;
    transform: translateY(14px);
    transition: opacity .6s cubic-bezier(.22, .61, .36, 1), transform .6s cubic-bezier(.22, .61, .36, 1);
    will-change: opacity, transform;
  }

  html.js .reveal-stagger.is-revealed>* {
    opacity: 1;
    transform: none;
  }

  .reveal-m,
  .reveal-y,
  .reveal-x {
    opacity: 1 !important;
    transform: none !important;
    transition: none !important;
  }

  .jobdetail__content p {
    font-size: 1.25rem;
    font-weight: 300;
    line-height: 1.6;
    margin-bottom: 1rem;
  }

  .jobdetail__content h2 {
    font-family: 'Inter', sans-serif;
    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1.6;
    margin-bottom: 1rem;
  }

  .jobdetail__content h3 {
    font-family: 'Inter', sans-serif;
    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1.6;
    margin-bottom: 1rem;
  }

  .jobdetail__content blockquote {
    font-family: 'Inter', sans-serif;
    font-size: 1.25rem;
    font-weight: 500;
    line-height: 1.6;
    margin-bottom: 1rem;
  }

  .jobdetail__content ul {
    font-family: 'Inter', sans-serif;
    font-size: 1.25rem;
    font-weight: 300;
    line-height: 1.6;
    margin-bottom: 1rem;
  }
</style>
<section class="jobdetail">
  <div class="jobdetail__wrap">
    <!-- ====== LEFT: content ====== -->
    <article class="jobdetail__main">
      <div class="jobdetail__topbar reveal-y" data-reveal="0.02">

        @if (!empty($careers->status))
          <a class="btn-pill" href="#">{{ $careers->status}}</a>
        @endif
      </div>

      <h1 class="jobdetail__title reveal-y" data-reveal="0.08">{{ $careers->position ?? $casting->pemeran }}</h1>
      <div class="jobdetail__dept reveal-y" data-reveal="0.12">{{ $careers->tim ?? $casting->judul_film }}</div>

      <ul class="jobdetail__meta reveal-y" data-reveal="0.16">
        <li>
          <svg viewBox="0 0 24 24">
            <path d="M12 21s-7-4.35-7-10a7 7 0 0 1 14 0c0 5.65-7 10-7 10Z" fill="none" stroke="currentColor"
              stroke-width="1.7" />
            <circle cx="12" cy="11" r="2" fill="currentColor" />
          </svg>
          {{ $careers->location ?? $casting->location }}
        </li>
        @if (!empty($careers->status))
          <li>
            <svg viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.7" />
              <path d="M12 7v5h4" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
            {{ $careers->created_at->diffForHumans() }}
          </li>
        @else
          <li>
            <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <!-- kalender -->
              <rect x="3" y="5" width="18" height="16" rx="2" />
              <path d="M8 3v4M16 3v4M3 10h18" />
              <!-- clap kecil di kanan-bawah -->
              <path d="M13.5 15.5h5v3h-5z" />
              <path d="M13.5 15.5l3-2h2v2h-5z" />
            </svg>

            Shoot: {{ \Carbon\Carbon::parse($casting->shoot_date)->format('d M Y') }}
          </li>
        @endif
        @if (!empty($careers->status))
          <li>
            <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="7" width="18" height="10" rx="2" />
              <circle cx="12" cy="12" r="2.6" /> <!-- lingkar tengah uang -->
              <path d="M6 10v4M18 10v4" /> <!-- detail sisi uang -->
            </svg>

            {{ $careers->salary ? 'Rp' . '' . str_replace(',', '.', number_format($careers->salary)) : '' }}
          </li>
        @else
          <li>
            <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="7" r="3.2" />
              <path d="M5 19a7 7 0 0 1 14 0" />
              <!-- badge kecil (bisa dipakai label gender/umur via text CSS terpisah) -->
              <circle cx="18.5" cy="8.5" r="2.2" />
            </svg>

            {{ $casting->gender == 'L' ? 'Pria' : 'Wanita' }}, {{ $casting->umur }}
          </li>
        @endif
        @if (!empty($careers->status))
          <li>
            <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <title>Experience</title>
              <path d="M12 3.5l2.3 4.7 5.2.8-3.8 3.7.9 5.2L12 15.9 7.4 18l.9-5.2-3.8-3.7 5.2-.8L12 3.5z" />
            </svg>

            {{ $careers->pengalaman }} experience
          </li>
        @else
          <li>
            <svg viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.7" />
              <path d="M12 7v5h4" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
            Deadline: {{ \Carbon\Carbon::parse($casting->deadline)->format('d M Y') }}
          </li>
        @endif
      </ul>
      <a class="btn-apply reveal-y" data-reveal="0.20" href="{{ $careers->link ?? $casting->link }}" target="_blank"
        rel="noopener noreferrer">
        APPLY NOW
        <svg viewBox="0 0 24 24">
          <path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
      </a>

      <div class="jobdetail__content reveal-y" data-reveal="0.24">
        {!! $careers->detail ?? $casting->detail !!}
      </div>
    </article>

    <!-- ====== RIGHT: sidebar ====== -->
    <aside class="jobdetail__side">

      <div class="others reveal-y reveal-stagger" data-reveal="0.10" data-stagger="80">
        <h4>Other Open Positions</h4>

        @if (!empty($careers->status))
          @foreach ($all_careers as $item)
            <a class="mini" href="{{ route('detail-careers', $item->slug) }}">
              <div class="mini__text">
                <div class="mini__title">{{ $item->position }}</div>
                <div class="mini__meta">{{ $item->tim }} · {{ $item->location }}</div>
              </div>
              <span class="mini__badge">{{ $item->status }}</span>
            </a>
          @endforeach
        @else
          @foreach ($all_casting as $item)
            <a class="mini" href="{{ route('detail-careers', $item->slug) }}">
              <div class="mini__text">
                <div class="mini__title">{{ $item->pemeran }}</div>
                <div class="mini__meta">{{ $item->judul_film }} · {{ $item->location }}</div>
              </div>
              <span class="mini__badge_danger">{{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}</span>
            </a>
          @endforeach
        @endif

      </div>
    </aside>
  </div>

</section>

<script>
  (function () {
    // Progressive enhancement: only animate when JS is present
    document.documentElement.classList.add('js');

    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var el = entry.target;
          el.classList.add('is-revealed');

          // If this is a stagger container, cascade delays to children
          if (el.classList.contains('reveal-stagger')) {
            var base = parseInt(el.getAttribute('data-stagger') || '80', 10); // ms
            Array.prototype.forEach.call(el.children, function (child, i) {
              child.style.transitionDelay = ((parseFloat(el.getAttribute('data-reveal') || '0') * 1000 + base * i) / 1000) + 's';
            });
          } else {
            // Apply single delay via data-reveal (seconds)
            var d = parseFloat(el.getAttribute('data-reveal') || '0');
            if (d > 0) {
              el.style.transitionDelay = d + 's';
            }
          }

          io.unobserve(el);
        }
      });
    }, { rootMargin: '0px 0px -10% 0px', threshold: 0.14 });

    // Observe all reveal targets
    document.querySelectorAll('.reveal-y, .reveal-x, .reveal-stagger').forEach(function (el) {
      io.observe(el);
    });
  })();
</script>