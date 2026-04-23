@extends('layouts.page')
@section('title', 'Pengaturan Halaman Membership')
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
                            <a class="nav-link active" data-toggle="tab" href="#tab-id-mhero" role="tab">
                                <span class="lang-tab-badge badge-id">ID</span>🇮🇩 Bahasa Indonesia
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-en-mhero" role="tab">
                                <span class="lang-tab-badge badge-en">EN</span>🇺🇸 English
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        {{-- Tab ID --}}
                        <div class="tab-pane fade show active" id="tab-id-mhero" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('membership_hero_title', 'Hero Title', ['class' => 'form-label']) }}
                                    {{ Form::text('membership_hero_title', $settings['membership_hero_title'] ?? 'Siap menjadi bagian dari keluarga kreatif kami?', ['class' => 'form-control', 'placeholder' => 'Misal: Bergabunglah Sekarang']) }}
                                    <small class="text-muted">Judul besar yang muncul pertama kali di hero.</small>
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('membership_hero_subtitle', 'Hero Subtitle', ['class' => 'form-label']) }}
                                    {{ Form::text('membership_hero_subtitle', $settings['membership_hero_subtitle'] ?? 'Daftar hari ini dan dapatkan akses eksklusif ke acara dan konten di balik layar.', ['class' => 'form-control', 'placeholder' => 'Subjudul hero dalam Bahasa Indonesia']) }}
                                    <small class="text-muted">Teks kecil di bawah judul hero.</small>
                                </div>
                            </div>
                        </div>
                        {{-- Tab EN --}}
                        <div class="tab-pane fade" id="tab-en-mhero" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('membership_hero_title_en', 'Hero Title (English)', ['class' => 'form-label']) }}
                                    {{ Form::text('membership_hero_title_en', $settings['membership_hero_title_en'] ?? 'Ready to become part of our creative family?', ['class' => 'form-control', 'placeholder' => 'E.g.: Join Our Community']) }}
                                    <small class="text-muted">Large title displayed first in the hero.</small>
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('membership_hero_subtitle_en', 'Hero Subtitle (English)', ['class' => 'form-label']) }}
                                    {{ Form::text('membership_hero_subtitle_en', $settings['membership_hero_subtitle_en'] ?? 'Sign up today and get exclusive access to events and behind the scenes content.', ['class' => 'form-control', 'placeholder' => 'Hero subtitle in English']) }}
                                    <small class="text-muted">Small text below the hero title.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Hero Image (tidak perlu tab) --}}
                    <div class="border-top pt-3 mt-2">
                        <div class="form-group mb-0">
                            {{ Form::label('membership_hero_image', 'Hero Image', ['class' => 'form-label']) }}
                            @if(isset($settings['membership_hero_image']) && $settings['membership_hero_image'] != "")
                                <div class="mb-2">
                                    <img src="{{ asset($settings['membership_hero_image']) }}" alt="preview" style="height: 60px; border-radius: 4px; display: block;">
                                </div>
                            @endif
                            <input type="file" name="membership_hero_image" class="form-control" accept="image/*">
                            <small class="text-muted">Gambar latar belakang hero. Tidak perlu diterjemahkan.</small>
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
