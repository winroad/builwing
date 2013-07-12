@extends('layouts.f4.admin.base')
@section('content')
@if(isset($warning))
<div data-alert class='alert-box success'>
	{{ $warning }}
  <a href='#' class='close'>&times;</a>
</div>
@else
<h3>ようこそ{{ Auth::user()->name }}さん</h3>
@endif
<p>AdminのTOPページです。</p>
@stop