<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Member;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        //渲染註冊頁面
        return view('memberHouse');
    }

    public function store(Request $request)
    {
        switch ($request['rout']) 
        {
            case "o" :
                return "a";
                break;

            case "r" :
                return "a";
                break;

            case "e" :
                return view('eticmember');
                break;
        }
        
    }

    public function search(Request $request)
    {
        try {
            // $result = Member::where('id', Auth::user()->email)->first();
            // $name = $result['name'];
            // $money = $result['money'];
            // $lv = $result['lv'];
            // $address = $result['address'];
            // $phone = $result['phone'];
            // $DB = json_encode(array('lv'=>$lv, 'name'=>$name, 'phone'=>$phone, 'money'=>$money, 'address'=>$address));
            if (Auth::check()) {
                return Auth::uer();
            }
            return "未驗證";
        } catch (\Exception $e) {
            return "出現了點錯誤";
        }
        
        
    }
    
    
}
