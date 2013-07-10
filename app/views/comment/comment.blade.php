@extends('laytouts.f4.user.base')
@section('content')
<h3>コメントの作成</h3>
{{ Form::open() }}
{{ Form::text('comment','',array('placeholder'=>'コメントを入力してください。')) }}
{{ Form::submiti() }}
{{ Form::close() }}
@stop