<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Utbkscore extends Model
{
    /** @use HasFactory<\Database\Factories\UtbkscoreFactory> */
    use HasFactory;
    protected $fillable = ['peserta_id', 'utbk_id', 'score'];
    protected $with = ['note', 'utbk'];
    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class, 'peserta_id');
    }
    public function utbk(): BelongsTo
    {
        return $this->belongsTo(Utbk::class, 'utbk_id');
    }
}
