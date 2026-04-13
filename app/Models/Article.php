<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Article extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'judul',
        'title',
        'tgl_rilis',
        'penulis',
        'detail',
        'kategori',
        'artikel_kategori_uuid',
        'link',
        'photo',
    ];

    public function artikelKategori()
    {
        return $this->belongsTo(ArtikelKategori::class, 'artikel_kategori_uuid', 'uuid');
    }

    public function userCreate() {
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    public function userEdit() {
        return $this->belongsTo(User::class, 'edited_by', 'uuid');
    }
}
