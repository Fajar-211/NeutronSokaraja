<?php

namespace Database\Factories;

use App\Models\Kelas;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nama = fake()->name();
        return [
            'nama' => $nama,
            'slug' => Str::slug($nama),
            'nis' => fake()->unique()->numerify(),
            'sekolah' => fake()->sentence(3),
            'kelas_id' => Kelas::factory()->create()
        ];
    }
}
