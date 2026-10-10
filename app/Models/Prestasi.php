<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasis';
    protected $primaryKey = 'id_prestasi';
    public $timestamps = false;

    protected $fillable = [
        'nama_prestasi',
        'nama_pemenang',
        'keterangan',
        'tanggal',
        'gambar',
    ];
}