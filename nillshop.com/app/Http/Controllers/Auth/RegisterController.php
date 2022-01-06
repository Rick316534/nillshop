<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'id' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|min:10|max:255',
            'lv' => 'required|string|max:1',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\member
     */
    protected function create(array $data)
    {
        return member::create([
            'name' => $data['name'],
            'id' => $data['id'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'lv' => $data['lv'],
        ]);
    }
}
