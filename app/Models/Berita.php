<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Berita extends Model
{
    protected $table = 'berita';

    protected $primaryKey = 'id_berita';

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'tanggal',
        'status',
        'id_user',
    ];

    public $timestamps = false;

    // Relasi ke user yang membuat berita
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
