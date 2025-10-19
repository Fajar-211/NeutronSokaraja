<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use Database\Factories\KelasFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $kelas = Kelas::all(); // ambil kelas dari KelasSeeder

        // $siswas = Siswa::factory()
        //     ->count(8)
        //     ->recycle($kelas)
        //     ->create();

        // // attach mapel sesuai index siswa
        // $siswas[0]->mengambil()->attach([1,2,3]);
        // $siswas[1]->mengambil()->attach([3,4,5]);
        // $siswas[2]->mengambil()->attach([5,6,7]);
        // $siswas[3]->mengambil()->attach([8,9,10]);
        // $siswas[4]->mengambil()->attach([1,5,7]);
        // $siswas[5]->mengambil()->attach([3,6,8]);
        // $siswas[6]->mengambil()->attach([8,9,13]);
        // $siswas[7]->mengambil()->attach([1,2,3]);
    }
}
