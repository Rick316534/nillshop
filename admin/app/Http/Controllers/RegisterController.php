<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Admin;

use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        //渲染註冊頁面
        return view('door.regist');
    }

    public function register(Request $request)
    {
        $this->validate(request(),[
            'name' => 'required|string|max:15|regex:/^[\w]+$/',
            'password' => 'required|string|min:6|regex:/^[A-Za-z0-9]+$/|confirmed',
        ]);

        Admin::create(([
            'name' => $request['name'], 
            'password' => Hash::make($request['password']), 
        ]));
        return view('door.login');
    }

    
}
