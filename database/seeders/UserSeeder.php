<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users =  [
            ['nom' => 'Ndiaye', 'prenom' => 'Ndiaye', 'role' => 'admin',  'remember_token' => Str::random(10),'email' => 'souleymane@gmail.com.com' , 'password' => bcrypt('secret')],
            ['nom' => 'Fall', 'prenom' => 'Oumy', 'role' => 'personnel',  'remember_token' => Str::random(10),'email' => 'oumy@gmail.com', 'password' => bcrypt('secret')],
            ['nom' => 'Barro', 'prenom' => 'Amadou', 'role' =>'membre', 'remember_token' => Str::random(10), 'email' => 'boro.@gmail.com', 'password' => bcrypt('secret')],
            ['nom' => 'Ndiaye', 'prenom' => 'Mamadou', 'role' => 'personnel', 'remember_token' => Str::random(10), 'email' => 'mamadou@gmail.com', 'password' => bcrypt('secret')],
            ['nom' => 'Fall', 'prenom' => 'Habs', 'remember_token' => Str::random(10),'role' =>'membre', 'email' => 'fouad@gmail.com', 'password' => bcrypt('secret')],



        ];
        foreach ($users as $user) {
            User::create($user);
        }

    }
}
