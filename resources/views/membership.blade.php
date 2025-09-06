@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<style>
  /* ---------- NAVBAR (tetap) ---------- */
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

  /* ================= MEMBERSHIP BENEFITS ================= */
  .member-benefits{
    background:#fff;
    padding: clamp(40px, 6vw, 72px) 0;
  }
  .mb-container{
    max-width: 1180px;
    margin: 0 auto;
    padding: 0 24px;
  }
  .mb-title{
    font: 500 clamp(25px,4.0vw,50px)/1.08 "Inter", sans-serif;
    text-align:center;
    letter-spacing:.3px;
    margin: 40 0 12px;
  }
  .mb-sub{
    text-align:center;
    max-width: 860px;
    margin: 0 auto clamp(28px, 5vw, 46px);
    color:#484a50;
    font: 400 clamp(13px, 2.0vw, 15px)/1.6 Inter, system-ui;
  }

  /* grid */
  .mb-grid{
    display:grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: clamp(16px, 3vw, 28px);
  }

  /* card */
  .mb-card{
    background: #f7f7f7;
    border: 1px solid #ececec;
    border-radius: 14px;
    padding: 18px 18px 20px;
    transition: box-shadow .25s ease, transform .22s ease, border-color .22s ease;
  }
  .mb-card:hover{
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(0,0,0,.08);
    border-color:#e6e6e6;
  }

  .mb-card-head{
    display:flex; align-items:center; justify-content:space-between;
    margin-bottom: 14px;
  }
  .mb-ico{
    width: 36px; height: 36px;
    display:grid; place-items:center;
    background:#fff;
    border:1px solid #e7e7ea;
    border-radius: 8px;
  }
  .mb-ico svg{ width:22px; height:22px; }

  .mb-badge{
    font: 500 10px/1 Inter, system-ui;
    text-transform: uppercase;
    letter-spacing:.4px;
    color:#fff;
    background:#2a2a2a;
    padding: 7px 10px;
    border-radius: 7px;
  }

  .mb-card-title{
    margin: 2px 0 6px;
    font: 700 clamp(14px,1.8vw,16px)/1.3 Inter, system-ui;
    color:#121212;
  }
  .mb-card-desc{
    margin:0;
    color:#565963;
    font: 400 13px/1.55 Inter, system-ui;
  }

  /* responsive */
  @media (max-width: 1024px){
    .mb-grid{ grid-template-columns: repeat(2, minmax(0,1fr)); }
  }
  @media (max-width: 640px){
    .mb-grid{ grid-template-columns: 1fr; }
    .mb-badge{ padding:6px 9px; }
  }

  /* ============== JOIN COMMUNITY STYLES ============== */
  .join-community{
    background:#fff;
    padding: clamp(48px,7vw,84px) 0;
  }
  .jc-wrap{
    max-width: 860px;
    margin: 0 auto;
    padding: 0 20px;
  }
  .jc-title{
    font: 500 clamp(25px,4.0vw,50px)/1.08 "Inter", sans-serif;
    text-align:center;
    margin: 0 0 10px;
  }
  .jc-sub{
    text-align:center;
    color:#585d66;
    max-width: 640px;
    margin: 0 auto clamp(28px,5vw,40px);
    font: 400 15px/1.6 Inter, system-ui, -apple-system, Segoe UI, Roboto;
  }

  /* Card */
  .jc-card{
    background:#fff;
    border:1px solid #ececf0;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(10,10,20,.05);
    padding: clamp(18px, 3vw, 28px);
  }
  .jc-legend{
    font:700 16px/1.2 Inter, system-ui;
    color:#1a1b1e;
    margin-bottom: 18px;
  }
  .jc-fieldset{
    border:0; padding:0; margin:0;
  }

  /* Layout for name fields */
  .jc-row{
    display:grid; gap: 16px;
  }
  .jc-row-2{ grid-template-columns: repeat(2, minmax(0,1fr)); }
  @media (max-width: 640px){
    .jc-row-2{ grid-template-columns: 1fr; }
  }

  /* Groups */
  .jc-group{ margin-bottom: 16px; }
  .jc-group label{
    display:block;
    font: 600 13px/1.4 Inter, system-ui;
    color:#2b2e34;
    margin-bottom: 8px;
  }

  /* Input with icon */
  .jc-input{
    position: relative;
  }
  .jc-ico{
    position:absolute; inset:0 auto 0 12px;
    width:22px; height:22px; display:grid; place-items:center;
    margin:auto 0;
    pointer-events:none;
  }
  .jc-input input{
    width:100%;
    height:52px;
    border:1px solid #e6e7eb;
    border-radius:10px;
    background:#fafbfc;
    padding: 0 14px 0 44px;
    font: 500 15px/1 Inter, system-ui;
    color:#15171a;
    outline:none;
    transition: border-color .18s ease, box-shadow .18s ease, background .18s ease;
  }
  .jc-input input::placeholder{ color:#9aa0a6; font-weight:500; }
  .jc-input input:focus{
    border-color:#c9d2ff;
    background:#fff;
    box-shadow:0 0 0 4px rgba(80,102,255,.12);
  }

  /* Button */
  .jc-btn{
    margin-top: 8px;
    width:100%;
    height:56px;
    border-radius:10px;
    border:1px solid #e6e7eb;
    background:#0f0f10;
    color:#fff;
    font: 800 14px/1 Inter, system-ui;
    letter-spacing:.5px;
    text-transform:uppercase;
    display:flex; align-items:center; justify-content:center;
    gap:10px;
    transition: transform .08s ease, box-shadow .2s ease, background .2s ease;
  }
  .jc-btn svg{ width:20px; height:20px; }
  .jc-btn:hover{ background:#1a1a1f; box-shadow:0 10px 24px rgba(0,0,0,.12); }
  .jc-btn:active{ transform: translateY(1px); }



</style>
<!-- ================= MEMBERSHIP: MEMBER EXCLUSIVE BENEFITS ================ -->
<section class="member-benefits" id="member-benefits">
  <div class="mb-container">
    <h2 class="mb-title">Member Exclusive Benefits</h2>
    <p class="mb-sub">
      As a Sinemaku Pictures member, you'll gain access to a world of exclusive
      experiences and opportunities that bring you closer to the art of filmmaking.
    </p>

    <div class="mb-grid">
      <!-- Card -->
      <article class="mb-card">
        <div class="mb-card-head">
          <span class="mb-ico">
            <!-- calendar icon -->
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <rect x="3" y="4.5" width="18" height="16" rx="2.8" fill="none" stroke="#6b6873" stroke-width="1.8"/>
              <path d="M3 9.5h18" stroke="#6b6873" stroke-width="1.8"/>
              <path d="M8 3.5v3M16 3.5v3" stroke="#6b6873" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
          </span>
          <span class="mb-badge">VIP Access</span>
        </div>
        <h3 class="mb-card-title">Exclusive Premiere</h3>
        <p class="mb-card-desc">
          First access to film screenings, gala premieres, and red carpet events before
          general release.
        </p>
      </article>

      <!-- Duplikasi kartu sesuai kebutuhan -->
      <article class="mb-card">
        <div class="mb-card-head">
          <span class="mb-ico">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <rect x="3" y="4.5" width="18" height="16" rx="2.8" fill="none" stroke="#6b6873" stroke-width="1.8"/>
              <path d="M3 9.5h18" stroke="#6b6873" stroke-width="1.8"/>
              <path d="M8 3.5v3M16 3.5v3" stroke="#6b6873" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
          </span>
          <span class="mb-badge">VIP Access</span>
        </div>
        <h3 class="mb-card-title">Exclusive Premiere</h3>
        <p class="mb-card-desc">
          First access to film screenings, gala premieres, and red carpet events before
          general release.
        </p>
      </article>

      <article class="mb-card">
        <div class="mb-card-head">
          <span class="mb-ico">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <rect x="3" y="4.5" width="18" height="16" rx="2.8" fill="none" stroke="#6b6873" stroke-width="1.8"/>
              <path d="M3 9.5h18" stroke="#6b6873" stroke-width="1.8"/>
              <path d="M8 3.5v3M16 3.5v3" stroke="#6b6873" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
          </span>
          <span class="mb-badge">VIP Access</span>
        </div>
        <h3 class="mb-card-title">Exclusive Premiere</h3>
        <p class="mb-card-desc">
          First access to film screenings, gala premieres, and red carpet events before
          general release.
        </p>
      </article>

      <article class="mb-card">
        <div class="mb-card-head">
          <span class="mb-ico">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <rect x="3" y="4.5" width="18" height="16" rx="2.8" fill="none" stroke="#6b6873" stroke-width="1.8"/>
              <path d="M3 9.5h18" stroke="#6b6873" stroke-width="1.8"/>
              <path d="M8 3.5v3M16 3.5v3" stroke="#6b6873" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
          </span>
          <span class="mb-badge">VIP Access</span>
        </div>
        <h3 class="mb-card-title">Exclusive Premiere</h3>
        <p class="mb-card-desc">
          First access to film screenings, gala premieres, and red carpet events before
          general release.
        </p>
      </article>

      <article class="mb-card">
        <div class="mb-card-head">
          <span class="mb-ico">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <rect x="3" y="4.5" width="18" height="16" rx="2.8" fill="none" stroke="#6b6873" stroke-width="1.8"/>
              <path d="M3 9.5h18" stroke="#6b6873" stroke-width="1.8"/>
              <path d="M8 3.5v3M16 3.5v3" stroke="#6b6873" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
          </span>
          <span class="mb-badge">VIP Access</span>
        </div>
        <h3 class="mb-card-title">Exclusive Premiere</h3>
        <p class="mb-card-desc">
          First access to film screenings, gala premieres, and red carpet events before
          general release.
        </p>
      </article>

      <article class="mb-card">
        <div class="mb-card-head">
          <span class="mb-ico">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <rect x="3" y="4.5" width="18" height="16" rx="2.8" fill="none" stroke="#6b6873" stroke-width="1.8"/>
              <path d="M3 9.5h18" stroke="#6b6873" stroke-width="1.8"/>
              <path d="M8 3.5v3M16 3.5v3" stroke="#6b6873" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
          </span>
          <span class="mb-badge">VIP Access</span>
        </div>
        <h3 class="mb-card-title">Exclusive Premiere</h3>
        <p class="mb-card-desc">
          First access to film screenings, gala premieres, and red carpet events before
          general release.
        </p>
      </article>
    </div>
  </div>
</section>

<!-- ============== MEMBERSHIP: JOIN OUR COMMUNITY ============== -->
<section class="join-community" id="join-community">
  <div class="jc-wrap">
    <h2 class="jc-title">Join Our Community</h2>
    <p class="jc-sub">
      Ready to become part of our creative family? Fill out the form below to start
      your journey as a Sinemaku Pictures member. It's completely free and takes
      less than 2 minutes.
    </p>

      @if ($errors->any())
        <script>
          @foreach ($errors->all() as $err)
            toastr.error(@json($err), 'Validation Error');
          @endforeach
        </script>
      @endif
      {!! Form::open(['route' => 'membership.store','id'=>'forms','method' => 'POST','class' =>
                'jc-card needs-validation','dropzone', 'forms','novalidate','enctype' => 'multipart/form-data']) !!}
      <fieldset class="jc-fieldset">
        <legend class="jc-legend">Personal Information</legend>

        <div class="jc-row jc-row-2">
          <!-- First Name -->
          <div class="jc-group">
            <label for="first_name">First Name</label>
            <div class="jc-input">
              <span class="jc-ico">
                <!-- person icon -->
                <svg viewBox="0 0 24 24" aria-hidden="true">
                  <path d="M12 12c2.9 0 5-2.3 5-5s-2.1-5-5-5-5 2.3-5 5 2.1 5 5 5Zm0 2c-4.2 0-8 2-8 5v1.5c0 .8.7 1.5 1.5 1.5h13c.8 0 1.5-.7 1.5-1.5V19c0-3-3.8-5-8-5Z" fill="#9aa0a6"/>
                </svg>
              </span>
              <input id="first_name" name="first_name" type="text" placeholder="Enter your first name" value="{{ old('first_name') }}" required>
              @error('first_name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>

          <!-- Last Name -->
          <div class="jc-group">
            <label for="last_name">Last Name</label>
            <div class="jc-input">
              <span class="jc-ico">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                  <path d="M12 12c2.9 0 5-2.3 5-5s-2.1-5-5-5-5 2.3-5 5 2.1 5 5 5Zm0 2c-4.2 0-8 2-8 5v1.5c0 .8.7 1.5 1.5 1.5h13c.8 0 1.5-.7 1.5-1.5V19c0-3-3.8-5-8-5Z" fill="#9aa0a6"/>
                </svg>
              </span>
              <input id="last_name" name="last_name" type="text" placeholder="Enter your last name" value="{{ old('last_name') }}" required>
              @error('last_name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>
        </div>

        <!-- Email -->
        <div class="jc-group">
          <label for="email">Email Address</label>
          <div class="jc-input">
            <span class="jc-ico">
              <!-- mail icon -->
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M3.5 6.5h17a1.5 1.5 0 0 1 1.5 1.5v8a1.5 1.5 0 0 1-1.5 1.5h-17A1.5 1.5 0 0 1 2 16V8a1.5 1.5 0 0 1 1.5-1.5Zm.8 1.9 6.9 4.3a2.5 2.5 0 0 0 2.6 0l6.9-4.3" fill="none" stroke="#9aa0a6" stroke-width="1.8" stroke-linecap="round"/>
              </svg>
            </span>
            <input id="email" name="email" type="email" placeholder="Enter your email address" value="{{ old('email') }}" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
              @enderror
          </div>
        </div>

        <!-- City -->
        <div class="jc-group">
          <label for="city">City</label>
          <div class="jc-input">
            <span class="jc-ico">
              <!-- pin icon -->
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 22s7-6.1 7-12a7 7 0 1 0-14 0c0 5.9 7 12 7 12Zm0-9a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" fill="#9aa0a6"/>
              </svg>
            </span>
            <input id="city" name="city" type="text" placeholder="Enter your city" value="{{ old('city') }}" required>
            @error('city')
                <small class="text-danger">{{ $message }}</small>
              @enderror
          </div>
        </div>

        <!-- Mobile -->
        <div class="jc-group">
          <label for="phone_number">Mobile Phone</label>
          <div class="jc-input">
            <span class="jc-ico">
              <!-- phone icon -->
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <rect x="7" y="2.5" width="10" height="19" rx="2" fill="none" stroke="#9aa0a6" stroke-width="1.8"/>
                <circle cx="12" cy="18.5" r="1" fill="#9aa0a6"/>
              </svg>
            </span>
            <input id="phone_number" name="phone_number" type="tel" placeholder="Enter your mobile phone number" value="{{ old('phone_number') }}" required>
            @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
              @enderror
          </div>
        </div>

        <button type="submit" class="jc-btn">
          BECOME A MEMBER - FREE
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </fieldset>
    {!! Form::close() !!}
  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}", 'Success');
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}", 'Error');
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $err)
            toastr.error("{{ $err }}", 'Validation Error');
        @endforeach
    @endif
</script>

