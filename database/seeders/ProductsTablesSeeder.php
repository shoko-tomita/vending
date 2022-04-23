<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ProductsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<=5; $i++) {
        DB::table('products')->insert([
            'company_id' => "1",
            'product_name' => "テスト",
            'price' => "100",
            'stack' => "10",
            'img_path' => "fanta.jpeg",

        ]);

    }
}
}
