@extends('layouts.f4.user.base')
@section('content')
<h2>コメント作成</h2>
	{{ Form::open(array('url'=>'message/comment/'.$action.'/'.$key)) }}
  {{ Form::label('コメント') }}
  {{ Form::textarea('comment','',array('rows'=>10)) }}
  @if($errors->has('comment'))
  	<div class="alert-box alert">
    {{ $errors->first('comment') }}
    </div>
  @endif
  {{ Form::submit('入力',array('class'=>'button')) }}
  {{ Form::close() }}
@stop