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
{{ Form::hidden('recipient_id',$message->user_id) }}
{{ Form::hidden('role_name',$message->role_name) }}
{{ Form::close() }}
<table width="100%" border="0">
  <th colspan="2">メッセージ内容</th>
  </th>
  <tr>
    <th width="20%" scope="row">送信者</th>
    <td width="77%">{{ (User::find($message->user_id)->name) }}</td>
  </tr>
  @if(isset($message->recipient_id))
  <tr>
    <th scope="row">送信先</th>
    <td>
    {{ isset($message->recipient_id) ? User::find($message->recipient_id)->name : null }}
    </td>
  </tr>
  @endif
  @if(isset($message->role_name))
  <tr>
    <th scope="row">送信先</th>
    <td>{{ Win::ser($message->role_name,'　') }}</td>
  </tr>
  @endif
  <tr>
    <th scope="row">タイトル</th>
    <td>{{ $message->subject }}</td>
  </tr>
  <tr>
    <th scope="row">内容</th>
    <td>{{ $message->body }}</td>
  </tr>
</table>
@stop