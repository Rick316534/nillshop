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
Route::get('load', 'HomeController@onload')->name('onload');
//註冊
Route::get('registview', 'RegisterController@index')->name('regist');
Route::post('regist', 'RegisterController@register')->name('register');

//登入驗證通過才可使用的路徑

//登入登出
Route::get('log', 'LoginController@index')->name('log');
Route::post('login', 'LoginController@login')->name('login');
Route::get('logout', 'LoginController@logout')->name('logout');
//中心
Route::get('memberhouse', 'MemberController@index')->name('member');
Route::get('member/{rout?}', 'MemberController@store')->name('memberstore');
Route::post('membersearch', 'MemberController@search')->name('search');
Route::post('memberup', 'MemberController@up')->name('up');
Route::post('membernewpsw', 'MemberController@editPassword')->name('newpsw');
//商品
Route::get('show/{id?}', 'ProductController@show')->name('show');
Route::post('productstore', 'ProductController@store')->name('productstore');
Route::post('Pnamesearch', 'ProductController@search')->name('Pnamesearch');//首頁搜尋功能
Route::post('Pidsearch', 'ProductController@idsearch')->name('Pidsearch');//首頁分類功能

//Route::post('showintroduce/{id}','ProductController@show')->name('show');
//購物車
Route::get('carshow','CarController@index' )->name('car');//進入購物車
Route::post('carset', 'CarController@carset')->name('carset');//加入購物車
Route::post('cardel', 'CarController@delete')->name('cardel');//購物車刪除商品
Route::post('carpay', 'CarController@pay')->name('carpay');//紀錄單一購物商品
//結帳
Route::get('payshow', 'PayController@index')->name('payshow');//結帳畫面
Route::get('directpay', 'PayController@directpay')->name('pay');//直接結帳
//訂單
Route::post('orderset', 'OrderController@set')->name('send');//建立訂單
Route::post('orderall', 'OrderController@all')->name('allo');//訂單列表
Route::post('ordersetid', 'OrderController@setid')->name('setpid');//建立session
Route::post('ordersearch', 'OrderController@search')->name('searcho');//訂單搜尋
Route::post('orderback', 'OrderController@back')->name('back');//建立退貨單
//退貨
