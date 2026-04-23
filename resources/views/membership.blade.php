@extends('layouts.app')

@section('title', 'Membership | Sinemaku Pictures')

@section('content')
@include('partials.navbar')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<style>
  :root {
    --ink: #0A0A0A;
    --muted: #6b7280;
    --line: #e6e6e6;
    --surface: #ffffff;
  }

  body {
    background-color: var(--surface);
  }

  /* ================= HERO SECTION ================= */
  .hero-section {
    position: relative;
    width: 100vw;
    height: 100vh;
    min-height: 600px;
    background-color: var(--ink);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }

  .hero-bg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    opacity: 0.5;
  }

  .hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.2) 60%, rgba(0,0,0,0.4) 100%);
  }

  .hero-content {
    position: relative;
    z-index: 10;
    text-align: center;
    color: #fff;
    max-width: 900px;
    padding: 0 24px;
    transform: translateY(20px);
  }

  .hero-title {
    font-size: clamp(3rem, 11vw, 6.5rem);
    font-weight: 700;
    line-height: 1.0;
    letter-spacing: -0.02em;
    margin-bottom: 24px;
  }

  .hero-subtitle {
    font: 400 clamp(16px, 2vw, 20px)/1.6;
    color: rgba(255, 255, 255, 0.8);
    margin: 0 auto 40px;
    max-width: 650px;
  }

  .btn-join-now {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: #fff;
    color: #000;
    font: 600 14px/1;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 18px 36px;
    border-radius: 4px;
    text-decoration: none;
    transition: transform 0.3s ease, background 0.3s ease;
    border: none;
    cursor: pointer;
  }

  .btn-join-now:hover {
    background: #e6e6e6;
    transform: translateY(-2px);
  }

  /* ================= REGISTRATION FORM SECTION ================= */
  .registration-section {
    padding: clamp(60px, 8vw, 100px) 0;
    background: #fff;
  }

  .form-container {
    max-width: 680px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .form-header {
    margin-bottom: 40px;
    text-align: center;
  }

  .form-header h2 {
    font: 600 clamp(28px, 4vw, 42px)/1.1;
    letter-spacing: -0.01em;
    color: var(--ink);
    margin-bottom: 12px;
  }

  .form-header p {
    font: 400 16px/1.6;
    color: var(--muted);
  }

  .clean-form {
    display: grid;
    gap: 24px;
  }

  .clean-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
  }

  @media (max-width: 640px) {
    .clean-row { grid-template-columns: 1fr; gap: 24px; }
  }

  .form-group-clean {
    display: block;
  }

  .form-group-clean label {
    display: block;
    font: 600 13px/1;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: #333;
    margin-bottom: 8px;
  }

  .form-group-clean input {
    width: 100%;
    background: transparent;
    border: none;
    border-bottom: 1px solid #ccc;
    border-radius: 0;
    padding: 12px 0;
    font: 400 16px/1.5;
    color: var(--ink);
    outline: none;
    transition: border-color 0.3s ease;
  }

  .form-group-clean input::placeholder {
    color: #a0a0a0;
  }

  .form-group-clean input:focus {
    border-bottom-color: var(--ink);
  }

  .btn-submit-clean {
    margin-top: 24px;
    width: 100%;
    background: var(--ink);
    color: #fff;
    border: none;
    padding: 18px 24px;
    font: 600 15px/1;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
    transition: background 0.3s ease;
    border-radius: 0;
  }

  .btn-submit-clean:hover {
    background: #2a2a2a;
  }

  .btn-submit-clean:active {
    transform: translateY(1px);
  }

  /* Reveal Animations */
  .reveal {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.8s ease, transform 0.8s cubic-bezier(0.2, 0.7, 0.2, 1);
  }
  .reveal.is-in {
    opacity: 1;
    transform: none;
  }

  @media (prefers-reduced-motion: reduce) {
    .reveal { transition: none !important; opacity: 1 !important; transform: none !important; }
  }

</style>

