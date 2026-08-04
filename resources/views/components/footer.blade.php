{{-- resources/views/components/footer.blade.php --}}
<footer class="relative w-full overflow-hidden pt-20 pb-10 px-6 md:px-10 z-[500] font-sans"
        style="background: linear-gradient(145deg, #1A2D61 0%, #050A30 100%);">

    {{-- Ultra Fine Grain Overlay --}}
    <div class="absolute inset-0 z-0 opacity-[0.025] pointer-events-none"
         style="background-image: url('data:image/svg+xml,%3Csvg viewBox=\'0 0 200 200\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cfilter id=\'noiseFilter\'%3E%3CfeTurbulence type=\'fractalNoise\' baseFrequency=\'0.9\' numOctaves=\'4\' stitchTiles=\'stitch\'/%3E%3C/filter%3E%3Crect width=\'100%25\' height=\'100%25\' filter=\'url(%23noiseFilter)\'/%3E%3C/svg%3E');">
    </div>

    <div class="max-w-[1600px] mx-auto relative z-10">

        {{-- Main Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-12 gap-y-16 mb-20 items-start">

            {{-- Left: Massive Branding CTA --}}
            <div class="lg:col-span-5 flex flex-col items-start">
                <h3 class="font-serif not-italic text-white/80 text-2xl md:text-3xl mb-4 leading-tight">
                    Punya cerita yang ingin didengar?
                </h3>
                <h2 class="font-peckham text-brand-orange text-xl md:text-3xl lg:text-[3vw] leading-[0.9] tracking-tighter mb-5 uppercase">
                    Ngobrol dulu aja
                </h2>
               <a href="mailto:hello@sinemakupictures.com"
   class="inline-block
          transition-all
          duration-300
          text-xs
          font-sans
          font-bold
          tracking-widest
          px-10
          py-4
          rounded-md
          border
          border-white/30
          shadow-sm
          uppercase
          bg-brand-orange
          text-white
          hover:bg-white
          hover:border-white
          hover:text-brand-orange
          cursor-none
          hover-target">
    Hubungi Kami
</a>
            </div>

            {{-- Right: Three Modular Columns --}}
            <div class="lg:col-span-7 grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-2 pt-2">

                {{-- Nav --}}
                <div class="flex flex-col gap-3">
                    @php
                        $footerLinks = [
                            // ['HOME', '/'], ['OUR WORKS', '/films'], ['EVENT', '/events'],
                            // ['MERCH', '/shop'], ['COMMUNITY', '/membership'], ['ARTICLE', '/article'], ['CAREER', '/careers']

                             ['BERANDA', '/'], ['LANGKAH KAMI', route('tentang')], ['KARYA KAMI', route('film')], ['RUANG TEMU', route('events.gala')],
                             ['PINTU TERBUKA', route('careers')]
                        ];
                    @endphp
                    @foreach($footerLinks as $link)
                        <a href="{{ url($link[1]) }}" class="text-white/60 hover:text-white transition-colors duration-300 text-xs font-bold tracking-[0.15em] uppercase cursor-none hover-target w-max">
                            {{ $link[0] }}
                        </a>
                    @endforeach
                </div>

                {{-- Social --}}
                <div class="flex flex-col gap-3.5">
                    <a href="https://www.instagram.com/sinemaku_pictures?igsh=MTdhbTlpejMyMW1saQ=="
                    target="_blank"
                    class="text-white/70 hover:text-brand-orange transition-colors duration-300 text-sm font-bold tracking-[0.15em] uppercase cursor-none hover-target border-b border-white/5 pb-1.5 w-max">
                        INSTAGRAM
                    </a>

                    <a href="https://www.tiktok.com/@sinemakupictures?_r=1&_t=ZS-97Wg8U1RY8N"
                    target="_blank"
                    class="text-white/70 hover:text-brand-orange transition-colors duration-300 text-sm font-bold tracking-[0.15em] uppercase cursor-none hover-target border-b border-white/5 pb-1.5 w-max">
                        TIKTOK
                    </a>

                    <a href="https://youtube.com/@sinemakupictures?si=INJ978DC_3D8Bjrp"
                    target="_blank"
                    class="text-white/70 hover:text-brand-orange transition-colors duration-300 text-sm font-bold tracking-[0.15em] uppercase cursor-none hover-target border-b border-white/5 pb-1.5 w-max">
                        YOUTUBE
                    </a>
                </div>

                {{-- Stay in Touch --}}
                <div class="flex flex-col">
                    {{-- <span class="text-[10px] tracking-[0.3em] uppercase font-bold text-white/20 block mb-6">STAY IN TOUCH</span> --}}
                      <span class="text-[10px] tracking-[0.3em] uppercase font-bold text-white/20 block mb-6">TETAP TERHUBUNG</span>
                    <p class="text-white/40 text-xs tracking-wider leading-relaxed mb-8 uppercase font-medium max-w-[200px]">
                        {{-- GET OUR EMAILS. NEW RELEASES UPDATE, TRAILERS, MERCH, EVENTS, AND MORE. --}}
                        DAPATKAN EMAIL KAMI. INFORMASI TERBARU TENTANG RILIS BARU, TRAILER, PRODUK, ACARA, DAN LAINNYA.
                    </p>

                    <form action="#" class="relative flex w-full max-w-[300px] border border-white/20 bg-brand-navy/30">
                        <input type="email" placeholder="EMAIL"
                               class="flex-1 bg-transparent px-3 py-3 text-xs text-white tracking-[0.15em] focus:outline-none placeholder:text-white/10">
                        <button type="submit"
                                class="bg-white text-brand-navy px-5 py-3 font-sans text-xs font-bold uppercase tracking-widest hover:bg-brand-orange hover:text-white transition-all duration-300 cursor-none hover-target shrink-0">
                            SIGN UP
                        </button>
                    </form>
                </div>

            </div>
        </div>

        {{-- Bottom Utility Bar --}}
        <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-6">
            {{-- Horizontal Logo --}}
            <div class="opacity-90">
                <img src="{{ asset('img/sinemaku_horizontal.png') }}" class="h-7 md:h-9 w-auto brightness-0 invert" alt="Sinemaku Pictures Logo">
            </div>

            {{-- Copyright --}}
            <div class="text-right">
                <p class="text-[11px] tracking-[0.25em] text-white/20 uppercase font-medium">
                    &copy; 2026 SINEMAKU PICTURES. ALL RIGHTS RESERVED.
                </p>
            </div>
        </div>

    </div>
</footer>
