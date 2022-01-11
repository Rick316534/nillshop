<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;





class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("storemember");
    }
    public function store(Request $request)
    {
        try {
            $query = [['id', '=', $request->id]];
            $result = DB::table('members')->where($query)->first();
            $name = $result->name;
            $phone = $result->phone;
            $address = $result->address;
            $DB = json_encode(array('name'=>$name, 'phone'=>$phone, 'address'=>$address));
            return $DB;
        } catch (\Exception $e) {
            return "查無此用戶";
        };
        
    }
    public function up(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $phone = $request->phone;
        $address = $request->address;
        $querys= [['name'=>$name], ['phone'=>$phone], ['address'=>$address]];
        try {
            foreach ($querys as $qury) {
                DB::table('members')->where('id', $id)->update($qury);
            }
                return "存當成功";
        } catch (\Exception $e) {
            return "存檔失敗";
        }

    }
    public function delete(Request $request)
    {
        $id = $request->id;
        try {
            DB::table('members')->where('id', '=', $id)->delete();
            return "刪除成功";
        } catch (\Exception $e) {
            return "刪除失敗";
        }
        
    }
    public function psw(Request $request)
    {
        $id = $request->id;
        $oldPassword = bcrypt($request->old);
        //$newPassword = bcrypt($request->new);
        return $oldPassword;
        // try {
        //     $result = DB::table('members')->where(['id', '=', $id])->first();
        //     if ($oldPassword == ($result->password)) {
        //         DB::table('members')->where('id', $id)->update(['password'=>$newPassword]); 
        //         return "修改完畢";
        //     } else {
        //         return "密碼錯誤";
        //     }
           
        // } catch (\Exception $e) {
        //     return "未知錯誤";
        // }
    }
    
}