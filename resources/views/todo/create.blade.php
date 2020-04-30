@extends ('layouts.app')<!-- layouts配下のapp.blade.phpを継承する -->
@section ('content')<!-- 親テンプレートのyield部分にsection~endsectionの内容を表示 -->

<h2 class="mb-3">ToDo作成</h2>
<!-- Formファサードのopenメソッドでformを作成する -->
<!-- openメソッドの引数としてルーティングした'todo.store'を指定 -->
<!-- laravelcollective/htmlでformタグを作成する場合は自動でCSRF対策用のトークンを挿入して送信時に送信側とセッションのトークンの一致確認を行う -->
{!! Form::open(['route' => 'todo.store']) !!}
  <div class="form-group">
    <!-- inputメソッドの引数として順にtype->'text',name->'title',value->null,その他属性として必須とするrequired,class->form-control,placeholder->ToDo内容を指定する -->
    {!! Form::input('text', 'title', null, ['required', 'class' => 'form-control', 'placeholder' => 'ToDo内容']) !!}
  </div>
  <!-- subimitメソッドで追加用の追加ボタンを作成 -->
  {!! Form::submit('追加', ['class' => 'btn btn-success float-right']) !!}
{!! Form::close() !!}

@endsection