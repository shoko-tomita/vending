<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\Update;

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

/**
     * 指定ユーザーのプロフィール表示
     *
     * @param  int  $id
     * @return View
     */
    public function showDisp($id)
    {
        return view('disp', ['product' => Product::findOrFail($id)]);
    }

    public function showEdit(int $id)
        {
            \Log::info("showEdit");
            $product = Product::findOrFail($id);
            return view('edit',['product' => $product ,]);
        }

    public function update(int $id, Update $request)
    {
        $product = Product::findOrFail($id)-> first();
        $product->company_name = $request->company_name;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->stack = $request->stack;
        $product->comment = $request->comment;
        $product->img_path = $request->img_path;

        $product->save();
        return redirect()->route('disp',['id' => $id ,]);
        // return redirect('mypage_office/office');
    }

}
