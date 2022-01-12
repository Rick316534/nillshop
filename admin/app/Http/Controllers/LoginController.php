<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        //渲染註冊頁面
        return view('door.login');
    }
    public function login(Request $request)
    {
        //驗證
        $this->validate(\request(),[
            'name' => 'required|string|max:255|regex:/^[A-Za-z0-9_]+$/',
            'password' => 'required|string|min:6|regex:/^[A-Za-z0-9]+$/', 
        ]);
        //查尋
        if (Auth::attempt([
            'name' => $request['name'],
            'password' => $request['password'],
        ], false)) {

            return view('home');
            
        } else {
            return view('door.login');
        }

    }
    public function logout()
    {
        Auth::logout();
        return view('home');
    }
}
