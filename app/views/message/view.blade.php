@extends('layouts.f4.user.base')
@section('content')
<h3>メッセージ詳細</h3>
<ul class='button-group right'>
	<li>{{ HTML::link('message','受信',array('class'=>'button')) }}</li>
	<li>{{ HTML::link('message/index/sent','送信',array('class'=>'button')) }}</li>
</ul>
@if(isset($message))
<table width="100%" border="0">
  <tr>
    <th width="20%" scope="row">ID</th>
    <td width="77%">{{ $message->id }}</td>
  </tr>
  <tr>
    <th scope="row">送信者</th>
    <td>{{ (User::find($message->user_id)->name) }}</td>
  </tr>
  @if(isset($message->recipient_id))
  <tr>
    <th scope="row">送信先</th>
    <td>
    {{ isset($message->recipient_id) ? User::find($message->recipient_id)->name : null }}
    </td>
  </tr>
  @else
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
  <tr>
    <th scope="row">作成日</th>
    <td>{{ $message->created_at }}</td>
  </tr>
  <tr>
    <th scope="row">更新日</th>
    <td>{{ $message->updated_at }}</td>
  </tr>
  <tr>
    <th scope="row">
    {{ HTML::link('comment/create/'.$message->id,'コメント',array('class'=>'button')) }}
    </th>
    <td>
    <ul>
    	@foreach($message->comments as $comment)
      	<li>{{ $comment->body }}</li>
      @endforeach
    </ul>
    </td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
</table>
@endif
@stop