<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Casting extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'pemeran',
        'pemeran_en',
        'judul_film',
        'gender',
        'umur',
        'location',
        'detail',
        'detail_en',
        'deadline',
        'link',
        'shoot_date',
    ];

    public function userCreate() {
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    public function userEdit() {
        return $this->belongsTo(User::class, 'edited_by', 'uuid');
    }
}
