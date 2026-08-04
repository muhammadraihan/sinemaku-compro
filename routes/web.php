<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ===== import controller =====
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriShopController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CastingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\BehindTheSceneController;
use App\Http\Controllers\PhykController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\ArtikelKategoriController;
use App\Http\Controllers\EventKategoriController;

// ===== home (About page is now the main landing) =====
Route::get('/', [FrontEndController::class, 'about'])->name('welcome');
Route::get('/home', [FrontEndController::class, 'index'])->name('hero');

// ===== frontend =====
Route::get('/about', function() { return redirect()->route('welcome'); });
Route::get('/langkah-kami', [FrontEndController::class, 'tentang'])->name('tentang');
Route::redirect('/tentang-kami', '/langkah-kami', 301);

Route::redirect('/karya-kami', '/karya-kami/film', 301)->name('karya-kami');
Route::get('/karya-kami/film', [FrontEndController::class, 'film'])->name('film');
Route::redirect('/films', '/karya-kami/film', 301);
Route::get('/detail-films/{slug}', [FrontEndController::class, 'detailfilm'])->name('detail-film');
Route::get('/karya-kami/serial', [FrontEndController::class, 'series'])->name('series');
Route::redirect('/serial', '/karya-kami/serial', 301);
Route::get('/detail-serial/{slug}', [FrontEndController::class, 'detailseries'])->name('detail-series');
Route::get('/karya-kami/televisi', [FrontEndController::class, 'television'])->name('tv');
Route::redirect('/tv', '/karya-kami/televisi', 301);
Route::get('/detail-tv/{slug}', [FrontEndController::class, 'detailtelevision'])->name('detail-tv');
Route::get('/detail-television/{slug}', [FrontEndController::class, 'detailtelevision'])->name('detail-television');
Route::get('/shop', [FrontEndController::class, 'shop'])->name('shop');
Route::get('/detail-shop/{slug}', [FrontEndController::class, 'detailshop'])->name('detail-shop');
Route::get('/detail-categories/{slug}', [FrontEndController::class, 'detailkategori'])->name('detail-kategori');
Route::get('/article', [FrontEndController::class, 'articles'])->name('articles');
Route::get('/detail-article/{slug}', [FrontEndController::class, 'detailarticles'])->name('detail-articles');
// Route::get('/events', [FrontEndController::class, 'event'])->name('event');
// Route::redirect('/events', '/events/gala-premiere')->name('event');
Route::redirect('/ruang-temu', '/ruang-temu/gala-premiere', 301)->name('events.index');
Route::get('/ruang-temu/gala-premiere', [FrontEndController::class, 'galaPremiere'])->name('events.gala');
Route::get('/ruang-temu/sinemaku-day', [FrontEndController::class, 'sinemakuDay'])->name('events.sinemaku-day');
Route::get('/ruang-temu/special-event', [FrontEndController::class, 'specialEvent'])->name('events.special-event');
Route::get('/ruang-temu/roadshow', [FrontEndController::class, 'roadshow'])->name('events.roadshow');
Route::get('/ruang-temu/goes-to-school', [FrontEndController::class, 'goesToSchool'])->name('events.goes-to-school');
Route::get('/ruang-temu/jaff-market', [FrontEndController::class, 'jaffMarket'])->name('events.jaff-market');
Route::redirect('/events', '/ruang-temu/gala-premiere', 301);
Route::redirect('/events/gala-premiere', '/ruang-temu/gala-premiere', 301);
Route::redirect('/events/sinemaku-day', '/ruang-temu/sinemaku-day', 301);
Route::redirect('/events/special-event', '/ruang-temu/special-event', 301);
Route::redirect('/events/roadshow', '/ruang-temu/roadshow', 301);
Route::redirect('/events/goes-to-school', '/ruang-temu/goes-to-school', 301);
Route::redirect('/events/jaff-market', '/ruang-temu/jaff-market', 301);
// Route::get('/detail-events/{slug}', [FrontEndController::class, 'detailevent'])->name('detail-event');
Route::redirect('/membership', '/pintu-terbuka', 301);
Route::post('/membership/register', [App\Http\Controllers\MembershipAuthController::class, 'register'])->name('membership.register');
Route::get('/membership/register', function () {return redirect()->route('careers');});
Route::post('/membership/login', [App\Http\Controllers\MembershipAuthController::class, 'login'])->name('membership.login');
Route::get('/membership/login', function () {return redirect()->route('careers');});
Route::post('/membership/logout', [App\Http\Controllers\MembershipAuthController::class, 'logout'])->name('membership.logout');
Route::get('/pintu-terbuka', [FrontEndController::class, 'careers'])->name('careers');
Route::redirect('/careers', '/pintu-terbuka', 301);
// Route::get('/detail-careers/{slug}', [FrontEndController::class, 'detailcareers'])->name('detail-careers');
Route::get('/bts', [FrontEndController::class, 'bts'])->name('bts');
Route::get('/karya-kami/dokumenter', [FrontEndController::class, 'documentary'])->name('documentary');
Route::redirect('/documentary', '/karya-kami/dokumenter', 301);
Route::get('/detail-documentary/{slug}', [FrontEndController::class, 'detaildocumentary'])->name('detail-documentary');
Route::get('/search', [FrontEndController::class, 'index'])->name('search.index');

// ===== SPA partial endpoints (JSON) =====
Route::get('/api/films/{slug}/partial', [FrontEndController::class, 'detailfilmPartial'])->name('api.film.partial');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'backoffice', 'middleware' => ['auth']], function () {
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
    Route::resource('kategorishop', 'KategoriShopController');
    Route::resource('shop', 'ShopController');
    Route::resource('article', 'ArticleController');
    Route::resource('job', 'JobController');
    Route::resource('casting', 'CastingController');
    Route::resource('event', 'EventController');
    Route::resource('phyk', 'PhykController');
    Route::resource('membership', 'MembershipController');
    Route::resource('bts', 'BehindTheSceneController');
    Route::resource('slide', 'SlideController');
    Route::get('get-kategori', [KategoriController::class, 'show'])->name('ref.kategori');
    Route::get('membership/export', [MembershipController::class, 'export'])->name('membership.export');
    Route::get('get-data', [MembershipController::class,'listData'])->name('membership.search');
    Route::get('phyk/export', [PhykController::class, 'export'])->name('phyk.export');
    Route::get('get-data-phyk', [PhykController::class,'listData'])->name('phyk.search');
    // About page CMS
    Route::get('settings/about', [SiteSettingController::class, 'aboutIndex'])->name('settings.about');
    Route::post('settings/about', [SiteSettingController::class, 'aboutUpdate'])->name('settings.about.update');
    // Membership page CMS
    Route::get('settings/membership', [SiteSettingController::class, 'membershipIndex'])->name('settings.membership');
    Route::post('settings/membership', [SiteSettingController::class, 'membershipUpdate'])->name('settings.membership.update');
    // Episodes
    Route::resource('episode', 'EpisodeController');
    // Article categories
    Route::resource('artikel-kategori', 'ArtikelKategoriController');
    // Event categories
    Route::post('event-kategori/reorder', 'EventKategoriController@reorder')->name('event-kategori.reorder');
    Route::resource('event-kategori', 'EventKategoriController');
});
