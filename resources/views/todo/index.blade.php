@extends ('layouts.app')<!-- layouts配下のapp.blade.phpを継承する -->
@section ('content')<!-- 親テンプレートのyield部分にsection~endsectionの内容を表示 -->

<h1 class="page-header">ToDo一覧</h1>
<p class="text-right">
  <a class="btn btn-success" href="/todo/create">ToDoを追加</a>
</p>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th>やること</th>
      <th>作成日時</th>
      <th>更新日時</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <!-- TodoControllerから受け取ったtodosテーブルのデータをforeachで1レコードずつ出力する -->
    <!-- 下記のは{ { } }は< ?= ?>と同様にphpの記述ができ値の出力を行う -->
    @foreach ($todos as $todo)
      <tr><!-- TodoController -->
        <td class="align-middle">{{ $todo->title }}</td><!-- $todoのtitleカラムを出力する -->
        <td class="align-middle">{{ $todo->created_at }}</td><!-- $todoのcreated_atカラムを出力する -->
        <td class="align-middle">{{ $todo->updated_at }}</td><!-- $todoのupdated_atカラムを出力する -->
        <td><a class="btn btn-primary" href="{{ route('todo.edit', $todo->id) }}">編集</a></td><!-- ルーティングされたtodo.editのURLに$todo->idで取得したidカラムをパラメータにセットして出力される -->
        <td>
          <!-- Formファサードのopenメソッドでformを作成する -->
          <!-- openメソッドの引数として第一引数にaction属性としてルーティングした'todo.destroy'とパラメータの$todo->id、第二引数にDELETEメソッドを指定 -->
          <!-- laravelcollective/htmlでformタグを作成する場合は自動でCSRF対策用のトークンを挿入して送信時に送信側とセッションのトークンの一致確認を行う -->
          {!! Form::open(['route' => ['todo.destroy', $todo->id], 'method' => 'DELETE']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}<!-- subimitメソッドで削除用の削除ボタンを作成 -->
          {!! Form::close() !!}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection