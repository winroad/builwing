@extends('layouts.f4.user.base')
@section('content')
@if(isset($midoku))
<div data-alert class="alert-box alert">
	{{ $midoku }}
</div>
@endif
<h2>ようこそ</h2>
<p>Topページですよ。</p>
@stop