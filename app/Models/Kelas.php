<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    /** @use HasFactory<\Database\Factories\KelasFactory> */
    use HasFactory;
    protected $fillable = ['kelas', 'category_id'];
    protected $with = ['category'];
        public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
    public function absen(): HasMany
    {
        return $this->hasMany(Absensi::class, 'kelas_id');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function jadwal(): HasMany
    {
        return $this->hasMany(Schedule::class, 'kelas_id');
    }
}
