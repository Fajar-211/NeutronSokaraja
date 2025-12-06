<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mapel extends Model
{
    /** @use HasFactory<\Database\Factories\MapelFactory> */
    use HasFactory;
    protected $fillable = ['nama_mapel', 'slug'];
    // protected $with = ['diajar', 'diambil', 'punya', 'absen'];
    public function diajar(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'pivot_mapel_pengajar' ,'mapel_id','pengajar_id');
    }
    public function diambil(): BelongsToMany
    {
        return $this->belongsToMany(Siswa::class, 'pivot_siswa_mapel' ,'mapel_id','siswa_id');
    }
    public function punya(): HasMany
    {
        return $this->hasMany(Nilai::class, 'mapel_id');
    }
    public function absen(): HasMany
    {
        return $this->hasMany(Absensi::class, 'mapel_id');
    }
}
