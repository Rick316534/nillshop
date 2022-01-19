<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Member;

use App\Product;

use Illuminate\Support\Facades\Hash;

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
            'email' => 'required|string|email|max:255|regex:/([\w\-]+\@[\w\-]+\.[\w\-]+$)/',
            'password' => 'required|string|min:6|regex:/^[A-Za-z0-9]+$/|confirmed',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|min:10|max:10|regex:/^[\d]+$/',
        ]);

        Member::create(([
            'name' => $request['name'], 
            'email' => $request['email'], 
            'password' => Hash::make($request['password']), 
            'address' => $request['address'], 
            'phone' => $request['phone'], 
            'lv' => '1',
            'money' => 0,
            'status' => true,
            'sum' =>0,
        ]));
        $datas = Product::where('listed', '1')->get();
        return view('home', compact('datas'));
    }
    
    
}
