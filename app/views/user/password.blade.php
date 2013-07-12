@extends('layouts.f4.user.base')
@section('content')
<h3>Password変更</h3>
<div data-alert class='alert-box success'>
新しいパスワードを8～16文字以内で入力してください。
<a href="#" class="close">&times;</a>
</div>
{{ Form::open(array('url'=>'user/password/reset/'.Auth::user()->id)) }}
{{ Form::password('password','') }}
@if($errors->has('password'))
<div data-alert class='alert-box alert'>
{{ $errors->first('password') }}
<a href="#" class="close">&times;</a>
</div>
@endif
{{ Form::submit('更新',array('class'=>'button')) }}
{{ Form::close() }}
@stop