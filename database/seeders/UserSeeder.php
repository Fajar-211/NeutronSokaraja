<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $admin = User::factory()->create([
            'name' => 'ADMIN 1',
            'email' => 'nnybg@gmail.com',
            'slug' => Str::slug('ADMIN 1'),
            'is_admin' => true,
            'password' => Hash::make('adamasahaddisini990')
        ]);
        $admin = User::factory()->create([
            'name' => 'ADMIN 2',
            'email' => 'kingjar@gmail.com',
            'slug' => Str::slug('ADMIN 2'),
            'is_admin' => true,
            'password' => Hash::make('panggilakukingfajar551')
        ]);
        $admin = User::factory()->create([
            'name' => 'Ahadun',
            'email' => 'ahad@gmail.com',
            'slug' => Str::slug('Ahadun'),
            'is_admin' => true,
            'password' => Hash::make('1ahadun23')
        ]);
        $admin = User::factory()->create([
            'name' => 'Tri Santonso',
            'email' => 'paktri3@gmail.com',
            'slug' => Str::slug('Tri Santonso'),
            'is_admin' => true,
            'password' => Hash::make('1paktri23')
        ]);
        $admin = User::factory()->create([
            'name' => 'ARIYANTO TRI KUSUMO',
            'email' => 'arie@gmail.com',
            'slug' => Str::slug('ARIYANTO TRI KUSUMO'),
            'is_admin' => true,
            'password' => Hash::make('1arie23')
        ]);
        

        // //Pengajar
        // $pengajar = User::factory()->create([
        //     'name' => 'Fajar Setiawan',
        //     'email' => 'user@example.com',
        //     'is_admin' => false,
        // ]);
        // $pengajar1 = User::factory()->create([
        //     'name' => 'Nami',
        //     'email' => 'nami@example.com',
        //     'is_admin' => false,
        // ]);
        // $pengajar2 = User::factory()->create([
        //     'name' => 'Yohana',
        //     'email' => 'Yohana@example.com',
        //     'is_admin' => false,
        // ]);
        // $pengajar3 = User::factory()->create([
        //     'name' => 'Imron sidik',
        //     'email' => 'imronee@example.com',
        //     'is_admin' => false,
        // ]);
        // $pengajar4 = User::factory()->create([
        //     'name' => 'Kamal',
        //     'email' => 'kamal@example.com',
        //     'is_admin' => false,
        // ]);
        // $pengajar5 = User::factory()->create([
        //     'name' => 'Hanafi',
        //     'email' => 'hanazz@example.com',
        //     'is_admin' => false,
        // ]);
        // $pengajar6 = User::factory()->create([
        //     'name' => 'Alan',
        //     'email' => 'fufufafa@example.com',
        //     'is_admin' => false,
        // ]);
        // $pengajar7 = User::factory()->create([
        //     'name' => 'Adit',
        //     'email' => 'yoki@example.com',
        //     'is_admin' => false,
        // ]);
        // $pengajar8 = User::factory()->create([
        //     'name' => 'Alpine',
        //     'email' => 'startz@example.com',
        //     'is_admin' => false,
        // ]);
        // $pengajar9 = User::factory()->create([
        //     'name' => 'Memet',
        //     'email' => 'memet@example.com',
        //     'is_admin' => false,
        // ]);
        // $pengajar10 = User::factory()->create([
        //     'name' => 'akmal',
        //     'email' => 'mal@example.com',
        //     'is_admin' => false,
        // ]);


        // //Assign mapel ke pengajar lewat pivot
        // //Misal pengajar ngajar mapel dengan id 1
        // $pengajar->mengajar()->attach([1,3]);
        // $pengajar1->mengajar()->attach(2);
        // $pengajar2->mengajar()->attach([2,5]);
        // $pengajar3->mengajar()->attach([7,8,9]);
        // $pengajar4->mengajar()->attach([4,11,9]);
        // $pengajar5->mengajar()->attach([11,12,13]);
        // $pengajar6->mengajar()->attach([4,5,6]);
        // $pengajar7->mengajar()->attach([1,4,15]);
        // $pengajar8->mengajar()->attach([1,2,3]);
        // $pengajar9->mengajar()->attach([1]);
        // $pengajar10->mengajar()->attach([10]);
    }
}
