@extends('layouts.f4.base')
@section('content')
<h3>ユーザー新規作成</h3>
{{ Form::open() }}
{{ Form::label('name','氏名') }}
{{ Form::text('name',Input::old('name','')) }}
@if($errors->has('name'))
<h4 style="color:red;text-align:center">{{ $errors->first('name') }}</h4>
@endif
{{ Form::label('email','メール') }}
{{ Form::text('email',Input::old('email','')) }}<br>
@if($errors->has('email'))
<h4 style="color:red;text-align:center">{{ $errors->first('email') }}</h4>
@endif
{{ Form::label('password','パスワード') }}
{{ Form::password('password') }}<br>
@if($errors->has('password'))
<h4 style="color:red;text-align:center">{{ $errors->first('password') }}</h4>
@endif
{{ Form::submit('新規作成',array('class'=>'button')) }}
{{ Form::close() }}
@stop
