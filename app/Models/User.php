<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'slug',
        'is_admin',
        'password',
        'avatar',
        'email_verified_at',
    ];
    // protected $with = ['mengajar', 'nilai'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function mengajar(): BelongsToMany
    {
        return $this->belongsToMany(Mapel::class, 'pivot_mapel_pengajar', 'pengajar_id','mapel_id');
    }
    // public function mengahdiri(): HasMany
    // {
    //     return $this->hasMany(Pertemuan::class, 'pengajar_id');
    // }
    public function nilai(): HasMany
    {
        return $this->hasMany(Nilai::class, 'pengajar_id');
    }
    public function absensi(): HasMany
    {
        return $this->hasMany(Absensi::class, 'user_id');
    }
    public function wali(): HasMany
    {
        return $this->hasMany(pivot_user_kelas::class, 'user_id');
    }
}
