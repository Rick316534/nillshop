<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use Illuminate\Contracts\Session\Session;
use PhpParser\Node\Expr\Cast\Object_;
use App\Car;
class ProductController extends Controller
{
    //商品顯示
    public function show(Request $request)
    {
        if (isset($request['id'])) {
            try {
                $result = Product::where('project_id', $request['id'])
                            ->where('listed', '1')
                            ->orderBy('money','desc')
                            ->get()
                            ->toArray();

                return $result ;

            } catch (\Exception $e) {
                return "查無此商品";
            }
        } else {
            try {
                $result = Product::where('listed', '1')
                            ->orderBy('money','desc')
                            ->get()
                            ->toArray();
    
                return $result ;
            } catch (\Exception $e) {
                return "查無此商品";
            }
        }
        
    }                            

    //商品搜尋
    public function search(Request $request)
    {
        $datas = Product::where('name', 'Like', "%". $request['name']. "%")
                    ->where('listed', '1')
                    ->orderBy('money','desc')
                    ->get();
                    

        return $datas ;
    }

    //商品頁面
    public function store(Request $request)
    {
        if (isset($request['id'])) {
            $result = Product::where('id', $request['id'])
                ->where('listed', '1')
                ->get()
                ->toArray();
                return $result ;
        } else {
            return "找不到沒有ID的商品" ;
        }
    }
    
    //新增購物車
    public function carset(Request $request)
    {
        // session()->pull('carid', $request['id']);
        // session()->push('carid', $request['id']);
        // return Session()->all();
        try {
            Car::create(([
                'id' => Auth::id(),
                'Pid' => $request['pid'],
            ]));
            return "以加入購物車";
        } catch (\Exception $e) {
            return $request['pid'];
        }
        
        
    }
}
