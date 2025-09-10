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

// ===== home =====
// Kalau mau redirect user login ke dashboard, taruh logika ini di controller:
Route::get('/', [FrontEndController::class, 'index'])->name('welcome');

// ===== frontend =====
Route::get('/films', [FrontEndController::class, 'film'])->name('film');
Route::get('/detail-films/{slug}', [FrontEndController::class, 'detailfilm'])->name('detail-film');
Route::get('/serial', [FrontEndController::class, 'series'])->name('series');
Route::get('/detail-serial/{slug}', [FrontEndController::class, 'detailseries'])->name('detail-series');
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

Auth::routes(['register' => false]);

// ===== backoffice =====
Route::prefix('backoffice')->middleware('auth')->group(function () {
    Route::redirect('/', '/backoffice/dashboard');
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('backoffice.dashboard');

    Route::get('logs', [ActivityController::class, 'index'])->name('logs');

    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::patch('profile/{user}/update', [UserController::class, 'ProfileUpdate'])->name('profile.update');
    Route::patch('profile/{user}/password', [UserController::class, 'ChangePassword'])->name('profile.password');

    Route::resources([
        'menus'        => MenuController::class,
        'users'        => UserController::class,
        'permissions'  => PermissionController::class,
        'roles'        => RoleController::class,
        'film'         => FilmController::class,
        'kategori'     => KategoriController::class,
        'kategorishop' => KategoriShopController::class,
        'shop'         => ShopController::class,
        'article'      => ArticleController::class,
        'job'          => JobController::class,
        'casting'      => CastingController::class,
        'event'        => EventController::class,
        'membership'   => MembershipController::class,
        'bts'          => BehindTheSceneController::class,
    ]);

    Route::get('get-kategori', [KategoriController::class, 'show'])->name('ref.kategori');
    Route::get('membership/export', [MembershipController::class, 'export'])->name('membership.export');
});
