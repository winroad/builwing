@extends('layouts.f4.user.base')
@section('content')
<h4>ようこそ{{ Auth::user()->name }}さん</h4>
<p>UserのTOPページです。</p>
@stop