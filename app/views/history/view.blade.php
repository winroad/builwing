@extends('layouts.f4.admin.base')
@section('content')
@if(count($histories) != 0)
<ul>
	@foreach($histories as $history)
  	<li>項目名：{{ Item::find($history->item_id)->name }}</li>
		<li>更新内容：{{ $history->old }}=>{{ $history->new }}</li>
		<li>更新日：{{ $history->created_at }}</li>
		<li>更新者：{{ $history->user->name }}</li>
    <hr>
  @endforeach
  </li>
</ul>
@else
<h2>更新履歴はありません</h2>
@endif
@stop