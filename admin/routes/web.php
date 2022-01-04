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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

use App\Http\Controllers\HomeController;
use Illuminate\Auth\Access\Response;

Route::get('/test', function(){
    return App\User::all();
});
 
Route::get('/storehouse/{rout?}', 'StorehouseController@jump')->name('house.jump');
Route::get('/storehouse', 'StorehouseController@store')->name('house.store');

