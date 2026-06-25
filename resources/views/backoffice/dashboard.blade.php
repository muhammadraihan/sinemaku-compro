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

        Semua yang kamu butuhkan untuk mengelola konten ada di sini. Mulai dari Film & Series, Episode, Artikel, hingga Casting bisa diakses dengan mudah melalui menu di samping.

        Jangan lupa cek kembali setiap perubahan sebelum dipublikasikan agar konten tetap rapi, konsisten, dan siap dinikmati oleh audience.

        Let's make great stories happen!
    </p>
    <p>
        Sincerely,<br>
        {{env('APP_DEVELOPER')}} Team<br>
    </p>
</div>
@endsection
