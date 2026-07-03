@extends('layouts.page')

@section('title', 'Film Edit')

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
                    <div class="form-group col-md-6 mb-3">
                        {{ Form::label('kategori','kategori',['class' => 'required form-label'])}}
                        {!! Form::select('kategori', $kategori, $film->kategori,
                        ['id'=>'kategori','class'
                        => 'custom-select'.($errors->has('kategori') ? 'is-invalid':'') ,'required'
                        => '', 'placeholder' => 'Pilih Kategori ...'])!!}
                        @if ($errors->has('kategori'))
                        <div class="invalid-feedback">{{ $errors->first('kategori') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        {{ Form::label('release_date','Tanggal Rilis',['class' => 'required form-label'])}}
                        {{ Form::text('release_date',$film->release_date,['placeholder' => 'Tanggal Rilis','class' => 'form-control release_date'.($errors->has('release_date') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('release_date'))
                        <div class="invalid-feedback">{{ $errors->first('release_date') }}</div>
                        @endif
                    </div>
                </div>

                <div class="panel-tag bg-white border-faded mb-4">
                    <ul class="nav lang-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-id-film" role="tab">
                                <span class="lang-tab-badge badge-id">ID</span>🇮🇩 Bahasa Indonesia
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-en-film" role="tab">
                                <span class="lang-tab-badge badge-en">EN</span>🇺🇸 English
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        {{-- Tab ID --}}
                        <div class="tab-pane fade show active" id="tab-id-film" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('title','Judul (ID)',['class' => 'required form-label'])}}
                                    {{ Form::text('title',$film->title,['placeholder' => 'Judul','class' => 'form-control '.($errors->has('title') ? 'is-invalid':''),'required'])}}
                                    @if ($errors->has('title'))<div class="invalid-feedback">{{ $errors->first('title') }}</div>@endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('genre','Genre (ID)',['class' => 'required form-label'])}}
                                    {{ Form::text('genre',$film->genre,['placeholder' => 'Genre','class' => 'form-control '.($errors->has('genre') ? 'is-invalid':''),'required'])}}
                                    @if ($errors->has('genre'))<div class="invalid-feedback">{{ $errors->first('genre') }}</div>@endif
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('sinopsis','Sinopsis (ID)',['class' => 'required form-label'])}}
                                    {{ Form::textarea('sinopsis',$film->sinopsis,['placeholder' => 'Sinopsis','class' => 'form-control '.($errors->has('sinopsis') ? 'is-invalid':''),'required'])}}
                                    @if ($errors->has('sinopsis'))<div class="invalid-feedback">{{ $errors->first('sinopsis') }}</div>@endif
                                </div>
                            </div>
                        </div>

                        {{-- Tab EN --}}
                        <div class="tab-pane fade" id="tab-en-film" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('title_en','Judul (EN)',['class' => 'form-label'])}}
                                    {{ Form::text('title_en',$film->title_en,['placeholder' => 'Title in English','class' => 'form-control'])}}
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('genre_en','Genre (EN)',['class' => 'form-label'])}}
                                    {{ Form::text('genre_en',$film->genre_en,['placeholder' => 'Genre in English','class' => 'form-control'])}}
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('sinopsis_en','Sinopsis (EN)',['class' => 'form-label'])}}
                                    {{ Form::textarea('sinopsis_en',$film->sinopsis_en,['placeholder' => 'Synopsis in English','class' => 'form-control', 'id' => 'sinopsis_en'])}}
                                </div>
                            </div>
                        </div>
                    </div>
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
 <div class="col-md-12 mb-4">

    <div class="form-group col-md-4 mb-3">
    {{ Form::label('director','Director',['class' => 'required form-label'])}}
    {{ Form::text('director',null,[
        'placeholder'=>'Director',
        'class'=>'form-control'
    ])}}
</div>

<div class="form-group col-md-4 mb-3">
    {{ Form::label('writer','Written By',['class'=>'form-label'])}}
    {{ Form::text('writer',null,[
        'placeholder'=>'Writer',
        'class'=>'form-control'
    ])}}
