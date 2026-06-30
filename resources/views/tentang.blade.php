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

            <span
            class="font-serif font-bold uppercase tracking-[5px] text-orange-400 text-sm">
            Tentang Sinemaku Picture
            </span>

            <h1
                class="mt-4
                text-white
                text-5xl lg:text-4xl
                font-black uppercase leading-none">

                Di balik setiap karya,
                <br>
                selalu ada seseorang
                yang berani memulai.
            </h1>

        </div>

    </div>

</section>

{{-- SECTION 2 --}}
<section class="bg-white py-32">

    <div class="max-w-7xl mx-auto px-8">

        <div class="grid lg:grid-cols-2 gap-20">

            {{-- kiri --}}
            <div>

                <h2
                class="text-5xl font-bold
                leading-tight">

                    Setiap cerita
                    berhak mendapatkan
                    kesempatan.

                </h2>

            </div>

            {{-- kanan --}}
            <div
            class="space-y-8
            text-gray-700
            text-lg
            leading-loose">

                <p>
                    Tidak semua perjalanan dimulai dari tempat yang sama.
                    Ada yang tumbuh di tengah industri kreatif.
                    Ada pula yang harus menempuh perjalanan yang lebih panjang
                    hanya untuk mendapatkan kesempatan pertamanya.
                </p>

                <p>
                    Yang membedakan sering kali bukan bakat,
                    melainkan kesempatan.
                </p>

                <p>
                    Banyak cerita lahir dari pengalaman hidup yang sederhana.
                    Dari percakapan sehari-hari,
                    dari kegagalan,
                    dari harapan,
                    dari kehilangan,
                    atau dari mimpi yang diam-diam terus dijaga.
                </p>

                <p>
                    Namun tidak semua cerita menemukan ruang
                    untuk didengar.
                    Bukan karena cerita itu kurang berarti,
                    melainkan karena belum menemukan
                    pertemuan yang tepat.
                </p>

                <p>
                    Mungkin,
                    setiap perjalanan besar memang selalu berawal
                    dari sebuah pertemuan.
                    Pertemuan antara manusia,
                    gagasan,
                    kepercayaan,
                    dan kesempatan.
                </p>

                <p>
                    Semangat itulah yang ingin terus tumbuh bersama
                    Sinemaku Pictures.
                    Bukan sebagai tempat yang memiliki semua jawaban,
                    melainkan sebagai sebuah pintu yang tetap terbuka.
                </p>

                <p>
                    Pintu untuk bertemu,
                    berdialog,
                    belajar,
                    berkolaborasi,
                    dan bersama-sama menciptakan sesuatu
                    yang bermakna.
                </p>

                <p>
                    Tidak setiap langkah akan berakhir
                    menjadi sebuah film.
                    Tidak setiap pertemuan akan melahirkan sebuah karya.
                    Namun setiap kesempatan untuk saling mendengarkan
                    selalu layak untuk dimulai.
                </p>

                <p>
                    Setiap kesempatan yang diberikan dengan tulus
                    dapat melahirkan sebuah cerita.
                    Dan setiap cerita yang disampaikan dengan jujur
                    memiliki kekuatan untuk mengubah kehidupan.
                </p>

            </div>

        </div>

    </div>

</section>

{{-- GALLERY --}}
<section class="bg-[#fafafa] py-32">

<div class="max-w-7xl mx-auto px-8">

<div class="grid grid-cols-12 gap-6">

<div class="col-span-12 lg:col-span-7">

<img
src="{{ asset('photo/sinemaku-day-1.jpg') }}"
class="rounded-3xl w-full h-[650px] object-cover">

</div>

<div class="col-span-12 lg:col-span-5 space-y-6">

<img
src="{{ asset('photo/sinemaku-day-2.jpg') }}"
class="rounded-3xl w-full h-[310px] object-cover">

<img
src="{{ asset('photo/sinemaku-day-3.jpg') }}"
class="rounded-3xl w-full h-[310px] object-cover">

</div>

</div>

</div>

</section>

{{-- QUOTE --}}
<section class="bg-black text-white py-40">

<div class="max-w-5xl mx-auto px-8 text-center">

<h2
class="text-4xl lg:text-6xl
leading-tight font-light">

"Setiap kesempatan yang diberikan
dengan tulus dapat melahirkan sebuah cerita."

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
