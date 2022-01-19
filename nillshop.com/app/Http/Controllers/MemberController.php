<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Member;
use App\Order;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;


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
                $datas = Order::where('user_id', Auth::id())->get();
                return view('list.Ordershow', compact('datas'));
                break;

            case "r" :
                $datas = Order::where('user_id', Auth::id())->where('status', '退貨')->get();
                return view('list.backshow', compact('datas'));
                break;

            case "e" :
                return view('eticmember');
                break;
        }
        
    }

    public function search(Request $request)
    {
        if (Auth::check()) {
            try {
                $result = Member::where('email', Auth::User()->email)->first();
                $name = $result['name'];
                $money = $result['money'];
                $lv = $result['lv'];
                $address = $result['address'];
                $phone = $result['phone'];
                $DB = json_encode(array('lv'=>$lv, 'name'=>$name, 'phone'=>$phone, 'money'=>$money, 'address'=>$address));
                return $DB;
            
            } catch (\Exception $e) {
                return "出現了點錯誤";
            }
        } else {
            return "未登入";
        }
        
        
        
    }

    public function up(Request $request)
    {
        if (Auth::check()) {
            try {
                Member::where('email', Auth::User()->email)->update([
                'name' => $request['name'], 
                'money' => $request['money'], 
                'address' => $request['address'],
                'phone' => $request['phone'],
                ]);
                return "存檔成功";
            } catch (\Exception $e) {
                return "存檔失敗";
            } 
        } else {
            return "未登入";
        }   
    }
    public function editPassword(Request $request)
    {

        try {
            $this->validate(request(),[
                'password_old' => 'required|string|min:6|regex:/^[A-Za-z0-9]+$/',
                'password' => 'required|string|min:6|regex:/^[A-Za-z0-9]+$/|confirmed',
            ]);
            $result = Member::where('email', Auth::User()->email)->first();
            if (Hash::check($request['password_old'], $result['password'])  ) {
                Member::where('email', Auth::user()->email)->update([
                    'password' => Hash::make($request['password']),
                    ]);
            } else {
                return "密碼錯誤";
            }
            return "存檔成功";
        } catch (\Exception $e) {
            return "存檔失敗";
        }
    }
    
}
