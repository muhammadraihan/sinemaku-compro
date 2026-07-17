@extends('layouts.app')

@section('title','Goes to School | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

{{-- ==========================================================
HERO
========================================================== --}}
<section class="relative h-screen overflow-hidden">

    {{-- Background --}}
    <img
        src="{{ asset('../img/gts/gts.jpeg') }}"
        class="absolute inset-0 w-full h-full object-cover"
    >

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

                GOES TO SCHOOL

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
FILM SELECTOR
========================================================== --}}

<section class="bg-white py-10 border-y border-gray-200">

    <div class="max-w-7xl mx-auto px-8">

        <div class="flex flex-wrap justify-center gap-3">

            <button onclick="showFilm('bolehkah', this)" class="film-button">
                Bolehkah Sekali Saja Kumenangis
            </button>

            <button onclick="showFilm('patah', this)" class="film-button">
                Patah Hati Yang Ku Pilih
            </button>

        </div>

    </div>

</section>
{{-- ==========================================================
DETAIL FILM
========================================================== --}}

<section id="film-section" class="bg-white py-20">

    <div class="max-w-7xl mx-auto px-8">

        <div class="text-center mb-16">

            <h2
                id="film-title"
                class="font-peckham text-[3.5vw] text-brand-navy uppercase">

                BOLEHKAH SEKALI SAJA KUMENANGIS

            </h2>

        </div>

        <div class="grid lg:grid-cols-2 gap-16">

            <div>

                <p
                    id="film-desc-1"
                    class="text-[20px] leading-9 text-gray-700 text-justify">

                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Ducimus iste voluptas placeat totam.
                    Accusantium numquam aliquid ab esse quasi at.
                    Vel quos natus itaque autem repellat enim ea iusto minus.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.

                </p>

            </div>

            <div>

                <p
                    id="film-desc-2"
                    class="text-[20px] leading-9 text-gray-700 text-justify">

                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Accusantium veniam perferendis modi facere voluptate adipisci.
                    Modi deserunt sequi ipsa tempore architecto voluptates.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.

                </p>

            </div>

        </div>

    </div>

</section>
{{-- ==========================================================
GALLERY
========================================================== --}}

<section class="bg-[#fafafa] pt-10 pb-28">

    <div class="max-w-7xl mx-auto px-8">

        <div class="mb-6">

            <span
                class="uppercase tracking-[5px] text-[#F36B21] text-sm font-bold">

                Event Gallery

            </span>

            {{-- <h2
                id="gallery-title"
                class="font-peckham text-5xl text-brand-navy mt-3">

                BOLEHKAH SEKALI SAJA KUMENANGIS

            </h2> --}}

        </div>


        <div class="grid grid-cols-12 gap-6">

            {{-- FOTO BESAR --}}
            <div class="col-span-12 lg:col-span-7">

                <div class="overflow-hidden rounded-2xl group">

                    <img
                        id="gallery-main"
                        src="{{ asset('../img/gala/_ARM1785.jpg') }}"
                        class="h-[650px] w-full object-cover transition duration-700 group-hover:scale-105">

                </div>

            </div>


            {{-- FOTO KANAN --}}
            <div class="col-span-12 lg:col-span-5 flex flex-col gap-6">

                <div class="overflow-hidden rounded-2xl group">

                    <img
                        id="gallery-1"
                        src="{{ asset('../img/gala/_ARM1959.jpg') }}"
                        class="h-[200px] w-full object-cover transition duration-700 group-hover:scale-105">

                </div>

                <div class="overflow-hidden rounded-2xl group">

                    <img
                        id="gallery-2"
                        src="{{ asset('../img/gala/_ARM2795.jpg') }}"
                        class="h-[200px] w-full object-cover transition duration-700 group-hover:scale-105">

                </div>

                <div class="overflow-hidden rounded-2xl group">

                    <img
                        id="gallery-3"
                        src="{{ asset('../img/gala/_ARM1730.jpg') }}"
                        class="h-[200px] w-full object-cover transition duration-700 group-hover:scale-105">

                </div>

            </div>

        </div>

    </div>

</section>
<style>

.film-button{

    padding:12px 22px;

    border:1px solid #131B4D;

    border-radius:999px;

    background:white;

    color:#131B4D;

    font-size:14px;

    font-weight:600;

    transition:.3s;

}

.film-button:hover{

    background:#131B4D;

    color:white;

}

.active-film{

    background:#131B4D;

    color:white;

}

</style>

<script>

const films = {

    bolehkah: {
        title: "BOLEHKAH SEKALI SAJA KUMENANGIS",
        desc1: `
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Ducimus iste voluptas placeat totam.
            Accusantium numquam aliquid ab esse quasi at.
            Vel quos natus itaque autem repellat enim ea iusto minus.
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
        `,
        desc2: `
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Accusantium veniam perferendis modi facere voluptate adipisci.
            Modi deserunt sequi ipsa tempore architecto voluptates.
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
        `,
        gallery: [
            "{{ asset('../img/gala/_ARM1785.jpg') }}",
            "{{ asset('../img/gala/_ARM1959.jpg') }}",
            "{{ asset('../img/gala/_ARM2795.jpg') }}",
            "{{ asset('../img/gala/_ARM1730.jpg') }}"
        ]
    },

    patah: {
        title: "PATAH HATI YANG KU PILIH",
        desc1: `
             Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Ducimus iste voluptas placeat totam.
            Accusantium numquam aliquid ab esse quasi at.
            Vel quos natus itaque autem repellat enim ea iusto minus.
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
        `,
        desc2: `
             Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Ducimus iste voluptas placeat totam.
            Accusantium numquam aliquid ab esse quasi at.
            Vel quos natus itaque autem repellat enim ea iusto minus.
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
        `,
        gallery: [
            "{{ asset('../img/gala/_ARM3087.jpg') }}",
            "{{ asset('../img/gala/_ARM3503.jpg') }}",
            "{{ asset('../img/gala/_ARM4212.jpg') }}",
            "{{ asset('../img/gala/_ARM3077.jpg') }}"
        ]
    },

};


function showFilm(film, button) {

    const data = films[film];

    if (!data) return;

    document.getElementById("film-title").innerHTML = data.title;
// document.getElementById("gallery-title").innerHTML = data.title;

    // Ganti deskripsi
    document.getElementById("film-desc-1").innerHTML = data.desc1;
    document.getElementById("film-desc-2").innerHTML = data.desc2;

    // Ganti gallery
    document.getElementById("gallery-main").src = data.gallery[0];
    document.getElementById("gallery-1").src = data.gallery[1];
    document.getElementById("gallery-2").src = data.gallery[2];
    document.getElementById("gallery-3").src = data.gallery[3];

    // Ganti tombol aktif
    document.querySelectorAll(".film-button").forEach(function(btn){
        btn.classList.remove("active-film");
    });

    button.classList.add("active-film");

}

document.addEventListener("DOMContentLoaded", function () {

    const firstButton = document.querySelector(".film-button");

    if (firstButton) {
        showFilm("bolehkah", firstButton);
    }

});

</script>
@include('components.footer')

