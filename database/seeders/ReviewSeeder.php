<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 1; $i <= 100; $i++) {
            $users = $faker->randomElements([2,3,4,5,6,7,8,9],3);
            foreach ($users as $user) {
                DB::table('reviews')->insert([
                    'mID' => $i,
                    'id' => $user,
                    'star' => $faker->numberBetween(1, 5),
                    'title' => $faker->sentence,
                    'content' => $faker->paragraph,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        for ($i = 1; $i <= 50; $i++) {
            $users = $faker->randomElements([10,11,12,13,14],2);
            foreach ($users as $user) {
                DB::table('reviews')->insert([
                    'mID' => $i,
                    'id' => $user,
                    'star' => $faker->numberBetween(1, 5),
                    'title' => $faker->sentence,
                    'content' => $faker->paragraph,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        for ($i = 101; $i <= 125; $i++) {
            $users = $faker->randomElements([6,7,8,9,10],2);
            foreach ($users as $user) {
                DB::table('reviews')->insert([
                    'mID' => $i,
                    'id' => $user,
                    'star' => $faker->numberBetween(2, 5),
                    'title' => $faker->sentence,
                    'content' => $faker->paragraph,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        for ($i = 126; $i <= 175; $i++) {
            $users = $faker->randomElements([11,12,13,14,15,16],1);
            foreach ($users as $user) {
                DB::table('reviews')->insert([
                    'mID' => $i,
                    'id' => $user,
                    'star' => $faker->numberBetween(2, 4),
                    'title' => $faker->sentence,
                    'content' => $faker->paragraph,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        for ($i = 176; $i <= 190; $i++) {
            $users = $faker->randomElements([2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20],10);
            foreach ($users as $user) {
                DB::table('reviews')->insert([
                    'mID' => $i,
                    'id' => $user,
                    'star' => $faker->numberBetween(2, 4),
                    'title' => $faker->sentence,
                    'content' => $faker->paragraph,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
