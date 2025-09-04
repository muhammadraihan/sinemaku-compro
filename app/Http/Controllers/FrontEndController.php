<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\film;
use App\Models\Shop;
use App\Models\Article;
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
        $film = film::all();
        $shop = shop::select('uuid','name', 'photo')
                ->where('highlight', '=', 'Y')
                ->get();
        $article = article::select('uuid','kategori', 'link', 'photo', 'judul', 'title', 'created_at')
                            ->orderBy('created_at')
                            ->limit(1)
                            ->get();
        $all_article = article::select('uuid','kategori', 'link', 'photo', 'judul', 'title', 'created_at')
                            ->where('uuid', '!=', $article[0]->uuid)
                            ->limit(4)
                            ->orderBy('created_at')
                            ->get();
        $careers = job::all();
        $coming_soon = Film::whereDate('release_date', '>=', Carbon::now())
                            ->get();
        $spotlight1 = film::all()->random();
        $spotlight2 = film::all()->random();
        return view('welcome',compact('film', 'shop', 'article', 'careers', 'all_article', 'coming_soon', 'spotlight1', 'spotlight2'));
    }

    public function film()
    {
        $kategori = Kategori::where('name', 'like', '%film%')->first();
        $film = film::all()->where('kategori', $kategori->uuid);
        $coming_soon = Film::whereDate('release_date', '>=', Carbon::now())
                            ->where('kategori', $kategori->uuid)
                            ->get();
        $genre = film::selectRaw('distinct genre')
                        ->where('kategori', $kategori->uuid)
                        ->get();

        return view('film', compact('film', 'genre', 'coming_soon'));
    }

    public function detailfilm($id)
    {
        $kategori = Kategori::where('name', 'like', '%film%')->first();
        $film = film::all()->where('uuid', 'like', $id)->first();
        $all_film = film::all()->where('kategori', $kategori->uuid);

        return view('detail-film', compact('film', 'all_film'));
    }

    public function series()
    {
        $kategori = Kategori::where('name', 'like', '%series%')->first();
        $film = film::all()->where('kategori', $kategori->uuid);
        $coming_soon = Film::whereDate('release_date', '>=', Carbon::now())
                            ->where('kategori', $kategori->uuid)
                            ->get();
        $genre = film::selectRaw('distinct genre')
                        ->where('kategori', $kategori->uuid)
                        ->get();

        return view('series', compact('film', 'genre', 'coming_soon'));
    }

    public function detailseries($id)
    {
        $kategori = Kategori::where('name', 'like', '%series%')->first();
        $film = film::all()->where('uuid', 'like', $id)->first();
        $all_film = film::all()->where('kategori', $kategori->uuid);

        return view('detail-series', compact('film', 'all_film'));
    }

    public function shop()
    {
        $shop = shop::all()->random()->limit(1)->first();
        $kategorishop = KategoriShop::all();
        $merchandise = shop::selectRaw('distinct merchandise')->get();  
        $all_merchandise = shop::all();      

        return view('shop', compact('shop', 'kategorishop', 'merchandise', 'all_merchandise'));
    }

    public function detailshop($id)
    {
        // dd($id);
        $shop = shop::select('name', 'photo', 'link', 'harga', 'detail')->where('uuid', '=', $id)->first();
        $all_shop = shop::all();

        return view('detail-shop', compact('shop', 'all_shop'));
    }

    public function detailkategori($id)
    {
        $shop = shop::all()->where('kategorishop', '=', $id);
        $title = shop::all()->where('kategorishop', '=', $id)->first();
        $all_shop = shop::all();

        return view('detail-kategori', compact('shop', 'all_shop', 'title'));
    }

    public function articles()
    {
        $articles = article::orderBy('tgl_rilis', 'DESC')->first();
        $all_articles = article::where('uuid', '!=', $articles->uuid)
                        ->orderBy('tgl_rilis', 'DESC')
                        ->get();

        return view('articles', compact('articles', 'all_articles'));
    }

    public function detailarticles($id)
    {
        $article = article::all()->where('uuid', '=', $id)->first();
        $all_article = article::all();

        return view('detail-articles', compact('article', 'all_article'));
    }

    public function event()
    {
        $event = event::all();

        return view('event', compact('event'));
    }

    public function detailevent($id)
    {
        $event = event::all()->where('uuid', $id)->first();
        $all_event = event::where('uuid', '!=', $event->uuid)->get();

        return view('detail-event', compact('event', 'all_event'));
    }

    public function membership()
    {
        // $membership = membership::all();

        return view('membership');
    }

    public function careers()
    {
        $careers = Job::all();
        $casting = Casting::all();

        return view('careers', compact('careers', 'casting'));
    }

    public function detailcareers($id)
    {
        $careers = job::all()->where('uuid', '=', $id)->first();
        $casting = Casting::all()->where('uuid', '=', $id)->first();
        $all_careers = job::all()->where('uuid', '!=', @$careers->uuid);
        $all_casting = Casting::all()->where('uuid', '!=', @$casting->uuid);

        return view('detail-careers', compact('careers', 'casting', 'all_careers', 'all_casting'));
    }
    
}
