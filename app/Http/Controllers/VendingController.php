<?php

namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Http\Requests\CreateThread;
    use App\Vending;
    use Illuminate\Support\Facades\Auth;
    // use App\Http\Requests\UpdateThread;


    class VendingController extends Controller
    {
        public function showCreate()
        {
            \Log::info("showcreate");
            return view('create');
        }

        public function getVending() {

            $vendings = Vending::all();
            // Eloquent"Member"で全データ取得
            return view('vending_all', [
                "vendings" => $vendings
            ]);
        }
        /**
         * 指定ユーザーのプロフィール表示
         *
         * @param  int  $id
         * @return View
         */
        public function showDisp($id)
        {

            return view('disp', ['vending' => Vending::findOrFail($id)]);
        }

        // スレッド作成された時のバリデーションDBに値を保存、リダイレクト
        public function create(CreateVending $request){
            // バリデーション
            $this->validate($request,[
            'title' => 'required',
            'thread_detail' => '',

            ]);

            // DBインサート
            $user = new Vending();

            $user->user_id = Auth::id();
            $user->title = $request->input('title');
            $user->thread_detail = $request->input('text');
            $user->category_id = 1;

            // 保存
            $user->save();

            // リダイレクト
            return redirect()->route('vending_all');
        }
    }
