@extends('layouts.f4.user.base')
@section('content')
<h2>未読メッセージ</h2>
{{-- var_dump($message) --}}<br>
{{--
@foreach($message as $k1=>$v1)
	{{ $k1 }} :
	@foreach($v1 as $k2=>$v2)
	{{ $k2 }} : {{ HTML::link('message/unread/'.$k2,$v2) }}<br>
	{{ $v2 }}<br>
  @endforeach
  <hr>
@endforeach
--}}
<table width="100%" border="0">
  <tr>
    <th widht="70%">メッセージ</th>
    <th width="15%">送信者</th>
    <th width="15%">日付</th>
  </tr>
@foreach($message as $key=>$value)
  <tr>
    <td>{{ HTML::link('message/unread/'.$value->id.'/'.$key,$value->subject) }}</td>
    <td>{{ User::find($value->sender_id)->name }}</td>
    <td>{{ date('m/d',strtotime($value->created_at)) }}</td>
  </tr>
@endforeach
</table>

@stop