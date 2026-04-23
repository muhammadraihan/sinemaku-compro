@extends('layouts.page')

@section('title', 'Article Tambah')

@section('css')
<link rel="stylesheet" media="screen, print" href="{{asset('css/formplugins/select2/select2.bundle.css')}}">
<link rel="stylesheet" media="screen, print" href="{{asset('css/formplugins/dropzone/dropzone.css')}}">
<link rel="stylesheet" media="screen, print"
    href="{{asset('css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">
@endsection

@section('content')
<div class="col-xxl">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>Tambah Baru <span class="fw-300"><i>Article </i></span></h2>
            <div class="panel-toolbar">
                <a class="nav-link active" href="{{route('article.index')}}"><i class="fal fa-arrow-alt-left">
                    </i>
                    <span class="nav-link-text">Kembali</span>
                </a>
                <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                    data-offset="0,10" data-original-title="Fullscreen"></button>
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <div class="panel-tag">
                    Field dengan <code>*</code> tidak boleh kosong.
                </div>
                @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
                {!! Form::open(['route' => 'article.store','id'=>'forms','method' => 'POST','class' =>
                'needs-validation','dropzone', 'forms','novalidate','enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('judul','Judul',['class' => 'required form-label'])}}
                        {{ Form::text('judul',null,['placeholder' => 'Judul','class' => 'form-control '.($errors->has('judul') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('judul'))
                        <div class="invalid-feedback">{{ $errors->first('judul') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('judul_en','Judul (EN)',['class' => 'form-label'])}}
                        {{ Form::text('judul_en',null,['placeholder' => 'Judul (EN)','class' => 'form-control '.($errors->has('judul_en') ? 'is-invalid':'')])}}
                        @if ($errors->has('judul_en'))
                        <div class="invalid-feedback">{{ $errors->first('judul_en') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('title','Title',['class' => 'required form-label'])}}
                        {{ Form::text('title',null,['placeholder' => 'Title','class' => 'form-control '.($errors->has('title') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('title'))
                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('title_en','Title (EN)',['class' => 'form-label'])}}
                        {{ Form::text('title_en',null,['placeholder' => 'Title (EN)','class' => 'form-control '.($errors->has('title_en') ? 'is-invalid':'')])}}
                        @if ($errors->has('title_en'))
                        <div class="invalid-feedback">{{ $errors->first('title_en') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('tgl_rilis','Tanggal Rilis',['class' => 'required form-label'])}}
                        {{ Form::text('tgl_rilis',null,['placeholder' => 'Tanggal Rilis','class' => 'form-control tgl_rilis'.($errors->has('tgl_rilis') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('tgl_rilis'))
                        <div class="invalid-feedback">{{ $errors->first('tgl_rilis') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('penulis','Penulis',['class' => 'required form-label'])}}
                        {{ Form::text('penulis',null,['placeholder' => 'Penulis','class' => 'form-control '.($errors->has('penulis') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('penulis'))
                        <div class="invalid-feedback">{{ $errors->first('penulis') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-12 mb-3">
                    {{ Form::label('detail','Detail',['class' => 'required form-label'])}}
                    {{ Form::textarea('detail',null,['placeholder' => 'Detail','class' => 'form-control '.($errors->has('detail') ? 'is-invalid':''),'required'])}}
                    @if ($errors->has('detail'))
                    <div class="invalid-feedback">{{ $errors->first('detail') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-12 mb-3">
                    {{ Form::label('detail_en','Detail (EN)',['class' => 'form-label'])}}
                    {{ Form::textarea('detail_en',null,['placeholder' => 'Detail (EN)','class' => 'form-control '.($errors->has('detail_en') ? 'is-invalid':''), 'id' => 'detail_en'])}}
                    @if ($errors->has('detail_en'))
                    <div class="invalid-feedback">{{ $errors->first('detail_en') }}</div>
                    @endif
                </div>
                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('artikel_kategori_uuid','Kategori',['class' => 'required form-label'])}}
                        {!! Form::select('artikel_kategori_uuid', $artikelKategoris, '',
                        ['id'=>'artikel_kategori_uuid','class'
                        => 'custom-select'.($errors->has('artikel_kategori_uuid') ? 'is-invalid':'') ,'required'
                        => '', 'placeholder' => 'Pilih Kategori ...'])!!}
                        @if ($errors->has('artikel_kategori_uuid'))
                        <div class="invalid-feedback">{{ $errors->first('artikel_kategori_uuid') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('link','Link External',['class' => 'required form-label'])}}
                        {{ Form::text('link',null,['placeholder' => 'Link External','class' => 'form-control '.($errors->has('link') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('link'))
                        <div class="invalid-feedback">{{ $errors->first('link') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-4 mb-3">
                    {{ Form::label('photo','Photo',['class' => 'required form-label'])}}
                    {{ Form::file('photo',null,['placeholder' => 'Photo','class' => 'form-control upload '.($errors->has('photo') ? 'is-invalid':''),'required', 'autocomplete' => 'off', 'id' => 'photo'])}}
                    <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                    alt="preview image" style="max-height: 250px;">
                    @if ($errors->has('photo'))
                    <div class="invalid-feedback">{{ $errors->first('photo') }}</div>
                    @endif
                </div>
            <div
                class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                <button class="btn btn-primary ml-auto" type="submit">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('js/formplugins/select2/select2.bundle.js')}}"></script>
<script src="{{asset('js/formplugins/dropzone/dropzone.js')}}"></script>
<script src="{{asset('js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('js/formplugins/ckeditor/ckeditor.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#artikel_kategori_uuid').select2();
        $('#type').select2();

        CKEDITOR.replace('detail');
        CKEDITOR.replace('detail_en');

        $('#photo').change(function(){
            
            let reader = new FileReader();
         
            reader.onload = (e) => { 
         
              $('#preview-image-before-upload').attr('src', e.target.result); 
            }
         
            reader.readAsDataURL(this.files[0]); 
           
           });

           $('.tgl_rilis').datepicker({
            orientation: "bottom left",
            format:'yyyy-mm-dd', // Notice the Extra space at the beginning
            todayHighlight:'TRUE',
            autoclose: true,
            todayBtn: "linked",
            clearBtn: true,
        });

        $('.tgl_akhir').datepicker({
            orientation: "bottom left",
            format:'yyyy-mm-dd', // Notice the Extra space at the beginning
            todayHighlight:'TRUE',
            autoclose: true,
            todayBtn: "linked",
            clearBtn: true,
        });
    });
</script>
@endsection