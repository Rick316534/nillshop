<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        //渲染註冊頁面
        return view('memberHouse');
    }

    

    
}
