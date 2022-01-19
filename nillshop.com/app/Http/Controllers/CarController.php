<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Product;

use App\Car;

use App\Order;


class CarController extends Controller
{
    //商品顯示
    public function index(Request $request)
    {
        $content = Car::select('Pid', 'much')->where('id', Auth::id())->get();
        return view('car.shopcar', compact('content'));
        
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
    public function pay(Request $request)
    {
        if ($request['id'] == Auth::id()) {
            try {
                session()->put('Pid', $request['pid']);
                Car::where('id', Auth::id())->where('Pid', $request['pid'])->update([
                    'much' => $request['much'],
                ]);
            } catch (\Exception $e) {
                return "結帳失敗01";
            }
        } else {
            return "使用者不符";
        }
        
    }
    
    //加入購物車
    public function carset(Request $request)
    {
        // session()->pull('carid', $request['id']);
        // session()->push('carid', $request['id']);
        // return Session()->all();
        try {
            $check = Car::select('Pid')->where('id', Auth::id())->get();
            if (empty($check['Pid'])) {
                foreach ($check as $key => $data ){
                    if ($data->Pid == $request['pid']) {
                        return "以加入過購物車";
                    }
            }
                
                Car::create(([
                    'id' => Auth::id(),
                    'Pid' => $request['pid'],
                    'much' => $request['much'],
                ]));
            } else {
                Car::create(([
                    'id' => Auth::id(),
                    'Pid' => $request['pid'],
                    'much' => $request['much'],
                ]));
            }
            return "加入成功";
        } catch (\Exception $e) {
            return '加入失敗';
        }
        
        
    }
}
