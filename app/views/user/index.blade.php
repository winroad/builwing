@extends('layouts.f4.user.base')
@section('content')
@if(isset($warning))
<div class="alert-box alert">
{{ $warning }}
</div>
@endif
@if(isset($message))
<nobr>
<marquee loop="-1">
<!--<div data-alert class="alert-box alert">
-->	<h5>{{ HTML::link('message/unread',$message,array('style'=>'color:red')) }}</h5>
</div>
</marquee>
</nobr>
@endif
<br>
@if(isset($comment))
<nobr>
<marquee loop="-1">
<!--<div data-alert class="alert-box alert">
-->	<h5>{{ HTML::link('comment/unread',$comment,array('style'=>'color:red')) }}</h5>
</div>
</marquee>
</nobr>
@endif
<h2>ようこそ</h2>
<p><span id="t1">{{ Auth::user()->name}}</span>さんのTopページですよ。</p>
@stop