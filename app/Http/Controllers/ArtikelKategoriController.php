<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ArtikelKategori;

use Auth;
use DataTables;
use URL;

class ArtikelKategoriController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = ArtikelKategori::get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('articles_count', function ($row) {
                    return $row->articles()->count();
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('artikel-kategori.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('artikel-kategori.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('artikelkategori.index');
    }

    public function create()
    {
        return view('artikelkategori.create');
    }

    public function store(Request $request)
    {
        $rules    = ['name' => 'required'];
        $messages = ['*.required' => 'Field :attribute tidak boleh kosong !'];
        $this->validate($request, $rules, $messages);

        $kategori           = new ArtikelKategori();
        $kategori->name     = $request->name;
        $kategori->slug     = Str::slug($request->name);
        $kategori->created_by = Auth::user()->uuid;
        $kategori->created_at = now();
        $kategori->save();

        toastr()->success('Kategori Artikel Added', 'Success');
        return redirect()->route('artikel-kategori.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $kategori = ArtikelKategori::uuid($id);
        return view('artikelkategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $rules    = ['name' => 'required'];
        $messages = ['*.required' => 'Field :attribute tidak boleh kosong !'];
        $this->validate($request, $rules, $messages);

        $kategori           = ArtikelKategori::uuid($id);
        $kategori->name     = $request->name;
        $kategori->slug     = Str::slug($request->name);
        $kategori->edited_by = Auth::user()->uuid;
        $kategori->save();

        toastr()->success('Kategori Artikel Updated', 'Success');
        return redirect()->route('artikel-kategori.index');
    }

    public function destroy($id)
    {
        $kategori = ArtikelKategori::uuid($id);
        $kategori->delete();

        toastr()->success('Kategori Artikel Deleted', 'Success');
        return redirect()->route('artikel-kategori.index');
    }
}
