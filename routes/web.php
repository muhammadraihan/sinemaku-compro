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
    // check if user is auth then redirect to dashboard page
    if (Auth::check()) {
        return redirect()->route('backoffice.dashboard');
    }
    return view('welcome');
});

Route::get('/film', 'FrontEndController@film')->name('film');
Route::get('/detail-film', 'FrontEndController@detailfilm')->name('detail-film');
Route::get('/shop', 'FrontEndController@shop')->name('shop');
Route::get('/detail-shop', 'FrontEndController@detailshop')->name('detail-shop');
Route::get('/detail-kategori', 'FrontEndController@detailkategori')->name('detail-kategori');
Route::get('/articles', 'FrontEndController@articles')->name('articles');
Route::get('/detail-articles', 'FrontEndController@detailarticles')->name('detail-articles');
Route::get('/event', 'FrontEndController@event')->name('event');
Route::get('/detail-event', 'FrontEndController@detailevent')->name('detail-event');
Route::get('/membership', 'FrontEndController@membership')->name('membership');
Route::get('/careers', 'FrontEndController@careers')->name('careers');
Route::get('/detail-careers', 'FrontEndController@detailcareers')->name('detail-careers');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'backoffice', 'middleware' => ['auth']], function () {
    // backoffice
    Route::get('/', function () {
        return redirect()->route('backoffice.dashboard');
    });
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
    Route::get('get-kategori', [KategoriController::class, 'show'])->name('ref.kategori');
});
