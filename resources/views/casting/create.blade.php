@extends('layouts.page')

@section('title', 'Casting Tambah')

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
            <h2>Tambah Baru <span class="fw-300"><i>Casting </i></span></h2>
            <div class="panel-toolbar">
                <a class="nav-link active" href="{{route('casting.index')}}"><i class="fal fa-arrow-alt-left">
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
                {!! Form::open(['route' => 'casting.store','id'=>'forms','method' => 'POST','class' =>
                'needs-validation','dropzone', 'forms','novalidate','enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('pemeran','Pemeran',['class' => 'required form-label'])}}
                        {{ Form::text('pemeran',null,['placeholder' => 'Pemeran','class' => 'form-control '.($errors->has('pemeran') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('pemeran'))
                        <div class="invalid-feedback">{{ $errors->first('pemeran') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('pemeran_en','Pemeran (EN)',['class' => 'form-label'])}}
                        {{ Form::text('pemeran_en',null,['placeholder' => 'Pemeran (EN)','class' => 'form-control '.($errors->has('pemeran_en') ? 'is-invalid':'')])}}
                        @if ($errors->has('pemeran_en'))
                        <div class="invalid-feedback">{{ $errors->first('pemeran_en') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('judul_film','Judul Film',['class' => 'required form-label'])}}
                        {{ Form::text('judul_film',null,['placeholder' => 'Judul Film','class' => 'form-control '.($errors->has('judul_film') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('judul_film'))
                        <div class="invalid-feedback">{{ $errors->first('judul_film') }}</div>
                        @endif
                    </div>
                     <div class="form-group col-md-4 mb-3">
                        {{ Form::label('gender','gender',['class' => 'required form-label'])}}
                        {!! Form::select('gender', array('L' => 'Pria', 'P' => 'Wanita'), '',
                        ['id'=>'gender','class'
                        => 'custom-select'.($errors->has('gender') ? 'is-invalid':'') ,'required'
                        => '', 'placeholder' => 'Pilih Gender ...'])!!}
                        @if ($errors->has('gender'))
                        <div class="invalid-feedback">{{ $errors->first('gender') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('umur','Umur',['class' => 'required form-label'])}}
                        {{ Form::text('umur',null,['placeholder' => 'Umur','class' => 'form-control umur'.($errors->has('umur') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('umur'))
                        <div class="invalid-feedback">{{ $errors->first('umur') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('location','Lokasi',['class' => 'required form-label'])}}
                        {{ Form::text('location',null,['placeholder' => 'Lokasi','class' => 'form-control '.($errors->has('location') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('location'))
                        <div class="invalid-feedback">{{ $errors->first('location') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('deadline','Deadline',['class' => 'required form-label'])}}
                        {{ Form::text('deadline',null,['placeholder' => 'Deadline','class' => 'form-control deadline'.($errors->has('deadline') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('deadline'))
                        <div class="invalid-feedback">{{ $errors->first('deadline') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('link','Link',['class' => 'required form-label'])}}
                        {{ Form::text('link',null,['placeholder' => 'Link','class' => 'form-control '.($errors->has('link') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('link'))
                        <div class="invalid-feedback">{{ $errors->first('link') }}</div>
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
        $('#gender').select2();
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

           $('.deadline').datepicker({
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