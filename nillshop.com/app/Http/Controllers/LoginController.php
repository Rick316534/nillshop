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
        $id = $request['id'];
        $password = $request['password'];
        if (Auth::attempt([
            'id' => $request['id'],
            'password' => $request['password'],
        ])) {

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
