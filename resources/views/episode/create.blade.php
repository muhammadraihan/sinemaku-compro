@extends('layouts.page')
@section('title', 'Tambah Episode')
@section('css')
<link rel="stylesheet" media="screen, print" href="{{asset('css/formplugins/select2/select2.bundle.css')}}">
<style>
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
<div class="col-xxl">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>Tambah <span class="fw-300"><i>Episode</i></span></h2>
            <div class="panel-toolbar">
                <a class="nav-link active" href="{{route('episode.index')}}"><i class="fal fa-arrow-alt-left"></i>
                    <span class="nav-link-text">Kembali</span>
                </a>
                <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <div class="panel-tag">Field dengan <code>*</code> tidak boleh kosong.</div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                @endif
                {!! Form::open(['route' => 'episode.store', 'method' => 'POST', 'class' => 'needs-validation', 'novalidate', 'enctype' => 'multipart/form-data']) !!}

                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        {{ Form::label('film_uuid', 'Film / Serial *', ['class' => 'form-label']) }}
                        {{ Form::select('film_uuid', $films, null, ['class' => 'form-control select2 '.($errors->has('film_uuid') ? 'is-invalid':''), 'required', 'placeholder' => '-- Pilih Film --']) }}
                        @if ($errors->has('film_uuid'))<div class="invalid-feedback">{{ $errors->first('film_uuid') }}</div>@endif
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        {{ Form::label('season_number', 'Season *', ['class' => 'form-label']) }}
                        {{ Form::number('season_number', 1, ['class' => 'form-control '.($errors->has('season_number') ? 'is-invalid':''), 'min' => 1, 'required']) }}
                        @if ($errors->has('season_number'))<div class="invalid-feedback">{{ $errors->first('season_number') }}</div>@endif
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        {{ Form::label('episode_number', 'Episode No *', ['class' => 'form-label']) }}
                        {{ Form::number('episode_number', 1, ['class' => 'form-control '.($errors->has('episode_number') ? 'is-invalid':''), 'min' => 1, 'required']) }}
                        @if ($errors->has('episode_number'))<div class="invalid-feedback">{{ $errors->first('episode_number') }}</div>@endif
                    </div>
                </div>

                <div class="panel-tag bg-white border-faded mb-4">
                    <ul class="nav lang-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-id-episode" role="tab">
                                <span class="lang-tab-badge badge-id">ID</span>🇮🇩 Bahasa Indonesia
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-en-episode" role="tab">
                                <span class="lang-tab-badge badge-en">EN</span>🇺🇸 English
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        {{-- Tab ID --}}
                        <div class="tab-pane fade show active" id="tab-id-episode" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-8 mb-3">
                                    {{ Form::label('title', 'Judul Episode (ID) *', ['class' => 'form-label']) }}
                                    {{ Form::text('title', null, ['placeholder' => 'Judul episode ini', 'class' => 'form-control '.($errors->has('title') ? 'is-invalid':''), 'required']) }}
                                    @if ($errors->has('title'))<div class="invalid-feedback">{{ $errors->first('title') }}</div>@endif
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    {{ Form::label('duration', 'Durasi (cth: 45 mnt)', ['class' => 'form-label']) }}
                                    {{ Form::text('duration', null, ['placeholder' => '45 mnt', 'class' => 'form-control']) }}
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('sinopsis', 'Sinopsis (ID)', ['class' => 'form-label']) }}
                                    {{ Form::textarea('sinopsis', null, ['placeholder' => 'Deskripsi singkat episode...', 'class' => 'form-control', 'rows' => 4]) }}
                                </div>
                            </div>
                        </div>

                        {{-- Tab EN --}}
                        <div class="tab-pane fade" id="tab-en-episode" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('title_en', 'Judul Episode (EN)', ['class' => 'form-label']) }}
                                    {{ Form::text('title_en', null, ['placeholder' => 'Episode Title in English', 'class' => 'form-control']) }}
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('sinopsis_en', 'Sinopsis (EN)', ['class' => 'form-label']) }}
                                    {{ Form::textarea('sinopsis_en', null, ['placeholder' => 'Synopsis in English...', 'class' => 'form-control', 'rows' => 4]) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        {{ Form::label('link', 'Link Streaming (Netflix / dll)', ['class' => 'form-label']) }}
                        {{ Form::text('link', null, ['placeholder' => 'https://...', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        {{ Form::label('link_trailer', 'Link Trailer (YouTube)', ['class' => 'form-label']) }}
                        {{ Form::text('link_trailer', null, ['placeholder' => 'https://...', 'class' => 'form-control']) }}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        {{ Form::label('photo', 'Thumbnail Episode', ['class' => 'form-label']) }}
                        {{ Form::file('photo', ['class' => 'form-control', 'accept' => 'image/*', 'id' => 'photo']) }}
                        <div class="mt-2">
                            <img id="preview-image-before-upload" src="{{asset('img/placeholder.png')}}" alt="Preview" style="width:200px;height:auto;border-radius:4px;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label class="form-label">Still Shots (Bisa pilih banyak)</label>
                        <input type="file" name="still_shots[]" class="form-control" accept="image/*" multiple>
                        <small class="text-muted">Gunakan CTRL/Shift untuk memilih banyak foto</small>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="form-label">Behind The Scenes (Bisa pilih banyak)</label>
                        <input type="file" name="bts_galleries[]" class="form-control" accept="image/*" multiple>
                        <small class="text-muted">Gunakan CTRL/Shift untuk memilih banyak foto</small>
                    </div>
                </div>

                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                    <button class="btn btn-primary ml-auto" type="submit">Simpan Episode</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/formplugins/select2/select2.bundle.js')}}"></script>
<script>
$(document).ready(function(){
    $('.select2').select2();
    $('#photo').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => { $('#preview-image-before-upload').attr('src', e.target.result); }
        reader.readAsDataURL(this.files[0]);
    });
});
</script>
@endsection
