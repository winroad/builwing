@extends('layouts.f4.user.bae')
@section('content')
<h2>テーブルの修正履歴</h2>
<ul>
@foreach($tables as $tbl)
<li>テーブル名　：　{{ $tbl->name }}</li>
<li>説明　：　{{ $tbl->description }}</li>
<li>更新日　：　{{ $tbl->created_at }}</li>
@endforeach
</ul>
@stop