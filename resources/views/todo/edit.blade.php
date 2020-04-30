@extends ('layouts.app')<!-- layouts配下のapp.blade.phpを継承する -->
@section ('content')<!-- 親テンプレートのyield部分にsection~endsectionの内容を表示 -->

<h2 class="mb-3">ToDo編集</h2>
<!-- Formファサードのopenメソッドでformを作成する -->
<!-- openメソッドの引数として第一引数にaction属性としてルーティングした'todo.update'とパラメータの$todo->id、第二引数にPUTメソッドを指定 -->
<!-- laravelcollective/htmlでformタグを作成する場合は自動でCSRF対策用のトークンを挿入して送信時に送信側とセッションのトークンの一致確認を行う -->
{!! Form::open(['route' => ['todo.update', $todo->id], 'method' => 'PUT']) !!}
  <div class="form-group">
    <!-- inputメソッドの引数として順にtype->'text',name->'title',value->$todo->title,その他属性として必須とするrequired,class->form-control,placeholder->ToDo内容を指定する -->
    {!! Form::input('text', 'title', $todo->title, ['required', 'class' => 'form-control']) !!}
  </div>
  <!-- subimitメソッドで更新用の更新ボタンを作成 -->
  {!! Form::submit('更新', ['class' => 'btn btn-success float-right']) !!}
{!! Form::close() !!}

@endsection