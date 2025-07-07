<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 1; $i <= 200; $i++) {
            DB::table('movies')->insert([
                'mName' => "映画" . $i,
                'date' => $faker->date,
                'time' => $faker->numberBetween(60, 180),
                'created_at' => now(),
                'updated_at' => now(),
                'image' => "NoImage.png"
            ]);
        };
        for ($i = 1; $i <= 200; $i++) {
            $genres = $faker->randomElements([1,2,3,4,5,6,7,8,9,10,11,12,13,14],3);
            foreach ($genres as $genre)
            {
                DB::table('belonging_genres')->insert([
                    'mID' => $i,
                    'gID' => $genre,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        };
    }
}
