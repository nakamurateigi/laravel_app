<?php

use Illuminate\Database\Seeder;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncateメソッドでtodosのテーブルのデータを全件削除する
        DB::table('todos')->truncate();
        //DBファサードを使ってtodosテーブルにinsertメソッドでサンプルデータを配列として指定して追加する
        DB::table('todos')->insert([
            [
                'title'      => 'Laravel Lessonを終わらせる',//titleカラムへ格納するデータ
                'created_at' => Carbon::create(2018, 1, 1),//created_atへ格納するデータ
                'updated_at' => Carbon::create(2018, 1, 4),//updated_atへ格納するデータ
            ],
            [
                'title'      => 'レビューに向けて理解を深める',//titleカラムへ格納するデータ
                'created_at' => Carbon::create(2018, 2, 1),//created_atへ格納するデータ
                'updated_at' => Carbon::create(2018, 2, 5),//updated_atへ格納するデータ
            ],
        ]);
    }
}
