<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Uuid;

class Membership extends Authenticatable
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'email',
        'city',
        'phone_number',
        'password'
    ];

    protected $hidden = [
        'password',
    ];
}
