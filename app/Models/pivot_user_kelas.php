<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pivot_user_kelas extends Model
{
    /** @use HasFactory<\Database\Factories\PivotUserKelasFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'kelas_id'];

        public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

}
