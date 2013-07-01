@extends('layouts.f4.admin.base')
@section('content')
<h1>ようこそ{{ Auth::user()->name }}さん</h1>
<p>AdminのTOPページです。</p>
@stop