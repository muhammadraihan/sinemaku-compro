<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Event;
use App\Models\EventKategori;
use App\Models\Film;

use Auth;
use DataTables;
use URL;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
           $data = Event::with(['film','eventKategori'])->get();


            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('event_kategori_uuid', function ($row) {
                    return $row->eventKategori->name ?? '-';
                })

                ->addColumn('film', function ($row) {
                    return $row->film->title ?? '-';
                })

                ->editColumn('photo', function ($row){
                    $url = asset('photo');
                    return '<image style="width: 150px; height: 150px;"  src="'.$url.'/'.$row->photo.'" alt="">';
                })

                ->addColumn('action', function ($row) {
                    return '
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('event.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('event.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action','photo', 'poster'])
                ->make(true);
        }

        return view('event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $eventKategoris = EventKategori::orderBy('order_num', 'asc')->pluck('name', 'uuid');
    //     return view('event.create', compact('eventKategoris'));
    // }
    public function create()
{
    $eventKategoris = EventKategori::orderBy('order_num','asc')
        ->pluck('name','uuid');

    $films = Film::orderBy('title','asc')
        ->pluck('title','uuid');

    return view(
        'event.create',
        compact(
            'eventKategoris',
            'films'
        )
    );
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'judul' => 'required',
            'title' => 'required',
            'tgl_event' => 'required',
            'jam_event' => 'required',
            'location' => 'required',
            'detail' => 'required',
            'link' => 'required',
            'video_link' => 'nullable',
            'event_kategori_uuid'=>'required',
            'film_uuid'=>'required',
            'photo' => 'required|image'
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG'
        ];

        $this->validate($request, $rules, $messages);
        // dd($request->photo);

        $event = new Event();
        $event->slug = Str::slug($request->judul);
        $event->judul = $request->judul;
        $event->judul_en = $request->judul_en;
        $event->title = $request->title;
        $event->tgl_event = $request->tgl_event;
        $event->jam_event = $request->jam_event;
        $event->location = $request->location;
        $event->location_en = $request->location_en;
        $event->harga = $request->harga;
        $event->detail = $request->detail;
        $event->detail_en = $request->detail_en;
        $event->link = $request->link;
        $event->video_link = $request->video_link;
        $event->event_kategori_uuid = $request->event_kategori_uuid;
        $event->film_uuid = $request->film_uuid;


        if ($image = $request->file('photo')) {
            $destinationPath = 'photo/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $event->photo = "$profileImage";
        }

        $event->created_by = Auth::user()->uuid;
        $event->created_at = now();
        $event->save();

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $destinationPath = 'photo/';
                $galleryImage = "gallery_" . date('YmdHis') . "_" . uniqid() . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $galleryImage);

                \App\Models\EventPhoto::create([
                    'event_uuid' => $event->uuid,
                    'photo' => $galleryImage
                ]);
            }
        }

        toastr()->success('New Event Name Added', 'Success');
        return redirect()->route('event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $event          = Event::uuid($id);
    //     $eventKategoris = EventKategori::orderBy('order_num', 'asc')->pluck('name', 'uuid');
    //     return view('event.edit', compact('event', 'eventKategoris'));
    // }

        public function edit($id)
{
    $event = Event::uuid($id);

    $eventKategoris = EventKategori::orderBy('order_num', 'asc')
        ->pluck('name', 'uuid');

    $films = Film::orderBy('title', 'asc')
        ->pluck('title', 'uuid');

    return view(
        'event.edit',
        compact(
            'event',
            'eventKategoris',
            'films'
        )
    );
}
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'judul' => 'required',
            'title' => 'required',
            'tgl_event' => 'required',
            'jam_event' => 'required',
            'location' => 'required',
            'detail' => 'required',
            'link' => 'required',
            'video_link' => 'nullable',
            // 'event_kategori_uuid' => 'required'
            'event_kategori_uuid' => 'required','film_uuid' => 'required',

        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG'
        ];

        $this->validate($request, $rules, $messages);
        // dd($request->photo);

        $event = Event::uuid($id);
        $event->slug = Str::slug($request->judul);
        $event->judul = $request->judul;
        $event->judul_en = $request->judul_en;
        $event->title = $request->title;
        $event->tgl_event = $request->tgl_event;
        $event->jam_event = $request->jam_event;
        $event->location = $request->location;
        $event->location_en = $request->location_en;
        $event->harga = $request->harga;
        $event->detail = $request->detail;
        $event->detail_en = $request->detail_en;
        $event->link = $request->link;
        $event->video_link = $request->video_link;
        $event->event_kategori_uuid = $request->event_kategori_uuid;
        $event->film_uuid = $request->film_uuid;

        if($request->hasFile('photo')){

            // user intends to replace the current image for the category.
            // delete existing (if set)

            if($oldImage = $event->photo) {
                $oldPath = public_path('photo/') . $oldImage;
                if(file_exists($oldPath)){
                    unlink($oldPath);
                }
            }

            // save the new image
            $image = $request->file('photo');
            $destinationPath = 'photo/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $event->photo = "$profileImage";
        }

        $event->created_by = Auth::user()->uuid;
        $event->created_at = now();
        $event->save();

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $destinationPath = 'photo/';
                $galleryImage = "gallery_" . date('YmdHis') . "_" . uniqid() . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $galleryImage);

                \App\Models\EventPhoto::create([
                    'event_uuid' => $event->uuid,
                    'photo' => $galleryImage
                ]);
            }
        }

        toastr()->success('Event Edited', 'Success');
        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::uuid($id);
        $event->delete();

        toastr()->success('Event Name Deleted', 'Success');
        return redirect()->route('event.index');
    }
}
