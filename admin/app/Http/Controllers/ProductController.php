<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index(Request $rout)
    {
        //渲染註冊頁
        
        $rout->input('rout');
        switch ($rout["rout"])
        {
            case "e":
                return view('function.editProduct');
                break;
            case "a":
                return view('function.addProduct');
                break;
        }
    }

    public function add(Request $request)
    {
        
        $this->validate(request(),[
            'name' => 'required|string|max:15',
            'introduce' => 'required|string|max:50',
            'money' => 'required|regex:/^[0-9_]+$/',
            'quantity' => 'required|regex:/^[0-9_]+$/',
            'file' => 'required|image',
        ]);
        $imgName = date('Y-m-d H:i:s'). $request['file']->getClientOriginalName();
        try {
            Product::create(([
            'name' => $request['name'], 
            'money' => $request['money'], 
            'quantity' => $request['quantity'],
            'project_id' => $request['project_id'],
            'listed' => false,
            'introduce' => $request['introduce'],
            'url' => 'http://admin.com/image/'. $imgName,
            ]));
        } catch (\Exception $e) {
            return  view('function.addProduct');
        }
        $request["file"]->move(public_path('image'), $imgName);
        return view('function.addProduct');
    }

    public function store(Request $request)
    {
        try {
            $result = Product::where('id',$request['id'])->first();
            $url = $result['url'];
            $name = $result['name'];
            $quantity = $result['quantity'];
            $money = $result['money'];
            $listed = $result['listed'];
            $project_id = $result['project_id'];
            $introduce = $result['introduce'];
            $DB = json_encode(array('url'=>$url, 'name'=>$name, 'quantity'=>$quantity, 'money'=>$money, 'listed'=>$listed, 'project_id'=>$project_id, 'introduce'=>$introduce));
            return $DB;
        } catch (\Exception $e) {
            return "查無此ID";
        }
        
    }

    public function up(Request $request)
    {
        try {
            Product::where('id',$request['id'])->update([
            'name' => $request['name'], 
            'money' => $request['money'], 
            'quantity' => $request['quantity'],
            'project_id' => $request['project_id'],
            'listed' => $request['listed'],
            'introduce' => $request['introduce'],
            ]);
            return "存檔成功";
        } catch (\Exception $e) {
            return "存檔失敗";
        }
        
                
    }
    
}
