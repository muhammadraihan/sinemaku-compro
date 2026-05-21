@extends('layouts.app')

@section('title', 'Membership | Sinemaku Pictures')

@section('content')

@include('partials.navbar', ['navTheme' => 'event'])

@push('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

{{-- ============================================================
MEMBERSHIP / COMMUNITY PAGE
============================================================ --}}
<div class="relative w-full min-h-screen flex items-center justify-center pt-24 pb-12 px-4 md:px-12 bg-creme-leaks">
    
    <!-- Layout Wrapper -->
    <div class="relative z-10 w-full max-w-[1300px] flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-16">
        
        <!-- Left Side: Membership Benefits -->
        <div class="w-full lg:max-w-[500px] text-brand-navy animate-fade-in-up">
            <h1 class="flex flex-col gap-2 mb-8">
                <span class="font-peckham text-5xl md:text-7xl text-brand-navy uppercase leading-[0.85] tracking-tighter">EXCLUSIVE</span>
                <span class="font-serif text-5xl md:text-7xl text-brand-orange italic leading-[0.85] tracking-tighter">Experiences.</span>
            </h1>
            <div class="flex flex-col gap-6">
                <p class="font-sans text-base md:text-xl text-brand-navy/80 leading-relaxed font-light">
                    As a Sinemaku Pictures member, you'll gain access to a world of exclusive experiences and opportunities that bring you closer to the art of filmmaking.
                </p>
                <p class="font-sans text-base md:text-xl text-brand-navy/80 leading-relaxed font-light">
                    First access to film screenings, gala premieres, and red carpet events before general release.
                </p>
            </div>
            
            <div class="mt-12 flex gap-4 hidden lg:flex">
                <div class="w-16 h-1 bg-brand-orange rounded-full"></div>
            </div>
        </div>

        <!-- Right Side: Modal Content -->
        <div class="w-full lg:max-w-[580px] bg-white p-8 md:p-14 rounded-xl shadow-2xl drop-shadow-2xl transform transition-all duration-500 overflow-y-auto max-h-[90vh] hide-scrollbar animate-fade-in-up">
            
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
                    Join the <span class="italic text-brand-orange">FAMILY</span>
                </h2>
                
                <form action="{{ route('membership.register') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">First Name</label>
                        <input type="text" name="first_name" required placeholder="Enter your first name" class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">Last Name</label>
                        <input type="text" name="last_name" required placeholder="Enter your last name" class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">Email</label>
                        <input type="email" name="email" required placeholder="Enter your email" class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">Date of Birth</label>
                        <input type="date" name="birth_date" required class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">City</label>
                        <select name="city" required class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none appearance-none">
                            <option value="Jakarta">Jakarta</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Surabaya">Surabaya</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">Phone Number</label>
                        <input type="tel" name="phone_number" required placeholder="Enter your phone number" class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none">
                    </div>
                    <div class="flex flex-col gap-2 col-span-1 md:col-span-2">
                        <label class="font-sans text-[10px] uppercase font-bold tracking-widest text-brand-navy ml-1">Password</label>
                        <input type="password" name="password" required placeholder="Create a password" class="w-full bg-brand-navy/5 border-none rounded-md px-5 py-4 font-sans text-sm focus:ring-2 focus:ring-brand-orange/20 transition-all outline-none">
                    </div>

                    <div class="col-span-1 md:col-span-2 flex items-center gap-3 mt-4">
                        <input type="checkbox" id="remember-reg" name="remember" class="w-4 h-4 rounded text-brand-orange focus:ring-brand-orange border-brand-navy/10">
                        <label for="remember-reg" class="font-sans text-[11px] text-brand-navy/60 font-bold">Remember me for faster sign in</label>
                    </div>

                    <div class="col-span-1 md:col-span-2 mt-6">
                        <button type="submit" class="w-full md:w-max mx-auto bg-brand-orange text-white font-sans text-[10px] tracking-[0.2em] uppercase font-bold py-5 px-14 rounded-2xl hover:scale-105 transition-all shadow-xl shadow-brand-orange/20 flex items-center justify-center">
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="mt-10 text-center">
                    <button onclick="switchCommunityPanel('login')" class="font-sans text-[11px] text-brand-navy/40 font-bold hover:text-brand-navy transition-colors">
                        Already have an account? <span class="text-brand-navy underline underline-offset-4 decoration-brand-navy/20">Sign in</span>
                    </button>
                </div>
            </div>

            {{-- LOGIN PANEL --}}
            <div id="login-panel">
                <h2 class="font-serif text-3xl md:text-5xl text-brand-navy text-center mb-8 md:mb-12 leading-tight">
                    Sign in with <span class="italic text-brand-orange">EMAIL</span>
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
                        <label for="remember-login" class="font-sans text-[11px] text-brand-navy/60 font-bold">Remember me for faster sign in</label>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full bg-brand-orange text-white font-sans text-[10px] tracking-[0.2em] uppercase font-bold py-5 px-14 rounded-2xl hover:scale-105 transition-all shadow-xl shadow-brand-orange/20">
                            Continue
                        </button>
                    </div>
                </form>

                <div class="mt-10 text-center">
                    <button onclick="switchCommunityPanel('reg')" class="font-sans text-[11px] text-brand-navy/40 font-bold hover:text-brand-navy transition-colors">
                        Back to <span class="text-brand-navy underline underline-offset-4 decoration-brand-navy/20">Sign up</span>
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
                    Welcome, <br><span class="italic text-brand-orange">{{ Auth::guard('member')->user()->first_name }}</span>!
                </h2>
                <p class="font-sans text-brand-navy/80 mb-10 max-w-sm mx-auto leading-relaxed">
                    You are currently logged in to your Sinemaku Pictures membership account. Enjoy your exclusive experiences.
                </p>
                <form action="{{ route('membership.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full md:w-max mx-auto bg-brand-navy text-white font-sans text-[10px] tracking-[0.2em] uppercase font-bold py-5 px-14 rounded-2xl hover:scale-105 transition-all shadow-xl shadow-brand-navy/20">
                        Sign Out
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
        if (panel === 'login') {
            reg.classList.add('hidden');
            login.classList.remove('hidden');
        } else {
            reg.classList.remove('hidden');
            login.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (typeof gsap === 'undefined') return;
        gsap.from('.animate-fade-in-up', {
            y: 50,
            opacity: 0,
            duration: 1.2,
            ease: "power4.out"
        });
    });
</script>
@endpush

@include('components.footer')

@endsection