<!-- HERO SECTION -->
<section class="hero-section">
  @if(isset($settings['membership_hero_image']) && $settings['membership_hero_image'] != '')
      <img src="{{ asset($settings['membership_hero_image']) }}" alt="Sinemaku Memberships" class="hero-bg reveal">
  @else
      <div class="hero-bg reveal" style="background: linear-gradient(45deg, #121212, #2a2a2a);"></div>
  @endif
  <div class="hero-overlay"></div>
  
  <div class="hero-content reveal" style="transition-delay: 0.1s;">
    <h1 class="hero-title">
      @php
        $defaultTitleId = "Siap menjadi bagian dari\nkeluarga kreatif kami?";
        $settings['membership_hero_title'] = isset($settings['membership_hero_title']) ? $settings['membership_hero_title'] : $defaultTitleId;
        $settings['membership_hero_title_en'] = isset($settings['membership_hero_title_en']) ? $settings['membership_hero_title_en'] : "Ready to become part of our\ncreative family?";
      @endphp
      @i18n($settings, 'membership_hero_title')
    </h1>
    <p class="hero-subtitle">
      @php
        $defaultSubtitleId = "Daftar hari ini dan dapatkan akses eksklusif ke acara dan konten di balik layar.";
        $settings['membership_hero_subtitle'] = isset($settings['membership_hero_subtitle']) ? $settings['membership_hero_subtitle'] : $defaultSubtitleId;
        $settings['membership_hero_subtitle_en'] = isset($settings['membership_hero_subtitle_en']) ? $settings['membership_hero_subtitle_en'] : 'Sign up today and get exclusive access to events and behind the scenes content.';
      @endphp
      @i18n($settings, 'membership_hero_subtitle')
    </p>
    <a href="#registration-form" class="btn-join-now js-scroll-to">
      @php
        $joinBtn = ['text' => 'Gabung Sekarang', 'text_en' => 'Join Now'];
      @endphp
      @i18n($joinBtn, 'text')
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <polyline points="19 12 12 19 5 12"></polyline>
      </svg>
    </a>
  </div>
</section>

