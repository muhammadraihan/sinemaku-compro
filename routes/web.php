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

// ===== home =====
Route::get('/', [FrontEndController::class, 'index'])->name('welcome');

// ===== frontend =====
Route::get('/about', [FrontEndController::class, 'about'])->name('about');
Route::get('/films', [FrontEndController::class, 'film'])->name('film');
Route::get('/detail-films/{slug}', [FrontEndController::class, 'detailfilm'])->name('detail-film');
Route::get('/serial', [FrontEndController::class, 'series'])->name('series');
Route::get('/detail-serial/{slug}', [FrontEndController::class, 'detailseries'])->name('detail-series');
Route::get('/tv', [FrontEndController::class, 'television'])->name('tv');
Route::get('/detail-tv/{slug}', [FrontEndController::class, 'detailtelevision'])->name('detail-tv');
Route::get('/shops', [FrontEndController::class, 'shop'])->name('shop');
Route::get('/detail-shops/{slug}', [FrontEndController::class, 'detailshop'])->name('detail-shop');
Route::get('/detail-categories/{slug}', [FrontEndController::class, 'detailkategori'])->name('detail-kategori');
Route::get('/article', [FrontEndController::class, 'articles'])->name('articles');
Route::get('/detail-article/{slug}', [FrontEndController::class, 'detailarticles'])->name('detail-articles');
Route::get('/events', [FrontEndController::class, 'event'])->name('event');
Route::get('/detail-events/{slug}', [FrontEndController::class, 'detailevent'])->name('detail-event');
Route::get('/memberships', [FrontEndController::class, 'membership'])->name('frontend.membership');
Route::get('/career', [FrontEndController::class, 'careers'])->name('careers');
Route::get('/detail-career/{slug}', [FrontEndController::class, 'detailcareers'])->name('detail-careers');
Route::get('/bts', [FrontEndController::class, 'bts'])->name('bts');
Route::get('/documentary', [FrontEndController::class, 'index'])->name('documentary');
Route::resource('membership', 'MembershipController');
Route::get('/search', [FrontEndController::class, 'index'])->name('search.index');

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
    // Route::resource('membership', 'MembershipController');
    Route::resource('bts', 'BehindTheSceneController');
    Route::resource('slide', 'SlideController');
    Route::get('get-kategori', [KategoriController::class, 'show'])->name('ref.kategori');
    Route::get('membership/export', [MembershipController::class, 'export'])->name('membership.export');
    Route::get('get-data', [MembershipController::class,'listData'])->name('membership.search');
    Route::get('phyk/export', [PhykController::class, 'export'])->name('phyk.export');
    Route::get('get-data-phyk', [PhykController::class,'listData'])->name('phyk.search');
});
