<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Member;

class LoginController extends Controller
{
    public function index()
    {
        //渲染註冊頁面
        return view('login');
    }
    public function login(Request $request)
    {
        //驗證
        $this->validate(request(),[
            'email' => 'required|string|email|max:255|regex:/([\w\-]+\@[\w\-]+\.[\w\-]+$)/',
            'password' => 'required|string|min:6|regex:/^[A-Za-z0-9]+$/', 
        ]);
        //查尋
        $remember_me = $request['remeber_me'];
        if (Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password'],
        ], $remember_me)) {

            $status = Member::where('email',$request['email'])->first();
            if ($status['status']) {
                return view('home') ;//渲染註冊頁面
            } else {
                return view('login'). "<script>window.alert('帳號停用');</script>";//渲染註冊頁面
            }
            
        } else {
            return view('login'). "<script>window.alert('帳號或密碼錯誤');</script>";//渲染註冊頁面
        }
       
        

    }
    public function logout()
    {
        Auth::logout();
        return view('home');//渲染註冊頁面
    }
}
