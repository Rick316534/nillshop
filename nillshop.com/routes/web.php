<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
//註冊
Route::get('registview','RegisterController@index')->name('regist');
Route::post('regist','RegisterController@register')->name('register');
//登入登出
Route::get('log','LoginController@index')->name('log');
Route::post('login','LoginController@login')->name('login');
Route::get('logout','LoginController@logout')->name('logout');
//中心
Route::get('memberhouse','MemberController@index')->name('member');
Route::get('member/{rout?}','MemberController@store')->name('memberstore');
Route::post('membersearch','MemberController@search')->name('search');
//商品
Route::post('show','ProductController@show')->name('show');
