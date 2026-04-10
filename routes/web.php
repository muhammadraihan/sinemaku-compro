<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('backoffice.dashboard');
    }

    $films = App\Models\Film::with('Categories')->orderBy('release_date', 'desc')->get();
    $latestEvent = App\Models\Event::orderBy('tgl_event', 'desc')->first();
    $latestFilm = App\Models\Film::with('Categories')
        ->whereHas('Categories', fn($q) => $q->where('name', 'Film'))
        ->orderBy('release_date', 'desc')
        ->first();
    $latestMerch = App\Models\Shop::latest()->first();
    $latestSerial = App\Models\Film::with('Categories')
        ->whereHas('Categories', fn($q) => $q->where('name', 'Series'))
        ->orderBy('release_date', 'desc')
        ->first();
    $latestArtikel = App\Models\Article::orderBy('tgl_rilis', 'desc')->first();
    $latestTvShow = App\Models\Film::with('Categories')
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
})->name('welcome');

Auth::routes(['register' => false]);

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/film', function () {
    $coming_soon = App\Models\Film::with('Categories')
        ->whereHas('Categories', fn($q) => $q->where('name', 'Film'))
        ->orderBy('release_date', 'desc')
        ->take(2)
        ->get();
    $genre = App\Models\Film::with('Categories')
        ->whereHas('Categories', fn($q) => $q->where('name', 'Film'))
        ->get();
    $chipGenres = ['Drama', 'Thriller', 'Romance', 'Comedy', 'Action', 'Horror'];
    return view('film', compact('coming_soon', 'genre', 'chipGenres'));
})->name('film');

Route::get('/film/{slug}', function ($slug) {
    $films = App\Models\Film::where('slug', $slug)->firstOrFail();
    $all_film = App\Models\Film::where('slug', '!=', $slug)->take(3)->get();
    $shopCollectionHtml = ''; 
    return view('detail-film', compact('films', 'all_film', 'shopCollectionHtml'));
})->name('detail-film');

Route::get('/series', function () {
    $coming_soon = App\Models\Film::with('Categories')
        ->whereHas('Categories', fn($q) => $q->where('name', 'Series'))
        ->orderBy('release_date', 'desc')
        ->take(2)
        ->get();
    $genre = App\Models\Film::with('Categories')
        ->whereHas('Categories', fn($q) => $q->where('name', 'Series'))
        ->get();
    $chipGenres = ['Drama', 'Thriller', 'Romance', 'Comedy', 'Action', 'Horror'];
    return view('series', compact('coming_soon', 'genre', 'chipGenres'));
})->name('series');

Route::get('/series/{slug}', function ($slug) {
    $series = App\Models\Film::where('slug', $slug)->firstOrFail();
    return view('detail-series', compact('series'));
})->name('detail-series');

Route::get('/events', function () {
    $event = App\Models\Event::orderBy('tgl_event', 'desc')->get();
    $events = $event;
    return view('event', compact('event', 'events'));
})->name('event');

Route::get('/events/{slug}', function ($slug) {
    $event = App\Models\Event::where('slug', $slug)->firstOrFail();
    return view('detail-event', compact('event'));
})->name('detail-event');

Route::get('/shop', function () {
    $merchandise = App\Models\Shop::latest()->take(4)->get();
    $all_merchandise = App\Models\Shop::all();
    $kategorishop = App\Models\Kategori::all(); 
    return view('shop', compact('merchandise', 'all_merchandise', 'kategorishop'));
})->name('shop');

Route::get('/shop/category/{slug}', function ($slug) {
    $kategori = App\Models\Kategori::where('uuid', $slug)->firstOrFail();
    return view('detail-kategori', compact('kategori'));
})->name('detail-kategori');

Route::get('/shop/product/{slug}', function ($slug) {
    $shop = App\Models\Shop::where('slug', $slug)->firstOrFail();
    return view('detail-shop', compact('shop'));
})->name('detail-shop');

Route::get('/community', function () {
    return view('membership');
})->name('frontend.membership');

Route::post('/community/join', function () {
    return redirect()->back()->with('success', 'Thank you for joining our community!');
})->name('membership.store');

Route::get('/articles', function () {
    $all = App\Models\Article::orderBy('tgl_rilis', 'desc')->get();
    $articles = $all->first();
    $all_articles = $all->skip(1);
    return view('articles', compact('articles', 'all_articles'));
})->name('articles');

Route::get('/articles/{slug}', function ($slug) {
    $article = App\Models\Article::where('slug', $slug)->firstOrFail();
    return view('detail-articles', compact('article'));
})->name('detail-articles');

Route::get('/careers', function () {
    $careers = App\Models\Job::all();
    $casting = App\Models\Casting::all();
    return view('careers', compact('careers', 'casting'));
})->name('careers');

Route::get('/careers/{slug}', function ($slug) {
    $job = App\Models\Job::where('slug', $slug)->firstOrFail();
    return view('detail-careers', compact('job'));
})->name('detail-careers');

Route::get('/bts', function () {
    return view('bts');
})->name('bts');

Route::get('/tv', function () {
    return view('welcome');
})->name('tv');

Route::get('/documentary', function () {
    return view('welcome');
})->name('documentary');

Route::get('/search', function () {
    return view('welcome');
})->name('search.index');

Route::group(['prefix' => 'backoffice', 'middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('dashboard', 'DashboardController@dashboard')->name('backoffice.dashboard');
    Route::get('logs', 'ActivityController@index')->name('logs');
    Route::get('profile', 'UserController@profile')->name('profile');
    Route::patch('profile/{user}/update', 'UserController@ProfileUpdate')->name('profile.update');
    Route::patch('profile/{user}/password', 'UserController@ChangePassword')->name('profile.password');
    Route::resource('menus', 'MenuController');
    Route::resource('users', 'UserController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('roles', 'RoleController');
    Route::resource('film', 'FilmController');
    Route::resource('kategori', 'KategoriController');
    Route::resource('shop', 'ShopController');
    Route::resource('article', 'ArticleController');
    Route::resource('job', 'JobController');
    Route::resource('casting', 'CastingController');
    Route::get('get-kategori', [KategoriController::class,'show'])->name('ref.kategori');
});
