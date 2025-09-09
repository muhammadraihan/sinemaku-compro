<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Film;
use App\Models\BehindTheScene as bts;

use Auth;
use DataTables;
use URL;
use Helper;
use Image;
use Response;

class BehindTheSceneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bts = bts::all();
        if (request()->ajax()) {
            $data = bts::get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('judul', function ($row){
                    return $row->Judul->title ?? null;
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
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('bts.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('bts.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action','photo', 'poster'])
                ->make(true);
        }

        return view('bts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $film = film::all()->pluck('title', 'uuid');
        return view('bts.create', compact('film'));
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
            'caption' => 'required',
            'link' => 'required'
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG'
        ];

        $this->validate($request, $rules, $messages);
        // dd($request->photo);

        $bts = new bts();
        $bts->judul = $request->judul;
        $bts->caption = $request->caption;
        $bts->link = $request->link;

        $bts->created_by = Auth::user()->uuid;
        $bts->created_at = now();
        $bts->save();

        toastr()->success('New BTS Video Added', 'Success');
        return redirect()->route('bts.index');
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
        $bts = bts::uuid($id);
        $film = film::all()->pluck('title', 'uuid');
        return view('bts.edit', compact('bts','film'));
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
            'caption' => 'required',
            'link' => 'required',
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG'
        ];

        $this->validate($request, $rules, $messages);
        
        $bts = bts::uuid($id);
        $bts->judul = $request->judul;
        $bts->caption = $request->caption;
        $bts->link = $request->link;

        $bts->edited_by = Auth::user()->uuid;
        $bts->save();

        toastr()->success('BTS Edited', 'Success');
        return redirect()->route('bts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bts = bts::uuid($id);
        $bts->delete();

        toastr()->success('BTS Video Deleted', 'Success');
        return redirect()->route('bts.index');
    }
}
