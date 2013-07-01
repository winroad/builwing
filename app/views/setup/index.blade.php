@extends('layouts.f4.base')
@section('content')
@if(isset($warning))
<h4 style="color:red;text-align:center">{{ $warning }}</h4>
<p><br>
@endif</p>
<table width="100%" border="0">
  <tr>
    <td>1</td>
    <td>{{ HTML::link('setup/users','ユーザーテーブルの作成') }}</td>
  </tr>
  <tr>
    <td>2</td>
    <td>{{ HTML::link('setup/profiles','プロフィールテーブルの作成') }}</td>
  </tr>
  <tr>
    <td>3</td>
    <td>{{ HTML::link('setup/roles','ロールテーブルの作成') }}</td>
  </tr>
  <tr>
    <td>4</td>
    <td>{{ HTML::link('setup/groups','グループテーブルの作成') }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td>{{ HTML::link('setup/belongs','所属テーブルの作成') }}</td>
  </tr>
  <tr>
    <td>6</td>
    <td>{{ HTML::link('setup/all','上記全テーブルの一括作成') }}</td>
  </tr>
</table>
@stop