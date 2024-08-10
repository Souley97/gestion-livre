<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\LivreSeeder;
use Database\Seeders\CategorieSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // LAN
        $this->call([

            UserSeeder::class,
            CategorieSeeder::class,
            LivreSeeder::class,
            EmpruntSeeder::class,


        ]);


    }
}
