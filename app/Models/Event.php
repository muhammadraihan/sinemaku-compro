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
        'title',
        'tgl_event',
        'jam_event',
        'location',
        'harga',
        'detail',
        'photo',
        'link',
        'slug',
        'event_kategori_uuid',
    ];

    public function eventKategori()
    {
        return $this->belongsTo(EventKategori::class, 'event_kategori_uuid', 'uuid');
    }

    public function userCreate() {
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    public function userEdit() {
        return $this->belongsTo(User::class, 'edited_by', 'uuid');
    }
}
