@extends('layouts.f4.user.base')
@section('content')
@if(isset($warning))
	<div data-alert class="alert-box alert radius">
		{{ $warning }}
  <a href="#" class="close">&times;</a>
  </div>
@else
<h2>未読メッセージ</h2>
@endif
@if(isset($message))
<table width="100%" border="0">
  <tr>
    <th widht="70%">メッセージ</th>
    <th width="15%">送信者</th>
    <th width="15%">日付</th>
  </tr>
@foreach($message as $key=>$value)
  <tr>
    <td>{{ HTML::link('message/unread/'.$value->id.'/'.$key,$value->subject,array('class'=>'button small alert expand')) }}</td>
    <td>{{ User::find($value->sender_id)->name }}</td>
    <td>{{ date('m/d',strtotime($value->created_at)) }}</td>
  </tr>
@endforeach
</table>
@endif
@stop