<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Category extends Model
{
use HasFactory;
protected $fillable = ['name', 'slug', 'description'];
// Relasi: Satu Kategori MEMILIKI BANYAK Berita
public function news(): HasMany
{
return $this->hasMany(Berita::class, 'category_id');
}
}