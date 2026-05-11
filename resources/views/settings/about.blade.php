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
             HERO SECTION (SLIDESHOW)
        ══════════════════════════════════════════════════════════ --}}
        <div class="panel settings-section-card">
            <div class="panel-hdr">
                <h2><i class="fal fa-images mr-2"></i>Hero Slideshow <span class="fw-300"><i>Kelola gambar latar belakang hero</i></span></h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div id="hero-slides-list" class="row">
                        @foreach($heroSlides as $index => $slide)
                        <div class="col-md-3 hero-slide-item mb-4" data-index="{{ $index }}">
                            <div class="card shadow-sm border">
                                <div class="position-relative">
                                    <img src="{{ asset($slide->image_path) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                    <button type="button" class="btn btn-danger btn-sm btn-icon position-absolute remove-hero-slide" style="top: 5px; right: 5px;" title="Hapus Gambar">
                                        <i class="fal fa-trash-alt"></i>
                                    </button>
                                </div>
                                <div class="card-body p-2">
                                    <input type="hidden" name="hero_existing_slide_ids[]" value="{{ $slide->id }}">
                                    <input type="hidden" name="hero_existing_slide_paths[]" value="{{ $slide->image_path }}">
                                    <input type="file" name="hero_slides[]" class="form-control form-control-sm" accept="image/*">
                                    <small class="text-muted d-block mt-1">Ganti gambar (opsional)</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        {{-- Template untuk slide baru (selalu tampil minimal 1 jika kosong) --}}
                        @if($heroSlides->isEmpty())
                        <div class="col-md-3 hero-slide-item mb-4" data-index="0">
                            <div class="card shadow-sm border bg-faded">
                                <div class="d-flex align-items-center justify-content-center" style="height: 150px; border-bottom: 1px dashed #ddd;">
                                    <i class="fal fa-image fa-3x text-muted"></i>
                                </div>
                                <div class="card-body p-2">
                                    <input type="hidden" name="hero_existing_slide_ids[]" value="">
                                    <input type="hidden" name="hero_existing_slide_paths[]" value="">
                                    <input type="file" name="hero_slides[]" class="form-control form-control-sm" accept="image/*" required>
                                    <small class="text-muted d-block mt-1">Unggah gambar baru</small>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <div class="mt-2 border-top pt-3">
                        <button type="button" id="add-hero-slide" class="btn btn-outline-success">
                            <i class="fal fa-plus-circle mr-1"></i> Tambah Slide Gambar Baru
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Team Gallery Logic (Existing) - keep it
                const teamList = document.getElementById('team-members-list');
                const addTeamBtn = document.getElementById('add-team-member');
                // ... (existing logic for team is already in the file)

                // Hero Slideshow Logic
                const heroList = document.getElementById('hero-slides-list');
                const addHeroBtn = document.getElementById('add-hero-slide');

                addHeroBtn.addEventListener('click', function() {
                    const index = heroList.querySelectorAll('.hero-slide-item').length;
                    const template = `
                        <div class="col-md-3 hero-slide-item mb-4" data-index="${index}">
                            <div class="card shadow-sm border bg-faded">
                                <div class="d-flex align-items-center justify-content-center" style="height: 150px; border-bottom: 1px dashed #ddd;">
                                    <i class="fal fa-image fa-3x text-muted"></i>
                                </div>
                                <div class="card-body p-2">
                                    <input type="hidden" name="hero_existing_slide_ids[]" value="">
                                    <input type="hidden" name="hero_existing_slide_paths[]" value="">
                                    <input type="file" name="hero_slides[]" class="form-control form-control-sm" accept="image/*" required>
                                    <button type="button" class="btn btn-outline-danger btn-block btn-sm mt-2 remove-hero-slide">
                                        <i class="fal fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    heroList.insertAdjacentHTML('beforeend', template);
                });

                heroList.addEventListener('click', function(e) {
                    if (e.target.closest('.remove-hero-slide')) {
                        const items = heroList.querySelectorAll('.hero-slide-item');
                        if (items.length > 1) {
                            e.target.closest('.hero-slide-item').remove();
                        } else {
                            const row = e.target.closest('.hero-slide-item');
                            row.querySelectorAll('input:not([type="hidden"])').forEach(i => i.value = '');
                            row.querySelector('img')?.remove();
                        }
                    }
                });
            });
        </script>

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
                                <div class="col-md-12 mb-4">
                                    <h5 class="fw-700 text-primary uppercase mb-2"><i class="fal fa-building mr-1"></i> 1. Company Column</h5>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    {{ Form::label('about_studio_label', 'Company Label', ['class' => 'form-label']) }}
                                    {{ Form::text('about_studio_label', $settings['about_studio_label'] ?? '', ['class' => 'form-control', 'placeholder' => 'Misal: Company']) }}
                                </div>
                                <div class="form-group col-md-8 mb-3">
                                    {{ Form::label('about_studio_body', 'Deskripsi Company', ['class' => 'form-label']) }}
                                    {{ Form::textarea('about_studio_body', $settings['about_studio_body'] ?? '', ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Deskripsi company dalam Bahasa Indonesia...']) }}
                                </div>
                                <div class="col-md-12 my-3 border-top pt-3">
                                    <h5 class="fw-700 text-primary uppercase mb-2"><i class="fal fa-users mr-1"></i> 2. Team Column</h5>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    {{ Form::label('about_team_label', 'Team Label', ['class' => 'form-label']) }}
                                    {{ Form::text('about_team_label', $settings['about_team_label'] ?? '', ['class' => 'form-control', 'placeholder' => 'Misal: Team']) }}
                                </div>
                                <div class="form-group col-md-8 mb-3">
                                    {{ Form::label('about_team_body', 'Deskripsi Team', ['class' => 'form-label']) }}
                                    {{ Form::textarea('about_team_body', $settings['about_team_body'] ?? '', ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Deskripsi team dalam Bahasa Indonesia...']) }}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-en-studio" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <h5 class="fw-700 text-info uppercase mb-2"><i class="fal fa-building mr-1"></i> 1. Company Column (EN)</h5>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    {{ Form::label('about_studio_label_en', 'Company Label (English)', ['class' => 'form-label']) }}
                                    {{ Form::text('about_studio_label_en', $settings['about_studio_label_en'] ?? '', ['class' => 'form-control', 'placeholder' => 'E.g.: Company']) }}
                                </div>
                                <div class="form-group col-md-8 mb-3">
                                    {{ Form::label('about_studio_body_en', 'Company Description (English)', ['class' => 'form-label']) }}
                                    {{ Form::textarea('about_studio_body_en', $settings['about_studio_body_en'] ?? '', ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Company description in English...']) }}
                                </div>
                                <div class="col-md-12 my-3 border-top pt-3">
                                    <h5 class="fw-700 text-info uppercase mb-2"><i class="fal fa-users mr-1"></i> 2. Team Column (EN)</h5>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    {{ Form::label('about_team_label_en', 'Team Label (English)', ['class' => 'form-label']) }}
                                    {{ Form::text('about_team_label_en', $settings['about_team_label_en'] ?? '', ['class' => 'form-control', 'placeholder' => 'E.g.: Team']) }}
                                </div>
                                <div class="form-group col-md-8 mb-3">
                                    {{ Form::label('about_team_body_en', 'Team Description (English)', ['class' => 'form-label']) }}
                                    {{ Form::textarea('about_team_body_en', $settings['about_team_body_en'] ?? '', ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Team description in English...']) }}
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
                            <div class="row mb-4 border-bottom pb-3">
                                <div class="col-md-12 mb-2">
                                    <h5 class="fw-700 text-primary uppercase"><i class="fal fa-list mr-1"></i> Section Header (What We Do)</h5>
                                </div>
                                <div class="form-group col-md-4 mb-2">
                                    {{ Form::label('about_wwd_eyebrow', 'Eyebrow Text', ['class' => 'form-label']) }}
                                    {{ Form::text('about_wwd_eyebrow', $settings['about_wwd_eyebrow'] ?? '', ['class' => 'form-control', 'placeholder' => 'Misal: WHAT WE DO']) }}
                                </div>
                                <div class="form-group col-md-8 mb-2">
                                    {{ Form::label('about_wwd_heading', 'Heading Text', ['class' => 'form-label']) }}
                                    {{ Form::text('about_wwd_heading', $settings['about_wwd_heading'] ?? '', ['class' => 'form-control', 'placeholder' => 'Misal: Bukan hanya sekadar...']) }}
                                </div>
                            </div>
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
                            <div class="row mb-4 border-bottom pb-3">
                                <div class="col-md-12 mb-2">
                                    <h5 class="fw-700 text-info uppercase"><i class="fal fa-list mr-1"></i> Section Header (What We Do) (EN)</h5>
                                </div>
                                <div class="form-group col-md-4 mb-2">
                                    {{ Form::label('about_wwd_eyebrow_en', 'Eyebrow Text (English)', ['class' => 'form-label']) }}
                                    {{ Form::text('about_wwd_eyebrow_en', $settings['about_wwd_eyebrow_en'] ?? '', ['class' => 'form-control', 'placeholder' => 'E.g.: WHAT WE DO']) }}
                                </div>
                                <div class="form-group col-md-8 mb-2">
                                    {{ Form::label('about_wwd_heading_en', 'Heading Text (English)', ['class' => 'form-label']) }}
                                    {{ Form::text('about_wwd_heading_en', $settings['about_wwd_heading_en'] ?? '', ['class' => 'form-control', 'placeholder' => 'E.g.: More than just...']) }}
                                </div>
                            </div>
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
             COLLABORATION SECTION
        ══════════════════════════════════════════════════════════ --}}
        <div class="panel settings-section-card">
            <div class="panel-hdr">
                <h2><i class="fal fa-handshake mr-2"></i>Collaboration Section <span class="fw-300"><i>Bagian ajakan kerja sama</i></span></h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <ul class="nav lang-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-id-collab" role="tab">
                                <span class="lang-tab-badge badge-id">ID</span>🇮🇩 Bahasa Indonesia
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-en-collab" role="tab">
                                <span class="lang-tab-badge badge-en">EN</span>🇺🇸 English
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-id-collab" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    {{ Form::label('about_collab_eyebrow', 'Eyebrow Text', ['class' => 'form-label']) }}
                                    {{ Form::text('about_collab_eyebrow', $settings['about_collab_eyebrow'] ?? '', ['class' => 'form-control', 'placeholder' => 'Misal: Kolaborasi']) }}
                                </div>
                                <div class="form-group col-md-8 mb-3">
                                    {{ Form::label('about_collab_heading', 'Heading Text', ['class' => 'form-label']) }}
                                    {{ Form::text('about_collab_heading', $settings['about_collab_heading'] ?? '', ['class' => 'form-control', 'placeholder' => 'Misal: Ada proyek hebat...']) }}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-en-collab" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    {{ Form::label('about_collab_eyebrow_en', 'Eyebrow Text (English)', ['class' => 'form-label']) }}
                                    {{ Form::text('about_collab_eyebrow_en', $settings['about_collab_eyebrow_en'] ?? '', ['class' => 'form-control', 'placeholder' => 'E.g.: Collaboration']) }}
                                </div>
                                <div class="form-group col-md-8 mb-3">
                                    {{ Form::label('about_collab_heading_en', 'Heading Text (English)', ['class' => 'form-label']) }}
                                    {{ Form::text('about_collab_heading_en', $settings['about_collab_heading_en'] ?? '', ['class' => 'form-control', 'placeholder' => 'E.g.: Have a great project...']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════
             DYNAMIC TEAM GALLERY
        ══════════════════════════════════════════════════════════ --}}
        <div class="panel settings-section-card">
            <div class="panel-hdr">
                <h2><i class="fal fa-users mr-2"></i>Team Gallery <span class="fw-300"><i>Kelola anggota tim secara dinamis</i></span></h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div id="team-members-list">
                        @php
                            $i = 1;
                            $hasData = true;
                            $foundAny = false;
                        @endphp
                        @while($hasData)
                            @php
                                $img = $settings["about_team_image_$i"] ?? null;
                                $name = $settings["about_team_name_$i"] ?? null;
                                $role = $settings["about_team_role_$i"] ?? null;
                                
                                // If first item is empty, we still want to show one empty row
                                if (!$img && !$name && !$role && $i > 1) { 
                                    $hasData = false; 
                                    break; 
                                }
                                $foundAny = true;
                            @endphp
                            <div class="team-member-item border p-3 mb-3 bg-faded" data-index="{{ $i-1 }}">
                                <div class="row align-items-end">
                                    <div class="col-md-3">
                                        <label class="form-label font-weight-bold">Foto</label>
                                        @if($img)
                                            <div class="mb-2">
                                                <img src="{{ asset($img) }}" class="img-thumbnail" style="height: 60px; border-radius: 4px;">
                                            </div>
                                        @endif
                                        <input type="hidden" name="team_existing_images[]" value="{{ $img }}">
                                        <input type="file" name="team_images_{{ $i-1 }}" class="form-control form-control-sm" accept="image/*">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label font-weight-bold">Nama</label>
                                        <input type="text" name="team_names[]" class="form-control" value="{{ $name }}" placeholder="Nama Anggota (opsional)">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label font-weight-bold">Jabatan</label>
                                        <input type="text" name="team_roles[]" class="form-control" value="{{ $role }}" placeholder="Jabatan (opsional)">
                                    </div>
                                    <div class="col-md-1 text-right">
                                        <button type="button" class="btn btn-outline-danger btn-icon remove-team-member" title="Hapus Anggota">
                                            <i class="fal fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @php $i++; @endphp
                        @endwhile

                        @if(!$foundAny)
                            {{-- Row kosong jika belum ada data sama sekali --}}
                            <div class="team-member-item border p-3 mb-3 bg-faded" data-index="0">
                                <div class="row align-items-end">
                                    <div class="col-md-3">
                                        <label class="form-label font-weight-bold">Foto</label>
                                        <input type="hidden" name="team_existing_images[]" value="">
                                        <input type="file" name="team_images_0" class="form-control form-control-sm" accept="image/*">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label font-weight-bold">Nama</label>
                                        <input type="text" name="team_names[]" class="form-control" placeholder="Nama Anggota (opsional)">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label font-weight-bold">Jabatan</label>
                                        <input type="text" name="team_roles[]" class="form-control" placeholder="Jabatan (opsional)">
                                    </div>
                                    <div class="col-md-1 text-right">
                                        <button type="button" class="btn btn-outline-danger btn-icon remove-team-member" title="Hapus Anggota">
                                            <i class="fal fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <div class="mt-3">
                        <button type="button" id="add-team-member" class="btn btn-success">
                            <i class="fal fa-plus-circle mr-1"></i> Tambah Anggota Tim Baru
                        </button>
                    </div>
                    <small class="text-muted mt-3 d-block">Anggota tim akan tampil dengan layout editorial di halaman About. Nama dan Jabatan akan tampil sebagai teks vertikal pada foto.</small>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const list = document.getElementById('team-members-list');
                const addBtn = document.getElementById('add-team-member');

                addBtn.addEventListener('click', function() {
                    const index = list.querySelectorAll('.team-member-item').length;
                    const template = `
                        <div class="team-member-item border p-3 mb-3 bg-faded" data-index="${index}">
                            <div class="row align-items-end">
                                <div class="col-md-3">
                                    <label class="form-label font-weight-bold">Foto</label>
                                    <input type="hidden" name="team_existing_images[]" value="">
                                    <input type="file" name="team_images_${index}" class="form-control form-control-sm" accept="image/*">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label font-weight-bold">Nama</label>
                                    <input type="text" name="team_names[]" class="form-control" placeholder="Nama Anggota (opsional)">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label font-weight-bold">Jabatan</label>
                                    <input type="text" name="team_roles[]" class="form-control" placeholder="Jabatan (opsional)">
                                </div>
                                <div class="col-md-1 text-right">
                                    <button type="button" class="btn btn-outline-danger btn-icon remove-team-member" title="Hapus Anggota">
                                        <i class="fal fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    list.insertAdjacentHTML('beforeend', template);
                });

                list.addEventListener('click', function(e) {
                    if (e.target.closest('.remove-team-member')) {
                        const items = list.querySelectorAll('.team-member-item');
                        if (items.length > 1) {
                            e.target.closest('.team-member-item').remove();
                            // Re-index file inputs to avoid gaps if needed, but the current controller approach handles it
                        } else {
                            // Jika tinggal 1, cukup kosongkan inputnya saja
                            const row = e.target.closest('.team-member-item');
                            row.querySelectorAll('input:not([type="hidden"])').forEach(i => i.value = '');
                            row.querySelector('img')?.remove();
                        }
                    }
                });
            });
        </script>

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
