<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Film;
use App\Models\Kategori;

use Auth;
use DataTables;
use URL;
use Helper;
use Image;
use Response;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $film = Film::all();
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
            'director' => 'required',
            'cast' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
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
        $film->kategori = $request->kategori;
        $film->title = $request->title;
        $film->genre = $request->genre;
        $film->release_date = $request->release_date;
        $film->sinopsis = $request->sinopsis;
        $film->duration = $request->duration;
        $film->season = $request->season;
        $film->episode = $request->episode;
        $film->director = $request->director;
        $film->cast = $request->cast;
        $film->link = $request->link;

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
            'director' => 'required',
            'cast' => 'required'
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG'
        ];

        $this->validate($request, $rules, $messages);
        
        $film = Film::uuid($id);
        $film->kategori = $request->kategori;
        $film->title = $request->title;
        $film->genre = $request->genre;
        $film->release_date = $request->release_date;
        $film->sinopsis = $request->sinopsis;
        $film->duration = $request->duration;
        $film->season = $request->season;
        $film->episode = $request->episode;
        $film->director = $request->director;
        $film->cast = $request->cast;
        $film->link = $request->link;

        if($request->hasFile('photo')){

            // user intends to replace the current image for the category.  
            // delete existing (if set)
        
            if($oldImage = $film->photo) {
        
                unlink(public_path('photo/') . $oldImage);
            }
        
            // save the new image
            $image = $request->file('photo');
            $destinationPath = 'photo/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $film->photo = "$profileImage";
        }

        if($request->hasFile('poster')){

            // user intends to replace the current image for the category.  
            // delete existing (if set)
        
            if($oldImage = $film->poster) {
        
                unlink(public_path('photo/') . $oldImage);
            }
        
            // save the new image
            $image = $request->file('poster');
            $destinationPath = 'photo/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $film->poster = "$profileImage";
        }
        $film->edited_by = Auth::user()->uuid;
        $film->save();

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
