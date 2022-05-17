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

        $companys = Company::all();


        return view('create',['companys'=>$companys]);
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
        $user->company_id = $request->input('company_id');
        $user->product_name = $request->input('product_name');
        $user->price = $request->input('price');
        $user->stack = $request->input('stack');
        $user->comment = $request->input('comment');
        $user->img_path = $request->input('img_path');
        // if(request('img_path')){
        //     $original = request()->file('img_path')->getClientOriginalName();
        //     $name = date('Ymd_His').'_'.$original;
        //     $file = request()->file('img_path')->move('storage/images',$name);
        //     $post->img_path=$name;
        // }

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
        $companys = Company::all();

        foreach ($products as $product) {
            $company_id = $product->company_id;
            $company_name = Company::find($company_id)->company_name;
            $product['company_name'] = $company_name;
        }
        //dd($products);
        return view('vending_all', ['products' => $products,'companys' => $companys,]);
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

    // 編集機能
    public function showEdit(int $id)
    {
        \Log::info("showEdit");
        $product = Product::findOrFail($id);
        $companys = Company::all();
        // $company_id = Product::findOrFail($id);
        $company_id =  $product->company_id;
        // dd($company_id);
        return view('edit', ['product' => $product,'companys'=>$companys,'company_id'=>$company_id,]);
        // return view('edit',compact('product'));
    }

    public function update(int $id, UpdateFormRequest $request)
    {

        $product = Product::findOrFail($id);
        $product->company_id = $request->company_id;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->stack = $request->stack;
        $product->comment = $request->comment;
        // $product->img_path = $request->img_path;
        $product->save();

        return redirect()->route('disp', ['id' => $id,]);
    }

    // 削除対象レコードを検索
    public function destroy($id)
    {
        \Log::info("destroy");
        $item = Product::findOrFail($id);
        $item->delete();
        return redirect('/');
    }

    // 検索機能
    public function search(Request $request)
    {
        \Log::info("search");
        $companys = Company::all();

        // dd($request);

        $company_id = $request->input('company_id');
        $word = $request->get('word');
        $products = Product::query();
        // dd($company_id);
        if ($word !== null) {
            $escape_word = addcslashes($word, '\\_%');
            $products->where('product_name', 'LIKE', '%' . $escape_word . '%');
            // $products = Product::where('product_name', 'LIKE', '%' . $escape_word . '%')->get();
            // dd($products);
        }

        if ($company_id !== null){
            $products->where('company_id' , $company_id );
            // $products = Product::where('company_id' , $company_id )->get();
            // dd($company_id);
        }
        $products = $products->get();
        return view(
            'vending_all',
            [
                'products' => $products,
                'companys' => $companys,
                'campany_id' => $company_id,
            ]
        );
    }

    // ソート機能 昇順・降順

    public function list(Request $request)
    {
    $sort = $request->get('sort');
    $companys = Company::all();
    // dd($request);

    switch($sort){
    case 1:
        $products = Product::orderBy('id')->get();
        break;
    case 2:
        $products = Product::orderBy('product_name')->get();
        break;
    case 3:
        $products = Product::orderBy('price')->get();
        break;
    case 4:
        $products = Product::orderBy('stack')->get();
        break;
    case 5:
        $products = Company::orderBy('company_name')->get();
        break;
    }

    return view(
        'vending_all',
        [
            'products' => $products,
            'companys' => $companys,
        ]
    );
    }
}