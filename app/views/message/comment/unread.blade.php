@extends('layouts.f4.user.base')
@section('content')
<h2>新規コメント</h2>
@if(isset($comments))
<ul>
	@foreach($comments as $comment)
		<li>タイトル：{{ HTML::link('message/comment/check/'.$comment,Message::find($comment)->subject) }}</li>
  @endforeach
</ul>
@endif
@stop