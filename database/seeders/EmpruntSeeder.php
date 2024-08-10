<?php

namespace Database\Seeders;

use App\Models\Emprunt;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmpruntSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Emprunt::factory(10)->create();

    }
}
