<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Materiel;
use Faker\Factory as Faker;


class MaterielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            Materiel::create([
                'type' => $faker->randomElement(['Type A', 'Type B', 'Type C']),
                'marque' => $faker->word,
                'model' => $faker->word,
                'numero_serie' => $faker->unique()->ean13,
                'numero_inventaire' => $faker->unique()->ean13,
                'etat' => $faker->randomElement(['bonne', 'moyenne', 'mauvaise', 'réforme']),
                'description' => $faker->sentence,
                'site_id' => $faker->numberBetween(1, 10) // Assuming you have 10 sites
            ]);
        }
    }
}
