<!-- Opening Sequence -->
<div id="opening-sequence" class="fixed inset-0 z-[9999] bg-black flex items-center justify-center">
    <!-- Skip button -->
    <button id="skip-intro" class="absolute top-8 right-8 text-gray-400 hover:text-white transition-colors duration-300 text-sm tracking-wide z-10">
        SKIP
    </button>

    <!-- Logo Phase -->
    <div id="phase-logo" class="text-center animate-fade-in-up" style="display: none;">
        <div class="flex items-center justify-center space-x-4 mb-8">
            <svg class="h-16 w-16 text-white animate-pulse" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M7 3v18"/><path d="M3 7.5h4"/><path d="M3 12h18"/><path d="M3 16.5h4"/><path d="M17 3v18"/><path d="M21 7.5h-4"/><path d="M21 16.5h-4"/></svg>
            <div class="text-4xl md:text-5xl font-bold tracking-tight text-white cinematic-title">
                SINEMAKU PICTURES
            </div>
        </div>
        <div class="w-32 h-px bg-white/30 mx-auto animate-scale-in animate-delay-500" />
    </div>

    <!-- Production Text Phase -->
    <div id="phase-production" class="text-center animate-fade-in-up" style="display: none;">
        <div class="text-xl md:text-2xl text-gray-300 editorial-text tracking-widest mb-8 animate-text-reveal">
            A SINEMAKU PICTURES PRODUCTION
        </div>
        <div class="flex items-center justify-center space-x-2">
            <div class="w-2 h-2 bg-white rounded-full animate-pulse" />
            <div class="w-2 h-2 bg-white rounded-full animate-pulse animate-delay-200" />
            <div class="w-2 h-2 bg-white rounded-full animate-pulse animate-delay-400" />
        </div>
    </div>

    <!-- Presenting Phase -->
    <div id="phase-presenting" class="text-center animate-fade-in-up" style="display: none;">
        <div class="text-3xl md:text-4xl text-white cinematic-title tracking-wide animate-text-reveal">
            Presenting...
        </div>
        <div class="mt-8 w-48 h-px bg-gradient-to-r from-transparent via-white to-transparent animate-scale-in" />
    </div>

    <!-- Subtle film grain overlay -->
    <div class="absolute inset-0 opacity-5 pointer-events-none">
        <div class="w-full h-full bg-gradient-to-br from-gray-800 via-transparent to-gray-900 animate-pulse" />
    </div>
</div>
