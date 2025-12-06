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
    protected $fillable = ['kelas'];
        public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
    public function absen(): HasMany
    {
        return $this->hasMany(Absensi::class, 'kelas_id');
    }
    public function wali()
{
    return $this->hasOne(pivot_user_kelas::class, 'kelas_id');
}
}
