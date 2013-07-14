@extends('layouts.f4.user.base')
@section('content')
<h3>コメントの作成</h3>
{{ Form::open() }}
{{ Form::text('body','',array('placeholder'=>'コメントを入力してください。','style'=>'ime-mode:active')) }}
@if($errors->has('body'))
<div data-alert class="alert-box alert">
{{ $errors->first('body') }}
</div>
@endif
{{ Form::submit('作成',array('class'=>'button')) }}
{{ Form::hidden('message_id',$message->id) }}
{{ Form::hidden('recipient_id',$message->recipient_id) }}
{{ Form::hidden('role_id',$message->role_id) }}
{{ Form::close() }}
@stop