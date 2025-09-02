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

  /* ===== SECTION DETAIL CAREER ===== */
  .jobdetail{ margin-top: 100px; background:#fff;padding:clamp(24px,4vw,40px) 0;}
  .jobdetail__wrap{max-width:1120px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:1.5fr .9fr;gap:34px;}
  @media (max-width:960px){.jobdetail__wrap{grid-template-columns:1fr;}}

  /* Left */
  .jobdetail__topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;}
  .btn-back{display:inline-flex;width:36px;height:36px;border-radius:10px;align-items:center;justify-content:center;color:#42454d;background:#f3f4f6;border:1px solid #eceef2;}
  .btn-back:hover{background:#fff;box-shadow:0 8px 20px rgba(10,10,20,.08);}
  .btn-pill{ margin-left: 600px; padding:.45rem .7rem;border-radius:8px;background:#f3e7b8;color:#6a5312;font:700 12.5px/1 Inter,system-ui;text-decoration:none;border:1px solid #eadf9a;}
  .jobdetail__title{font:700 clamp(25px,4.2vw,35px)/1.1 "Libre Baskerville",serif;margin:.2rem 0;}
  .jobdetail__dept{color:#727a86;font:400 14px/1.2 Inter,system-ui;margin-bottom:10px;}
  .jobdetail__meta{display:flex;flex-wrap:wrap;gap:14px 18px;margin:25px 0 28px;padding:0;}
  .jobdetail__meta li{list-style:none;display:inline-flex;align-items:center;gap:8px;color:#505763;background:#f7f8fa;border:1px solid #eceef2;padding:8px 12px;border-radius:10px;font:600 13px/1 Inter,system-ui;}
  .jobdetail__meta svg{width:18px;height:18px;color:#9aa0a6}

  /* Typo sections */
  .h2{font:700 22px/1.24 Inter,system-ui;margin:18px 0 8px;color:#111317;}
  .h3{font:700 16.5px/1.2 Inter,system-ui;margin:16px 0 8px;color:#111317;}
  .jobdetail__main p{color:#2b2f36;font:400 14.8px/1.7 Inter,system-ui;margin:0 0 12px;}
  .list{padding-left:1.2rem;margin:0 0 18px;}
  .list li{margin:6px 0;color:#2b2f36;font:400 14.6px/1.65 Inter,system-ui;}

  /* Sidebar */
  .jobdetail__side{position:relative;}
  @media (min-width:961px){.jobdetail__side{position:sticky;top:24px;height:fit-content;}}
  .applybox{border:1px solid #eceef2;border-radius:14px;background:#fff;padding:18px 16px;box-shadow:0 8px 24px rgba(10,10,20,.06);margin-bottom:28px;}
  .applybox h4{font:800 15px/1.1 Inter,system-ui;margin:0 0 10px;color:#101317;}
  .applybox__meta{margin:0 0 12px;padding:0;display:grid;gap:1px;}
  .applybox__meta li{margin-top: 12px; list-style:none;display:flex;gap:12px;align-items:center;color:#505763;font:600 13px/1.1 Inter,system-ui;}
  .applybox__meta svg{width:18px;height:18px;color:#9aa0a6}
  .btn-apply{margin-top: 20px; display:flex;justify-content:center;align-items:center;gap:10px;height:44px;border-radius:10px;border:1px solid #e8e9ed;background:#111317;color:#fff;font:800 12.8px/1 Inter,system-ui;letter-spacing:.3px;text-decoration:none;}
  .btn-apply:hover{filter:brightness(1.03);box-shadow:0 10px 24px rgba(10,10,20,.18);}
  .btn-apply svg{width:18px;height:18px;color:currentColor}
  .applybox__note{margin:10px 0 0;color:#7a808b;font:300 11px/1.45 Inter,system-ui}

  /* Others */
  .others{border:1px solid #eceef2;border-radius:14px;background:#fff;padding:18px 16px;box-shadow:0 8px 24px rgba(10,10,20,.06);margin-bottom:28px;}
  .others h4{font:800 15px/1.1 Inter,system-ui;margin:0 0 8px}
  .mini{display:flex;align-items:center;justify-content:space-between;gap:30px;padding:12px;border-radius:10px;border:1px solid #eef0f3;text-decoration:none;color:inherit;margin:8px 0;}
  .mini:hover{background:#fafbfc;border-color:#e6e9ef}
  .mini__title{font:700 13px/1.2 Inter,system-ui;color:#111317}
  .mini__meta{margin-top:10px; font:600 10px/1.15 Inter,system-ui;color:#6f7783}
  .mini__badge{font:600 10px/1 Inter,system-ui;background:#f3e7b8;color:#6a5312;border:1px solid #eadf9a;border-radius:8px;padding:6px 10px}


</style>
<section class="jobdetail">
  <div class="jobdetail__wrap">
    <!-- ====== LEFT: content ====== -->
    <article class="jobdetail__main">
      <div class="jobdetail__topbar">
        
        <a class="btn-pill" href="#">Contract</a>
      </div>

      <h1 class="jobdetail__title">Sound Designer</h1>
      <div class="jobdetail__dept">Post Production</div>

      <ul class="jobdetail__meta">
        <li>
          <svg viewBox="0 0 24 24"><path d="M12 21s-7-4.35-7-10a7 7 0 0 1 14 0c0 5.65-7 10-7 10Z" fill="none" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="11" r="2" fill="currentColor"/></svg>
          Jakarta, Indonesia
        </li>
        <li>
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.7"/><path d="M12 7v5h4" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
          1 week ago
        </li>
        <li>
          <svg viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h10" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
          Rp7.500.000 – Rp9.500.000
        </li>
        <li>
          <svg viewBox="0 0 24 24"><path d="M8 13h8M8 17h8M8 9h8M6 5v14" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><circle cx="6" cy="5" r="1.5" fill="currentColor"/></svg>
          3+ years experience
        </li>
      </ul>

      <h2 class="h3">About This Role</h3>
      <p><strong>Create immersive audio landscapes</strong> for our psychological thriller productions as our Sound Designer, crafting sonic experiences that enhance narrative tension and emotional depth.</p>
      <p>We’re looking for a creative sound designer who understands the psychological impact of audio in storytelling. You’ll be responsible for creating original sound effects, designing ambient soundscapes, and collaborating with our composers to create cohesive audio experiences.</p>
      <p>This remote position offers flexibility while working on high-profile productions that demand innovative audio solutions and meticulous attention to detail.</p>

      <h3 class="h3">Key Responsibilities</h3>
      <ul class="list">
        <li>Design and create original sound effects for films and series</li>
        <li>Develop ambient soundscapes and atmospheric audio</li>
        <li>Collaborate with directors and editors on audio vision</li>
        <li>Record and edit field recordings and foley sounds</li>
        <li>Mix and master audio elements for final delivery</li>
        <li>Maintain organized sound libraries and asset management</li>
        <li>Work with composers to integrate music and sound design</li>
      </ul>

      <h3 class="h3">Requirements</h3>
      <ul class="list">
        <li>Minimum 3 years experience in sound design for film/TV</li>
        <li>Proficiency in Pro Tools, Logic Pro, or similar DAWs</li>
        <li>Experience with field recording and foley techniques</li>
        <li>Understanding of audio post-production workflows</li>
        <li>Ability to work independently and meet deadlines</li>
        <li>Portfolio demonstrating range in different genres</li>
      </ul>
    </article>

    <!-- ====== RIGHT: sidebar ====== -->
    <aside class="jobdetail__side">
      <div class="applybox">
        <h4>Apply for This Position</h4>

        <ul class="applybox__meta">
          <li>
            <svg viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="2" fill="none" stroke="currentColor" stroke-width="1.7"/><path d="M8 4v3m8-3v3M4 9h16" fill="none" stroke="currentColor" stroke-width="1.7"/></svg>
            Contract Position
          </li>
          <li>
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.7"/><path d="M12 7v5h4" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
            19.00 WIB
          </li>
        </ul>

        <a class="btn-apply" href="#">
          APPLY NOW
          <svg viewBox="0 0 24 24"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>

        <p class="applybox__note">Applications are processed via email. Please include your portfolio and cover letter.</p>
      </div>

      <div class="others">
        <h4>Other Open Positions</h4>

        <a class="mini" href="#">
          <div class="mini__text">
            <div class="mini__title">VFX Supervisor</div>
            <div class="mini__meta">Visual Effect · Jakarta</div>
          </div>
          <span class="mini__badge">Contract</span>
        </a>

        <a class="mini" href="#">
          <div class="mini__text">
            <div class="mini__title">VFX Supervisor</div>
            <div class="mini__meta">Visual Effect · Jakarta</div>
          </div>
          <span class="mini__badge">Contract</span>
        </a>

        <a class="mini" href="#">
          <div class="mini__text">
            <div class="mini__title">VFX Supervisor</div>
            <div class="mini__meta">Visual Effect · Jakarta</div>
          </div>
          <span class="mini__badge">Contract</span>
        </a>

        <a class="mini" href="#">
          <div class="mini__text">
            <div class="mini__title">VFX Supervisor</div>
            <div class="mini__meta">Visual Effect · Jakarta</div>
          </div>
          <span class="mini__badge">Contract</span>
        </a>
      </div>
    </aside>
  </div>
</section>

