<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Siswa extends Model
{
    /** @use HasFactory<\Database\Factories\SiswaFactory> */
    use HasFactory;
    protected $fillable = ['nama', 'slug', 'nis', 'sekolah', 'kelas_id'];
    protected $with = ['kelas'];
    public function mengambil(): BelongsToMany
    {
        return $this->belongsToMany(Mapel::class, 'pivot_siswa_mapel' ,'siswa_id','mapel_id');
    }
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    public function absen(): HasMany
    {
        return $this->hasMany(Absensi::class, 'siswa_id');
    }
    public function nilai(): HasMany
    {
        return $this->hasMany(Nilai::class, 'siswa_id');
    }
    public function note(): HasOne
    {
        return $this->hasOne(Note::class, 'siswa_id');
    }
}
