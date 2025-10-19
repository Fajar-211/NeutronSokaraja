<?php

namespace Database\Factories;

use App\Models\Mapel;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mapel>
 */
class MapelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nama = fake()->words(2, true);
        return [
            'nama_mapel' => $nama,
            'slug' => Str::slug($nama),
        ];
    }
}
