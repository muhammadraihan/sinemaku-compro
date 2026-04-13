<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class FilmGallery extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'uuid',
        'film_uuid',
        'episode_uuid',
        'type',
        'photo',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_uuid', 'uuid');
    }

    public function episode()
    {
        return $this->belongsTo(Episode::class, 'episode_uuid', 'uuid');
    }

    public static function uuid($uuid)
    {
        return self::where('uuid', $uuid)->first();
    }
}
