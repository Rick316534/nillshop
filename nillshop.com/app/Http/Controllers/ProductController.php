<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use PhpParser\Node\Expr\Cast\Object_;

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
    public function select(Request $request)
    {
        $result = Product::where('name', 'Like', "%". $request['id']. "%")
                    ->where('listed', '1')
                    ->orderBy('money','desc')
                    ->get()
                    ->toArray();

        return $result ;
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
    
}
