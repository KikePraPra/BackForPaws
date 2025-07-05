<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('animals')->insert([
            ['specie' => 'Perro', 'created_at' => now(), 'updated_at' => now()],
            ['specie' => 'Gato', 'created_at' => now(), 'updated_at' => now()],
            ['specie' => 'Conejo', 'created_at' => now(), 'updated_at' => now()],
            ['specie' => 'Hamster', 'created_at' => now(), 'updated_at' => now()],
            ['specie' => 'Erizo', 'created_at' => now(), 'updated_at' => now()],
            ['specie' => 'Pez', 'created_at' => now(), 'updated_at' => now()],
            ['specie' => 'Tortuga', 'created_at' => now(), 'updated_at' => now()],
            ['specie' => 'Loro', 'created_at' => now(), 'updated_at' => now()],
            ['specie' => 'Canario', 'created_at' => now(), 'updated_at' => now()],
            ['specie' => 'Periquito', 'created_at' => now(), 'updated_at' => now()],
            ['specie' => 'Hurón', 'created_at' => now(), 'updated_at' => now()],
            ['specie' => 'Cuy', 'created_at' => now(), 'updated_at' => now()],
            ['specie' => 'Chinchilla', 'created_at' => now(), 'updated_at' => now()],
            ['specie' => 'Iguana', 'created_at' => now(), 'updated_at' => now()],
            ['specie' => 'Gecko', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
