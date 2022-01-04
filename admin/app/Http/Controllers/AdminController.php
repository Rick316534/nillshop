<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function log()
    {
        return view('login');
    }
    public function show()
    {
        
    }
    public function store(Array $date)
    {
        return $date['id'];
    }
}
