@extends('layouts.app')

@section('title','Tentang Kami | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

<section class="relative h-screen overflow-hidden">

    {{-- Background --}}
    <img
        src="{{ asset('img/tentang/tentang1.jpg') }}"
        class="absolute inset-0 w-full h-full object-cover"
    >

    <div class="absolute inset-0 bg-black/45"></div>

    <div class="relative z-10 h-full flex items-end">

        <div class="max-w-9xl mx-auto w-full px-8 lg:px-20 pb-24">

            <h1
             data-aos="fade-up"
            data-aos-delay="300"
                class="mt-4 text-white text-5xl lg:text-4xl font-black uppercase leading-none">


                Di balik setiap karya,
                <br>
                selalu ada seseorang
                yang berani memulai.
            </h1>

            <span
             data-aos="fade-up"
            data-aos-delay="100"
            class="font-serif font-bold uppercase tracking-[5px] text-orange-400 text-sm">
            Tentang Sinemaku Picture
            </span>

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

{{-- SECTION ABOUT --}}
<section class="bg-white py-28">

    <div class="max-w-7xl mx-auto px-8">

        {{-- Heading --}}
        <div class="text-center mb-20">


           <h1
        style="font-family: 'DM Serif Display', serif;"
        class="text-4xl font-bold">
        MENGAPA SINEMAKU ADA
    </h1>

        </div>

{{-- CONTENT --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 mt-16">

    {{-- KIRI --}}
    <div>

        <h3 class="text-4xl lg:text-5xl leading-tight text-black mb-10"
            style="font-family:'Instrument Serif', serif;">

            Setiap cerita dimulai
            <br>
            dari sebuah kesempatan.

        </h3>

        <div class="space-y-3 text-[21px] leading-9 text-gray-700 text-justify"
             style="font-sans;">

            <p>
                Tidak semua perjalanan dimulai dari tempat yang sama.
                Ada yang tumbuh di tengah industri kreatif.
                Ada pula yang harus menempuh perjalanan yang lebih panjang
                hanya untuk mendapatkan kesempatan pertamanya.
            </p>

            <p>
                Yang membedakan sering kali bukan bakat,
                melainkan kesempatan. Banyak cerita lahir dari pengalaman hidup yang sederhana.
                Dari percakapan sehari-hari, dari kegagalan,
                dari harapan, dari kehilangan,
                atau dari mimpi yang diam-diam terus dijaga.
            </p>

        </div>

    </div>

    {{-- KANAN --}}
    <div>

        <div class="space-y-3 text-[21px] leading-9 text-gray-700 text-justify"
             style="font-sans;">
            <p>
                Namun tidak semua cerita menemukan ruang untuk didengar.
                Bukan karena cerita itu kurang berarti,
                melainkan karena belum menemukan pertemuan yang tepat.
            </p>

            <p>
                Mungkin, setiap perjalanan besar memang selalu berawal
                dari sebuah pertemuan. Pertemuan antara manusia,
                gagasan, kepercayaan, dan kesempatan.
            </p>

            <p>
                Semangat itulah yang ingin terus tumbuh bersama
                Sinemaku Pictures. Bukan sebagai tempat yang memiliki
                semua jawaban, melainkan sebagai sebuah pintu
                yang tetap terbuka.
            </p>

            <p>
                Pintu untuk bertemu, berdialog, belajar,
                berkolaborasi, dan bersama-sama menciptakan
                sesuatu yang bermakna.
            </p>

        </div>

    </div>

</div>
        {{-- PARAGRAF PENUTUP --}}
        <div class="max-w-5xl mx-auto mt-20">

            <div class="border-t pt-12">

                        <p class="text-2xl leading-loose font-bold text-center text-gray-700" style="font-family:'Lora', serif;">
                    Tidak setiap langkah akan berakhir menjadi sebuah film.
                    Tidak setiap pertemuan akan melahirkan sebuah karya.
                    Namun setiap kesempatan untuk saling mendengarkan selalu layak untuk dimulai.

                </p>

            </div>

        </div>

    </div>

</section>

<section class="bg-[#fafafa] py-24">

    <div class="max-w-7xl mx-auto px-8">

        <div class="grid grid-cols-12 gap-6">

            <div class="col-span-12 lg:col-span-7">

                <img
                    src="{{ asset('photo/sinemaku-day-1.jpg') }}"
                    class="rounded-xl h-[520px] w-full object-cover">

            </div>

            <div class="col-span-12 lg:col-span-5 space-y-6">

                <img
                    src="{{ asset('photo/sinemaku-day-2.jpg') }}"
                    class="rounded-xl h-[250px] w-full object-cover">

                <img
                    src="{{ asset('photo/sinemaku-day-3.jpg') }}"
                    class="rounded-xl h-[250px] w-full object-cover">

            </div>

        </div>

    </div>

</section>

{{-- QUOTE --}}
<section class="bg-black text-white py-40">

<div class="max-w-5xl mx-auto px-8 text-center">

<h2 id="typingQuote" class="text-4xl lg:text-5xl leading-tight font-light opacity-0 transition-opacity duration-700">

</h2>

<p
class="uppercase tracking-[6px]
mt-10 text-orange-400">

SINEMAKU PICTURES

</p>

</div>

</section>

@include('components.footer')

@endsection
