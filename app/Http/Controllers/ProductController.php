<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\UpdateFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
        $file_name = $request->file('img_path')->getClientOriginalName();
        $user->img_path = $file_name;
        \Log::info("upload file $file_name");
        $request->file('img_path')->storeAs('public/images',$file_name);
        // dd($request->input('img_path'));
        // $image->img_path = $request->file('img_path');
        // $path = \Storage::put('/public',$image);
        // 保存
        $user->save();
        \Log::info("newCreate");
        // リダイレクト
        // return Storage::disk('local')->download($user);
        return redirect('/');
    }


    public function show()
    {
        $products = Product::all();
        $companys = Company::all();
        $products = Product::orderBy('created_at','asc')->paginate(3);

        foreach ($products as $product) {
            $company_id = $product->company_id;
            $company_name = Company::find($company_id)->company_name;
            $product['company_name'] = $company_name;
        }
        // dd($test);
        return view(
            'vending_all',
            [
                'products' => $products,
                'companys' => $companys,
                'downloadmode' => 'all',
                'downloadmode_etc' => ['all','all'],
            ]
        );
    }

    /**
     * 指定ユーザーのプロフィール表示
     *
     * @param  int  $id
     * @return View
     */
    public function showDisp($id)
    {
        \Log::info("showDisp");
        return view('disp', ['product' => Product::findOrFail($id)]);
    }

    // 編集機能
    public function showEdit(int $id)
    {
        \Log::info("showEdit");
        $product = Product::findOrFail($id);
        $companys = Company::all();
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
        $product->img_path = $request->img_path;
        $product->save();

        return redirect()->route('disp', ['id' => $id,]);
    }

    // 削除対象レコードを検索
    public function destroy(int $id)
    {
        \Log::info("destroy");
        Product::find($id)->delete();
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
        $products = $products->paginate();

        return view(
            'vending_all',
            [
                'products' => $products,
                'companys' => $companys,
                'campany_id' => $company_id,
                'downloadmode' => 'search',
                'downloadmode_etc' => [$word,$company_id],
            ]
        );
    }

    // ソート機能 昇順・降順
    public function list(Request $request)
    {
    $sort = $request->get('sort');
    $companys = Company::all();
    $products = Product::query();
    // dd($request);

    $up = $request->get('radioInline') ;
    $down = $request->get('radioInline');
    \Log::info("radio",[$up,$down]);

    switch($sort)
    {
    case 1:if ($request->get('radioInline') == 'up'){
        $products = Product::orderBy('id','asc')->paginate();
        }else{
            $products = Product::orderBy('id','desc')->paginate();
        }
        break;
    case 2:if ($request->get('radioInline') == 'up'){
        $products = Product::orderBy('product_name','asc')->paginate();
        }else{
        $products = Product::orderBy('product_name','desc')->paginate();
        }
        break;
    case 3:if ($request->get('radioInline') == 'up'){
        $products = Product::orderBy('product_name','asc')->paginate();
        }else{
        $products = Product::orderBy('price','desc')->paginate();
        }
        break;
    case 4:if ($request->get('radioInline') == 'up'){
        $products = Product::orderBy('stack','asc')->paginate();
        }else{
        $products = Product::orderBy('stack','desc')->paginate();
        }
        break;
    case 5:if ($request->get('radioInline') == 'up'){
        $products = Company::orderBy('company_name','asc')->paginate();
        }else{
        $products = Company::orderBy('company_name','desc')->paginate();
        }
        break;
    }
    // 並び替えをビューに
    return view(
        'vending_all',
        [
            'products' => $products,
            'companys' => $companys,
            'downloadmode' => 'sort',
            'downloadmode_etc' => [$sort,$request->get('radioInline')]
        ]
    );
    }

    public function downloadcsv($mode, $mode_etc,  Request $request)
    {
        \Log::info("downloadcsv",[$mode]);
        // ==========データ収集
        // dd($mode_etc);

        $products = Product::all();// ■変更部分
        if($mode === 'sort'){

            $sortlist = explode("_", $mode_etc);
            $sort = $sortlist[0];
            $order = $sortlist[1];
            switch($sort)
            {
            case 1:if ($order == 'up'){
                $products = Product::orderBy('id','asc')->paginate();
                }else{
                    $products = Product::orderBy('id','desc')->paginate();
                }
                break;
            case 2:if ($order == 'up'){
                $products = Product::orderBy('product_name','asc')->paginate();
                }else{
                $products = Product::orderBy('product_name','desc')->paginate();
                }
                break;
            case 3:if ($order == 'up'){
                $products = Product::orderBy('product_name','asc')->paginate();
                }else{
                $products = Product::orderBy('price','desc')->paginate();
                }
                break;
            case 4:if ($order == 'up'){
                $products = Product::orderBy('stack','asc')->paginate();
                }else{
                $products = Product::orderBy('stack','desc')->paginate();
                }
                break;
            case 5:if ($order == 'up'){
                $products = Company::orderBy('company_name','asc')->paginate();
                }else{
                $products = Company::orderBy('company_name','desc')->paginate();
                }
                break;
            }


        }elseif ($mode === 'search') {
            // dd($mode_etc);
            # code...
            $products = Product::query();
            $mode_etc_list = explode("_", $mode_etc);
            $word = $mode_etc_list[0];
            $company_id = $mode_etc_list[1];
            //dd($company_id);
            if ($word !== "") {

                $escape_word = addcslashes($word, '\\_%');
                $products = $products->where('product_name', 'LIKE', '%' . $escape_word . '%');
                // $products = Product::where('product_name', 'LIKE', '%' . $escape_word . '%')->get();
                 //dd($products);
            }

            if ($company_id !== ""){
                $products = $products->where('company_id' , $company_id );
                // $products = Product::where('company_id' , $company_id )->get();
                // dd($company_id);
            }
            $products = $products->paginate();

        }else{
            // nothing to do..
        }

        // ========== csv生成
        $response = new StreamedResponse(function () use ($products) {
            //                                                ↑収集済みデータ
            $stream = fopen('php://output', 'w');
            foreach ($products as $product){
                 //     ↑収集済みデータ
                fputcsv($stream,  [
                    // ↓csvのカラム
                    $product->id,
                    $product->product_name,
                    $product->price,
                    $product->stack,
                    $product->comment,
                    // ↑csvのカラム
                ]);
            }
            fclose($stream);
        },200,
        [
            'Content-Type'=>'text/csv',
            'Content-Disposition'=>'attachment; filename=products.csv',
            //                                              ↑ファイル名
        ]);
        return $response;
    }

}