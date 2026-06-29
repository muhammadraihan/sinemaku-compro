<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentary extends Model
{
    use HasFactory;
    use Uuid;

      protected $fillable = [
        'kategori',
        'title',
        'title_en',
        'genre',
        'genre_en',
        'release_date',
        'sinopsis',
        'sinopsis_en',
        'duration',
        'season',
        'episode',
        'director',
        'writer',
        'cast',
        'link',
        'link_watch',
        'photo',
        'poster',
        'slug'
    ];

     public function Documentaries(){
        return $this->belongsTo(Documentary::class, 'documentary', 'uuid');
    }
     public function bts()
    {
        // kolom foreign key di tabel bts = 'judul' yang berisi uuid film
        return $this->hasMany(BehindTheScene::class, 'judul', 'uuid');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class, 'film_uuid', 'uuid')
                    ->orderBy('season_number')
                    ->orderBy('episode_number');
    }

    public function galleries()
    {
        return $this->hasMany(FilmGallery::class, 'film_uuid', 'uuid');
    }

    public function stillShots()
    {
        return $this->hasMany(FilmGallery::class, 'film_uuid', 'uuid')->where('type', 'still_shot');
    }

    public function btsGalleries()
    {
        return $this->hasMany(FilmGallery::class, 'film_uuid', 'uuid')->where('type', 'bts');
    }

    public function userCreate() {
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    public function userEdit() {
        return $this->belongsTo(User::class, 'edited_by', 'uuid');
    }
}
