@extends('layouts.f4.user.base')
@section('content')
<div class='row'>
<div class='large-8 column'>	
<h4>受信メッセージ一覧</h4>
</div>
<div class='large-4 column'>
<div class='row collapse'>
	{{ Form::open(array('url'=>'message/search')) }}
  <div class="large-9 small-6 columns">
  {{ Form::text('search','',array('placeholder'=>' メッセージ検索')) }}
  </div>
  <div class="large-3 small-6 columns">
  {{ Form::submit('検索',array('class'=>'button small')) }}
  </div>
  {{ Form::close() }}
  </div>
</div>
</div>
@if(isset($messages))
<table width="100%" border="0">
  <tr>
@foreach($messages as $message)
    <td width="65%">{{ HTML::link('message/view/'.$message->id,$message->subject,array('class'=>'button large expand')) }}</td>
    <td width="20%">送信者：{{ User::find($message->sender_id)->name }}</td>
    <td width="15%">{{ date('n月j日',strtotime($message->created_at)) }}</td>
  </tr>
  <tr>
    <td colspan="3">{{ $message->body }}</td>
  </tr>
@endforeach
</table>
<h5>{{ $messages->links() }}</h5>
@endif
@stop