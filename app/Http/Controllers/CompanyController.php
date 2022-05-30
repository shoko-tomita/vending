<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Http\Requests\CompanyFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

class CompanyController extends Controller
{
    public function show(){
        $companys = Company::all();
        $companys = Company::orderBy('created_at','asc')->paginate(3);

        foreach ($companys as $company) {
            // $company_id = $company->company_id;
            // $company_name = Company::find($company_id);
            // $company['company_name'] = $company_name;
        }
        //dd($companys);
        return view('company/all', ['companys' => $companys,]);

        // return view('company/all');
    }

    public function showCreate()
    {
        \Log::info("showcreate2");
        // $companys = Company::all();

        return view('company/company_create');
    }

    // スレッド作成された時のバリデーションDBに値を保存、リダイレクト
    public function newCreate(CompanyFormRequest $request)
    {
        // dd($request);
        // バリデーション
        $this->validate($request, [
            'company_name' => 'required',
            'street_address' => 'required',
            'representative_name' => 'required',

        ]);
        // dd($request);
        // DBインサート
        $user = new Company();
        $user->company_name = $request->input('company_name');
        $user->street_address = $request->input('street_address');
        $user->representative_name = $request->input('representative_name');
        // dd($user);
        // 保存
        $user->save();
        \Log::info("newCreate2");
        // リダイレクト
        // return Storage::disk('local')->download($user);
        return redirect('all');
    }

        // 論理削除
    public function destroy2(int $id)
    {
        Company::find($id)->delete();
        return redirect('all');
    }

    // /**
    //  * 指定ユーザーのプロフィール表示
    //  *
    //  * @param  int  $id
    //  * @return View
    //  */
    // public function showDisp($id)
    // {
    //     return view('company/company_disp', ['company' => Company::findOrFail($id)]);
    // }
        // 編集機能
        public function showEdit(int $id)
        {
            \Log::info("showEdit2");
            $company = Company::findOrFail($id);
            // $company = Company::all();
            // $company_id =  $product->company_id;
            // dd($company);
            return view('company/company_edit', ['company'=>$company,]);
            // return view('edit',compact('company'));
        }

        public function up(int $id, CompanyFormRequest $request)
        {

            $company = Company::findOrFail($id);
            // $company->company_id = $request->company_id;
            $company->company_name = $request->company_name;
            $company->street_address = $request->street_address;
            $company->representative_name = $request->representative_name;
            $company->save();

            return redirect('all');
        }

    //      // 検索機能
    // public function search(Request $request)
    // {
    //     \Log::info("search");
    //     $companys = Company::all();

    //     // dd($request);
    //     $company_id = $request->input('company_id');
    //     $word = $request->get('word');
    //     $products = Product::query();
    //     // dd($company_id);
    //     if ($word !== null) {
    //         $escape_word = addcslashes($word, '\\_%');
    //         $products->where('product_name', 'LIKE', '%' . $escape_word . '%');
    //         // $products = Product::where('product_name', 'LIKE', '%' . $escape_word . '%')->get();
    //         // dd($products);
    //     }

    //     if ($company_id !== null){
    //         $products->where('company_id' , $company_id );
    //         // $products = Product::where('company_id' , $company_id )->get();
    //         // dd($company_id);
    //     }
    //     $products = $products->paginate();
    //     return view(
    //         'vending_all',
    //         [
    //             'products' => $products,
    //             'companys' => $companys,
    //             'campany_id' => $company_id,
    //         ]
    //     );
    // }

    // // ソート機能 昇順・降順
    // public function list2(Request $request)
    // {
    // $sort = $request->get('sort');
    // $companys = Company::all();
    // // dd($request);

    // $up = $request->get('radioInline') ;
    // $down = $request->get('radioInline');
    // \Log::info("radio",[$up,$down]);

    // switch($sort)
    // {
    // case 1:if ($request->get('radioInline') == 'up'){
    //     $products = Product::orderBy('id','asc')->paginate();
    //     }else{
    //         $products = Product::orderBy('id','desc')->paginate();
    //     }
    //     break;
    // case 2:if ($request->get('radioInline') == 'up'){
    //     $products = Product::orderBy('product_name','asc')->paginate();
    //     }else{
    //     $products = Product::orderBy('product_name','desc')->paginate();
    //     }
    //     break;
    // case 3:if ($request->get('radioInline') == 'up'){
    //     $products = Product::orderBy('product_name','asc')->paginate();
    //     }else{
    //     $products = Product::orderBy('price','desc')->paginate();
    //     }
    //     break;
    // case 4:if ($request->get('radioInline') == 'up'){
    //     $products = Product::orderBy('stack','asc')->paginate();
    //     }else{
    //     $products = Product::orderBy('stack','desc')->paginate();
    //     }
    //     break;
    // case 5:if ($request->get('radioInline') == 'up'){
    //     $products = Company::orderBy('company_name','asc')->paginate();
    //     }else{
    //     $products = Company::orderBy('company_name','desc')->paginate();
    //     }
    //     break;
    // }

    // return view(
    //     'vending_all',
    //     [
    //         'products' => $products,
    //         'companys' => $companys,
    //     ]
    // );
    // }
}
