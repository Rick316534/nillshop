<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

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
    public function jump(Request $rout)
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
        $query = [['id', '=', $request->id]];
        try {
            $result = DB::table('products')->where($query)->first();
            $url = $result->url;
            $name = $result->name;
            $quantity = $result->quantity;
            $money = $result->money;
            $listed = $result->listed;
            $project_id = $result->project_id;
            $introduce = $result->introduce;
            $DB = json_encode(array('url'=>$url, 'name'=>$name, 'quantity'=>$quantity, 'money'=>$money, 'listed'=>$listed, 'project_id'=>$project_id, 'introduce'=>$introduce));
        } catch (\Exception $e) {
            return "查無此商品";
        };
        echo $DB;
    }

    public function up(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $quantity = $request->quantity;
        $money = $request->money;
        $listed = $request->listed;
        $project_id = $request->project_id;
        $introduce = $request->introduce;
        try {
            $qurys = [['name'=>$name], ['quantity'=>$quantity], ['money'=>$money], ['listed'=>$listed], ['project_id'=>$project_id], ['introduce'=>$introduce]];
            foreach ($qurys as $qury) {
                DB::table('products')->where('id', $id)->update($qury);
            }
            return "存檔成功";
        } catch (\Exception $e) {
            return "存檔失敗";
        }
    }

}
  
function fileSet($file) 
{
        
    $imgName = date('Y-m-d H:i:s'). $file->getClientOriginalName();
    $file->move(public_path('image'), $imgName);
    return $imgName;
}
   
function insertSet ($request, $imgName)
{
    $project_id = $request->project;
    $name = $request->name;
    $introduce = $request->introduce;
    $money = $request->money;
    $listed = '1';
    $url = 'http://admin.com/image/'. $imgName;
    $quantity = $request -> Q;
    $insertsql = 'insert into products (project_id, name, introduce, money, listed, url, quantity) values (?, ?, ?, ?, ?, ?, ?)' ;
    $data = [$project_id, $name, $introduce, $money, $listed, $url, $quantity];
    if ( DB::insert($insertsql, $data)) {
        return view('result');
    } else {
        return url()->current();
    }
}