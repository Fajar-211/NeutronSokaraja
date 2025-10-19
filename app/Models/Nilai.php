<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nilai extends Model
{
    /** @use HasFactory<\Database\Factories\NilaiFactory> */
    use HasFactory;
    protected $fillable = ['siswa_id', 'pengajar_id', 'mapel_id', 'nilai', 'tanggal', 'catatan'];
    protected $with = ['diawasi', 'milik', 'mapel'];
    public function diawasi(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengajar_id');
    }
    public function milik(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
    
}
