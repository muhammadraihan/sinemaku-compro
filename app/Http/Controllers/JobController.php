<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Job;

use Auth;
use DataTables;
use URL;
use Helper;
use Image;
use Response;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job = job::all();
        if (request()->ajax()) {
            $data = job::get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('photo', function ($row){
                    $url = asset('photo');
                    return '<image style="width: 150px; height: 150px;"  src="'.$url.'/'.$row->photo.'" alt="">';
                })
                ->addColumn('action', function ($row) {
                    return '
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('job.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('job.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action','photo'])
                ->make(true);
        }

        return view('job.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('job.create');
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
            'position' => 'required',
            'tim' => 'required',
            'location' => 'required',
            'pengalaman' => 'required',
            'detail' => 'required',
            'status' => 'required',
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

        $job = new job();
        $job->position = $request->position;
        $job->tim = $request->tim;
        $job->location = $request->location;
        $job->salary = $request->salary;
        $job->pengalaman = $request->pengalaman;
        $job->detail = $request->detail;
        $job->status = $request->status;
        $job->link = $request->link;
        $job->created_by = Auth::user()->uuid;
        $job->created_at = now();
        $job->save();

        toastr()->success('New Career Name Added', 'Success');
        return redirect()->route('job.index');
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
        $job = job::uuid($id);
        return view('job.edit', compact('job'));
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
            'position' => 'required',
            'tim' => 'required',
            'location' => 'required',
            'pengalaman' => 'required',
            'detail' => 'required',
            'status' => 'required',
            'link' => 'required'
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG'
        ];

        $this->validate($request, $rules, $messages);
        
        $job = job::uuid($id);
        $job->position = $request->position;
        $job->tim = $request->tim;
        $job->location = $request->location;
        $job->salary = $request->salary;
        $job->pengalaman = $request->pengalaman;
        $job->detail = $request->detail;
        $job->status = $request->status;
        $job->link = $request->link;
        $job->edited_by = Auth::user()->uuid;
        $job->save();

        toastr()->success('Career Edited', 'Success');
        return redirect()->route('job.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = job::uuid($id);
        $job->delete();

        toastr()->success('Career Name Deleted', 'Success');
        return redirect()->route('job.index');
    }
}
