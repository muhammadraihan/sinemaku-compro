<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilmCredit extends Model
{
    protected $fillable = [
        'film_id',
        'role',
        'name'
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
