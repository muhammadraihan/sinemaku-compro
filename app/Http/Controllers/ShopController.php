<?php

namespace App\Http\Controllers;

use App\Models\KategoriShop;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Shop;

use Auth;
use DataTables;
use URL;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Shop::get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('kategorishop', function ($row){
                    return $row->Categories->name ?? null;
                })
                ->editColumn('photo', function ($row){
                    $url = asset('photo');
                    return '<image style="width: 150px; height: 150px;"  src="'.$url.'/'.$row->photo.'" alt="">';
                })
                ->addColumn('action', function ($row) {
                    return '
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('shop.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('shop.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action', 'photo'])
                ->make(true);
        }

        return view('shop.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategorishop = KategoriShop::all()->pluck('name', 'uuid');
        return view('shop.create', compact('kategorishop'));
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
            'name' => 'required',
            'judul' => 'required',
            'detail' => 'required',
            'harga' => 'required',
            'link' => 'required',
            'photo' => 'required|image',
            'highlight' => 'required',
            'kategorishop' => 'required'
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG'
        ];

        $this->validate($request, $rules, $messages);
        // dd($request->photo);

        $shop = new Shop();
        $shop->slug = Str::slug($request->name);
        $shop->name = $request->name;
        $shop->judul = $request->judul;
        $shop->detail = $request->detail;
        $shop->harga = $request->harga;
        $shop->discount = $request->discount;
        $shop->link = $request->link;
        $shop->highlight = $request->highlight;
        $shop->merchandise = $request->merchandise;
        $shop->kategorishop = $request->kategorishop;

        if ($image = $request->file('photo')) {
            $destinationPath = 'photo/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $shop->photo = "$profileImage";
        }
        $shop->created_by = Auth::user()->uuid;
        $shop->created_at = now();
        $shop->save();

        toastr()->success('New Shop Name Added', 'Success');
        return redirect()->route('shop.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
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
        $shop = Shop::uuid($id);
        $kategorishop = KategoriShop::all()->pluck('name', 'uuid');
        return view('shop.edit', compact('shop', 'kategorishop'));
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
            'name' => 'required',
            'judul' => 'required',
            'detail' => 'required',
            'harga' => 'required',
            'link' => 'required',
            'highlight' => 'required',
            'kategorishop' => 'required'
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.image' => 'Field Harus Berupa Foto !',
            '*.mimes' => 'Foto Harus Berformat JPEG/PNG/JPG'
        ];

        $this->validate($request, $rules, $messages);
        // dd($request->photo);

        $shop = Shop::uuid($id);
        $shop->slug = Str::slug($request->name);
        $shop->name = $request->name;
        $shop->judul = $request->judul;
        $shop->detail = $request->detail;
        $shop->harga = $request->harga;
        $shop->discount = $request->discount;
        $shop->link = $request->link;
        $shop->highlight = $request->highlight;
        $shop->merchandise = $request->merchandise;
        $shop->kategorishop = $request->kategorishop;

        if($request->hasFile('photo')){

            // user intends to replace the current image for the category.  
            // delete existing (if set)
        
            if($oldImage = $shop->photo) {
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
            $shop->photo = "$profileImage";
        }
        $shop->edited_by = Auth::user()->uuid;
        $shop->save();

        toastr()->success('Shop Edited', 'Success');
        return redirect()->route('shop.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::uuid($id);
        $shop->delete();

        toastr()->success('Shop Name Deleted', 'Success');
        return redirect()->route('shop.index');
    }
}
