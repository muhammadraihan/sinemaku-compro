@extends('layouts.page')

@section('title','Dashboard')

@section('content')
<div class="subheader">
    <h1 class="subheader-title">
        <i class='fal fa-info-circle'></i> Introduction
        <small>
            A brief introduction to this {{env('APP_NAME')}}
        </small>
    </h1>
</div>
<div class="fs-lg fw-300 p-5 bg-white border-faded rounded mb-g">
    <h3 class="mb-g">
        Hi {{Auth::user()->name}},
    </h3>
     <p>
        Selamat datang di Dashboard Sinemaku Pictures.
    </p>

    <p>
        Dashboard ini dirancang untuk membantu Anda mengelola seluruh konten platform secara efisien, mulai dari Film & Series, Episode, Artikel, hingga proses Casting.
    </p>

    <p>
        Gunakan menu navigasi yang tersedia untuk mengakses setiap fitur. Pastikan seluruh data dan perubahan telah diperiksa dengan baik sebelum dipublikasikan guna menjaga kualitas dan konsistensi konten.
    </p>

    <p>
        Terima kasih atas kontribusi Anda dalam mengembangkan dan mengelola konten Sinemaku Pictures.
    </p>
    <p>

        Let's make great stories happen!
    </p>
    <p>
        Sincerely,<br>
        {{env('APP_DEVELOPER')}} Team<br>
    </p>
</div>
@endsection
