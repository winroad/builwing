@extends('layouts.f4.user.base')
@section('content')
<h3>メッセージ詳細</h3>
<ul class='button-group right'>
	<li>{{ HTML::link('message/index','一覧',array('class'=>'button')) }}</li>
	<li>{{ HTML::link('message/unread','未読',array('class'=>'button')) }}</li>
</ul>
@if(isset($messages))
<table width="100%" border="0">
  <tr>
    <th width="20%" scope="row">ID</th>
    <td width="77%">{{ $messages->id }}</td>
  </tr>
  <tr>
    <th scope="row">送信者</th>
    <td>{{ User::find($messages->sender_id)->name }}</td>
  </tr>
  <tr>
    <th scope="row">送信先</th>
    <td>{{ isset(User::find($messages->recipient_id)->name) ?: null }}</td>
  </tr>
  <tr>
    <th scope="row">送信先グループ</th>
    <td>{{ isset($messages->group_id) ? Group::find($messages->group_id)->name : null }}</td>
  </tr>  
  <tr>
    <th scope="row">タイトル</th>
    <td>{{ $messages->subject }}</td>
  </tr>
  <tr>
    <th scope="row">内容</th>
    <td>{{ $messages->body }}</td>
  </tr>
  <tr>
    <th scope="row">作成日</th>
    <td>{{ $messages->created_at }}</td>
  </tr>
  <tr>
    <th scope="row">更新日</th>
    <td>{{ $messages->updated_at }}</td>
  </tr>
  <tr>
    <th scope="row">
    {{ HTML::link('comment/create/'.$messages->id,'コメント',array('class'=>'button')) }}
    </th>
    <td>
    <ul>
    	@foreach($messages->comments as $comment)
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