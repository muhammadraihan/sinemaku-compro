<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Uuid;

class EventPhoto extends Model
{
    use HasFactory;
    use Uuid;

    protected $table = 'event_photos';

    protected $fillable = [
        'event_uuid',
        'photo',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_uuid', 'uuid');
    }
}
