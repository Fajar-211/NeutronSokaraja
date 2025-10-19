<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    /** @use HasFactory<\Database\Factories\AbsensiFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'siswa_id', 'mapel_id', 'tanggal', 'absensi' ,'sumary'];
    protected $with = ['siswa', 'mapel', 'pengajar'];
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
    public function pengajar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
