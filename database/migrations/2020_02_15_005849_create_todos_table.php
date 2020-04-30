<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //up()はテーブル、カラムの追加を行う関数
    public function up()
    {
        //schemaクラスのcreateメソッドを使いtodosテーブルを追加する
        Schema::create('todos', function (Blueprint $table) {
            //$tableに対してカラム型のメソッドで追加していく
            //メソッドの引数にはカラム名を記述
            $table->increments('id');
            $table->string('title');
            $table->timestamps();//テーブルのカラムにcreatede_atとupdated_atを追加する
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    //down()はup()で作成したテーブルを削除する
    //ロールバックコマンドで実行される
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
