@extends('layouts.f4.user.base')
@section('content')
<h3>コメント詳細</h3>
<ul class='button-group right'>
	<li>{{ HTML::link('comment','受信',array('class'=>'button')) }}</li>
	<li>{{ HTML::link('comment/index/sent','送信',array('class'=>'button')) }}</li>
</ul>
@if(isset($comment))
<table width="100%" border="0">
  <tr>
    <th colspan="2">コメント詳細</th>
  </tr>
  <tr>
    <th width="20%" scope="row">内容</th>
    <td width="77%">{{ $comment->body }}</td>
  </tr>
  <tr>
    <th scope="row">送信者</th>
    <td>{{ User::find($comment->user_id)->name }}</td>
  </tr>
  @if(isset($comment->recipient_id))
  <tr>
    <th scope="row">送信先</th>
    <td>
    {{ isset($comment->recipient_id) ? User::find($comment->recipient_id)->name : null }}
    </td>
  </tr>
  @else
  <tr>
    <th scope="row">送信先</th>
    <td>
    {{ Win::ser($comment->role_name,'　') }}
    </td>
  </tr>
  @endif
  <tr>
    <th scope="row">作成日</th>
    <td>{{ $comment->created_at }}</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <th colspan="2">メッセージ詳細</th>
  </tr>
  <tr>
    <th width="20%" scope="row">タイトル</th>
    <td widht="77%">{{ $message->subject }}</td>
  </tr>
  <tr>
    <th scope="row">内容</th>
    <td>{{ $message->body }}</td>
  </tr>  
  <tr>
    <th scope="row">送信者</th>
    <td>{{ User::find($message->user_id)->name }}</td>
  </tr>
  @if(isset($message->recipient_id))
  <tr>
    <th scope="row">送信先</th>
    <td>{{ isset($message->recipient_id) ? Role::find($message->recipient_id)->name : null }}</td>
  </tr>
  @else
  <tr>
    <th scope="row">送信先</th>
    <td>{{ Win::ser($comment->message->role_name,'、') }}</td>
  </tr>
  @endif
  <tr>
    <th scope="row">作成日</th>
    <td>{{ $comment->message->created_at }}</td>
  </tr>
  <tr>
    <th scope="row">更新日</th>
    <td>{{ $comment->message->updated_at }}</td>
  </tr>
  <tr>
    <th scope="row">コメント一覧</th>
    <td>
  	@foreach($comments as $com)
    {{ $com->body }}<br>
    @endforeach
    </td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
</table>
@endif
@stop