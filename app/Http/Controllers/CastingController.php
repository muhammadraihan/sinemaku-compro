<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Casting;

use Auth;
use DataTables;
use URL;
use Helper;
use Image;
use Response;

class CastingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $casting = casting::all();
        if (request()->ajax()) {
            $data = casting::get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('casting.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('casting.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('casting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('casting.create');
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
            'pemeran' => 'required',
            'judul_film' => 'required',
            'gender' => 'required',
            'umur' => 'required',
            'location' => 'required',
            'detail' => 'required',
            'deadline' => 'required',
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

        $casting = new casting();
        $casting->slug = Str::slug($request->pemeran);
        $casting->pemeran = $request->pemeran;
        $casting->judul_film = $request->judul_film;
        $casting->gender = $request->gender;
        $casting->umur = $request->umur;
        $casting->location = $request->location;
        $casting->detail = $request->detail;
        $casting->deadline = $request->deadline;
        $casting->link = $request->link;
        $casting->shoot_date = $request->shoot_date;
        $casting->created_by = Auth::user()->uuid;
        $casting->created_at = now();
        $casting->save();

        toastr()->success('New Casting Added', 'Success');
        return redirect()->route('casting.index');
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
        $casting = casting::uuid($id);
        return view('casting.edit', compact('casting'));
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
            'pemeran' => 'required',
            'judul_film' => 'required',
            'gender' => 'required',
            'umur' => 'required',
            'location' => 'required',
            'detail' => 'required',
            'deadline' => 'required',
            'link' => 'required'
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG'
        ];

        $this->validate($request, $rules, $messages);
        
        $casting = casting::uuid($id);
        $casting->pemeran = $request->pemeran;
        $casting->judul_film = $request->judul_film;
        $casting->gender = $request->gender;
        $casting->umur = $request->umur;
        $casting->location = $request->location;
        $casting->detail = $request->detail;
        $casting->deadline = $request->deadline;
        $casting->link = $request->link;
        $casting->shoot_date = $request->shoot_date;
        $casting->edited_by = Auth::user()->uuid;
        $casting->save();

        toastr()->success('Casting Edited', 'Success');
        return redirect()->route('casting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $casting = casting::uuid($id);
        $casting->delete();

        toastr()->success('Casting Name Deleted', 'Success');
        return redirect()->route('casting.index');
    }
}
