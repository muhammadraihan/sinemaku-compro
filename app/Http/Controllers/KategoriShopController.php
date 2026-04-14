<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriShop;

use Auth;
use DataTables;
use URL;

class KategoriShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = KategoriShop::get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('kategorishop.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('kategorishop.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('kategorishop.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategorishop.create');
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
            'name' => 'required|unique:kategori_shops,name'
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG',
            'name.unique' => 'Nama Kategori sudah digunakan, silakan gunakan Nama Kategori lain.',
        ];

        $this->validate($request, $rules, $messages);
        // dd($request->photo);

        $kategorishop = new KategoriShop();
        $kategorishop->name = $request->name;
        $kategorishop->created_by = Auth::user()->uuid;
        $kategorishop->created_at = now();
        $kategorishop->save();

        toastr()->success('New Categori Name Added', 'Success');
        return redirect()->route('kategorishop.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $kategorishop = $request->kategorishop;

        $result  = KategoriShop::select('name')
                    ->where('uuid', $kategorishop)
                    ->first();

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategorishop = KategoriShop::uuid($id);
        return view('kategorishop.edit', compact('kategorishop'));
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
            'name' => 'required|unique:kategori_shops,name'
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG',
            'name.unique' => 'Nama Kategori sudah digunakan, silakan gunakan Nama Kategori lain.',
        ];

        $this->validate($request, $rules, $messages);
        // dd($request->photo);

        $kategorishop = KategoriShop::uuid($id);
        $kategorishop->name = $request->name;
        $kategorishop->edited_by = Auth::user()->uuid;
        $kategorishop->save();

        toastr()->success('Categori Edited', 'Success');
        return redirect()->route('kategorishop.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategorishop = KategoriShop::uuid($id);
        $kategorishop->delete();

        toastr()->success('Categori Name Deleted', 'Success');
        return redirect()->route('kategorishop.index');
    }
}
