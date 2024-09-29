<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory as FakerFactory;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 10; $i++) { // Adjust the number to generate more products
            $data = [
                'name'        => $faker->word,
                'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'price'       => $faker->randomFloat(2, 10, 100), // Random price between 10 and 100
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];

            // Using Query Builder
            $this->db->table('products')->insert($data);
        }
    }
}
