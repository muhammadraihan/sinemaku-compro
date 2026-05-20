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
use App\Models\SiteSetting;
use App\Models\ArtikelKategori;
use App\Models\EventKategori;
use App\Models\HeroSlide;
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
        $settings     = SiteSetting::getGroup('about');
        $heroSlides   = HeroSlide::orderBy('sort_order')->get();
        return view('about', compact('kategorishop', 'settings', 'heroSlides'));
    }

    public function film()
    {
        $kategori = Kategori::where('name', 'like', '%film%')->first();



                if (!$kategori) {
            return abort(404, 'Category Film not found');
        }
        $film = Film::where('kategori', $kategori->uuid)->orderBy('release_date', 'desc')->get();
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


        $genre = Film::where('kategori', $kategori->uuid)->orderBy('release_date', 'desc')
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
        if (!$kategori) {
            return abort(404, 'Category Film not found');
        }
        $films = Film::where('slug', $id)->first();
        $all_film = Film::where('kategori', $kategori->uuid)
                        ->where('uuid', '!=', $films->uuid)
                        ->get();
        $kategorishop = KategoriShop::all();

        //BTS
        $bts = bts::all();
        $judul = bts::selectRaw('distinct judul')->get();
        $film = Film::where('slug', $id)
                    ->orderBy('created_at', 'DESC')->get();
        
        //SHOP
        $shopData = [
            'shop' => Shop::all()->random()->limit(1)->first(),
            'kategorishop' => KategoriShop::all(),
            'merchandise' => Shop::selectRaw('distinct merchandise')->where('merchandise', '=', optional($film->first())->title)->get(),
            'all_merchandise' => Shop::all(),
        ];

        // --- [BARU] render sections dari shop.blade.php ---
        $sections = view('shop', $shopData)->renderSections();
        $shopCollectionHtml = $sections['collection'] ?? ''; // kalau tidak ada, kosong

        return view('detail-film', compact(
            'films', 'all_film', 'kategorishop', 'bts', 'judul', 'film', 'shopCollectionHtml'
        ));

        // return view('detail-film', compact('films', 'all_film', 'kategorishop', 'bts', 'judul', 'film'));
    }

    /**
     * API endpoint for SPA cinematic transition — returns JSON only.
     * Called by film-transition.js when a grid card is clicked.
     */
    public function detailfilmPartial($slug)
    {
        $kategori = Kategori::where('name', 'like', '%film%')->first();
        $films = Film::where('slug', $slug)->first();

        if (!$films) {
            return response()->json(['error' => 'Film not found'], 404);
        }

        // Extract YouTube ID
        $youtube_id = '';
        if (!empty($films->link) && preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $films->link, $match)) {
            $youtube_id = $match[1];
        }

        // Still shots
        $still_shots = $films->stillShots->map(fn($s) => [
            'photo' => str_contains($s->photo, 'http') ? $s->photo : asset('photo/' . $s->photo),
        ])->values();

        // Recommendations (other films in same category)
        $all_film = Film::where('kategori', $films->kategori)
                  ->where('uuid', '!=', $films->uuid)
                  ->take(4)
                  ->get()
                  ->map(function($f) {
                      $catName = strtolower($f->Categories->name ?? 'film');
                      $route = 'detail-film';
                      if (str_contains($catName, 'series')) $route = 'detail-series';
                      if (str_contains($catName, 'documentary')) $route = 'detail-documentary';
                      if (str_contains($catName, 'television')) $route = 'detail-television';
                      
                      return [
                          'slug'         => $f->slug,
                          'url'          => route($route, $f->slug),
                          'photo'        => asset('photo/' . $f->photo),
                          'title'        => $f->title,
                          'title_en'     => $f->title_en ?? $f->title,
                          'genre'        => $f->genre,
                          'release_date' => $f->release_date,
                      ];
                  })->values();

        // Cast list (max 3 + "and more")
        $cast_list = collect(explode(',', $films->cast))->map(fn($c) => trim($c))->filter()->values();

        return response()->json([
            'slug'         => $films->slug,
            'photo'        => asset('photo/' . $films->photo),
            'poster'       => asset('photo/' . $films->poster),
            'title'        => $films->title,
            'title_en'     => $films->title_en ?? $films->title,
            'genre'        => $films->genre,
            'release_date' => $films->release_date,
            'director'     => $films->director,
            'writer'       => $films->writer,
            'cast'         => $cast_list,
            'duration'     => $films->duration,
            'sinopsis'     => $films->sinopsis,
            'sinopsis_en'  => $films->sinopsis_en ?? $films->sinopsis,
            'youtube_id'   => $youtube_id,
            'still_shots'  => $still_shots,
            'recommendations' => $all_film,
        ]);
    }

    public function series()
    {
        $kategori = Kategori::where('name', 'like', '%series%')->first();
        if (!$kategori) {
            return abort(404, 'Category Series not found');
        }
        $film = Film::where('kategori', $kategori->uuid)->orderBy('release_date', 'desc')->get();
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


        $genre = Film::where('kategori', $kategori->uuid)->orderBy('release_date', 'desc')
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
        if (!$kategori) {
            return abort(404, 'Category Series not found');
        }
        $films = Film::where('slug', $id)->first();
        $all_film = Film::where('kategori', $kategori->uuid)
                        ->where('uuid', '!=', $films->uuid)
                        ->get();
        $kategorishop = KategoriShop::all();

        //BTS
        $bts = bts::all();
        $judul = bts::selectRaw('distinct judul')->get();
        $film = Film::where('slug', $id)
                    ->orderBy('created_at', 'DESC')->get();

        //SHOP
        $shopData = [
            'shop' => Shop::all()->random()->limit(1)->first(),
            'kategorishop' => KategoriShop::all(),
            'merchandise' => Shop::selectRaw('distinct merchandise')->where('merchandise', '=', optional($film->first())->title)->get(),
            'all_merchandise' => Shop::all(),
        ];

        // --- [BARU] render sections dari shop.blade.php ---
        $sections = view('shop', $shopData)->renderSections();
        $shopCollectionHtml = $sections['collection'] ?? ''; // kalau tidak ada, kosong

        return view('detail-series', compact('films', 'all_film', 'kategorishop', 'bts', 'judul', 'film', 'shopCollectionHtml'));
    }

    public function television()
    {
        $kategori = Kategori::where('name', 'like', '%sinetron%')->first();
        if (!$kategori) {
            return abort(404, 'Category Television not found');
        }
        $film = Film::where('kategori', $kategori->uuid)->orderBy('release_date', 'desc')->get();
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



        $genre = Film::where('kategori', $kategori->uuid)->orderBy('release_date', 'desc')
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
        if (!$kategori) {
            return abort(404, 'Category Television not found');
        }
        $films = Film::where('slug', $id)->first();
        $all_film = Film::where('kategori', $kategori->uuid)
                        ->where('uuid', '!=', $films->uuid)
                        ->get();
        $kategorishop = KategoriShop::all();

        //BTS
        $bts = bts::all();
        $judul = bts::selectRaw('distinct judul')->get();
        $film = Film::where('slug', $id)
                    ->orderBy('created_at', 'DESC')->get();

        //SHOP
        $shopData = [
            'shop' => Shop::all()->random()->limit(1)->first(),
            'kategorishop' => KategoriShop::all(),
            'merchandise' => Shop::selectRaw('distinct merchandise')->where('merchandise', '=', optional($film->first())->title)->get(),
            'all_merchandise' => Shop::all(),
        ];

        // --- [BARU] render sections dari shop.blade.php ---
        $sections = view('shop', $shopData)->renderSections();
        $shopCollectionHtml = $sections['collection'] ?? ''; 

        return view('detail-television', compact('films', 'all_film', 'kategorishop', 'bts', 'judul', 'film', 'shopCollectionHtml'));
    }

    public function documentary()
    {
        $kategori = Kategori::where('name', 'like', '%dokumenter%')->first();
        if (!$kategori) {
            // Log warning instead of hard fail or return empty collection
            $film = collect();
            $chipGenres = collect();
            $coming_soon = collect();
        } else {
            $film = Film::where('kategori', $kategori->uuid)->orderBy('release_date', 'desc')->get();
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



            $genre = Film::where('kategori', $kategori->uuid)->orderBy('release_date', 'desc')
                        ->get()->map(function ($f) {
                $f->genres_array = collect(preg_split('/\s*,\s*/', (string) $f->genre))
                    ->map(fn ($g) => strtolower(trim($g)))
                    ->filter()
                    ->values()
                    ->all();
                return $f;
            });
        }

        $kategorishop = KategoriShop::all();

        return view('documentary', compact('film', 'genre', 'coming_soon', 'chipGenres', 'kategorishop'));
    }

    public function detaildocumentary($id)
    {
        $kategori = Kategori::where('name', 'like', '%dokumenter%')->first();
        if (!$kategori) {
            return abort(404, 'Category Documentary not found');
        }
        $films = Film::where('slug', $id)->first();
        $all_film = Film::where('kategori', $kategori->uuid)
                        ->where('uuid', '!=', $films->uuid)
                        ->get();
        $kategorishop = KategoriShop::all();

        //BTS
        $bts = bts::all();
        $judul = bts::selectRaw('distinct judul')->get();
        $film = Film::where('slug', $id)
                    ->orderBy('created_at', 'DESC')->get();

        //SHOP
        $shopData = [
            'shop' => Shop::all()->random()->limit(1)->first(),
            'kategorishop' => KategoriShop::all(),
            'merchandise' => Shop::selectRaw('distinct merchandise')->where('merchandise', '=', optional($film->first())->title)->get(),
            'all_merchandise' => Shop::all(),
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
        $shop = Shop::all()->random()->limit(1)->first();
        $kategorishop = KategoriShop::all();
        $merchandise = Shop::selectRaw('distinct merchandise')->get();  
        $all_merchandise = Shop::all();      
        $kategorishop = KategoriShop::all();

        return view('shop', compact('shop', 'kategorishop', 'merchandise', 'all_merchandise', 'kategorishop'));
    }

    public function detailshop($id)
    {
        // dd($id);
        $shop = Shop::select('uuid', 'name', 'photo', 'link', 'harga', 'detail')->where('slug', '=', $id)->first();
        $all_shop = Shop::where('uuid', '!=', $shop->uuid)->limit(4)->get();
        $kategorishop = KategoriShop::all();

        return view('detail-shop', compact('shop', 'all_shop', 'kategorishop'));
    }

    public function detailkategori($id)
    {
        $shop = Shop::where('kategorishop', $id)->get();
        $title = Shop::where('kategorishop', $id)->first();
        $all_shop = Shop::all();
        $kategorishop = KategoriShop::all();

        return view('detail-kategori', compact('shop', 'all_shop', 'title', 'kategorishop'));
    }

    public function articles()
    {
        $articles = Article::with('artikelKategori')->orderBy('tgl_rilis', 'DESC')->first();
        $all_articles = Article::with('artikelKategori')->where('uuid', '!=', @$articles->uuid)
                        ->orderBy('tgl_rilis', 'DESC')
                        ->get();
        $kategorishop = KategoriShop::all();
        $artikel_kategori = ArtikelKategori::all();

        return view('articles', compact('articles', 'all_articles', 'kategorishop', 'artikel_kategori'));
    }

    public function detailarticles($id)
    {
        $article = Article::where('slug', $id)->first();
        $all_article = Article::where('uuid', '!=', $article->uuid)->get();
        $kategorishop = KategoriShop::all();

        return view('detail-articles', compact('article', 'all_article', 'kategorishop'));
    }

    public function event()
    {
        $event = Event::with('eventKategori')->orderBy('tgl_event', 'DESC')->get();
        $kategorishop = KategoriShop::all();
        $event_kategori = EventKategori::all();

        return view('event', compact('event', 'kategorishop', 'event_kategori'));
    }

    public function detailevent($id)
    {
        $event = Event::with('photos')->where('slug', $id)->firstOrFail();
        $all_event = Event::where('uuid', '!=', $event->uuid)->orderBy('tgl_event', 'DESC')->get();
        $kategorishop = KategoriShop::all();

        return view('detail-event', compact('event', 'all_event', 'kategorishop'));
    }

    public function membership()
    {
        $kategorishop = KategoriShop::all();
        $settings = \App\Models\SiteSetting::getGroup('membership');

        return view('membership', compact('kategorishop', 'settings'));
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
        $careers = Job::where('slug', $id)->first();
        $casting = Casting::where('slug', $id)->first();
        $all_careers = Job::where('uuid', '!=', @$careers->uuid)
                            ->where('tim', @$careers->tim)
                            ->get();
        $all_casting = Casting::where('uuid', '!=', @$casting->uuid)
                                ->where('judul_film', @$casting->judul_film)
                                ->get();
        $kategorishop = KategoriShop::all();

        return view('detail-careers', compact('careers', 'casting', 'all_careers', 'all_casting', 'kategorishop'));
    }

    public function bts()
    {
        $bts = bts::all();
        $judul = bts::selectRaw('distinct judul')->get();
        $film = Film::orderBy('created_at', 'DESC')->get();
        $kategorishop = KategoriShop::all();

        return view('bts', compact('bts', 'film', 'kategorishop', 'judul'));
    }
    
}
