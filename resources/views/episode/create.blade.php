@extends('layouts.page')
@section('title', 'Tambah Episode')
@section('css')
<link rel="stylesheet" media="screen, print" href="{{asset('css/formplugins/select2/select2.bundle.css')}}">
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

                <div class="row">
                    <div class="form-group col-md-8 mb-3">
                        {{ Form::label('title', 'Judul Episode *', ['class' => 'form-label']) }}
                        {{ Form::text('title', null, ['placeholder' => 'Judul episode ini', 'class' => 'form-control '.($errors->has('title') ? 'is-invalid':''), 'required']) }}
                        @if ($errors->has('title'))<div class="invalid-feedback">{{ $errors->first('title') }}</div>@endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('duration', 'Durasi (cth: 45 mnt)', ['class' => 'form-label']) }}
                        {{ Form::text('duration', null, ['placeholder' => '45 mnt', 'class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group col-md-12 mb-3">
                    {{ Form::label('sinopsis', 'Sinopsis / Deskripsi', ['class' => 'form-label']) }}
                    {{ Form::textarea('sinopsis', null, ['placeholder' => 'Deskripsi singkat episode...', 'class' => 'form-control', 'rows' => 4]) }}
                </div>

                <div class="form-group col-md-12 mb-3">
                    {{ Form::label('link', 'Link Streaming (YouTube / dll)', ['class' => 'form-label']) }}
                    {{ Form::text('link', null, ['placeholder' => 'https://...', 'class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-6 mb-3">
                    {{ Form::label('photo', 'Thumbnail Episode', ['class' => 'form-label']) }}
                    {{ Form::file('photo', ['class' => 'form-control', 'accept' => 'image/*', 'id' => 'photo']) }}
                    <div class="mt-2">
                        <img id="preview-image-before-upload" src="{{asset('img/placeholder.png')}}" alt="Preview" style="width:200px;height:auto;border-radius:4px;">
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
