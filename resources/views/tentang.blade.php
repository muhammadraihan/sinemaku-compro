@extends('layouts.app')

@section('title','Tentang Kami | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

<section class="relative h-screen overflow-hidden">

    {{-- Background --}}
    <img
        src="{{ asset('../img/tentang/DSC08013.jpg') }}"
        class="absolute inset-0 w-full h-full object-cover"
    >

    <div class="absolute inset-0 bg-black/45"></div>

    <div class="relative z-10 h-full flex items-end">

        <div class="max-w-9xl mx-auto w-full px-8 lg:px-20 pb-24">

            <h1
             data-aos="fade-up"
            data-aos-delay="300"
                class="font-peckham text-[6.5vw] sm:text-[3vw] md:text-[3vw] text-4xl text-white  uppercase block mb-3 tracking-tighter">


                Di balik setiap karya,
                <br>
                selalu ada seseorang
                yang berani memulai
            </h1>



        <!-- Button -->
    <div class="mt-8">
        <a href="{{ route('film') }}"
            class="inline-flex items-center bg-navy hover:bg-white text-white hover:text-[#F36B21] px-8 py-3 rounded-full uppercase font-bold tracking-wider transition-all duration-300 shadow-lg cursor-none hover-target">
            Our Works
        </a>


            {{-- <h1
             data-aos="fade-up"
            data-aos-delay="300"
                class="mt-4 text-white text-5xl lg:text-4xl font-black uppercase leading-none">


                Di balik setiap karya,
                <br>
                selalu ada seseorang
                yang berani memulai.
            </h1> --}}

        </div>

    </div>

</section>

<section class="bg-white py-5">

    <div class="max-w-7xl mx-auto px-8">

        @if($event)

            <div class="text-center mb-6">

                <h2 class="font-peckham text-[3.5vw] text-brand-navy uppercase">
                    {{ $event->judul }}
                </h2>

            </div>

            <div class="columns-1 lg:columns-2 gap-16 text-[20px] leading-9 text-gray-700 text-justify">

                {!! $event->detail !!}

            </div>

        @else

            <div class="text-center py-20">

                <h2 class="font-peckham text-4xl text-brand-navy">
                    Data belum tersedia
                </h2>

            </div>

        @endif

    </div>

</section>

{{-- CONTENT
<div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 mt-0">

    {{-- KIRI --}}
    {{-- <div>

        <div class="space-y-3 text-[21px] leading-9 text-gray-700 text-justify"
             style="font-sans;">  --}}

            {{-- <p>
                Setiap cerita dimulai dari sebuah kesempatan.
                Tidak semua perjalanan dimulai dari tempat yang sama.
                Ada yang tumbuh di tengah industri kreatif.
                Ada pula yang harus menempuh perjalanan yang lebih panjang
                hanya untuk mendapatkan kesempatan pertamanya. Yang membedakan sering kali bukan bakat,
                melainkan kesempatan. Banyak cerita lahir dari pengalaman hidup yang sederhana.
                Dari percakapan sehari-hari, dari kegagalan,
                dari harapan, dari kehilangan,
                atau dari mimpi yang diam-diam terus dijaga. Namun tidak semua cerita menemukan ruang untuk didengar.
                Bukan karena cerita itu kurang berarti,
                melainkan karena belum menemukan pertemuan yang tepat. INI ISI
            </p> --}}

            {{-- <p>
                Yang membedakan sering kali bukan bakat,
                melainkan kesempatan. Banyak cerita lahir dari pengalaman hidup yang sederhana.
                Dari percakapan sehari-hari, dari kegagalan,
                dari harapan, dari kehilangan,
                atau dari mimpi yang diam-diam terus dijaga.
            </p> --}}
             {{-- <p>
                Namun tidak semua cerita menemukan ruang untuk didengar.
                Bukan karena cerita itu kurang berarti,
                melainkan karena belum menemukan pertemuan yang tepat.
            </p> --}}

        {{-- </div>

    </div> --}}

    {{-- KANAN --}}
    {{-- <div>

        <div class="space-y-3 text-[21px] leading-9 text-gray-700 text-justify"
             style="font-sans;">

            <p>
                Mungkin, setiap perjalanan besar memang selalu berawal
                dari sebuah pertemuan. Pertemuan antara manusia,
                gagasan, kepercayaan, dan kesempatan. Semangat itulah yang ingin terus tumbuh bersama
                Sinemaku Pictures. Bukan sebagai tempat yang memiliki
                semua jawaban, melainkan sebagai sebuah pintu
                yang tetap terbuka. Pintu untuk bertemu, berdialog, belajar,
                berkolaborasi, dan bersama-sama menciptakan
                sesuatu yang bermakna. Tidak setiap langkah akan berakhir menjadi sebuah film.
                    Tidak setiap pertemuan akan melahirkan sebuah karya.
                    Namun setiap kesempatan untuk saling mendengarkan selalu layak untuk dimulai. INI ISI JUGA
            </p> --}}

            {{-- <p>
                Semangat itulah yang ingin terus tumbuh bersama
                Sinemaku Pictures. Bukan sebagai tempat yang memiliki
                semua jawaban, melainkan sebagai sebuah pintu
                yang tetap terbuka.
            </p> --}}

            {{-- <p>
                Pintu untuk bertemu, berdialog, belajar,
                berkolaborasi, dan bersama-sama menciptakan
                sesuatu yang bermakna.
            </p> --}}
            {{-- <p> Tidak setiap langkah akan berakhir menjadi sebuah film.
                    Tidak setiap pertemuan akan melahirkan sebuah karya.
                    Namun setiap kesempatan untuk saling mendengarkan selalu layak untuk dimulai.</p> --}}
        {{-- </div>

    </div>

</div>

        </div>

    </div>

</section> --}}

<section class="bg-black py-3">

<div class="max-w-7xl mx-auto px-8">

<div class="mb-6">

<span class="uppercase tracking-[5px] text-[#F36B21] text-sm font-bold">

Gallery Foto

</span>

</div>

<div class="grid grid-cols-12 gap-3">

        {{-- Row 1 --}}
        <div class="col-span-12 md:col-span-6">
            <img id="gallery-1"
                 class="w-full h-[320px] object-cover rounded-2xl">
        </div>

        <div class="col-span-12 md:col-span-6">
            <img id="gallery-2"
                 class="w-full h-[320px] object-cover rounded-2xl">
        </div>

        {{-- Row 2 --}}
        <div class="col-span-12 md:col-span-4">
            <img id="gallery-3"
                 class="w-full h-[320px] object-cover rounded-2xl">
        </div>

        <div class="col-span-12 md:col-span-4">
            <img id="gallery-4"
                 class="w-full h-[320px] object-cover rounded-2xl">
        </div>

        <div class="col-span-12 md:col-span-4">
            <img id="gallery-5"
                 class="w-full h-[320px] object-cover rounded-2xl">
        </div>

       {{-- Row 3 --}}
<div class="col-span-12 md:col-span-6">
    <img id="gallery-6"
         class="w-full h-[320px] object-cover rounded-2xl">
</div>

<div class="col-span-12 md:col-span-6 relative cursor-pointer"
     onclick="openGallery()">

    <img id="gallery-7"
         class="w-full h-[320px] object-cover rounded-2xl">

    <div id="gallery-overlay"
         class="absolute inset-0 bg-black/60 rounded-2xl flex items-center justify-center text-white text-5xl font-bold">
        +99
    </div>

</div>

</section>

<div id="gallery-all-images" style="display:none;"></div>


<script>

const data = @json($event ?? null);

function setGalleryImage(id, photo){

    const img = document.getElementById(id);

    if(!img) return;

    if(photo){

        let url = photo.photo;

        if(!url.startsWith('http')){
            url = "{{ asset('photo') }}/" + url;
        }

        img.src = url;
        img.style.display = "block";

    }else{

        img.style.display = "none";

    }

}

function loadGallery(){

    if(!data || !data.photos) return;

    // isi 7 foto pertama
    setGalleryImage("gallery-1", data.photos[0]);
    setGalleryImage("gallery-2", data.photos[1]);
    setGalleryImage("gallery-3", data.photos[2]);
    setGalleryImage("gallery-4", data.photos[3]);
    setGalleryImage("gallery-5", data.photos[4]);
    setGalleryImage("gallery-6", data.photos[5]);
    setGalleryImage("gallery-7", data.photos[6]);

    const container = document.getElementById("gallery-all-images");
    container.innerHTML = "";

    data.photos.forEach(photo => {

        let url = photo.photo;

        if(!url.startsWith('http')){
            url = "{{ asset('photo') }}/" + url;
        }

        container.innerHTML += `
            <a href="${url}">
                <img src="${url}" class="hidden">
            </a>
        `;

    });

    if(window.galleryInstance){
        window.galleryInstance.destroy();
    }

    window.galleryInstance = lightGallery(container,{
        selector:'a',
        thumbnail:true,
        plugins:[lgThumbnail],
        download:false
    });

    const overlay = document.getElementById("gallery-overlay");

    if(data.photos.length > 7){

        overlay.style.display = "flex";
        overlay.innerHTML = "+" + (data.photos.length - 7);

    }else{

        overlay.style.display = "none";

    }

}

function openGallery(){

    if(window.galleryInstance){
        window.galleryInstance.openGallery(6);
    }

}

document.addEventListener("DOMContentLoaded",function(){

    loadGallery();

});

</script>

@include('components.footer')

@endsection
