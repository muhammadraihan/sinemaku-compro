@extends('layouts.app')

@section('title', 'Membership | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

@push('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<style>
    body { background-color: #EDECEA !important; }
    
    /* Custom style for editorial inputs */
    .editorial-input {
        background: transparent !important;
        border: none !important;
        border-bottom: 1px solid rgba(37, 34, 94, 0.2) !important;
        border-radius: 0 !important;
        padding: 12px 0 !important;
        font-family: inherit;
        font-size: 1.1rem;
        color: #25225E !important;
        transition: border-color 0.4s ease;
    }
    .editorial-input:focus {
        border-bottom-color: #FFB150 !important;
        outline: none !important;
    }
    .editorial-input::placeholder {
        color: rgba(37, 34, 94, 0.3) !important;
    }

    /* Date input fix for editorial style */
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(15%) sepia(45%) saturate(2371%) hue-rotate(228deg) brightness(91%) contrast(92%);
        opacity: 0.5;
    }
</style>
@endpush

{{-- ============================================================
EDITORIAL WRAPPER
============================================================ --}}
<div id="editorial-wrapper" class="text-brand-deepbreath relative w-full font-sans min-h-screen">

    {{-- ============================================================
    HERO SECTION (Clean Editorial)
    ============================================================ --}}
    <section class="relative w-full h-[60vh] md:h-[70vh] overflow-hidden flex items-center justify-center pt-20 bg-transparent">
        <!-- Content Overlay -->
        <div class="relative z-20 text-center px-8 max-w-6xl mx-auto">
            <div class="flex flex-col items-center">
                <span class="hero-reveal font-sans text-[10px] tracking-[0.4em] uppercase font-bold text-brand-orange mb-8 block">
                    Sinemaku Community
                </span>
                <h1 class="hero-reveal font-serif text-6xl md:text-9xl text-brand-deepbreath leading-[0.85] tracking-tighter mb-12">
                    <span data-i18n="page_community_1">Our</span> <span data-i18n="page_community_2" class="italic text-brand-orange">Community.</span>
                </h1>
                <p class="hero-reveal font-sans text-lg md:text-xl font-light text-brand-deepbreath/70 max-w-2xl leading-relaxed">
                    @i18n($settings, 'membership_hero_subtitle')
                </p>
            </div>
        </div>
    </section>

    {{-- ============================================================
    REGISTRATION FORM (Editorial Museum Style)
    ============================================================ --}}
    <section class="py-32 px-8 md:px-16 z-20 relative bg-transparent" id="registration-form">
        <div class="max-w-4xl mx-auto">
            
            <div class="flex flex-col md:flex-row gap-16 md:gap-32 items-start">
                <!-- Left Side: Form Header (Sticky) -->
                <div class="w-full md:w-1/3 md:sticky md:top-40 reveal-text">
                    <h2 class="font-serif text-5xl md:text-6xl text-brand-deepbreath leading-[0.9] tracking-tighter mb-8 italic">
                        <span data-i18n="membership_form_title">Join the Family.</span>
                    </h2>
                    <p class="font-sans text-sm md:text-base text-brand-deepbreath/60 leading-relaxed" data-i18n="membership_form_subtitle">
                        Fill in your details below to get exclusive access to our inner circle.
                    </p>
                </div>

                <!-- Right Side: Form Body -->
                <div class="w-full md:w-2/3 reveal-rec">
                    {!! Form::open(['route' => 'membership.store', 'method' => 'POST', 'class' => 'flex flex-col gap-12 needs-validation', 'id' => 'membership-form', 'novalidate']) !!}
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-12">
                            <!-- First Name -->
                            <div class="flex flex-col gap-2">
                                <label for="first_name" class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40" data-i18n="label_first_name">First Name</label>
                                <input id="first_name" name="first_name" type="text" placeholder="Jan" value="{{ old('first_name') }}" required class="editorial-input">
                                <small id="error-first_name" class="font-sans text-[10px] text-red-500 mt-1 hidden"></small>
                            </div>

                            <!-- Last Name -->
                            <div class="flex flex-col gap-2">
                                <label for="last_name" class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40" data-i18n="label_last_name">Last Name</label>
                                <input id="last_name" name="last_name" type="text" placeholder="Maheswara" value="{{ old('last_name') }}" required class="editorial-input">
                                <small id="error-last_name" class="font-sans text-[10px] text-red-500 mt-1 hidden"></small>
                            </div>
                        </div>

                        <!-- Birth Date -->
                        <div class="flex flex-col gap-2">
                            <label for="birth_date" class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40" data-i18n="label_birth_date">Date of Birth</label>
                            <input id="birth_date" name="birth_date" type="date" value="{{ old('birth_date') }}" required class="editorial-input">
                            <small id="error-birth_date" class="font-sans text-[10px] text-red-500 mt-1 hidden"></small>
                        </div>

                        <!-- Email -->
                        <div class="flex flex-col gap-2">
                            <label for="email" class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40" data-i18n="label_email">Email Address</label>
                            <input id="email" name="email" type="email" placeholder="jan@example.com" value="{{ old('email') }}" required class="editorial-input">
                            <small id="error-email" class="font-sans text-[10px] text-red-500 mt-1 hidden"></small>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-12">
                            <!-- City -->
                            <div class="flex flex-col gap-2">
                                <label for="city" class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40" data-i18n="label_city">City</label>
                                <input id="city" name="city" type="text" placeholder="Jakarta" value="{{ old('city') }}" required class="editorial-input">
                                <small id="error-city" class="font-sans text-[10px] text-red-500 mt-1 hidden"></small>
                            </div>

                            <!-- Mobile Phone -->
                            <div class="flex flex-col gap-2">
                                <label for="phone_number" class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath/40" data-i18n="label_phone">Mobile Phone</label>
                                <input id="phone_number" name="phone_number" type="tel" placeholder="081234567890" value="{{ old('phone_number') }}" required class="editorial-input">
                                <small id="error-phone_number" class="font-sans text-[10px] text-red-500 mt-1 hidden"></small>
                            </div>
                        </div>

                        <button type="submit" class="mt-8 bg-brand-deepbreath text-white font-sans text-xs md:text-sm tracking-[0.2em] uppercase font-bold py-6 px-12 hover:bg-brand-orange transition-colors duration-500 cursor-none hover-target self-start shadow-xl">
                            <span data-i18n="label_submit_membership">Count Me In</span>
                        </button>

                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </section>

</div>

{{-- Scripts --}}
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap === 'undefined') return;

    gsap.registerPlugin(ScrollTrigger);

    // 1. Hero Reveal Animations
    gsap.from(".hero-reveal", {
        y: 50,
        opacity: 0,
        duration: 1.2,
        stagger: 0.2,
        ease: "power4.out",
        delay: 0.3
    });

    // 2. Content Reveals
    document.querySelectorAll('.reveal-text, .reveal-rec').forEach(el => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: "top 90%",
            },
            y: 50,
            opacity: 0,
            duration: 1.2,
            ease: "power4.out"
        });
    });

    // Toastr Notifications
    @if(session('success'))
        toastr.success("{{ session('success') }}", 'Success');
    @endif
    @if(session('error'))
        toastr.error("{{ session('error') }}", 'Error');
    @endif

    // Form Validation (No Refresh if Invalid)
    const membershipForm = document.getElementById('membership-form');
    if (membershipForm) {
        membershipForm.addEventListener('submit', function(e) {
            let isValid = true;
            const requiredInputs = membershipForm.querySelectorAll('input[required]');
            
            requiredInputs.forEach(input => {
                const errorEl = document.getElementById('error-' + input.id);
                if (errorEl) {
                    if (!input.value.trim()) {
                        errorEl.textContent = 'Field ' + input.id.replace('_', ' ') + ' cannot be empty';
                        errorEl.classList.remove('hidden');
                        isValid = false;
                    } else {
                        errorEl.classList.add('hidden');
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });
    }
});
</script>
@endpush

@include('components.footer')

@endsection
