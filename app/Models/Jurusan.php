<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    protected $table = 'jurusans';

    protected $primaryKey = 'id_jurusan';

    protected $fillable = [
        'nama_jurusan',
    ];

    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class, 'id_jurusan', 'id_jurusan');
    }
}
