<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Shop extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'name',
        'judul',
        'detail',
        'harga',
        'discount',
        'link',
        'photo',
        'highlight',
        'merchandise',
        'kategorishop'
    ];

    public function Categories(){
        return $this->belongsTo(KategoriShop::class, 'kategorishop', 'uuid');
    }

    public function userCreate() {
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    public function userEdit() {
        return $this->belongsTo(User::class, 'edited_by', 'uuid');
    }
}
