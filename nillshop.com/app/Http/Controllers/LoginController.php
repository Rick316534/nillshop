<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

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
            'id' => 'required|string|email|max:255|regex:/([\w\-]+\@[\w\-]+\.[\w\-]+$)/',
            'password' => 'required|string|min:6|regex:/^[A-Za-z0-9]+$/', 
        ]);
        //查尋
        $remember_me = $request['remeber_me'];
        if (Auth::attempt([
            'id' => $request['id'],
            'password' => $request['password'],
        ], $remember_me)) {

            return view('home');
            
        } else {
            return view('login');
        }
       
        //渲染註冊頁面

    }
    public function logout()
    {
        Auth::logout();
        return view('home');
    }
}
