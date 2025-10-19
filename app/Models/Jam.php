<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jam extends Model
{
    /** @use HasFactory<\Database\Factories\JamFactory> */
    use HasFactory;
    protected $fillable = ['start', 'end'];
    public function jadwal(): HasMany
    {
        return $this->hasMany(Schedule::class, 'jam_id');
    }
}
