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
Route::get('/tentang-kami', [FrontEndController::class, 'tentang'])->name('tentang');
Route::get('/films', [FrontEndController::class, 'film'])->name('film');
Route::get('/detail-films/{slug}', [FrontEndController::class, 'detailfilm'])->name('detail-film');
Route::get('/serial', [FrontEndController::class, 'series'])->name('series');
Route::get('/detail-serial/{slug}', [FrontEndController::class, 'detailseries'])->name('detail-series');
Route::get('/tv', [FrontEndController::class, 'television'])->name('tv');
Route::get('/detail-tv/{slug}', [FrontEndController::class, 'detailtelevision'])->name('detail-tv');
Route::get('/detail-television/{slug}', [FrontEndController::class, 'detailtelevision'])->name('detail-television');
Route::get('/shop', [FrontEndController::class, 'shop'])->name('shop');
Route::get('/detail-shop/{slug}', [FrontEndController::class, 'detailshop'])->name('detail-shop');
Route::get('/detail-categories/{slug}', [FrontEndController::class, 'detailkategori'])->name('detail-kategori');
Route::get('/article', [FrontEndController::class, 'articles'])->name('articles');
Route::get('/detail-article/{slug}', [FrontEndController::class, 'detailarticles'])->name('detail-articles');
Route::get('/events', [FrontEndController::class, 'event'])->name('event');
Route::get('/events/gala-premiere', [FrontEndController::class, 'galaPremiere'])->name('events.gala');
Route::get('/events/sinemaku-day', [FrontEndController::class, 'sinemakuDay'])->name('events.sinemaku-day');
Route::get('/detail-events/{slug}', [FrontEndController::class, 'detailevent'])->name('detail-event');
Route::get('/membership', [FrontEndController::class, 'membership'])->name('frontend.membership');
Route::post('/membership/register', [App\Http\Controllers\MembershipAuthController::class, 'register'])->name('membership.register');
Route::get('/membership/register', function() { return redirect()->route('frontend.membership'); });
Route::post('/membership/login', [App\Http\Controllers\MembershipAuthController::class, 'login'])->name('membership.login');
Route::get('/membership/login', function() { return redirect()->route('frontend.membership'); });
Route::post('/membership/logout', [App\Http\Controllers\MembershipAuthController::class, 'logout'])->name('membership.logout');
Route::get('/careers', [FrontEndController::class, 'careers'])->name('careers');
Route::get('/detail-careers/{slug}', [FrontEndController::class, 'detailcareers'])->name('detail-careers');
Route::get('/bts', [FrontEndController::class, 'bts'])->name('bts');
Route::get('/documentary', [FrontEndController::class, 'documentary'])->name('documentary');
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
