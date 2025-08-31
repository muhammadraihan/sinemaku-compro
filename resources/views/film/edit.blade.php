@extends('layouts.page')

@section('title', 'Film Edit')

@section('css')
<link rel="stylesheet" media="screen, print" href="{{asset('css/formplugins/select2/select2.bundle.css')}}">
<link rel="stylesheet" media="screen, print"
    href="{{asset('css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">
@endsection

@section('content')
<div class="col-xxl">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
        <h2>Edit <span class="fw-300"><i>Film</i></span></h2>
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
                {!! Form::open(['route' => ['film.update',$film->uuid],'method' => 'PUT','class' =>
                'needs-validation','novalidate', 'enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('kategori','kategori',['class' => 'required form-label'])}}
                        {!! Form::select('kategori', $kategori, $film->kategori,
                        ['id'=>'kategori','class'
                        => 'custom-select'.($errors->has('kategori') ? 'is-invalid':'') ,'required'
                        => '', 'placeholder' => 'Pilih Kategori ...'])!!}
                        @if ($errors->has('kategori'))
                        <div class="invalid-feedback">{{ $errors->first('kategori') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('title','Judul',['class' => 'required form-label'])}}
                        {{ Form::text('title',$film->title,['placeholder' => 'Judul','class' => 'form-control '.($errors->has('title') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('title'))
                        <div class="invalid-feedback">{{ $errors->first('judul') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('genre','Genre',['class' => 'required form-label'])}}
                        {{ Form::text('genre',$film->genre,['placeholder' => 'Genre','class' => 'form-control '.($errors->has('genre') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('genre'))
                        <div class="invalid-feedback">{{ $errors->first('genre') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('release_date','Tanggal Rilis',['class' => 'required form-label'])}}
                        {{ Form::text('release_date',$film->release_date,['placeholder' => 'Tanggal Rilis','class' => 'form-control '.($errors->has('release_date') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('release_date'))
                        <div class="invalid-feedback">{{ $errors->first('release_date') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-12 mb-3">
                    {{ Form::label('sinopsis','Sinopsis',['class' => 'required form-label'])}}
                    {{ Form::textarea('sinopsis',$film->sinopsis,['placeholder' => 'Sinopsis','class' => 'form-control '.($errors->has('sinopsis') ? 'is-invalid':''),'required'])}}
                    @if ($errors->has('sinopsis'))
                    <div class="invalid-feedback">{{ $errors->first('sinopsis') }}</div>
                    @endif
                </div>
                <div class="row">
                    <div class="form-group col-md-4 mb-3 duration">
                        {{ Form::label('duration','Durasi',['class' => 'required form-label'])}}
                        {{ Form::text('duration',$film->duration,['placeholder' => 'Durasi','class' => 'form-control '.($errors->has('duration') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('duration'))
                        <div class="invalid-feedback">{{ $errors->first('duration') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3 season">
                        {{ Form::label('season','Season',['class' => 'required form-label'])}}
                        {{ Form::text('season',$film->season,['placeholder' => 'Season','class' => 'form-control '.($errors->has('season') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('season'))
                        <div class="invalid-feedback">{{ $errors->first('season') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3 episode">
                        {{ Form::label('episode','Episode',['class' => 'required form-label'])}}
                        {{ Form::text('episode',$film->episode,['placeholder' => 'Episode','class' => 'form-control '.($errors->has('episode') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('episode'))
                        <div class="invalid-feedback">{{ $errors->first('episode') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('director','Director',['class' => 'required form-label'])}}
                        {{ Form::text('director',$film->director,['placeholder' => 'Director','class' => 'form-control '.($errors->has('director') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('director'))
                        <div class="invalid-feedback">{{ $errors->first('director') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('cast','Cast',['class' => 'required form-label'])}}
                        {{ Form::text('cast',$film->cast,['placeholder' => 'Cast','class' => 'form-control '.($errors->has('cast') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('cast'))
                        <div class="invalid-feedback">{{ $errors->first('cast') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('link','Link',['class' => 'required form-label'])}}
                        {{ Form::text('link',$film->link,['placeholder' => 'Link Trailer','class' => 'form-control '.($errors->has('link') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('link'))
                        <div class="invalid-feedback">{{ $errors->first('link') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-4 mb-3">
                    {{ Form::label('photo','Photo',['class' => 'required form-label'])}}
                    <input type="hidden" name="oldImage" value="{{ $film->photo }}"> 
                    @if ($film->photo)
                        <img src="{{ asset('photo/' . $film->photo) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                    @else
                        <img class="img-preview img-fluid mb-5 col-sm-5">
                    @endif
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
        
        // Generate a password string
        function randString(){
            var chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNP123456789";
            var string_length = 8;
            var randomstring = '';
            for (var i = 0; i < string_length; i++) {
                var rnum = Math.floor(Math.random() * chars.length);
                randomstring += chars.substring(rnum, rnum + 1);
            }
            return randomstring;
        }
        
        // Create a new password
        $(".getNewPass").click(function(){
            var field = $('#password').closest('div').find('input[name="password"]');
            field.val(randString(field));
        });

        //Enable input and button change password
        $('#enablePassChange').click(function() {
            if ($(this).is(':checked')) {
                $('#passwordForm').attr('disabled',false); //enable input
                $('#getNewPass').attr('disabled',false); //enable button
            } else {
                    $('#passwordForm').attr('disabled', true); //disable input
                    $('#getNewPass').attr('disabled', true); //disable button
            }
        });
    });
</script>
@endsection