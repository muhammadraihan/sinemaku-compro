<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Event extends Model
{
    use HasFactory;
    use Uuid;

    protected $table = 'events';

    protected $fillable = [
        'judul',
        'judul_en',
        'title',
        'tgl_event',
        'jam_event',
        'location',
        'location_en',
        'harga',
        'detail',
        'detail_en',
        'photo',
        'link',
        'video_link',
        'slug',
        'event_kategori_uuid',
        'film_uuid'
    ];

    public function eventKategori()
    {
        return $this->belongsTo(EventKategori::class, 'event_kategori_uuid', 'uuid');
    }

          public function film()
    {
        return $this->belongsTo(Film::class, 'film_uuid', 'uuid');
    }
    public function photos()
    {
        return $this->hasMany(EventPhoto::class, 'event_uuid', 'uuid');
    }

    public function userCreate() {
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    public function userEdit() {
        return $this->belongsTo(User::class, 'edited_by', 'uuid');
    }

}
