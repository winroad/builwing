@extends('layouts.f4.user.base')
@section('content')
<h2>受信メッセージ一覧</h2>
<table width="100%" border="0">
  <tr>
@foreach($messages as $message)
    <td width="47%">{{ $message->subject }}</td>
    <td width="25%">送信者：{{ User::find($message->sender_id)->name }}</td>
    <td width="25%">日付：{{ $message->created_at }}</td>
  </tr>
  <tr>
    <td colspan="3">{{ $message->body }}</td>
  </tr>
@endforeach
</table>
@stop