<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\film;
use App\Models\Shop;
use App\Models\Article;

class FrontEndController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $about = About::all();
    //     $cabang = Cabang::all();
    //     $dokter = Dokter::all();
    //     $edukasi = Edukasi::all();
    //     $karir = Karir::all();
    //     $logo = Logo::all();
    //     $award = Penghargaan::all();
    //     $produk = Produk::where('label', '=', '2')->get();
    //     $treatment = Treatment::where('label', '=', '2')->get();
    //     $reseller = Reseller::all();
    //     $promo = Promo::all();
    //     $sosmed = SocialMedia::all();
    //     $youtube = Youtube::all();
    //     $newtreatment = Treatment::where('label', '=', '1')->get();
    //     $kategori = Produk_kategori::all();

    //     return view('pages.landing',
    //     compact('about', 'cabang', 'dokter', 'edukasi', 'karir', 'logo', 'award', 'kategori',
    //     'treatment', 'reseller', 'promo', 'sosmed', 'youtube', 'newtreatment', 'produk'));
    // }

    public function film()
    {
        $film = film::all();

        return view('film', compact('film'));
    }

    public function detailfilm()
    {
        $film = film::all();

        return view('detail-film', compact('film'));
    }

    public function shop()
    {
        $shop = shop::all();

        return view('shop', compact('shop'));
    }

    public function detailshop()
    {
        $shop = shop::all();

        return view('detail-shop', compact('shop'));
    }

    public function detailkategori()
    {
        $shop = shop::all();

        return view('detail-kategori', compact('shop'));
    }

    public function articles()
    {
        $articles = article::all();

        return view('articles', compact('articles'));
    }

    public function detailarticles()
    {
        $article = article::all();

        return view('detail-articles', compact('article'));
    }

    public function event()
    {
        $event = article::all();

        return view('event', compact('event'));
    }

    public function detailevent()
    {
        $event = article::all();

        return view('detail-event', compact('event'));
    }

    public function membership()
    {
        // $membership = membership::all();

        return view('membership');
    }

    public function careers()
    {
        // $careers = careers::all();

        return view('careers');
    }

    public function detailcareers()
    {
        // $careers = article::all();

        return view('detail-careers');
    }
    
}
