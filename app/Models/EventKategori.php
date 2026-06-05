<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class EventKategori extends Model
{
    use HasFactory;
    use Uuid;

    protected $table = 'event_kategoris';

    protected $fillable = [
        'name',
        'slug',
        'order_num',
        'created_by',
        'edited_by',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'event_kategori_uuid', 'uuid');
    }

    public function userCreate()
    {
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    public function userEdit()
    {
        return $this->belongsTo(User::class, 'edited_by', 'uuid');
    }
}
