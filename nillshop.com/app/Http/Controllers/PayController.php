<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Product;

use App\Car;
use App\Member;
use App\Order;


class PayController extends Controller
{
    //商品顯示
    public function index(Request $request)
    {
        $content = Product::select('name', 'url', 'money', 'quantity','id')->where('id', session()->get("Pid"))->get();
        $people = Member::select('name', 'address', 'phone')->where('id', Auth::id())->get();
        $much = Car::select('much')->where('Pid',session()->get('Pid'))->where('id', Auth::id())->get();
        return view('pay.payshow', compact('content', 'people', 'much'));

        switch ($request['type'])
        {
            case 'direct':
                
            break;
        };
    }                            

    //商品刪除
    public function delete(Request $request)
    {
        try {
            Car::where('id', Auth::id())->where('Pid', $request['pid'])->delete();
            return "刪除成功";
        } catch (\Exception $e) {
            return '刪除失敗';
        }
       
    }

    //單一商品結帳
    public function directpay()
    {
        return Product::select('name', 'introduce', 'url', 'money')->where('id', session()->get('Pid'));
    }
    
    //加入購物車
    public function carset(Request $request)
    {
        
        
        
    }
}
