@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}


<h2>新規ユーザー登録</h2>

{{ Form::label('user name') }}
{{ Form::text('username',null,['class' => 'input']) }}
@if ($errors->has('username'))
<span class="invalid-feedback" role="alert">
  {{ $errors->first('username') }}
</span>
@endif

{{ Form::label('mail address') }}
{{ Form::text('mail',null,['class' => 'input']) }}
@if ($errors->has('mail'))
<span class="invalid-feedback" role="alert">
  {{ $errors->first('mail') }}
</span>
@endif

{{ Form::label('password') }}
{{ Form::password('password',null,['class' => 'input']) }}
@if ($errors->has('password'))
<span class="invalid-feedback" role="alert">
  {{ $errors->first('password') }}
</span>
@endif

{{ Form::label('password confirm') }}
{{ Form::password('password_confirmation',null,['class' => 'input']) }}
@if ($errors->has('password_confirmation'))
<span class="invalid-feedback" role="alert">
  {{ $errors->first('password_confirmation') }}
</span>
@endif

{{ Form::submit('REGISTER') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
