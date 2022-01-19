<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Product;

use App\Car;
use App\Member;
use App\Order;


class OrderController extends Controller
{
    //商品顯示
    public function index(Request $request)
    {
        
    }                            

    //建立訂單
    public function set(Request $request)
    {
        $content = Product::select('name', 'money', 'quantity')->where('id', session()->get('Pid'))->first();
        $listed = Car::select('much')->where('Pid', session()->get('Pid'))->where('id', Auth::id())->first();
        $LV = Member::select('lv')->where('id', Auth::id())->first();
        $money = Member::select('money')->where('id', Auth::id())->first();
        $sumMoney = Member::select('sum')->where('id', Auth::id())->first();
        $sum = $request['sum'];
        if ($content['quantity'] < $listed['much']){
            return "庫存量不足，結帳失敗";
        }
        switch ($LV['lv'])
        {
            case "1":
                if ($request['sum'] >= 1000) {
                    $sum = $request['sum'] - 100;
                }
            break ;
            case "2":
                $sum = $request['sum'] * 0.8;
            break;
        }
        if(($money['money'] - $sum) >= 0){
            $newmoney = $money['money'] - $sum;
        } else {
            $sum =  $sum - $money['money'];
            $newmoney = 0;
        }
        try {
            
            Order::create(([
                'user_id' => Auth::id(),
                'name' => $request['name'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'money' => $content['money'],
                'sum' => $sum,
                'status' => '完成',
                'content' => $content['name'],
                "listed" => $listed['much'],
                
            ]));
            if ( ($sumMoney['sum'] + $sum ) > 5000) {
                Member::where('id', Auth::id())->update([
                    'lv' => '2',
                ]);
            };
            Member::where('id', Auth::id())->update([
                'sum' => $sumMoney['sum'] + $sum,
                'money' => $newmoney,
            ]);
            $newStatus = $content['quantity'] - $listed['much'];
            if ( $newStatus > 0) {
                Product::where('id', session()->get('Pid'))->update([
                    'quantity' => $newStatus,
                ]);
            } else {
                Product::where('id', session()->get('Pid'))->update([
                    'quantity' => $newStatus,
                    'listed' => '0',
                ]);
            }
            
            Car::where('id', Auth::id())->where('Pid', session()->get('Pid'))->delete();
            return "訂單完成";
        } catch (\Exception $e) {
            return "結帳失敗";
        }
        
        
    }
    
    public function all() 
    {
        return Order::where('user_id', Auth::id())->get();
    }

    public function setid(Request $request)
    {
        session()->put('readPid', $request['id']);
        return session()->get('readPid');
    }
   
   public function search (Request $request)
   {    
        if ($request['beginday'] < $request['endday']) {
            try {
                return Order::where('user_id', Auth::id())->where('created_at', '>', $request['beginday'])->where('created_at', '<', $request['endday'])->get();
            } catch (\Exception $e) {
                return "錯誤";
            }
        } else {
            return "日期錯誤";
        }
        
   }
   
   public function back (Request $request)
   {
        try {
            Order::where('user_id', Auth::id())->where('id', $request['id'])->update([
                'status' => '請求退貨中'
                ]);
                return "請求成功";
        } catch (\Exception $e) {
            return "退貨請求失敗";
        }
   }
}
