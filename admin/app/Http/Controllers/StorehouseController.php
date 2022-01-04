<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;

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
        echo $rout->input('rout');
        switch ($rout["rout"])
        {
            case "e":
                return view('');
                break;
            case "n":
                return view('newProduct');
                break;

        }
    }

    public function edit()
    {
        return view('');
    }
    public function new()
    {
        return view('newProduct');
    }
}