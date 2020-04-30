<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    //db:seedコマンドで実行される
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(TodosTableSeeder::class);//todoテーブルへのサンプルデータ格納用のTodosTableSeederファイルを呼び出す
    }
}
