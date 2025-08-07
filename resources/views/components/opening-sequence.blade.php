{{-- resources/views/components/opening-sequence.blade.php --}}
<div id="opening-sequence" class="fixed inset-0 z-[9999] bg-black flex items-center justify-center">
    <button onclick="$('#opening-sequence').fadeOut(300);$('#main-content').fadeIn(300);" class="absolute top-8 right-8 text-gray-400 hover:text-white transition-colors duration-300 text-sm tracking-wide z-10">
        SKIP
    </button>
    <div id="phase-logo" class="text-center animate-fade-in-up">
        <div class="flex items-center justify-center space-x-4 mb-8">
            <span class="iconify h-16 w-16 text-white animate-pulse" data-icon="lucide:film"></span>
            <div class="text-4xl md:text-5xl font-bold tracking-tight text-white cinematic-title">
                SINEMAKU PICTURES
            </div>
        </div>
        <div class="w-32 h-px bg-white/30 mx-auto animate-scale-in animate-delay-500"></div>
    </div>
    {{-- Gunakan jQuery/JS untuk auto-hide sequence sesuai animasi OpeningSequence.tsx --}}
    <script>
        setTimeout(function(){
            $('#phase-logo').fadeOut(300, function(){
                $('#phase-production').fadeIn(300);
            });
        }, 800);
        setTimeout(function(){
            $('#phase-production').fadeOut(300, function(){
                $('#phase-presenting').fadeIn(300);
            });
        }, 1600);
        setTimeout(function(){
            $('#opening-sequence').fadeOut(400);
            $('#main-content').fadeIn(400);
        }, 2200);
    </script>
    <div id="phase-production" class="text-center animate-fade-in-up" style="display:none">
        <div class="text-xl md:text-2xl text-gray-300 editorial-text tracking-widest mb-8 animate-text-reveal">
            A SINEMAKU PICTURES PRODUCTION
        </div>
        <div class="flex items-center justify-center space-x-2">
            <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
            <div class="w-2 h-2 bg-white rounded-full animate-pulse animate-delay-200"></div>
            <div class="w-2 h-2 bg-white rounded-full animate-pulse animate-delay-400"></div>
        </div>
    </div>
    <div id="phase-presenting" class="text-center animate-fade-in-up" style="display:none">
        <div class="text-3xl md:text-4xl text-white cinematic-title tracking-wide animate-text-reveal">
            Presenting...
        </div>
        <div class="mt-8 w-48 h-px bg-gradient-to-r from-transparent via-white to-transparent animate-scale-in"></div>
    </div>
    <div class="absolute inset-0 opacity-5 pointer-events-none">
        <div class="w-full h-full bg-gradient-to-br from-gray-800 via-transparent to-gray-900 animate-pulse"></div>
    </div>
</div>
