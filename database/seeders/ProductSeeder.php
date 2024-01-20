<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = new Product();
        $product->name = 'Brand New Coat';
        $product->price = 1200.00;
        $product->status = 'available';
        $product->user_id = 1;
        $product->type = 'product';
        $product->save();
    }
}
