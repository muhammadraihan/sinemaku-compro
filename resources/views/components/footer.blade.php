{{-- resources/views/components/footer.blade.php --}}
<footer class="bg-black text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-800 via-transparent to-gray-900"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
        <div class="py-20 lg:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
                <div class="lg:col-span-5 space-y-8">
                    <div class="flex items-center space-x-3 group">
                        <span class="iconify h-10 w-10 text-white group-hover:text-gray-300 transition-colors duration-500" data-icon="lucide:film"></span>
                        <span class="text-2xl font-bold tracking-tight">SINEMAKU PICTURES</span>
                    </div>
                    <p class="text-gray-400 editorial-text text-lg leading-relaxed max-w-md">
                        Creating cinematic experiences that challenge conventions and inspire new perspectives. 
                        We are storytellers, dreamers, and rebels with cameras.
                    </p>
                </div>
                <div class="lg:col-span-4 space-y-8">
                    <h3 class="text-lg font-semibold text-white">Navigation</h3>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach (['Home'=>'/', 'Films'=>'/films', 'Serial'=>'/serial', 'Shop'=>'/shops', 'Articles'=>'/article', 'Events'=>'/events', 'Careers'=>'/career', 'Komunitas'=>'/memberships'] as $name=>$path)
                            <a href="{{ url($path) }}" class="text-gray-400 hover:text-white transition-colors duration-300 editorial-text text-base group">
                                <span class="group-hover:translate-x-1 transition-transform duration-300 inline-block">
                                    {{ $name }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="lg:col-span-3 space-y-8">
                    <h3 class="text-lg font-semibold text-white">Connect</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <span class="iconify h-4 w-4 text-gray-400 flex-shrink-0" data-icon="lucide:mail"></span>
                            <a href="mailto:hello@sinemakupictures.com" class="text-gray-400 hover:text-white transition-colors duration-300 editorial-text">
                                hello@sinemakupictures.com
                            </a>
                        </div>
                        <p class="text-gray-500 editorial-text text-sm">
                            Jakarta, Indonesia
                        </p>
                    </div>
                    <div class="space-y-4">
                        <h4 class="text-base font-medium text-white">Follow Us</h4>
                        <div class="flex space-x-4">
                            @foreach ([['Instagram','#','lucide:instagram'],['YouTube','#','lucide:youtube'],['Twitter','#','lucide:twitter']] as [$name, $url, $icon])
                                <a href="{{ $url }}" class="p-3 bg-gray-900 hover:bg-gray-800 transition-all duration-300 group hover:scale-110" aria-label="{{ $name }}">
                                    <span class="iconify h-5 w-5 text-gray-400 group-hover:text-white transition-colors duration-300" data-icon="{{ $icon }}"></span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-800 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-8">
                    <p class="text-gray-500 editorial-text text-sm">
                        © 2024 Sinemaku Pictures. All rights reserved.
                    </p>
                    <div class="flex space-x-6">
                        @foreach (['Privacy Policy','#','Terms of Service','#','Cookies','#'] as $i=>$item)
                            @if ($i%2==0)
                                <a href="{{ ['#','#','#'][$i/2] }}" class="text-gray-500 hover:text-gray-300 transition-colors duration-300 editorial-text text-sm">
                                    {{ $item }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="flex items-center space-x-2 text-gray-600">
                    <span class="text-xs editorial-text tracking-wider">EST. 2020</span>
                    <div class="w-1 h-1 bg-gray-600 rounded-full"></div>
                    <span class="text-xs editorial-text tracking-wider">JAKARTA</span>
                </div>
            </div>
        </div>
    </div>
</footer>
