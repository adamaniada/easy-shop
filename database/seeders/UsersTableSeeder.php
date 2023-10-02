<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Add this import statement
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $data = [
            'name' => 'ADMIN Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin@admin.com'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $this->insertData($data);

        // Generate random data for users
        for ($i = 1; $i <= 49; $i++) {
            $data = [
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'gender' => $faker->randomElement(['M', 'F', 'A', 'NP']),
                'password' => Hash::make('password'),
                'is_seller' => $faker->boolean(10), // 10% chance of being seller
                'is_active' => $faker->boolean(80), // 80% chance of being active
                'is_banned' => $faker->boolean(10), // 10% chance of being banned
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $this->insertData($data);
        }
    }

    /**
     * Insert data into the 'users' table.
     *
     * @param array $data
     * @return void
     */
    private function insertData(array $data): void
    {
        DB::table('users')->insert($data);
    }
}
