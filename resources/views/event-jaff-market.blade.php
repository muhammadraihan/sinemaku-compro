@extends('layouts.app')

@section('title','JAFF MARKET | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

{{-- ==========================================================
HERO
========================================================== --}}
<section class="relative h-screen overflow-hidden">

    <div class="absolute inset-0 z-0">

       {{-- Background --}}
    <img src="{{ asset('../img/jaff/DSC08954.jpg') }}"
        class="hero-slide active">
    <img src="{{ asset('../img/jaff/ARDC9126.jpg') }}"
        class="hero-slide active">
    <img src="{{ asset('../img/jaff/9.jpg') }}"
        class="hero-slide">
    <img src="{{ asset('../img/jaff/DSC08021.jpg') }}"
        class="hero-slide">
    <img src="{{ asset('../img/jaff/DSC09671.jpg') }}"
        class="hero-slide">
    <img src="{{ asset('../img/jaff/ARDC8698.jpg') }}"
        class="hero-slide">
         </div>

    {{-- Overlayy --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/20"></div>

    <div class="relative z-10 h-full flex items-end">

        <div class="max-w-7xl mx-auto w-full px-8 lg:px-20 pb-10">

            <h1
                data-aos="fade-up"
                data-aos-delay="300"
                class="font-peckham
                text-[clamp(3rem,14vw,5.5rem)]
                sm:text-[9vw]
                md:text-[6vw]
                lg:text-[5vw]
                uppercase
                tracking-tight
                text-white">

                JAFF MARKET

            </h1>

        </div>

    </div>

</section>



{{-- ==========================================================
FILM SELECTOR
========================================================== --}}

<section class="bg-white py-5 border-y border-gray-200">

    <div class="max-w-7xl mx-auto px-8">


        <div class="flex flex-wrap justify-center gap-3">
            @foreach ($events as $index => $event)
            <button onclick="showFilm({{ $index }}, this)" class="film-button inline-block transition-all duration-300 text-xs font-sans font-bold tracking-widest px-4 py-2 rounded-md border border-brand-navy/20 shadow-sm uppercase bg-brand-navy/5 text-brand-navy hover:bg-brand-orange hover:border-brand-orange hover:text-white">
                {{ $event->judul }}
            </button>
        @endforeach

        </div>

    </div>

</section>
{{-- ==========================================================
DETAIL FILM
========================================================== --}}

<section id="film-section" class="bg-white pt-10 pb-20">

    <div class="max-w-7xl mx-auto px-8">

        <div class="text-center mb-6">

            <h2
                id="film-title"
                class="font-peckham text-[clamp(2rem,9vw,3.5rem)] md:text-[3.5vw] leading-[0.95] text-brand-navy uppercase">

                BOLEHKAH SEKALI SAJA KUMENANGIS

            </h2>

        </div>

        <div
            id="film-desc-1"
            class="columns-1 lg:columns-2 gap-16 text-[20px] leading-9 text-gray-700 text-justify">
            {{-- Detail will be loaded dynamically --}}
        </div>

    </div>

</section>
{{-- ==========================================================
GALLERY
========================================================== --}}
<section class="bg-black py-3">

    <div class="max-w-7xl mx-auto px-8">

        <div class="mb-6">
            <span class="uppercase tracking-[5px] text-[#F36B21] text-sm font-bold">
                Video & Galeri Foto
            </span>
        </div>

        <div class="grid grid-cols-12 gap-3">

            {{-- Row 1 --}}
            <div class="col-span-12 md:col-span-6">
                <img id="gallery-1"
                    class="w-full h-[320px] object-cover rounded-2xl cursor-pointer">
            </div>

            <div class="col-span-12 md:col-span-6">
                <img id="gallery-2"
                    class="w-full h-[320px] object-cover rounded-2xl cursor-pointer">
            </div>

            {{-- Row 2 --}}
            <div class="col-span-12 md:col-span-4">
                <img id="gallery-3"
                    class="w-full h-[320px] object-cover rounded-2xl cursor-pointer">
            </div>

            <div class="col-span-12 md:col-span-4">
                <img id="gallery-4"
                    class="w-full h-[320px] object-cover rounded-2xl cursor-pointer">
            </div>

            <div class="col-span-12 md:col-span-4">
                <img id="gallery-5"
                    class="w-full h-[320px] object-cover rounded-2xl cursor-pointer">
            </div>

            {{-- Row 3 --}}
            <div class="col-span-12 md:col-span-6">
                <img id="gallery-6"
                    class="w-full h-[320px] object-cover rounded-2xl cursor-pointer">
            </div>

            <div class="col-span-12 md:col-span-6 relative cursor-pointer"
                onclick="openGallery(6)">

                <img id="gallery-7"
                    class="w-full h-[320px] object-cover rounded-2xl">

                <div id="gallery-overlay"
                    class="absolute inset-0 bg-black/60 rounded-2xl flex items-center justify-center text-white text-5xl font-bold">
                    +99
                </div>

            </div>

        </div>

    </div>

</section>

<div id="gallery-all-images" style="display:none;"></div>

{{-- Modal Preview --}}
<div id="imageModal"
    class="fixed inset-0 bg-black/90 hidden items-center justify-center z-[9999]"
    onclick="closeImage()">

    <button
        class="absolute top-5 right-8 text-white text-6xl"
        onclick="closeImage()">
        &times;
    </button>

    <img id="modalImage"
        class="max-w-[90vw] max-h-[90vh] rounded-xl shadow-2xl"
        onclick="event.stopPropagation()">

</div>

<style>

.film-button{
    display: inline-block;
    padding: 8px 16px;
    border: 1px solid rgba(19, 27, 77, 0.2);
    border-radius: 8px;
    background: rgba(19, 27, 77, 0.05);
    color: #131B4D;
    font-size: 12px;
    font-family: sans-serif;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    box-shadow: 0 1px 2px rgba(0,0,0,.05);
    transition: all .3s ease;
}

.film-button:hover{
    background: #F36B21;
    border-color: #F36B21;
    color: #fff;
}

.active-film{
    background: #F36B21;
    border-color: #F36B21;
    color: #fff;
}
.hero-slide{
    position:absolute;
    inset:0;
    width:100%;
    height:100%;
    object-fit:cover;

    opacity:0;
    transition:opacity 1s ease-in-out;
}

.hero-slide.active{
    opacity:1;
}

</style>

<script>

@php
    $events->load('photos');
@endphp

const filmsData = @json($events);

function showFilm(index, button){

    const data = filmsData[index];

    if(!data) return;

    document.getElementById("film-title").innerHTML = data.judul;
    document.getElementById("film-desc-1").innerHTML = data.detail ?? "";

    function setGalleryImage(id, photo){

        const img = document.getElementById(id);

        if(!img) return;

        if(photo){

            let url = photo.photo;

            if(!url.startsWith("http")){
                url = "{{ asset('photo') }}/" + url;
            }

            img.src = url;
            img.style.display = "block";

            if(id !== "gallery-7"){

                img.onclick = function(e){
                    e.stopPropagation();
                    showImage(url);
                };

            }else{

                img.onclick = null;

            }

        }else{

            img.style.display = "none";
            img.onclick = null;

        }

    }

    setGalleryImage("gallery-1", data.photos[0]);
    setGalleryImage("gallery-2", data.photos[1]);
    setGalleryImage("gallery-3", data.photos[2]);
    setGalleryImage("gallery-4", data.photos[3]);
    setGalleryImage("gallery-5", data.photos[4]);
    setGalleryImage("gallery-6", data.photos[5]);
    setGalleryImage("gallery-7", data.photos[6]);

    loadGallery(data.photos);

    document.querySelectorAll(".film-button").forEach(btn=>{
        btn.classList.remove("active-film");
    });

    button.classList.add("active-film");

}

function loadGallery(photos){

    const container = document.getElementById("gallery-all-images");

    container.innerHTML = "";

    photos.forEach(photo=>{

        let url = photo.photo;

        if(!url.startsWith("http")){
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

    if(photos.length > 7){

        overlay.style.display = "flex";
        overlay.innerHTML = "+" + (photos.length - 7);

    }else{

        overlay.style.display = "none";

    }

}

function openGallery(index = 6){

    if(window.galleryInstance){
        window.galleryInstance.openGallery(index);
    }

}

function showImage(src){

    document.getElementById("modalImage").src = src;

    const modal = document.getElementById("imageModal");

    modal.classList.remove("hidden");
    modal.classList.add("flex");

}

function closeImage(){

    const modal = document.getElementById("imageModal");

    modal.classList.remove("flex");
    modal.classList.add("hidden");

}

document.addEventListener("DOMContentLoaded",()=>{

    const firstButton = document.querySelector(".film-button");

    if(firstButton){
        showFilm(0, firstButton);
    }

    const heroSlides = document.querySelectorAll(".hero-slide");

if(heroSlides.length > 1){

    let heroIndex = 0;

    setInterval(() => {

        heroSlides[heroIndex].classList.remove("active");

        heroIndex = (heroIndex + 1) % heroSlides.length;

        heroSlides[heroIndex].classList.add("active");

    }, 3000);

}

});

</script>
@include('components.footer')
