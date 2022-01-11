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
Route::get('registview','RegisterController@index')->name('regist');
Route::post('regist','RegisterController@register')->name('register');
Route::get('log','LoginController@index')->name('log');
Route::post('login','LoginController@login')->name('login');
Route::get('logout','LoginController@logout')->name('logout');
// Route::get('/homes', 'HomesController@index')->name('loghome');
// Route::get('/member', 'MemberController@index')->name('member.index')->middleware('auth');
//Route::post('/register@create', )->name('register');