<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;




class StorehouseController extends Controller
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
    public function jump (Request $rout)
    {
        $rout->input('rout');
        switch ($rout["rout"])
        {
            case "e":
                return view('editProduct');
                break;
            case "n":
                return view('newProduct');
                break;

        }
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Product
     */
    
    public function store(Request $request)
    {
        Validator::make($request->all(), ['file' => 'required|image'])->validate(); // 判斷檔案屬性
        $imgName = fileSet($request->file); // 儲存檔案與檔案命名
        insertSet($request, $imgName); //新增資料
        return view('result');
    }

    public function select(Request $request)
    {
        try {
            $query = [['id', '=', $request->id]];
            $a = DB::table('products')->where($query)->first()->url;
        } catch (\Exception $e) {
            return "查無此商品";
        };

        echo $a;
    }
}
  
function fileSet($file) 
{
        
    $imgName = date('Y-m-d H:i:s'). $file->getClientOriginalName();
    $file->move(public_path('image'), $imgName);
    return $imgName;
}
   
function insertSet($request, $imgName)
{
    $project_id = $request->project;
    $name = $request->name;
    $introduce = $request->introduce;
    $money = $request->money;
    $listed = '1';
    $url = '\'http://admin.com/image/'. $imgName. '\'';
    $quantity = $request -> Q;
    $insertsql = 'insert into products (project_id, name, introduce, money, listed, url, quantity) values (?, ?, ?, ?, ?, ?, ?)' ;
    $data = [$project_id, $name, $introduce, $money, $listed, $url, $quantity];
    if ( DB::insert($insertsql, $data)) {
        return view('result');
    } else {
        return url()->current();
    }
}