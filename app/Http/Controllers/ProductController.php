<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function showCreate()
        {
            \Log::info("showcreate");
            return view('create');
        }

        public function show()
        {
            $products=Product::all();


            foreach($products as $product){
                $company_id = $product->company_id;
                $company_name = Company::find($company_id)->company_name;
                $product['company_name'] = $company_name;
            }
            //dd($products);
            return view('vending_all',['products'=>$products]);
        }
}
