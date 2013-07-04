@extends('layouts.f4.user.base')
@section('content')
<ul>
	<li>電話番号 : {{ $profile->tel }}</li>
  @if(isset($address))
  <li>住所情報
  	<ul>
    @foreach($address as $key=>$value)
  		<li>{{HTML::link('profile/update/address/'.$key,$key)}} : {{$value}}</li>
    @endforeach
  	</ul>
  </li>
  @endif
  @if(isset($body))
  <li>{{ HTML::link('profile/update','身体情報') }}
  	<ul>
    @foreach($body as $key=>$value)
  		<li>{{ HTML::link('profile/update/body/'.$key,$key) }} : {{ $value }}</li>
    @endforeach
  	</ul>
  </li>
  @endif
  @if(isset($license))
  <li>資格情報
  	<ul>
    @foreach($license as $key=>$value)
  		<li>{{ HTML::link('profile/update/license/'.$key,$key) }} : {{ $value }}</li>
    @endforeach
  	</ul>
  </li>
  @endif
  @if(isset($labor))
  <li>労務情報
  	<ul>
    @foreach($labor as $key=>$value)
  		<li>{{ HTML::link('profile/update/labor/'.$key,$key) }} : {{ $value }}</li>
    @endforeach
  	</ul>
  </li>
  @endif
  @if(isset($family))
  <li>家族情報
  	<ul>
    @foreach($family as $key=>$value)
  		<li>{{ HTML::link('profile/update/family/'.$key,$key) }} : {{ $value }}</li>
    @endforeach
  	</ul>
  </li>
  @endif
  @if(isset($note))
  <li>備考
  	<ul>
    @foreach($note as $key=>$value)
  		<li>{{ HTML::link('profile/update/note/'.$key,$key) }} : {{ $value }}</li>
    @endforeach
  	</ul>
  </li>
  @endif
</ul>
@stop