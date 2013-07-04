@extends('layouts.f4.admin.base')
@section('content')
グループのView.blade.phpです。
<table width="100%" border="1">
  <tr>
    <th scope="row">ID</th>
    <td>{{ $group->id }}</td>
  </tr>
  <tr>
    <th scope="row">部署名</th>
    <td>{{ $group->name }}</td>
  </tr>
  <tr>
    <th scope="row">住所関連</th>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">業務関連</th>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">内部情報</th>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">備考</th>
    <td>&nbsp;</td>
  </tr>
</table>

@stop