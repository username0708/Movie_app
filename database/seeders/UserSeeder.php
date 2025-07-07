<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        $admin = User::create([
            'name' => '管理者',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'age' => 21,
            'gender' => 'man',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $adminRole = Role::create(['name' => 'admin']);
        $addMoviePermission = Permission::create(['name' => 'addMovie']);
        $deleteMoviePermission = Permission::create(['name' => 'deleteMovie']);
        $editMoviePermission = Permission::create(['name' => 'editMovie']);
        $addGenrePermission = Permission::create(['name' => 'addGenre']);
        $deleteReviewPermission = Permission::create(['name' => 'deleteReview']);

        $adminRole->givePermissionTo($addMoviePermission);
        $adminRole->givePermissionTo($deleteMoviePermission);
        $adminRole->givePermissionTo($editMoviePermission);
        $adminRole->givePermissionTo($addGenrePermission);
        $adminRole->givePermissionTo($deleteReviewPermission);

        $admin->assignRole($adminRole);

        for ($i = 1; $i <= 19; $i++)
        {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'age' => $faker->numberBetween(18, 99),
                'gender' => $faker->randomElement(['man', 'woman', 'others']),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
