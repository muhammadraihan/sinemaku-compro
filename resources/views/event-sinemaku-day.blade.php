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

    <div class="flex flex-wrap justify-center gap-3">
            @foreach ($events as $index => $event)
                <button
                    onclick="showEvent({{ $index }}, this)"
                    class="film-button inline-block transition-all duration-300 text-xs font-sans font-bold tracking-widest px-4 py-2 rounded-md border border-brand-navy/20 shadow-sm uppercase bg-brand-navy/5 text-brand-navy hover:bg-brand-orange hover:border-brand-orange hover:text-white">
                    {{ $event->judul }}
                </button>
    @endforeach
            {{-- <button onclick="showEvent('2024', this)"
                class="film-button active-film">

                Sinemaku Day 2024

            </button>

            <button onclick="showEvent('2025', this)"
                class="film-button">

                Sinemaku Day 2025

            </button> --}}

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

            <div
                id="event-desc-1"
                class="columns-1 lg:columns-2 gap-16 text-[20px] leading-9 text-gray-700 text-justify">
                {{-- Detail will be loaded dynamically --}}
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
</style>

<script>
    @php
    $events->load('photos');
    @endphp

    const eventsData = @json($events);

    function showEvent(index, button) {

        const data = eventsData[index];

        if (!data) return;

        document.getElementById("event-title").innerHTML = data.judul;

        // Set event details
        document.getElementById("event-desc-1").innerHTML = data.detail || '';

        // Helper function to set gallery images dynamically
        function setGalleryImage(elementId, photoObj) {
            const imgElement = document.getElementById(elementId);
            if (imgElement) {
                if (photoObj && photoObj.photo) {
                    let photoUrl = photoObj.photo;
                    if (!photoUrl.startsWith('http')) {
                        photoUrl = "{{ asset('photo') }}/" + photoUrl;
                    }
                    imgElement.src = photoUrl;
                    imgElement.style.display = 'block';
                } else {
                    imgElement.style.display = 'none';
                }
            }
        }

        setGalleryImage("gallery-main", data.photos[0]);
        setGalleryImage("gallery-1", data.photos[1]);
        setGalleryImage("gallery-2", data.photos[2]);
        setGalleryImage("gallery-3", data.photos[3]);

        document.querySelectorAll(".film-button").forEach(function(btn) {
            btn.classList.remove("active-film");
        });

        button.classList.add("active-film");

    }

    document.addEventListener("DOMContentLoaded", function() {

        const firstButton = document.querySelector(".film-button");

        if (firstButton) {
            showEvent(0, firstButton);
        }

    });
</script>

@include('components.footer')
