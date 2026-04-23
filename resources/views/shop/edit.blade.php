@extends('layouts.page')

@section('title', 'Shop Edit')

@section('css')
<link rel="stylesheet" media="screen, print" href="{{asset('css/formplugins/select2/select2.bundle.css')}}">
<link rel="stylesheet" media="screen, print"
    href="{{asset('css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">
@endsection

@section('content')
<div class="col-xxl">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
        <h2>Edit <span class="fw-300"><i>Shop</i></span></h2>
            <div class="panel-toolbar">
                <a class="nav-link active" href="{{route('shop.index')}}"><i class="fal fa-arrow-alt-left">
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
                {!! Form::open(['route' => ['shop.update',$shop->uuid],'method' => 'PUT','class' =>
                'needs-validation','novalidate', 'enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('kategorishop','Kategori',['class' => 'required form-label'])}}
                        {!! Form::select('kategorishop', $kategorishop, $shop->kategorishop,
                        ['id'=>'kategorishop','class'
                        => 'custom-select'.($errors->has('kategorishop') ? 'is-invalid':'') ,'required'
                        => '', 'placeholder' => 'Pilih Kategori ...'])!!}
                        @if ($errors->has('kategorishop'))
                        <div class="invalid-feedback">{{ $errors->first('kategorishop') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('merchandise','Merchandise',['class' => 'required form-label'])}}
                        {{ Form::text('merchandise',$shop->merchandise,['placeholder' => 'eg. Perayaan Mati Rasa','class' => 'form-control '.($errors->has('merchandise') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('merchandise'))
                        <div class="invalid-feedback">{{ $errors->first('merchandise') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('name','Nama Produk',['class' => 'required form-label'])}}
                        {{ Form::text('name',$shop->name,['placeholder' => 'Nama Produk','class' => 'form-control '.($errors->has('name') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('name'))
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('name_en','Nama Produk (EN)',['class' => 'form-label'])}}
                        {{ Form::text('name_en',$shop->name_en,['placeholder' => 'Nama Produk (EN)','class' => 'form-control '.($errors->has('name_en') ? 'is-invalid':'')])}}
                        @if ($errors->has('name_en'))
                        <div class="invalid-feedback">{{ $errors->first('name_en') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('judul','Judul',['class' => 'required form-label'])}}
                        {{ Form::text('judul',$shop->judul,['placeholder' => 'Judul','class' => 'form-control '.($errors->has('judul') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('judul'))
                        <div class="invalid-feedback">{{ $errors->first('judul') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('judul_en','Judul (EN)',['class' => 'form-label'])}}
                        {{ Form::text('judul_en',$shop->judul_en,['placeholder' => 'Judul (EN)','class' => 'form-control '.($errors->has('judul_en') ? 'is-invalid':'')])}}
                        @if ($errors->has('judul_en'))
                        <div class="invalid-feedback">{{ $errors->first('judul_en') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-12 mb-3">
                    {{ Form::label('detail','Detail',['class' => 'required form-label'])}}
                    {{ Form::textarea('detail',$shop->detail,['placeholder' => 'Detail','class' => 'form-control '.($errors->has('detail') ? 'is-invalid':''),'required'])}}
                    @if ($errors->has('detail'))
                    <div class="invalid-feedback">{{ $errors->first('detail') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-12 mb-3">
                    {{ Form::label('detail_en','Detail (EN)',['class' => 'form-label'])}}
                    {{ Form::textarea('detail_en',$shop->detail_en,['placeholder' => 'Detail (EN)','class' => 'form-control '.($errors->has('detail_en') ? 'is-invalid':''), 'id' => 'detail_en'])}}
                    @if ($errors->has('detail_en'))
                    <div class="invalid-feedback">{{ $errors->first('detail_en') }}</div>
                    @endif
                </div>
                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('harga','Harga',['class' => 'required form-label'])}}
                        {{ Form::text('harga',$shop->harga,['placeholder' => 'Harga','class' => 'form-control'.($errors->has('harga') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('harga'))
                        <div class="invalid-feedback">{{ $errors->first('harga') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('discount','Discount',['class' => 'required form-label'])}}
                        {{ Form::text('discount',$shop->discount,['placeholder' => 'Discount','class' => 'form-control'.($errors->has('discount') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('discount'))
                        <div class="invalid-feedback">{{ $errors->first('discount') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('link','Link',['class' => 'required form-label'])}}
                        {{ Form::text('link',$shop->link,['placeholder' => 'Link Produk','class' => 'form-control '.($errors->has('link') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('link'))
                        <div class="invalid-feedback">{{ $errors->first('link') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('highlight','Highlight',['class' => 'required form-label'])}}
                        {!! Form::select('highlight', array('Y' => 'Y - Tampilkan', 'N' => 'N - Sembunyikan'), $shop->highlight,
                        ['id'=>'highlight','class'
                        => 'custom-select'.($errors->has('highlight') ? 'is-invalid':'') ,'required'
                        => '', 'placeholder' => 'Pilih Highlight ...'])!!}
                        @if ($errors->has('highlight'))
                        <div class="invalid-feedback">{{ $errors->first('highlight') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-4 mb-3">
                    {{ Form::label('photo','Photo',['class' => 'required form-label'])}}
                    <input type="hidden" name="oldImage" value="{{ $shop->photo }}"> 
                    @if ($shop->photo)
                        <img src="{{ asset('photo/' . $shop->photo) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
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
        $('#kategorishop').select2();
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