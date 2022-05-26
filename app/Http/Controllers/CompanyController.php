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

}
