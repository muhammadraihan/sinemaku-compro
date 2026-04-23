<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\ArtikelKategori;

use Auth;
use DataTables;
use URL;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Article::get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('artikel_kategori_uuid', function ($row) {
                    return $row->artikelKategori->name ?? ($row->kategori ?? '-');
                })
                ->editColumn('photo', function ($row){
                    $url = asset('photo');
                    return '<image style="width: 150px; height: 150px;"  src="'.$url.'/'.$row->photo.'" alt="">';
                })
                ->addColumn('action', function ($row) {
                    return '
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('article.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('article.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action','photo'])
                ->make(true);
        }

        return view('article.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artikelKategoris = ArtikelKategori::all()->pluck('name', 'uuid');
        return view('article.create', compact('artikelKategoris'));
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
            'tgl_rilis' => 'required',
            'penulis' => 'required',
            'detail' => 'required',
            'artikel_kategori_uuid' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG'
        ];

        $this->validate($request, $rules, $messages);
        // dd($request->photo);

        $article = new Article();
        $article->slug = Str::slug($request->judul);
        $article->judul = $request->judul;
        $article->judul_en = $request->judul_en;
        $article->title = $request->title;
        $article->title_en = $request->title_en;
        $article->tgl_rilis = $request->tgl_rilis;
        $article->penulis = $request->penulis;
        $article->detail = $request->detail;
        $article->detail_en = $request->detail_en;
        $kategoriObj = ArtikelKategori::where('uuid', $request->artikel_kategori_uuid)->first();
        $article->kategori = $kategoriObj ? $kategoriObj->name : 'Uncategorized';
        $article->artikel_kategori_uuid = $request->artikel_kategori_uuid;
        $article->link = $request->link;

        if ($image = $request->file('photo')) {
            $destinationPath = 'photo/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $article->photo = "$profileImage";
        }
        $article->created_by = Auth::user()->uuid;
        $article->created_at = now();
        $article->save();

        toastr()->success('New Article Name Added', 'Success');
        return redirect()->route('article.index');
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
        $article          = Article::uuid($id);
        $artikelKategoris = ArtikelKategori::all()->pluck('name', 'uuid');
        return view('article.edit', compact('article', 'artikelKategoris'));
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
            'tgl_rilis' => 'required',
            'penulis' => 'required',
            'detail' => 'required',
            'artikel_kategori_uuid' => 'required',
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG'
        ];

        $this->validate($request, $rules, $messages);
        
        $article = Article::uuid($id);
        $article->slug = Str::slug($request->judul);
        $article->judul = $request->judul;
        $article->judul_en = $request->judul_en;
        $article->title = $request->title;
        $article->title_en = $request->title_en;
        $article->tgl_rilis = $request->tgl_rilis;
        $article->penulis = $request->penulis;
        $article->detail = $request->detail;
        $article->detail_en = $request->detail_en;
        $kategoriObj = ArtikelKategori::where('uuid', $request->artikel_kategori_uuid)->first();
        $article->kategori = $kategoriObj ? $kategoriObj->name : 'Uncategorized';
        $article->artikel_kategori_uuid = $request->artikel_kategori_uuid;
        $article->link = $request->link;

        if($request->hasFile('photo')){

            // user intends to replace the current image for the category.  
            // delete existing (if set)
        
            if($oldImage = $article->photo) {
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
            $article->photo = "$profileImage";
        }
        $article->edited_by = Auth::user()->uuid;
        $article->save();

        toastr()->success('Article Edited', 'Success');
        return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::uuid($id);
        $article->delete();

        toastr()->success('Article Name Deleted', 'Success');
        return redirect()->route('article.index');
    }
}
