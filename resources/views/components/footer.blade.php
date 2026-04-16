{{-- resources/views/components/footer.blade.php --}}
<footer style="background: #0b0a1a; color: #ffffff; position: relative; overflow: hidden;">

    {{-- Subtle indigo glow --}}
    <div style="position: absolute; inset: 0; opacity: 0.05; background: radial-gradient(ellipse at 20% 60%, #26225e 0%, transparent 55%), radial-gradient(ellipse at 80% 20%, #6b3d08 0%, transparent 50%); pointer-events: none;"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
        <div class="py-20 lg:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">

                {{-- Brand --}}
                <div class="lg:col-span-5 space-y-6">
                    <div class="flex items-center space-x-3">
                        {{-- Amber film icon --}}
                        <span class="iconify h-9 w-9 flex-shrink-0"
                              data-icon="lucide:film"
                              style="color: #ed9520;"></span>
                        <span class="text-2xl font-bold tracking-tight text-white">SINEMAKU PICTURES</span>
                    </div>
                    <p class="editorial-text text-base leading-relaxed max-w-sm" style="color: #a39de0;">
                        Creating cinematic experiences that challenge conventions and inspire new perspectives.
                        We are storytellers, dreamers, and rebels with cameras.
                    </p>
                    {{-- Amber separator line --}}
                    <div style="width: 40px; height: 2px; background: #ed9520;"></div>
                </div>

                {{-- Navigation --}}
                <div class="lg:col-span-4 space-y-6">
                    <h3 class="text-lg font-semibold text-white">Navigation</h3>
                    <div class="grid grid-cols-2 gap-x-4 gap-y-3">
                        @foreach (['Home'=>'/', 'Films'=>'/films', 'Serial'=>'/serial', 'Shop'=>'/shops', 'Articles'=>'/article', 'Events'=>'/events', 'Careers'=>'/career', 'Komunitas'=>'/memberships'] as $name=>$path)
                            <a href="{{ url($path) }}"
                               class="editorial-text text-sm transition-colors duration-300"
                               style="color: #a39de0;"
                               onmouseenter="this.style.color='#ed9520'"
                               onmouseleave="this.style.color='#a39de0'">
                                {{ $name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Connect --}}
                <div class="lg:col-span-3 space-y-6">
                    <h3 class="text-lg font-semibold text-white">Connect</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-2">
                            <span class="iconify h-4 w-4 flex-shrink-0" data-icon="lucide:mail" style="color: #ed9520;"></span>
                            <a href="mailto:hello@sinemakupictures.com"
                               class="editorial-text text-sm transition-colors duration-300"
                               style="color: #a39de0;"
                               onmouseenter="this.style.color='#ed9520'"
                               onmouseleave="this.style.color='#a39de0'">
                                hello@sinemakupictures.com
                            </a>
                        </div>
                        <p class="editorial-text text-sm" style="color: #7069c7;">Jakarta, Indonesia</p>
                    </div>

                    <div class="space-y-3">
                        <h4 class="text-sm font-medium text-white">Follow Us</h4>
                        <div class="flex space-x-2">
                            @foreach ([['Instagram','#','lucide:instagram'],['YouTube','#','lucide:youtube'],['Twitter','#','lucide:twitter']] as [$sName, $sUrl, $sIcon])
                                <a href="{{ $sUrl }}"
                                   class="p-2.5 transition-all duration-300 flex items-center justify-center"
                                   style="background: #1a1640; border: 1px solid rgba(112,105,199,0.2);"
                                   aria-label="{{ $sName }}"
                                   onmouseenter="this.style.background='#221d55'; this.style.borderColor='rgba(237,149,32,0.35)'; this.querySelector('span').style.color='#ed9520';"
                                   onmouseleave="this.style.background='#1a1640'; this.style.borderColor='rgba(112,105,199,0.2)'; this.querySelector('span').style.color='#7069c7';">
                                    <span class="iconify h-4 w-4" data-icon="{{ $sIcon }}" style="color: #7069c7;"></span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="py-7" style="border-top: 1px solid rgba(112,105,199,0.15);">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex flex-col md:flex-row items-center gap-4 md:gap-8">
                    <p class="editorial-text text-sm" style="color: #7069c7;">
                        © 2024 Sinemaku Pictures. All rights reserved.
                    </p>
                    <div class="flex space-x-5">
                        @foreach (['Privacy Policy', 'Terms of Service', 'Cookies'] as $link)
                            <a href="#"
                               class="editorial-text text-sm transition-colors duration-300"
                               style="color: #7069c7;"
                               onmouseenter="this.style.color='#ed9520'"
                               onmouseleave="this.style.color='#7069c7'">
                                {{ $link }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-center space-x-2" style="color: #221d55;">
                    <span class="text-xs editorial-text tracking-wider">EST. 2020</span>
                    <div class="w-1 h-1 rounded-full" style="background: #6b3d08;"></div>
                    <span class="text-xs editorial-text tracking-wider">JAKARTA</span>
                </div>
            </div>
        </div>
    </div>
</footer>
