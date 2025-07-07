<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        if (!Storage::exists('public/images')) {
            Storage::makeDirectory('public/images');
        }
        for ($i = 1; $i <= 100; $i++) {

            $category = $faker->randomElement(['abstract', 'animals', 'business', 'cats', 'city', 'food', 'people', 'nature', 'sports']);

            $filename = 'movie_' . $i . '_image.png';
            $imagePath = $faker->image(storage_path('public/images'), 480, 640, $category, false, true, $filename, false);

            DB::table('movies')->where('mID', $i)->update(['image' => $imagePath]);

        };
    }
}
