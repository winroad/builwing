@extends('layouts.f4.user.base')
@section('content')
@if(isset($warning))
	<div data-alert class="alert-box alert radius">
		{{ $warning }}
  <a href="#" class="close">&times;</a>
  </div>
@else
<h2>未読コメント</h2>
@endif
@if(isset($comments))
<table width="100%" border="0">
  <tr>
    <th width="70%" scope="col">タイトル</th>
    <th width="15%" scope="col">送信者</th>
    <th width="15%" scope="col">日付</th>
  </tr>
	@foreach($comments as $key=>$comment)
  <tr>
    <td>
<!--<div class="alert-box success tiny">
-->    {{ HTML::link('comment/unread/'.$comment->id.'/'.$key,$comment->body,array('class'=>'button small alert expand')) }}
<!--</div>
-->    </td>
    <td>{{ User::find($comment->user_id)->name }}</td>
    <td>{{ date('n月j日',strtotime($comment->created_at)) }}</td>
  </tr>
  @endforeach
</table>
@endif
@stop