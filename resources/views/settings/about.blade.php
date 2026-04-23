@extends('layouts.page')
@section('title', 'Pengaturan Halaman About')
@section('css')
<style>
.settings-section-card { border-left: 4px solid #0088cc; margin-bottom: 1.5rem; }
.settings-section-card .panel-hdr { background: #f8f9fa; }

/* ── Lang Tab Styling ── */
.lang-tabs { border-bottom: 2px solid #e9ecef; margin-bottom: 1.5rem; }
.lang-tabs .nav-link {
    font-size: 0.8rem; font-weight: 700; letter-spacing: 0.05em;
    text-transform: uppercase; color: #6c757d;
    padding: 0.6rem 1.25rem; border: none; border-bottom: 3px solid transparent;
    margin-bottom: -2px; border-radius: 0; background: none;
}
.lang-tabs .nav-link:hover { color: #343a40; background: #f8f9fa; }
.lang-tabs .nav-link.active { color: #343a40; background: none; }
.lang-tabs .nav-link[href*="tab-id"].active { border-bottom-color: #e5b030; color: #b8860b; }
.lang-tabs .nav-link[href*="tab-en"].active { border-bottom-color: #0088cc; color: #0056b3; }
.lang-tab-badge {
    display: inline-block; font-size: 0.7rem; padding: 1px 7px;
    border-radius: 3px; margin-right: 6px; font-weight: 800;
}
.badge-id { background: #fff3cd; color: #856404; }
.badge-en { background: #cce5ff; color: #004085; }
.tab-pane { animation: fadeInTab 0.2s ease; }
@keyframes fadeInTab { from { opacity: 0; transform: translateY(4px); } to { opacity: 1; transform: none; } }
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

        {{-- ══════════════════════════════════════════════════════════
             HERO SECTION
        ══════════════════════════════════════════════════════════ --}}
        <div class="panel settings-section-card">
            <div class="panel-hdr">
                <h2><i class="fal fa-image mr-2"></i>Hero Section <span class="fw-300"><i>Bagian atas halaman</i></span></h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    {{-- Lang Tabs --}}
                    <ul class="nav lang-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-id-hero" role="tab">
                                <span class="lang-tab-badge badge-id">ID</span>🇮🇩 Bahasa Indonesia
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-en-hero" role="tab">
                                <span class="lang-tab-badge badge-en">EN</span>🇺🇸 English
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        {{-- Tab ID --}}
                        <div class="tab-pane fade show active" id="tab-id-hero" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('about_hero_title', 'Hero Title', ['class' => 'form-label']) }}
                                    {{ Form::text('about_hero_title', $settings['about_hero_title'] ?? '', ['class' => 'form-control', 'placeholder' => 'Judul utama hero']) }}
                                    <small class="text-muted">Judul besar yang muncul pertama kali di hero.</small>
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('about_hero_subtitle', 'Hero Subtitle', ['class' => 'form-label']) }}
                                    {{ Form::text('about_hero_subtitle', $settings['about_hero_subtitle'] ?? '', ['class' => 'form-control', 'placeholder' => 'Subjudul hero']) }}
                                    <small class="text-muted">Teks kecil di bawah judul hero.</small>
                                </div>
                            </div>
                        </div>
                        {{-- Tab EN --}}
                        <div class="tab-pane fade" id="tab-en-hero" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('about_hero_title_en', 'Hero Title (English)', ['class' => 'form-label']) }}
                                    {{ Form::text('about_hero_title_en', $settings['about_hero_title_en'] ?? '', ['class' => 'form-control', 'placeholder' => 'Main hero title']) }}
                                    <small class="text-muted">Large title displayed in the hero section.</small>
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('about_hero_subtitle_en', 'Hero Subtitle (English)', ['class' => 'form-label']) }}
                                    {{ Form::text('about_hero_subtitle_en', $settings['about_hero_subtitle_en'] ?? '', ['class' => 'form-control', 'placeholder' => 'Hero subtitle']) }}
                                    <small class="text-muted">Small text displayed below the hero title.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Hero Image (tidak perlu tab) --}}
                    <div class="border-top pt-3 mt-2">
                        <div class="form-group mb-0">
                            {{ Form::label('about_hero_image', 'Hero Image', ['class' => 'form-label']) }}
                            @if(isset($settings['about_hero_image']) && $settings['about_hero_image'] != "")
                                <div class="mb-2">
                                    <img src="{{ asset($settings['about_hero_image']) }}" alt="preview" style="height: 60px; border-radius: 4px; display: block;">
                                </div>
                            @endif
                            <input type="file" name="about_hero_image" class="form-control" accept="image/*">
                            <small class="text-muted">Gambar latar belakang hero. Tidak perlu diterjemahkan.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════
             IDENTITY SECTION
        ══════════════════════════════════════════════════════════ --}}
        <div class="panel settings-section-card">
            <div class="panel-hdr">
                <h2><i class="fal fa-fingerprint mr-2"></i>Identity Section <span class="fw-300"><i>Identitas perusahaan</i></span></h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <ul class="nav lang-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-id-identity" role="tab">
                                <span class="lang-tab-badge badge-id">ID</span>🇮🇩 Bahasa Indonesia
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-en-identity" role="tab">
                                <span class="lang-tab-badge badge-en">EN</span>🇺🇸 English
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-id-identity" role="tabpanel">
                            <div class="form-group mb-3">
                                {{ Form::label('about_identity_heading', 'Identity Heading', ['class' => 'form-label']) }}
                                {{ Form::text('about_identity_heading', $settings['about_identity_heading'] ?? '', ['class' => 'form-control', 'placeholder' => 'Judul seksi identitas']) }}
                                <small class="text-muted">Teks besar yang muncul di seksi identitas perusahaan.</small>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-en-identity" role="tabpanel">
                            <div class="form-group mb-3">
                                {{ Form::label('about_identity_heading_en', 'Identity Heading (English)', ['class' => 'form-label']) }}
                                {{ Form::text('about_identity_heading_en', $settings['about_identity_heading_en'] ?? '', ['class' => 'form-control', 'placeholder' => 'Identity section heading']) }}
                                <small class="text-muted">Large text shown in the company identity section.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════
             MISSION & VISION
        ══════════════════════════════════════════════════════════ --}}
        <div class="panel settings-section-card">
            <div class="panel-hdr">
                <h2><i class="fal fa-bullseye mr-2"></i>Mission & Vision <span class="fw-300"><i>Misi dan visi</i></span></h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <ul class="nav lang-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-id-mission" role="tab">
                                <span class="lang-tab-badge badge-id">ID</span>🇮🇩 Bahasa Indonesia
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-en-mission" role="tab">
                                <span class="lang-tab-badge badge-en">EN</span>🇺🇸 English
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-id-mission" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('about_mission_statement', 'Pernyataan Misi', ['class' => 'form-label']) }}
                                    {{ Form::textarea('about_mission_statement', $settings['about_mission_statement'] ?? '', ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Pernyataan misi perusahaan...']) }}
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('about_vision_statement', 'Pernyataan Visi', ['class' => 'form-label']) }}
                                    {{ Form::textarea('about_vision_statement', $settings['about_vision_statement'] ?? '', ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Pernyataan visi perusahaan...']) }}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-en-mission" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('about_mission_statement_en', 'Mission Statement (English)', ['class' => 'form-label']) }}
                                    {{ Form::textarea('about_mission_statement_en', $settings['about_mission_statement_en'] ?? '', ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Company mission statement...']) }}
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('about_vision_statement_en', 'Vision Statement (English)', ['class' => 'form-label']) }}
                                    {{ Form::textarea('about_vision_statement_en', $settings['about_vision_statement_en'] ?? '', ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Company vision statement...']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════
             STUDIO SECTION
        ══════════════════════════════════════════════════════════ --}}
        <div class="panel settings-section-card">
            <div class="panel-hdr">
                <h2><i class="fal fa-building mr-2"></i>Studio Section <span class="fw-300"><i>Tentang studio</i></span></h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <ul class="nav lang-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-id-studio" role="tab">
                                <span class="lang-tab-badge badge-id">ID</span>🇮🇩 Bahasa Indonesia
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-en-studio" role="tab">
                                <span class="lang-tab-badge badge-en">EN</span>🇺🇸 English
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-id-studio" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    {{ Form::label('about_studio_label', 'Studio Label', ['class' => 'form-label']) }}
                                    {{ Form::text('about_studio_label', $settings['about_studio_label'] ?? '', ['class' => 'form-control', 'placeholder' => 'Misal: Tentang Studio']) }}
                                    <small class="text-muted">Judul kecil kolom pertama.</small>
                                </div>
                                <div class="form-group col-md-8 mb-3">
                                    {{ Form::label('about_studio_body', 'Deskripsi Studio', ['class' => 'form-label']) }}
                                    {{ Form::textarea('about_studio_body', $settings['about_studio_body'] ?? '', ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Deskripsi studio dalam Bahasa Indonesia...']) }}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-en-studio" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    {{ Form::label('about_studio_label_en', 'Studio Label (English)', ['class' => 'form-label']) }}
                                    {{ Form::text('about_studio_label_en', $settings['about_studio_label_en'] ?? '', ['class' => 'form-control', 'placeholder' => 'E.g.: About the Studio']) }}
                                    <small class="text-muted">Small heading for the first column.</small>
                                </div>
                                <div class="form-group col-md-8 mb-3">
                                    {{ Form::label('about_studio_body_en', 'Studio Description (English)', ['class' => 'form-label']) }}
                                    {{ Form::textarea('about_studio_body_en', $settings['about_studio_body_en'] ?? '', ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Studio description in English...']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════
             VALUES / CORE PRINCIPLES
        ══════════════════════════════════════════════════════════ --}}
        <div class="panel settings-section-card">
            <div class="panel-hdr">
                <h2><i class="fal fa-star mr-2"></i>Values / Core Principles <span class="fw-300"><i>Nilai perusahaan (3 item)</i></span></h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <ul class="nav lang-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-id-values" role="tab">
                                <span class="lang-tab-badge badge-id">ID</span>🇮🇩 Bahasa Indonesia
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-en-values" role="tab">
                                <span class="lang-tab-badge badge-en">EN</span>🇺🇸 English
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        {{-- Tab ID Values --}}
                        <div class="tab-pane fade show active" id="tab-id-values" role="tabpanel">
                            @foreach([1,2,3] as $i)
                            <div class="row mb-3 pb-3 {{ $i < 3 ? 'border-bottom' : '' }}">
                                <div class="col-md-12 mb-2">
                                    <span class="badge badge-secondary">Nilai #{{ $i }}</span>
                                </div>
                                <div class="form-group col-md-4 mb-2">
                                    {{ Form::label("about_values_{$i}_title", "Judul Value #{$i}", ['class' => 'form-label']) }}
                                    {{ Form::text("about_values_{$i}_title", $settings["about_values_{$i}_title"] ?? '', ['class' => 'form-control', 'placeholder' => 'Misal: Keberanian']) }}
                                </div>
                                <div class="form-group col-md-8 mb-2">
                                    {{ Form::label("about_values_{$i}_body", "Deskripsi Value #{$i}", ['class' => 'form-label']) }}
                                    {{ Form::text("about_values_{$i}_body", $settings["about_values_{$i}_body"] ?? '', ['class' => 'form-control', 'placeholder' => 'Deskripsi singkat dalam Bahasa Indonesia...']) }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{-- Tab EN Values --}}
                        <div class="tab-pane fade" id="tab-en-values" role="tabpanel">
                            @foreach([1,2,3] as $i)
                            <div class="row mb-3 pb-3 {{ $i < 3 ? 'border-bottom' : '' }}">
                                <div class="col-md-12 mb-2">
                                    <span class="badge badge-info">Value #{{ $i }}</span>
                                </div>
                                <div class="form-group col-md-4 mb-2">
                                    {{ Form::label("about_values_{$i}_title_en", "Value #{$i} Title (English)", ['class' => 'form-label']) }}
                                    {{ Form::text("about_values_{$i}_title_en", $settings["about_values_{$i}_title_en"] ?? '', ['class' => 'form-control', 'placeholder' => 'E.g.: Authenticity']) }}
                                </div>
                                <div class="form-group col-md-8 mb-2">
                                    {{ Form::label("about_values_{$i}_body_en", "Value #{$i} Description (English)", ['class' => 'form-label']) }}
                                    {{ Form::text("about_values_{$i}_body_en", $settings["about_values_{$i}_body_en"] ?? '', ['class' => 'form-control', 'placeholder' => 'Short description in English...']) }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════
             TEAMS PHOTO (no translation needed)
        ══════════════════════════════════════════════════════════ --}}
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
                            <div class="mb-2">
                                <img src="{{ asset($settings['about_secondary_image']) }}" alt="preview" style="height: 100px; border-radius: 4px; display: block;">
                            </div>
                        @endif
                        <input type="file" name="about_secondary_image" class="form-control" accept="image/*">
                        <small class="text-muted">Foto tim paralaks yang tampil edge-to-edge. Tidak perlu diterjemahkan.</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════
             TEAM GALLERY MOSAIC (no translation needed)
        ══════════════════════════════════════════════════════════ --}}
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
                                <div class="mb-2">
                                    <img src="{{ asset($settings["about_team_image_{$i}"]) }}" alt="preview" style="height: 60px; border-radius: 4px; display: block;">
                                </div>
                            @endif
                            <input type="file" name="about_team_image_{{ $i }}" class="form-control" accept="image/*">
                        </div>
                        @endforeach
                    </div>
                    <small class="text-muted">Gambar-gambar mosaic tim. Tidak perlu diterjemahkan.</small>
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
