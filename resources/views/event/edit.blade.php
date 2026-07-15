@extends('layouts.page')

@section('title', 'Event Edit')

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
        <h2>Edit <span class="fw-300"><i>Event</i></span></h2>
            <div class="panel-toolbar">
                <a class="nav-link active" href="{{route('event.index')}}"><i class="fal fa-arrow-alt-left">
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
                {!! Form::open(['route' => ['event.update',$event->uuid],'method' => 'PUT','class' =>
                'needs-validation','novalidate', 'enctype' => 'multipart/form-data']) !!}
 <div class="row">

    {{-- Kategori Event --}}
    <div class="form-group col-md-3 mb-3">
        {{ Form::label('event_kategori_uuid', 'Kategori Event', ['class' => 'required form-label']) }}
        {!! Form::select(
            'event_kategori_uuid',
            $eventKategoris,
            $event->event_kategori_uuid,
            [
                'id' => 'event_kategori_uuid',
                'class' => 'custom-select' . ($errors->has('event_kategori_uuid') ? ' is-invalid' : ''),
                'placeholder' => 'Pilih Kategori...',
                'required'
            ]
        ) !!}
    </div>

    {{-- Film --}}
    <div class="form-group col-md-3 mb-3">
        {{ Form::label('film_uuid', 'Film', ['class' => 'required form-label']) }}
        {!! Form::select(
            'film_uuid',
            $films,
            $event->film_uuid,
            [
                'id' => 'film_uuid',
                'class' => 'custom-select' . ($errors->has('film_uuid') ? ' is-invalid' : ''),
                'placeholder' => 'Pilih Film...',
                'required'
            ]
        ) !!}
    </div>

    {{-- Tanggal Event --}}
    <div class="form-group col-md-3 mb-3">
        {{ Form::label('tgl_event', 'Tanggal Event', ['class' => 'required form-label']) }}
        {{ Form::text(
            'tgl_event',
            $event->tgl_event,
            [
                'class' => 'form-control tgl_event' . ($errors->has('tgl_event') ? ' is-invalid' : ''),
                'placeholder' => 'Tanggal Event',
                'required'
            ]
        ) }}
    </div>

    {{-- Jam Event --}}
    <div class="form-group col-md-3 mb-3">
        {{ Form::label('jam_event', 'Jam Event', ['class' => 'required form-label']) }}
      {{ Form::time(
    'jam_event',
    $event->jam_event,
    [
        'class' => 'form-control' . ($errors->has('jam_event') ? ' is-invalid' : ''),
        'placeholder' => 'Jam Event',
        'required'
    ]
)}}
    </div>

</div>

<div class="row">

    {{-- Harga --}}
    <div class="form-group col-md-3 mb-3">
        {{ Form::label('harga', 'Harga', ['class' => 'required form-label']) }}
        {{ Form::text(
            'harga',
            $event->harga,
            [
                'class' => 'form-control' . ($errors->has('harga') ? ' is-invalid' : ''),
                'placeholder' => 'Harga',
                'required'
            ]
        ) }}
    </div>

