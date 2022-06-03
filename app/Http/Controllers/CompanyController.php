<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Http\Requests\CompanyFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CompanyController extends Controller
{
    public function show(){
        $companyAll = Company::all();
        $companys = Company::orderBy('created_at','asc')->paginate(3);

        foreach ($companys as $company) {
            // dd($companys);
            // $company_id = $company->company_id;
            // $company_name = Company::find($company_id)->company_name;
            // $companys['company_name'] = $company_name;
        }
        return view(
            'company/all',
            [
                // 'company_id' => $company_id,
                'companyAll' => $companyAll,
                'companys' => $companys,
                'downloadmode' => 'all',
                'downloadmode_etc' => ['all','all'],
            ]
        );

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

         // 検索機能
    public function search2(Request $request)
    {
        \Log::info("search2");
        $companyAll = Company::all();
        $companys = Company::all();

        // dd($request);
        $company_id = $request->input('company_id');
        $word = $request->get('word');
        $companys = Company::query();
        // dd($company_id);
        if ($word !== null) {
            $escape_word = addcslashes($word, '\\_%');
            $companys->where('company_name', 'LIKE', '%' . $escape_word . '%');
            // $companys = Product::where('product_name', 'LIKE', '%' . $escape_word . '%')->get();
            // dd($companys);
        }

        if ($company_id !== null){
            $companys->where('id' , $company_id );
            // $companys = Product::where('company_id' , $company_id )->get();
            // dd($company_id);
        }
        $companys = $companys->paginate();

        return view(
            'company/all',
            [
                'companyAll' => $companyAll,
                'companys' => $companys,
                'company_id' => $company_id,
                'downloadmode' => 'search2',
                'downloadmode_etc' => [$word,$company_id],
            ]
        );
    }

    // ソート機能 昇順・降順
    public function list2(Request $request)
    {
    $sort = $request->get('sort2');
    $companys = Company::all();
    $companyAll = Company::all();
    // dd($request);

    $up = $request->get('radioInline') ;
    $down = $request->get('radioInline');
    \Log::info("radio",[$up,$down]);

    switch($sort)
    {
    case 1:if ($request->get('radioInline') == 'up'){
        $companys = Company::orderBy('id','asc')->paginate();
        }else{
            $companys = Company::orderBy('id','desc')->paginate();
        }
        break;
    case 2:if ($request->get('radioInline') == 'up'){
        $companys = Company::orderBy('company_name','asc')->paginate();
        }else{
        $companys = Company::orderBy('company_name','desc')->paginate();
        }
        break;
    case 3:if ($request->get('radioInline') == 'up'){
        $companys = Company::orderBy('street_address','asc')->paginate();
        }else{
        $companys = Company::orderBy('street_address','desc')->paginate();
        }
        break;
    case 4:if ($request->get('radioInline') == 'up'){
        $companys = Company::orderBy('representative_name','asc')->paginate();
        }else{
        $companys = Company::orderBy('representative_name','desc')->paginate();
        }
        break;

    }

    return view(
        'company/all',
        [
            'companyAll' => $companyAll,
            'companys' => $companys,
            'downloadmode' => 'sort',
            'downloadmode_etc' => [$sort,$request->get('radioInline')]
        ]
    );
    }

    public function download($mode, $mode_etc,  Request $request)
    {
        \Log::info("download",[$mode]);
        // ==========データ収集
        // dd($mode_etc);

        $companys = Company::all();// ■変更部分
        if($mode === 'sort'){

            $sortlist = explode("_", $mode_etc);
            $sort = $sortlist[0];
            $order = $sortlist[1];
            switch($sort)
            {
            case 1:if ($order == 'up'){
                $companys = Company::orderBy('id','asc')->paginate();
                }else{
                    $companys = Company::orderBy('id','desc')->paginate();
                }
                break;
            case 2:if ($order == 'up'){
                $companys = Company::orderBy('company_name','asc')->paginate();
                }else{
                $companys = Company::orderBy('company_name','desc')->paginate();
                }
                break;
            case 3:if ($order == 'up'){
                $companys = Company::orderBy('street_address','asc')->paginate();
                }else{
                $companys = Company::orderBy('street_address','desc')->paginate();
                }
                break;
            case 4:if ($order == 'up'){
                $companys = Company::orderBy('representative_name','asc')->paginate();
                }else{
                $companys = Company::orderBy('representative_name','desc')->paginate();

                }
                break;

            }


        }elseif ($mode === 'search2') {
            // dd($mode_etc);
            # code...
            \Log::info("search2csv");

            $companys = Company::query();
            $mode_etc_list = explode("_", $mode_etc);
            $word = $mode_etc_list[0];
            $company_id = $mode_etc_list[1];
            // dd($company_id);
            if ($word !== "") {

                $escape_word = addcslashes($word, '\\_%');
                $companys = $companys->where('company_name', 'LIKE', '%' . $escape_word . '%');
                // $companys = company::where('company_name', 'LIKE', '%' . $escape_word . '%')->get();
                //  dd($companys);
            }

            if ($company_id !== ""){
                $companys = $companys->where('id' , $company_id );
                // $companys = company::where('company_id' , $company_id )->get();
                // dd($company_id);
            }
            $companys = $companys->paginate();

        }else{
            // nothing to do..
        }

        // ========== csv生成
        $response = new StreamedResponse(function () use ($companys) {
            //                                                ↑収集済みデータ
            $stream = fopen('php://output', 'w');
            foreach ($companys as $company){
                 //     ↑収集済みデータ
                fputcsv($stream,  [
                    // ↓csvのカラム
                    $company->id,
                    $company->company_name,
                    $company->street_address,
                    $company->representative_name,
                    // ↑csvのカラム
                ]);
            }
            fclose($stream);
        },200,
        [
            'Content-Type'=>'text/csv',
            'Content-Disposition'=>'attachment; filename=companys.csv',
            //                                              ↑ファイル名
        ]);
        return $response;
    }

}
