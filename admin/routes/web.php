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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'LoginController@index')->name('log');
//註冊
Route::get('registview','RegisterController@index')->name('regist');
Route::post('regist','RegisterController@register')->name('register');
//登入｜登出
Route::get('log','LoginController@index')->name('log');
Route::post('login','LoginController@login')->name('login');
Route::get('logout','LoginController@logout')->name('logout');
//商品操作
Route::get('product/{rout?}','ProductController@index')->name('product'); //跳轉到列表頁面
Route::post('productall','ProductController@all')->name('allp'); //列表資料
Route::post('productsearch','ProductController@search')->name('searchp');//使用搜尋功能
Route::post('productdelete','ProductController@delete')->name('deletep');//刪除商品
Route::post('productset','ProductController@set')->name('idset'); //session存取id
Route::get('productload','ProductController@onload')->name('onloadp'); //商品頁面
Route::post('findproduct','ProductController@store')->name('findproduct');//商品資料表內容
Route::post('addproduct','ProductController@add')->name('addproduct'); //新增商品
Route::post('editproduct','ProductController@up')->name('editproduct'); //編輯商品
//會員操作
Route::get('member','MemberController@index')->name('member');//跳轉到列表頁面
Route::post('memberall','MemberController@all')->name('all'); //列表資料
Route::post('membersearch','MemberController@search')->name('search'); //使用尋功能
Route::post('memberdelete','MemberController@delete')->name('delete'); //刪除帳號
Route::post('memberset','MemberController@set')->name('emailset'); //session存取email
Route::get('memberonload','MemberController@onload')->name('onloadm'); //打開個人資料表
Route::post('findmember','MemberController@store')->name('findmember'); //個人資料表內容
Route::post('editmember','MemberController@up')->name('editmember'); //更改內容
Route::post('editmemberpassword','MemberController@editPassword')->name('editpsw'); //更改密碼
//訂單操作
