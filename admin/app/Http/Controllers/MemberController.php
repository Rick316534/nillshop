<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Member;

use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index()
    {
        return view('list.member');
    }

    public function all(Request $request)
    {
        try {
            $result = Member::all();
            return $result;
        } catch (\Exception $e) {
            return "未知錯誤";
        }
    }

    public function onload(Request $request)
    {
       return view('function.editMember');
    }

    public function set(Request $request)
    {
        try {
            session()->forget('email');
            session()->put('email', $request['email']);
            return session()->all();
        } catch (\Exception $e) {
            return "未知錯誤";
        }
    }

    public function store(Request $request)
    {
        try {
            $result = Member::where('email', session()->get('email'))->first();
            $email = $result['email'];
            $name = $result['name'];
            $money = $result['money'];
            $lv = $result['lv'];
            $address = $result['address'];
            $phone = $result['phone'];
            $status = $result['status'];
            $sum = $result['sum'];
            $DB = json_encode(array('lv'=>$lv, 'name'=>$name, 'phone'=>$phone, 'money'=>$money, 'status'=>$status, 'address'=>$address, 'email'=>$email, 'sum'=>$sum));
            return $DB;
        } catch (\Exception $e) {
            return "錯誤";
        }
    }

    public function search(Request $request)
    {
        try {
            $result = Member::where('email', 'like', '%'. $request['email']. '%')->get();
            return $result;
        } catch (\Exception $e) {
            return "查無此帳號";
        }
    }

    public function delete(Request $request)
    {
        try {
            $result = Member::where('email', $request['email'])->delete();
            return "刪除成功";
        } catch (\Exception $e) {
            return "查無此帳號";
        }
    }

    public function up(Request $request)
    {
        try {
            $this->validate(request(),[
                'email' => 'required',
            ]);
            Member::where('email', $request['email'])->update([
            'name' => $request['name'], 
            'money' => $request['money'], 
            'address' => $request['address'],
            'phone' => $request['phone'],
            'status' => $request['status'],
            ]);
            return "存檔成功";
        } catch (\Exception $e) {
            return "存檔失敗";
        }       
    }

    public function editPassword(Request $request)
    {
        try {
            $this->validate(request(),[
                'email' => 'required',
                'password' => 'required|string|min:6|regex:/^[A-Za-z0-9]+$/|confirmed',
            ]);
            Member::where('email', $request['email'])->update([
            'password' => Hash::make($request['password']),
            ]);
            return "存檔成功";
        } catch (\Exception $e) {
            return "存檔失敗";
        }
    }

    
}