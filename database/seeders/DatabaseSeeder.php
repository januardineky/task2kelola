<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'Januardi',
            'email' => 'jan@example.id',
            'phone_number' => '082376542356',
            'address' => 'Kec.Singaparna Kab.Tasikmalaya Provinsi Jawa Barat',
            'major' => 'Rekayasa Perangkat Lunak',
            'status' => 1,
            'password' => bcrypt('12345'),
            'rolename' => 'Admin'
        ]);

        User::create([
            'username' => 'Neky',
            'email' => 'neky@example.id',
            'phone_number' => '082376542356',
            'address' => 'Kp.soreang Kab.Bandung Provinsi Jawa Barat',
            'major' => 'Desain Komunikasi Visual',
            'status' => 0,
            'password' => bcrypt('12345'),
            'rolename' => 'User'
        ]);

        User::factory(19)->create();
    }
}
