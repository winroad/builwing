@extends('layouts.f4.admin.base')
@section('content')
<h2>プロフィールindex</h2>

<table width="100%" border="0">
  <tr>
    <th scope="col">ID</th>
    <th scope="col">ユーザー名</th>
    <th scope="col">電話番号</th>
    <th scope="col">操作</th>
  </tr>
@foreach($profiles as $pro)
  <tr>
    <td>{{ $pro->id }}</td>
    <td>{{ $pro->user->name }}</td>
    <td>{{ $pro->tel }}</td>
    <td>
    {{ HTML::link('admin/profile/view/'.$pro->id,'詳細') }}&nbsp;
    {{ HTML::link('admin/profile/update/'.$pro->id,'修正') }}
    </td>
  </tr>
@endforeach
</table>
@stop