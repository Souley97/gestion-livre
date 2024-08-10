<?php

namespace Database\Seeders;

use App\Models\Livre;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class LivreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Livre::factory(10)->create();
    }
}