</div>

<div class="form-group col-md-4 mb-3">
    {{ Form::label('cast','Cast',['class'=>'required form-label'])}}
    {{ Form::text('cast',null,[
        'placeholder'=>'e.g Umay, Prilly',
        'class'=>'form-control'
    ])}}
</div>

    <h5 class="mb-3">Film Credits</h5>



    <table class="table table-bordered" id="credit-table">

        <thead>

            <tr>

                <th width="30%">Role</th>

                <th>Name</th>

                <th width="10%">Action</th>

            </tr>

        </thead>

        <tbody>
@if($film->credits->count())

    @foreach($film->credits as $credit)

        <tr>

            <td>

                <select name="roles[]" class="form-control">

                    @php
                        $roles = [
                            'Executive Producer',
                            'Producer',
                            'Co_Producer',
                            'Witers DOP',
                            'Art Director',
                            'Wardrobe',
                            'Sound Recordist',
                            'Post Producer',
                            'Editor',
                            'Sound Designer'
                        ];
                    @endphp

                    @foreach($roles as $role)

                        <option
                            value="{{ $role }}"
                            {{ $credit->role == $role ? 'selected' : '' }}>

                            {{ $role }}

                        </option>

                    @endforeach

                </select>

            </td>

            <td>

                <input
                    type="text"
                    name="names[]"
                    value="{{ $credit->name }}"
                    class="form-control">

            </td>

            <td class="text-center">

                <button
                    type="button"
                    class="btn btn-danger btn-sm remove-row">

                    ×

                </button>

            </td>

        </tr>

    @endforeach

@else

<tr>

    <td>

        <select name="roles[]" class="form-control">

            <option>Director</option>
            <option>Writer</option>
            <option>Cast</option>
            <option>Producer</option>

        </select>

    </td>

    <td>

        <input
            type="text"
            name="names[]"
            class="form-control">

    </td>

    <td class="text-center">

        <button
            type="button"
            class="btn btn-danger btn-sm remove-row">

            ×

        </button>

    </td>

</tr>

@endif

        </tbody>

    </table>

    <button
        type="button"
        class="btn btn-success"
        id="add-credit">

        + Tambah Credit

    </button>

