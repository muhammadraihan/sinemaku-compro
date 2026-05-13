@extends('layouts.page')

@section('title', 'Event Tambah')

@section('css')
<link rel="stylesheet" media="screen, print" href="{{asset('css/formplugins/select2/select2.bundle.css')}}">
<link rel="stylesheet" media="screen, print" href="{{asset('css/formplugins/dropzone/dropzone.css')}}">
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
            <h2>Tambah Baru <span class="fw-300"><i>Event </i></span></h2>
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
                {!! Form::open(['route' => 'event.store','id'=>'forms','method' => 'POST','class' =>
                'needs-validation','dropzone', 'forms','novalidate','enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="form-group col-md-3 mb-3">
                        {{ Form::label('event_kategori_uuid','Kategori Event',['class' => 'required form-label'])}}
                        {!! Form::select('event_kategori_uuid', $eventKategoris, '',
                        ['id'=>'event_kategori_uuid','class'
                        => 'custom-select'.($errors->has('event_kategori_uuid') ? 'is-invalid':'') ,'required'
                        => '', 'placeholder' => 'Pilih Kategori ...'])!!}
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        {{ Form::label('tgl_event','Tanggal Event',['class' => 'required form-label'])}}
                        {{ Form::text('tgl_event',null,['placeholder' => 'Tanggal Event','class' => 'form-control tgl_event'.($errors->has('tgl_event') ? 'is-invalid':''),'required'])}}
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        {{ Form::label('jam_event','Jam Event',['class' => 'required form-label'])}}
                        {{ Form::time('jam_event',null,['placeholder' => 'Jam Event','class' => 'form-control '.($errors->has('jam_event') ? 'is-invalid':''),'required'])}}
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        {{ Form::label('harga','Harga',['class' => 'required form-label'])}}
                        {{ Form::text('harga',null,['placeholder' => 'Harga','class' => 'form-control '.($errors->has('harga') ? 'is-invalid':''),'required'])}}
                    </div>
                </div>

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
                                    {{ Form::text('judul',null,['placeholder' => 'Judul','class' => 'form-control '.($errors->has('judul') ? 'is-invalid':''),'required'])}}
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('location', 'Lokasi (ID)',['class' => 'required form-label'])}}
                                    {{ Form::text('location',null,['placeholder' => 'Lokasi','class' => 'form-control '.($errors->has('location') ? 'is-invalid':''),'required'])}}
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('detail','Detail Event (ID)',['class' => 'required form-label'])}}
                                    {{ Form::textarea('detail',null,['placeholder' => 'Detail','class' => 'form-control '.($errors->has('detail') ? 'is-invalid':''),'required'])}}
                                </div>
                            </div>
                        </div>

                        {{-- Tab EN --}}
                        <div class="tab-pane fade" id="tab-en-event" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('judul_en','Judul Event (EN)',['class' => 'form-label'])}}
                                    {{ Form::text('judul_en',null,['placeholder' => 'Event Title in English','class' => 'form-control'])}}
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    {{ Form::label('location_en','Lokasi (EN)',['class' => 'form-label'])}}
                                    {{ Form::text('location_en',null,['placeholder' => 'Location in English','class' => 'form-control'])}}
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    {{ Form::label('detail_en','Detail Event (EN)',['class' => 'form-label'])}}
                                    {{ Form::textarea('detail_en',null,['placeholder' => 'Event Detail in English','class' => 'form-control', 'id' => 'detail_en'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('link','Link Tiket / Pendaftaran',['class' => 'required form-label'])}}
                        {{ Form::text('link',null,['placeholder' => 'Link Tiket','class' => 'form-control '.($errors->has('link') ? 'is-invalid':''),'required'])}}
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('video_link','Link Video (After Movie)',['class' => 'form-label'])}}
                        {{ Form::text('video_link',null,['placeholder' => 'Link Video (Youtube)','class' => 'form-control'])}}
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('title','Slug / Unique Title',['class' => 'required form-label'])}}
                        {{ Form::text('title',null,['placeholder' => 'Slug','class' => 'form-control '.($errors->has('title') ? 'is-invalid':''),'required'])}}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        {{ Form::label('photo','Main Photo (Thumbnail)',['class' => 'required form-label'])}}
                        {{ Form::file('photo',null,['placeholder' => 'Photo','class' => 'form-control upload '.($errors->has('photo') ? 'is-invalid':''),'required', 'autocomplete' => 'off', 'id' => 'photo'])}}
                        <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                        alt="preview image" style="max-height: 250px; margin-top: 10px;">
                    </div>
                    <div class="form-group col-md-8 mb-3">
                        {{ Form::label('gallery','Event Gallery (Multiple Photos)',['class' => 'form-label'])}}
                        <input type="file" name="gallery[]" class="form-control" multiple accept="image/*">
                        <small class="text-muted">You can select multiple photos to be displayed in the event gallery.</small>
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
        $('#event_kategori_uuid').select2();
        $('#type').select2();
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

           $('.tgl_event').datepicker({
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