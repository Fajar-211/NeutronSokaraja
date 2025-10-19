<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Mapel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pertemuan>
 */
class PertemuanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pengajar_id' => User::factory(),
            'mapel_id' => Mapel::factory(),
            'tanggal' => now()
        ];
    }
}
