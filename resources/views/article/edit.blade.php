@extends('layouts.page')

@section('title', 'Article Edit')

@section('css')
<link rel="stylesheet" media="screen, print" href="{{asset('css/formplugins/select2/select2.bundle.css')}}">
<link rel="stylesheet" media="screen, print"
    href="{{asset('css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">
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
        <h2>Edit <span class="fw-300"><i>Article</i></span></h2>
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
                {!! Form::open(['route' => ['article.update',$article->uuid],'method' => 'PUT','class' =>
                'needs-validation','novalidate', 'enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('artikel_kategori_uuid','Kategori Artikel',['class' => 'required form-label'])}}
                        {!! Form::select('artikel_kategori_uuid', $artikelKategoris, $article->artikel_kategori_uuid,
                        ['id'=>'artikel_kategori_uuid','class'
                        => 'custom-select'.($errors->has('artikel_kategori_uuid') ? 'is-invalid':'') ,'required'
                        => '', 'placeholder' => 'Pilih Kategori ...'])!!}
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('tgl_rilis','Tanggal Rilis',['class' => 'required form-label'])}}
                        {{ Form::text('tgl_rilis',$article->tgl_rilis,['placeholder' => 'Tanggal Rilis','class' => 'form-control tgl_rilis'.($errors->has('tgl_rilis') ? 'is-invalid':''),'required'])}}
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('penulis','Penulis',['class' => 'required form-label'])}}
                        {{ Form::text('penulis',$article->penulis,['placeholder' => 'Penulis','class' => 'form-control '.($errors->has('penulis') ? 'is-invalid':''),'required'])}}
                    </div>
                </div>

                <div class="panel-tag bg-white border-faded mb-4">
                    <ul class="nav lang-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-id-article" role="tab">
                                <span class="lang-tab-badge badge-id">ID</span>🇮🇩 Bahasa Indonesia
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-en-article" role="tab">
                                <span class="lang-tab-badge badge-en">EN</span>🇺🇸 English
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        {{-- Tab ID --}}
                        <div class="tab-pane fade show active" id="tab-id-article" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('judul','Judul Artikel (ID)',['class' => 'required form-label'])}}
                                    {{ Form::text('judul',$article->judul,['placeholder' => 'Judul','class' => 'form-control '.($errors->has('judul') ? 'is-invalid':''),'required'])}}
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('title','Excerpt / Ringkasan (ID)',['class' => 'required form-label'])}}
                                    {{ Form::text('title',$article->title,['placeholder' => 'Excerpt','class' => 'form-control '.($errors->has('title') ? 'is-invalid':''),'required'])}}
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('detail','Konten Artikel (ID)',['class' => 'required form-label'])}}
                                    {{ Form::textarea('detail',$article->detail,['placeholder' => 'Detail','class' => 'form-control '.($errors->has('detail') ? 'is-invalid':''),'required'])}}
                                </div>
                            </div>
                        </div>

                        {{-- Tab EN --}}
                        <div class="tab-pane fade" id="tab-en-article" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('judul_en','Judul Artikel (EN)',['class' => 'form-label'])}}
                                    {{ Form::text('judul_en',$article->judul_en,['placeholder' => 'Article Title in English','class' => 'form-control'])}}
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('title_en','Excerpt / Ringkasan (EN)',['class' => 'form-label'])}}
                                    {{ Form::text('title_en',$article->title_en,['placeholder' => 'Excerpt in English','class' => 'form-control'])}}
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('detail_en','Konten Artikel (EN)',['class' => 'form-label'])}}
                                    {{ Form::textarea('detail_en',$article->detail_en,['placeholder' => 'Article Content in English','class' => 'form-control', 'id' => 'detail_en'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12 mb-3">
                        {{ Form::label('link','Link External (Read More)',['class' => 'required form-label'])}}
                        {{ Form::text('link',$article->link,['placeholder' => 'https://...','class' => 'form-control '.($errors->has('link') ? 'is-invalid':''),'required'])}}
                    </div>
                </div>
                <div class="form-group col-md-4 mb-3">
                    {{ Form::label('photo','Photo',['class' => 'required form-label'])}}
                    <input type="hidden" name="oldImage" value="{{ $article->photo }}"> 
                    @if ($article->photo)
                        <img src="{{ asset('photo/' . $article->photo) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
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