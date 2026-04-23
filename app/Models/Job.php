<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Job extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'position',
        'position_en',
        'tim',
        'location',
        'salary',
        'pengalaman',
        'detail',
        'detail_en',
        'status',
        'link'
    ];

    public function userCreate() {
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    public function userEdit() {
        return $this->belongsTo(User::class, 'edited_by', 'uuid');
    }
}
