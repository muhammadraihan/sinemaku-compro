<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Shop;
use App\Models\Article;
use App\Models\BehindTheScene as bts;
use App\Models\Casting;
use App\Models\Event;
use App\Models\Job;
use App\Models\Kategori;
use App\Models\KategoriShop;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use Carbon\Carbon;

class FrontEndController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori_film = Kategori::where('name', 'like', '%film%')->first();
        $film = film::all()->where('kategori', $kategori_film->uuid);
        $kategori_series = Kategori::where('name', 'like', '%series%')->first();
        $series = film::all()->where('kategori', $kategori_series->uuid);
        $shop = shop::select('uuid','name', 'photo', 'slug')
                ->where('highlight', '=', 'Y')
                ->get();
        $article = article::select('uuid','kategori', 'link', 'photo', 'judul', 'title', 'created_at', 'slug')
                            ->orderBy('created_at')
                            ->limit(1)
                            ->get();
        $all_article = article::select('uuid','kategori', 'link', 'photo', 'judul', 'title', 'created_at', 'slug')
                            ->where('uuid', '!=', $article[0]->uuid)
                            ->limit(4)
                            ->orderBy('created_at')
                            ->get();
        $careers = job::orderBy('created_at', 'DESC')->limit(6)->get();
        $coming_soon = Film::whereDate('release_date', '>=', Carbon::now())
                            ->get();
        $spotlight1 = film::all()->random();
        $spotlight2 = film::all()->random();
        $kategorishop = KategoriShop::all();
        return view('welcome',compact('film', 'shop', 'article', 'careers', 'all_article', 'coming_soon', 'spotlight1', 'spotlight2', 'kategorishop',
                                        'series', 'kategori_film', 'kategori_series'));
    }

    public function film()
    {
        $kategori = Kategori::where('name', 'like', '%film%')->first();
        $film = film::all()->where('kategori', $kategori->uuid);
        $coming_soon = Film::whereDate('release_date', '>=', Carbon::now())
                            ->where('kategori', $kategori->uuid)
                            ->get();
        // $genre = film::selectRaw('distinct genre')
        //                 ->where('kategori', $kategori->uuid)
        //                 ->get();

        // 1) Kumpulkan semua genre mentah dari DB
        $raw = Film::where('kategori', $kategori->uuid)->pluck('genre'); // mis: ["drama, thriller", "comedy", "drama, comedy"]

        // 2) Pecah per koma, rapikan, unique, sort
        $chipGenres = $raw
            ->flatMap(fn ($s) => preg_split('/\s*,\s*/', (string) $s)) // → ["drama","thriller","comedy",...]
            ->map(fn ($g) => strtolower(trim($g)))
            ->filter()
            ->unique()
            ->sort()
            ->values();

        // 3) Siapkan data film + array genre per film (untuk data-genres)
        $genre = Film::where('kategori', $kategori->uuid)
            ->get()->map(function ($f) {
            $f->genres_array = collect(preg_split('/\s*,\s*/', (string) $f->genre))
                ->map(fn ($g) => strtolower(trim($g)))
                ->filter()
                ->values()
                ->all();
            return $f;
        });
        $kategorishop = KategoriShop::all();

        return view('film', compact('film', 'genre', 'coming_soon', 'chipGenres', 'kategorishop'));
    }

    public function detailfilm($id)
    {
        $kategori = Kategori::where('name', 'like', '%film%')->first();
        $film = film::all()->where('slug', 'like', $id)->first();
        $all_film = film::all()
                        ->where('kategori', $kategori->uuid)
                        ->where('uuid', '!=', $film->uuid);
        $kategorishop = KategoriShop::all();

        return view('detail-film', compact('film', 'all_film', 'kategorishop'));
    }

    public function series()
    {
        $kategori = Kategori::where('name', 'like', '%series%')->first();
        $film = film::all()->where('kategori', $kategori->uuid);
        $coming_soon = Film::whereDate('release_date', '>=', Carbon::now())
                            ->where('kategori', $kategori->uuid)
                            ->get();
        // $genre = film::selectRaw('distinct genre')
        //                 ->where('kategori', $kategori->uuid)
        //                 ->get();

        // 1) Kumpulkan semua genre mentah dari DB
        $raw = Film::where('kategori', $kategori->uuid)->pluck('genre'); // mis: ["drama, thriller", "comedy", "drama, comedy"]

        // 2) Pecah per koma, rapikan, unique, sort
        $chipGenres = $raw
            ->flatMap(fn ($s) => preg_split('/\s*,\s*/', (string) $s)) // → ["drama","thriller","comedy",...]
            ->map(fn ($g) => strtolower(trim($g)))
            ->filter()
            ->unique()
            ->sort()
            ->values();

        // 3) Siapkan data film + array genre per film (untuk data-genres)
        $genre = Film::where('kategori', $kategori->uuid)
            ->get()->map(function ($f) {
            $f->genres_array = collect(preg_split('/\s*,\s*/', (string) $f->genre))
                ->map(fn ($g) => strtolower(trim($g)))
                ->filter()
                ->values()
                ->all();
            return $f;
        });

        $kategorishop = KategoriShop::all();

        return view('series', compact('film', 'genre', 'coming_soon', 'chipGenres', 'kategorishop'));
    }

    public function detailseries($id)
    {
        $kategori = Kategori::where('name', 'like', '%series%')->first();
        $film = film::all()->where('slug', 'like', $id)->first();
        $all_film = film::all()
                        ->where('kategori', $kategori->uuid)
                        ->where('uuid', '!=', $film->uuid);
        $kategorishop = KategoriShop::all();

        return view('detail-series', compact('film', 'all_film', 'kategorishop'));
    }

    public function shop()
    {
        $shop = shop::all()->random()->limit(1)->first();
        $kategorishop = KategoriShop::all();
        $merchandise = shop::selectRaw('distinct merchandise')->get();  
        $all_merchandise = shop::all();      
        $kategorishop = KategoriShop::all();

        return view('shop', compact('shop', 'kategorishop', 'merchandise', 'all_merchandise', 'kategorishop'));
    }

    public function detailshop($id)
    {
        // dd($id);
        $shop = shop::select('uuid', 'name', 'photo', 'link', 'harga', 'detail')->where('slug', '=', $id)->first();
        $all_shop = shop::where('uuid', '!=', $shop->uuid)->limit(4)->get();
        $kategorishop = KategoriShop::all();

        return view('detail-shop', compact('shop', 'all_shop', 'kategorishop'));
    }

    public function detailkategori($id)
    {
        $shop = shop::all()->where('kategorishop', '=', $id);
        $title = shop::all()->where('kategorishop', '=', $id)->first();
        $all_shop = shop::all();
        $kategorishop = KategoriShop::all();

        return view('detail-kategori', compact('shop', 'all_shop', 'title', 'kategorishop'));
    }

    public function articles()
    {
        $articles = article::orderBy('tgl_rilis', 'DESC')->first();
        $all_articles = article::where('uuid', '!=', $articles->uuid)
                        ->orderBy('tgl_rilis', 'DESC')
                        ->get();
        $kategorishop = KategoriShop::all();

        return view('articles', compact('articles', 'all_articles', 'kategorishop'));
    }

    public function detailarticles($id)
    {
        $article = article::all()->where('slug', '=', $id)->first();
        $all_article = article::where('uuid', '!=', $article->uuid)->get();
        $kategorishop = KategoriShop::all();

        return view('detail-articles', compact('article', 'all_article', 'kategorishop'));
    }

    public function event()
    {
        $event = event::all();
        $kategorishop = KategoriShop::all();

        return view('event', compact('event', 'kategorishop'));
    }

    public function detailevent($id)
    {
        $event = event::all()->where('slug', $id)->first();
        $all_event = event::where('uuid', '!=', $event->uuid)->get();
        $kategorishop = KategoriShop::all();

        return view('detail-event', compact('event', 'all_event', 'kategorishop'));
    }

    public function membership()
    {
        // $membership = membership::all();
        $kategorishop = KategoriShop::all();

        return view('membership', compact('kategorishop'));
    }

    public function careers()
    {
        $careers = Job::all();
        $casting = Casting::all();
        $kategorishop = KategoriShop::all();

        return view('careers', compact('careers', 'casting', 'kategorishop'));
    }

    public function detailcareers($id)
    {
        $careers = job::all()->where('slug', '=', $id)->first();
        $casting = Casting::all()->where('slug', '=', $id)->first();
        $all_careers = job::all()
                            ->where('uuid', '!=', @$careers->uuid)
                            ->where('tim', @$careers->tim);
        $all_casting = Casting::all()
                                ->where('uuid', '!=', @$casting->uuid)
                                ->where('judul_film', @$casting->judul_film);
        $kategorishop = KategoriShop::all();

        return view('detail-careers', compact('careers', 'casting', 'all_careers', 'all_casting', 'kategorishop'));
    }

    public function bts()
    {
        $bts = bts::all();
        $judul = bts::selectRaw('distinct judul')->get();
        $film = film::orderBy('created_at', 'DESC')->get();
        $kategorishop = KategoriShop::all();

        return view('bts', compact('bts', 'film', 'kategorishop', 'judul'));
    }
    
}
