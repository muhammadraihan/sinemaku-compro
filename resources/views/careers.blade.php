@extends('layouts.app')

@section('title', 'Careers | Sinemaku Pictures')

@section('content')

@include('partials.navbar', ['navTheme' => 'event'])


@push('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

<style>
.hide-scrollbar::-webkit-scrollbar {
    display:none;
}

.hide-scrollbar{
    -ms-overflow-style:none;
    scrollbar-width:none;
}
</style>
@endpush

{{-- ============================================================
EDITORIAL WRAPPER
============================================================ --}}
<div id="editorial-wrapper" class="text-brand-deepbreath relative w-full font-sans min-h-screen pt-32 pb-40">

    <div class="max-w-[1600px] mx-auto px-6 md:px-10">

        {{-- 1. PAGE HEADER (Centered) --}}
        <div class="text-center mb-8 md:mb-20 reveal-text">
            <h1 class="font-peckham not-italic text-[26px] sm:text-4xl md:text-4xl lg:text-5xl text-brand-navy leading-[0.9] md:leading-[0.8] tracking-tight">
                Setiap Orang Berhak Atas Kesempatan Pertamanya.<span class="font-peckham not-italic uppercase text-brand-orange tracking-tighter text-[26px] sm:text-4xl md:text-4xl lg:text-5xl"> Sinemaku Membuka Pintunya.</span>
            </h1>
        </div>

     {{-- 2. CATEGORY BOXES --}}
<div class="flex flex-col gap-6 md:gap-8 mx-auto">

    {{-- BOX 1: ONLINE FILM LAB --}}
    <div class="career-card group relative bg-brand-orange rounded-xl p-8 md:p-12 overflow-hidden transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl hover:shadow-brand-orange/30 shadow-xl shadow-brand-orange/20 reveal-item">

        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">

            <div class="max-w-2xl">
                <h2 class="font-peckham text-2xl md:text-3xl text-white normal-case leading-none mb-2">
                    ONLINE FILM LAB
                    <span class="font-sans text-xl md:text-3xl normal-case opacity-90">
                        untuk umum
                    </span>
                </h2>

                <p class="font-sans text-xl md:text-sm text-white leading-relaxed line-clamp-2">
                    Basic Scriptwriting bersama Reka Wijaya | 12 Agustus 2026
                </p>
            </div>

            <a href="https://docs.google.com/forms/d/e/1FAIpQLSepFLs416xdfEAP3ex2R2H-PkSmo2UsFc37Wn9AhuwsT3xPLA/viewform"
               target="_blank"
               class="px-8 py-3 rounded-full border border-white/40 text-white font-sans text-[12px] tracking-[0.2em] font-bold group-hover:bg-white group-hover:text-brand-orange transition-all duration-300 inline-block">
                Daftar Sekarang
            </a>

        </div>

    </div>

    {{-- BOX 2: CASTING --}}
    <div class="career-card group relative bg-[#1A2D61] rounded-xl p-8 md:p-12 overflow-hidden transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl hover:shadow-black/40 shadow-xl shadow-black/20 reveal-item">

        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">

            <div class="max-w-2xl">
                <h2 class="font-peckham text-2xl md:text-3xl text-white uppercase leading-none mb-2">
                    MAGANG
                    <span class="font-sans text-xl md:text-3xl normal-case opacity-90">
                        untuk mahasiswa
                    </span>
                </h2>

                <p class="font-sans text-xl md:text-sm text-white leading-relaxed line-clamp-2">
                    Ruang belajar langsung di dalam industri film bersama tim Sinemaku di berbagai divisi
                </p>
            </div>

            <a href="https://docs.google.com/forms/d/e/1FAIpQLSdkQcptXoVdOWgvl5mZuJAdyUj6EHXpMg_bqHR8xBtYo8qTSw/viewform"
               target="_blank"
               class="px-8 py-3 rounded-full border border-white/40 text-white font-sans text-[12px] tracking-[0.2em] font-bold group-hover:bg-white group-hover:text-brand-navy transition-all duration-300 inline-block">
                Daftar Sekarang
            </a>

        </div>

    </div>

    {{-- BOX 3: VOLUNTEER --}}
    <div class="career-card group relative bg-white border border-brand-navy/5 rounded-xl p-8 md:p-12 overflow-hidden transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl hover:shadow-brand-navy/10 shadow-xl shadow-brand-navy/5 reveal-item">

        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">

            <div class="max-w-2xl">
                <h2 class="font-peckham text-2xl md:text-3xl text-brand-orange uppercase leading-none mb-2">
                    CASTING
                    <span class="font-sans text-xl md:text-3xl normal-case text-brand-navy opacity-60">
                        untuk umum
                    </span>
                </h2>

                <p class="font-sans text-xl md:text-sm text-brand-navy/60 leading-relaxed line-clamp-2">
                    Wajah baru selalu punya tempat di sini. Ambil kesempatanmu, perkenalkan dirimu
                </p>
            </div>

            <a href="https://docs.google.com/forms/d/e/1FAIpQLSc5m0Y7nUeoVE_mIzB_XmZNT14Q3fL4R3GJytdt15k3r4NRhQ/viewform"
               target="_blank"
               class="px-8 py-3 rounded-full border border-brand-navy/40 text-brand-navy font-sans text-[12px] tracking-[0.2em] font-bold group-hover:bg-brand-navy group-hover:text-white transition-all duration-300 inline-block">
                Daftar Sekarang
            </a>

        </div>

    </div>


    {{-- BOX 4: MAGANG --}}
    <div class="career-card group relative bg-brand-orange rounded-xl p-8 md:p-12 overflow-hidden transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl hover:shadow-brand-orange/30 shadow-xl shadow-brand-orange/20 reveal-item">

        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">

            <div class="max-w-2xl">
                <h2 class="font-peckham text-2xl md:text-3xl text-white uppercase leading-none mb-2">
                    VOLUNTEER
                    <span class="font-sans text-xl md:text-3xl normal-case opacity-90">
                        untuk event mendatang
                    </span>
                </h2>

                <p class="font-sans text-xl md:text-sm text-white leading-relaxed line-clamp-2">
                    Jadi bagian di balik layar event Sinemaku. Untuk kamu yang suka event, produksi, dan bertemu orang baru
                </p>
            </div>

            <a href="https://docs.google.com/forms/d/e/1FAIpQLSdRU7kmYTPanb1F_tvC6vSdB_qjQ5uuazdWrffCwXer3gLPyg/viewform"
               target="_blank"
               class="px-8 py-3 rounded-full border border-white/40 text-white font-sans text-[12px] tracking-[0.2em] font-bold group-hover:bg-white group-hover:text-brand-orange transition-all duration-300 inline-block">
                Daftar Sekarang
            </a>

        </div>

    </div>

</div>

{{-- ============================================================
MEMBERSHIP / COMMUNITY PAGE
============================================================ --}}
<div class="relative w-full min-h-screen flex items-center justify-center pt-24 pb-12 px-4 md:px-12 bg-creme-leaks">

    <!-- Layout Wrapper -->
    <div class="relative z-10 w-full max-w-[1300px] flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-16">

        <!-- Left Side: Membership Benefits -->
        <div class="w-full lg:max-w-[500px] text-brand-navy animate-fade-in-up">
            <h1 class="flex flex-col gap-2 mb-8">
                <span class="font-peckham text-5xl md:text-7xl text-brand-navy uppercase leading-[0.85] tracking-tighter">JADI BAGIAN</span>
                <span class="font-serif not-italic text-3xl md:text-5xl text-brand-orange italic leading-[0.85] tracking-tighter">Dari Komunitas Sinemaku.</span>
            </h1>
            <div class="flex flex-col gap-6">
                <p class="font-sans text-base md:text-xl text-brand-navy/80 leading-relaxed font-light">
                    Komunitas ini kami buat sebagai ruang untuk bertemu, berdialog, dan bertumbuh bersama. Dengan bergabung, kamu jadi yang pertama tahu setiap kali ada pintu baru yang dibuka.
                </p>
                <p class="font-sans text-base md:text-xl text-brand-navy/80 leading-relaxed font-light">
                    Workshop, program belajar, screening lebih awal, dan kesempatan lain untuk lebih dekat dengan dunia film.
                </p>
            </div>

            <div class="mt-12 flex gap-4 hidden lg:flex">
                <div class="w-16 h-1 bg-brand-orange rounded-full"></div>
            </div>
        </div>

        <!-- Right Side: Modal Content -->
        <div class="w-full lg:max-w-[500px] bg-white p-8 md:p-14 rounded-xl shadow-2xl drop-shadow-2xl transform transition-all duration-500 overflow-y-auto max-h-[90vh] hide-scrollbar animate-fade-in-up">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <ul class="list-disc list-inside text-xs">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Brand Icon -->
            <div class="flex justify-center mb-6 md:mb-10 lg:hidden">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-brand-navy rounded-full flex items-center justify-center">
                    <img src="{{ asset('img/logo-new.png') }}" class="w-8 h-8 object-contain brightness-0 invert" alt="Icon">
                </div>
            </div>

            @guest('member')
            {{-- REGISTRATION PANEL --}}
            <div id="registration-panel" class="hidden">
                <h2 class="font-serif text-3xl md:text-5xl text-brand-navy text-center mb-8 md:mb-12 leading-tight">
                    Jadilah bagian dari <span class="italic text-brand-orange">KELUARGA SINEMAKU</span>
                </h2>

                <form action="{{ route('membership.register') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">Nama Depan</label>
                        <input type="text" name="first_name" required placeholder="Masukkan nama depan anda" class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">Nama Belakang</label>
                        <input type="text" name="last_name" required placeholder="Masukkan nama belakang Anda" class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">Email</label>
                        <input type="email" name="email" required placeholder="Masukkan email anda" class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">Tanggal Lahir</label>
                        <input type="date" name="birth_date" required class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">Kota</label>
                        <select name="city" required class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none appearance-none">
                            <option value="Jakarta">Jakarta</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Surabaya">Surabaya</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">Nomor Telepon</label>
                        <input type="tel" name="phone_number" required placeholder="Masukkan nomor telepon anda" class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none">
                    </div>
                    <div class="flex flex-col gap-2 col-span-1 md:col-span-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">Kata Sandi</label>
                        <input type="password" name="password" required placeholder="Masukkan kata sandi" class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none">
                    </div>

                    <div class="col-span-1 md:col-span-2 flex items-center gap-3 mt-4">
                        <input type="checkbox" id="remember-reg" name="remember" class="w-4 h-4 rounded text-brand-orange focus:ring-brand-orange border-brand-navy/10">
                        <label for="remember-reg" class="font-sans text-[11px] text-brand-navy/60 font-bold">Ingat saya untuk masuk lebih cepat</label>
                    </div>

                    <div class="col-span-1 md:col-span-2 mt-6">
                        <button type="submit" class="w-full md:w-max mx-auto bg-brand-orange text-white font-sans text-[10px] tracking-[0.2em] uppercase font-bold py-5 px-14 rounded-2xl hover:scale-105 transition-all shadow-xl shadow-brand-orange/20 flex items-center justify-center">
                            Buat Akun
                        </button>
                    </div>
                </form>

                <div class="mt-10 text-center">
                    <button onclick="switchCommunityPanel('login')" class="font-sans text-[11px] text-brand-navy/40 font-bold hover:text-brand-navy transition-colors">
                        Sudah punya akun? <span class="text-brand-navy underline underline-offset-4 decoration-brand-navy/20">Masuk</span>
                    </button>
                </div>
            </div>

            {{-- LOGIN PANEL --}}
            <div id="login-panel">
                <h2 class="font-sans text-3xl md:text-5xl text-brand-navy text-center mb-8 md:mb-12 leading-tight">
                    Masuk dengan <span class="font-sans text-brand-orange">EMAIL</span>
                </h2>

                <form action="{{ route('membership.login') }}" method="POST" class="flex flex-col gap-6 max-w-[400px] mx-auto">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">Email</label>
                        <input type="email" name="email" required placeholder="Enter your email" class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">Password</label>
                        <input type="password" name="password" required placeholder="Enter your password" class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none">
                    </div>

                    <div class="flex items-center gap-3 mt-2">
                        <input type="checkbox" id="remember-login" name="remember" class="w-4 h-4 rounded text-brand-orange focus:ring-brand-orange border-brand-navy/10">
                        <label for="remember-login" class="font-sans text-[11px] text-brand-navy/60 font-bold">Ingat saya untuk masuk lebih cepat</label>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full bg-brand-orange text-white font-sans text-[10px] tracking-[0.2em] uppercase font-bold py-5 px-14 rounded-2xl hover:scale-105 transition-all shadow-xl shadow-brand-orange/20">
                            Selanjutnya
                        </button>
                    </div>
                </form>

                <div class="mt-10 text-center">
                    <button onclick="switchCommunityPanel('reg')" class="font-sans text-[11px] text-brand-navy/40 font-bold hover:text-brand-navy transition-colors">
                        Kembali ke <span class="text-brand-navy underline underline-offset-4 decoration-brand-navy/20">Daftar</span>
                    </button>
                </div>
            </div>

            @else

            {{-- DASHBOARD PANEL (LOGGED IN) --}}
            <div id="dashboard-panel" class="text-center py-10">
                <div class="w-20 h-20 bg-brand-orange/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="font-serif text-3xl text-brand-orange">{{ substr(Auth::guard('member')->user()->first_name, 0, 1) }}</span>
                </div>
                <h2 class="font-serif text-3xl md:text-5xl text-brand-navy mb-4 leading-tight">
                    Selamat, <br><span class="italic text-brand-orange">{{ Auth::guard('member')->user()->first_name }}</span>!
                </h2>
                <p class="font-sans text-brand-navy/80 mb-10 max-w-sm mx-auto leading-relaxed">
                    Saat ini Anda telah masuk ke akun keanggotaan Sinemaku Pictures. Yuk, jelajahi berbagai kesempatan dan pengalaman seru bersama kami.
                </p>
                <form action="{{ route('membership.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full md:w-max mx-auto bg-brand-navy text-white font-sans text-[10px] tracking-[0.2em] uppercase font-bold py-5 px-14 rounded-2xl hover:scale-105 transition-all shadow-xl shadow-brand-navy/20">
                        Keluar
                    </button>
                </form>
            </div>

            @endguest

        </div>
    </div>
</div>

{{-- Scripts --}}
@push('scripts')
<script>
    function switchCommunityPanel(panel) {

    const reg = document.getElementById('registration-panel');
    const login = document.getElementById('login-panel');

    if(panel === 'login'){
        reg.classList.add('hidden');
        login.classList.remove('hidden');
    }else{
        reg.classList.remove('hidden');
        login.classList.add('hidden');
    }

}

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

    // 2. Section Headings Reveal
    document.querySelectorAll('.reveal-text').forEach(el => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: "top 90%",
            },
            y: 30,
            opacity: 0,
            duration: 1,
            ease: "power3.out"
        });
    });

    // 3. List Items Staggered Reveal
    document.querySelectorAll('.reveal-item').forEach(el => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: "top 95%",
            },
            y: 40,
            opacity: 0,
            duration: 1.2,
            ease: "power4.out"
        });
    });
});
</script>
@endpush
</div>
@include('components.footer')

@endsection
