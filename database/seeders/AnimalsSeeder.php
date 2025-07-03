<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('animals')->insert([
            ['name' => 'Perro', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gato', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Conejo', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tortuga', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Serpiente', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ave', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cerdo', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Oveja', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cabra', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vaca', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Toro', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gallina', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Burro', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Caballo', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pato', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hamster', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Erizo', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
