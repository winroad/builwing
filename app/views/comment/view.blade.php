@extends('layouts.f4.user.base')
@section('content')
<h3>コメント詳細</h3>
<ul class='button-group right'>
	<li>{{ HTML::link('message/index','一覧',array('class'=>'button')) }}</li>
	<li>{{ HTML::link('message/unread','未読',array('class'=>'button')) }}</li>
</ul>
@if(isset($comments))
<table width="100%" border="0">
  <tr>
    <th colspan="2">コメント詳細</th>
  </tr>
  <tr>
    <th width="20%" scope="row">内容</th>
    <td width="77%">{{ $comments->body }}</td>
  </tr>
  <tr>
    <th scope="row">送信者</th>
    <td>{{ User::find($comments->message->user_id)->name }}</td>
  </tr>
  @if(isset($comment->recipient_id))
  <tr>
    <th scope="row">送信先</th>
    <td>
    {{ isset($comments->recipient_id) ? User::find($messages->recipient_id)->name : null }}
    </td>
  </tr>
  @endif
  @if(isset($comment->role_id))
  <tr>
    <th scope="row">送信先</th>
    <td>{{ isset($comments->role_id) ? Role::find($comments->role_id)->name : null }}</td>
  </tr>
  @endif
  <tr>
    <th scope="row">作成日</th>
    <td>{{ $comments->created_at }}</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <th colspan="2">メッセージ詳細</th>
  </tr>
  <tr>
    <th width="20%" scope="row">タイトル</th>
    <td widht="77%">{{ $comments->message->subject }}</td>
  </tr>
  <tr>
    <th scope="row">内容</th>
    <td>{{ $comments->message->body }}</td>
  </tr>  
  <tr>
    <th scope="row">送信者</th>
    <td>{{ User::find($comments->user_id)->name }}</td>
  </tr>
  @if(isset($comments->message->recipient_id))
  <tr>
    <th scope="row">送信先</th>
    <td>{{ isset($comments->message->recipient_id) ? Role::find($comments->message->recipient_id)->name : null }}</td>
  </tr>
  @endif
  @if(isset($comments->message->role_id))
  <tr>
    <th scope="row">送信先</th>
    <td>{{ (isset($comments->message->role_id) ? Role::find($comments->message->role_id)->name : null).'　全員へ' }}</td>
  </tr>
  @endif
  <tr>
    <th scope="row">作成日</th>
    <td>{{ $comments->message->created_at }}</td>
  </tr>
  <tr>
    <th scope="row">更新日</th>
    <td>{{ $comments->message->updated_at }}</td>
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