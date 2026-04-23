<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Membership extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'email',
        'city',
        'phone_number'
    ];
}
