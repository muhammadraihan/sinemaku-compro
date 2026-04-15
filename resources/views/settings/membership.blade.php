@extends('layouts.page')
@section('title', 'Pengaturan Halaman Membership')
@section('css')
<style>
.settings-section-card { border-left: 4px solid #0088cc; margin-bottom: 1.5rem; }
.settings-section-card .panel-hdr { background: #f8f9fa; }
</style>
@endsection

@section('content')
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-id-card'></i> Pengaturan: <span class='fw-300'>Halaman Membership</span>
        <small>Edit konten yang tampil di halaman /memberships.</small>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        {!! Form::open(['route' => 'settings.membership.update', 'method' => 'POST', 'class' => 'needs-validation', 'novalidate', 'enctype' => 'multipart/form-data']) !!}

        {{-- HERO SECTION --}}
        <div class="panel settings-section-card">
            <div class="panel-hdr">
                <h2><i class="fal fa-image mr-2"></i>Hero Section <span class="fw-300"><i>Bagian atas halaman</i></span></h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row">
                        <div class="form-group col-md-4 mb-3">
                            {{ Form::label('membership_hero_title', 'Hero Title', ['class' => 'form-label']) }}
                            {{ Form::text('membership_hero_title', $settings['membership_hero_title'] ?? 'Ready to become part of our creative family?', ['class' => 'form-control', 'placeholder' => 'Misal: Join Our Community']) }}
                            <small class="text-muted">Judul besar yang muncul pertama kali di hero.</small>
                        </div>
                        <div class="form-group col-md-4 mb-3">
                            {{ Form::label('membership_hero_subtitle', 'Hero Subtitle', ['class' => 'form-label']) }}
                            {{ Form::text('membership_hero_subtitle', $settings['membership_hero_subtitle'] ?? 'Sign up today and get exclusive access to events and behind the scenes content.', ['class' => 'form-control', 'placeholder' => 'Subjudul hero']) }}
                            <small class="text-muted">Teks kecil di bawah judul hero.</small>
                        </div>
                        <div class="form-group col-md-4 mb-3">
                            {{ Form::label('membership_hero_image', 'Hero Image', ['class' => 'form-label']) }}
                            @if(isset($settings['membership_hero_image']) && $settings['membership_hero_image'] != "")
                                <img src="{{ asset($settings['membership_hero_image']) }}" alt="preview" style="height: 50px; display: block; margin-bottom: 5px;">
                            @endif
                            <input type="file" name="membership_hero_image" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SAVE BUTTON --}}
        <div class="panel">
            <div class="panel-content d-flex flex-row align-items-center justify-content-end">
                <a href="{{ url('/memberships') }}" target="_blank" class="btn btn-outline-secondary mr-3">
                    <i class="fal fa-external-link-alt mr-1"></i> Preview Halaman Membership
                </a>
                <button class="btn btn-primary px-5" type="submit">
                    <i class="fal fa-save mr-1"></i> Simpan Semua Perubahan
                </button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection
