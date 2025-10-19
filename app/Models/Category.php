<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    protected $fillable = ['category', 'slug', 'color'];
    // protected $with = ['kelas'];
    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class, 'category_id');
    }
}
