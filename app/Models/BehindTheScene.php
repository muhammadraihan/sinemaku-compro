<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class BehindTheScene extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'judul',
        'caption',
        'link'
    ];

    public function Judul(){
        return $this->belongsTo(Film::class, 'judul', 'uuid');
    }

    public function userCreate() {
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    public function userEdit() {
        return $this->belongsTo(User::class, 'edited_by', 'uuid');
    }
}
