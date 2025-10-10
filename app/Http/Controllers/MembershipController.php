<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Membership;
use Rap2hpoutre\FastExcel\FastExcel;

use Auth;
use DataTables;
use URL;
use Helper;
use Image;
use Response;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $membership = membership::all();
        if (request()->ajax()) {
            $data = membership::get();

            return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('action', function ($row) {
                //     return '
                //             <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('membership.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                //             <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('membership.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>';
                // })
                ->removeColumn('id')
                ->removeColumn('uuid')
                // ->rawColumns(['action','photo', 'poster'])
                ->make(true);
        }

        return view('membership.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:memberships,email',
            'city' => 'required',
            'phone_number' => 'required|numeric|unique:memberships,phone_number'
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG',
            '*.email' => 'Format Email Salah !',
            'email.unique' => 'Email sudah digunakan, silakan gunakan email lain.',
            'phone_number.unique' => 'Nomor telepon sudah digunakan, silakan gunakan nomor lain.',
        ];

        $this->validate($request, $rules, $messages);
        // dd($request->photo);

        $membership = new membership();
        $membership->first_name = $request->first_name;
        $membership->last_name = $request->last_name;
        $membership->email = $request->email;
        $membership->city = $request->city;
        $membership->phone_number = $request->phone_number;
        $membership->created_at = now();
        $membership->save();

        // toastr()->success('Thankyou for Subscribe !', 'Success');
        return redirect('/memberships')->with('success', 'Thankyou for Subscribe !');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function export(Request $request)
    {
        $q = Membership::query();

        // opsional: terapkan pencarian global dari DataTables
        if ($search = $request->input('search.value')) {
            $q->where(function ($x) use ($search) {
                $x->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('city', 'like', "%{$search}%")
                ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        $rows = $q->orderBy('first_name')->get(['first_name','last_name','email','city','phone_number']);

        $data = $rows->values()->map(function ($r, $i) {
            return [
                'No'          => $i + 1,
                'First Name'  => $r->first_name,
                'Last Name'   => $r->last_name,
                'Email'       => $r->email,
                'City'        => $r->city,
                'Phone'       => $r->phone_number,
            ];
        });

        return (new FastExcel($data))->download('membership.xlsx');
    }
}
