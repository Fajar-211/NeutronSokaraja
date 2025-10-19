<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Utbk extends Model
{
    /** @use HasFactory<\Database\Factories\UtbkFactory> */
    use HasFactory;
    protected $fillable = ['utbk'];
    // protected $with = ['utbkscore'];
    public function utbkscore(): HasMany
    {
        return $this->hasMany(Utbkscore::class, 'utbk_id');
    }
}
