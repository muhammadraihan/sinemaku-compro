@extends('layouts.page')

@section('title', 'Casting Edit')

@section('css')
<link rel="stylesheet" media="screen, print" href="{{asset('css/formplugins/select2/select2.bundle.css')}}">
<link rel="stylesheet" media="screen, print"
    href="{{asset('css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">
@endsection

@section('content')
<div class="col-xxl">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
        <h2>Edit <span class="fw-300"><i>Casting</i></span></h2>
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
                {!! Form::open(['route' => ['casting.update',$casting->uuid],'method' => 'PUT','class' =>
                'needs-validation','novalidate', 'enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('pemeran','Pemeran',['class' => 'required form-label'])}}
                        {{ Form::text('pemeran',$casting->pemeran,['placeholder' => 'Pemeran','class' => 'form-control '.($errors->has('pemeran') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('pemeran'))
                        <div class="invalid-feedback">{{ $errors->first('pemeran') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('judul_film','Judul Film',['class' => 'required form-label'])}}
                        {{ Form::text('judul_film',$casting->judul_film,['placeholder' => 'Judul Film','class' => 'form-control '.($errors->has('judul_film') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('judul_film'))
                        <div class="invalid-feedback">{{ $errors->first('judul_film') }}</div>
                        @endif
                    </div>
                     <div class="form-group col-md-4 mb-3">
                        {{ Form::label('gender','gender',['class' => 'required form-label'])}}
                        {!! Form::select('gender', array('L' => 'Pria', 'P' => 'Wanita'), $casting->gender,
                        ['id'=>'gender','class'
                        => 'custom-select'.($errors->has('gender') ? 'is-invalid':'') ,'required'
                        => '', 'placeholder' => 'Pilih Gender ...'])!!}
                        @if ($errors->has('gender'))
                        <div class="invalid-feedback">{{ $errors->first('gender') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('umur','Umur',['class' => 'required form-label'])}}
                        {{ Form::text('umur',$casting->umur,['placeholder' => 'Umur','class' => 'form-control umur'.($errors->has('umur') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('umur'))
                        <div class="invalid-feedback">{{ $errors->first('umur') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('location','Lokasi',['class' => 'required form-label'])}}
                        {{ Form::text('location',$casting->location,['placeholder' => 'Lokasi','class' => 'form-control '.($errors->has('location') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('location'))
                        <div class="invalid-feedback">{{ $errors->first('location') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('deadline','Deadline',['class' => 'required form-label'])}}
                        {{ Form::text('deadline',$casting->deadline,['placeholder' => 'Deadline','class' => 'form-control deadline'.($errors->has('deadline') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('deadline'))
                        <div class="invalid-feedback">{{ $errors->first('deadline') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('shoot_date','Tanggal Shoot',['class' => 'required form-label'])}}
                        {{ Form::text('shoot_date',$casting->shoot_date,['placeholder' => 'Tanggal Shoot','class' => 'form-control shoot_date'.($errors->has('shoot_date') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('shoot_date'))
                        <div class="invalid-feedback">{{ $errors->first('shoot_date') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('link','Link',['class' => 'required form-label'])}}
                        {{ Form::text('link',$casting->link,['placeholder' => 'Link','class' => 'form-control '.($errors->has('link') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('link'))
                        <div class="invalid-feedback">{{ $errors->first('link') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-12 mb-3">
                    {{ Form::label('detail','Detail',['class' => 'required form-label'])}}
                    {{ Form::textarea('detail',$casting->detail,['placeholder' => 'Detail','class' => 'form-control '.($errors->has('detail') ? 'is-invalid':''),'required'])}}
                    @if ($errors->has('detail'))
                    <div class="invalid-feedback">{{ $errors->first('detail') }}</div>
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
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    $(document).ready(function(){
        $('#gender').select2();
        $('#type').select2();

        CKEDITOR.replace('detail');

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

        $('.shoot_date').datepicker({
            orientation: "bottom left",
            format:'yyyy-mm-dd', // Notice the Extra space at the beginning
            todayHighlight:'TRUE',
            autoclose: true,
            todayBtn: "linked",
            clearBtn: true,
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