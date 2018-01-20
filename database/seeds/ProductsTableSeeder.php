<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [];
        for($i = 0; $i < 50; $i++):
            $supplier_id = rand(1, 10);
            $product_category_id = rand(1,2);
            $quantity = rand(10,20);
            $image = str_random(10).'.jpg';
            $price = rand(10, 20).'00';
        $products[] = [
            'name' => str_random(10),
            'image' => $image,
            'supplier_id' => $supplier_id,
            'product_category_id'=> $product_category_id,
            'quantity' => $quantity,
            'price' => $price,
        ];
        endfor;

        foreach($products AS $product):
        
            Product::create($product);
        endforeach;
    }
}
