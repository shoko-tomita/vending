<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class AuthController extends Controller
{
    /**
     * @return View
     */
    public function showLogin()
    {
        \Log::info("showlogin");
        return view ('auth.login.login_form');

    }

        /**
        * @param  App\Http\Requests\LoginFormRequest;
        * $request
        */
        public function login(LoginFormRequest $request)
        {
            $credentials = $request->only('email','password');

            \Log::info("loginattempt");
            if(Auth::attempt($credentials)) {
                $request->session()->regenerate();

                \Log::info("loginok");
                return redirect()->route('vending_all');
                // return redirect('/vending_all')->with('login_success','ログイン成功しました！');
            }
            \Log::info("showloginng");
            return back()->withErrors([
                'login_error' => 'メールアドレスかパスワードが間違っています',
            ]);
        }
    }
