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
        // Variables for the redesigned welcome.blade.php (v2-visual-restyle branch)
        $films = Film::with('Categories')->orderBy('release_date', 'desc')->get();
        $latestEvent = Event::orderBy('tgl_event', 'desc')->first();
        $latestFilm = Film::with('Categories')
            ->whereHas('Categories', fn($q) => $q->where('name', 'Film'))
            ->orderBy('release_date', 'desc')
            ->first();
        $latestMerch = Shop::latest()->first();
        $latestSerial = Film::with('Categories')
            ->whereHas('Categories', fn($q) => $q->where('name', 'Series'))
            ->orderBy('release_date', 'desc')
            ->first();
        $latestArtikel = Article::orderBy('tgl_rilis', 'desc')->first();
        $latestTvShow = Film::with('Categories')
            ->whereHas('Categories', fn($q) => $q->where('name', 'Sinetron'))
            ->orderBy('release_date', 'desc')
            ->first();

        return view('welcome', compact(
            'films',
            'latestEvent',
            'latestFilm',
            'latestMerch',
            'latestSerial',
            'latestArtikel',
            'latestTvShow'
        ));
    }

    public function about()
    {
        $kategorishop = KategoriShop::all();
        return view('about', compact('kategorishop'));
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
        $films = film::all()->where('slug', 'like', $id)->first();
        $all_film = film::all()
                        ->where('kategori', $kategori->uuid)
                        ->where('uuid', '!=', $films->uuid);
        $kategorishop = KategoriShop::all();

        //BTS
        $bts = bts::all();
        $judul = bts::selectRaw('distinct judul')->get();
        $film = film::where('slug', 'like', $id)
                    ->orderBy('created_at', 'DESC')->get();
        
        //SHOP
        $shopData = [
            'shop' => shop::all()->random()->limit(1)->first(),
            'kategorishop' => KategoriShop::all(),
            'merchandise' => shop::selectRaw('distinct merchandise')->where('merchandise', '=', $film[0]->title)->get(),
            'all_merchandise' => shop::all(),
            'kategorishop' => KategoriShop::all(),
        ];

        // --- [BARU] render sections dari shop.blade.php ---
        $sections = view('shop', $shopData)->renderSections();
        $shopCollectionHtml = $sections['collection'] ?? ''; // kalau tidak ada, kosong

        return view('detail-film', compact(
            'films', 'all_film', 'kategorishop', 'bts', 'judul', 'film', 'shopCollectionHtml'
        ));

        // return view('detail-film', compact('films', 'all_film', 'kategorishop', 'bts', 'judul', 'film'));
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
        $films = film::all()->where('slug', 'like', $id)->first();
        $all_film = film::all()
                        ->where('kategori', $kategori->uuid)
                        ->where('uuid', '!=', $films->uuid);
        $kategorishop = KategoriShop::all();

        //BTS
        $bts = bts::all();
        $judul = bts::selectRaw('distinct judul')->get();
        $film = film::where('slug', 'like', $id)
                    ->orderBy('created_at', 'DESC')->get();

        //SHOP
        $shopData = [
            'shop' => shop::all()->random()->limit(1)->first(),
            'kategorishop' => KategoriShop::all(),
            'merchandise' => shop::selectRaw('distinct merchandise')->where('merchandise', '=', $film[0]->title)->get(),
            'all_merchandise' => shop::all(),
            'kategorishop' => KategoriShop::all(),
        ];

        // --- [BARU] render sections dari shop.blade.php ---
        $sections = view('shop', $shopData)->renderSections();
        $shopCollectionHtml = $sections['collection'] ?? ''; // kalau tidak ada, kosong

        return view('detail-series', compact('films', 'all_film', 'kategorishop', 'bts', 'judul', 'film', 'shopCollectionHtml'));
    }

    public function television()
    {
        $kategori = Kategori::where('name', 'like', '%sinetron%')->first();
        $film = film::all()->where('kategori', $kategori->uuid);
        $coming_soon = Film::whereDate('release_date', '>=', Carbon::now())
                            ->where('kategori', $kategori->uuid)
                            ->get();

        $raw = Film::where('kategori', $kategori->uuid)->pluck('genre');

        $chipGenres = $raw
            ->flatMap(fn ($s) => preg_split('/\s*,\s*/', (string) $s)) 
            ->map(fn ($g) => strtolower(trim($g)))
            ->filter()
            ->unique()
            ->sort()
            ->values();

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

        return view('television', compact('film', 'genre', 'coming_soon', 'chipGenres', 'kategorishop'));
    }

    public function detailtelevision($id)
    {
        $kategori = Kategori::where('name', 'like', '%sinetron%')->first();
        $films = film::all()->where('slug', 'like', $id)->first();
        $all_film = film::all()
                        ->where('kategori', $kategori->uuid)
                        ->where('uuid', '!=', $films->uuid);
        $kategorishop = KategoriShop::all();

        //BTS
        $bts = bts::all();
        $judul = bts::selectRaw('distinct judul')->get();
        $film = film::where('slug', 'like', $id)
                    ->orderBy('created_at', 'DESC')->get();

        //SHOP
        $shopData = [
            'shop' => shop::all()->random()->limit(1)->first(),
            'kategorishop' => KategoriShop::all(),
            'merchandise' => shop::selectRaw('distinct merchandise')->where('merchandise', '=', @$film[0]->title)->get(),
            'all_merchandise' => shop::all(),
            'kategorishop' => KategoriShop::all(),
        ];

        // --- [BARU] render sections dari shop.blade.php ---
        $sections = view('shop', $shopData)->renderSections();
        $shopCollectionHtml = $sections['collection'] ?? ''; 

        return view('detail-television', compact('films', 'all_film', 'kategorishop', 'bts', 'judul', 'film', 'shopCollectionHtml'));
    }

    public function documentary()
    {
        $kategori = Kategori::where('name', 'like', '%dokumenter%')->first();
        $film = film::all()->where('kategori', $kategori->uuid);
        $coming_soon = Film::whereDate('release_date', '>=', Carbon::now())
                            ->where('kategori', $kategori->uuid)
                            ->get();

        $raw = Film::where('kategori', $kategori->uuid)->pluck('genre');

        $chipGenres = $raw
            ->flatMap(fn ($s) => preg_split('/\s*,\s*/', (string) $s)) 
            ->map(fn ($g) => strtolower(trim($g)))
            ->filter()
            ->unique()
            ->sort()
            ->values();

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

        return view('documentary', compact('film', 'genre', 'coming_soon', 'chipGenres', 'kategorishop'));
    }

    public function detaildocumentary($id)
    {
        $kategori = Kategori::where('name', 'like', '%dokumenter%')->first();
        $films = film::all()->where('slug', 'like', $id)->first();
        $all_film = film::all()
                        ->where('kategori', $kategori->uuid)
                        ->where('uuid', '!=', $films->uuid);
        $kategorishop = KategoriShop::all();

        //BTS
        $bts = bts::all();
        $judul = bts::selectRaw('distinct judul')->get();
        $film = film::where('slug', 'like', $id)
                    ->orderBy('created_at', 'DESC')->get();

        //SHOP
        $shopData = [
            'shop' => shop::all()->random()->limit(1)->first(),
            'kategorishop' => KategoriShop::all(),
            'merchandise' => shop::selectRaw('distinct merchandise')->where('merchandise', '=', @$film[0]->title)->get(),
            'all_merchandise' => shop::all(),
            'kategorishop' => KategoriShop::all(),
        ];

        // --- [BARU] render sections dari shop.blade.php ---
        $sections = view('shop', $shopData)->renderSections();
        $shopCollectionHtml = $sections['collection'] ?? ''; 

        return view('detail-documentary', compact(
            'films', 'all_film', 'kategorishop', 'bts', 'judul', 'film', 'shopCollectionHtml'
        ));
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
