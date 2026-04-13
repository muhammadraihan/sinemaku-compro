@extends('layouts.page')
@section('title', 'Edit Kategori Event')
@section('css')
<link rel="stylesheet" media="screen, print" href="{{asset('css/formplugins/select2/select2.bundle.css')}}">
@endsection
@section('content')
<div class="col-xxl">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>Edit <span class="fw-300"><i>Kategori Event</i></span></h2>
            <div class="panel-toolbar">
                <a class="nav-link active" href="{{route('event-kategori.index')}}"><i class="fal fa-arrow-alt-left"></i>
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
                {!! Form::open(['route' => ['event-kategori.update', $kategori->uuid], 'method' => 'PUT', 'class' => 'needs-validation', 'novalidate']) !!}
                <div class="form-group col-md-6 mb-3">
                    {{ Form::label('name', 'Nama Kategori *', ['class' => 'form-label']) }}
                    {{ Form::text('name', $kategori->name, ['placeholder' => 'Nama Kategori Event', 'class' => 'form-control '.($errors->has('name') ? 'is-invalid':''), 'required']) }}
                    @if ($errors->has('name'))<div class="invalid-feedback">{{ $errors->first('name') }}</div>@endif
                </div>
                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                    <button class="btn btn-primary ml-auto" type="submit">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/formplugins/select2/select2.bundle.js')}}"></script>
@endsection
