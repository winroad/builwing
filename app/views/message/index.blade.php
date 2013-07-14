@extends('layouts.f4.user.base')
@section('content')
<div class='row'>
<div class='large-8 column'>
@if(isset($title))
 <h4>{{ $title }}</h4>
@endif
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
  {{ Form::hidden('action',$action) }}
  {{ Form::close() }}
  </div>
</div>
</div>
@if(isset($messages))
<table width="100%" border="0">
<tr>
	<th>タイトル</td>
	<th>送信者</td>
	<th>日付</td>
</tr>
  <tr>
@foreach($messages as $message)
    <td width="70%">{{ HTML::link('message/view/'.$message->id,$message->subject,array('class'=>'button expand')) }}</td>
    <td width="12%">{{ User::find($message->user_id)->name }}</td>
    <td width="12%">{{ date('n月j日',strtotime($message->created_at)) }}</td>
  </tr>
@endforeach
</table>
<h5>{{ $messages->links() }}</h5>
@endif
@stop