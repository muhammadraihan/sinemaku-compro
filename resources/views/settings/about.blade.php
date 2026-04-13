@extends('layouts.page')
@section('title', 'Pengaturan Halaman About')
@section('css')
<style>
.settings-section-card { border-left: 4px solid #0088cc; margin-bottom: 1.5rem; }
.settings-section-card .panel-hdr { background: #f8f9fa; }
.char-count { font-size: 0.75rem; color: #6c757d; float: right; }
</style>
@endsection

@section('content')
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-info-circle'></i> Pengaturan: <span class='fw-300'>Halaman About</span>
        <small>Edit konten yang tampil di halaman /about.</small>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        {!! Form::open(['route' => 'settings.about.update', 'method' => 'POST', 'class' => 'needs-validation', 'novalidate', 'enctype' => 'multipart/form-data']) !!}

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
                            {{ Form::label('about_hero_title', 'Hero Title', ['class' => 'form-label']) }}
                            {{ Form::text('about_hero_title', $settings['about_hero_title'] ?? '', ['class' => 'form-control', 'placeholder' => 'Judul utama hero']) }}
                            <small class="text-muted">Judul besar yang muncul pertama kali di hero.</small>
                        </div>
                        <div class="form-group col-md-4 mb-3">
                            {{ Form::label('about_hero_subtitle', 'Hero Subtitle', ['class' => 'form-label']) }}
                            {{ Form::text('about_hero_subtitle', $settings['about_hero_subtitle'] ?? '', ['class' => 'form-control', 'placeholder' => 'Subjudul hero']) }}
                            <small class="text-muted">Teks kecil di bawah judul hero.</small>
                        </div>
                        <div class="form-group col-md-4 mb-3">
                            {{ Form::label('about_hero_image', 'Hero Image', ['class' => 'form-label']) }}
                            @if(isset($settings['about_hero_image']) && $settings['about_hero_image'] != "")
                                <img src="{{ asset($settings['about_hero_image']) }}" alt="preview" style="height: 50px; display: block; margin-bottom: 5px;">
                            @endif
                            <input type="file" name="about_hero_image" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- IDENTITY SECTION --}}
        <div class="panel settings-section-card">
            <div class="panel-hdr">
                <h2><i class="fal fa-fingerprint mr-2"></i>Identity Section <span class="fw-300"><i>Identitas perusahaan</i></span></h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row">
                        <div class="form-group col-md-12 mb-3">
                            {{ Form::label('about_identity_heading', 'Identity Heading', ['class' => 'form-label']) }}
                            {{ Form::text('about_identity_heading', $settings['about_identity_heading'] ?? '', ['class' => 'form-control', 'placeholder' => 'Judul seksi identitas']) }}
                            <small class="text-muted">Ini adalah satu-satunya teks untuk seksi Identity.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MISSION & VISION --}}
        <div class="panel settings-section-card">
            <div class="panel-hdr">
                <h2><i class="fal fa-bullseye mr-2"></i>Mission & Vision <span class="fw-300"><i>Misi dan visi</i></span></h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row">
                        <div class="form-group col-md-6 mb-3">
                            {{ Form::label('about_mission_statement', 'Mission Statement', ['class' => 'form-label']) }}
                            {{ Form::textarea('about_mission_statement', $settings['about_mission_statement'] ?? '', ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Pernyataan misi...']) }}
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            {{ Form::label('about_vision_statement', 'Vision Statement', ['class' => 'form-label']) }}
                            {{ Form::textarea('about_vision_statement', $settings['about_vision_statement'] ?? '', ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Pernyataan visi...']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STUDIO SECTION --}}
        <div class="panel settings-section-card">
            <div class="panel-hdr">
                <h2><i class="fal fa-building mr-2"></i>Studio Section <span class="fw-300"><i>Tentang studio</i></span></h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row">
                        <div class="form-group col-md-4 mb-3">
                            {{ Form::label('about_studio_label', 'Studio Label', ['class' => 'form-label']) }}
                            {{ Form::text('about_studio_label', $settings['about_studio_label'] ?? '', ['class' => 'form-control', 'placeholder' => 'Misal: The Studio']) }}
                        </div>
                        <div class="form-group col-md-8 mb-3">
                            {{ Form::label('about_studio_body', 'Studio Description', ['class' => 'form-label']) }}
                            {{ Form::textarea('about_studio_body', $settings['about_studio_body'] ?? '', ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Deskripsi studio...']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- VALUES SECTION --}}
        <div class="panel settings-section-card">
            <div class="panel-hdr">
                <h2><i class="fal fa-star mr-2"></i>Values / Core Principles <span class="fw-300"><i>Nilai perusahaan (3 item)</i></span></h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    @foreach([1,2,3] as $i)
                    <div class="row mb-2 pb-2 {{ $i < 3 ? 'border-bottom' : '' }}">
                        <div class="form-group col-md-4 mb-2">
                            {{ Form::label("about_values_{$i}_title", "Value #{$i} — Judul", ['class' => 'form-label']) }}
                            {{ Form::text("about_values_{$i}_title", $settings["about_values_{$i}_title"] ?? '', ['class' => 'form-control', 'placeholder' => 'Misal: Authenticity']) }}
                        </div>
                        <div class="form-group col-md-8 mb-2">
                            {{ Form::label("about_values_{$i}_body", "Value #{$i} — Deskripsi", ['class' => 'form-label']) }}
                            {{ Form::text("about_values_{$i}_body", $settings["about_values_{$i}_body"] ?? '', ['class' => 'form-control', 'placeholder' => 'Deskripsi singkat nilai...']) }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- TEAMS IMAGE SECTION --}}
        <div class="panel settings-section-card">
            <div class="panel-hdr">
                <h2><i class="fal fa-camera mr-2"></i>Teams Photo Section <span class="fw-300"><i>Gambar edge-to-edge / paralaks</i></span></h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="form-group mb-3">
                        {{ Form::label('about_secondary_image', 'Secondary Image (Teams Photo)', ['class' => 'form-label']) }}
                        @if(isset($settings['about_secondary_image']) && $settings['about_secondary_image'] != "")
                            <img src="{{ asset($settings['about_secondary_image']) }}" alt="preview" style="height: 100px; display: block; margin-bottom: 5px;">
                        @endif
                        <input type="file" name="about_secondary_image" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>
        </div>

        {{-- TEAM GALLERY MOSAIC --}}
        <div class="panel settings-section-card">
            <div class="panel-hdr">
                <h2><i class="fal fa-images mr-2"></i>Team Gallery Mosaic <span class="fw-300"><i>6 Gambar Kolase</i></span></h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row">
                        @foreach([1, 2, 3, 4, 5, 6] as $i)
                        <div class="form-group col-md-4 mb-4">
                            {{ Form::label("about_team_image_{$i}", "Gallery Image {$i}", ['class' => 'form-label']) }}
                            @if(isset($settings["about_team_image_{$i}"]) && $settings["about_team_image_{$i}"] != "")
                                <img src="{{ asset($settings["about_team_image_{$i}"]) }}" alt="preview" style="height: 60px; display: block; margin-bottom: 5px;">
                            @endif
                            <input type="file" name="about_team_image_{$i}" class="form-control" accept="image/*">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- SAVE BUTTON --}}
        <div class="panel">
            <div class="panel-content d-flex flex-row align-items-center justify-content-end">
                <a href="{{ url('/about') }}" target="_blank" class="btn btn-outline-secondary mr-3">
                    <i class="fal fa-external-link-alt mr-1"></i> Preview Halaman About
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
