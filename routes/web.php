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
    // Redirect authenticated users to the dashboard
    if (Auth::check()) {
        return redirect()->route('backoffice.dashboard');
    }

    // Hero slider — latest 5 films
    $films = App\Models\Film::with('Categories')->orderBy('release_date', 'desc')->get();

    // Section: Events
    $latestEvent = App\Models\Event::orderBy('tgl_event', 'desc')->first();

    // Section: Film (kategori = "Film")
    $latestFilm = App\Models\Film::with('Categories')
        ->whereHas('Categories', fn($q) => $q->where('name', 'Film'))
        ->orderBy('release_date', 'desc')
        ->first();

    // Section: Merch
    $latestMerch = App\Models\Shop::latest()->first();

    // Section: Serial (kategori = "Series")
    $latestSerial = App\Models\Film::with('Categories')
        ->whereHas('Categories', fn($q) => $q->where('name', 'Series'))
        ->orderBy('release_date', 'desc')
        ->first();

    // Section: Artikel
    $latestArtikel = App\Models\Article::orderBy('tgl_rilis', 'desc')->first();

    // Section: Televisi (kategori = "Sinetron")
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
});

Auth::routes(['register' => false]);

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/movies', function () {
        return view('movies');
    })->name('movies');

Route::group(['prefix' => 'backoffice', 'middleware' => ['auth']], function () {
    // backoffice
    Route::get('/', 'DashboardController@index');
    Route::get('dashboard', 'DashboardController@dashboard')->name('backoffice.dashboard');
    // logs
    Route::get('logs', 'ActivityController@index')->name('logs');
    // profile
    Route::get('profile', 'UserController@profile')->name('profile');
    Route::patch('profile/{user}/update', 'UserController@ProfileUpdate')->name('profile.update');
    Route::patch('profile/{user}/password', 'UserController@ChangePassword')->name('profile.password');
    // resource
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
