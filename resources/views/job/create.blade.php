@extends('layouts.page')

@section('title', 'Career Tambah')

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
            <h2>Tambah Baru <span class="fw-300"><i>Career </i></span></h2>
            <div class="panel-toolbar">
                <a class="nav-link active" href="{{route('job.index')}}"><i class="fal fa-arrow-alt-left">
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
                {!! Form::open(['route' => 'job.store','id'=>'forms','method' => 'POST','class' =>
                'needs-validation','dropzone', 'forms','novalidate','enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('position','Posisi',['class' => 'required form-label'])}}
                        {{ Form::text('position',null,['placeholder' => 'Posisi','class' => 'form-control '.($errors->has('position') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('position'))
                        <div class="invalid-feedback">{{ $errors->first('position') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('position_en','Posisi (EN)',['class' => 'form-label'])}}
                        {{ Form::text('position_en',null,['placeholder' => 'Posisi (EN)','class' => 'form-control '.($errors->has('position_en') ? 'is-invalid':'')])}}
                        @if ($errors->has('position_en'))
                        <div class="invalid-feedback">{{ $errors->first('position_en') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('tim','Tim',['class' => 'required form-label'])}}
                        {{ Form::text('tim',null,['placeholder' => 'Tim','class' => 'form-control '.($errors->has('tim') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('tim'))
                        <div class="invalid-feedback">{{ $errors->first('tim') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('location','Lokasi',['class' => 'required form-label'])}}
                        {{ Form::text('location',null,['placeholder' => 'Lokasi','class' => 'form-control location'.($errors->has('location') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('location'))
                        <div class="invalid-feedback">{{ $errors->first('location') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('salary','Salary',['class' => 'required form-label'])}}
                        {{ Form::text('salary',null,['placeholder' => 'Salary','class' => 'form-control '.($errors->has('salary') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('salary'))
                        <div class="invalid-feedback">{{ $errors->first('salary') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('pengalaman','Pengalaman',['class' => 'required form-label'])}}
                        {{ Form::text('pengalaman',null,['placeholder' => 'e.g 5+ years experience','class' => 'form-control '.($errors->has('pengalaman') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('pengalaman'))
                        <div class="invalid-feedback">{{ $errors->first('pengalaman') }}</div>
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
                        {{ Form::label('status','Status',['class' => 'required form-label'])}}
                        {{ Form::text('status',null,['placeholder' => 'e.g contract/freelance/full time','class' => 'form-control '.($errors->has('status') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('status'))
                        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
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
        $('#kategori').select2();
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