<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Illuminate\Support\Facades\DB;
use Auth;

class TodoController extends Controller
{
    
    private $todo;//Todoクラスのインスタンスを代入するためのprivate変数

    public function __construct(Todo $instanceClass)
    {
        /*
        コンストラクタインジェクションしたTodoクラスのインスタンスをtodo変数へ代入
        $this->todoは自分のクラスの上記$todo変数を表す
        Todoクラスのインスタンスをtodo変数へ代入することでDBへの操作をtodo変数から行える
        */
        $this->middleware('auth');//認証済みユーザだけがコントローラのアクションにアクセスできるように保護する
        $this->todo = $instanceClass;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //一覧画面表示用メソッド
    public function index()
    {
        /*
        todosテーブルの全レコードをallメソッドで取得し$todosに代入する
        allメソッドでは各レコードを連想配列で返す
        */
        //$todos = $this->todo->all();
        //Auth::id()で現在認証されているユーザのIDを取得
        //getByUserIdメソッドの引数に指定して、認証中のユーザのIDに合致するデータのみを取得する
        $todos = $this->todo->getByUserId(Auth::id());
        /*
        views/todo/index.blade.phpを表示し、$todosの値を渡す
        compactメソッドで$todosを連想配列としてindex.blade.phpへ渡す
        */
        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Todo内容更新用メソッド
    public function create()
    {
        //views/todo/create.blade.phpを表示する
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //新規データ追加用メソッド
    //Request $requestでFromタグでリクエストした情報を取得する
    public function store(Request $request)
    {
        //$requestのallメソッドでリクエスト時の情報を連想配列で取得し$inputへ代入する
        $input = $request->all();
        //リクエストの配列のキーにuser_idを追加し、値としてAuth::id()で取得した認証中のユーザIDを格納する
        $input['user_id'] = Auth::id();
        //fill($input)でリクエストで取得した情報が設定できるかどうか$fillableをチェックして確認する
        //saveメソッドでDBへ保存する
        //DB::enableQueryLog();
        $this->todo->fill($input)->save();
        //dd(DB::getQueryLog());
        //redirect()->to()の引数にtodoを指定することでhttp://127.0.0.1:8000/todoへ遷移する
        return redirect()->to('todo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Todo内容編集用メソッド
    //パラメータとして対象データレコードのidを引数に指定する
    public function edit($id)
    {
        //テーブルから引数の$id(idカラム)に合致するレコードを取得する
        $todo = $this->todo->find($id);
        //views/todo/edit.blade.phpを表示し、compactメソッドで$todo配列として渡す
        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Todo内容更新用メソッド
    //Requestクラスのインスタンスの$requestと対象データレコードのidを引数として指定する
    public function update(Request $request, $id)
    {
        //$requestへallメソッドで取得したリクエスト情報を$input変数へ代入する
        $input = $request->all();
        /*
        todo->find($id)で$idに合致するレコードを取得する
        fill($input)で更新できるカラムかをチェックする
        save()でDBへ保存する
        */
        //DB::enableQueryLog();
        $this->todo->find($id)->fill($input)->save();
        //dd(DB::getQueryLog());
        //ルーティングがtodoの一覧表示画面を表示する
        return redirect()->to('todo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //対象データ削除用メソッド
    //対象データレコードのidを引数に指定する
    public function destroy($id)
    {
        //$this->todo->find($id)で$idに合致するレコードを取得する
        //delete()で上記レコードをDBから削除する
        $this->todo->find($id)->delete();
        //ルーティングがtodoの一覧表示画面を表示する
        return redirect()->to('todo');
    }
}
