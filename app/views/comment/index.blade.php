@extends('layouts.f4.user.base')
@section('content')
<div class='row'>
<div class='large-8 column'>	
<h4>{{ $title }}</h4>
</div>
<div class='large-4 column'>
<div class='row collapse'>
	{{ Form::open(array('url'=>'comment/search')) }}
  <div class="large-9 small-6 columns">
  {{ Form::text('search','',array('placeholder'=>' コメント検索')) }}
  </div>
  <div class="large-3 small-6 columns">
  {{ Form::submit('検索',array('class'=>'button small')) }}
  </div>
  {{ Form::hidden('action',$action) }}
  {{ Form::close() }}
</div>
</div>
@if(isset($comments))
<table width="100%" border="0">
<tr>
	<th>タイトル</td>
	<th>送信者</td>
	<th>日付</td>
</tr>
@foreach($comments as $comment)
  <tr>
    <td width="70%">{{ HTML::link('comment/view/'.$comment->id,$comment->body,array('class'=>'button expand')) }}</td>
    <td width="13%">
    {{ User::find($comment->user_id)->name }}
    </td>
    <td width="13%">
    {{ date('n月j日',strtotime($comment->created_at)) }}
    </td>
  </tr>
@endforeach
</table>
<h5>{{ $comments->links() }}</h5>
@endif
</div>
@stop