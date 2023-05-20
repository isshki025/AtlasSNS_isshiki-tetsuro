@extends('layouts.logout')

@section('content')
{!! Form::open(['url' => '/login']) !!}

<p class="title">AtlasSNSへようこそ</p>

@if ($errors->any())
<div class="error-wrapper">
  @foreach ($errors->all() as $error)
  <p class="error">{{ $error }}</p>
  @endforeach
</div>
@endif

{{ Form::label('mail address') }}
{{ Form::text('mail',null,['class' => 'input']) }}
{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}

{{ Form::submit('LOGIN') }}

<p><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

@endsection
