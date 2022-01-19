<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Product;

use App\Member;
use App\Order;


class OrderController extends Controller
{
    //商品顯示
    public function index(Request $request)
    {
        $datas = Order::all();
        $email = Member::select('id','email')->get();
        return view('list.order', compact('datas', 'email'));
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
        try {
            $user = Member::select('id')->where('email', "like", "%". $request['email']. "%")->first();
            return Order::where('user_id', $user['id'])->get();
            
        } catch (\Exception $e) {
            return "沒有此使用者"; 
        }  
    }
        
        
   
   public function back (Request $request)
   {
        try {
            $oldsum = Order::select('sum')->where('user_id', $request['userId'])->where('id', $request['id'])->get();
            $lv = Member::select('sum')->where('id', $request['userId'])->get();
            $status = Order::select('status')->where('user_id', $request['userId'])->where('id', $request['id'])->get();
            $sum = $lv[0]['sum'] - $oldsum[0]['sum'];
            if ( $status[0]['status'] == "退貨"){
                return "以退貨";
            } else {
                Order::where('user_id', $request['userId'])->where('id', $request['id'])->update([
                    'status' => '退貨'
                    ]);
                Member::where('id', $request['userId'])->update([
                    'money' => $oldsum[0]['sum'],
                    'sum' => $sum,
                    ]);
                if( $sum <5000 ){
                    Member::where('id', $request['userId'])->update([
                        'lv' => '1',
                    ]);
                };
            }
            

            return "退貨完成";

        } catch (\Exception $e) {
            return "退貨失敗";
        }
   }

   public function backindex()
   {
    $datas = Order::select('id', 'user_id', 'name', 'address', 'phone', 'content', 'money', 'listed', 'sum', 'status', 'updated_at')->where('status', '請求退貨中')->get();
    return view('list.back', compact('datas'));
   }

}
