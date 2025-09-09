@extends('layouts.page')

@section('title', 'Film Tambah')

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
            <h2>Tambah Baru <span class="fw-300"><i>Film </i></span></h2>
            <div class="panel-toolbar">
                <a class="nav-link active" href="{{route('film.index')}}"><i class="fal fa-arrow-alt-left">
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
                {!! Form::open(['route' => 'film.store','id'=>'forms','method' => 'POST','class' =>
                'needs-validation','dropzone', 'forms','novalidate','enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('kategori','kategori',['class' => 'required form-label'])}}
                        {!! Form::select('kategori', $kategori, '',
                        ['id'=>'kategori','class'
                        => 'custom-select'.($errors->has('kategori') ? 'is-invalid':'') ,'required'
                        => '', 'placeholder' => 'Pilih Kategori ...'])!!}
                        @if ($errors->has('kategori'))
                        <div class="invalid-feedback">{{ $errors->first('kategori') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('title','Judul',['class' => 'required form-label'])}}
                        {{ Form::text('title',null,['placeholder' => 'Judul','class' => 'form-control '.($errors->has('title') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('title'))
                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('genre','Genre',['class' => 'required form-label'])}}
                        {{ Form::text('genre',null,['placeholder' => 'Genre','class' => 'form-control '.($errors->has('genre') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('genre'))
                        <div class="invalid-feedback">{{ $errors->first('genre') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('release_date','Tanggal Rilis',['class' => 'required form-label'])}}
                        {{ Form::text('release_date',null,['placeholder' => 'Tanggal Rilis','class' => 'form-control release_date'.($errors->has('release_date') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('release_date'))
                        <div class="invalid-feedback">{{ $errors->first('release_date') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-12 mb-3">
                    {{ Form::label('sinopsis','Sinopsis',['class' => 'required form-label'])}}
                    {{ Form::textarea('sinopsis',null,['placeholder' => 'Sinopsis','class' => 'form-control '.($errors->has('sinopsis') ? 'is-invalid':''),'required'])}}
                    @if ($errors->has('sinopsis'))
                    <div class="invalid-feedback">{{ $errors->first('sinopsis') }}</div>
                    @endif
                </div>
                <div class="row">
                    <div class="form-group col-md-4 mb-3 duration">
                        {{ Form::label('duration','Durasi',['class' => 'required form-label'])}}
                        {{ Form::text('duration',null,['placeholder' => 'Durasi','class' => 'form-control'.($errors->has('duration') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('duration'))
                        <div class="invalid-feedback">{{ $errors->first('duration') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3 season">
                        {{ Form::label('season','Season',['class' => 'required form-label'])}}
                        {{ Form::text('season',null,['placeholder' => 'Season','class' => 'form-control'.($errors->has('season') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('season'))
                        <div class="invalid-feedback">{{ $errors->first('season') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3 episode">
                        {{ Form::label('episode','Episode',['class' => 'required form-label'])}}
                        {{ Form::text('episode',null,['placeholder' => 'Episode','class' => 'form-control'.($errors->has('episode') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('episode'))
                        <div class="invalid-feedback">{{ $errors->first('episode') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('director','Director',['class' => 'required form-label'])}}
                        {{ Form::text('director',null,['placeholder' => 'Director','class' => 'form-control '.($errors->has('director') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('director'))
                        <div class="invalid-feedback">{{ $errors->first('director') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('cast','Cast',['class' => 'required form-label'])}}
                        {{ Form::text('cast',null,['placeholder' => 'e.g Umay, Prilly','class' => 'form-control '.($errors->has('cast') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('cast'))
                        <div class="invalid-feedback">{{ $errors->first('cast') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('link','Link',['class' => 'required form-label'])}}
                        {{ Form::text('link',null,['placeholder' => 'https://www.youtube.com','class' => 'form-control '.($errors->has('link') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('link'))
                        <div class="invalid-feedback">{{ $errors->first('link') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('link_watch','Link Watch Now / Buy Ticket',['class' => 'form-label'])}}
                        {{ Form::text('link_watch',null,['placeholder' => 'https://www.netflix.com','class' => 'form-control '.($errors->has('link_watch') ? 'is-invalid':'')])}}
                        @if ($errors->has('link_watch'))
                        <div class="invalid-feedback">{{ $errors->first('link_watch') }}</div>
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
                <div class="form-group col-md-4 mb-3">
                    {{ Form::label('poster','Poster',['class' => 'required form-label'])}}
                    {{ Form::file('poster',null,['placeholder' => 'Poster','class' => 'form-control upload '.($errors->has('poster') ? 'is-invalid':''),'required', 'autocomplete' => 'off', 'id' => 'poster'])}}
                    <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                    alt="preview image" style="max-height: 250px;">
                    @if ($errors->has('poster'))
                    <div class="invalid-feedback">{{ $errors->first('poster') }}</div>
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
        $('#kategori').select2();
        $('#type').select2();

        CKEDITOR.replace('sinopsis');

        $('#photo').change(function(){
            
            let reader = new FileReader();
         
            reader.onload = (e) => { 
         
              $('#preview-image-before-upload').attr('src', e.target.result); 
            }
         
            reader.readAsDataURL(this.files[0]); 
           
           });

        $('#poster').change(function(){
            
            let reader = new FileReader();
            
            reader.onload = (e) => { 
            
                $('#preview-image-before-upload').attr('src', e.target.result); 
            }
            
            reader.readAsDataURL(this.files[0]); 
            
        });

           $('.release_date').datepicker({
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

        $('#kategori').change(function(){
            var kategori = $(this).val();

            $.ajax({
                url: "{{ route('ref.kategori') }}",
                type: 'GET',
                data: {
                    kategori: kategori
                },
                success: function(data) {
                    kategori = data.name.toLowerCase();
                    
                    if(kategori === 'film'){
                        $('.duration').show();
                        $('.season').hide();
                        $('.episode').hide();
                    }else if(kategori === 'series'){
                        $('.duration').hide();
                        $('.season').show();
                        $('.episode').show();
                    }else{
                        $('.duration').show();
                        $('.season').show();
                        $('.episode').show();
                    }
                }
            });
        });
    });
</script>
@endsection