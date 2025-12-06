<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryNilai extends Model
{
    /** @use HasFactory<\Database\Factories\TemporaryNilaiFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'siswa_id', 'pengajar_id', 'mapel_id', 'absensi', 'tanggal', 'sumary'];
}
