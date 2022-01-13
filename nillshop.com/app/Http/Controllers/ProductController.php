<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use PhpParser\Node\Expr\Cast\Object_;

class ProductController extends Controller
{

    public function show(Request $request)
    {
        $i = 0 ; 
        $results = [] ;
        // $url = $name = $quantity = $money = $listed = $project_id = $introduce = $id = array();
        try {
            $result = Product::where('project_id','3')
                        ->orderBy('money','desc')
                        ->get()
                        ->toArray();

            return ($result) ;
        } catch (\Exception $e) {
            return "查無此ID";
        }
        
    }
    
}
