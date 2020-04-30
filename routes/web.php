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
//Route::resourceでTodoControllerのメソッドへのルーティングを行う
//routeはroute:listコマンドで確認できる
Route::resource('todo', 'TodoController');

//Auth機能のルーティングを追加する
Auth::routes();

//http://127.0.0.1:8000/homeを指定した場合にHomeControllerのindexメソッドを呼び出す
//このルーティング名を'home'へ変更
Route::get('/home', 'HomeController@index')->name('home');
