@extends('layouts.app')

@section('title','Sinemaku Day | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

{{-- ==========================================================
HERO
========================================================== --}}
<section class="relative h-screen overflow-hidden">


    <div class="absolute inset-0 z-0">

    {{-- Background --}}
    <img
        src="{{ asset('../img/sinemakuday/sinemaku.jpeg') }}"
        class="hero-slide active">
    <img src="{{ asset('../img/sinemakuday/_ARM1010.JPG') }}"
        class="hero-slide active">
    <img src="{{ asset('../img/sinemakuday/_ARM1765.JPG') }}"
        class="hero-slide">
    <img src="{{ asset('../img/sinemakuday/_ARM1859.JPG') }}"
        class="hero-slide">
    <img src="{{ asset('../img/sinemakuday/_ARM0983.JPG') }}"
        class="hero-slide">
    <img src="{{ asset('../img/sinemakuday/_ARM1588.jpg') }}"
        class="hero-slide">
    <img src="{{ asset('../img/sinemakuday/_ARM0743.JPG') }}"
        class="hero-slide">
    <img src="{{ asset('../img/sinemakuday/_ARM1611.jpg') }}"
        class="hero-slide">
        </div>

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/20"></div>

    <div class="relative z-10 h-full flex items-end">

        <div class="max-w-7xl mx-auto w-full px-8 lg:px-20 pb-24">

            <h1
                data-aos="fade-up"
                data-aos-delay="300"
                class="font-peckham
                text-[14vw]
                sm:text-[9vw]
                md:text-[6vw]
                lg:text-[5vw]
                uppercase
                tracking-tight
                text-white">

                SINEMAKU DAY

            </h1>

            <span
                data-aos="fade-up"
                data-aos-delay="500"
                class="mt-4
                block
                uppercase
                tracking-[6px]
                text-white
                font-bold
                text-xs
                md:text-sm">

                SINEMAKU PICTURES

            </span>

        </div>

    </div>

</section>

{{-- ==========================================================
EVENT SELECTOR
========================================================== --}}

<section class="bg-white py-5 border-y border-gray-200">

    <div class="flex flex-wrap justify-center gap-3">
            @foreach ($events as $index => $event)
                <button
                    onclick="showEvent({{ $index }}, this)"
                    class="film-button inline-block transition-all duration-300 text-xs font-sans font-bold tracking-widest px-4 py-2 rounded-md border border-brand-navy/20 shadow-sm uppercase bg-brand-navy/5 text-brand-navy hover:bg-brand-orange hover:border-brand-orange hover:text-white">
                    {{ $event->judul }}
                </button>
    @endforeach


        </div>

    </div>

</section>
{{-- ==========================================================
DETAIL EVENT
========================================================== --}}

<section id="event-section" class="bg-white pt-10 pb-20">

    <div class="max-w-7xl mx-auto px-8">

        {{-- Judul --}}
        <div class="text-center mb-6">

            <h2
                id="event-title"
                class="font-peckham text-[3.5vw] text-brand-navy uppercase">

                SINEMAKU DAY 2024

            </h2>

        </div>

        {{-- Deskripsi --}}
        <div class="max-w-6xl mx-auto">

            <div
                id="event-desc-1"
                class="columns-1 lg:columns-2 gap-16 text-[20px] leading-9 text-gray-700 text-justify">
                {{-- Detail will be loaded dynamically --}}
            </div>

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
                    onclick="showImage(this.src)"
                    class="w-full h-[320px] object-cover rounded-2xl cursor-pointer">
            </div>

            <div class="col-span-12 md:col-span-6">
                <img id="gallery-2"
                    onclick="showImage(this.src)"
                    class="w-full h-[320px] object-cover rounded-2xl cursor-pointer">
            </div>

            {{-- Row 2 --}}
            <div class="col-span-12 md:col-span-4">
                <img id="gallery-3"
                    onclick="showImage(this.src)"
                    class="w-full h-[320px] object-cover rounded-2xl cursor-pointer">
            </div>

            <div class="col-span-12 md:col-span-4">
                <img id="gallery-4"
                    onclick="showImage(this.src)"
                    class="w-full h-[320px] object-cover rounded-2xl cursor-pointer">
            </div>

            <div class="col-span-12 md:col-span-4">
                <img id="gallery-5"
                    onclick="showImage(this.src)"
                    class="w-full h-[320px] object-cover rounded-2xl cursor-pointer">
            </div>

            {{-- Row 3 --}}
            <div class="col-span-12 md:col-span-6">
                <img id="gallery-6"
                    onclick="showImage(this.src)"
                    class="w-full h-[320px] object-cover rounded-2xl cursor-pointer">
            </div>

            {{-- Foto terakhir membuka gallery --}}
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
        type="button"
        onclick="closeImage(); event.stopPropagation();"
        class="absolute top-5 right-8 text-white text-6xl leading-none">
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

const eventsData = @json($events);

function showEvent(index, button) {
const data = eventsData[index];
console.log(data);

console.log(data);
console.log("video_link:", data.video_link);
    if (!data) return;

   document.getElementById("event-title").innerHTML = data.judul;
document.getElementById("event-desc-1").innerHTML = data.detail ?? '';

    // Helper function untuk set image gallery
   function setGalleryImage(elementId, photoObj) {

    const imgElement = document.getElementById(elementId);

    if (!imgElement) return;

    if (photoObj && photoObj.photo) {

        let photoUrl = photoObj.photo;

        if (!photoUrl.startsWith('http')) {
            photoUrl = "{{ asset('photo') }}/" + photoUrl;
        }

        imgElement.src = photoUrl;
        imgElement.style.display = "block";

     // Foto pertama membuka link video
if (elementId === "gallery-1") {

   imgElement.onclick = function () {

    console.log("Foto pertama diklik");
    console.log("Video:", data.video_link);

    if (data.video_link) {
        console.log("Membuka YouTube...");
        window.open(data.video_link, "_blank");
    } else {
        console.log("Video kosong");
        showImage(photoUrl);
    }

};
    };

}
// Foto lainnya tetap preview
else if (elementId !== "gallery-7") {

    imgElement.onclick = function () {
        showImage(photoUrl);
    };

}

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

    // Ganti tombol aktif
    document.querySelectorAll(".film-button").forEach(function(btn){
        btn.classList.remove("active-film");
    });

    button.classList.add("active-film");

}

function loadGallery(photos){

    const container = document.getElementById("gallery-all-images");

    container.innerHTML = "";

    photos.forEach(photo => {

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

    console.log(photos);
    console.log(container.innerHTML);

    // Hancurkan gallery lama
  window.galleryInstance = lightGallery(container,{
    selector:'a',
    download:false,
    thumbnail:true,
    plugins:[lgThumbnail],
    dynamic:false
});

    const overlay = document.getElementById("gallery-overlay");

    if(photos.length > 7){
        overlay.innerHTML = "+" + (photos.length - 6);
        overlay.style.display = "flex";
    }else{
        overlay.style.display = "none";
    }
}

function openGallery(){

    if(window.galleryInstance){
        window.galleryInstance.openGallery(6);
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

document.addEventListener("DOMContentLoaded", function () {

    const firstButton = document.querySelector(".film-button");

    if (firstButton) {
       showEvent(0, firstButton);
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
