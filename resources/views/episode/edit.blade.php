@extends('layouts.page')
@section('title', 'Edit Episode')
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
            <h2>Edit <span class="fw-300"><i>Episode</i></span></h2>
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
                {!! Form::open(['route' => ['episode.update', $episode->uuid], 'method' => 'PUT', 'class' => 'needs-validation', 'novalidate', 'enctype' => 'multipart/form-data']) !!}

                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        {{ Form::label('film_uuid', 'Film / Serial *', ['class' => 'form-label']) }}
                        {{ Form::select('film_uuid', $films, $episode->film_uuid, ['class' => 'form-control select2 '.($errors->has('film_uuid') ? 'is-invalid':''), 'required']) }}
                        @if ($errors->has('film_uuid'))<div class="invalid-feedback">{{ $errors->first('film_uuid') }}</div>@endif
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        {{ Form::label('season_number', 'Season *', ['class' => 'form-label']) }}
                        {{ Form::number('season_number', $episode->season_number, ['class' => 'form-control '.($errors->has('season_number') ? 'is-invalid':''), 'min' => 1, 'required']) }}
                        @if ($errors->has('season_number'))<div class="invalid-feedback">{{ $errors->first('season_number') }}</div>@endif
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        {{ Form::label('episode_number', 'Episode No *', ['class' => 'form-label']) }}
                        {{ Form::number('episode_number', $episode->episode_number, ['class' => 'form-control '.($errors->has('episode_number') ? 'is-invalid':''), 'min' => 1, 'required']) }}
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
                                    {{ Form::text('title', $episode->title, ['placeholder' => 'Judul episode ini', 'class' => 'form-control '.($errors->has('title') ? 'is-invalid':''), 'required']) }}
                                    @if ($errors->has('title'))<div class="invalid-feedback">{{ $errors->first('title') }}</div>@endif
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    {{ Form::label('duration', 'Durasi (cth: 45 mnt)', ['class' => 'form-label']) }}
                                    {{ Form::text('duration', $episode->duration, ['placeholder' => '45 mnt', 'class' => 'form-control']) }}
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('sinopsis', 'Sinopsis (ID)', ['class' => 'form-label']) }}
                                    {{ Form::textarea('sinopsis', $episode->sinopsis, ['placeholder' => 'Deskripsi singkat episode...', 'class' => 'form-control', 'rows' => 4]) }}
                                </div>
                            </div>
                        </div>

                        {{-- Tab EN --}}
                        <div class="tab-pane fade" id="tab-en-episode" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('title_en', 'Judul Episode (EN)', ['class' => 'form-label']) }}
                                    {{ Form::text('title_en', $episode->title_en, ['placeholder' => 'Episode Title in English', 'class' => 'form-control']) }}
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('sinopsis_en', 'Sinopsis (EN)', ['class' => 'form-label']) }}
                                    {{ Form::textarea('sinopsis_en', $episode->sinopsis_en, ['placeholder' => 'Synopsis in English...', 'class' => 'form-control', 'rows' => 4]) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        {{ Form::label('link', 'Link Streaming (Netflix / dll)', ['class' => 'form-label']) }}
                        {{ Form::text('link', $episode->link, ['placeholder' => 'https://...', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        {{ Form::label('link_trailer', 'Link Trailer (YouTube)', ['class' => 'form-label']) }}
                        {{ Form::text('link_trailer', $episode->link_trailer, ['placeholder' => 'https://...', 'class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group col-md-6 mb-3">
                    {{ Form::label('photo', 'Thumbnail Episode (kosongkan jika tidak diganti)', ['class' => 'form-label']) }}
                    @if($episode->photo)
                        <div class="mb-2">
                            <img src="{{ asset('photo/'.$episode->photo) }}" alt="Thumbnail" style="width:200px;height:auto;border-radius:4px;">
                        </div>
                    @endif
                    {{ Form::file('photo', ['class' => 'form-control', 'accept' => 'image/*', 'id' => 'photo']) }}
                    <div class="mt-2">
                        <img id="preview-image-before-upload" src="" alt="" style="width:200px;height:auto;border-radius:4px;display:none;">
                    </div>
                </div>

                <hr class="my-4">
                <h4>Gallery Management</h4>
                
                <div class="row">
                    <!-- Still Shots -->
                    <div class="col-md-6 mb-4">
                        <label class="form-label font-weight-bold">Still Shots</label>
                        <div class="row mb-3">
                            @foreach($episode->stillShots as $gallery)
                                <div class="col-4 mb-2 position-relative">
                                    <img src="{{ asset('photo/'.$gallery->photo) }}" class="img-thumbnail" style="width:100%; height:80px; object-fit:cover;">
                                    <div class="custom-control custom-checkbox mt-1">
                                        <input type="checkbox" name="delete_gallery[]" value="{{ $gallery->uuid }}" class="custom-control-input" id="del_{{ $gallery->uuid }}">
                                        <label class="custom-control-label text-danger" for="del_{{ $gallery->uuid }}">Hapus</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <input type="file" name="still_shots[]" class="form-control" accept="image/*" multiple>
                        <small class="text-muted">Tambah foto baru (Bisa pilih banyak)</small>
                    </div>

                    <!-- BTS -->
                    <div class="col-md-6 mb-4">
                        <label class="form-label font-weight-bold">Behind The Scenes</label>
                        <div class="row mb-3">
                            @foreach($episode->btsGalleries as $gallery)
                                <div class="col-4 mb-2 position-relative">
                                    <img src="{{ asset('photo/'.$gallery->photo) }}" class="img-thumbnail" style="width:100%; height:80px; object-fit:cover;">
                                    <div class="custom-control custom-checkbox mt-1">
                                        <input type="checkbox" name="delete_gallery[]" value="{{ $gallery->uuid }}" class="custom-control-input" id="del_{{ $gallery->uuid }}">
                                        <label class="custom-control-label text-danger" for="del_{{ $gallery->uuid }}">Hapus</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <input type="file" name="bts_galleries[]" class="form-control" accept="image/*" multiple>
                        <small class="text-muted">Tambah foto baru (Bisa pilih banyak)</small>
                    </div>
                </div>

                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                    <button class="btn btn-primary ml-auto" type="submit">Update Episode</button>
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
        reader.onload = (e) => {
            $('#preview-image-before-upload').attr('src', e.target.result).show();
        }
        reader.readAsDataURL(this.files[0]);
    });
});
</script>
@endsection
