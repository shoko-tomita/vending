<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\UpdateFormRequest;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function showCreate()
    {
        \Log::info("showcreate");
        return view('create');
    }

    // スレッド作成された時のバリデーションDBに値を保存、リダイレクト
    public function newCreate(UpdateFormRequest $request)
    {
        // dd($request);
        // バリデーション
        $this->validate($request, [
            'product_name' => 'required',
            'price' => 'required',
            'stack' => 'required',
            'comment' => 'required',
            'stack' => 'required',
            'comment' => 'required',
            // 'img_path' => 'required',

        ]);
        // dd($request);
        // DBインサート
        $user = new Product();
        $user->company_id = Auth::id();
        $user->product_name = $request->input('product_name');
        $user->price = $request->input('price');
        $user->stack = $request->input('stack');
        $user->comment = $request->input('comment');
        $user->img_path = $request->input('img_path');

        // $user = Product::find($request->id);
        // $user->product_name = $request->product_name;
        // $user->price = $request->price;
        // $user->stack = $request->stack;
        // $user->comment = $request->comment;
        // $user->img_path = $request->img_path;

        // 保存
        $user->save();
        \Log::info("newCreate");
        // リダイレクト
        return redirect('/');
    }


    public function show()
    {
        $products = Product::all();

        foreach ($products as $product) {
            $company_id = $product->company_id;
            $company_name = Company::find($company_id)->company_name;
            $product['company_name'] = $company_name;
        }
        //dd($products);
        return view('vending_all', ['products' => $products]);
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
        return view('edit', ['product' => $product,]);
        // return view('edit',compact('product'));
    }

    public function update(int $id, UpdateFormRequest $request)
    {

        // $inputs = $request->all();
        // dd($inputs);
        // \DB::beginTransaction();
        // try{
        //     $product = Product::find($inputs['id']);
        //     \DB::commit();
        // }catch(\Throwable $e) {
        //     \DB::rollback();
        //     abort(500);
        // }

        $product = Product::findOrFail($id)-> first();
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->stack = $request->stack;
        $product->comment = $request->comment;
        $product->img_path = $request->img_path;
        $product->save();
        return redirect()->route('disp', ['id' => $id,]);
    }
    // public function update(int $id, UpdateFormRequest $request)
    // {
    //     $product = Product::findOrFail($id)-> first();
    //     $product->company_name = $request->company_name;
    //     $product->product_name = $request->product_name;
    //     $product->price = $request->price;
    //     $product->stack = $request->stack;
    //     $product->comment = $request->comment;
    //     $product->img_path = $request->img_path;

    //     $product->save();
    //     return redirect()->route('disp',['id' => $id ,]);
    //     // return redirect('mypage_office/office');
    // }

    // public function delete($id){

    //     // 削除対象レコードを検索
    //     $user = \App\User::findOrFail($id);

    //     // 削除
    //     $user->delete();
    //     }
}
