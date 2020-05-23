<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//Modelクラスを継承することでDBを操作するメソッドをTodoクラスから使用することができる
class Todo extends Model
{
    use SoftDeletes;//ソフトデリートを使用するため

    //予期せぬ代入を防ぐため$fillabelでsaveメソッド等で代入を許可するカラムを指定する
    protected $fillable = [
        'title',//titleカラムは代入可能
        'user_id',//user_idカラムは代入可能
    ];

    //引数のidとテーブルのuser_idが合致するデータを取得する
    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }
}
