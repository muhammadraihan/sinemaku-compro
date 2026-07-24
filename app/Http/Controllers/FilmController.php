<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Film;
use App\Models\Kategori;
use App\Models\FilmGallery;
use App\Models\FilmCredit;

use Auth;
use DataTables;
use URL;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Film::get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('kategori', function ($row){
                    return $row->Categories->name ?? null;
                })
                ->editColumn('photo', function ($row){
                    $url = asset('photo');
                    return '<image style="width: 150px; height: 150px;"  src="'.$url.'/'.$row->photo.'" alt="">';
                })
                ->editColumn('poster', function ($row){
                    $url = asset('photo');
                    return '<image style="width: 150px; height: 150px;"  src="'.$url.'/'.$row->poster.'" alt="">';
                })
                ->addColumn('action', function ($row) {
                    return '
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('film.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('film.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action','photo', 'poster'])
                ->make(true);
        }

        return view('film.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all()->pluck('name', 'uuid');
        return view('film.create', compact('kategori'));
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
    'kategori' => 'required',
    'title' => 'required',
    'genre' => 'required',
    'release_date' => 'required',
    'sinopsis' => 'required',
    'photo' => 'required|image',
    'poster' => 'required|image'
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG'
        ];

        $this->validate($request, $rules, $messages);
        // dd($request->photo);

        $film = new Film();
        $film->slug = Str::slug($request->title);
        $film->kategori = $request->kategori;
        $film->title = $request->title;
        $film->title_en = $request->title_en;
        $film->genre = $request->genre;
        $film->genre_en = $request->genre_en;
        $film->release_date = $request->release_date;
        $film->sinopsis = $request->sinopsis;
        $film->sinopsis_en = $request->sinopsis_en;
        $film->duration = $request->duration;
        $film->season = $request->season;
        $film->episode = $request->episode;
        $film->director = $request->director;
        $film->writer = $request->writer;
        $film->cast = $request->cast;
        $film->link = $request->link;
        $film->link_watch = $request->link_watch;


        if ($image = $request->file('photo')) {
            $destinationPath = 'photo/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $film->photo = "$profileImage";
        }

        if ($image = $request->file('poster')) {
            $destinationPath = 'photo/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $film->poster = "$profileImage";
        }

        $film->created_by = Auth::user()->uuid;
$film->created_at = now();
$film->save();

/// Director
if ($request->director) {
    FilmCredit::create([
        'film_id' => $film->id,
        'role' => 'DIRECTOR',
        'name' => $request->director,
    ]);
}

// Writer
if ($request->writer) {
    FilmCredit::create([
        'film_id' => $film->id,
        'role' => 'WRITER',
        'name' => $request->writer,
    ]);
}

// Cast
if ($request->cast) {

    foreach (explode(',', $request->cast) as $cast) {

        FilmCredit::create([
            'film_id' => $film->id,
            'role' => 'Cast',
            'name' => trim($cast),
        ]);

    }
}

// Credit tambahan
if ($request->roles) {

    foreach ($request->roles as $index => $role) {

        if (empty($request->names[$index])) {
            continue;
        }

        FilmCredit::create([
            'film_id' => $film->id,
            'role' => $role,
            'name' => $request->names[$index],
        ]);

    }

}
        // FilmCredit::where('film_id', $film->id)->delete();

if ($request->roles) {

    foreach ($request->roles as $key => $role) {

        if (!empty($request->names[$key])) {

            FilmCredit::create([
                'film_id' => $film->id,
                'role'    => $role,
                'name'    => $request->names[$key]
            ]);

        }

    }

}

        // Handle Galleries
        if ($request->hasFile('still_shots')) {
            foreach ($request->file('still_shots') as $image) {
                $filename = date('YmdHis') . "_still_" . Str::random(5) . "." . $image->getClientOriginalExtension();
                $image->move('photo/', $filename);
                FilmGallery::create([
                    'film_uuid' => $film->uuid,
                    'type' => 'still_shot',
                    'photo' => $filename
                ]);
            }
        }

        if ($request->hasFile('bts_galleries')) {
            foreach ($request->file('bts_galleries') as $image) {
                $filename = date('YmdHis') . "_bts_" . Str::random(5) . "." . $image->getClientOriginalExtension();
                $image->move('photo/', $filename);
                FilmGallery::create([
                    'film_uuid' => $film->uuid,
                    'type' => 'bts',
                    'photo' => $filename
                ]);
            }
        }

        toastr()->success('New Film Name Added', 'Success');
        return redirect()->route('film.index');
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
    public function edit($id)
    {
        $film = Film::uuid($id);
        $kategori = Kategori::all()->pluck('name', 'uuid');
        return view('film.edit', compact('film','kategori'));
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
            'kategori' => 'required',
            'title' => 'required',
            'genre' => 'required',
            'release_date' => 'required',
            'sinopsis' => 'required',
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG'
        ];

        $this->validate($request, $rules, $messages);

        $film = Film::uuid($id);
        $film->slug = Str::slug($request->title);
        $film->kategori = $request->kategori;
        $film->title = $request->title;
        $film->title_en = $request->title_en;
        $film->genre = $request->genre;
        $film->genre_en = $request->genre_en;
        $film->release_date = $request->release_date;
        $film->sinopsis = $request->sinopsis;
        $film->sinopsis_en = $request->sinopsis_en;
        $film->duration = $request->duration;
        $film->season = $request->season;
        $film->episode = $request->episode;
        $film->director = $request->director;
        $film->writer = $request->writer;
        $film->cast = $request->cast;
        $film->link = $request->link;
        $film->link_watch = $request->link_watch;


        if($request->hasFile('photo')){

            // user intends to replace the current image for the category.
            // delete existing (if set)

            if($oldImage = $film->photo) {
                $oldPath = public_path('photo/') . $oldImage;
                if(file_exists($oldPath)){
                    unlink($oldPath);
                }
            }

            // save the new image
            $image = $request->file('photo');
            $destinationPath = 'photo/';
            $profileImage = date('YmdHis') . ".photo." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $film->photo = "$profileImage";
        }

        if($request->hasFile('poster')){

            // user intends to replace the current image for the category.
            // delete existing (if set)

            if($oldImage = $film->poster) {
                $oldPath = public_path('photo/') . $oldImage;
                if(file_exists($oldPath)){
                    unlink($oldPath);
                }
            }

            // save the new image
            $image = $request->file('poster');
            $destinationPath = 'photo/';
            $profileImage = date('YmdHis') . ".poster." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $film->poster = "$profileImage";
        }
        $film->edited_by = Auth::user()->uuid;
$film->save();

/*
|--------------------------------------------------------------------------
| Update Film Credits
|--------------------------------------------------------------------------
*/

// Hapus semua credit lama
FilmCredit::where('film_id', $film->id)->delete();

// Simpan credit baru
if ($request->has('roles')) {

    foreach ($request->roles as $index => $role) {

        // Lewati jika nama kosong
        if (empty($request->names[$index])) {
            continue;
        }

        FilmCredit::create([
            'film_id' => $film->id,
            'role'    => $role,
            'name'    => $request->names[$index],
        ]);
    }
}

        // Handle New Galleries
        if ($request->hasFile('still_shots')) {
            foreach ($request->file('still_shots') as $image) {
                $filename = date('YmdHis') . "_still_" . Str::random(5) . "." . $image->getClientOriginalExtension();
                $image->move('photo/', $filename);
                FilmGallery::create([
                    'film_uuid' => $film->uuid,
                    'type' => 'still_shot',
                    'photo' => $filename
                ]);
            }
        }

        if ($request->hasFile('bts_galleries')) {
            foreach ($request->file('bts_galleries') as $image) {
                $filename = date('YmdHis') . "_bts_" . Str::random(5) . "." . $image->getClientOriginalExtension();
                $image->move('photo/', $filename);
                FilmGallery::create([
                    'film_uuid' => $film->uuid,
                    'type' => 'bts',
                    'photo' => $filename
                ]);
            }
        }

        // Handle Deletions
        if ($request->has('delete_gallery') && is_array($request->delete_gallery)) {
            foreach ($request->delete_gallery as $gUuid) {
                $gallery = FilmGallery::where('uuid', $gUuid)->where('film_uuid', $film->uuid)->first();
                if ($gallery) {
                    if (file_exists(public_path('photo/') . $gallery->photo)) {
                        unlink(public_path('photo/') . $gallery->photo);
                    }
                    $gallery->delete();
                }
            }
        }

        toastr()->success('Film Edited', 'Success');
        return redirect()->route('film.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $film = Film::uuid($id);
        $film->delete();

        toastr()->success('Film Name Deleted', 'Success');
        return redirect()->route('film.index');
    }
}
