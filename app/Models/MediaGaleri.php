<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediaGaleri extends Model
{
    protected $table = 'media_galeris';

    protected $primaryKey = 'id_media';

    protected $fillable = [
        'id_album',
        'kategori',
        'file',
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(
            AlbumGaleri::class,
            'id_album',
            'id_album'
        );
    }
}