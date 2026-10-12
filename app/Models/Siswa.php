<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    protected $table = 'siswas';

    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'nisn',
        'nama_siswa',
        'jenis_kelamin',
        'id_jurusan',
        'tahun_masuk',
    ];

    public $timestamps = false;

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(
            Jurusan::class,
            'id_jurusan',
            'id_jurusan'
        );
    }
}
