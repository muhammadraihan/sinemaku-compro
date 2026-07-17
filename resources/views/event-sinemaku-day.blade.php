@extends('layouts.app')

@section('title','Sinemaku Day | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

{{-- ==========================================================
HERO
========================================================== --}}
<section class="relative h-screen overflow-hidden">

    {{-- Background --}}
    <img
        src="{{ asset('../img/sinemakuday/sinemaku.jpeg') }}"
        class="absolute inset-0 w-full h-full object-cover">

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

<section class="bg-white py-10 border-y border-gray-200">

    <div class="max-w-7xl mx-auto px-8">

        <div class="flex flex-wrap justify-center gap-3">

            <button onclick="showEvent('2024', this)"
                class="film-button active-film">

                Sinemaku Day 2024

            </button>

            <button onclick="showEvent('2025', this)"
                class="film-button">

                Sinemaku Day 2025

            </button>

        </div>

    </div>

</section>
{{-- ==========================================================
DETAIL EVENT
========================================================== --}}

<section id="event-section" class="bg-white py-20">

    <div class="max-w-7xl mx-auto px-8">

        {{-- Judul --}}
        <div class="text-center mb-16">

            <h2
                id="event-title"
                class="font-peckham text-[3.5vw] text-brand-navy uppercase">

                SINEMAKU DAY 2024

            </h2>

        </div>

        {{-- Deskripsi --}}
        <div class="max-w-6xl mx-auto">

            <div class="grid lg:grid-cols-2 gap-16 items-start">

                <div>

                    <p
                        id="event-desc-1"
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
                        id="event-desc-2"
                        class="text-[20px] leading-9 text-gray-700 text-justify">

                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Accusantium veniam perferendis modi facere voluptate adipisci.
                        Modi deserunt sequi ipsa tempore architecto voluptates.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>
{{-- ==========================================================
EVENT GALLERY
========================================================== --}}

<section class="bg-[#fafafa] pt-10 pb-28">

    <div class="max-w-7xl mx-auto px-8">

        <div class="mb-6">

            <span
                class="uppercase tracking-[5px] text-[#F36B21] text-sm font-bold">

                Event Gallery

            </span>

        </div>

        <div class="grid grid-cols-12 gap-6">

            {{-- FOTO BESAR --}}
            <div class="col-span-12 lg:col-span-7">

                <div class="overflow-hidden rounded-2xl group">

                    <img
                        id="gallery-main"
                        src="{{ asset('../img/sinemakuday/2024/1.jpg') }}"
                        class="h-[650px] w-full object-cover transition duration-700 group-hover:scale-105">

                </div>

            </div>

            {{-- FOTO KANAN --}}
            <div class="col-span-12 lg:col-span-5 flex flex-col gap-6">

                <div class="overflow-hidden rounded-2xl group">

                    <img
                        id="gallery-1"
                        src="{{ asset('../img/sinemakuday/2024/2.jpg') }}"
                        class="h-[200px] w-full object-cover transition duration-700 group-hover:scale-105">

                </div>

                <div class="overflow-hidden rounded-2xl group">

                    <img
                        id="gallery-2"
                        src="{{ asset('../img/sinemakuday/2024/3.jpg') }}"
                        class="h-[200px] w-full object-cover transition duration-700 group-hover:scale-105">

                </div>

                <div class="overflow-hidden rounded-2xl group">

                    <img
                        id="gallery-3"
                        src="{{ asset('../img/sinemakuday/2024/4.jpg') }}"
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

const events = {

    2024: {
        title: "SINEMAKU DAY 2024",
        desc1: `Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Accusantium veniam perferendis modi facere voluptate adipisci.
                Modi deserunt sequi ipsa tempore architecto voluptates.
                Lorem ipsum dolor sit amet consectetur adipisicing elit.`,
        desc2: `Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Accusantium veniam perferendis modi facere voluptate adipisci.
                Modi deserunt sequi ipsa tempore architecto voluptates.
                Lorem ipsum dolor sit amet consectetur adipisicing elit.`,
        gallery: [
            "{{ asset('../img/sinemakuday/SINEMA24.JPG') }}",
            "{{ asset('../img/sinemakuday/SINEMAKU DAY 24.JPG') }}",
            "{{ asset('../img/sinemakuday/SINEMAKU DAY 2024.JPG') }}",
            "{{ asset('../img/sinemakuday/_ARM1148.JPG') }}"
        ]
    },

    2025: {
        title: "SINEMAKU DAY 2025",
        desc1: `Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Accusantium veniam perferendis modi facere voluptate adipisci.
                Modi deserunt sequi ipsa tempore architecto voluptates.
                Lorem ipsum dolor sit amet consectetur adipisicing elit.`,
        desc2: `Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Accusantium veniam perferendis modi facere voluptate adipisci.
                Modi deserunt sequi ipsa tempore architecto voluptates.
                Lorem ipsum dolor sit amet consectetur adipisicing elit.`,
        gallery: [
             "{{ asset('../img/sinemakuday/SINEMDAY25.jpg') }}",
            "{{ asset('../img/sinemakuday/SINEMAKU25.jpg') }}",
            "{{ asset('../img/sinemakuday/SINEM25.jpg') }}",
            "{{ asset('../img/sinemakuday/SIM25.jpg') }}"
        ]
    }

};

function showEvent(year, button){

    const data = events[year];

    if(!data) return;

    document.getElementById("event-title").innerHTML = data.title;

    document.getElementById("event-desc-1").innerHTML = data.desc1;
    document.getElementById("event-desc-2").innerHTML = data.desc2;

    document.getElementById("gallery-main").src = data.gallery[0];
    document.getElementById("gallery-1").src = data.gallery[1];
    document.getElementById("gallery-2").src = data.gallery[2];
    document.getElementById("gallery-3").src = data.gallery[3];

    document.querySelectorAll(".film-button").forEach(function(btn){
        btn.classList.remove("active-film");
    });

    button.classList.add("active-film");

}

</script>

@include('components.footer')


