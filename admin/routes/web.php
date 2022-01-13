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
Route::get('/', 'HomeController@index')->name('home');
//註冊
Route::get('registview','RegisterController@index')->name('regist');
Route::post('regist','RegisterController@register')->name('register');
//登入｜登出
Route::get('log','LoginController@index')->name('log');
Route::post('login','LoginController@login')->name('login');
Route::get('logout','LoginController@logout')->name('logout');
//商品操作
Route::get('product/{rout?}','ProductController@index')->name('product');
Route::post('addproduct','ProductController@add')->name('addproduct');
Route::post('findproduct','ProductController@store')->name('findproduct');
Route::post('editproduct','ProductController@up')->name('editproduct');
//會員操作
Route::get('member','MemberController@index')->name('member');
Route::post('findmember','MemberController@store')->name('findmember');
Route::post('editmember','MemberController@up')->name('editmember');
Route::post('editmemberpassword','MemberController@editPassword')->name('editpsw');
//訂單操作
