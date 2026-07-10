@extends('layouts.app')

@section('title','Sinemaku Day | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

<section class="relative h-screen overflow-hidden">

    {{-- Background --}}
    <img
        src="{{ asset('../img/sinemakuday/_ARM1148.JPG') }}"
        class="absolute inset-0 w-full h-full object-cover"
    >

    <div class="absolute inset-0 bg-black/45"></div>

    <div class="relative z-10 h-full flex items-end">

        <div class="max-w-9xl mx-auto w-full px-8 lg:px-20 pb-24">

            <h1
             data-aos="fade-up"
            data-aos-delay="300"
                class="font-peckham text-[6.5vw] sm:text-[3vw] md:text-[3vw] text-4xl text-white  uppercase block mb-3 tracking-tighter">


                SINEMAKU DAY
            </h1>

            <span
             data-aos="fade-up"
            data-aos-delay="100"
            class="font-sans font-bold uppercase tracking-[5px] text-white  text-sm">
            Sinemaku Pictures
            </span>

        <!-- Button -->
    <div class="mt-8">
    <a href="#event-section"
        class="inline-flex items-center bg-navy hover:bg-white text-white hover:text-[#F36B21] px-8 py-3 rounded-full uppercase font-bold tracking-wider transition-all duration-300 shadow-lg cursor-none hover-target">
        Explore Event
    </a>
</div>


        </div>

    </div>

</section>

{{-- SECTION ABOUT --}}
<section id="event-section" class="bg-white py-28">

    <div class="max-w-7xl mx-auto px-8">

        {{-- Heading --}}
        <div class="text-center mb-10">

         <h1
    class="font-peckham text-[6.5vw] sm:text-[3vw] md:text-[3vw] text-4xl text-brand-navy uppercase block mb-3 tracking-tighter">
    LOREM IPSUM 2025
</h1>

        </div>

{{-- CONTENT --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 mt-0">

    {{-- KIRI --}}
    <div>

        <div class="space-y-3 text-[21px] leading-9 text-gray-700 text-justify"
             style="font-sans;">

            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita explicabo natus dolorem mollitia excepturi similique enim cumque praesentium dolor quasi amet, numquam nesciunt tenetur incidunt quod, quo hic ab provident. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita explicabo natus dolorem mollitia excepturi similique enim cumque praesentium dolor quasi amet, numquam nesciunt tenetur incidunt quod, quo hic ab provident. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita explicabo natus dolorem mollitia excepturi similique enim cumque praesentium dolor quasi amet, numquam nesciunt tenetur incidunt quod, quo hic ab provident.
            </p>

        </div>

    </div>

    {{-- KANAN --}}
    <div>

        <div class="space-y-3 text-[21px] leading-9 text-gray-700 text-justify"
             style="font-sans;">

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam molestias fugiat, illum, aliquam quas exercitationem perferendis in iusto eligendi eaque voluptates ipsa porro cumque autem, quos dolorem dolores reiciendis! Soluta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita explicabo natus dolorem mollitia excepturi similique enim cumque praesentium dolor quasi amet, numquam nesciunt tenetur incidunt quod, quo hic ab provident. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita explicabo natus dolorem mollitia excepturi similique enim cumque praesentium dolor quasi amet, numquam nesciunt tenetur incidunt quod, quo hic ab provident.
            </p>
        </div>

    </div>

</div>

        </div>

    </div>

</section>


<section class="bg-[#fafafa] py-24">

    <div class="max-w-7xl mx-auto px-8">

        <div class="grid grid-cols-12 gap-6">

            <div class="col-span-12 lg:col-span-7">

                <img src="{{ asset('../img/sinemakuday/SINEMAKU25.jpg') }}"
                    class="rounded-xl h-[520px] w-full object-cover">

            </div>

            <div class="col-span-12 lg:col-span-5 space-y-6">


                <img

                    src="{{ asset('/img/sinemakuday/SINEM25.jpg') }}"
                    class="rounded-xl h-[250px] w-full object-cover">
                    <img
                    src="{{ asset('../img/sinemakuday/SINEMAKU 202.jpg') }}"
                    class="rounded-xl h-[250px] w-full object-cover">
                    <div class="col-span-12 lg:col-span-7">

        </div>

    </div>

</section>

{{-- SECTION ABOUT --}}
<section id="event-list" class="bg-white py-28">

    <div class="max-w-7xl mx-auto px-8">

        {{-- Heading --}}
        <div class="text-center mb-10">

         <h1
    class="font-peckham text-[6.5vw] sm:text-[3vw] md:text-[3vw] text-4xl text-brand-navy uppercase block mb-3 tracking-tighter">
    LOREM IPSUM 2024
</h1>

        </div>

{{-- CONTENT --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 mt-0">

    {{-- KIRI --}}
    <div>

        <div class="space-y-3 text-[21px] leading-9 text-gray-700 text-justify"
             style="font-sans;">

            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita explicabo natus dolorem mollitia excepturi similique enim cumque praesentium dolor quasi amet, numquam nesciunt tenetur incidunt quod, quo hic ab provident.
            </p>

        </div>

    </div>

    {{-- KANAN --}}
    <div>

        <div class="space-y-3 text-[21px] leading-9 text-gray-700 text-justify"
             style="font-sans;">

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam molestias fugiat, illum, aliquam quas exercitationem perferendis in iusto eligendi eaque voluptates ipsa porro cumque autem, quos dolorem dolores reiciendis! Soluta.
            </p>
        </div>

    </div>

</div>

        </div>

    </div>

</section>


<section class="bg-[#fafafa] py-24">

    <div class="max-w-7xl mx-auto px-8">

        <div class="grid grid-cols-12 gap-6">

            <div class="col-span-12 lg:col-span-7">

                <img src="{{ asset('../img/sinemakuday/SINEMA24.JPG') }}"
                    class="rounded-xl h-[520px] w-full object-cover">

            </div>

            <div class="col-span-12 lg:col-span-5 space-y-6">

                <img

                    src="{{ asset('../img/sinemakuday/SINEMAKU DAY 24.JPG') }}"
                    class="rounded-xl h-[250px] w-full object-cover">
                    <img
                    src="{{ asset('../img/sinemakuday/SINEMAKU DAY 2024.JPG') }}"
                    class="rounded-xl h-[250px] w-full object-cover">

            </div>

        </div>

    </div>

</section>


@include('components.footer')

@endsection