</div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('link','Link Trailer',['class' => 'required form-label'])}}
                        {{ Form::text('link',$film->link,['placeholder' => 'Link Trailer','class' => 'form-control '.($errors->has('link') ? 'is-invalid':''),'required'])}}
                        @if ($errors->has('link'))
                        <div class="invalid-feedback">{{ $errors->first('link') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-8 mb-3">
                        {{ Form::label('link_watch','Watch Providers Links (Dynamic Logos)',['class' => 'form-label'])}}
                        {{ Form::textarea('link_watch',$film->link_watch,['placeholder' => "https://netflix.com/...\nhttps://vidio.com/...", 'class' => 'form-control '.($errors->has('link_watch') ? 'is-invalid':''), 'rows' => 1, 'id' => 'link_watch', 'style' => 'overflow:hidden'])}}
                        <small class="form-text text-muted">
                            Masukkan daftar link streaming (Netflix, Vidio, Disney+, dll). Pisahkan tiap link dengan <strong>koma</strong> atau <strong>baris baru (Enter)</strong>. Logo akan muncul otomatis di halaman detail.
                        </small>
                        @if ($errors->has('link_watch'))
                        <div class="invalid-feedback">{{ $errors->first('link_watch') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-4 mb-3">
                    {{ Form::label('photo','Photo',['class' => 'required form-label'])}}
                    <input type="hidden" name="oldImage" value="{{ $film->photo }}">
                    @if ($film->photo)
                        <img src="{{ asset('photo/' . $film->photo) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                    @endif
                    {{ Form::file('photo',['placeholder' => 'Photo','class' => 'form-control upload '.($errors->has('photo') ? 'is-invalid':''),'required', 'autocomplete' => 'off', 'id' => 'photo'])}}
                    <img id="preview-image-before-upload-photo" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                    alt="preview image" style="max-height: 250px;">
                    @if ($errors->has('photo'))
                    <div class="invalid-feedback">{{ $errors->first('photo') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-4 mb-3">
                    {{ Form::label('poster','poster',['class' => 'required form-label'])}}
                    <input type="hidden" name="oldPoster" value="{{ $film->poster }}">
                    @if ($film->poster)
                        <img src="{{ asset('photo/' . $film->poster) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                    @endif
                    {{ Form::file('poster',['placeholder' => 'Poster','class' => 'form-control upload '.($errors->has('poster') ? 'is-invalid':''),'required', 'autocomplete' => 'off', 'id' => 'poster'])}}
                    <img id="preview-image-before-upload-poster" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                    alt="preview image" style="max-height: 250px;">
                    @if ($errors->has('poster'))
                    <div class="invalid-feedback">{{ $errors->first('poster') }}</div>
                    @endif
                </div>

                <div class="col-md-12 mb-3">
                    <hr>
                    <h4 class="mb-3">Gallery Management</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Existing Still Shots</label>
                            <div class="row">
                                @foreach($film->stillShots as $gallery)
                                <div class="col-md-4 mb-2 text-center">
                                    <img src="{{ asset('photo/' . $gallery->photo) }}" class="img-fluid mb-1" style="height: 100px; object-fit: cover;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="del_{{ $gallery->uuid }}" name="delete_gallery[]" value="{{ $gallery->uuid }}">
                                        <label class="custom-control-label text-danger" for="del_{{ $gallery->uuid }}">Hapus</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-3">
                                {{ Form::label('still_shots','Tambah Still Shots (Multi)',['class' => 'form-label'])}}
                                <input type="file" name="still_shots[]" class="form-control" multiple accept="image/*">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Existing Behind The Scenes</label>
                            <div class="row">
                                @foreach($film->btsGalleries as $gallery)
                                <div class="col-md-4 mb-2 text-center">
                                    <img src="{{ asset('photo/' . $gallery->photo) }}" class="img-fluid mb-1" style="height: 100px; object-fit: cover;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="del_{{ $gallery->uuid }}" name="delete_gallery[]" value="{{ $gallery->uuid }}">
                                        <label class="custom-control-label text-danger" for="del_{{ $gallery->uuid }}">Hapus</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-3">
                                {{ Form::label('bts_galleries','Tambah BTS Photos (Multi)',['class' => 'form-label'])}}
                                <input type="file" name="bts_galleries[]" class="form-control" multiple accept="image/*">
                            </div>
                        </div>
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
<script src="{{asset('js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('js/formplugins/ckeditor/ckeditor.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#kategori').select2();
        $('#type').select2();

        CKEDITOR.replace('sinopsis');
        CKEDITOR.replace('sinopsis_en');

        $('#photo').change(function(){

            let reader = new FileReader();

            reader.onload = (e) => {

              $('#preview-image-before-upload-photo').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

           });

        $('#poster').change(function(){

            let reader = new FileReader();

            reader.onload = (e) => {

                $('#preview-image-before-upload-poster').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });

        // Auto-resize for link_watch
        $('#link_watch').on('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        }).trigger('input');

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

        $('#add-credit').click(function(){

    $('#credit-table tbody').append(`

        <tr>

            <td>

                <select name="roles[]" class="form-control">

                    <option value="Director">Director</option>
                    <option value="Writer">Writer</option>
                    <option value="Cast">Cast</option>
                    <option value="Producer">Producer</option>
                    <option value="Executive Producer">Executive Producer</option>
                    <option value="Editor">Editor</option>
                    <option value="Music Composer">Music Composer</option>
                    <option value="Cinematographer">Cinematographer</option>

                </select>

            </td>

            <td>

                <input
                    type="text"
                    name="names[]"
                    class="form-control">

            </td>

            <td class="text-center">

                <button
                    type="button"
                    class="btn btn-danger btn-sm remove-row">

                    ×

                </button>

            </td>

        </tr>

    `);

});

$(document).on('click','.remove-row',function(){

    $(this).closest('tr').remove();

});
</script>
@endsection
