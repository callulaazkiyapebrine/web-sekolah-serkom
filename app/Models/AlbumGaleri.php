<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlbumGaleri extends Model
{
    protected $table = 'album_galeris';

    protected $primaryKey = 'id_album';

    public $timestamps = false;

    protected $fillable = [
        'judul',
        'tanggal',
        'keterangan',
    ];

    public function media(): HasMany
    {
        return $this->hasMany(
            MediaGaleri::class,
            'id_album',
            'id_album'
        );
    }
}