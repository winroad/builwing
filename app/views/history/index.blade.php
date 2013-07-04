@extends('layouts.f4.admin.base')
@section('content')
<h2>更新履歴</h2>
<ul>
@foreach($profiles as $profile)
 <li>プロフィール　：　{{ HTML::link('history/view/'.$profile->id,$profile->user->name) }} </li>
@endforeach
</ul>
@stop