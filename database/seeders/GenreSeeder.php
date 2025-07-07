<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            'genreName' => "アクション",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('genres')->insert([
            'genreName' => "SF",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('genres')->insert([
            'genreName' => " コメディ",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('genres')->insert([
            'genreName' => "サスペンス",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('genres')->insert([
            'genreName' => "ホラー",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('genres')->insert([
            'genreName' => "スリラー",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('genres')->insert([
            'genreName' => "パニック",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('genres')->insert([
            'genreName' => "スポーツ",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('genres')->insert([
            'genreName' => "青春",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('genres')->insert([
            'genreName' => "恋愛",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('genres')->insert([
            'genreName' => "ファミリー",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('genres')->insert([
            'genreName' => "ファンタジー",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('genres')->insert([
            'genreName' => "アニメ",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('genres')->insert([
            'genreName' => "ミュージカル",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
