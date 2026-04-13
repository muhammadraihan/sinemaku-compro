<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Episode;
use App\Models\Film;
use App\Models\Kategori;

use Auth;
use DataTables;
use URL;

class EpisodeController extends Controller
{
    /**
     * Only show films that are Series or TV (Sinetron) in dropdowns.
     */
    private function getSeriesFilms()
    {
        // Get kategori UUIDs for Series and Sinetron
        $seriesKategoris = Kategori::whereIn('name', ['Series', 'Sinetron', 'series', 'sinetron'])
            ->orWhere('name', 'like', '%series%')
            ->orWhere('name', 'like', '%sinetron%')
            ->pluck('uuid');

        return Film::whereIn('kategori', $seriesKategoris)
            ->orderBy('title')
            ->get()
            ->pluck('title', 'uuid');
    }

    public function index()
    {
        if (request()->ajax()) {
            $data = Episode::with('film')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('film_uuid', function ($row) {
                    return $row->film->title ?? '-';
                })
                ->editColumn('photo', function ($row) {
                    if ($row->photo) {
                        $url = asset('photo');
                        return '<image style="width:120px;height:80px;object-fit:cover;" src="' . $url . '/' . $row->photo . '" alt="">';
                    }
                    return '-';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('episode.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('episode.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action', 'photo'])
                ->make(true);
        }

        return view('episode.index');
    }

    public function create()
    {
        $films = $this->getSeriesFilms();
        return view('episode.create', compact('films'));
    }

    public function store(Request $request)
    {
        $rules = [
            'film_uuid'      => 'required',
            'season_number'  => 'required|integer|min:1',
            'episode_number' => 'required|integer|min:1',
            'title'          => 'required',
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.integer'  => 'Field :attribute harus berupa angka !',
            '*.min'      => 'Field :attribute minimal 1 !',
        ];

        $this->validate($request, $rules, $messages);

        $film     = Film::where('uuid', $request->film_uuid)->first();
        $baseSlug = Str::slug(($film->title ?? 'film') . '-s' . $request->season_number . '-e' . $request->episode_number);

        // Ensure slug uniqueness
        $slug      = $baseSlug;
        $counter   = 1;
        while (Episode::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $episode                 = new Episode();
        $episode->film_uuid      = $request->film_uuid;
        $episode->season_number  = $request->season_number;
        $episode->episode_number = $request->episode_number;
        $episode->title          = $request->title;
        $episode->sinopsis       = $request->sinopsis;
        $episode->duration       = $request->duration;
        $episode->link           = $request->link;
        $episode->slug           = $slug;

        if ($image = $request->file('photo')) {
            $destinationPath = 'photo/';
            $profileImage    = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $episode->photo  = $profileImage;
        }

        $episode->created_by = Auth::user()->uuid;
        $episode->created_at = now();
        $episode->save();

        toastr()->success('Episode Added', 'Success');
        return redirect()->route('episode.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $episode = Episode::uuid($id);
        $films   = $this->getSeriesFilms();
        return view('episode.edit', compact('episode', 'films'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'film_uuid'      => 'required',
            'season_number'  => 'required|integer|min:1',
            'episode_number' => 'required|integer|min:1',
            'title'          => 'required',
        ];

        $messages = [
            '*.required' => 'Field :attribute tidak boleh kosong !',
            '*.integer'  => 'Field :attribute harus berupa angka !',
        ];

        $this->validate($request, $rules, $messages);

        $episode                 = Episode::uuid($id);
        $film                    = Film::where('uuid', $request->film_uuid)->first();
        $baseSlug                = Str::slug(($film->title ?? 'film') . '-s' . $request->season_number . '-e' . $request->episode_number);

        // Only regenerate slug if key fields changed
        if (
            $episode->film_uuid      !== $request->film_uuid ||
            $episode->season_number  != $request->season_number ||
            $episode->episode_number != $request->episode_number
        ) {
            $slug    = $baseSlug;
            $counter = 1;
            while (Episode::where('slug', $slug)->where('uuid', '!=', $episode->uuid)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
            $episode->slug = $slug;
        }

        $episode->film_uuid      = $request->film_uuid;
        $episode->season_number  = $request->season_number;
        $episode->episode_number = $request->episode_number;
        $episode->title          = $request->title;
        $episode->sinopsis       = $request->sinopsis;
        $episode->duration       = $request->duration;
        $episode->link           = $request->link;

        if ($request->hasFile('photo')) {
            if ($oldImage = $episode->photo) {
                $oldPath = public_path('photo/') . $oldImage;
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $image           = $request->file('photo');
            $destinationPath = 'photo/';
            $profileImage    = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $episode->photo  = $profileImage;
        }

        $episode->edited_by = Auth::user()->uuid;
        $episode->save();

        toastr()->success('Episode Updated', 'Success');
        return redirect()->route('episode.index');
    }

    public function destroy($id)
    {
        $episode = Episode::uuid($id);

        if ($episode->photo) {
            $oldPath = public_path('photo/') . $episode->photo;
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $episode->delete();

        toastr()->success('Episode Deleted', 'Success');
        return redirect()->route('episode.index');
    }
}