</div>
                    {{-- <div class="form-group col-md-3 mb-3">
                        {{ Form::label('event_kategori_uuid','Kategori Event',['class' => 'required form-label'])}}
                        {!! Form::select('event_kategori_uuid', $eventKategoris, $event->event_kategori_uuid,
                        ['id'=>'event_kategori_uuid','class'
                        => 'custom-select'.($errors->has('event_kategori_uuid') ? 'is-invalid':'') ,'required'
                        => '', 'placeholder' => 'Pilih Kategori ...'])!!}
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        {{ Form::label('tgl_event','Tanggal Event',['class' => 'required form-label'])}}
                        {{ Form::text('tgl_event',$event->tgl_event,['placeholder' => 'Tanggal Event','class' => 'form-control tgl_event'.($errors->has('tgl_event') ? 'is-invalid':''),'required'])}}
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        {{ Form::label('jam_event','Jam Event',['class' => 'required form-label'])}}
                        {{ Form::time('jam_event',$event->jam_event,['placeholder' => 'Jam Event','class' => 'form-control '.($errors->has('jam_event') ? 'is-invalid':''),'required'])}}
                    </div> --}}
                    {{-- <div class="form-group col-md-3 mb-3">
                        {{ Form::label('harga','Harga',['class' => 'required form-label'])}}
                        {{ Form::text('harga',$event->harga,['placeholder' => 'Harga','class' => 'form-control '.($errors->has('harga') ? 'is-invalid':''),'required'])}}
                    </div>
                </div> --}}

                <div class="panel-tag bg-white border-faded mb-4">
                    <ul class="nav lang-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-id-event" role="tab">
                                <span class="lang-tab-badge badge-id">ID</span>🇮🇩 Bahasa Indonesia
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-en-event" role="tab">
                                <span class="lang-tab-badge badge-en">EN</span>🇺🇸 English
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        {{-- Tab ID --}}
                        <div class="tab-pane fade show active" id="tab-id-event" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('judul','Judul Event (ID)',['class' => 'required form-label'])}}
                                    {{ Form::text('judul',$event->judul,['placeholder' => 'Judul','class' => 'form-control '.($errors->has('judul') ? 'is-invalid':''),'required'])}}
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('location','Lokasi (ID)',['class' => 'required form-label'])}}
                                    {{ Form::text('location',$event->location,['placeholder' => 'Lokasi','class' => 'form-control '.($errors->has('location') ? 'is-invalid':''),'required'])}}
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('detail','Detail Event (ID)',['class' => 'required form-label'])}}
                                    {{ Form::textarea('detail',$event->detail,['placeholder' => 'Detail','class' => 'form-control '.($errors->has('detail') ? 'is-invalid':''),'required'])}}
                                </div>
                            </div>
                        </div>

                        {{-- Tab EN --}}
                        <div class="tab-pane fade" id="tab-en-event" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('judul_en','Judul Event (EN)',['class' => 'form-label'])}}
                                    {{ Form::text('judul_en',$event->judul_en,['placeholder' => 'Event Title in English','class' => 'form-control'])}}
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('location_en','Lokasi (EN)',['class' => 'form-label'])}}
                                    {{ Form::text('location_en',$event->location_en,['placeholder' => 'Location in English','class' => 'form-control'])}}
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('detail_en','Detail Event (EN)',['class' => 'form-label'])}}
                                    {{ Form::textarea('detail_en',$event->detail_en,['placeholder' => 'Event Detail in English','class' => 'form-control', 'id' => 'detail_en'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('link','Link Tiket / Pendaftaran',['class' => 'required form-label'])}}
                        {{ Form::text('link',$event->link,['placeholder' => 'Link Tiket','class' => 'form-control '.($errors->has('link') ? 'is-invalid':''),'required'])}}
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('video_link','Link Video (After Movie)',['class' => 'form-label'])}}
                        {{ Form::text('video_link',$event->video_link,['placeholder' => 'Link Video (Youtube)','class' => 'form-control'])}}
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('title','Slug / Unique Title',['class' => 'required form-label'])}}
                        {{ Form::text('title',$event->title,['placeholder' => 'Slug','class' => 'form-control '.($errors->has('title') ? 'is-invalid':''),'required'])}}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('photo','Main Photo (Thumbnail)',['class' => 'required form-label'])}}
                        <input type="hidden" name="oldImage" value="{{ $event->photo }}">
                        {{ Form::file('photo',null,['placeholder' => 'Photo','class' => 'form-control upload '.($errors->has('photo') ? 'is-invalid':''), 'autocomplete' => 'off', 'id' => 'photo'])}}
                        @if ($event->photo)
                            <img id="preview-image-before-upload" src="{{ asset('photo/' . $event->photo) }}" class="img-preview img-fluid mt-3" style="max-height: 250px;">
                        @else
                            <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="preview image" style="max-height: 250px; margin-top: 10px;">
                        @endif
                    </div>
                    <div class="form-group col-md-8 mb-3">
                        {{ Form::label('gallery','Add More Photos to Gallery',['class' => 'form-label'])}}
                        <input type="file" name="gallery[]" class="form-control" multiple accept="image/*">
                        <div class="mt-3 d-flex flex-wrap gap-2">
                            @foreach($event->photos as $item)
                                <div class="position-relative">
                                    <img src="{{ asset('photo/'.$item->photo) }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px;">
                                </div>
                            @endforeach
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
        $('#event_kategori_uuid').select2();
$('#film_uuid').select2();


        CKEDITOR.replace('detail');
        CKEDITOR.replace('detail_en');

        $('#photo').change(function(){

            let reader = new FileReader();

            reader.onload = (e) => {

              $('#preview-image-before-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

           });

           $('.tgl_event').datepicker({
            orientation: "bottom left",
            format:'yyyy-mm-dd', // Notice the Extra space at the beginning
            todayHighlight:'TRUE',
            autoclose: true,
            todayBtn: "linked",
            clearBtn: true,
        });

        // $('.tgl_akhir').datepicker({
        //     orientation: "bottom left",
        //     format:'yyyy-mm-dd', // Notice the Extra space at the beginning
        //     todayHighlight:'TRUE',
        //     autoclose: true,
        //     todayBtn: "linked",
        //     clearBtn: true,
        // });

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
