<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Episode extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'film_uuid',
        'season_number',
        'episode_number',
        'title',
        'title_en',
        'sinopsis',
        'sinopsis_en',
        'duration',
        'link',
        'link_trailer',
        'photo',
        'slug',
        'created_by',
        'edited_by',
    ];

    /**
     * The parent Film (Series or TV) this episode belongs to.
     */
    public function film()
    {
        return $this->belongsTo(Film::class, 'film_uuid', 'uuid');
    }

    public function userCreate()
    {
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    public function userEdit()
    {
        return $this->belongsTo(User::class, 'edited_by', 'uuid');
    }

    public function galleries()
    {
        return $this->hasMany(FilmGallery::class, 'episode_uuid', 'uuid');
    }

    public function stillShots()
    {
        return $this->hasMany(FilmGallery::class, 'episode_uuid', 'uuid')->where('type', 'still_shot');
    }

    public function btsGalleries()
    {
        return $this->hasMany(FilmGallery::class, 'episode_uuid', 'uuid')->where('type', 'bts');
    }
}
