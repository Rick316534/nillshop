<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\member;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index()
    {
        return view('memberhome');
    }
}