<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product; // Importamos el modelo Product para poder insertar datos

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creamos el primer producto de prueba
        Product::create([
            'name' => 'Laptop Gamer Pro',
            'description' => '16GB RAM, 512GB SSD, RTX 4060',
            'price' => 1299.99,
            'stock' => 10
        ]);

        // Creamos el segundo producto de prueba
        Product::create([
            'name' => 'Mouse Óptico Inalámbrico',
            'description' => 'Ergonómico con DPI regulable',
            'price' => 25.50,
            'stock' => 50
        ]);
    }
}
