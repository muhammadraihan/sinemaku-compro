@extends('layouts.app')

@section('title','Tentang Kami | Sinemaku Pictures')

@push('head')
    <style>
        .tentang-gradient-panel {
            position: relative;
            overflow: hidden;
            isolation: isolate;
            background: #fff;
        }

        .tentang-gradient-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                radial-gradient(circle 360px at var(--tentang-mx, 50%) var(--tentang-my, 50%), rgba(243, 107, 33, 0.24) 0%, rgba(243, 107, 33, 0.11) 38%, transparent 72%),
                radial-gradient(circle 220px at var(--tentang-mx, 50%) var(--tentang-my, 50%), rgba(255, 180, 87, 0.16) 0%, transparent 70%);
            filter: blur(26px);
            opacity: 0;
            transition: opacity 0.35s ease;
        }

        .tentang-gradient-panel:hover::before {
            opacity: 1;
        }

        .tentang-gradient-content {
            position: relative;
            z-index: 1;
        }
    </style>
@endpush

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


        </div>

    </div>

</section>

<section class="tentang-gradient-panel py-5">

    <div class="tentang-gradient-content max-w-7xl mx-auto px-8">

        @if($event)

            <div class="text-center mb-0">

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



<section class="bg-black py-3">

    <div class="max-w-7xl mx-auto px-8">

        <div class="mb-6">
            <span class="uppercase tracking-[5px] text-[#F36B21] text-sm font-bold">
                Gallery Foto
            </span>
        </div>

        <div class="grid grid-cols-12 gap-3">

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

            <div class="col-span-12 md:col-span-6">
                <img id="gallery-6"
                    onclick="showImage(this.src)"
                    class="w-full h-[320px] object-cover rounded-2xl cursor-pointer">
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

        </div>

    </div>

</section>

<div id="gallery-all-images" style="display:none;"></div>

<div id="imageModal"
    class="fixed inset-0 bg-black/90 hidden items-center justify-center z-[9999]"
    onclick="closeImage()">

    <button
        class="absolute top-5 right-8 text-white text-6xl">
        &times;
    </button>

    <img id="modalImage"
        class="max-w-[90vw] max-h-[90vh] rounded-xl"
        onclick="event.stopPropagation()">

</div>


<script>

const data = @json($event ?? null);

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

    }else{

        img.style.display = "none";

    }

}

function loadGallery(){

    if(!data || !data.photos) return;

    setGalleryImage("gallery-1", data.photos[0]);
    setGalleryImage("gallery-2", data.photos[1]);
    setGalleryImage("gallery-3", data.photos[2]);
    setGalleryImage("gallery-4", data.photos[3]);
    setGalleryImage("gallery-5", data.photos[4]);
    setGalleryImage("gallery-6", data.photos[5]);
    setGalleryImage("gallery-7", data.photos[6]);

    const container = document.getElementById("gallery-all-images");

    container.innerHTML = "";

    data.photos.forEach(photo=>{

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

document.addEventListener("DOMContentLoaded",function(){

    loadGallery();

    const tentangGradientPanel = document.querySelector(".tentang-gradient-panel");

    if (tentangGradientPanel) {
        tentangGradientPanel.addEventListener("mousemove", function(event) {
            const rect = tentangGradientPanel.getBoundingClientRect();
            const x = ((event.clientX - rect.left) / rect.width) * 100;
            const y = ((event.clientY - rect.top) / rect.height) * 100;

            tentangGradientPanel.style.setProperty("--tentang-mx", x + "%");
            tentangGradientPanel.style.setProperty("--tentang-my", y + "%");
        });
    }

});

</script>

@include('components.footer')

@endsection
