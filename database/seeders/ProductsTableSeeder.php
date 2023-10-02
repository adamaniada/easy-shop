<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Création de fausses annonces
        for ($i = 0; $i < 100; $i++) {
            DB::table('products')->insert([
                'title' => $faker->word,
                'description' => $faker->paragraph,
                'unit_price' => $faker->randomFloat(2, 10, 100),
                'quantity' => $faker->numberBetween(1, 10),
                'condition' => $faker->randomElement(['Bon', 'Tres bon', 'Mauvais', 'Usé']),
                'state' => $faker->randomElement(['en attente', 'approuvé', 'desactivée', 'vendue']),
                'images_url' => json_encode([$faker->imageUrl(), $faker->imageUrl()]),
                'user_id' => $faker->numberBetween(1, 5), // Remplacez avec les IDs réels de vos utilisateurs
                'cat_id' => $faker->numberBetween(1, 15), // Remplacez avec les IDs réels de vos catégories
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