<!-- REGISTRATION FORM SECTION -->
<section class="registration-section" id="registration-form">
  <div class="form-container reveal">
    <div class="form-header">
      @php
        $personalInfo = ['title' => 'Informasi Pribadi', 'title_en' => 'Personal Information', 'desc' => 'Isi formulir di bawah ini untuk memulai perjalanan Anda sebagai anggota Sinemaku Pictures. Ini sepenuhnya gratis.', 'desc_en' => "Fill out the form below to start your journey as a Sinemaku Pictures member. It's completely free."];
      @endphp
      <h2>@i18n($personalInfo, 'title')</h2>
      <p>@i18n($personalInfo, 'desc')</p>
    </div>


    {!! Form::open(['route' => 'membership.store', 'method' => 'POST', 'class' => 'clean-form needs-validation', 'novalidate']) !!}
      
      <div class="clean-row">
        <!-- First Name -->
        <div class="form-group-clean">
          @php $firstNameText = ['label' => 'Nama Depan', 'label_en' => 'First Name']; @endphp
          <label for="first_name">@i18n($firstNameText, 'label')</label>
          <small id="error-first_name" class="error-msg" style="color:red; font-size:12px; margin-bottom:4px; display: {{ $errors->has('first_name') ? 'block' : 'none' }};">
            {{ $errors->first('first_name') ?? 'Field first name tidak boleh kosong!' }}
          </small>
          <input id="first_name" name="first_name" type="text" placeholder="Jan" value="{{ old('first_name') }}" required>
        </div>

        <!-- Last Name -->
        <div class="form-group-clean">
          @php $lastNameText = ['label' => 'Nama Belakang', 'label_en' => 'Last Name']; @endphp
          <label for="last_name">@i18n($lastNameText, 'label')</label>
          <small id="error-last_name" class="error-msg" style="color:red; font-size:12px; margin-bottom:4px; display: {{ $errors->has('last_name') ? 'block' : 'none' }};">
            {{ $errors->first('last_name') ?? 'Field last name tidak boleh kosong!' }}
          </small>
          <input id="last_name" name="last_name" type="text" placeholder="Maheswara" value="{{ old('last_name') }}" required>
        </div>
      </div>

      <!-- Birth Date -->
      <div class="form-group-clean">
        @php $birthDateText = ['label' => 'Tanggal Lahir', 'label_en' => 'Date of Birth']; @endphp
        <label for="birth_date">@i18n($birthDateText, 'label')</label>
        <small id="error-birth_date" class="error-msg" style="color:red; font-size:12px; margin-bottom:4px; display: {{ $errors->has('birth_date') ? 'block' : 'none' }};">
          {{ $errors->first('birth_date') ?? 'Field birth date tidak boleh kosong!' }}
        </small>
        <input id="birth_date" name="birth_date" type="date" value="{{ old('birth_date') }}" required>
      </div>

      <!-- Email -->
      <div class="form-group-clean">
        @php $emailText = ['label' => 'Alamat Email', 'label_en' => 'Email Address']; @endphp
        <label for="email">@i18n($emailText, 'label')</label>
        <small id="error-email" class="error-msg" style="color:red; font-size:12px; margin-bottom:4px; display: {{ $errors->has('email') ? 'block' : 'none' }};">
          {{ $errors->first('email') ?? 'Field email tidak boleh kosong!' }}
        </small>
        <input id="email" name="email" type="email" placeholder="jan@example.com" value="{{ old('email') }}" required>
      </div>

      <!-- City -->
      <div class="form-group-clean">
        @php $cityText = ['label' => 'Kota', 'label_en' => 'City']; @endphp
        <label for="city">@i18n($cityText, 'label')</label>
        <small id="error-city" class="error-msg" style="color:red; font-size:12px; margin-bottom:4px; display: {{ $errors->has('city') ? 'block' : 'none' }};">
          {{ $errors->first('city') ?? 'Field city tidak boleh kosong!' }}
        </small>
        <input id="city" name="city" type="text" placeholder="Jakarta" value="{{ old('city') }}" required>
      </div>

      <!-- Mobile Phone -->
      <div class="form-group-clean">
        @php $phoneText = ['label' => 'Nomor HP', 'label_en' => 'Mobile Phone']; @endphp
        <label for="phone_number">@i18n($phoneText, 'label')</label>
        <small id="error-phone_number" class="error-msg" style="color:red; font-size:12px; margin-bottom:4px; display: {{ $errors->has('phone_number') ? 'block' : 'none' }};">
          {{ $errors->first('phone_number') ?? 'Field phone number tidak boleh kosong!' }}
        </small>
        <input id="phone_number" name="phone_number" type="tel" placeholder="081234567890" value="{{ old('phone_number') }}" required>
      </div>

      <button type="submit" class="btn-submit-clean">
        @php $btnSubmit = ['text' => 'Daftarkan Saya', 'text_en' => 'Count Me In']; @endphp
        @i18n($btnSubmit, 'text')
      </button>

    {!! Form::close() !!}
  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // Toastr Notifications
    @if(session('success'))
        toastr.success("{{ session('success') }}", 'Success');
    @endif
    @if(session('error'))
        toastr.error("{{ session('error') }}", 'Error');
    @endif

    // Smooth scroll for anchor links
    document.querySelectorAll('.js-scroll-to').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetEl = document.getElementById(targetId);
            if (targetEl) {
                targetEl.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Form Validation (No Refresh if Invalid)
    const membershipForm = document.querySelector('.clean-form');
    if (membershipForm) {
      membershipForm.addEventListener('submit', function(e) {
        let isValid = true;
        const requiredInputs = membershipForm.querySelectorAll('input[required]');
        
        requiredInputs.forEach(input => {
          const errorEl = document.getElementById('error-' + input.id);
          if (errorEl) {
            if (!input.value.trim()) {
              errorEl.textContent = 'Field ' + input.id.replace('_', ' ') + ' tidak boleh kosong !';
              errorEl.style.display = 'block';
              isValid = false;
            } else {
              errorEl.style.display = 'none';
            }
          }
        });

        if (!isValid) {
          e.preventDefault();
          // Scroll to the first error if needed
          const firstError = membershipForm.querySelector('.error-msg[style*="display: block"]');
          if (firstError) {
            // firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }
        }
      });
    }

    // Reveal Animation Logic
    (function(){
      const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
          if(!entry.isIntersecting) return;
          entry.target.classList.add('is-in');
          obs.unobserve(entry.target);
        });
      }, { root: null, rootMargin: '0px', threshold: 0.1 });

      document.querySelectorAll('.reveal').forEach(el => {
        // Immediate show if reduce motion is preferred
        const reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if(reduced) el.classList.add('is-in');
        else observer.observe(el);
      });
    })();
</script>

@include('components.footer')
@endsection
