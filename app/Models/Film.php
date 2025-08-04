<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Film extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'kategori',
        'title',
        'genre',
        'release_date',
        'sinopsis',
        'duration',
        'season',
        'episode',
        'director',
        'cast',
        'link',
        'photo'
    ];

    public function Categories(){
        return $this->belongsTo(Kategori::class, 'kategori', 'uuid');
    }

    public function userCreate() {
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    public function userEdit() {
        return $this->belongsTo(User::class, 'edited_by', 'uuid');
    }
}
