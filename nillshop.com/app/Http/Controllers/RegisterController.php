<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Member;

class RegisterController extends Controller
{
    public function index()
    {
        //渲染註冊頁面
        return view('regist');
    }

    public function register(Request $request)
    {
        $this->validate(request(),[
            'name' => 'required|string|max:15|regex:/^[\w]+$/',
            'id' => 'required|string|email|max:255|regex:/([\w\-]+\@[\w\-]+\.[\w\-]+$)/',
            'password' => 'required|string|min:6|regex:/^[A-Za-z0-9]+$/|confirmed',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|min:10|max:10|regex:/^[\d]+$/',
            'lv' => 'required|integer|max:1',
        ]);

        Member::create(([
            'name' => $request['name'], 
            'id' => $request['id'], 
            'password' => bcrypt($request['password']), 
            'address' => $request['address'], 
            'phone' => $request['phone'], 
            'lv' => $request['lv'],
        ]));
        return view('login');
    }

    
}
